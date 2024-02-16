<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') Kartoharjo Recycle</title>
    <!-- Styles, scripts, or other common meta tags -->
</head>
<body>
    <header>
        <nav>
            <!-- Navigation links go here -->
        </nav>
    </header>

    <main>
        @yield('content') <!-- This is where the specific page content will be injected -->
    </main>

    <footer>
        <!-- Footer content goes here -->
    </footer>

    <!-- Additional scripts or assets -->
</body>
</html>
