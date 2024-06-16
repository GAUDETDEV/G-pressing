<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PDF liste des livraisons</title>
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
                <p>Pressing </p>
            </div>

            <table>
                <caption><strong>Liste des livraisons</strong></caption>
                <thead>
                    <tr>
                        <th>Client(s)</th>
                        <th>Téléphone(s)</th>
                        <th>Date de livraison</th>
                        <th>Heure de livraison</th>
                        <th>Enregistré le</th>
                        <th>Frais</th>
                        <th>Plannifié le</th>
                        <th>Modifié le</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($liste_livraisons as $liste_livraison)
                        <tr>
                            <td>{{ $liste_livraison->nom_destinataire}}</td>
                            <td>{{ $liste_livraison->tel_destinataire}}</td>
                            <td>{{ $liste_livraison->date_livraison}}</td>
                            <td>{{ $liste_livraison->heure_livraison}}</td>
                            <td>{{ $liste_livraison->registration}}</td>
                            <td>{{ $liste_livraison->frais}} Frs</td>
                            <td>{{ $liste_livraison->created_at}}</td>
                            <td>{{ $liste_livraison->updated_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td> Total </td>
                        <td> {{ $total_frais }} Frs</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
    </body>
</html>

