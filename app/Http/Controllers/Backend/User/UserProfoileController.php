<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfoileController extends Controller
{
    public function profile()
    {
        return view('backend.user.profile.dashboard');
    }
}
