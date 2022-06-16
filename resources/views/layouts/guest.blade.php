<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cocoo2-Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('css/font-awesome/all.min.css') }}">
  <!-- endinject -->  
  <!-- inject:css -->  
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/icon.jpg') }}" />
</head>

<body>
  <div class="container-scroller">
    {{ $slot }}
  </div>
  <!-- container-scroller -->
  <!-- plugins:js --> 
  
  <!-- endinject -->
</body>
</html>