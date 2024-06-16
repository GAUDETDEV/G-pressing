<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PDF liste vêtements</title>
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

        <div>
            <div>
                <p>logo</p>
                <p>Pressing {{$infos_gerant->entreprise}}</p>
            </div>

            <table>
                <caption><strong>Liste des vêtements receptionnés de façon classique</strong></caption>
                <thead>
                    <tr>
                        <th>Type vet(s)</th>
                        <th>Couleur(s)</th>
                        <th>Spécification(s)</th>
                        <th>Catégorie(s)</th>
                        <th>Quantité(s)</th>
                        <th>Prix unit(s)</th>
                        <th>Prix</th>
                        <th>Réceptionné le</th>
                        <th>Mis à jour le</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vetement_classics as $vetement_classic)
                        <tr>
                            <td>{{ $vetement_classic->nom_vet}}</td>
                            <td>{{ $vetement_classic->color_vet}}</td>
                            <td>{{ $vetement_classic->caract_vet}}</td>
                            <td>{{ $vetement_classic->cat_vet}}</td>
                            <td>{{ $vetement_classic->qte_vet}}</td>
                            <td>{{ $vetement_classic->prix_unitaire}}</td>
                            <td>{{ $vetement_classic->prix}}</td>
                            <td>{{ $vetement_classic->created_at}}</td>
                            <td>{{ $vetement_classic->updated_at}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td> Total </td>
                        <td> {{ $total_qte_vet }}</td>
                        <td> {{ $total_prix_unitaire }} Frs</td>
                        <td> {{ $total_prix }} Frs</td>
                    </tr>
                </tbody>
                <tfoot>

                </tfoot>
            </table>

            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
    </body>
</html>
