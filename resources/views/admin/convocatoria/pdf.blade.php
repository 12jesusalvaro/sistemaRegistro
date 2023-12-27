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

<style>
.cabecera{
    background-color: gray;
    color: white;
}

h1{
    color:blue;
}
</style>

</head>
<body>
    <img src="assets/Logo_EPG.png" alt="" width="80px" height="80px">
    <h1 class="text-center">Convocatorias</h1> <br>
    <table class="table" style="text-aling: center;font-size: 10px">
        <thead class="cabecera">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Año</th>
                <th>Numero</th>
                <th>Fecha Incio</th>
                <th>Fecha Fin</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($convocatorias as $convocatoria)
                <tr>
                    <td>{{$convocatoria->id}}</td>
                    <td>{{$convocatoria->nombre}}</td>
                    <td>{{$convocatoria->anio}}</td>
                    <td>{{$convocatoria->numero}}</td>
                    <td>{{$convocatoria->fecha_inicio}}</td>
                    <td>{{$convocatoria->fecha_final}}</td>
                </tr>
            @empty

            @endforelse
        </tbody>
    </table>

</body>
</html>
