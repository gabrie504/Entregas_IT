<!Doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    

  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" crossorigin="use-credentials" href="{{secure_asset('/manifest.json')}}">

    <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com"> 
    {{-- favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ secure_asset('/images/icons/icon-512x512.png') }}">
    @stack('styles')
    <style>
        .logo {
          position: absolute;
          top: 5px;
          left: 10px;
          width: 70px; /* Ajusta el tamaño del logo según tus necesidades */
        }

        @media (max-width: 767.98px) {
        .logo {
            position: relative;
            margin: 5px left;
            width: 20%; /* Ajusta el tamaño del logo según tus necesidades */
        }

        .navbar-brand {
            display: block;
            text-align: center;
        }
    }
        

  /* Style for the install notification */
  .install-notification {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 8px;
        cursor: pointer;
        animation: slide-up 0.3s ease-in-out; /* Add the animation */
    }

    /* Define the animation keyframes */
    @keyframes slide-up {
        from {
            transform: translateY(100%); /* Start from below the screen */
        }
        to {
            transform: translateY(0); /* Move to the top */
        }
    }

    .install-button:hover {
        background-color: #0056b3;
    }
      </style>
<script>
    window.addEventListener('beforeinstallprompt', (e) => {
        // Prevent the default event to prevent the automatic install prompt
        e.preventDefault();

        // Show a custom message to the user
        const installMessage = "¡Agrega esta aplicación a tu dispositivo para acceder fácilmente!";

        // Show the install prompt in a notification-like style
        const installNotification = document.createElement('div');
        installNotification.classList.add('install-notification'); // Add the class for the animation
        
        // Create a container for the message and button
        const contentContainer = document.createElement('div');
        contentContainer.textContent = installMessage;
        
        // Create the "Instalar" button with the style of btn-primary
        const installButton = document.createElement('button');
        installButton.textContent = 'Instalar';
        installButton.classList.add('btn', 'btn-info'); // Add the Bootstrap classes

        // Add a click event listener to the button
        installButton.addEventListener('click', () => {
            // Show the install prompt
            e.prompt();

            // Wait for the user to respond to the prompt
            e.userChoice.then((choiceResult) => {
                if (choiceResult.outcome === 'accepted') {
                    console.log('User accepted the install prompt');
                } else {
                    console.log('User dismissed the install prompt');
                }

                // Remove the notification
                installNotification.remove();
            });
        });

        // Append the button to the content container
        contentContainer.appendChild(installButton);

        // Append the content container to the notification
        installNotification.appendChild(contentContainer);

        // Add the notification to the body of the document
        document.body.appendChild(installNotification);
    });
</script>



</head>
<body>

    
    <div id="app">
        
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <img  class="logo"
                 src="{{secure_asset('tvc.png')}}" alt="">
                <a class="navbar-brand link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover d-block text-center etiqueta">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ secure_url('/login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ secure_url('/register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
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
                            
                        
                        @endguest
                       
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
   
   
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        if ('serviceWorker' in navigator) {
          window.addEventListener('load', function() {
            navigator.serviceWorker.register('./sw.js').then(function(registration) {
              console.log('ServiceWorker registrado con éxito: ', registration.scope);
            }, function(err) {
              console.log('Error al registrar el ServiceWorker: ', err);
            });
          });
        }
      </script>
      
    
</body>
</html>
