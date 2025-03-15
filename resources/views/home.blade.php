@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="container py-3">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2>Importation et Exportation de Fichiers Excel</h2>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('excel.export') }}" class="btn btn-success">
                    <i class="fas fa-file-export"></i> Exporter Excel
                </a>
            </div>
        </div>

        <!-- Formulaire d'importation -->
        <form action="{{ route('excel.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Sélectionner un fichier Excel</label>
                <input type="file" class="form-control" name="file" id="file" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">
                <i class="fas fa-upload"></i> Importer
            </button>
        </form>

        @if ($files->isNotEmpty())
            <!-- Barre de recherche -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par nom ou email...">
                </div>
            </div>

            <h3 class="mt-5">Liste des Données</h3>
            <table class="table table-bordered mt-3" id="dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($files as $file)
                        <tr>
                            <td>{{ $file->id }}</td>
                            <td class="searchable">{{ $file->nom }}</td>
                            <td class="searchable">{{ $file->email }}</td>
                            <td>{{ $file->telephone }}</td>
                            <td>
                                <!-- Lien pour voir le fichier -->
                                <a href="{{ route('view.file', ['id' => $file->id]) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Voir
                                </a>

                                <!-- Formulaire pour supprimer le fichier -->
                                <form action="{{ route('delete.file', $file->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Voulez-vous vraiment supprimer ce fichier ?')">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>

                                <!-- Bouton pour modifier (ouvre la modal) -->
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $file->id }}">
                                    <i class="fas fa-edit"></i> Modifier
                                </button>
                            </td>
                        </tr>

                        <!-- Modal pour éditer le fichier -->
                        <div class="modal fade" id="editModal{{ $file->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $file->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $file->id }}">Modifier le Fichier</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('update.file', $file->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nom">Nom</label>
                                                <input type="text" name="nom" class="form-control" value="{{ $file->nom }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control" value="{{ $file->email }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="telephone">Téléphone</label>
                                                <input type="text" name="telephone" class="form-control" value="{{ $file->telephone }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>

        @else
            <div class="alert alert-warning mt-4">
                <i class="fas fa-exclamation-circle"></i> Aucun fichier importé pour le moment.
            </div>
        @endif
    </div>

    <!-- Script pour la recherche en direct -->
    <script>
        document.getElementById("searchInput").addEventListener("keyup", function () {
            let searchValue = this.value.toLowerCase();
            let rows = document.querySelectorAll("#dataTable tbody tr");

            rows.forEach(row => {
                let text = row.querySelector(".searchable").textContent.toLowerCase();
                row.style.display = text.includes(searchValue) ? "" : "none";
            });
        });
    </script>

    <!-- Bootstrap JS (Si ce n'est pas déjà dans ton layout) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
