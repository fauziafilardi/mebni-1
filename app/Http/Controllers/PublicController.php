<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\NewsPublication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PublicController extends Controller
{
    public function index()
    {
        $data = 'data';
        return view('frontend.home', [
            'data' => $data,
        ]);
    }

    public function menu($param)
    {
        $data = Content::where('slug', $param)->first();

        return view('frontend.menu', [
            'title' => $param,
            'data' => $data,
        ]);
    }

    public function profile()
    {
        $data = Content::where('slug', 'profile')->first();

        return view('frontend.menu', [
            'title' => 'profile',
            'data' => $data,
        ]);
    }


    public function organization()
    {
        $data = Content::where('slug', 'organization')->first();

        return view('frontend.menu', [
            'title' => 'organization',
            'data' => $data,
        ]);
    }

    public function news()
    {
        $news_publication =
            NewsPublication::
                select(DB::raw("
                    title,
                    DATE_FORMAT(publish_date, '%d') as day_name,
                    DATE_FORMAT(publish_date, '%b') as month_name,
                    DATE_FORMAT(publish_date, '%W, %d %M, %Y') as publish_date,
                    category,
                    short_description,
                    content_type,
                    image_path,
                    content,
                    slug
                "))
                ->where('category', '=', 'news')
                ->where('content_type', '=', 'public')
                ->paginate(5);

        $categories = NewsPublication::
            select(DB::raw("
                category,
                COUNT(*) AS total
            "))
            ->where('content_type', '=', 'public')
            ->groupBy('category')
            ->get();

        $recent_posts = NewsPublication::
            select(DB::raw("
                CASE
                    WHEN CHAR_LENGTH(title) <= 25 THEN title
                    ELSE CONCAT(LEFT(title, 25), '...')
                END AS title,
                DATE_FORMAT(publish_date, '%d') as day_name,
                DATE_FORMAT(publish_date, '%b') as month_name,
                DATE_FORMAT(publish_date, '%d %M, %Y') as publish_date,
                category,
                short_description,
                content_type,
                image_path,
                content,
                slug
            "))
            ->where('content_type', '=', 'public')
            ->orderBy('publish_date', 'DESC')
            ->limit(5)
            ->get();

        // dd($news_publication);

        return view('frontend.news_publication', [
            'title' => 'news',
            'news_publication' => $news_publication,
            'categories' => $categories,
            'recent_posts' => $recent_posts,
        ]);
    }

    public function news_detail($slug)
    {
        $news_publication =
            NewsPublication::
                select(DB::raw("
                    title,
                    DATE_FORMAT(publish_date, '%W, %d %M, %Y') as publish_date,
                    category,
                    short_description,
                    content_type,
                    image_path,
                    content,
                    slug
                "))
                ->where('category', '=', 'news')
                ->where('content_type', '=', 'public')
                ->where('slug', '=', $slug)
                ->first();

        $categories = NewsPublication::
            select(DB::raw("
                category,
                COUNT(*) AS total
            "))
            ->where('content_type', '=', 'public')
            ->groupBy('category')
            ->get();

        $recent_posts = NewsPublication::
            select(DB::raw("
                CASE
                    WHEN CHAR_LENGTH(title) <= 25 THEN title
                    ELSE CONCAT(LEFT(title, 25), '...')
                END AS title,
                DATE_FORMAT(publish_date, '%d') as day_name,
                DATE_FORMAT(publish_date, '%b') as month_name,
                DATE_FORMAT(publish_date, '%d %M, %Y') as publish_date,
                category,
                short_description,
                content_type,
                image_path,
                content,
                slug
            "))
            ->where('content_type', '=', 'public')
            ->orderBy('publish_date', 'DESC')
            ->limit(5)
            ->get();

        return view('frontend.news_publication_detail', [
            'title' => 'news',
            'news_publication' => $news_publication,
            'categories' => $categories,
            'recent_posts' => $recent_posts,
        ]);
    }

    public function publication()
    {
        $news_publication =
            NewsPublication::
                select(DB::raw("
                    title,
                    DATE_FORMAT(publish_date, '%d') as day_name,
                    DATE_FORMAT(publish_date, '%b') as month_name,
                    DATE_FORMAT(publish_date, '%W, %d %M, %Y') as publish_date,
                    category,
                    short_description,
                    content_type,
                    image_path,
                    content,
                    slug
                "))
                ->where('category', '=', 'publication')
                ->where('content_type', '=', 'public')
                ->paginate(5);

        $categories = NewsPublication::
            select(DB::raw("
                category,
                COUNT(*) AS total
            "))
            ->where('content_type', '=', 'public')
            ->groupBy('category')
            ->get();

        $recent_posts = NewsPublication::
            select(DB::raw("
                CASE
                    WHEN CHAR_LENGTH(title) <= 25 THEN title
                    ELSE CONCAT(LEFT(title, 25), '...')
                END AS title,
                DATE_FORMAT(publish_date, '%d') as day_name,
                DATE_FORMAT(publish_date, '%b') as month_name,
                DATE_FORMAT(publish_date, '%d %M, %Y') as publish_date,
                category,
                short_description,
                content_type,
                image_path,
                content,
                slug
            "))
            ->where('content_type', '=', 'public')
            ->orderBy('publish_date', 'DESC')
            ->limit(5)
            ->get();

        return view('frontend.news_publication', [
            'title' => 'publication',
            'news_publication' => $news_publication,
            'categories' => $categories,
            'recent_posts' => $recent_posts,
        ]);
    }

    public function publication_detail($slug)
    {
        $news_publication =
            NewsPublication::
                select(DB::raw("
                    title,
                    DATE_FORMAT(publish_date, '%W, %d %M, %Y') as publish_date,
                    category,
                    short_description,
                    content_type,
                    image_path,
                    content,
                    slug
                "))
                ->where('category', '=', 'publication')
                ->where('content_type', '=', 'public')
                ->where('slug', '=', $slug)
                ->first();

        $categories = NewsPublication::
            select(DB::raw("
                category,
                COUNT(*) AS total
            "))
            ->where('content_type', '=', 'public')
            ->groupBy('category')
            ->get();

        $recent_posts = NewsPublication::
            select(DB::raw("
                CASE
                    WHEN CHAR_LENGTH(title) <= 25 THEN title
                    ELSE CONCAT(LEFT(title, 25), '...')
                END AS title,
                DATE_FORMAT(publish_date, '%d') as day_name,
                DATE_FORMAT(publish_date, '%b') as month_name,
                DATE_FORMAT(publish_date, '%d %M, %Y') as publish_date,
                category,
                short_description,
                content_type,
                image_path,
                content,
                slug
            "))
            ->where('content_type', '=', 'public')
            ->orderBy('publish_date', 'DESC')
            ->limit(5)
            ->get();

        return view('frontend.news_publication_detail', [
            'title' => 'publication',
            'news_publication' => $news_publication,
            'categories' => $categories,
            'recent_posts' => $recent_posts,
        ]);
    }

    public function event()
    {
        $events =
            Event::
                select(DB::raw("
                    id,
                    CASE
                        WHEN CHAR_LENGTH(name) <= 25 THEN name
                        ELSE CONCAT(LEFT(name, 25), '...')
                    END AS name,
                    place,
                    DATE_FORMAT(date, '%d %M %Y') as date,
                    FORMAT(price, 0) as price,
                    image_path,
                    slug
                "))
                ->paginate(10);

        return view('frontend.event', [
            'title' => 'event',
            'events' => $events,
        ]);
    }

    function event_detail($slug) {

        $data = Event::select(DB::raw("
            id,
            name,
            place,
            DATE_FORMAT(date, '%d %M %Y') as date,
            FORMAT(price, 0) as price,
            image_path,
            pic,
            description,
            slug
        "))
        ->where('slug', $slug)
        ->first();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function membership()
    {
        return view('frontend.membership', [
            'title' => 'membership',
        ]);
    }
}
