<!-- filepath: d:\CSI 3\SEMESTRE 2\DEVELOPPEMENT BACK-END PHP\Collect_project\collecte-journaliere\resources\views\client\paiements.blade.php -->
@extends("client.welcome")
@section("contenu")

<div class="container mt-4">
    <!-- Ligne pour le bouton "Effectuer un Paiement" -->
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <button class="btn btn-primary" id="openModalBtn"><i class="bi bi-plus-circle"></i> Effectuer un Paiement</button>
        </div>
    </div>

    <!-- Tableau pour l'historique des dernières transactions -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-clock-history"></i> Historique des Dernières Transactions</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Mode de Paiement</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paiements as $paiement)
                            <tr>
                                <td>{{ $paiement->date_paiement }}</td>
                                <td>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
                                <td>{{ $paiement->mode_paiement }}</td>
                                <td>{{ ucfirst($paiement->status) }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary"

                                        @if($paiement->status !== 'confirmé') disabled @endif>

                                        Générer reçu

                                    </button>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Aucune transaction trouvée.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour effectuer un paiement -->
<div class="modal" id="paiementModal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-cash"></i> Effectuer un Paiement</h5>
                <button type="button" class="btn-close" id="closeModalBtn"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('paiements.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant (FCFA)</label>
                        <input type="number" class="form-control" id="montant" name="montant" value="{{$echeances->first()->montant_journalier ?? '' }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="mode_paiement" class="form-label">Mode de Paiement</label>
                        <select class="form-select" id="mode_paiement" name="mode_paiement" required>

                            <option value="Mobile Money">Mobile Money</option>
                            <option value="Chèque">QR Code</option>
                        </select>
                    </div>
                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Valider</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts pour gérer l'ouverture et la fermeture du modal -->
<script>
    document.getElementById('openModalBtn').addEventListener('click', function () {
        document.getElementById('paiementModal').style.display = 'block';
    });

    document.getElementById('closeModalBtn').addEventListener('click', function () {
        document.getElementById('paiementModal').style.display = 'none';
    });

    // Fermer le modal si l'utilisateur clique en dehors
    window.addEventListener('click', function (event) {
        const modal = document.getElementById('paiementModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>

@endsection
