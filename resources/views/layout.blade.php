<!DOCTYPE html>
<html>
<head>
  <title>@yield('title')</title>
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
  <!-- Header section -->
  <header>
    <!-- Your header HTML code here -->
  </header>
  
  <!-- Main content section -->
  <main>
    @yield('content')
  </main>
  
  <!-- Footer section -->
  <footer>
    <!-- Your footer HTML code here -->
  </footer>
</body>
</html>