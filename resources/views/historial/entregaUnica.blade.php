@extends('plantilla')

@section('estilos')
    <style>
.contenedor{
    display: flex;
    justify-content: center;
}


.2_26 { 
	overflow:hidden;
}
.e2_26 { 
	width:689px;
	height:971px;
	position:absolute;
}
.e1_4 { 
	color:rgba(11.68750025331974, 0.24348958366317675, 0.24348958366317675, 1);
	width:570px;
	height:61px;
	position:absolute;
	left:60px;
	top:61px;
	font-family:Inter;
	text-align:center;
	font-size:16px;
	letter-spacing:0;
}
.e1_5 { 
	color:rgba(0, 0, 0, 1);
	width:589px;
	height:39px;
	position:absolute;
	left:51px;
	top:103px;
	font-family:Inter;
	text-align:center;
	font-size:14px;
	letter-spacing:0;
}
.1_6 { 
	border:1px solid rgba(0, 0, 0, 1);
}
.e1_6 { 
	width:669px;
	height:382px;
	position:absolute;
	left:11px;
	top:298px;
}
.e1_7 { 
	color:rgba(0, 0, 0, 1);
	width:95px;
	height:27px;
	position:absolute;
	left:11px;
	top:156px;
	font-family:Inter;
	text-align:center;
	font-size:14px;
	letter-spacing:0;
}
.e1_8 { 
	color:rgba(0, 0, 0, 1);
	width:95px;
	height:27px;
	position:absolute;
	left:11px;
	top:183px;
	font-family:Inter;
	text-align:center;
	font-size:14px;
	letter-spacing:0;
}
.e1_9 { 
	background-color:rgba(217.0000022649765, 217.0000022649765, 217.0000022649765, 1);
	width:127px;
	height:27px;
	position:absolute;
	left:90px;
	top:156px;
}
.e1_10 { 
	background-color:rgba(217.0000022649765, 217.0000022649765, 217.0000022649765, 1);
	width:127px;
	height:27px;
	position:absolute;
	left:90px;
	top:189px;
}
.e1_11 { 
	background-color:rgba(217.0000022649765, 217.0000022649765, 217.0000022649765, 1);
	width:301px;
	height:330px;
	position:absolute;
	left:363px;
	top:324px;
}
.e1_12 { 
	color:rgba(0, 0, 0, 0.20000000298023224);
	width:314px;
	height:311px;
	position:absolute;
	left:25px;
	top:335px;
	font-family:Inter;
	text-align:left;
	font-size:14px;
	letter-spacing:0;
}
.e1_13 { 
	width:301px;
	height:330px;
	position:absolute;
	left:363px;
	top:324px;
	background-image:url(images/php9wdh5qmeosotva1bdpn0ea63rhbj8s1xuaepr_1.png);
	background-repeat:no-repeat;
	background-size:cover;
}
.e1_14 { 
	color:rgba(0, 0, 0, 1);
	width:678px;
	height:43px;
	position:absolute;
	left:11px;
	top:238px;
	font-family:Inter;
	text-align:left;
	font-size:14px;
	letter-spacing:0;
}
.1_15 { 
	border:1px solid rgba(0, 0, 0, 1);
}
.e1_15 { 
	width:671px;
	height:0px;
	position:absolute;
	left:0px;
	top:226px;
}
.1_16 { 
	border:1px solid rgba(0, 0, 0, 1);
}
.e1_16 { 
	width:668px;
	height:113px;
	position:absolute;
	left:10px;
	top:717px;
}
.e1_17 { 
	color:rgba(0, 0, 0, 1);
	width:165px;
	height:38px;
	position:absolute;
	left:10px;
	top:751px;
	font-family:Inter;
	text-align:left;
	font-size:14px;
	letter-spacing:0;
}
.e1_18 { 
	color:rgba(0, 0, 0, 1);
	width:165px;
	height:38px;
	position:absolute;
	left:11px;
	top:792px;
	font-family:Inter;
	text-align:left;
	font-size:14px;
	letter-spacing:0;
}
.e1_19 { 
	color:rgba(0, 0, 0, 1);
	width:257px;
	height:34px;
	position:absolute;
	left:181.99998474121094px;
	top:717px;
	font-family:Inter;
	text-align:center;
	font-size:14px;
	letter-spacing:0;
}
.e1_20 { 
	color:rgba(0, 0, 0, 1);
	width:250px;
	height:34px;
	position:absolute;
	left:439px;
	top:717px;
	font-family:Inter;
	text-align:center;
	font-size:14px;
	letter-spacing:0;
}
.e1_3 { 
	width:71px;
	height:61px;
	position:absolute;
	left:25px;
	top:0px;
	background-image:url(images/tvc2_1.png);
	background-repeat:no-repeat;
	background-size:cover;
}
.e1_21 { 
	width:668px;
	height:110px;
	position:absolute;
	left:10px;
	top:861px;
}
.e1_22 { 
	color:rgba(0, 0, 0, 1);
	width:668px;
	height:110px;
	position:absolute;
	left:0px;
	top:0px;
	font-family:Inter;
	text-align:left;
	font-size:15px;
	letter-spacing:0;
}


    </style>
@endsection


@section('cabecera')
<link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">

@endsection
@section('title')
    Entrega Única
@endsection

@section('content')

 
<div class="contenedor">

        <div class=e2_26>
            <span  class="e1_4">DEPARTAMENTO DE IT</span>
            <span  class="e1_5">COMPROBANTE DE ENTREGA DE EQUIPO/ACCESORIOS</span>
            <div  class="e1_6"></div>
            <span  class="e1_7">FECHA:</span>
            <span  class="e1_8">HORA:</span>
            <div  class="e1_9"></div>
            <div  class="e1_10"></div>
            <div  class="e1_11"></div>
            <span  class="e1_12">equipo1
            equipo2 
            equipo 3
            equipo4
        </span>
        <div  class="e1_13"></div>
        <span  class="e1_14">Por este medio se hace constar que se hace entrega del siguiente equipo que se detalla a 
            continuacion:</span>
            <div  class="e1_15"></div>
            <div  class="e1_16"></div>
           
            <table class="table-secondary">
                <tr>
                    
                </tr>

            </table>
            <div  class="e1_3"></div><div class=e1_21>
            <span  class="e1_22">Se hace constar que el equipo se entrega en optimas condiciones y ha sido revisado por quien lo recibe.</span></div></div>
        
</div>


 
@endsection


