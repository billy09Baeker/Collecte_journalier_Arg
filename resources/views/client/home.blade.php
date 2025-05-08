@extends("client.welcome")
@section("contenu")

<div class="container py-5">
    <h2 class="mb-5 fw-bold text-center">Bienvenue {{ session('user_nom') }}</h2>

    <div class="row g-4">
        <!-- Solde actuel -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="text-success fs-2 mb-3">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <h6 class="card-title text-muted">Solde Actuel</h6>
                    <h4 class="fw-bold">
                        {{ $totalPaiements ?? 0 }} FCFA
                    </h4>
                </div>
            </div>
        </div>

        <!-- Prochaine échéance -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="text-warning fs-2 mb-3">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <h6 class="card-title text-muted">Prochaine Échéance</h6>
                    <p class="fw-semibold mb-0">
                        {{ $echeance_montant ?? 0 }} FCFA
                    </p>
                    <p class="text-muted small">{{ $echeance_date ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Dernier paiement -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="text-primary fs-2 mb-3">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <h6 class="card-title text-muted">Dernier Paiement</h6>
                    @if($lastPayment_montant > 0)
    <p class="mb-0">{{ $lastPayment_montant }} FCFA - {{ $lastPayment_date }}</p>
@else
    <p class="text-muted mb-0">Aucun paiement effectué</p>
@endif

                    <p class="text-muted small">{{ session('lastPayment_date') ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    <div class="mt-5">
        <h5 class="mb-3 fw-bold"><i class="bi bi-bell me-2"></i>Notifications importantes</h5>
        <ul class="list-group shadow-sm">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Retard de paiement détecté
                <span class="badge bg-danger rounded-pill">Urgent</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Nouveau reçu généré pour la collecte du 01 Mai
                <span class="badge bg-primary rounded-pill">Nouveau</span>
            </li>
        </ul>
    </div>
</div>
@endsection
