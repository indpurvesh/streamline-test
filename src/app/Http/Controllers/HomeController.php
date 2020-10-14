<?php

namespace App\Http\Controllers;

use App\Models\Directory;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rootDirectories = Directory::with('children', 'files')->whereNull('parent_id')->get();
        return view('home')
            ->with('rootDirectories', $rootDirectories);
    }
}
