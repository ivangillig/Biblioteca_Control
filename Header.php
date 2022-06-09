<!doctype html>
<html lang="en">

<head>
    <title>Biblioteca Pública</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" sizes="any" href="/images/icons/favicon.ico" type="image/x-icon"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
            <img src="/images/icons/favicon.ico" width="30" height="30" class="mr-1 mb-1" alt="">    
            Biblioteca</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Libros</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="/templates/Libros/AltaLibro.php">Alta de libro</a>
                            <a class="dropdown-item" href="/templates/Libros/ListaLibros.php">Listado de libros</a>
                            <a class="dropdown-item" href="/templates/Libros/LibrosPorEstado.php">Listado por estado</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Prestamos</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="/templates/Prestamos/AltaPrestamo.php">Cargar Prestamo</a>
                            <a class="dropdown-item" href="/templates/Prestamos/ListaPrestamos.php">Prestamos vigentes</a>
                            <a class="dropdown-item" href="/templates/Prestamos/ListaPorSocio.php">Prestamos por socio</a>
                            <a class="dropdown-item" href="/templates/Prestamos/ListaPorFecha.php">Prestamos por fechas</a>
                            <a class="dropdown-item" href="/templates/Prestamos/ListaPorMenores.php">Prestamos a menores</a>
                            <a class="dropdown-item" href="/templates/Prestamos/ListaPrimerSemestre.php">Prestamos primer semestre</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reparación</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="/templates/Reparaciones/AltaReparacion.php">Cargar reparación</a>
                            <a class="dropdown-item" href="/templates/Reparaciones/ListaReparacion.php">Reparaciones en curso</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Socios</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="/templates/Socios/AltaSocio.php">Alta de socio</a>
                            <a class="dropdown-item" href="/templates/Socios/ListaSocio.php">Listado de socios</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0 nav-item">
                    <a class="nav-link text-info" href="/logout.php">Cerrar Sesión</a>
                </form>
            </div>
    </nav>