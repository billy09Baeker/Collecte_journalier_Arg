@extends('admin.welcome')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Gestion des Clients</h2>
        <!-- Bouton d'ouverture du modal -->

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
                    <th>Solde (FCFA)</th>
                    <th class="text-center">Détails</th>
                    <th class="text-center">Supprimer</th>
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
                    <td>{{ number_format($client->solde, 0, ',', ' ') }}</td>
                    <td class="text-center">
                        <a href="{{ route('client.details', $client->id) }}" class="btn btn-sm btn-outline-primary" title="Voir les détails"><i class="bi bi-eye"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <form action="{{ route('client.destroy', $client->id) }}" method="POST" class="d-inline"
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

                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Aucun client enregistré.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>



@endsection
