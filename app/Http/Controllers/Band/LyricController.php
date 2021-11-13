<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Http\Resources\LyricResource;
use App\Models\Band;
use App\Models\Lyric;
use Illuminate\Http\Request;

class LyricController extends Controller
{
    public function create()
    {
        return view('lyrics.create',[
            'title' => "New Lyric"
        ]);
    }

    public function store()
    {
        request()->validate([
            'album' => 'required',
            'band' => 'required',
            'body' => 'required',
            'title' => 'required'
        ]);

        $band = Band::find(request('band'));

        $band->lyrics()->create([
            'title' => request('title'),
            'slug' => \Str::slug(request('title')),
            'body' => request('body'),
            'album_id' => request('album')
        ]);


        return response()->json(['message' => 'The lyrics was created into band ' . $band->name]);
    }

    public function table()
    {
        return view('lyrics.table',[
            'title' => "Lyrics"
        ]);
    }

    public function dataTable()
    {
        $bandId = request('band_id');
        $albumId = request('album_id');

        if ($bandId && !$albumId) {
           $lyrics = Lyric::where('band_id', $bandId)->latest()->get();
        } elseif($bandId && $albumId) {
            $lyrics = Lyric::where([
                ['band_id', $bandId],
                ['album_id', $albumId]
            ])->latest()->get();
        } else {
            $lyrics = Lyric::latest()->paginate(2);
        }

        return LyricResource::collection($lyrics);
    }

    public function show(Lyric $lyric)
    {
        return $lyric;
    }

    public function edit(Lyric $lyric)
    {
        return view('lyrics.edit',[
            'lyric' => $lyric,
            'title' => "Edit Lyric: {$lyric->title}"
        ]);
    }

    public function update(Lyric $lyric)
    {
        request()->validate([
            'album' => 'required',
            'band' => 'required',
            'body' => 'required',
            'title' => 'required'
        ]);

        $band = Band::find(request('band'));

        $lyric->update([
            'band_id'   => request('band'),
            'title'     => request('title'),
            'slug'      => \Str::slug(request('title')),
            'body'      => request('body'),
            'album_id'  => request('album')
        ]);


        return response()->json(['message' => 'The lyrics was updated into band ' . $band->name]);
    }
}
