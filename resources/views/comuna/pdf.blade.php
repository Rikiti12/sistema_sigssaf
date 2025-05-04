<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Comuna</title>
</head>

{{-- Estilo al PDF --}}
<style>

body{
    margin: 0;
    padding: 0;
    background: url(../img/centro.png);
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

tbody. tr. td{
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

.info-box {
    border: 1px solid #000;
    padding: 10px;
    margin-bottom: 15px;
}

.info-title {
    font-weight: bold;
    margin-bottom: 5px;
}

</style>
{{-- Estilo al PDF --}}

{{-- Index del PDF --}}
    <body>

        <div class="row">
            <img class="centro" src="../public/img/centro1.png" alt="" >
        </div>
        <h1>Datos de la Comuna</h1><br>

        <div class="info-box">
            <div class="info-title">Datos del Vocero de la Comuna</div>
            <p><strong>Cédula del Vocero:</strong> {{ $comunas->cedula_comunas }}</p>
            <p><strong>Nombre del Vocero:</strong> {{ $comunas->nombre_comunas }}</p>
            <p><strong>Apellido del Vocero:</strong> {{ $comunas->apellido_comunas }}</p>
            <p><strong>Teléfono:</strong> {{ $comunas->telefono }}</p>
        </div>

        <div class="info-box">
            <div class="info-title">Datos de la Comuna</div>
            <p><strong>Nombre de la Comuna:</strong> {{ $comunas->nom_comunas }}</p>
            <p><strong>Parroquia Asignada:</strong> {{ $comunas->parroquia->nom_parroquia }}</p>
            <p><strong>Dirección de la Comuna:</strong> {{ $comunas->dire_comunas }}</p>
        </div>

        <div class="row">
            <img class="footer-image"  src="../public/img/piepagina.png" alt="Pie de Página">
        </div>

    </body>
{{-- Index del PDF --}}

</html>