@extends('layouts/auth')
@section('title',"vêtements receptionnés")

@section('content')

<div class="text-center mt-3">
    @if (session('message'))
    <strong  style="padding: 10px; border-radius: 6px; color: rgb(7, 53, 67); background-color:rgb(76, 250, 227);">{{ session('message') }}</strong>
    @endif
</div>

<div class="mt-5">
    <table class="table table-striped shadow">
        <caption class="fs-5" style="color:rgb(15, 109, 177); border-top: solid 5px rgb(26, 12, 87);"><strong>Liste des vêtements réceptionnés</strong></caption>
        <thead>
            <tr>
                <th class="text-primary">Nom vet</th>
                <th class="text-primary">Couleur</th>
                <th class="text-primary">Specificat</th>
                <th class="text-primary">Catg</th>
                <th class="text-primary">Qte</th>
                <th class="text-primary">Prix unit</th>
                <th class="text-primary">Prix total</th>
                <th class="text-primary">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recepts as $recept)
            <tr>
                <td>{{ $recept->nom_vet}}</td>
                <td>{{ $recept->color_vet}}</td>
                <td>{{ $recept->caract_vet}}</td>
                <td>{{ $recept->cat_vet}}</td>
                <td>{{ $recept->qte_vet}}</td>
                <td>{{ $recept->prix_unitaire}} frs CFA</td>
                <td>{{ $recept->prix}} frs CFA</td>
                <td>
                    <a href="" title="details" style='color: rgb(14, 8, 4);'><i class="fa-solid fa-eye"></i></a><!--boutton details-->
                    <a data-bs-toggle="modal" data-bs-target="#modalDeleteVet" href="" type="button" title="supprimer" style='color: rgb(217, 6, 6);'><i class="fa-solid fa-trash"></i></a><!--boutton supprimer-->
                    <a href="" title="modifier" style='color: rgb(38, 11, 214);'><i class="fa-solid fa-pen"></i></a><!--boutton modifier-->
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    <p class="text-center"><strong class="text-danger"> La liste des vêtements réceptionnés est vite! <strong></p>
                </td>
            </tr>
            @endforelse
            <tr>
                <td colspan="4"><strong class="text-danger">Total</strong></td>
                <td><strong class="text-danger">{{$total_qte}}</strong></td>
                <td><strong class="text-danger">{{$total_prix_unit}} frs CFA</strong></td>
                <td><strong class="text-danger">{{$total_prix}} frs CFA</strong></td>
            </tr>
            <tr>

                <a type="button" class="btn" href="" style='color: rgb(255, 255, 255); background-color: rgb(5, 5, 5); margin: 5px;'>Imprimer</a>
            </tr>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>


@endsection
