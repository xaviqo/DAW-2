<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function all(){
        $book = new Book();
        return view('welcome',['books' => Book::all()]);
    }

    public function create(Request $request){
        $book = $request->except('_token');
        Book::insert($book);
        return $book;
    }
}
