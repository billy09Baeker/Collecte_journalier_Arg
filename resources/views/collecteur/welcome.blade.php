<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Inclure Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0d6efd;">
        <div class="container-fluid">
          <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-wallet2 me-2"></i> MaCollecte
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link active" href="{{route('admin.dashboard')}}"><i class="bi bi-speedometer2 me-1"></i> Tableau de bord</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.collecteurs') }}"><i class="bi bi-receipt me-1"></i> Collecteurs</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.clients') }}"><i class="bi bi-bell me-1"></i> Clients</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.suivi-paiements') }}"><i class="bi bi-gear me-1"></i> Transactions</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.performances')}}"><i class="bi bi-gear me-1"></i> Performances</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.parametres')}}"><i class="bi bi-gear me-1"></i> Paramètres</a>
              </li>

              <li class="nav-item">
                <a class="nav-link text-warning" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right me-1"></i> Déconnexion</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>




    <!-- Main Content -->
    <div class="container main mt-4">
        <section>
            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield("content")
        </section>
    </div>

<!-- Footer -->
<footer class="bg-dark text-white mt-5">
    <div class="container py-4">
        <div class="row">
            <!-- À propos -->
            <div class="col-md-4 mb-3">
                <h5>À propos</h5>
                <p>MaCollecte est une solution digitale de gestion des collectes journalières. Suivez vos paiements, collectes et clients en temps réel.</p>
            </div>

            <!-- Liens rapides -->
            <div class="col-md-4 mb-3">
                <h5>Navigation</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">Tableau de bord</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Collectes</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Clients</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Paiements</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-md-4 mb-3">
                <h5>Contact</h5>
                <p>Email : support@macollecte.com</p>
                <p>Téléphone : +237 6 99 00 00 00</p>
                <div>
                    <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
        <hr class="border-top border-light">
        <div class="text-center">
            <small>&copy; {{ date('Y') }} MaCollecte. Tous droits réservés.</small>
        </div>
    </div>
</footer>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
