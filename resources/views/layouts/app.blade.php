<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- resources/views/partials/navbar.blade.php -->
<div class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">GuysApp</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('guys.index') }}">List Guys</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('guys.create') }}">Add New Guy</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('send-message-form') }}">Send Messages</a>
            </li>
        </ul>
    </div>
</div>


<div class="container mt-4">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
