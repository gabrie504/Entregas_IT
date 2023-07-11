@extends('plantilla')


@section('title')
    Calendario
@endsection

@section('cabecera')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.min.js">
@endsection


@section('content')
<ul style="margin-top: 5px;">
    <li style="font-weight: bold; color: #FFC0CB;">Entregas</li>
    <li style="font-weight: bold; color: #90EE90;">Prestamos</li>
    <li  style="font-weight: bold; color: #ADD8E6;">Salidas</li>
  </ul>


        <div id="calendar"></div>
@endsection


@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
  
      var calendar = new FullCalendar.Calendar(calendarEl, {
        // Configura las opciones del calendario aquí
      
      });
  
      calendar.render();
    });
  </script>
@endsection