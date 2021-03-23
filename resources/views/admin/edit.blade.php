@extends('layouts.main')

@section('title', 'Admin')

@section('content')
<form method="post" action="{{ route('admin.store') }}">
    @csrf
    <div class="mt-3 mb-3">
        <input type="checkbox" id="maintenance-mode" name="maintenance-mode" value="true">
        <label for="maintenance-mode" class="form-label">Maintenance Mode</label><br>
    </div>
    <button type="submit" class="btn btn-primary">
        Save
    </button>
</form>
@endsection