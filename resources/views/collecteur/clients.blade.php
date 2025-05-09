@extends('collecteur.welcome')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Gestion des Clients</h2>
        <!-- Bouton d'ouverture du modal -->
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addCollecteurModal">
                <i class="bi bi-plus-circle me-1"></i> Ajouter un client
            </button>
    </div>

    <div class="table-responsive shadow-sm">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Sexe</th>
                    <th>Email</th>
                    <th>Téléphone</th>

                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td>{{ $client->nom }}</td>
                    <td>{{ $client->prenom }}</td>
                    <td>{{ ucfirst($client->sexe) }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->telephone }}</td>

                </tr>
                <!-- Modal pour modifier le client -->
                <tr>
                    <!-- Modal d'édition pour un client -->
                    <div class="modal fade" id="editModal{{ $client->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $client->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('collecteur.client.update', $client->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $client->id }}">Modifier le client</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Nom</label>
                                                <input type="text" name="nom" class="form-control" value="{{ $client->nom }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Prénom</label>
                                                <input type="text" name="prenom" class="form-control" value="{{ $client->prenom }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Date de naissance</label>
                                                <input type="date" name="date_naissance" class="form-control" value="{{ $client->date_naissance }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Lieu de naissance</label>
                                                <input type="text" name="lieu_naissance" class="form-control" value="{{ $client->lieu_naissance }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Sexe</label>
                                                <select name="sexe" class="form-select" required>
                                                    <option value="masculin" {{ $client->sexe == 'masculin' ? 'selected' : '' }}>Masculin</option>
                                                    <option value="féminin" {{ $client->sexe == 'féminin' ? 'selected' : '' }}>Féminin</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Téléphone</label>
                                                <input type="text" name="telephone" class="form-control" value="{{ $client->telephone }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" value="{{ $client->email }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Adresse</label>
                                                <input type="text" name="adresse" class="form-control" value="{{ $client->adresse }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nouveau mot de passe <small class="text-muted">(optionnel)</small></label>
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Confirmation mot de passe</label>
                                                <input type="password" name="password_confirmation" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Enregistrer</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Aucun client enregistré.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($clients->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $clientsw->links() }}
    </div>
@endif
</div>



<!-- Modal Multi-étapes -->
<div class="modal fade" id="addCollecteurModal" tabindex="-1" aria-labelledby="addCollecteurLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('collecteur.client.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <!-- Étapes -->
                    <div id="step-1" class="step">
                        <h6>Informations personnelles</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" name="nom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" name="prenom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="date_naissance" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control" name="date_naissance" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lieu_naissance" class="form-label">Lieu de naissance</label>
                                <input type="text" class="form-control" name="lieu_naissance" required>
                            </div>
                            <div class="col-md-6">
                                <label for="sexe" class="form-label">Sexe</label>
                                <select name="sexe" class="form-select" required>
                                    <option value="">-- Choisir --</option>
                                    <option value="masculin">Masculin</option>
                                    <option value="féminin">Féminin</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="step-2" class="step d-none">
                        <h6>Coordonnées</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Adresse email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" name="telephone" required>
                            </div>
                            <div class="col-12">
                                <label for="adresse" class="form-label">Adresse complète</label>
                                <input type="text" class="form-control" name="adresse" required>
                            </div>
                        </div>
                    </div>

                    <div id="step-3" class="step d-none">
                        <h6>Sécurité</h6>
                        <div class="row">
                            <div class="col-12">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation entre étapes -->
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" id="prevStep" disabled>Précédent</button>
                    <button type="button" class="btn btn-primary" id="nextStep">Suivant</button>
                    <button type="submit" class="btn btn-success d-none" id="submitBtn">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    const steps = document.querySelectorAll('.step');
    const nextBtn = document.getElementById('nextStep');
    const prevBtn = document.getElementById('prevStep');
    const submitBtn = document.getElementById('submitBtn');
    let currentStep = 0;

    function updateSteps() {
        steps.forEach((step, index) => {
            step.classList.toggle('d-none', index !== currentStep);
        });
        prevBtn.disabled = currentStep === 0;
        nextBtn.classList.toggle('d-none', currentStep === steps.length - 1);
        submitBtn.classList.toggle('d-none', currentStep !== steps.length - 1);
    }

    nextBtn.addEventListener('click', () => {
        if (currentStep < steps.length - 1) {
            currentStep++;
            updateSteps();
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 0) {
            currentStep--;
            updateSteps();
        }
    });

    updateSteps();
</script>

@endsection
