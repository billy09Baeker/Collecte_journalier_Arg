@extends('admin.welcome')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5 display-5 fw-bold"></h1>

   <!-- Compteurs rapides -->
<div class="row mb-5 g-4">
    <div class="col-md-4">
        <a href="{{ route('admin.suivi-paiements', ['status' => 'confirmé']) }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm text-white bg-primary">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-subtitle mb-1 text-white-50">Paiements Confirmés</h6>
                        <h3 class="fw-bold">{{ $totalPaiementsConfirmes }}</h3>
                    </div>
                    <i class="bi bi-check-circle fs-2"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('admin.suivi-paiements', ['status' => 'en attente']) }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm text-white bg-warning">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-subtitle mb-1 text-white-50">Paiements en Attente</h6>
                        <h3 class="fw-bold">{{ $totalPaiementsEnattentes }}</h3>
                    </div>
                    <i class="bi bi-hourglass-split fs-2"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('admin.suivi-paiements', ['status' => 'annulé']) }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm text-white bg-danger">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-subtitle mb-1 text-white-50">Paiements Annulés</h6>
                        <h3 class="fw-bold">{{ $totalPaiementsAnnules }}</h3>
                    </div>
                    <i class="bi bi-x-circle fs-2"></i>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Indication du filtre actif -->
@if($status)
    <div class="alert alert-info">
        Affichage des paiements avec le statut : <strong>{{ ucfirst($status) }}</strong>
        <a href="{{ route('admin.suivi-paiements') }}" class="btn btn-sm btn-secondary ms-3">Réinitialiser le filtre</a>
    </div>
@endif


    <!-- Tableau des derniers paiements -->
    <h3 class="mb-4">Liste des Derniers Paiements</h3>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nom du Client</th>
                    <th>Prénom du Client</th>
                    <th>Montant (FCFA)</th>
                    <th>Date de Paiement</th>
                    <th>Statut</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($paiements as $paiement)
                    <tr>
                        <td>{{ $paiement->client->nom ?? 'N/A' }}</td>
                        <td>{{ $paiement->client->prenom ?? 'N/A' }}</td>
                        <td>{{ number_format($paiement->montant, 0, ',', ' ') }}</td>
                        <td>{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}</td>
                        <td>
                            @if($paiement->status === 'en attente')
                                <span class="badge bg-warning text-dark">En attente</span>
                            @elseif($paiement->status === 'confirmé')
                                <span class="badge bg-success">Confirmé</span>
                            @elseif($paiement->status === 'annulé')
                                <span class="badge bg-danger">Annulé</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($paiement->status) }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($paiement->status === 'en attente')
                                <form action="{{ route('paiement.confirmer', $paiement->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" title="Confirmer">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                </form>

                                <form action="{{ route('paiement.annuler', $paiement->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Annuler ce paiement ?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" title="Annuler">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Aucun paiement trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>




<style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .transition {
        transition: all 0.3s ease;
    }
</style>
@endsection
