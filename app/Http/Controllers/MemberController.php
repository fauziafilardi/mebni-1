<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsPublication;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
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

        return view('backend.member.index', [
            'datas' => $datas,
        ]);
    }

    function show($slug)
    {
        $data = NewsPublication::select(DB::raw("
            id,
            title,
            publish_date,
            category,
            short_description,
            content_type,
            image_path,
            content,
            slug
        "))
        ->where('slug', $slug)
        ->first();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
