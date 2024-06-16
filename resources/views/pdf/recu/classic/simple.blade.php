<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PDF reçu</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>

        <style>

            table {
                font-family: "Times New Roman", Times, serif;
            }

            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }

            th {
                background-color: #7c7c7c;
                color: white;
                text-align: left;
            }

        </style>


        <div class="container">
<!--bloc entreprise-->
            <div class="row">
                <div class="col">
                    <h2>Pressing</h2>
                    <strong class="fs-4">{{$info_editor->entreprise}}</strong>
                    <h3>Logo</h3>
                    <strong class="fs-4">Image</strong>
                </div>
                <div class="col">
                    <h2>INFORMATIONS FACTURE</h2>
                    <h3>Facture N° {{$facture->id}} </h3>
                    <p><strong>Date de création: </strong> {{$facture->created_at}}</p>
                    <p><strong>Date de rétrait: </strong> {{$facture->date_retrait}}</p>
                    <p><strong>Statut: </strong>@if($facture->statut_facture == "") Inconnu @else {{$facture->statut_facture}}  @endif </p>
                    <p><strong>Avancé ? </strong> @if ($facture->avance == 0) Non @else Oui avancé de : {{$montant_vets - $facture->reste}} frs @endif</p>
                    <p><strong>Délivré par: </strong> {{$info_editor->name}} </p>
                </div>
            </div>
<!--bloc entreprise-->

<!--bloc clients-->
            <div class="row">
                <div class="col">
                    <h2>INFORMATIONS CLIENT</h2>
                    <p><strong>Nom: </strong> {{$facture->nom_titulaire}}</p>
                    <p><strong>Téléphone: </strong> {{$facture->tel_titulaire}}</p>
                </div>
                <div class="col">
                    <h2>INFORMATIONS LIVRAISON</h2>
                    <p><strong>Récuperation par le client lui même!</p>
                </div>
            </div>
<!--bloc clients-->

<!--bloc vêtements-->
            <h2>VÊTEMENTS RECEPTIONNES</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Qte</th>
                        <th>Désignations</th>
                        <th>Couleurs</th>
                        <th>Spécifications</th>
                        <th>Types</th>
                        <th>Qualité(s)</th>
                        <th>Prix unitaire</th>
                        <th>Prix total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vet_recepts as $vet_recept)
                    <tr>
                        <td>{{$vet_recept->qte_vet}}</td>
                        <td>{{$vet_recept->nom_vet}}</td>
                        <td>{{$vet_recept->color_vet}}</td>
                        <td>{{$vet_recept->caract_vet}}</td>
                        <td>{{$vet_recept->cat_vet}}</td>
                        <td>{{$vet_recept->quality_vet}}</td>
                        <td>{{$vet_recept->prix_unitaire}} frs</td>
                        <td>{{$vet_recept->prix}} frs</td>
                    </tr>
                    @empty
                        <tr>
                            <td>Aucun vêtements enregistré pour cette facture!</td>
                        </tr>
                    @endforelse
                    <tr>
                        <td>{{$qte_vets}}</td>
                        <td>Total</td>
                        <td>{{$prix_units}} frs</td>
                        <td>{{$montant_vets}} frs</td>
                    </tr>
                </tbody>
                <tfoot>

                </tfoot>

            </table>
<!--bloc vêtements-->

<!--bloc resultat-->

            <div>

                <table class="table">
                    <tbody>
                        <tr>
                            <td>Montant à payer</td>
                            @if ($facture->avance !== 0)
                            <td>{{$facture->reste}} frs</td>
                            @endif
                            @if ($facture->avance == 0)
                            <td>{{$montant_vets}} frs</td>
                            @endif
                        </tr>
                    </tbody>
                </table>


            </div>

<!--bloc resultat-->

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
