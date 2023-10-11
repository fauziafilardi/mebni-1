<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\NewsPublication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class NewsPublicationController extends Controller
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
        $datas = NewsPublication::select(DB::raw("
            id,
            title,
            publish_date,
            category,
            short_description,
            content_type,
            image_path,
            content,
            slug
        "))->get();

        return view('backend.news_publication.index', [
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        return view('backend.news_publication.create');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:100',
                'category' => 'required|string|max:15',
                'publish_date' => 'required',
                'content_type' => 'required|string|max:10',
                'short_description' => 'required|string|max:100',
                'image_path' => 'required',
                'content' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $trans = DB::transaction(function () use ($request) {
                $user = Auth::user();

                $slug = strtolower(substr(preg_replace('/\s+/', '-', $request->title), 0, 100)) . '-' . strtotime("now");
                $slug_ = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

                $input['title'] = $request->title;
                $input['category'] = $request->category;
                $input['publish_date'] = $request->publish_date;
                $input['content_type'] = $request->content_type;
                $input['short_description'] = $request->short_description;
                $input['content'] = $request->content;
                $input['slug'] = $slug_;
                $input['create_user'] = $user->id;

                if (!empty($request->image_path)){
                    if ($request->file('image_path')) {
                        $path_image_path_name = Str::lower( $request->category . '_' . $request->content_type . '_' . time() . '.' . $request->image_path->extension());
                        $path_image_path = $request->file('image_path')->storeAs('news_publication', $path_image_path_name, 'public');
                        $input['image_path'] = '/storage/' . $path_image_path;
                    }
                }

                NewsPublication::create($input);
                return response()->json(['status' => 'success']);
            });

            return $trans;

        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Database error or some other error
            return response()->json(['error' => $e . ' Something went wrong'], 500);
        }
    }

    public function edit($np_id)
    {

        $np_id = decrypt($np_id);
        $data = NewsPublication::find($np_id);

        if ($data == null) {
            return redirect()->intended('admin/news_publication');
        }

        return view('backend.news_publication.edit', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $np_id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:100',
                'category' => 'required|string|max:15',
                'publish_date' => 'required',
                'content_type' => 'required|string|max:10',
                'short_description' => 'required|string|max:100',
                'image_path' => 'required',
                'content' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $trans = DB::transaction(function () use ($request, $np_id) {
                $user = Auth::user();
                $np_id = decrypt($np_id);

                $slug = strtolower(substr(preg_replace('/\s+/', '-', $request->title), 0, 100)) . '-' . strtotime("now");
                $slug_ = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

                $input['title'] = $request->title;
                $input['category'] = $request->category;
                $input['publish_date'] = $request->publish_date;
                $input['content_type'] = $request->content_type;
                $input['short_description'] = $request->short_description;
                $input['content'] = $request->content;
                $input['slug'] = $slug_;
                $input['update_user'] = $user->id;

                if (!empty($request->image_path)) {
                    if ($request->file('image_path')) {
                        $image_path_name = Str::lower($request->category . '_' . $request->content_type . '_' . time() . '.' . $request->image_path->extension());
                        $image_path = $request->file('image_path')->storeAs('news_publication', $image_path_name, 'public');

                        //Remove existing file
                        $old_path_foto = public_path() . '/' . $request->image_path_old;
                        if (!empty($request->image_path_old)) {
                            if (file_exists($old_path_foto)) {
                                unlink($old_path_foto);
                            }
                        }

                        $input['image_path'] = '/storage/' . $image_path;
                    }
                };

                NewsPublication::where('id', $np_id)
                    ->update($input);
                return response()->json(['status' => 'success']);
            });

            return $trans;

        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Database error or some other error
            return response()->json(['error' => $e . ' Something went wrong'], 500);
        }
    }

    public function delete_news_publication(Request $request)
    {
        try {
            $id = decrypt($request->id);

            $slider = NewsPublication::find($id);

            if (!$slider) {
                return response()->json(['error' => 'data not found'], 404);
            }

            $slider->delete();

            return response()->json(['message' => 'data deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the item'], 500);
        }
    }
}
