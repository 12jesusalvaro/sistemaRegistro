<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Reporte de Usuarios</title>
</head>

<body>

    <h2 class="text-center">Listado de Usuarios</h2>

    <img src="{{ public_path() . $image }}" alt="" width="100" height="100" />

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Apellido Pat</th>
                <th>Email</th>
                <th>Dni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($postulantes as $postulante)
            <tr>
                <td>{{ $postulante->nombres }}</td>
                <td>{{ $postulante->apellido_paterno}}</td>
                <td>{{ $postulante->correo_electronico }}</td>
                <td>{{ $postulante->numero_documento }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
