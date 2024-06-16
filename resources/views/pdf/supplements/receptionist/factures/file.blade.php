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

        <div>
            <table>
                <caption><strong>Liste des factures</strong></caption>
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Titulaire</th>
                        <th>Téléphone</th>
                        <th>Créer le</th>
                        <th>Mis à jour le</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($liste_factures as $liste_facture)
                        <tr>
                            <td>{{ $liste_facture->id}}</td>
                            <td>{{ $liste_facture->nom_titulaire}}</td>
                            <td>{{ $liste_facture->tel_titulaire}}</td>
                            <td>{{ $liste_facture->created_at}}</td>
                            <td>{{ $liste_facture->updated_at}}</td>
                        </tr>
                    @endforeach
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
