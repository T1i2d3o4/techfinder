@extends('template')

@section('main')
<div class="container mt-4">
    <h1 class="mb-4">Gestion des Compétences</h1>



    <div class="card mb-5 shadow-sm border-0">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Ajouter une nouvelle compétence</h5>
        </div>
        <div class="card-body bg-light">
            <form action="{{ url('/web/competences') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="label_compo" class="form-control" placeholder="Nom (ex: Laravel)" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="description_comp" class="form-control" placeholder="Description courte" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">Ajouter</button>
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
                        <th>Label</th>
                        <th>Description</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($competences_list as $competence)
                        <tr>
                            <td class="ps-3">{{ $competence->code_comp }}</td>
                            <td><span class="badge bg-info text-dark">{{ $competence->label_compo }}</span></td>
                            <td>{{ $competence->description_comp }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $competence->code_comp }}">
                                    Modifier
                                </button>

                                <form action="{{ url('/web/competences/'.$competence->code_comp) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="editModal{{ $competence->code_comp }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ url('/web/competences/'.$competence->code_comp) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modifier : {{ $competence->label_compo }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label text-start d-block">Label</label>
                                                <input type="text" name="label_compo" class="form-control" value="{{ $competence->label_compo }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-start d-block">Description</label>
                                                <textarea name="description_comp" class="form-control" rows="3" required>{{ $competence->description_comp }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white py-3">
            <div class="d-flex justify-content-center">
                {{ $competences_list->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
