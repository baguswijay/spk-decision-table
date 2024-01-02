<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> --}}
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <title>SPK</title>
</head>
<body>
    <ul class="nav nav-pills" id="myNav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('kriteria.index') }}">Active</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('hitung.index') }}" id="homeLink">Home</a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li> --}}
      </ul>

    <div class="container">
        @yield('content')
    </div>



</body>
</html>

<script>
    $(document).ready(function() {
      // Mengatur event click pada link "Home"
      $("#homeLink").click(function() {
        // Menghapus kelas 'active' dari semua elemen
        $("#myNav .nav-item").removeClass("active");

        // Menambahkan kelas 'active' pada link yang diklik
        $(this).closest(".nav-item").addClass("active");
      });
    });
</script>
