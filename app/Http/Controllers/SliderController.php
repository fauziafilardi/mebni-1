<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SliderController extends Controller
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
        $datas = Slider::select(DB::raw("
            id,
            title,
            description,
            url,
            CASE WHEN is_active = 1 THEN 'Active' ELSE 'Not-Active' END as is_active,
            CASE WHEN is_caption = 1 THEN 'Show' ELSE 'Hide' END as is_caption,
            slider_path
        "))
        ->get();

        return view('backend.slider.index', [
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        return view('backend.slider.create');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'max:100',
                'description' => 'max:100',
                'slider_path' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $trans = DB::transaction(function () use ($request) {
                $user = Auth::user();

                $is_active = $request->is_active == 'on' ? 1 : 0;
                $is_caption = $request->is_caption == 'on' ? 1 : 0;

                $input['title'] = $request->title;
                $input['description'] = $request->description;
                $input['url'] = $request->url;
                $input['youtube_url'] = $request->youtube_url;
                $input['is_active'] = $is_active;
                $input['is_caption'] = $is_caption;
                $input['create_user'] = $user->id;

                if (!empty($request->slider_path)){
                    if ($request->file('slider_path')) {
                        $path_slider_path_name = Str::lower( 'slider-' . strtotime("now") . '.' . $request->slider_path->extension());
                        $path_slider_path = $request->file('slider_path')->storeAs('sliders', $path_slider_path_name, 'public');
                        $input['slider_path'] = '/storage/' . $path_slider_path;
                    }
                }

                Slider::create($input);
                return response()->json(['status' => 'success']);
            });

            return $trans;

        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e . ' Something went wrong'], 500);
        }
    }

    public function edit($np_id)
    {

    }

    public function update(Request $request, $np_id)
    {

    }

    public function destroy(string $id)
    {
    }

    public function delete_slider(Request $request)
    {
        try {
            // Fetch the item to be deleted, e.g., using the $id parameter
            $id = decrypt($request->id);

            $slider = Slider::find($id);

            if (!$slider) {
                return response()->json(['error' => 'data not found'], 404);
            }

            // Perform the deletion (or any other business logic)
            $slider->delete();

            return response()->json(['message' => 'data deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the item'], 500);
        }
    }

}
