<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if ($user->role == 1 || $user->role == 2) {
                return ($next($request));
            } else {
                abort(404);
            };
        });
    }

    public function index()
    {
        $events = Event::select(DB::raw("
            id,
            name,
            place,
            DATE_FORMAT(date, '%d %M %Y') as event_date,
            description,
            pic,
            FORMAT(price, 0) as price,
            image_path
        "))
        ->get();

        return view('backend.event.index', [
            'events' => $events
        ]);
    }

    public function create()
    {
        return view('backend.event.create');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'place' => 'required|string|max:100',
                'date' => 'required',
                'description' => 'required|string|max:100',
                'pic' => 'required|string|max:100',
                'price' => 'required|string|max:100',
                'image_path' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $trans = DB::transaction(function () use ($request) {
                $user = Auth::user();

                $slug = strtolower(substr(preg_replace('/\s+/', '-', $request->name), 0, 100)) . '-' . strtotime("now");
                $slug_ = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

                $input['name'] = $request->name;
                $input['place'] = $request->place;
                $input['date'] = $request->date;
                $input['description'] = $request->description;
                $input['pic'] = $request->pic;
                $input['price'] = $request->price;
                $input['slug'] = $slug_;
                $input['create_user'] = $user->id;

                if (!empty($request->image_path)){
                    if ($request->file('image_path')) {
                        $path_image_path_name = Str::lower( $slug_ . '.' . $request->image_path->extension());
                        $path_image_path = $request->file('image_path')->storeAs('events', $path_image_path_name, 'public');
                        $input['image_path'] = '/storage/' . $path_image_path;
                    }
                }

                Event::create($input);
                return response()->json(['status' => 'success']);
            });

            return $trans;

        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e . ' Something went wrong'], 500);
        }
    }

    public function edit($event_id)
    {
        $event_id = decrypt($event_id);
        $data = Event::find($event_id);

        if ($data == null) {
            return redirect()->intended('admin/event');
        }

        return view('backend.event.edit', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $event_id)
    {
        dd($event_id);
    }

    public function destroy(string $id)
    {
    }

    public function delete_event(Request $request)
    {
        try {
            // Fetch the item to be deleted, e.g., using the $id parameter
            $id = decrypt($request->id);

            $event = Event::find($id);

            if (!$event) {
                return response()->json(['error' => 'data not found'], 404);
            }

            // Perform the deletion (or any other business logic)
            $event->delete();

            return response()->json(['message' => 'data deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the item'], 500);
        }
    }

}
