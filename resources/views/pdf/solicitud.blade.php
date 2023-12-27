<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud</title>
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
<br>
    <div class="container" style="justify-content: center;">
    <div style="padding: 10px; text-align: justify; font-size: 15px; line-height: 1.5;">
            <div style="text-align: justify; ustify;padding-left: 50%">
                <p><b>SOLICITA:</b> Inscripción como postulante al Programa de Maestría en:</p>

            </div>
            <p><b>SEÑOR RECTOR DE LA UNIVERSIDAD NACIONAL DEL ALTIPLANO DE PUNO</b></p>
        <p style="text-align: justify;padding-left: 30% ">
            Yo, <b>{{$postulante->nombres}} {{$postulante->primer_apellido}} {{$postulante->segundo_apellido}} </b>
            Bachiller en Bachiller en <b>Bachiller</b>
            Identificado(a) con DNI. Nº <b>{{$postulante->numero_documento}}</b>
            y con domicilio(a) en <b>Domicilio</b> Nº <b>Numero D</b>
            de la ciudad de <b>Ciudad </b>, y correo electrónico: <b>{{$postulante->email}}</b>
            Numero de celular: <b>{{$postulante->celular}}</b> Ante usted con el debido respeto me presento y expongo:

        </p>
        <p style="text-align: justify;">Que, teniendo conocimiento de la Convocatoria de Admisión presencial 2023 del Programas de Maestrías de la Escuela de Posgrado de la Universidad Nacional del Altiplano de Puno, y los requisitos establecidos en el Reglamento de Proceso de Admisión Presencial 2023 para realizar estudios de maestría, solicito a usted se me considere como postulante al Programa de Maestría en:</p>
        <p style="text-align: justify;padding-left: 50% "><b>POR LO EXPUESTO:</b><br>Señor Rector; ruego a usted acceder a mi petición por </p>
        <p style="padding-left: 70%">
        <?php
                setlocale(LC_ALL, 'es_ES');
                echo strftime('%e de %B de %Y');
                ?>
        </p>
    </div>
    <div class="table-container" style="margin:50px; padding-left: 150px; display: flex; align-items: center; height: 100vh; margin-left: auto;">

        <table style="padding-left: 60%">
            <tr>
                <td>FIRMA:</td>
                <td>______________</td>
            </tr>
            <tr>
                <td>D.N.I.:</td>
                <td>{{$postulante->numero_documento}}</td>
            </tr>
        </table>
    </div>
    <p style="position: fixed; bottom: 0;font-style: italic;font-size: 12px;;">(<b>NOTA:</b> llenado el formato deberá de consignar su firma manuscrita o digital, si su firma es manuscrita deberá escanear el documento firmado. El documento deberá ser remitido en formato pdf.)</p>

</div>

</body>
</html>
