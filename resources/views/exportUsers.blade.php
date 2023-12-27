<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>CODIGO_SEDE_FILIAL</th>
            <th>TIPO_PROCESO</th>
            <th>PROCESO_ADMISION</th>
            <th>NUMERO_CONVOCATORIA</th>
            <th>TIPO_DOCUMENTO</th>
            <th>NRO_DOCUMENTO</th>
            <th>NOMBRES</th>
            <th>PRIMER_APELLIDO</th>
            <th>SEGUNDO_APELLIDO</th>
            <th>APELLIDO_CASADA</th>
            <th>SOLO_UN_APELLIDO</th>
            <th>SEXO</th>
            <th>FECHA_NACIMIENTO</th>
            <th>PAIS_NACIMIENTO</th>
            <th>NACIONALIDAD</th>
            <th>UBIGEO_NACIMIENTO</th>
            <th>UBIGEO_DOMICILIO</th>
            <th>CONDICION_DISCAPACIDAD</th>
            <th>TIPO_DISCAPACIDAD</th>
            <th>CELULAR</th>
            <th>CORREO_PERSONAL</th>
            <!-- <th>CODIGO_FACULTAD_UNIDAD</th>
            <th>CODIGO_PROGRAMA_OPCIONES</th>
            <th>FECHA_POSTULACION</th>
            <th>PUNTAJE_OBTENIDO</th>
            <th>MODALIDAD_ADMISION</th>
            <th>MODALIDAD_ESTUDIO</th>
            <th>ES_INGRESANTE</th>
            <th>CODIGO_FACULTAD_UNIDAD_INGRESO</th>
            <th>CODIGO_PROGRAMA_INGRESO</th>
            <th>FECHA_INGRESO</th>FECHA_INGRESO
            <th>CORREO_INSTITUCIONAL</th> 	-->
            <th>CODIGO_ORCID</th>
            <th>DIGIT DNI</th>
            <!-- <th>PROGRAMA</th>
            <th>FACULTAD</th>
            <th>OBSERVACIONES</th>  -->


        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user['id']}}</td>
                <td>{{$user['sede']}}</td>
                <td>{{$user['tipo_proceso']}}</td>
                <td>{{$user['proceso_admision']}}</td>
                <td>{{$user['numero_convocatoria']}}</td>
                <td>{{$user['tipo_documento_id']}}</td>
                <td>{{$user['numero_documento']}}</td>
                <td>{{$user['nombres']}}</td>
                <td>{{$user['primer_apellido']}}</td>
                <td>{{$user['segundo_apellido']}}</td>
                <td>{{$user['apellido_casada']}}</td>
                <td>{{$user['solo_un_apellido']}}</td>
                <td>{{$user['sexo']}}</td>
                <td>{{$user['fecha_nacimiento']}}</td>
                <td>{{$user['pais_nac']}}</td>
                <td>{{$user['nacionalidad']}}</td>
                <td>{{$user['ubigeo_nac']}}</td>
                <td>{{$user['ubigeo_dom']}}</td>
                <td>{{$user['discapacidad']}}</td>
                <td>{{$user['tipo_discapacidad']}}</td>
                <td>{{$user['celular']}}</td>
                <td>{{$user['email']}}</td>
                <td>{{$user['codigo_orcid']}}</td>
                <td>{{$user['digito_dni']}}</td>
            </tr>
        @endforeach
    </tbody>

</table>
