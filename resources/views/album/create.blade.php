@extends('layouts.main')

@section('title', 'New Album')

@section('content')
{{-- will submit form to /albums w route name album.store --}}
<form action="{{ route('album.store') }}" method="POST"> 
    {{-- look at slides --}}
    @csrf 
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" value={{ old('title') }}>
        {{-- 'title' corresponds to the name attribute of the field to be validated --}}
        @error('title') 
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="artist" class="form-label">Artist</label>
        <select name="artist" id="artist" class="form-select">
            <option value="">-- Select Artist --</option>
            @foreach($artists as $artist)
                <option 
                    value="{{$artist->id}}"
                    {{-- terneray statement --}}
                    {{ $artist->id == old('artist') ? "selected" : "" }}> 
                    {{$artist->name}}
                </option>
            @endforeach
        </select>
        {{-- 'artist' corresponds to the name attribute of the field to be validated --}}
        @error('artist')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">
        Save
    </button>
</form>
@endsection
