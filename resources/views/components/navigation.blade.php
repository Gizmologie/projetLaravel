<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">
        <img src="{{ '/images/logo_small.png' }}" class="img-fluid" width="50px" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">Liste</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Promotion</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Nouveautés</a>
            </li>
        </ul>
    </div>
    <div class="collapse navbar-collapse mr-5" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            @if(\Illuminate\Support\Facades\Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-lg fa-user mr-1"></i>{{ \Illuminate\Support\Facades\Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('profil')}}">Mon compte</a>
                        <a class="dropdown-item" href="{{route('logout')}}">Déconnexion</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{route('cart')}}" class="notification nav-link">
                        <span><i class="fas fa-lg fa-shopping-cart"></i></span>
                        <span class="badge d-none js-cart-total">0</span>
                    </a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->roles == 'admin')

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Administration
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('adminUser')}}">Utilisateurs</a>
                            <a class="dropdown-item" href="{{route('adminProduct')}}">Produits</a>
                        </div>
                    </li>
                @endif

            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}">Inscription</a>
                </li>

            @endif


        </ul>
    </div>



</nav>
