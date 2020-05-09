<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

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

    
    //
    public function index(){
        return view('admin.news',['menu'=>'news', 'news' => News::orderBy('id','DESC')->get()]);
    }

    
    public function settings(){
        return view('admin.settings', ['menu'=>'settings']);
    }
    
    public function nPassword($request){
        echo "asdf";
        exit;
        // $this->validate($request, [
        //     'title' => 'required',
        //     'content' => 'required'
        // ]);
    }
}
