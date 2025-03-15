@auth
<header class="hero bg-primary text-light text-center py-5">
    <div class="container">
        <h1 class="display-4 fw-bold">Bienvenue sur EasySearch 🚀</h1>
        <p class="lead">Une plateforme innovante pour simplifier votre quotidien.</p>
        <button id="importButton" class="btn btn-light btn-lg mt-3"><i class="fas fa-rocket"></i> Commencer</button>
    </div>
</header>

<!-- Formulaire pour l'importation du fichier Excel -->
<div id="importForm" class="container mt-5" style="display: none;">
    <h2>Importer un fichier Excel</h2>
    <form action="{{ route('excel.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="excel_file" class="form-label">Choisir un fichier Excel</label>
            <input type="file" class="form-control" id="excel_file" name="excel_file" required>
        </div>
        <button type="submit" class="btn btn-primary">Importer</button>
    </form>
</div>

<script>
    document.getElementById('importButton').addEventListener('click', function() {
        document.getElementById('importForm').style.display = 'block';
    });
</script>
@endauth

<style>
    .hero {
    background: linear-gradient(to right, #007bff, #6610f2);
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.hero h1 {
    font-size: 3rem;
    animation: fadeIn 1s ease-in-out;
}
.hero p {
    font-size: 1.25rem;
    opacity: 0.9;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

</style>