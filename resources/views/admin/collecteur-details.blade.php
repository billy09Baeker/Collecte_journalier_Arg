@extends('admin.welcome')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5 display-5 fw-bold">Détails du Collecteur</h1>

    <!-- Informations du collecteur -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $collecteur->nom }} {{ $collecteur->prenom }}</h5>
            <p><strong>Email :</strong> {{ $collecteur->email }}</p>
            <p><strong>Téléphone :</strong> {{ $collecteur->telephone }}</p>
            <p><strong>Nombre de Clients :</strong> {{ $clients->count() }}</p>
        </div>
    </div>

    <!-- Tableau des clients -->
    <h3 class="mb-3">Liste des Clients Ajoutés</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date d'Ajout</th>
                    <th>Nombre de Paiements Confirmés</th>
                    <th>Montant Total des Paiements (FCFA)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td>{{ $client->nom }}</td>
                    <td>{{ $client->prenom }}</td>
                    <td>{{ $client->created_at->format('d/m/Y') }}</td>
                    <td>{{ $client->nombre_paiements_confirmes }}</td>
                    <td>{{ number_format($client->montant_total_paiements, 0, ',', ' ') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Aucun client trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
