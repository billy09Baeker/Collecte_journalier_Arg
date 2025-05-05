@extends("client.welcome")
@section("contenu")


<div class="container mt-5">
    <h2 class="mb-4">Bienvenue {{ session('user_nom') }}</h2>



    <div class="row g-4">
        <!-- Solde actuel -->
        <div class="col-md-4">
            <div class="p-4 bg-white dashboard-card">
                <h6><i class="bi bi-wallet2 me-2"></i>Solde actuel</h6>
                <h3 class="text-success">
                    @if(session('totalPaiements') !== null)
                        <div class="alert alert-info">
                            Total des paiements : {{ session('totalPaiements') ?? 0 }} FCFA
                        </div>
                    @else
                        <div class="alert alert-info">
                        0 FCFA
                        </div>
                    @endif
                </h3>
            </div>
        </div>

        <!-- Prochaine échéance -->
        <div class="col-md-4">
            <div class="p-4 bg-white dashboard-card">
                <h6><i class="bi bi-calendar-event me-2"></i>Prochaine échéance</h6>
                <p class="mb-0">{{ session('echeance_montant') }} FCFA - {{ session('echeance_date') }}</p>
            </div>
        </div>

        <!-- Dernier paiement -->
        <div class="col-md-4">
            <div class="p-4 bg-white dashboard-card">
                <h6><i class="bi bi-cash-stack me-2"></i>Dernier paiement</h6>
                <p class="mb-0">{{ session('lastPayment_montant') }} FCFA - {{ session('lastPayment_date') }}</p>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h5><i class="bi bi-bell me-2"></i>Notifications importantes</h5>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Retard de paiement détecté pour le client N°104
                <span class="badge bg-danger">Urgent</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Nouveau reçu généré pour la collecte du 01 Mai
                <span class="badge bg-primary">Nouveau</span>
            </li>
        </ul>
    </div>
</div>

@endsection


