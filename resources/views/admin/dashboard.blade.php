@extends('admin.welcome')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5 display-5 fw-bold">Tableau de Bord Administrateur</h1>

    <!-- Compteurs rapides -->
    <div class="row mb-5 g-4">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm text-white bg-primary">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-subtitle mb-1 text-white-50">Collecteurs</h6>
                        <h3 class="fw-bold">{{ $totalCollecteurs ?? 0 }}</h3>
                    </div>
                    <i class="bi bi-people-fill fs-2"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm text-white bg-success">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-subtitle mb-1 text-white-50">Clients</h6>
                        <h3 class="fw-bold">{{ $totalClients ?? 0 }}</h3>
                    </div>
                    <i class="bi bi-person-fill fs-2"></i>
                </div>
            </div>
        </div>
        <!-- Tu peux ajouter d'autres compteurs ici si besoin -->
    </div>

    <!-- Cartes principales -->
    <div class="row g-4">
        <div class="container py-5">

            <div class="row g-4">
                <!-- Carte Gestion des Collecteurs -->
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow h-100 hover-shadow transition">
                        <div class="card-body text-center">
                            <div class="mb-3 text-primary fs-1">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <h5 class="card-title fw-semibold">Gestion des Collecteurs</h5>
                            <p class="card-text text-muted">Ajouter, modifier ou supprimer des collecteurs.</p>
                            <a href="{{route('admin.collecteurs')}}" class="btn btn-outline-primary btn-sm mt-2">Gérer</a>
                        </div>
                    </div>
                </div>

                <!-- Carte Gestion des Clients -->
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow h-100 hover-shadow transition">
                        <div class="card-body text-center">
                            <div class="mb-3 text-success fs-1">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <h5 class="card-title fw-semibold">Gestion des Clients</h5>
                            <p class="card-text text-muted">Gérer les informations des clients.</p>
                            <a href="#" class="btn btn-outline-success btn-sm mt-2">Gérer</a>
                        </div>
                    </div>
                </div>

                <!-- Carte Suivi des Transactions -->
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow h-100 hover-shadow transition">
                        <div class="card-body text-center">
                            <div class="mb-3 text-warning fs-1">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                            <h5 class="card-title fw-semibold">Suivi des Transactions</h5>
                            <p class="card-text text-muted">Consulter et suivre les paiements effectués.</p>
                            <a href="#" class="btn btn-outline-warning btn-sm mt-2">Suivre</a>
                        </div>
                    </div>
                </div>

                <!-- Carte Performances -->
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow h-100 hover-shadow transition">
                        <div class="card-body text-center">
                            <div class="mb-3 text-danger fs-1">
                                <i class="bi bi-bar-chart-line-fill"></i>
                            </div>
                            <h5 class="card-title fw-semibold">Performances</h5>
                            <p class="card-text text-muted">Analyser les performances des collecteurs.</p>
                            <a href="#" class="btn btn-outline-danger btn-sm mt-2">Analyser</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
