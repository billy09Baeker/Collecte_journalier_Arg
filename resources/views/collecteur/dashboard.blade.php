
@extends('collecteur.welcome')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5 display-5 fw-bold">Tableau de Bord Collecteur</h1>

    <!-- Boutons d'actions -->
    <div class="d-flex justify-content-center mb-4">
        <a href="{{ route('collecteur.paiements') }}" class="btn btn-primary me-3">Enregistrer Paiement</a>
        <a href="{{ route('collecteur.clients') }}" class="btn btn-success me-3">Ajouter Client</a>
        <a href="" class="btn btn-warning">Performance</a>
    </div>

    <!-- Liste des clients -->
    <h3 class="mb-3">Liste des Clients</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Date d'Ajout</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td>{{ $client->nom }}</td>
                    <td>{{ $client->prenom }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->telephone }}</td>
                    <td>{{ $client->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Aucun client enregistré.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
