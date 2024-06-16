@extends('layouts/index')
@section('title', "index")
@section('content')

<div class="container">

    <form action="{{route('postLogin')}}" method="POST" class="container" style="width:500px; margin-top:5%; padding: 5em; background-color: rgb(0, 0, 0); border-radius: 10px;">

        <p style="color: rgba(8, 211, 191, 0.743); text-shadow: 1px 1px 2px rgb(4, 131, 135), 0 0 25px rgb(123, 123, 212), 0 0 5px rgb(31, 31, 228); text-align: center; font-size: 20px; text-decoration: underline;"> G-PressingManager </p><br>
        <div class="TextAuth">
            <h1 class="TextAuthH1">Authentification</h1>
        </div>
        @method('post')
        @csrf
        <div class="text-center">
            @if (session('message'))
            <strong  style="padding:5px; border-radius: 6px; color:rgb(217, 17, 17); background-color:rgb(246, 208, 208);">{{ session('message') }}</strong>
            @endif
        </div>
        <div class="mb-3 mt-5">
            <label for="exampleInputEmail1" class="form-label" style="color:rgb(3, 57, 206);">Email</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" style="color:rgb(37, 204, 255); background-color:rgb(2, 76, 87);">
            @if ($errors)
                @error('email')
                    <p style="color:rgb(217, 17, 17);">L'email est requis</p>
                @enderror
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" style="color:rgb(3, 57, 206);">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" style="color:rgb(37, 204, 255); background-color:rgb(2, 76, 87);">
            @if ($errors)
                @error('password')
                    <p style="color:rgb(217, 17, 17);">Le mot de passe est requis</p>
                @enderror
            @endif
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-right-to-bracket"></i> Connexion </button>
    </form>

</div>


@endsection
