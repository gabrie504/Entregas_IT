@extends('plantilla')


@section('cabecera')
    

    <style type="text/css">
		#signature-pad {
			border: 1px solid #c3c3c3;
			margin-bottom: 10px;
		}
	</style>
@endsection


@section('title')
    firma
@endsection

@section('content')

    <h1>Fecha: {{ $fecha }}</h1>
    <h2>Hora: {{ $hora }}</h2>
    <ul>
    @foreach ($equipos as $equipo)
        <li>{{ $equipo->nombre_articulo }} - {{ $equipo->descripcion_articulo }}</li>
    @endforeach
    </ul>

    <div id="signature-pad">
		<canvas id="canvas" width="500" height="200"></canvas>
	</div>
	<button id="clear-button">Borrar</button>
	<button id="save-button">Guardar</button>




@endsection


@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/4.1.5/signature_pad.umd.min.js" integrity="sha512-ngaalT22GGVs6hGMprLZ39ulFSdC/WUty7LR5AaFxpkDp5TUQ/w11WOIvZBktWOP/e9aA9m/xxpBUNDWpadROA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
var isDrawing = false;
var lastX = 0;
var lastY = 0;

function startDrawing(e) {
  isDrawing = true;
  lastX = e.clientX;
  lastY = e.clientY;
}

function draw(e) {
  if (!isDrawing) return;
  const canvas = document.querySelector('#canvas');
  const ctx = canvas.getContext('2d');
  ctx.beginPath();
  ctx.moveTo(lastX, lastY);
  ctx.lineTo(e.clientX, e.clientY);
  ctx.stroke();
  lastX = e.clientX;
  lastY = e.clientY;
}

function stopDrawing() {
  isDrawing = false;
}

const canvas = document.querySelector('#canvas');
canvas.addEventListener('mousedown', startDrawing);
canvas.addEventListener('mousemove', draw);
canvas.addEventListener('mouseup', stopDrawing);



//******************************************************************************************************************
/* window.onload = function() {
	var canvas = document.getElementById('canvas');
	var signaturePad = new SignaturePad(canvas);

	document.getElementById('clear-button').addEventListener('click', function() {
		signaturePad.clear();
	});

	document.getElementById('save-button').addEventListener('click', function() {
		if (signaturePad.isEmpty()) {
			alert('La firma está vacía.');
		} else {
			var dataURL = signaturePad.toDataURL();
			// Haz algo con los datos de la firma, como enviarlos al servidor
			console.log(dataURL);
		}
	});
}; */


</script>
  
  
@endsection