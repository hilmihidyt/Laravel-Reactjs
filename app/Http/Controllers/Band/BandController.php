<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Http\Requests\Band\BandRequest;
use App\Models\{Band, Genre};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BandController extends Controller
{
    public function table()
    {
        if (request()->expectsJson()) {
            return Band::latest()->get(['id','name']);
        }
        return view('bands.table',[
            'bands' => Band::latest()->paginate(16)
        ]);
    }
    public function create()
    {
        return view('bands.create',[
             'genres' => Genre::all(),
             'band' => new Band,
             'submitLabel' => 'Create'
        ]);
    }

    public function store(BandRequest $request)
    {
        $band = Band::create([
            'name' => request('name'),
            'slug' => \Str::slug(request('name')),
            'thumbnail' => request('thumbnail') ? request()->file('thumbnail')->store('images/band') : null,
        ]);

        $band->genres()->sync(request('genres'));

        return back()->with('success', 'Band was created');
        
    }

    public function edit(Band $band)
    {
        return view('bands.edit',[
            'band'=> $band,
            'genres' => Genre::all(),
            'submitLabel' => 'Update'
        ]);
    }

    public function update(BandRequest $request,Band $band)
    {

        if (request('thumbnail')) {
            
            Storage::delete($band->thumbnail);
            
            $thumbnail = request()->file('thumbnail')->store('images/band');
        
        } elseif($band->thumbnail) {
        
            $thumbnail = $band->thumbnail;
        
        } else {
        
            $thumbnail = null;
        
        }

        $band->update([
            'name' => request('name'),
            'slug' => \Str::slug(request('name')),
            'thumbnail' => $thumbnail,
        ]);

        $band->genres()->sync(request('genres'));

        return back()->with('success', 'Band was updated');
        
    }

    public function destroy(Band $band)
    {
        Storage::delete($band->thumbnail);

        $band->genres()->detach();

        $band->albums()->delete();

        $band->delete();
    }

    public function show(Band $band) {
        return view('bands.show',[
            'band' => $band,
            'title' => $band->name,
            'albums' => $band->albums()->withCount('lyrics')->with('lyrics','lyrics.band')->latest()->get()
        ]);
    }



}
