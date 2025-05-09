<!-- filepath: d:\CSI 3\SEMESTRE 2\DEVELOPPEMENT BACK-END PHP\Collect_project\collecte-journaliere\resources\views\collecteur\recu.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reçu de Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .details {
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reçu de Paiement</h1>
        <p>Date : {{ now()->format('d/m/Y') }}</p>
    </div>
    <div class="details">
        <p><strong>Nom du Client :</strong> {{ $paiement->client->nom }} {{ $paiement->client->prenom }}</p>
        <p><strong>Montant :</strong> {{ number_format($paiement->montant, 2, ',', ' ') }} FCFA</p>
        <p><strong>Date de Paiement :</strong> {{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}</p>

        <p><strong>Mode de Paiement :</strong> {{ ucfirst($paiement->mode_paiement) }}</p>
    </div>
    <div class="footer">
        <p>Merci pour votre paiement.</p>
    </div>
</body>
</html>
