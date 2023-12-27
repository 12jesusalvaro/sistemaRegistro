<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carta de Compromiso</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

     <!--  Datatables  -->
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>

     <!--  extension responsive  -->
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">


</head>

<body class="antialiased">
<header style="text-align: center;">
    <table style="opacity: 0.8; width: 100%; max-width: 800px;">
            <tr>
                <td valign="top" style="padding: 10px;"><img src="{{ public_path() . $image2 }}" alt="" width="60" height="60" /></td>
                <td style="background-color: rgb(128, 144, 176); text-align: center; padding: 10px; border: 1px solid white; color: white; font-size: 12px; font-weight: bold;">UNIVERSIDAD NACIONAL DEL ALTIPLANO - PUNO</td>
                <td style="background-color: rgb(197, 128, 128); text-align: center; padding: 10px; border: 1px solid white; color: white; font-size: 12px; font-weight: bold;">ESCUELA DE POSGRADO</td>
                <td style="background-color: rgb(255, 237, 179); text-align: center; padding: 10px; border: 1px solid white; color: black; font-size: 12px; font-weight: bold;">PROCESO DE ADMISIÓN PRESENCIAL 2023</td>
                <td valign="top" style="padding: 10px;"><img src="{{ public_path() . $image1 }}" alt="" width="60" height="80" /></td>
            </tr>
        </table>

</header>
<br><br><br>
<div class="container" style="border: 3px solid #ccc;">
    <div style="padding: 15px; text-align: justify; font-size: 15px; line-height: 1.5;">
        <h3 style="text-align: center;">CARTA DE COMPROMISO</h3>
        <p style="text-align: center;">
            <?php echo date('j \d\e F \d\e Y'); ?>
        </p>
        <p>Señor:</p>
        <p><b>SEÑOR DIRECTOR GENERAL DE LA ESCUELA DE POSGRADO UNA - PUNO</b></p>
        <p>Ciudad.</p>
        <p>De mi mayor consideración:</p>
        <p style="text-align: justify;">
        Mediante la presente me comprometo expresamente aceptar y someterme a las disposiciones de la Escuela de Posgrado como postulante y estudiante del Programa de Doctorado/Maestría en <b>{{ $mencion->nombre }}</b>.
        Al poner en su conocimiento este hecho le expreso las consideraciones de mi deferencia personal.

        </p>

    </div>
    <div class="table-container" style="margin:20px; padding-left: 150px; display: flex; align-items: center; height: 100vh; margin-left: auto;">

        <table>
            <tr>
                <td>FIRMA:</td>
                <td>______________</td>
            </tr>
            <tr>
                <td>NOMBRE:</td>
                <td>{{$postulante->nombres}} {{$postulante->primer_apellido}} {{$postulante->segundo_apellido}} </td>
            </tr>
            <tr>
                <td>D.N.I.:</td>
                <td>{{$postulante->numero_documento}}</td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>
