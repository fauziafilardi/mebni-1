<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ContentController extends Controller
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
        $contents = Content::select(DB::raw("
            id,
            title,
            slug,
            CASE
                WHEN is_active = 1
                THEN 'Active'
                ELSE 'Not-Active'
            END as is_active
        "))
        ->get();

        return view('backend.content.index', [
            'contents' => $contents
        ]);
    }

    public function create()
    {
        return view('backend.content.create');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:100',
                'slug' => 'required|string|max:100',
                'content' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }


            $trans = DB::transaction(function () use ($request) {
                $user = Auth::user();

                $input['title'] = $request->title;
                $input['slug'] = $request->slug;
                $input['is_active'] = $request->is_active == true ? 1 : 0;
                $input['content'] = $request->content;
                $input['create_user'] = $user->id;

                Content::create($input);
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

    public function edit($content_id)
    {
        $content_id = decrypt($content_id);
        $data = Content::find($content_id);

        if ($data == null) {
            return redirect()->intended('admin/content');
        }

        return view('backend.content.edit', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $content_id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'content' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $trans = DB::transaction(function () use ($request, $content_id) {
                $user = Auth::user();
                $content_id = decrypt($content_id);

                $input['is_active'] = $request->is_active == true ? 1 : 0;
                $input['content'] = $request->content;
                $input['update_user'] = $user->id;


                Content::where('id', $content_id)
                    ->update($input);

                return response()->json(['status' => 'success']);
            });

            return $trans;

        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e . ' Something went wrong'], 500);
        }
    }
}
