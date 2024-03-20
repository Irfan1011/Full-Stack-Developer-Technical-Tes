<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    // redirect to book create view
    public function create()
    {
        return view('Book/create');
    }

    // store book data to database
    public function store(Request $request)
    {
        $bookData = $request->all();

        // data validation
        $validate = Validator::make($bookData, [
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
        ]);

        if($validate->fails()){
            return redirect()->back()->with('error', $validate->errors()->first()); //back pada halaman sebelumnya
            // return response([
            //     'message' => $validate->errors()->first(),
            // ],400); // 400 = bad request
        }

        $book = Book::create($bookData);
        return redirect('/dashboard')->with('success', 'Book Added');
        // return response([
        //     'message' => 'Book Added',
        //     'data' => $book
        // ],200); // 200 = success
    }

    // redirect to book edit view
    public function edit($id)
    {
        $book = Book::find($id);
        return view('Book/edit', compact('book'));
    }

    // update book data in database
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        // data validation
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
        ]);
        
        if($validate->fails()){
            return redirect()->back()->with('error', $validate->errors()->first()); //back pada halaman sebelumnya
            // return response([
            //     'message' => $validate->errors()->first(),
            // ],400);
        }

        $bookData = $request->all();
        $book->update($bookData);
        return redirect('/dashboard')->with('success', 'Book Updated');
        // return response([
        //     'message' => 'Book Updated',
        //     'data' => $bookData
        // ],200);
    }

    // delete book from database
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect('/dashboard')->with('success', 'Book Deleted');
        // return response([
        //     'message' => 'Book Deleted',
        // ], 200);
    }
}
