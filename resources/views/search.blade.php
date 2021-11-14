@extends('layouts.app')

@section('content')
<div class="container">
    <h4>You are search for <q>{{ $keyword }}</q> get {{ $lyrics->count() }} result</h4>
    <div class="row">
        <div class="col-md-6">
            @foreach ($lyrics as $lyric)
                <p><a href="{{ route('lyrics.show',[$lyric->band, $lyric]) }}">{{ $lyric->title }}</a></p>
            @endforeach
        </div>
    </div>
    {{ $lyrics->appends(['keyword' => $keyword])->links() }}
</div>
@endsection
