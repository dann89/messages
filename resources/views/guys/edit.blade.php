{{-- resources/views/guys/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Guy')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Edit Guy</h2>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('guys.update', $guy->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $guy->name }}" required>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile:</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $guy->mobile }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Guy</button>
            </form>
        </div>
    </div>
@endsection
