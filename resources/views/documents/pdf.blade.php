<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture {{ $document->reference }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            line-height: 1.4;
            color: #000;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .font-bold {
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        .no-border {
            border: none !important;
        }
        .totaux td {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="text-center">
        <h2>{{ $document->entreprise->nom }}</h2>
        <p>{{ $document->entreprise->email }}</p>
        <p>Tél:{{ $document->entreprise->telephone }}</p>
    </div>

    <hr>

    <div class="text-right">
        <p>Thiès, le {{ \Carbon\Carbon::parse($document->date)->format('d / m / Y') }}</p>
    </div>

    <div class="text-center">
        <h2>Facture</h2>
    </div>

    <p><strong>Client :</strong> {{ strtoupper($document->client->nom) }} {{ strtoupper($document->client->prenom) }}</p>

    <table>
        <thead>
            <tr>
                <th>Désignation des Articles</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Prix totale</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($document->lignes as $ligne)
                <tr>
                    <td>{{ $ligne->designation }}</td>
                    <td>{{ $ligne->quantite }}</td>
                    <td>{{ number_format($ligne->prix_unitaire, 0, ',', ' ') }}</td>
                    <td>{{ number_format($ligne->quantite * $ligne->prix_unitaire, 0, ',', ' ') }}</td>
                </tr>
            @endforeach

     @php
    $totalMateriel = 0;

    foreach ($document->lignes as $ligne) {
        $montant = $ligne->quantite * $ligne->prix_unitaire;
        $totalMateriel += $montant;
    }

    $totalMainOeuvre = $document->main_oeuvre ?? 0;

    $totalGeneral = $totalMateriel + $totalMainOeuvre;
@endphp


    $totalGeneral = $totalMateriel + $totalMainOeuvre;
@endphp



         <tr>
    <td colspan="3" style="text-align: right;"><strong>Total Matériel</strong></td>
    <td>{{ number_format($totalMateriel, 0, ',', ' ') }}</td>
</tr>
<tr>
    <td colspan="3" style="text-align: right;"><strong>Main d’œuvre</strong></td>
    <td>{{ number_format($totalMainOeuvre, 0, ',', ' ') }}</td>
</tr>
<tr>
    <td colspan="3" style="text-align: right;"><strong>Total</strong></td>
    <td>{{ number_format($totalGeneral, 0, ',', ' ') }}</td>
</tr>


        </tbody>
    </table>

    <br><br>

    <p>Arrêté la présente facture à la somme de <strong>{{ ucfirst($montantLettre) }}</strong> francs CFA.</p>



</body>
</html>
