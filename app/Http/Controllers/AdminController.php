<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:api')->except('index', 'show');
    }
    //
    public function index(){

    }

    //
    public function adminList(){        
        $user = \Auth::user();
        return json_encode($user);
    }

    /**
     * Update a user's profile
     *
     * @param $username
     * @return mixed
     * @throws Laracasts\Validation\FormValidationException
     */
    public function update($username, Request $request)
    {
        
    }
}
