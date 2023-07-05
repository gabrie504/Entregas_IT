<!DOCTYPE html>
<html lang="en">
<head>

    <style>


/* ---------------------------------------- */
         .container1 {
  display: flex;
}

.sidebar1 {
  max-width: 250px;

  width: 100%;
  height: 100vh;
  background-color: #f0f0f0;
  transition: transform 0.3s ease-in-out;
  transform: translateX(0);
  z-index: 1;
}

.sidebar1.collapsed {
  transform: translateX(-300px);
}

.sidebar1 nav {
  margin-top: 50px;
}

.sidebar1 ul {
  list-style: none;
  padding: 0;
}

.sidebar1 li {
  padding: 10px;
}

.sidebar1 li a {
  text-decoration: none;
  color: #333;
}

.main-content1 {
  flex-grow: 1;
  padding: 20px;
  transition: margin-left 0.3s ease-in-out;
}

.main-content1.collapsed {
  margin-left: -250px;
}

#collapseButton1 {
  position: fixed;
  top: 10px;
  left: 10px;
  font-size: 20px;
  border: none;
  background-color: transparent;
  cursor: pointer;
  z-index: 2;
}

    </style>
    @yield('cabecera')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="mobile-web-app-capable" content="yes">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>@yield('title')</title>

</head>

<body>

        <div class="item ms-auto">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{secure_url(route('home'))}}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ secure_url('/logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ secure_url('/logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>

<div class="container1">
    <button id="collapseButton1">&laquo;</button>
    <div class="sidebar1">
      <nav>
        <ul>
          <li><a href="#">Inicio</a></li>
          <li><a href="#">Acerca de</a></li>
          <li><a href="#">Servicios</a></li>
          <li><a href="#">Contacto</a></li>
        </ul>
      </nav>
    </div>

    <main class="main-content1">
        @yield('content')
    </main>

  </div>



    <footer>

    </footer>
    @yield('scripts')

    <script>
        var collapseButton = document.getElementById('collapseButton1');
collapseButton.addEventListener('click', toggleSidebar);

function toggleSidebar() {
  var sidebar = document.querySelector('.sidebar1');
  var mainContent = document.querySelector('.main-content1');

  sidebar.classList.toggle('collapsed');
  mainContent.classList.toggle('collapsed');
}

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>


</html>
