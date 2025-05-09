<!-- filepath: d:\CSI 3\SEMESTRE 2\DEVELOPPEMENT BACK-END PHP\Collect_project\collecte-journaliere\resources\views\admin\parametres.blade.php -->
@extends('admin.welcome')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5 display-5 fw-bold">Paramètres de l'Échéance</h1>


    @if($echeance)
    <!-- Affichage des informations de l'échéance -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Informations sur l'Échéance</h5>
            <p><strong>Montant Journalier :</strong> {{ number_format($echeance->montant_journalier, 2, ',', ' ') }} FCFA</p>
            <p><strong>Date de Paiement :</strong>
                {{ $echeance->date_paiement
                    ? \Carbon\Carbon::parse($echeance->date_paiement)->translatedFormat('d F Y')
                    : 'Non défini' }}
            </p>

            <p><strong>Date d'Échéance :</strong>
                {{ $echeance->date_echeance
                    ? \Carbon\Carbon::parse($echeance->date_echeance)->translatedFormat('d F Y')
                    : 'Non définie' }}
            </p>
            <p><strong>Mode de Paiement 1 :</strong> {{ $echeance->mode_paiement_1 ?? 'Non défini' }}</p>
            <p><strong>QR Code 1 :</strong>
                @if($echeance->qr_code_1)
                    <img src="{{ asset('storage/' . $echeance->qr_code_1) }}" alt="QR Code 1" style="width: 100px;">
                @else
                    Non défini
                @endif
            </p>
            <p><strong>Mode de Paiement 2 :</strong> {{ $echeance->mode_paiement_2 ?? 'Non défini' }}</p>
            <p><strong>QR Code 2 :</strong>
                @if($echeance->qr_code_2)
                    <img src="{{ asset('storage/' . $echeance->qr_code_2) }}" alt="QR Code 2" style="width: 100px;">
                @else
                    Non défini
                @endif
            </p>
        </div>
    </div>

    <!-- Bouton pour modifier l'échéance -->
    <a href="#editEcheanceModal" class="btn btn-primary" data-bs-toggle="modal">Modifier l'Échéance</a>

    <!-- Modal pour modifier l'échéance -->
    <div class="modal fade" id="editEcheanceModal" tabindex="-1" aria-labelledby="editEcheanceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.parametres.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEcheanceModalLabel">Modifier l'Échéance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="montant_journalier" class="form-label">Montant Journalier</label>
                            <input type="number" class="form-control" id="montant_journalier" name="montant_journalier" value="{{ $echeance->montant_journalier }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_paiement" class="form-label">Date de Paiement</label>
                            <input type="date" class="form-control" id="date_paiement" name="date_paiement" value="{{ $echeance->date_paiement }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_echeance" class="form-label">Date d'Échéance</label>
                            <input type="date" class="form-control" id="date_echeance" name="date_echeance" value="{{ $echeance->date_echeance }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="mode_paiement_1" class="form-label">Mode de Paiement 1</label>
                            <input type="text" class="form-control" id="mode_paiement_1" name="mode_paiement_1" value="{{ $echeance->mode_paiement_1 }}">
                        </div>
                        <div class="mb-3">
                            <label for="qr_code_1" class="form-label">QR Code 1</label>
                            <input type="file" class="form-control" id="qr_code_1" name="qr_code_1">
                        </div>
                        <div class="mb-3">
                            <label for="mode_paiement_2" class="form-label">Mode de Paiement 2</label>
                            <input type="text" class="form-control" id="mode_paiement_2" name="mode_paiement_2" value="{{ $echeance->mode_paiement_2 }}">
                        </div>
                        <div class="mb-3">
                            <label for="qr_code_2" class="form-label">QR Code 2</label>
                            <input type="file" class="form-control" id="qr_code_2" name="qr_code_2">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else
    <p class="text-center text-muted">Aucune échéance définie.</p>
    <div class="text-center mt-3">
        <a href="#addEcheanceModal" class="btn btn-success" data-bs-toggle="modal">Ajouter une Échéance</a>
    </div>

    <!-- Modal pour ajouter une échéance -->
    <div class="modal fade" id="addEcheanceModal" tabindex="-1" aria-labelledby="addEcheanceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.parametres.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEcheanceModalLabel">Ajouter une Échéance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="montant_journalier" class="form-label">Montant Journalier</label>
                            <input type="number" class="form-control" id="montant_journalier" name="montant_journalier" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_paiement" class="form-label">Date de Paiement</label>
                            <input type="date" class="form-control" id="date_paiement" name="date_paiement" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_echeance" class="form-label">Date d'Échéance</label>
                            <input type="date" class="form-control" id="date_echeance" name="date_echeance" required>
                        </div>
                        <div class="mb-3">
                            <label for="mode_paiement_1" class="form-label">Mode de Paiement 1</label>
                            <input type="text" class="form-control" id="mode_paiement_1" name="mode_paiement_1">
                        </div>
                        <div class="mb-3">
                            <label for="qr_code_1" class="form-label">QR Code 1</label>
                            <input type="file" class="form-control" id="qr_code_1" name="qr_code_1">
                        </div>
                        <div class="mb-3">
                            <label for="mode_paiement_2" class="form-label">Mode de Paiement 2</label>
                            <input type="text" class="form-control" id="mode_paiement_2" name="mode_paiement_2">
                        </div>
                        <div class="mb-3">
                            <label for="qr_code_2" class="form-label">QR Code 2</label>
                            <input type="file" class="form-control" id="qr_code_2" name="qr_code_2">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Ajouter</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
</div>




@endsection
