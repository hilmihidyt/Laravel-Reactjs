@extends('layouts.app')

@section('content')
    <div class="container">
        <img src="{{ $band->picture }}" class="w-100 rounded mb-3" alt="{{ $band->name }}">

        <div class="row">
            <div class="col-md-8">
                <h4>{{ $band->name }} - <span class="text-muted mb-4">{{ $lyric->title }}</span></h4>
                <div>
                    {!! nl2br($lyric->body) !!}
                </div>
            </div>
            <div class="col-md-4">
                <h4 class="mb-4">The same album</h4>
                @foreach ($lyrics as $item)
                    <a href="{{ route('lyrics.show', [$band, $item]) }}" class="d-block">{{ $item->title }}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection