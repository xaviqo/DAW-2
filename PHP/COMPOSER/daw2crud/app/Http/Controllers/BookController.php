<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['books']=Book::paginate(5);
        return view('book.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = $request->except('_token');

        if ($request->hasFile('image')) {
            $book['image'] = $request->file('image')->store('uploads','public');
        }

        Book::insert($book);
        return redirect('book')->with('message','Book stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return null;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $new_book_data = $request->except(['_token','_method']);
        if ($request->hasFile('image')) {
            $book = Book::findOrFail($id);
            Storage::delete('public/'.$book->image);
            $new_book_data['image'] = $request->file('image')->store('uploads','public');
        }
        Book::where('id','=',$id)->update($new_book_data);
        $book = Book::findOrFail($id);
        return view('book.edit', compact('book'))->with('message','Book edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if (Storage::delete('public/'.$book->image)){
            Book::destroy($id);
        }
        return redirect('/book')->with('message','Book deleted successfully');
    }
}
