<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Http\Requests\Band\GenreRequest;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function create()
    {
        return view('genres.create',[
            'title' => "New Genre"
        ]);
    }

    public function store(GenreRequest $request)
    {
        Genre::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name)
        ]);

        return back()->with('success','Genre was created');
    }

    public function table()
    {
        return view('genres.table',[
            'genres' => Genre::withCount('bands')->latest()->paginate(12),
            'title' => "Genres"
        ]);
    }

    public function edit(Genre $genre)
    {
        return view('genres.edit',[
            'title' => "Edit Genre: {$genre->name}",
            'genre' => $genre
        ]);
    }

    public function update(Genre $genre, GenreRequest $request)
    {
        $genre->update([
            'name' => $request->name,
            'slug' => \Str::slug($request->name)
        ]);

        return redirect()->route('genres.table')->with('success','Genre was updated');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
    }

    public function show(Genre $genre)
    {
        return view('genres.show',[
            'title' => "{$genre->name}",
            'genre' => $genre,
            'bands' => $genre->bands()->latest()->paginate(2)
        ]);
    }
}
