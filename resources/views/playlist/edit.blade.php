@extends('layouts.main')

@section('title')
    Editing {{ $playlist->name }}
@endsection

@section('content')
{{-- will submit form to /playlists/{id} w route name playlist.update --}}
<form action="{{ route('playlist.update', [ 'id' => $playlist->id ]) }}" method="POST"> 
    @csrf 
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input 
            type="text" 
            name="name" 
            id="name" 
            class="form-control" 
            value="{{ old('name', $playlist->name) }}"
        >
        @error('name') 
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">
        Save
    </button>
</form>
@endsection
