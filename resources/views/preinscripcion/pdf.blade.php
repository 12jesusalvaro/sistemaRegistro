<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

     <!--  Datatables  -->
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>

     <!--  extension responsive  -->
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
        text-align: right;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    body{
        font-family: sans-serif;
        color: black;
    }
    @page {
    margin: 160px 50px;
    }
    header { position: fixed;
        left: -50px;
        top: -160px;
        right: -50px;
        height: 140px;
        background-color: #660404;
        text-align: right;
    }
    header h4{
        margin: 10px 0;
        color: white;
        text-align: center;
    }
    header pre{
        margin: 0 0 0px 0;
        color: white;
        text-align: right;
        margin-right: 20px;
        margin-top: -20px;
    }
    footer {
        position: fixed;
        left: 0px;
        bottom: -50px;
        right: 0px;
        height: 40px;
        border-bottom: 2px solid #ddd;
    }
    footer .page:after {
        content: counter(page);
    }
    footer table {
        width: 100%;
    }
    footer p {
        text-align: right;
    }
    footer .izq {
        text-align: left;
    }

    th {
        text-align: left;
    }

    td {
        text-align: right;
    }
</style>

</head>
<body>
    <header>
        <!--<img src="assets/Logo_EPG.png" class="align-left" width="80px" height="80px">
        <h1>EPG Universidad Nacional Del Altiplano</h1> <br>
        <h2>Ficha de inscripcion</h2>-->
        <table width="100%">
            <tr>
                <td valign="top"> <img src="{{ public_path() . $image }}" alt="" width="150" height="80" /></td>
                <td aling="center">
                    <h4>UNIVERSIDAD NACIOANL DEL ALTIPLANO</h4>
                    <h4>ESCUELA DE POSTGRADO</h4>
                    <pre>
                        UNA-PUNO
                        EPG@GMAIL.COM
                        CEL: 9864283645
                    </pre>
                </td>
            </tr>
          </table>
      </header>


      <div id="content">
        <h2 class="text-center">Ficha de Preinscripción</h2>
        <h3 style="color: rgb(114, 13, 13);">Datos del Postulante</h3>
      </div>
      <table>
        <tr class="text-center">
            <td class="text-left">
                    <h6 style="color: gray"> DNI: {{$postulante->numero_documento}} </h6>
                    <h6 style="color: gray"> Nombres: {{$postulante->nombres}} </h6>
                    <h6 style="color: gray"> Apellido Pat.: {{$postulante->primer_apellido}} </h6>
                    <h6 style="color: gray"> Apellido Mat.: {{$postulante->segundo_apellido}} </h6>
                    <h6 style="color: gray"> Email: {{$postulante->email}} </h6>
                    <h6 style="color: gray"> Tel: {{$postulante->celular}}</h6>

            </td>
        </tr>
      </table> <br>

    <h3 style="color: rgb(114, 13, 13);" >Código</h3>
    <h6 class="text-left" >Su codigo de inscripción es "{{ $codigo_pago->codigo }}", realice su pago en las agencias
        autorizadas del banco SCOTIABANK con este código.</h6>

    <h3 style="color: rgb(114, 13, 13);" >Admisión</h3>
    <h6 style="color: gray"> Programa de postulación: {{$programa->nombre}} </h6>
    <h6 style="color: gray"> Mencion/Especialidad: {{$mencion->nombre}} </h6>


    <h3 style="color: rgb(114, 13, 13);" >Firma</h3>
    <h6 class="text-left" >Firma de conformidad: ______________</h6>


    <br>
    <h6 class="text-center" style="color: rgb(83, 74, 74);">Nota: El registro al proceso de admisión se completa con el pago por concepto de
            admisión y la presentación de los requisitos en las oficinas del programa al que
            postula, acceda a nuestro directorio en:
            http://posgradounap.pe
            Para mayor Información revise el portal web de la Escuela de Posgrado de la UNA
            PUNO en http://www.posgradounap.pe.
    </h6>

    <footer>
        <table>
            <tr>
                <td>
                    <p class="izq">
                    Escuela de postGrado
                    </p>
                    </td>
                <td>
                    <p class="page">
                    Página
                    </p>
                </td>
            </tr>
        </table>
    </footer>
</body>
</html>
