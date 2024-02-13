{{-- resources/views/send-message.blade.php --}}
@extends('layouts.app')

@section('title', 'Send Messages')

@section('content')
    <h2>Send a Message</h2>
    <!-- Your form content here -->


<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('send-messages') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="guys">Select Guys</label>
            <select id="guys" name="guys[]" multiple class="form-control">
                @foreach($guys as $guy)
                    <option value="{{ $guy->id }}">{{ $guy->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
