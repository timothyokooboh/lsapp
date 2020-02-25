<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "Welcome to LSAPP built with laravel";
        return view('pages.index')->with('title',$title);
    }

    public function about(){
        $title = "About us";
        return view('pages.about')->with('title',$title);
    }

    public function services(){
        $data = array(
            'title'=>"services",
            'services' => ["patient data documentation", "patient data security", "patient follow up"]
        );
        return view('pages.services')->with($data);
    }
}
