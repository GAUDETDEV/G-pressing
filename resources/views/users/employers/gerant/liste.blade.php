@extends('layouts/auth')
@section('title',"liste employers")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding:5px; border-radius: 6px; color:rgb(25, 6, 91); background-color:rgb(162, 217, 234);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut bouton add employers-->

<div class="d-flex">

    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalAddEmp" style="background-color:rgb(66, 16, 250); color: white;">
        <i class="fa-solid fa-plus"></i> Ajouter
    </button>

    <!-- Button trigger modal -->
    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style='background-color:rgb(240, 0, 0); color: rgb(244, 244, 244); margin-left: 3px;'>
        <i class="fa-solid fa-broom"></i> Nettoyage complet
    </button>

</div>

<!--fin bouton add employers-->


<!-- Debut Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel" style='color:rgb(240, 0, 0);'>Attention <i class="fa-solid fa-2x fa-circle-info" style='color:rgb(240, 0, 0);'></i></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-5 text-danger">
                Tous les employers seront supprimés!
            </div>
            <div class="modal-footer">
            <a class="btn btn-primary" href="{{route('deleteAllEmployer')}}"><i class="fa-solid fa-check"></i> Je confirme</a>
            <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-rotate-left"></i> Annuler</button>
            </div>
        </div>
    </div>
  </div>
<!-- Fin Modal -->


<!-- debut barre de recherche -->

<div class="container mt-3">
    <form action="" method="get" action="{{route('listeEmployers')}}" style="display: flex;">

        @csrf
        @method('get')
        <input class="form-control no-border-input" type="text" name="search" placeholder="Recherche...">
        <button type="submit" class="btn no-border-button" style="background-color:rgb(8, 134, 173); color: white;">Rechercher</button>

    </form>
</div>

<!-- fin barre de recherche -->

<table class="table table-white table-hover mt-3 shadow rounded-5">
    <thead class="table-primary">
        <tr>
            <th>#</th>
            <th>Photo(s)</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone(s)</th>
            <th>Entreprise(s)</th>
            <th>Poste(s)</th>
            <th>Souscrire le</th>
            <th>Modifier le</th>
            <th>Action(s)</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($employers as $employer)
        <tr>
            <td><strong> {{ $employer->id }} </strong></td>
            <td>

                @if ($employer->photo)

                <img src="{{ asset('storage/'.$employer->photo) }}" alt="Photo de profil" style="width: 3rem; height: 3rem; text-align: center; border-radius: 10px;">

                @else

                <img src="{{ asset('https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg')}}" alt="" style="width: 3rem; height: 3rem; text-align: center; border-radius: 10px;">

                @endif

            </td>
            <td>{{ $employer->name }}</td>
            <td>{{ $employer->email }}</td>
            <td>{{ $employer->telephone }}</td>
            <td>{{ $employer->entreprise }}</td>
            <td>{{ $employer->role }}</td>
            <td>{{ $employer->created_at }}</td>
            <td>{{ $employer->updated_at }}</td>
            <td>
                <a href="{{route('detailEmployer',["employer"=>$employer->id])}}" title="details" style='color: rgb(14, 8, 4);'><i class="fa-solid fa-eye"></i></a><!--boutton details-->
                <a href="{{route('modifyEmployer',["employer"=>$employer->id])}}" title="modifier" style='color: rgb(38, 11, 214);'><i class="fa-solid fa-pen"></i></a><!--boutton modifier-->
                <a href="{{route('deleteEmployer',["employer"=>$employer->id])}}" type="button" title="supprimer" style='color: rgb(217, 6, 6);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
            </td>

        </tr>

    </tbody>
    <tfoot>

    </tfoot>

    @empty

        <p class="text-center"><strong class="text-danger"> La liste des employers est vite! <strong></p>

    @endforelse

</table>

<!--debut modal add employers -->
<div class="modal fade" id="exampleModalAddEmp" tabindex="-1" aria-labelledby="exampleModalAddEmpLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalAddEmpLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">AJOUT EMPLOYER</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('postEmployer')}}" method="POST" enctype="multipart/form-data">

                @method('post')
                @csrf

                <div class="row">

                    <div class="col">

                        <input type="text" class="form-control mt-3" name="name" placeholder="Nom">
                        @if ($errors)
                        @error('name')
                            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                        @enderror
                        @endif

                        <input type="email" class="form-control mt-3" name="email" placeholder="Email">
                        @if ($errors)
                        @error('email')
                            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                        @enderror
                        @endif

                        <input type="tel" class="form-control mt-3" name="telephone" placeholder="Téléphone" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}">
                        @if ($errors)
                        @error('telephone')
                            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                        @enderror
                        @endif

                    </div>
                    <div class="col">

                        <label class="form-label mt-3" for="" style="color:rgb(12, 9, 104);">Prise de service</label>
                        <input type="date" class="form-control" name="debut_poste">
                        @if ($errors)
                        @error('debut_poste')
                            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                        @enderror
                        @endif

                        <label class="form-label mt-3" for="" style="color:rgb(12, 9, 104);">Fin de service</label>
                        <input type="date" class="form-control" name="fin_poste">
                        @if ($errors)
                        @error('fin_poste')
                            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                        @enderror
                        @endif

                        <input type="text" class="form-control mt-3" name="lieu_habitation" placeholder="Habitation">
                        @if ($errors)
                        @error('lieu_habitation')
                            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                        @enderror
                        @endif

                    </div>
                    <div class="col">

                        <input type="text" class="form-control mt-3" name="adresse" placeholder="adresse">
                        @if ($errors)
                        @error('adresse')
                            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                        @enderror
                        @endif

                        <label class="form-label mt-3" for="" style="color:rgb(12, 9, 104);">Le poste</label>
                        <select class="form-select" name="id_poste" id="">
                            @forelse ($postes as $poste)
                                <option value="{{$poste->id}}">{{$poste->titre_poste}}</option>
                            @empty
                                <p style="color:rgb(217, 17, 17);">Liste des postes est vide</p>
                            @endforelse
                        </select>
                        @if ($errors)
                        @error('id_poste')
                            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                        @enderror
                        @endif

                        <input type="password" class="form-control mt-3" name="password" placeholder="Mot de passe">
                        @if ($errors)
                        @error('password')
                            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                        @enderror
                        @endif


                    </div>

                </div>

                <div class="row">

                    <div class="col">
                        <label class="form-label mt-3" for="" style="color:rgb(12, 9, 104);">Importez un photo</label>
                        <input type="file" class="form-control" name="photo">
                        @if ($errors)
                        @error('photo')
                            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
                        @enderror
                        @endif
                    </div>

                </div>

                <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer</button>
                <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
        </div>

    </div>
    </div>
</div>
<!--debut modal add employer -->

{{ $employers->links() }}

@endsection
