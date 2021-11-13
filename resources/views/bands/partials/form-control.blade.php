            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="thumbnail" class="form-control-file" id="thumbnail">
                @error('thumbnail')
                <div class="mt-2 text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ old('name') ?? $band->name }}" class="form-control" id="name">
                @error('name')
                <div class="mt-2 text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="genres">Choose Genre</label>
                <select name="genres[]" id="genres" class="form-control select2-multiple" multiple="multiple">
                @foreach ($genres as $genre)
                <option {{ $band->genres()->find($genre->id) ? 'selected' : ''}} value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
                </select>
                @error('genres')
                <div class="mt-2 text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>