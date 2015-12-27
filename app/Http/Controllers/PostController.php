<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function all(){
    	return Post::all();
    }
}
