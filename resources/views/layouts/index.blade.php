<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Goteek-Solutions|@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>

<!--Debut menu principal-->

        <nav class="navbar navbar-expand-lg" style="background-color: #012e3e;">
            <div class="container-fluid" >
                <a class="navbar-brand fs-2" href="#" style="color: rgba(8, 211, 191, 0.743); text-shadow: 1px 1px 2px rgb(4, 131, 135), 0 0 25px rgb(123, 123, 212), 0 0 5px rgb(31, 31, 228);"> G-PressingManager </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" id="Accueil" aria-current="page" href="{{route('index')}}" style="color: rgb(208, 254, 255);">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color: rgb(208, 254, 255);">Servives</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color: rgb(208, 254, 255);">Contacts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#offres" style="color: rgb(208, 254, 255);">Offres</a>
                        </li>
                    </ul>
                    <div class="d-flex" role="search">
                        <a class="btn btn-outline-primary" type="button" href="{{route('login')}}">Se connecter</a>
                    </div>

                </div>
            </div>
        </nav>

<!--fin menu principal-->

        @yield('content')

<!--debut footer-->

        <footer>
            <div class="footer-container">
                <div class="footer-section about">
                    <h2>À propos</h2>
                    <p>
                        G-PressingManager! Est votre assistant personnel pour la gestion de pressing. Vous permettant d'optimiser votre temps de travail et votre efficacité à travers ses différentes fonctionnilités qu'elle met à votre disposition!
                    </p>
                </div>
                <div class="footer-section links">
                    <h2>Liens Utiles</h2>
                    <ul>
                        <li><a href="#Accueil">Accueil</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#offres">Offres</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#offres">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-section contact">
                    <h2>Contact</h2>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i>Abidjan, Côte d'Ivoire</li>
                        <li><i class="fas fa-phone"></i>+225 01 03 28 67 59 / +225 07 67 52 33 46</li>
                        <li><i class="fas fa-envelope"></i> gaudet.andre225@.com </li>
                    </ul>
                </div>
                <div class="footer-section social">
                    <h2>Suivez-nous</h2>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; 2024 G-PressingManager. Tous droits réservés.
            </div>
        </footer>

<!--fin footer-->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </body>
</html>
