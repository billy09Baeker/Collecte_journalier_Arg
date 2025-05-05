<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Collecte - Inscription</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 1rem;
            width: 100%;
            max-width: 600px;
        }
        .form-step {
            display: none;
        }
        .form-step.active {
            display: block;
        }
        .progress-container {
            height: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        .progress-bar {
            height: 100%;
            background-color: #0d6efd;
            width: 0%;
            transition: width 0.3s ease-in-out;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
<div class="card shadow-sm p-4">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <h2 class="text-center mb-4">Inscription</h2>

    <div class="progress-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <form id="multiStepForm" action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-step active">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" id="nom" name="nom" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" id="prenom" name="prenom" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="date_naissance" class="form-label">Date de naissance</label>
                <input type="date" id="date_naissance" name="date_naissance" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="lieu_naissance" class="form-label">Lieu de naissance</label>
                <input type="text" id="lieu_naissance" name="lieu_naissance" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Sexe</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexe" id="sexe_masculin" value="masculin" required>
                        <label class="form-check-label" for="sexe_masculin">Masculin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexe" id="sexe_feminin" value="feminin" required>
                        <label class="form-check-label" for="sexe_feminin">Féminin</label>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary w-100 next-step">Suivant</button>
        </div>

        <div class="form-step">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="tel" id="telephone" name="telephone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" id="adresse" name="adresse" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary prev-step">Précédent</button>
                <button type="button" class="btn btn-primary next-step">Suivant</button>
            </div>
        </div>

        <div class="form-step">
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary prev-step">Précédent</button>
                <button type="submit" class="btn btn-success">S'inscrire</button>
            </div>
        </div>
    </form>

    <div class="mt-3 text-center">
        <p class="mb-0">Déjà un compte ? <a href="{{ route('login') }}" class="link-primary">Connectez-vous</a></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const steps = document.querySelectorAll('.form-step');
    const progressBar = document.getElementById('progressBar');
    let currentStep = 0;

    function updateProgressBar() {
        const progress = ((currentStep + 1) / steps.length) * 100;
        progressBar.style.width = `${progress}%`;
    }

    document.querySelectorAll('.next-step').forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep < steps.length - 1) {
                steps[currentStep].classList.remove('active');
                currentStep++;
                steps[currentStep].classList.add('active');
                updateProgressBar();
            }
        });
    });

    document.querySelectorAll('.prev-step').forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep > 0) {
                steps[currentStep].classList.remove('active');
                currentStep--;
                steps[currentStep].classList.add('active');
                updateProgressBar();
            }
        });
    });

    updateProgressBar();
</script>
</body>
</html>
