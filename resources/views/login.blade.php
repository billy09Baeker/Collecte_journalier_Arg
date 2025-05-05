<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Collecte - Connexion</title>

    <!-- Lien vers Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body {

            background-color: #f8f9fa; /* Couleur de fond plus douce */

        }

        .card {

            border-radius: 1rem; /* Coins arrondis pour la carte */

        }

    </style>

</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">

        <!-- Success Message -->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <h2 class="text-center mb-4">Connexion</h2>

        <form action="{{ route('login') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label for="email" class="form-label">Email</label>

                <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre email" required>

            </div>

            <div class="mb-3">

                <label for="password" class="form-label">Mot de passe</label>

                <input type="password" id="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" required>

            </div>

            <button type="submit" class="btn btn-primary w-100">Se connecter</button>

        </form>

        <div class="mt-3 text-center">

            <p class="mb-0">Vous n'avez pas de compte ? <a href="{{ route('register') }}" class="link-primary">Inscrivez-vous</a></p>

        </div>

    </div>


    <!-- Lien vers Bootstrap JS (optionnel pour les composants interactifs) -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
