<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Techfinder</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="#">TECHFINDER</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/web/competences">Compétences</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/web/utilisateurs">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Intervention</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">UserCompetences</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <a href="#" class="btn btn-outline-dark px-4 rounded-pill">Connexion</a>
                    </div>
                </div>
            </div>
        </nav>



        @yield('main')

        <footer class="bg-light py-4">
            <div class="container">
                <p class="text-center text-muted">&copy; 2026 Techfinder. Tous droits réservés.</p>
            </div>
        </footer>

        @include('partials.toast')

    </body>
</html>
