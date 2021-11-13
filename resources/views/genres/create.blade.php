@extends('layouts.backend',['title' => $title])

@section('content')
    <div class="card">
        <div class="card-header">{{ $title }}</div>
        <div class="card-body">
            <form action="{{ route('genres.create') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
            </div>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
            <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection