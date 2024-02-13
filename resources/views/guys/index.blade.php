{{-- resources/views/guys/index.blade.php --}}
@extends('layouts.app')

@section('title', 'List of Guys')

@section('content')
    <div class="container">
        <h2>List of Guys</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Mobile</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($guys as $guy)
                <tr>
                    <td>{{ $guy->name }}</td>
                    <td>{{ $guy->mobile }}</td>
                    <td>
                        <a href="{{ route('guys.edit', $guy->id) }}" class="btn btn-sm btn-info">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
