@extends('layouts.app')

@section('content')
<div class="container">
    <img src="{{ $band->picture }}" alt="" class="w-100 rounded" height="400px" style="object-fit: cover; object-position: top">
    <h3 class="text-center mt-4">{{ $band->name }}</h3>

    <div class="mb-4">
        @foreach ($band->genres as $genre)
            <a href="#" class="text-secondary">{{ $genre->name }}</a>
        @endforeach
    </div>

    @foreach ($albums as $album)
    @if ($album->lyrics_count)
        <div class="card mb-3">
            <div class="card-header">{{ $album->name }} - {{ $album->year }}</div>
            <div class="card-body">
                @foreach ($album->lyrics as $lyric)
                    <a href="" class="d-block" >{{ $lyric->title }}</a>
                @endforeach
            </div>
        </div>
    @endif
    @endforeach
</div>
@endsection
