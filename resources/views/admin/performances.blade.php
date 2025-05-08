<!-- filepath: d:\CSI 3\SEMESTRE 2\DEVELOPPEMENT BACK-END PHP\Collect_project\collecte-journaliere\resources\views\admin\performances.blade.php -->
@extends('admin.welcome')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5 display-5 fw-bold">Performances des Collecteurs</h1>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Clients enrollés</th>
                    <th>Montant Total Collecté (FCFA)</th>
                    <th>Détails</th>
                </tr>
            </thead>
            <tbody>
                @forelse($collecteurs as $collecteur)
                <tr>
                    <td>{{ $collecteur->nom }}</td>
                    <td>{{ $collecteur->prenom }}</td>
                    <td>{{ $collecteur->email }}</td>
                    <td>{{ $collecteur->nombre_clients }}</td>
                    <td>{{ number_format($collecteur->montant_total_collecte, 0, ',', ' ') }}</td>
                    <td class="text-center">
                        <a href="{{ route('collecteur.details', $collecteur->id) }}" class="btn btn-sm btn-outline-primary" title="Voir les détails"><i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Aucun collecteur trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
