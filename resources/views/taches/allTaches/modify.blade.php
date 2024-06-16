@extends('layouts/auth')
@section('title',"formulaire modification")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<!--debut formulaire de modification tache-->

<div class="container">

    <form action="{{route('putTache',['tache' => $tache->id])}}" method="POST" class="container shadow rounded-3" style="width:50%; margin-top:5%; padding: 5em; background-color: rgb(255, 255, 255);">
        <h1 class="modal-title fs-5" id="modalAjoutGerantLabel" style="color:rgb(6, 76, 125); font-weight: bold; border-bottom: solid 5px rgb(6, 76, 125); ">MISE A JOUR DE LA TÂCHE</h1>
        @method('put')
        @csrf


            <label for="" style="color:rgb(68, 3, 147); font-weight: bold;">Debut</label>
            <input type="date" class="form-control mt-3" name="debut_tache" value="{{$tache->debut_tache}}">
            @if ($errors)
            @error('debut_tache')
                <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
            @enderror
            @endif

            <label for="" style="color:rgb(68, 3, 147); font-weight: bold;">Fin</label>
            <input type="date" class="form-control mt-3" name="fin_tache" value="{{$tache->fin_tache}}">
            @if ($errors)
            @error('fin_tache')
                <p style="color:rgb(217, 17, 17);">{{ $message }}</p>
            @enderror
            @endif

            <button type="submit" class="btn mt-3" style="color: white; background-color: rgb(4, 96, 216);" ><i class="fa-solid fa-person-running"></i> Mettre à jour</button>
            <button type="reset" class="btn mt-3" style="color: white; background-color: rgb(6, 96, 57);" ><i class="fa-solid fa-rotate-left"></i> Annuler</button>

    </form>

</div>

<!--fin formulaire de modification tache-->

@endsection
