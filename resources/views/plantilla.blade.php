<!DOCTYPE html>
<html lang="en">
<head>
    @yield('cabecera')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>
<body>

    <nav>
        <ul class="nav justify-content-end">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{secure_url(route('home'))}}">Home</a>
          </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Entregas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Equipos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Historial</a>
            </li>
            <li class="nav-item">
          </li>
              <a class="nav-link disabled">  {{  auth()->user()->name}} </a>
          </li>
          
          </ul>
    </nav>
    <main>

        @yield('content')
    </main>
    <footer>

    </footer>
</body>
@yield('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>