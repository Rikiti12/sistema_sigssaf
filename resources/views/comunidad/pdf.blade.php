<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Comunidad</title>
</head>

{{-- Estilo al PDF --}}
<style>

body{
    margin: 0;
	padding: 0;
    background: url(../img/portada2.png);
	background-size: cover;
	font-family: sans-serif;
    font-size: 0.8rem;
    
}

.header{
    background-color: rgb(15, 15, 15);
    color: rgb(231, 227, 225);
}

h1{
    color: rgb(0, 0, 0);
    text-align: center;
    font-family: sans-serif;
}

.table{
    font-size: 18px;
    text-align: center;

}

tbody tr td{
    border: 2px solid black;
}

img {

    margin-left: 17.5%;
    width: 600px;
    height: 22px;
  
}

.centro{
    margin-left: 10.5%;
    width: 80%;
    height: 10%; 
  border-radius: 8% 
} 

.footer-image { 
    width: 76%; 
    height: auto; 
    position: absolute;
    bottom: 33px; 
    left: 19%; 
    transform: translateX(-29%);

}

</style>
{{-- Estilo al PDF --}}

{{-- Index del PDF --}}
    <body>

        <div class="row">
            <img class="centro" src="../public/img/portada2.png" alt="">
        </div>

        <h1>Datos de la Comunidad</h1><br>
            <table class="table" cellpadding="1" cellspacing="1" width="100%" style="padding-bottom:0.4rem;front-size:0.6rem !important">
                <thead class="header">
                    <tr>
                        <th>Vocero de la Comunidad</th>
                        <th>Comunidad</th>
                        <th>Comuna Asignado</th>
                        <th>Dirección</th>
                        <th>Proyecto de la Comunidad</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($comunidades as $comunidad)
                    <tr>
                        <td>{{ $comunidad->cedula_jefe }} - {{ $comunidad->nom_jefe }} 
                        {{ $comunidad->ape_jefe }} {{ $comunidad->telefono }} 
                        </td>
                        <td>{{ $comunidad->nom_comuni }}</td>
                        <td>{{ $comunidad->comuna->nom_comunas }}</td>
                        <td>{{ $comunidad->dire_comuni }}</td>
                        <td>
                            @if(strtolower($comunidad->crear_pro) ==='si')
                                {{ $comunidad->nom_proyecto ?? 'No Especificado' }}
                                {{ $comunidad->descripcion ?? 'No Especificado' }}
                            @else
                                No Posee
                            @endif
                        </td>
                    </tr>
                @endforeach  
                </tbody>
            </table>

            <div class="row">
                <img class="footer-image" src="../public/img/portada2.png" alt="Pie de Pagina">
            </div>

    </body>
{{-- Index del PDF --}}

</html>