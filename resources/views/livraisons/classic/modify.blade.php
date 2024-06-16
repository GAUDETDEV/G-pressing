@extends('layouts/auth')
@section('title',"edit livraison")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut boutons d'ajout d'options de livraison-->

<div class="container mt-4">
    <div class="container rounded-2 shadow" style="width:100%; padding: 1em; background-color: rgb(7, 40, 130);">
        <h1 class="modal-title fs-5" style="color:rgb(248, 248, 248); font-weight: bold; "><i class="fa-solid fa-gear"></i> OPTIONS DE LIVRAISON</h1>
        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalAddCommune" class="btn" href="" style='color: rgb(255, 255, 255); background-color: rgb(5, 97, 150); margin: 5px;'><i class="fa-solid fa-plus"></i> Commune</a>
        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalAddQuartier" class="btn" href="" style='color: rgb(255, 255, 255); background-color: rgb(5, 97, 150); margin: 5px;'><i class="fa-solid fa-plus"></i> Quartier</a>
        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalAddAdresse" class="btn" href="" style='color: rgb(255, 255, 255); background-color: rgb(5, 97, 150); margin: 5px;'><i class="fa-solid fa-plus"></i> Adresse</a>
        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalAddPrix" class="btn" href="" style='color: rgb(255, 255, 255); background-color: rgb(5, 97, 150); margin: 5px;'><i class="fa-solid fa-plus"></i> Prix</a>
    </div>
</div>

<!--fin boutons d'ajout d'options de livraison-->

<div class="container mt-3">

<!--debut formulaire d'ajout livraison-->

    <form action="{{route('putLivraisonClassic',['livraison' => $infos_livraison->id])}}" method="POST" class="container shadow rounded-3" style="width:100%; margin-top:5%; padding: 5em; background-color: rgb(255, 255, 255);">
        <h2 class="modal-title fs-5" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">MISE A JOUR DES DETAILS DE LIVRAISON DE LA FACTURE N° {{$facture->id}}</h2>
        @method('put')
        @csrf

        <div class="row">

            <div class="col">

                <label for="" class="form-label mt-3" style="color: rgb(13, 5, 181); font-weight: bold;">Destinataire</label>
                <input type="text" class="form-control mt-3" name="nom_destinataire" value="{{$facture->nom_titulaire}}">
                @if ($errors)
                @error('nom_destinataire')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color: rgb(13, 5, 181); font-weight: bold;">Contact du destinataire</label>
                <input type="tel" class="form-control mt-3" name="tel_destinataire" value="{{$facture->tel_titulaire}}" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}">
                @if ($errors)
                @error('tel_destinataire')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

            </div>

            <div class="col">

                <label for="" class="form-label mt-3" style="color: rgb(13, 5, 181); font-weight: bold;">Date de livraison</label>
                <input type="date" class="form-control mt-3" name="date_livraison" value="{{$facture->date_retrait}}">
                @if ($errors)
                @error('date_livraison')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color: rgb(13, 5, 181); font-weight: bold;">Heure de livraison</label>
                <input type="time" class="form-control mt-3" name="heure_livraison" value="{{$infos_livraison->heure_livraison}}">
                @if ($errors)
                @error('heure_livraison')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color: rgb(13, 5, 181); font-weight: bold;">Commune</label>
                <select class="form-select mt-3" name="id_commune" id="">
                    @forelse ($communes as $commune)
                    <option value="{{$commune->id}}">{{$commune->nom_commune}}</option>
                    @empty
                    <p class="text-center"><strong class="text-danger"> La liste des communes est vite! <strong></p>
                    @endforelse
                </select>
                @if ($errors)
                @error('id_commune')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

            </div>

            <div class="col">

                <label for="" class="form-label mt-3" style="color: rgb(13, 5, 181); font-weight: bold;">Quartier</label>
                <select class="form-select mt-3" name="id_quartier" id="">
                    @forelse ($quartiers as $quartier)
                    <option value="{{$quartier->id}}">{{$quartier->nom_quartier}}</option>
                    @empty
                    <p class="text-center"><strong class="text-danger"> La liste des quartiers est vite! <strong></p>
                    @endforelse
                </select>
                @if ($errors)
                @error('id_quartier')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color: rgb(13, 5, 181); font-weight: bold;">Adresse</label>
                <select class="form-select mt-3" name="id_adresse" id="">
                    @forelse ($adresses as $adresse)
                    <option value="{{$adresse->id}}">{{$adresse->nom_adresse}}</option>
                    @empty
                    <p class="text-center"><strong class="text-danger"> La liste des adaresses est vite! <strong></p>
                    @endforelse
                </select>
                @if ($errors)
                @error('id_adresse')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <label for="" class="form-label mt-3" style="color: rgb(13, 5, 181); font-weight: bold;">Le prix (En Francs CFA) </label>
                <select class="form-select mt-3" name="id_prix" id="">
                    @forelse ($prices as $price)
                    <option value="{{$price->id}}">{{$price->valeur_prix}}</option>
                    @empty
                    <p class="text-center"><strong class="text-danger"> La liste des prix est vite! <strong></p>
                    @endforelse
                </select>
                @if ($errors)
                @error('id_prix')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-pen-to-square"></i> Modifier</button>
                <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

            </div>

        </div>

    </form>

<!--fin formulaire d'ajout livraison-->

</div>


<!--debut liste des modal d'ajout d'options de livraison-->

<!--debut Modal add commune-->
<div class="modal fade" id="exampleModalAddCommune" tabindex="-1" aria-labelledby="exampleModalAddCommuneLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAddCommuneLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE COMMUNES</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postCommuneClassic',['facture' => $facture])}}" method="POST">

                @method('post')
                @csrf

                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Nom de la commune</label>
                <input type="text" class="form-control mt-3" name="nom_commune">
                @if ($errors)
                @error('nom_commune')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer </button>
                <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal" style='background-color:rgb(62, 7, 51); color: white;'>Retour</button>
        </div>
    </div>
    </div>
</div>
<!--fin Modal add commune-->


<!--debut Modal add quartier-->
<div class="modal fade" id="exampleModalAddQuartier" tabindex="-1" aria-labelledby="exampleModalAddQuartierLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAddQuartierLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE QUARTIERS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postQuartierClassic',['facture' => $facture])}}" method="POST">

                @method('post')
                @csrf

                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Nom du quartier</label>
                <input type="text" class="form-control mt-3" name="nom_quartier">
                @if ($errors)
                @error('nom_quartier')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer </button>
                <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal" style='background-color:rgb(62, 7, 51); color: white;'>Retour</button>
        </div>
    </div>
    </div>
</div>
<!--fin Modal add quartier-->


<!--debut Modal add adresse-->
<div class="modal fade" id="exampleModalAddAdresse" tabindex="-1" aria-labelledby="exampleModalAddAdresseLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAddAdresseLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT D'ADRESSES</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postAdresseClassic',['facture' => $facture])}}" method="POST">

                @method('post')
                @csrf

                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Adresse</label>
                <input type="text" class="form-control mt-3" name="nom_adresse">
                @if ($errors)
                @error('nom_adresse')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer </button>
                <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal" style='background-color:rgb(62, 7, 51); color: white;'>Retour</button>
        </div>
    </div>
    </div>
</div>
<!--fin Modal add adresse-->


<!--debut Modal add prix-->
<div class="modal fade" id="exampleModalAddPrix" tabindex="-1" aria-labelledby="exampleModalAddPrixLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAddPrixLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT DE PRIX</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postPrixClassic',['facture' => $facture])}}" method="POST">

                @method('post')
                @csrf

                <label for="" style="color:rgb(58, 32, 60); font-weight: bold;">Le prix</label>
                <input type="number" class="form-control mt-3" name="valeur_prix">
                @if ($errors)
                @error('valeur_prix')
                    <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                @enderror
                @endif

                <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer </button>
                <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal" style='background-color:rgb(62, 7, 51); color: white;'>Retour</button>
        </div>
    </div>
    </div>
</div>
<!--fin Modal add prix-->


<!--fin liste des modal d'ajout d'options de livraison-->

@endsection
