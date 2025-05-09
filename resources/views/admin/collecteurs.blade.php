@extends('admin.welcome')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Gestion des Collecteurs</h2>
        <!-- Bouton d'ouverture du modal -->
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addCollecteurModal">
                <i class="bi bi-plus-circle me-1"></i> Ajouter un collecteur
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
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($collecteurs as $collecteur)
                <tr>
                    <td>{{ $collecteur->nom }}</td>
                    <td>{{ $collecteur->prenom }}</td>
                    <td>{{ ucfirst($collecteur->sexe) }}</td>
                    <td>{{ $collecteur->email }}</td>
                    <td>{{ $collecteur->telephone }}</td>
                    <td class="text-center">
                        <!-- Bouton Modifier (ex: dans chaque ligne du tableau) -->
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $collecteur->id }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                        <form action="{{ route('collecteurs.destroy', $collecteur->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce collecteur ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Supprimer">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <!-- Modal pour modifier le collecteur -->
                <tr>
                    <!-- Modal d'édition pour un collecteur -->
                    <div class="modal fade" id="editModal{{ $collecteur->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $collecteur->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('admin.collecteur.update', $collecteur->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $collecteur->id }}">Modifier le collecteur</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Nom</label>
                                                <input type="text" name="nom" class="form-control" value="{{ $collecteur->nom }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Prénom</label>
                                                <input type="text" name="prenom" class="form-control" value="{{ $collecteur->prenom }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Date de naissance</label>
                                                <input type="date" name="date_naissance" class="form-control" value="{{ $collecteur->date_naissance }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Lieu de naissance</label>
                                                <input type="text" name="lieu_naissance" class="form-control" value="{{ $collecteur->lieu_naissance }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Sexe</label>
                                                <select name="sexe" class="form-select" required>
                                                    <option value="masculin" {{ $collecteur->sexe == 'masculin' ? 'selected' : '' }}>Masculin</option>
                                                    <option value="féminin" {{ $collecteur->sexe == 'féminin' ? 'selected' : '' }}>Féminin</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Téléphone</label>
                                                <input type="text" name="telephone" class="form-control" value="{{ $collecteur->telephone }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" value="{{ $collecteur->email }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Adresse</label>
                                                <input type="text" name="adresse" class="form-control" value="{{ $collecteur->adresse }}">
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
                    <td colspan="6" class="text-center text-muted">Aucun collecteur enregistré.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($collecteurs->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $collecteursw->links() }}
    </div>
@endif
</div>



<!-- Modal Multi-étapes -->
<div class="modal fade" id="addCollecteurModal" tabindex="-1" aria-labelledby="addCollecteurLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.collecteur.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un collecteur</h5>
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
