<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ficha-de-Inscripcion</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

     <!--  Datatables  -->
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>

     <!--  extension responsive  -->
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

</head>
<style>
  .cuadrado {
    position: absolute;
    top:150px;
    right: 0;
    width: 100px;
    height: 100px;
    border: 1px solid #000;

  }
  .sub {
    font-size: 13px;
    font-weight: bold;
    text-decoration: underline;
  }
  td{

    text-align: center;
  }
</style>

<body class="antialiased">
<header style="text-align: center;">
    <table style="opacity: 0.8; width: 100%; max-width: 800px;">
            <tr>
                <td valign="top" style="padding: 10px;"><img src="{{ public_path() . $image2 }}" alt="" width="50" height="50" /></td>
                <td style="background-color: rgb(128, 144, 176); text-align: center; padding: 10px; border: 1px solid white; color: white; font-size: 12px; font-weight: bold;">UNIVERSIDAD NACIONAL DEL ALTIPLANO - PUNO</td>
                <td style="background-color: rgb(197, 128, 128); text-align: center; padding: 10px; border: 1px solid white; color: white; font-size: 12px; font-weight: bold;">ESCUELA DE POSGRADO</td>
                <td style="background-color: rgb(255, 237, 179); text-align: center; padding: 10px; border: 1px solid white; color: black; font-size: 12px; font-weight: bold;">PROCESO DE ADMISIÓN PRESENCIAL 2023</td>
                <td valign="top" style="padding: 10px;"><img src="{{ public_path() . $image1 }}" alt="" width="50" height="70" /></td>
            </tr>
        </table>
</header>
<br><br><br>

</footer>

<h4 style="text-align: center;">FICHA DE INSCRIPCION</h4><br>
<div class="cuadrado"></div>


<p>I. <span class="sub">DATOS GENERALES:</span></p>
<!-- Contenido de la sección -->

<table style="width: 100%;font-family: 'Times New Roman', Times, serif;">
  <tr style="display: none;visibility: hidden;">
    <td style=" border: 1px solid black; padding: 5px;" colspan="1"></td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1"></td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1"></td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1"></td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1"></td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1"></td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1"></td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1"></td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1"></td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1"></td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1"></td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1"></td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1"></td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1"></td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1"></td>
  </tr>
  <tr >
    <td style="border: 1px solid black; padding: 5px;"colspan="5">{{$usuario->primer_apellido}}</td>
    <td style="border: 1px solid black; padding: 5px;"colspan="5">{{$usuario->segundo_apellido}}</td>
    <td style="border: 1px solid black; padding: 5px;"colspan="5">{{$usuario->nombres}} </td>
  </tr>
  <tr  style="font-weight: bold; font-size: 14px;">
    <td style="border: 1px solid black; padding: 5px;"colspan="5">APELLIDO PATERNO</td>
    <td style="border: 1px solid black; padding: 5px;"colspan="5">APELLIDO MATERNO</td>
    <td style="border: 1px solid black; padding: 5px;"colspan="5">NOMBRES</td>
  </tr>
  <tr >
    <td style="border: 1px solid black; padding: 5px;" colspan="2">{{$usuario->numero_documento}}</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1">{{$anio}}</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1">{{$mes}}</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1">{{$dia}}</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="2">{{$LugarNac["departamento_nac"] }}</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="3">{{$LugarNac["provincia_nac"] }}</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="2">{{$LugarNac["distrito_nac"] }}</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="3">{{$nacionalidad->nombre}}</td>
  </tr>
  <tr style="font-weight: bold; font-size: 14px;">
    <td style="border: 1px solid black; padding: 5px;" colspan="2">DNI</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="3">FECHA DE NACIMIENTO</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="7">DEPTO./PROV./DISTR.</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="3">NACIONALIDAD</td>
  </tr>
  <tr>
    <td style="border: 1px solid black; padding: 5px;" colspan="10">{{$estadoCivil->nombre}}</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="5">{{$datogeneral->edad}}</td>

  </tr>
  <tr style="font-weight: bold; font-size: 14px;">
    <td style="border: 1px solid black; padding: 5px;" colspan="10">ESTADO CIVIL</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="5">EDAD</td>

  </tr>
  <tr>
    <td style="border: 1px solid black; padding: 5px;" colspan="2"></td>
    <td style="border: 1px solid black; padding: 5px;" colspan="8">{{$datogeneral->direccion_domiciliaria}}</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="3">{{$usuario->celular}}</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="2"></td>
  </tr>
  <tr style="font-weight: bold; font-size: 14px;">
    <td style="border: 1px solid black; padding: 5px;" colspan="2">PASAPORTE</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="8">DIRECCION DOMICILARIA</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="3">CELULAR</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="2">TELEFENO FIJO</td>
  </tr>
  <tr style=" font-size: 14px;">
    <td style="border: 1px solid black; padding: 5px; font-weight: bold;" colspan="2">CORREO</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="13">{{$usuario->email}}</td>

  </tr>
</table>

<p>II.<span class="sub"> INFORMACION ACADEMICA:</span></p>
<!-- Contenido de la sección -->
<table style="width: 100%;font-family: 'Times New Roman', Times, serif;">
  <tr style="font-weight: bold; font-size: 14px;">
    <td style=" border: 1px solid black; padding: 5px;" colspan="6">ESTUDIOS DE PREGRADO (BACHILLER):</td>  </tr>
  <tr >
    <td style=" border: 1px solid black; padding: 5px;" colspan="4">{{$infAcademica->nombre_universidad}}</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1">{{$infAcademica->anio_ingreso}}</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1">{{$infAcademica->anio_egreso}}</td>
  </tr>
  <tr style="font-weight: bold; font-size: 14px;">
    <td style=" border: 1px solid black; padding: 5px;" colspan="4">UNIVERSIDAD</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1">AÑO DE INGRESO</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="1">AÑO DE EGRESO</td>
  </tr>
  <tr style=" font-size: 14px;">
    <td style="border: 1px solid black; padding: 5px; font-weight: bold;"  colspan="3">TIPO DE UNNIVERSIDAD</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="3">{{$universidad->nombre}}</td>
  </tr>
  @foreach ($datoInfoAca as $info)
    <tr >
      <td style=" border: 1px solid black; padding: 5px;" colspan="2">{{ $info['distrito'] }}</td>
      <td style="border: 1px solid black; padding: 5px;" colspan="2">{{ $info['provincia'] }}</td>
      <td style="border: 1px solid black; padding: 5px;" colspan="2">{{ $info['departamento'] }}</td>
    </tr>
  @endforeach
  <tr style="font-weight: bold; font-size: 14px;">
    <td style=" border: 1px solid black; padding: 5px;" colspan="2">DEPARTAMENTO</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="2">PROVINCIA</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="2">DISTRITO</td>
  </tr>
  <tr style=" font-size: 14px;">
    <td style="border: 1px solid black; padding: 5px; font-weight: bold;"  colspan="3">GRADO OBTENIDO:</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="3">{{$infAcademica->grado_obtenido}}</td>
  </tr>
  <tr style=" font-size: 14px;">
    <td style="border: 1px solid black; padding: 5px; font-weight: bold;"  colspan="3">ESTUDIOS CONCLUIDOS:</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="3">{{$infAcademica->est_concluidos}}</td>
  </tr>
</table>

<p>III.<span class="sub"> EXPERIENCIA PROFESIONAL:</span></p>
<!-- Contenido de la sección -->
<table style="width: 100%;font-family: 'Times New Roman', Times, serif;">
  <tr style=" font-size: 14px;">
    <td style="border: 1px solid black; padding: 5px; font-weight: bold;"  colspan="3">INSTITUCIÓN DE PROCEDENCIA:</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="4">{{$expProfesional->inst_procedencia}}</td>
  </tr>
  <tr style=" font-size: 14px;">
    <td style="border: 1px solid black; padding: 5px; font-weight: bold;"  colspan="3">CARGO ACTUAL:</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="4">{{$expProfesional->carg_actual}}</td>
  </tr>
  <tr style=" font-size: 14px;">
    <td style="border: 1px solid black; padding: 5px; font-weight: bold;"  colspan="3">AÑO Y FECHA DE INICIO:</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="4">{{$expProfesional->fecha_inicio}}</td>
  </tr>
  <tr style=" font-size: 14px;">
    <td style="border: 1px solid black; padding: 5px; font-weight: bold;"  colspan="3">OTROS:</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="4">{{$expProfesional->otros}}</td>
  </tr>

</table>


<p>IV.<span class="sub"> PRODUCCION CIENTIFICA:</span></p>
<!-- Contenido de la sección -->
<table style="width: 100%;font-family: 'Times New Roman', Times, serif;">
  <tr style="font-weight: bold; font-size: 14px;">
    <td style=" border: 1px solid black; padding: 5px;" colspan="10">PUBLICACIONES REALIZADAS (**):</td>  </tr>

  @foreach($datosProds as $datosProd)
  <tr style=" font-size: 14px;">
    <td style="border: 1px solid black; padding: 5px; font-weight: bold;"  colspan="4">Titulo de Trabajo:</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="6">{{ $datosProd->titulo }}</td>
  </tr>
  <tr style=" font-size: 14px;">
    <td style="border: 1px solid black; padding: 5px; font-weight: bold;"  colspan="4">Nombre de la revista o Publicación</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="6">{{ $datosProd->nombre }}</td>
  </tr>

  <tr >
    <td style="border: 1px solid black; padding: 5px;" colspan="2">{{ $datosProd->anio }}</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="2">{{ $datosProd->numero }}</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="2">{{ $datosProd->volumen }}</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="2">{{ $datosProd->paginas }}</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="2">{{ $datosProd->hasta_pag }}</td>
  </tr>
  <tr style="font-weight: bold; font-size: 14px;">
    <td style=" border: 1px solid black; padding: 5px;" colspan="2">Año</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="2">Numero</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="2">Volumen</td>
    <td style="border: 1px solid black; padding: 5px;" colspan="2">Paginas: de </td>
    <td style="border: 1px solid black; padding: 5px;" colspan="2">a</td>
  </tr>
  @endforeach
</table>


<p>V.<span class="sub"> IDIOMAS EXTRANJEROS Y NATIVOS:</span></p>
<!-- Contenido de la sección -->
  <table style="width: 100%;font-family: 'Times New Roman', Times, serif;">
    <tr style="font-weight: bold; font-size: 14px;">
      <td style=" border: 1px solid black; padding: 5px;" colspan="3">IDIOMAS</td>
      <td style=" background-color: yellow; border: 1px solid black; padding: 5px;" colspan="3">HABLA</td>
      <td style=" background-color: yellow;  border: 1px solid black; padding: 5px;" colspan="3">LEE</td>
      <td style=" background-color: yellow; border: 1px solid black; padding: 5px;" colspan="3">ESCRIBE</td>
    </tr>
    @foreach ($idioms as $idiom)
        <tr>
          <td style=" border: 1px solid black; padding: 5px;" colspan="3">{{ $idiom['list_idioma_id'] }}</td>
          <td style=" border: 1px solid black; padding: 5px;" colspan="3">{{ $idiom['habla_id'] }}</td>
          <td style=" border: 1px solid black; padding: 5px;" colspan="3">{{ $idiom['lee_id'] }}</td>
          <td style=" border: 1px solid black; padding: 5px;" colspan="3">{{ $idiom['escribe_id'] }}</td>
        </tr>
    @endforeach

  </table>
</body>
</html>
