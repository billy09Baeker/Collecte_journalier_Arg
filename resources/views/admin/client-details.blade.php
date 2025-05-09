@extends('admin.welcome')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Détails du Client</h2>

    <!-- Informations du client -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $client->nom }} {{ $client->prenom }}</h5>
            <p><strong>Email :</strong> {{ $client->email }}</p>
            <p><strong>Téléphone :</strong> {{ $client->telephone }}</p>
            <p><strong>Sexe :</strong> {{ ucfirst($client->sexe) }}</p>
            <p><strong>Solde Total :</strong> {{ number_format($client->paiements->where('status', 'confirmé')->sum('montant'), 0, ',', ' ') }} FCFA</p>
        </div>
    </div>

    <!-- Tableau des paiements -->
    <h3 class="mb-3">Historique des Paiements</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date de Paiement</th>
                    <th>Montant (FCFA)</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($paiements as $paiement)
                <tr>
                    <td>{{ $paiement->date_paiement }}</td>
                    <td>{{ number_format($paiement->montant, 0, ',', ' ') }}</td>
                    <td>{{ ucfirst($paiement->status) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">Aucun paiement trouvé pour ce client.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($paiements->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $paiements->links() }}
    </div>
@endif
</div>
@endsection
