@extends('template')

@section('main')
<div class="container mt-4">
    <h1 class="mb-4">Gestion des Utilisateurs</h1>

    <div class="card mb-5 shadow-sm border-0">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Nouvel Utilisateur</h5>
        </div>
        <div class="card-body bg-light">
            <form action="{{ url('/web/utilisateurs') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="nom_user" class="form-control" placeholder="Nom" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="prenom_user" class="form-control" placeholder="Prénom" required>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="login_user" class="form-control" placeholder="Login" required>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="tel_user" class="form-control" placeholder="Téléphone" required>
                    </div>
                    <div class="col-md-2">
                        <select name="sex_user" class="form-select" required>
                            <option value="M">Masculin</option>
                            <option value="F">Féminin</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">Créer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3">Code</th>
                        <th>Nom & Prénom</th>
                        <th>Téléphone</th>
                        <th>Rôle</th>
                        <th>État</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($utilisateurs as $user)
                        <tr>
                            <td class="ps-3">{{ $user->code_user }}</td>
                            <td>{{ $user->nom_user }} {{ $user->prenom_user }} <br> <small class="text-muted">{{ $user->login_user }}</small></td>
                            <td>{{ $user->tel_user }}</td>
                            <td><span class="badge bg-secondary">{{ $user->role_user }}</span></td>
                            <td>
                                <span class="badge {{ $user->etat_user == 'actif' ? 'bg-success' : ($user->etat_user == 'bloquer' ? 'bg-danger' : 'bg-warning') }}">
                                    {{ $user->etat_user }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editUser{{ $user->code_user }}">
                                    Modifier
                                </button>
                                <form action="{{ url('/web/utilisateurs/'.$user->code_user) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="editUser{{ $user->code_user }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ url('/web/utilisateurs/'.$user->code_user) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modifier {{ $user->nom_user }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <label class="form-label">Nom</label>
                                                    <input type="text" name="nom_user" class="form-control" value="{{ $user->nom_user }}">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Prénom</label>
                                                    <input type="text" name="prenom_user" class="form-control" value="{{ $user->prenom_user }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Téléphone</label>
                                                    <input type="text" name="tel_user" class="form-control" value="{{ $user->tel_user }}">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Rôle</label>
                                                    <select name="role_user" class="form-select">
                                                        <option value="admin" {{ $user->role_user == 'admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="technicien" {{ $user->role_user == 'technicien' ? 'selected' : '' }}>Technicien</option>
                                                        <option value="client" {{ $user->role_user == 'client' ? 'selected' : '' }}>Client</option>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">État</label>
                                                    <select name="etat_user" class="form-select">
                                                        <option value="actif" {{ $user->etat_user == 'actif' ? 'selected' : '' }}>Actif</option>
                                                        <option value="inactif" {{ $user->etat_user == 'inactif' ? 'selected' : '' }}>Inactif</option>
                                                        <option value="bloquer" {{ $user->etat_user == 'bloquer' ? 'selected' : '' }}>Bloqué</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white">
            {{ $utilisateurs->links() }}
        </div>
    </div>
</div>
@endsection
