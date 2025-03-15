@extends('layouts.app')

@section('content')
@guest
<div class="hero-guest d-flex align-items-center text-center text-light">
    <div class="container">
        <div class="jumbotron bg-transparent">
            <h1 class="display-3 fw-bold fade-in">Bienvenue sur Easysearch <i class="fas fa-table"></i>
            </h1>
            <p class="lead fade-in delay-1">Découvrez une expérience unique et intuitive.</p>
            <hr class="my-4">
            <p class="fade-in delay-2">Inscrivez-vous ou connectez-vous pour commencer.</p>
            <a class="btn btn-primary btn-lg fade-in delay-3" href="{{ route('register') }}" role="button">
                <i class="fas fa-user-plus"></i> S'inscrire
            </a>
            <a class="btn btn-success btn-lg fade-in delay-3" href="{{ route('login') }}" role="button">
                <i class="fas fa-sign-in-alt"></i> Se Connecter
            </a>
        </div>
    </div>
</div>
@endguest
@endsection


<style>
.hero-guest {
    background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4)), 
                url('https://source.unsplash.com/1600x900/?technology,futuristic');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    height: 100vh;
    display: flex;
    justify-content: center;
}

.jumbotron {
    background: rgba(0, 0, 0, 0.5);
    padding: 3rem;
    border-radius: 20px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
}

/* Effet de fade-in */
.fade-in {
    opacity: 0;
    animation: fadeInUp 1s ease-in-out forwards;
}
.delay-1 { animation-delay: 0.5s; }
.delay-2 { animation-delay: 1s; }
.delay-3 { animation-delay: 1.5s; }

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive */
@media (max-width: 768px) {
    .jumbotron {
        padding: 2rem;
    }
    .hero-guest {
        height: 80vh;
    }
}


</style>