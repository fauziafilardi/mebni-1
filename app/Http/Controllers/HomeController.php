<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsPublication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 3) {
            return redirect()->route('member.index');
        } else {
            return view('backend.home', []);
        }

    }
}
