<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function index(){
      $comments=Comment::all();
      return view('comments', ['comments'=>$comments]);
    }

    public function add(){
      return view('add');
    }

    public function store(CommentRequest $data){

      Comment::create([
        'name'=>$data->name,
        'email'=>$data->email,
        'text'=>$data->text
      ]);

      return redirect(route('comments'));
    }
}
