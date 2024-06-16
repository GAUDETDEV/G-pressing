<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PDF liste tâches</title>
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
                <p>Pressing {{$infos_laveur->entreprise}}</p>

                <p>Receptionniste: {{$infos_laveur->name}}</p>
                <p>Contact: {{$infos_laveur->telephone}}</p>
                <p>Adresse mail: {{$infos_laveur->email}}</p>
                <p>Adresse: {{$infos_laveur->lieu_habitation}}</p>

            </div>

            <table>
                <caption><strong>Liste des tâches</strong></caption>
                <thead>
                    <tr>
                        <th>Type de tâche</th>
                        <th>Début execution(s)</th>
                        <th>Fin execution(s)</th>
                        <th>Etat(s)</th>
                        <th>Planifier le</th>
                        <th>Mis à jour le</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($liste_taches as $liste_tache)
                        <tr>
                            <td>{{ $liste_tache->type_tache}}</td>
                            <td>{{ $liste_tache->debut_tache}}</td>
                            <td>{{ $liste_tache->fin_tache}}</td>
                            <td>{{ $liste_tache->etat_tache}}</td>
                            <td>{{ $liste_tache->created_at}}</td>
                            <td>{{ $liste_tache->updated_at}}</td>
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
