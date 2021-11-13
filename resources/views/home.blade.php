@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($bands as $band)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ $band->picture }}" alt="{{ $band->name }}" class="img-fluid">
                    <div class="card-body">
                        {{ $band->name }}
                    </div>
                    <div class="card-footer">
                        {{ $band->album->name ?? '' }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $bands->links() }}
</div>
@endsection
