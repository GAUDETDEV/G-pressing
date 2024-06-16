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
                <p>Pressing {{$infos_user->entreprise}}</p>
                <p>Receptionniste: {{$infos_user->name}}</p>
                <p>Contact: {{$infos_user->telephone}}</p>
                <p>Adresse mail: {{$infos_user->email}}</p>
                <p>Adresse: {{$infos_user->lieu_habitation}}</p>

            </div>

            <table>
                <caption><strong>Liste des vêtements receptionnés</strong></caption>
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
                    @foreach ($liste_vetements as $liste_vetement)
                        <tr>
                            <td>{{ $liste_vetement->nom_vet}}</td>
                            <td>{{ $liste_vetement->color_vet}}</td>
                            <td>{{ $liste_vetement->caract_vet}}</td>
                            <td>{{ $liste_vetement->cat_vet}}</td>
                            <td>{{ $liste_vetement->qte_vet}}</td>
                            <td>{{ $liste_vetement->prix_unitaire}}</td>
                            <td>{{ $liste_vetement->prix}}</td>
                            <td>{{ $liste_vetement->created_at}}</td>
                            <td>{{ $liste_vetement->updated_at}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td> Total </td>
                        <td> {{ $total_qte_vet }}</td>
                        <td> {{ $total_prix_unitaire }} frs CFA</td>
                        <td> {{ $total_prix }} frs CFA</td>
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
