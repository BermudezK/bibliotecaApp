<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveLibroRequest;
use App\Isbn;
use App\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth',
            'roles:admin'
        ])->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('libro.index', [
            'libros'=>Libro::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('libro.create', [
            'libro' => new Libro(),
            'isbn'=>[]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveLibroRequest $request)
    {
        $isbns=request('isbn');
        $count= count($isbns);
        $libro= Libro::create([
            'title'=>request('title'),
            'description'=>request('description'),
            'count'=>$count
        ]);
        foreach($isbns as $isbnItem){
            Isbn::create([
                'isbn'=> $isbnItem,
                'libro_id'=>$libro->id
            ]);
        };
        return redirect()->route('libro.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Libro $libro)
    {
        $isbn = Libro::find($libro->id)->isbns;

        return view('libro.show', ['libro' => $libro, 'isbn'=> $isbn]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Libro $libro)
    {
        $isbn = Libro::find($libro->id)->isbns;

        return view('libro.edit', [
            'libro' => $libro,
            'isbn'=> $isbn
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveLibroRequest $request, Libro $libro)
    {
        $libro->update($request->validated());
        return redirect()->route('libro.show', $libro);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Libro $libro)
    {
        $libro->delete();

        return redirect()->route('libro.index');
    }
}
