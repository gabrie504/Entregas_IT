<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('{{secure_asset("fondo_sus.jpg")}}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .glass-container {
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            padding: 15% 15%;
            backdrop-filter: blur(10px); /* Efecto de vidrio */
            width: 75%; /* Puedes ajustar el ancho del rectángulo */
        }

        /* Resto de los estilos para el contenido de la página */

       .plan-title {
        font-size: 24px;
        font-weight: bold;
        color: #fff; /* Color blanco */
    }

    .plan-description {
        font-size: 18px;
        color: #ccc; /* Color gris claro */
    }

    .plan-price {
        font-size: 20px;
        color: #f44336; /* Color rojo */
    }

    /* Estilos para el título "Contrata un plan" */
    .main-title {
        font-size: 32px;
        font-weight: bold;
        color: #fff; /* Color blanco */
        margin-bottom: 20px;
    }



    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    

    

    <title>Document</title>
</head>
<body>

    <div class="glass-container">
        <div class="container text-center">
            <h1 class="mb-3 plan-title">Contrata un plan</h1> 
            <div class="row align-items-center">
                <div class="col-md">
                    <h2 class="mb-3 plan-title">3 meses</h2>
                    <p class="plan-description">¡Suscríbete por 3 meses y obtén acceso completo a nuestro contenido premium!</p>
                    <p class="plan-price">Precio: $29.99</p>
                </div>
                <div class="col-md">
                    <h2 class="mb-3 plan-title">6 meses</h2>
                    <p class="plan-description">Obtén 6 meses de acceso ilimitado a nuestra plataforma a un precio reducido.</p>
                    <p class="plan-price">Precio: $49.99</p>
                </div>
                <div class="col-md">
                    <h2 class="mb-3 plan-title">12 meses</h2>
                    <p class="plan-description">La mejor oferta: 12 meses de acceso a un precio especial. ¡No te lo pierdas!</p>
                    <p class="plan-price">Precio: $89.99</p>
                </div>
            </div>
        </div>
        <!-- Mostrar información de los planes y formulario de suscripción -->
        <form action="{{ secure_url('/subscribe') }}" method="POST">
            @csrf
            <select name="plan" class="form-select mb-3">
                <option value="3_months">3 meses</option>
                <option value="6_months">6 meses</option>
                <option value="12_months">12 meses</option>
            </select>
            <button type="submit" class="btn btn-primary">Suscribirse</button>

          
            {{-- <button type="button" id="salir" class="btn btn-danger">Salir</button>
 --}}

        </form>

        <a class="link" href="{{ secure_url('/logout') }}"
        onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
        {{ __('Salir') }}
        </a>

        <form id="logout-form" action="{{ secure_url('/logout') }}" method="POST" class="d-none">
        @csrf
        </form>


      
    </div>
    

    

</body>
</html>
