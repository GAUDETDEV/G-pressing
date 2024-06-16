@extends('layouts/index')
@section('title', "index")
@section('content')

        <style>

/*style du message de la description de l'application*/

            @keyframes pulse {
                0% {
                    transform: scale(1);
                }
                50% {
                    transform: scale(1.1);
                }
                100% {
                    transform: scale(1);
                }
            }

            .divLetterFadeTextContainer{
                margin: 0 auto;
                width: 50%;
            }

            .divLetterFadeText{
                margin: 0 auto;
                width: 100%;
                height: 100px;
                display: inline-block;
            }

            .pulse{
                font-size: 20px;
                text-align: center;
                color: white;
                background-color: rgb(0, 115, 182);
                animation: pulse 1s ease-in-out 1s infinite alternate both running;
                border-radius: 10px;
                padding: 5px;
            }

/*style du message de bienvenu*/
            @keyframes typing {
                from {
                    width: 0;
                }
                to {
                    width: 100%;
                }
            }

            @keyframes slideUp {
                from {
                    transform: translateY(100%);
                }
                to {
                    transform: translateY(0);
                }
            }

            .text-letters {
                overflow: hidden;
                white-space: nowrap;
                border-right: 3px solid;
                width: 0;
                animation: typing 2s steps(30, end) forwards;
            }

            .slideUp {

                animation: slideUp 0.5s ease-out;
            }

            .letter{

                width: 30%;
                margin: 0 auto;
                background-color: #ffffff;

            }

            .text-letters{
                margin-top: 20%;
                display: flex;
                justify-content: center;
                color: rgb(2, 58, 212);
                text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
            }


        </style>



        <div  class="letter">
            <h1 class="text-letters">Bienvenu!</h1>
        </div>


        <div class="divLetterFadeTextContainer">

            <div class="divLetterFadeText">

                <p class="pulse">
                    <span>
                        A bord de G-PressingManager!
                        Votre assistant personnel pour la gestion de pressing.
                        <strong style="font-size: 25px;">Prêt à optimiser votre temps et votre efficacité ?</strong>
                        Découvrez tout ce que nous avons à vous offrir dès maintenant,
                        en souscrivant à l'une de nos offres!
                    </span>
                </p>

            </div>

        </div>


        <div class="container mt-5">
            <h2 id="offres">Nos offres</h2>
        </div>


        <div class="container mt-5">

<!-- debut liste des formules -->

            <div class="row row-cols-1 row-cols-md-3 g-4">

                @forelse ($infos_formules as $infos_formule)

                <div class="col">

                    <div class="slideUp">

                        <div class="card h-100 shadow">
                            <div class="card-body">
                                <h4 class="card-titles" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125);">{{$infos_formule->nom_formule}}</h4>
                                <div class="card-text">
                                    <p style="background-color:rgb(6, 76, 125); color:white; font-weight: bold; border-radius: 5px; padding:7px; "><strong>A seulement :</strong> <span style="font-size: 2em; color:rgb(166, 212, 245); font-weight: bold;">{{$infos_formule->prix_formule}} Francs </span></p>
                                    <p><strong>Avec un nombre d'utilisateurs :</strong> {{$infos_formule->nbr_user}}</p>
                                    <p><strong>Et un nombre d'essai :</strong> {{$infos_formule->nbr_essai}}</p>
                                    <p><strong>Pour une période de :</strong> {{$infos_formule->periode}} jours d'utilisation.</p>
                                    <p><strong>Proposant les fonctionnalités suivantes :</strong></p>
                                </div>
                                <p class="card-text" style="color:white; background-color:rgb(6, 76, 125); border-radius: 5px; padding:7px; width: 100%; height: 200px;;">{!! nl2br(e($infos_formule->fonctionnalite)) !!}</p>
                            </div>
                            <div class="card-footer mt-5 text-center">

                                @if ($infos_formule->nom_formule == "Free")
                                    <a href="{{route('suscribeFormule',['formule' => $infos_formule->id,])}}" type="button" class="btn mt-5" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(2, 107, 142); font-size: 20px;"> J'essaie <i class="fa-brands fa-golang"></i></a>
                                @else
                                    <a href="{{route('suscribeFormule',['formule' => $infos_formule->id,])}}" type="button" class="btn mt-5" style="color:rgb(255, 255, 255); padding: 5px; background-color:rgb(2, 107, 142); font-size: 20px;"> Souscrire <i class="fa-solid fa-person-running"></i></a>
                                @endif

                            </div>
                        </div>

                    </div>


                </div>

                @empty

                @endforelse

            </div>

<!-- fin liste des formules -->

        </div>


@endsection
