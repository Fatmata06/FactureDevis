<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ ucfirst($document->type) }} {{ $document->reference }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header, .footer {
            text-align: center;
        }
        .section {
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table th, .table td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>{{ ucfirst($document->type) }} - {{ $document->reference }}</h2>
        <p>Date : {{ \Carbon\Carbon::parse($document->date)->format('d/m/Y') }}</p>
    </div>

    <div class="section">
        <strong>Entreprise :</strong><br>
        {{ $document->entreprise->nom }}<br>
        {{ $document->entreprise->email }}<br>
        {{ $document->entreprise->telephone }}
    </div>

    <div class="section">
        <strong>Client :</strong><br>
        {{ $document->client->prenom }} {{ $document->client->nom }}
    </div>

    <div class="section">
        <table class="table">
            <thead>
                <tr>
                    <th>Désignation</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($document->lignes as $ligne)
                    <tr>
                        <td>{{ $ligne->designation }}</td>
                        <td>{{ $ligne->quantite }}</td>
                        <td>{{ number_format($ligne->prix_unitaire, 2, ',', ' ') }} €</td>
                        <td>{{ number_format($ligne->total, 2, ',', ' ') }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">
            Total : {{ number_format($document->lignes->sum('total'), 2, ',', ' ') }} €
        </p>
    </div>

    <div class="footer">
        <p>Document généré automatiquement - {{ config('app.name') }}</p>
    </div>

</body>
</html>
