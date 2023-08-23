<!DOCTYPE html>
<html lang="en">
<head>

@yield('estilos')



<style>
.main-content1{
  margin-top: 10%;
}



    .sidebar1 a:hover {
      color: black;
    }

    .sidebar1 a{
  font-family: "Inter", sans-serif;

}
/* ---------------------------------------- */
         .container1 {
  display: flex;
}

.sidebar1 {
  max-width: 25vh;
  position: sticky;
  top: 0;
  width: 100%;
  height: 100vh;
  background-color: #1967b1;

  transition: transform 0.3s ease-in-out;
  transform: translateX(0);
  z-index: 1;
}



.sidebar1.collapsed {
  transform: translateX(-25vh);
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
  color: white;
}

.main-content1 {
  flex-grow: 1;
  padding: 20px;
  transition: margin-left 0.3s ease-in-out;
}


.main-content1.collapsed {
  margin-left: -10%;
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

.overflow-hidden {
  overflow: hidden;
}



.boton2{
  display: none;
}


.logo-tvc{
  width: 100px;
  margin-top: 70px;
}

.logo-container {
  display: flex;
  justify-content: center;


}

.sidebar1 li.active {
  background-color: cadetblue;
}


/******************************************* ESTILOS PARA VERSION MOVIL **********************/
@media (max-width: 768px) {


.sidebar1{
  display: none;

}

.sidebar2{
  background: #1967b1;
}

.boton2{
  display: flex;
}
.boton1{
  display: none;
}

.sidebar2 a{
  font-family: "Inter", sans-serif;

}

/* .sidebar2 li a {
  color: white;
} */
#collapseButton2 {
  position: fixed;
  top: 10px;
  left: 10px;
  font-size: 20px;
  border: none;
  background-color: transparent;
  cursor: pointer;
  z-index: 2;
}



.main-content1.collapsed {
margin-left: 1vw;
margin-right: 18vw;
}



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
  <nav class="navbar navbar-expand-lg bg-body-tertiary  fixed-top">

    {{-- BOTON PARA VERSION DE ESCRITORIO --}}
    <button id="collapseButton1" class="boton1"> <span class="navbar-toggler-icon"></span> </button>

       {{-- BOTON PARA VERSION MOVIL --}}
       <button id="collapseButton2" class="boton2" id="boton2" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"> <span class="navbar-toggler-icon"></span> </button>



  <div class="item ms-auto">
      <ul class="nav justify-content-end">
          <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{secure_url('/')}}">Home</a>
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
</nav>




<div class="container1">

  {{-- SIDEBAR VISIBLE DESDE DESKTOP --}}
  <div class="sidebar1">
    <a class="navbar-brand" href="{{secure_url('/')}}">
      <div class="logo-container">
        <img class="logo-tvc" src="{{secure_asset('tvc.png')}}" alt="Logo">
      </div>
    </a>
    <nav>
      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="{{secure_url('/')}}">Inicio</a></li>
        <!-- Dropdown -->
        <li class="nav-item">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="collapse" data-bs-target="#historialDropdown" aria-expanded="false" aria-controls="historialDropdown">Subscripcion</a>
          <div id="historialDropdown" class="collapse">
            <ul class="nav flex-column">

              <li class="nav-item">
                <form id="cancel-subscription-form" action="{{ secure_url('/cancel-suscription') }}" method="POST">
                    @csrf
                    <button type="button" class="nav-link" style="border: none; background: none; padding: 0;" onclick="confirmCancellation()">Cancelar Suscripción</button>
                </form>
            </li>
              
              <li class="nav-item"><a class="nav-link" href="{{secure_url('/subscriptions/change')}}">Cambiar Plan</a></li>
            </ul>
          </div>
        </li>


        <li class="nav-item"><a class="nav-link" href="{{secure_url('/entrega1',['id' => 1])}}" >Entregas</a></li>
        <li class="nav-item"><a class="nav-link" href="{{secure_url('/entrega1',['id' => 2])}}">Prestamos</a></li>
        <li class="nav-item"><a class="nav-link" href="{{secure_url('/entrega1',['id' => 3])}}">Salidas</a></li>

        <li class="nav-item">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="collapse" data-bs-target="#historialDropdown" aria-expanded="false" aria-controls="historialDropdown">Historial</a>
          <div id="historialDropdown" class="collapse">
            <ul class="nav flex-column">
              <li class="nav-item"><a class="nav-link" href="{{secure_url('/historial')}}">Entrega</a></li>
              <li class="nav-item"><a class="nav-link" href="{{secure_url('historialprestamo')}}">Prestamo</a></li>
              <li class="nav-item"><a class="nav-link" href="{{secure_url('')}}">Salida de Equipo</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{secure_url('/listaequipo')}}">Inventario</a></li>
      </ul>
    </nav>
  </div>



    <div class="sidebar2">
{{--
      <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        Button with data-bs-target
      </button>
       --}}
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <a class="navbar-brand" href="{{secure_url('/')}}">
            <div class="logo-container">
              <img class="logo-tvc" src="{{secure_asset('tvc.png')}}" alt="Logo">
            </div>
          </a>
          <nav>
            <ul class="nav flex-column">
              <li class="nav-item"><a class="nav-link" href="secure_url('/')">Inicio</a></li>
              <li class="nav-item"><a class="nav-link" href="{{secure_url('/entrega1',['id' => 1])}}" >Entregas</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Prestamos</a></li>
              <li class="nav-item">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="collapse" data-bs-target="#historialDropdown" aria-expanded="false" aria-controls="historialDropdown">Historial</a>
                <div id="historialDropdown" class="collapse">
                  <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="#">Entrega</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Prestamo</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Salida de Equipo</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item"><a class="nav-link" href="#">Inventario</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>


    <div class="main-content1">

      @yield('content')


    </div>



    @yield('aside')







  </div>





@yield('scripts')


{{-- confirmacion si se desea cancelar la subscripcion --}}
<script>
  function confirmCancellation() {
      if (confirm('¿Estás seguro de que deseas cancelar la suscripción?')) {
          document.getElementById('cancel-subscription-form').submit();
      }
  }
</script>

    <script>
var collapseButton = document.getElementById('collapseButton1');
var sidebar = document.querySelector('.sidebar1');
var mainContent = document.querySelector('.main-content1');
var isMobile = window.innerWidth <= 768;



collapseButton.addEventListener('click', toggleSidebar);

function toggleSidebar() {
  sidebar.classList.toggle('collapsed');
  mainContent.classList.toggle('collapsed');

}

    </script>

<script>
  // Obtener todos los elementos <li> dentro de la barra lateral
  var sidebarItems = document.querySelectorAll('.sidebar1 li');

  // Recorrer todos los elementos y agregar un evento de clic
  sidebarItems.forEach(function(item) {
    item.addEventListener('click', function() {
      // Eliminar la clase 'active' de todos los elementos
      sidebarItems.forEach(function(item) {
        item.classList.remove('active');
      });

      // Agregar la clase 'active' al elemento seleccionado
      this.classList.add('active');
    });
  });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>


</html>
