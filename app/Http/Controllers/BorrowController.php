<?php

namespace App\Http\Controllers;

use App\Borrow;
use App\Http\Requests\SaveBorrowRequest;
use App\Isbn;
use App\Libro;
use App\User;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function __construct()
    {
        // $this->middleware([
        //     'auth',
        //     'roles:admin'
        // ])->except(['myBorrows','create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrows = Borrow::select('isbns.isbn', 'borrows.isbn_id', 'borrows.id','users.name', 'libros.title')
            ->join('users', 'users.id', '=', 'borrows.user_id')
            ->join('isbns', 'isbns.id', '=', 'borrows.isbn_id')
            ->join('libros', 'libros.id', '=', 'isbns.libro_id')
            ->paginate(10);

        return view('borrow.index',[
            'borrows'=> $borrows
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($libro, $isbn)
    {
        return view('borrow.create', [
            'libro' => Libro::find($libro),
            'isbn' => Isbn::find($isbn)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveBorrowRequest $request)
    {
        $isbn = Isbn::find(request('isbn'));
        $user = request('user');

        $borrow = Borrow::create([
            'isbn_id' => $isbn->id,
            'user_id' => $user
        ]);

        Libro::find(request('libro'))->decrement('count', 1);
        Isbn::find(request('isbn'))->update(['state' => 1]);

        return redirect()->route('libro.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Libro $libro, Isbn $isbn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $borrow = Borrow::find($id);
        $isbn = Isbn::find($borrow->isbn_id);
        $libro = $isbn->libro;
        $borrow->delete();
        $libro->increment('count', 1);
        $isbn->update(['state' => 0]);

        return redirect()->route('libro.index');
    }

    public function myBorrows()
    {
        $borrows = Borrow::select('isbns.isbn', 'borrows.isbn_id', 'borrows.id', 'libros.title')
            ->join('users', 'users.id', '=', 'borrows.user_id')
            ->join('isbns', 'isbns.id', '=', 'borrows.isbn_id')
            ->join('libros', 'libros.id', '=', 'isbns.libro_id')
            ->where('borrows.user_id', '=', auth()->user()->id)
            ->paginate(10);
        return view('borrow.index', ['borrows' => $borrows]);
    }
}
