@extends('client.welcome')

@section('contenu')
<div class="container py-5">
    <h1 class="text-center mb-5 display-5 fw-bold">Mes Paiements</h1>

    <!-- Informations sur l'échéance -->
    @if($echeance)
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Informations sur l'Échéance</h5>
            <p><strong>Montant Journalier :</strong> {{ number_format($echeance->montant_journalier, 2, ',', ' ') }} FCFA</p>
            <p><strong>Date d'Échéance :</strong> {{ $echeance->date_echeance }}</p>
            <p><strong>Mode de Paiement 1 :</strong> {{ $echeance->mode_paiement_1 ?? 'Non défini' }}</p>
            <p><strong>Mode de Paiement 2 :</strong> {{ $echeance->mode_paiement_2 ?? 'Non défini' }}</p>
            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#paiementModal">Effectuer Paiement</button>
        </div>
    </div>
    @else
    <p class="text-center text-muted">Aucune échéance définie.</p>
    @endif

    <!-- Filtre des paiements -->
    <div class="mb-4">
        <form action="{{ route('client.mes-paiements') }}" method="GET" class="d-flex justify-content-end">
            <select name="status" class="form-select w-auto me-2">
                <option value="">Tous</option>
                <option value="confirmé" {{ request('status') == 'confirmé' ? 'selected' : '' }}>Confirmés</option>
                <option value="en attente" {{ request('status') == 'en attente' ? 'selected' : '' }}>En Attente</option>
                <option value="annulé" {{ request('status') == 'annulé' ? 'selected' : '' }}>Annulés</option>
            </select>
            <button type="submit" class="btn btn-secondary">Filtrer</button>
        </form>
    </div>

    <!-- Historique des paiements -->
    <h3 class="mb-3">Historique des Paiements</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date de Paiement</th>
                    <th>Montant (FCFA)</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($paiements as $paiement)
                <tr>
                    <td>{{ $paiement->date_paiement }}</td>
                    <td>{{ number_format($paiement->montant, 0, ',', ' ') }}</td>
                    <td>{{ ucfirst($paiement->status) }}</td>
                    <td>
                        @if($paiement->status === 'confirmé')
                            {{-- <form action="{{ route('client.paiements.confirmer', $paiement->id) }}" method="POST" style="display:inline-block;"> --}}
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" title="Confirmer">
                                    <i class="bi bi-check-circle"></i> Telecharger reçu
                                </button>
                            {{-- </form> --}}
                        @endif
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">Aucun paiement trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal pour effectuer un paiement -->
<div class="modal fade" id="paiementModal" tabindex="-1" aria-labelledby="paiementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('client.paiements.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="paiementModalLabel">Effectuer un Paiement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Montant Journalier :</strong> {{ number_format($echeance->montant_journalier, 2, ',', ' ') }} FCFA</p>
                    <p><strong>Date d'Échéance :</strong> {{ $echeance->date_echeance }}</p>
                    <p class="text-muted">Scannez l'un des QR codes ci-dessous pour effectuer votre paiement :</p>
                    <div class="mb-3">
                        <p><strong>Mode de Paiement 1 :</strong> {{ $echeance->mode_paiement_1 ?? 'Non défini' }}</p>
                        @if($echeance->qr_code_1)
                            <img src="{{ asset('storage/' . $echeance->qr_code_1) }}" alt="QR Code 1" style="width: 150px;">
                        @else
                            <p class="text-muted">QR Code 1 non disponible.</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <p><strong>Mode de Paiement 2 :</strong> {{ $echeance->mode_paiement_2 ?? 'Non défini' }}</p>
                        @if($echeance->qr_code_2)
                            <img src="{{ asset('storage/' . $echeance->qr_code_2) }}" alt="QR Code 2" style="width: 150px;">
                        @else
                            <p class="text-muted">QR Code 2 non disponible.</p>
                        @endif
                    </div>
                    <p class="text-muted">Après avoir effectué le paiement, cliquez sur le bouton ci-dessous pour confirmer.</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Paiement Effectué</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
