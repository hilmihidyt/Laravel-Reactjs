<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Models\{Album, Band};

class AlbumController extends Controller
{
    public function table()
    {
        return view('albums.table',[
            'albums' => Album::paginate(16),
            'title' => 'Albums'
        ]);
    }

    public function create()
    {
        return view('albums.create',[
            'title' => 'New Album',
            'bands'  => Band::all(),
            'submitLabel' => "Create",
            'album' => new Album
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|unique:albums,name',
            'band' => 'required',
            'year' => 'required'
        ]);

        $band = Band::find(request('band'));

        Album::create([
            'name' => request('name'),
            'slug' => \Str::slug(request('name')),
            'band_id' => request('band'),
            'year' => request('year')
        ]);

        return back()->with('status','Album was created into '. $band->name);
    }

    public function edit(Album $album)
    {
        return view('albums.edit',[
            'title' => "Edit album: {$album->name}",
            'bands'  => Band::all(),
            'album' => $album,
            'submitLabel' => "Update"
        ]);
    }

    public function update(Album $album)
    {
        request()->validate([
            'name' => 'required|unique:albums,name,' . $album->id,
            'band' => 'required',
            'year' => 'required'
        ]);

        $album->update([
            'name' => request('name'),
            'slug' => \Str::slug(request('name')),
            'band_id' => request('band'),
            'year' => request('year')
        ]);

        return redirect()->route('albums.table')->with('status','Album was updated');
    }

    public function destroy(Album $album)
    {
        $album->delete();
    }
}
