{{-- resources/views/guys/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Add New Guy')

@section('content')
    <h2>Add New Guy</h2>
    <!-- Your form content here -->



<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('guys.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile number" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Guy</button>
            </form>
        </div>
    </div>
</div>


<!-- Bootstrap JS (using Bootstrap 4 for this example) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
