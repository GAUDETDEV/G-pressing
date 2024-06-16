
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Pressing | @yield('title')</title>
</head>
<body  style="background-color: rgb(249, 248, 214);">

<!--debut sidebar-->

    <div class="container-fluid">
        <div class="row flex-nowrap">

            <div class="col-auto col-md-4 col-lg-3 min-vh-100 d-flex flex-column justify-content-between" style="background-color: rgb(27, 6, 72);">

                <div class="p-2" style="background-color: rgb(27, 6, 72);">

                    <a class="d-flex text-decoration-none mt-1 align-items-center text-white p-2" style="border-bottom: 3px solid #4e75e9;">
                        <span class="fs-4 d-none d-sm-inline">@yield('h2') pressing {{ Auth::user()->entreprise }}</span>
                    </a>

                    <ul class="nav nav-pills flex-column mt-4">

                        <li class="nav-item py-2 py-sm-0">
                            <a href="{{route('dashboard')}}" class="nav-link text-white">
                                <i class="fs-5 fa-solid fa-gauge"></i><span class="fs-6 ms-3 d-none d-sm-inline">Tableau de bord </span>
                            </a>
                        </li>

                        @auth
                        @if (Auth::user()->role == "gerant")
                        <li class="nav-item py-2 py-sm-0">
                            <a target="_blank" href="{{route('accueilAbonnement')}}" class="nav-link text-white">
                                <i class="fa-solid fa-address-card"></i><span class="fs-6 ms-3 d-none d-sm-inline">Abonnement</span>
                            </a>
                        </li>
                        @endif
                        @endauth

                        @auth
                        @if (Auth::user()->role == "sudo")
                        <li class="nav-item py-2 py-sm-0">
                            <a target="_blank" href="{{route('listeGerant')}}" class="nav-link text-white">
                                <i class="fa-solid fs-5 fa-users"></i><span class="fs-6 ms-3 d-none d-sm-inline">Utilisateurs</span>
                            </a>
                        </li>
                        @endif
                        @endauth


                        @auth

                        @if (Auth::user()->role == "receptionniste")
                        <li class="nav-item py-2 py-sm-0 ">
                            <a target="_blank" href="{{route('receptionistListeClient')}}" class="nav-link text-white">
                                <i class="fa-solid fs-5 fa-user"></i><span class="fs-6 ms-3 d-none d-sm-inline">Clients</span>
                            </a>
                        </li>
                        @endif

                        @if (Auth::user()->role == "gerant")
                        <li class="nav-item py-2 py-sm-0 ">
                            <a target="_blank" href="{{route('gerantListeClient')}}" class="nav-link text-white">
                                <i class="fa-solid fs-5 fa-user"></i><span class="fs-6 ms-3 d-none d-sm-inline">Clients</span>
                            </a>
                        </li>
                        @endif

                        @endauth

                        @auth
                        @if (Auth::user()->role == "gerant")
                        <li class="nav-item py-2 py-sm-0 mask">
                            <a target="_blank" href="{{route('listeEmployers')}}" class="nav-link text-white">
                                <i class="fs-5 fa fa-users"></i><span class="fs-6 ms-3 d-none d-sm-inline">Employers</span>
                            </a>
                        </li>
                        @endif
                        @endauth

                        @auth
                        @if (Auth::user()->role == "gerant")
                        <li class="nav-item py-2 py-sm-0 mask">
                            <a target="_blank" href="{{route('indexPlanning')}}" class="nav-link text-white">
                                <i class="fa-solid fs-5 fa-book"></i><span class="fs-6 ms-3 d-none d-sm-inline">Planning</span>
                            </a>
                        </li>
                        @endif
                        @endauth

                        @auth
                            @if (Auth::user()->role == "gerant" or Auth::user()->role == "receptionniste" or Auth::user()->role == "laveur" or Auth::user()->role == "repasseur" or Auth::user()->role == "livreur")

                            <li class="nav-item dropdown py-2 py-sm-0 mask">
                                <a class="nav-link dropdown-toggle text-white " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fs-5 fa-hand-spock"></i><span class="fs-6 ms-3 d-none d-sm-inline"> Tâches</span>
                                </a>
                                <ul class="dropdown-menu" style="background-color: rgb(1, 10, 32);">
                                    @if (Auth::user()->role == "gerant")
                                    <li><a class="dropdown-item" href="{{route('indexAllTache')}}" style="color:rgb(15, 12, 179);">Toutes les tâches</a></li>
                                    @endif
                                    @if (Auth::user()->role == "receptionniste" or Auth::user()->role == "laveur" or Auth::user()->role == "repasseur" or Auth::user()->role == "livreur")
                                    <li><a class="dropdown-item" href="{{route('indexMyTache')}}" style="color:rgb(15, 12, 179);">Mes tâches</a></li>
                                    @endif
                                </ul>
                            </li>

                            @endif
                        @endauth


                        @auth
                            @if (Auth::user()->role == "receptionniste" or Auth::user()->role == "gerant" or Auth::user()->role == "client")

                            <li class="nav-item dropdown py-2 py-sm-0 mask">
                                <a class="nav-link dropdown-toggle text-white " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fs-5 fa-file-invoice-dollar"></i><span class="fs-6 ms-3 d-none d-sm-inline"> Factures </span>
                                </a>
                                <ul class="dropdown-menu" style="background-color: rgb(1, 10, 32);">
                                    @if (Auth::user()->role == "gerant")
                                    <li><a class="dropdown-item" href="{{route('listeAllFacture')}}" style="color:rgb(15, 12, 179);">Toutes les factures</a></li>
                                    @endif
                                    @if (Auth::user()->role == "receptionniste" or Auth::user()->role == "client")
                                    <li><a class="dropdown-item" href="{{route('listeMyFacture')}}" style="color:rgb(15, 12, 179);">Toutes les factures</a></li>
                                    @endif
                                </ul>
                            </li>

                            @endif
                        @endauth

                        @auth
                            @if (Auth::user()->role == "receptionniste")

                            <li class="nav-item dropdown py-2 py-sm-0 mask">
                                <a class="nav-link dropdown-toggle text-white " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fs-5 fa-bell-concierge"></i><span class="fs-6 ms-3 d-none d-sm-inline"> Prestations </span>
                                </a>
                                <ul class="dropdown-menu" style="background-color: rgb(1, 10, 32);">
                                    @if (Auth::user()->role == "receptionniste")
                                    <li><a class="dropdown-item" href="{{route('accueilFacture')}}" style="color:rgb(15, 12, 179);">Laver & repasser</a></li>
                                    <li><a class="dropdown-item" href="{{route('listeSupplements')}}" style="color:rgb(15, 12, 179);">Autres</a></li>
                                    @endif
                                </ul>
                            </li>

                            @endif
                        @endauth

                        @auth
                            @if (Auth::user()->role == "receptionniste" or Auth::user()->role == "gerant" or Auth::user()->role == "client")

                            <li class="nav-item dropdown py-2 py-sm-0 mask">
                                <a class="nav-link dropdown-toggle text-white " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fs-5 fa-file-invoice"></i><span class="fs-6 ms-3 d-none d-sm-inline"> Reçu</span>
                                </a>
                                <ul class="dropdown-menu" style="background-color: rgb(1, 10, 32);">
                                    @if (Auth::user()->role == "gerant")
                                    <li><a class="dropdown-item" href="{{route('listeAllRecu')}}" style="color:rgb(15, 12, 179);">Tous les reçus</a></li>
                                    @endif
                                    @if (Auth::user()->role == "receptionniste" or Auth::user()->role == "client")
                                    <li><a class="dropdown-item" href="{{route('listeMyRecu')}}" style="color:rgb(15, 12, 179);">Mes reçus</a></li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                        @endauth


                        @auth

                            @if (Auth::user()->role == "gerant" or Auth::user()->role == "receptionniste")
                            <li class="nav-item dropdown py-2 py-sm-0 mask">
                                <a class="nav-link dropdown-toggle text-white " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fs-5 fa-download"></i><span class="fs-6 ms-3 d-none d-sm-inline"> Receptions</span>
                                </a>
                                <ul class="dropdown-menu" style="background-color: rgb(1, 10, 32);">
                                    @if (Auth::user()->role == "gerant")
                                    <li><a class="dropdown-item" href="{{route('indexAllRecept')}}" style="color:rgb(15, 12, 179);">Toutes les receptions</a></li>
                                    @endif
                                    @if (Auth::user()->role == "receptionniste")
                                    <li><a class="dropdown-item" href="{{route('indexMyRecept')}}" style="color:rgb(15, 12, 179);">Mes reception(s)</a></li>
                                    @endif
                                </ul>
                            </li>
                            @endif

                            @if (Auth::user()->role == "client" )
                            <li class="nav-item py-2 py-sm-0 mask">
                                <a target="_blank" href="{{route('indexMyRecept')}}" class="nav-link text-white">
                                    <i class="fa-solid fs-5 fa-layer-group"></i><span class="fs-6 ms-3 d-none d-sm-inline">Depots</span>
                                </a>
                            </li>
                            @endif


                            @if (Auth::user()->role == "gerant" )
                            <li class="nav-item py-2 py-sm-0 mask">
                                <a target="_blank" href="{{route('ListeLivraison')}}" class="nav-link text-white">
                                    <i class="fa-solid fs-5 fa-truck"></i><span class="fs-6 ms-3 d-none d-sm-inline">Livraisons</span>
                                </a>
                            </li>
                            @endif

                        @endauth

                        @auth

                            @if (Auth::user()->role == "gerant" or Auth::user()->role == "receptionniste" or Auth::user()->role == "client")
                            <li class="nav-item py-2 py-sm-0 mask">
                                <a target="_blank" href="{{route('listeSpet')}}" class="nav-link text-white">
                                    <i class="fa-solid fs-5 fa-microchip"></i><span class="fs-6 ms-3 d-none d-sm-inline">Suivre</span>
                                </a>
                            </li>
                            @endif

                        @endauth

                        @auth
                            @if (Auth::user()->role == "gerant")
                            <li class="nav-item py-2 py-sm-0 mask">
                                <a target="_blank" href="{{route('listeVetements')}}" class="nav-link text-white">
                                    <i class="fa-solid fs-5 fa-person-arrow-down-to-line"></i><span class="fs-6 ms-3 d-none d-sm-inline">Vêtements</span>
                                </a>
                            </li>
                            @endif
                        @endauth

                        @auth
                        @if (Auth::user()->role == "receptionniste" or Auth::user()->role == "gerant")
                        <li class="nav-item py-2 py-sm-0 ">
                            <a target="_blank" href="{{route('receptionistListePackClient')}}" class="nav-link text-white">
                                <i class="fa-solid fs-5 fa-box"></i><span class="fs-6 ms-3 d-none d-sm-inline">Offres</span>
                            </a>
                        </li>
                        @endif
                        @endauth

                        @auth
                        @if (Auth::user()->role == "gerant" or  Auth::user()->role == "client" or Auth::user()->role == "receptionniste" or Auth::user()->role == "laveur" or Auth::user()->role == "repasseur" or Auth::user()->role == "livreur")
                        <li class="nav-item py-2 py-sm-0 ">
                            <a target="_blank" href="{{route('receptionistListePackClient')}}" class="nav-link text-white">
                                <i class="fa-solid fs-5 fa-rocket"></i><span class="fs-6 ms-3 d-none d-sm-inline">Prise en main</span>
                            </a>
                        </li>
                        @endif
                        @endauth


                        <li class="nav-item py-2 py-sm-0">
                            <a target="_blank" href="{{route('logout')}}" class="nav-link text-white">
                                <i class="fa-solid fs-5 fa-right-from-bracket"></i><span class="fs-6 ms-3 d-none d-sm-inline">Déconnexion</span>
                            </a>
                        </li>

                    </ul>

                </div>

            </div>

<!--fin sidebar-->

<!-- min-vh-100 d-flex flex-column justify-content-between -->

            <div class="col-auto col-md-8 col-lg-9" >

        <!--Debut menu latéral-->

                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <small class="text-danger">{{date('l jS F Y') }}</small>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <strong class="nav-item">
                                    <small class="nav-link text-primary">{{ date('h:i') }}</small>
                                </strong>
                            </ul>

                            <a data-bs-toggle="modal" data-bs-target="#modalDeleteVet" href="" class="nav-link text-white">

                                @if (Auth::user()->photo)

                                <img src="{{ asset('storage/'.Auth::user()->photo) }}" alt="Photo de profil" style="width: 3rem; height: 3rem; text-align: center; border-radius: 10px;">

                                @else

                                <img src="{{ asset('https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg')}}" alt="" style="width: 3rem; height: 3rem; text-align: center; border-radius: 10px;">

                                @endif

                                <span class="fs-6 ms-3 d-none d-sm-inline" style="color:rgb(116, 5, 94);">@auth {{Auth::user()->name}} @endauth</span>

                            </a>

<!--debut Modal suppression vet-->
                            <div class="modal fade" id="modalDeleteVet" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog" >
                                <div class="modal-content" style='background-color:rgb(32, 22, 68);'>
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalDeleteVetLabel" style="color:rgb(255, 255, 255);">Infos utilisateur <i class="fa-solid fa-circle-info"></i> <strong style="color:rgb(15, 22, 231);">{{ Auth::user()->role }}</strong></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center" style="color:rgb(109, 211, 255);">

                                        <strong>{{ Auth::user()->email }}</strong>

                                        <p class="mt-2"><a href="{{route('indexCompteUser')}}" type="button" class="btn" style='background-color:rgb(66, 16, 250); color: white;'><i class="fa-solid fa-user"></i> Gestion de mon compte</a></p>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-bs-dismiss="modal" style='background-color:rgb(9, 130, 72); color: white;'>Annuler</button>
                                    </div>
                                </div>
                                </div>
                            </div>
<!--fin Modal suppression vet-->
                            @auth
                                @if (Auth::user()->role == "gerant" or Auth::user()->role == "sudo")


                                <div class="d-flex">
                                    <ul class="nav-item dropstart">
                                        <a style="color: rgb(23, 7, 142);" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-gear fa-2x"></i>
                                        </a>
                                        <ul class="dropdown-menu" style="background-color: rgb(22, 22, 58); color:white;">

                                            @auth
                                            @if (Auth::user()->role == "sudo")

                                            <li><a style="color:rgb(29, 143, 169);" class="dropdown-item" href="{{route('listeFormules')}}">Formules</a></li>
                                            <li><a style="color:rgb(29, 143, 169);" class="dropdown-item" href="{{route('listeEtats')}}">Etats</a></li>
                                            <li><a style="color:rgb(29, 143, 169);" class="dropdown-item" href="{{route('reinsertGerants')}}">Réinsérer</a></li>

                                            @endif
                                            @endauth

                                            @auth
                                            @if (Auth::user()->role == "gerant" or Auth::user()->role == "sudo")

                                            @if (Auth::user()->role == "gerant")
                                            <li><a style="color:rgb(29, 143, 169);" class="dropdown-item" href="{{route('reabonnerGerants')}}">Réabonner</a></li>
                                            <li><a style="color:rgb(29, 143, 169);" class="dropdown-item" href="{{route('listePostes')}}">Postes</a></li>
                                            <li><a style="color:rgb(29, 143, 169);" class="dropdown-item" href="{{route('indexDepot')}}">Dépôts</a></li>
                                            <li><a style="color:rgb(29, 143, 169);" class="dropdown-item" href="{{route('listeCaracteristiques')}}">Caractéristiques</a></li>
                                            <li><a style="color:rgb(29, 143, 169);" class="dropdown-item" href="{{route('accueilPacks')}}">Paquetages</a></li>
                                            <li><a style="color:rgb(29, 143, 169);" class="dropdown-item" href="{{route('listeServices')}}">Services supplementaires</a></li>
                                            @endif

                                            <li><a style="color:rgb(29, 143, 169);" class="dropdown-item" href="{{route('listeCategories')}}">Catégories</a></li>

                                            @endif
                                            @endauth

                                        </ul>
                                    </ul>
                                </div>

                                @endif
                            @endauth

                        </div>
                    </div>
                </nav>

        <!--Fin menu latéral-->

                @yield('content')

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

<!--debut footer-->
<footer class="container-fluid mt-5" style="background-color:rgb(11, 8, 25); height: 100%;">

    <div class="container">

        <div class="text-center" style="color: white;">

            <p> &copy; <small style="color:rgb(29, 143, 169);">Goteek Solution 2024 </small></p>

        </div>

        <div class="row">

            <div class="col">

            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>

        </div>

    </div>

</footer>
<!--fin footer-->

</html>

