@extends('layouts/auth')
@section('title',"planification de receptions")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut formulaire de modification gerants-->

<div class="container">

    <form action="{{route('postPlanningRecep')}}" method="POST" class="container shadow rounded-3" style="width:50%; margin-top:5%; padding: 5em; background-color: rgb(255, 255, 255);">
        <h1 class="modal-title fs-5" id="modalAjoutGerantLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">FORMULAIRE DE PLANIFICATION DE RECEPTIONS</h1>
        @method('post')
        @csrf

        <label class="form-label mt-3" for="" style="color:rgb(44, 4, 84); font-weight: bold;">Débute le: </label>
        <input type="date" class="form-control" name="debut_tache" value="{{ $today }}">
        @if ($errors)
        @error('debut_tache')
            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
        @enderror
        @endif

        <label class="form-label mt-3" for="" style="color:rgb(44, 4, 84); font-weight: bold;">Prend fin le: </label>
        <input type="date" class="form-control" name="fin_tache">
        @if ($errors)
        @error('fin_tache')
            <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
        @enderror
        @endif

        <label class="form-label mt-3" for="" style="color:rgb(44, 4, 84); font-weight: bold;">Executant</label>
        <select class="form-select" name="id_executant" id="">
            @forelse ($liste_receptionnistes as $liste_receptionniste)
            <option value="{{$liste_receptionniste->id}}">{{$liste_receptionniste->name}}</option>
            @empty
            <p style="color:rgb(217, 17, 17);">La liste des receptionnistes est vide!</p>
            @endforelse
        </select>

        <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Enregistrer </button>
        <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

    </form>

</div>


<!--fin formulaire de modification gerants-->

@endsection
