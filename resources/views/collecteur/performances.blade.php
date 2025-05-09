
@extends('collecteur.welcome')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5 display-5 fw-bold">Mes Performances</h1>

    <!-- Compteurs -->
    <div class="row mb-5 g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm text-white bg-primary">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-subtitle mb-1 text-white-50">Total Clients</h6>
                        <h3 class="fw-bold">{{ $totalClients }}</h3>
                    </div>
                    <i class="bi bi-people fs-2"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm text-white bg-success">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-subtitle mb-1 text-white-50">Montant Total Collecté (FCFA)</h6>
                        <h3 class="fw-bold">{{ number_format($montantTotal, 0, ',', ' ') }}</h3>
                    </div>
                    <i class="bi bi-cash-stack fs-2"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtre -->
    <form action="{{ route('collecteur.performances') }}" method="GET" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="jour" class="form-label">Filtrer par Jour</label>
                <input type="date" name="jour" id="jour" class="form-control" value="{{ request('jour') }}">
            </div>
            <div class="col-md-4">
                <label for="mois" class="form-label">Filtrer par Mois</label>
                <select name="mois" id="mois" class="form-select">
                    <option value="">-- Choisir un mois --</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('mois') == $i ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4">
                <label for="annee" class="form-label">Filtrer par Année</label>
                <select name="annee" id="annee" class="form-select">
                    <option value="">-- Choisir une année --</option>
                    @for($i = now()->year; $i >= 2000; $i--)
                        <option value="{{ $i }}" {{ request('annee') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Filtrer</button>
    </form>

    <!-- Liste des collectes -->
    <h3 class="mb-3">Liste des Collectes</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Montant (FCFA)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($collectes as $collecte)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($collecte->date_paiement)->format('d/m/Y') }}</td>

                    <td>{{ $collecte->client->nom }} {{ $collecte->client->prenom }}</td>
                    <td>{{ number_format($collecte->montant, 0, ',', ' ') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">Aucune collecte trouvée.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($collectes->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $collectes->links() }}
    </div>
@endif

    <!-- Graphique -->
    <h3 class="mb-3">Graphique des Collectes</h3>
    <canvas id="collecteChart"></canvas>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('collecteChart').getContext('2d');
    const collecteData = @json($graphiqueData);
    const labels = collecteData.map(data => data.date);
    const data = collecteData.map(data => data.total);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Montant Collecté (FCFA)',
                data: data,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
</script>
@endsection
