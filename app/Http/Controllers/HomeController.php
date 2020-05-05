<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    private $post;
    public function __construct(Post $post) {
        $this->post = $post;
    }

    public function index()
    {

        $posts = $this->post->all();
        return view('home', compact("posts"));
    }
}
