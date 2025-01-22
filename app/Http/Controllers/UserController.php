<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index()
    {
        // $forms = Form::where('status_id', 1)->get();
        $users = User::all();
        return view('user', compact('users'));
    }
}
