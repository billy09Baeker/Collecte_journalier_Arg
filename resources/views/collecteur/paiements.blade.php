<!-- filepath: d:\CSI 3\SEMESTRE 2\DEVELOPPEMENT BACK-END PHP\Collect_project\collecte-journaliere\resources\views\collecteur\paiements.blade.php -->
@extends('collecteur.welcome')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5 display-5 fw-bold">Enregistrer un Paiement</h1>

    <!-- Informations sur l'échéance -->
    @if($echeance)
    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Montant de l'Échéance :</strong> {{ number_format($echeance->montant_journalier, 2, ',', ' ') }} FCFA</p>
            <p><strong>Date de l'Échéance :</strong> {{ $echeance->date_echeance->format('d/m/Y') }}</p>
        </div>
    </div>
    @else
    <p class="text-center text-muted">Aucune échéance définie.</p>
    @endif

    <!-- Formulaire pour enregistrer un paiement -->
    <form action="{{ route('collecteur.paiements.store') }}" method="POST" class="mb-5">
        @csrf
        <div class="mb-3">
            <label for="client_id" class="form-label">Sélectionner un Client</label>
            <select name="client_id" id="client_id" class="form-select" required>
                <option value="">-- Choisir un client --</option>
                @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="mode_paiement" class="form-label">Mode de Paiement</label>
            <select name="mode_paiement" id="mode_paiement" class="form-select" required>
                <option value="espece">Espèce</option>
                <option value="mobile money">Mobile Money</option>
                <option value="virement">Virement</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Paiement Validé</button>
    </form>

    <!-- Liste des paiements -->
    <h3 class="mb-3">Historique des Paiements</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Montant (FCFA)</th>
                    <th>Date de Paiement</th>
                    <th>Mode de Paiement</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($paiements as $paiement)
                <tr>
                    <td>{{ $paiement->client->nom }} {{ $paiement->client->prenom }}</td>
                    <td>{{ number_format($paiement->montant, 2, ',', ' ') }}</td>
                    <td>{{ $paiement->date_paiement->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($paiement->mode_paiement) }}</td>
                    <td>
                        <a href="{{ route('collecteur.paiements.recu', $paiement->id) }}" class="btn btn-sm btn-secondary">Télécharger Reçu</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Aucun paiement enregistré.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
