<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Collectes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .table thead {
            background-color: #212529;
            color: white;
        }
        .table tbody tr td {
            vertical-align: middle;
        }
        .btn i {
            margin-right: 4px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="bi bi-camera-fill"></i> Gestion des Collectes</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-grid"></i> Tableau de bord</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-person-lines-fill"></i> Collectes</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-people"></i> Clients</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-bar-chart"></i> Rapports</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-bell"></i> Notifications</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-gear"></i> Paramètres</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="bi bi-clipboard2"></i> Gestion des Collectes</h3>
        <a href="#" class="btn btn-success"><i class="bi bi-plus-circle"></i> Ajouter une Collecte</a>
    </div>

    <table class="table table-bordered shadow-sm">
        <thead>
            <tr>
                <th><i class="bi bi-calendar3"></i> Date</th>
                <th><i class="bi bi-person-bounding-box"></i> Collecteur</th>
                <th><i class="bi bi-cash-coin"></i> Montant Collecté</th>
                <th><i class="bi bi-person-vcard"></i> Client</th>
                <th><i class="bi bi-gear-fill"></i> Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2025-04-03</td>
                <td>Paul Kamga</td>
                <td>15 000 FCFA</td>
                <td>Jean Dupont</td>
                <td>
                    <a href="#" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil-square"></i> Modifier</a>
                    <a href="#" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> Supprimer</a>
                    <a href="#" class="btn btn-outline-success btn-sm"><i class="bi bi-receipt"></i> Générer Reçu</a>
                </td>
            </tr>
            <tr>
                <td>2025-03-31</td>
                <td>Marie Claire</td>
                <td>8,500 FCFA</td>
                <td>Marie Claire</td>
                <td>
                    <a href="#" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil-square"></i> Modifier</a>
                    <a href="#" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> Supprimer</a>
                    <a href="#" class="btn btn-outline-success btn-sm"><i class="bi bi-receipt"></i> Générer Reçu</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
