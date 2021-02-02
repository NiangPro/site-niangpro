<nav class="navbar fixed-top navbar-expand-lg navbar-dark">
  <a href="#" class="navbar-brand pl-5"
    >Niang<span class="pro">Pro</span><sub>Codeur</sub> </a>
  <button
    class="navbar-toggler"
    type="button"
    data-toggle="collapse"
    data-target="#navbarNav"
    aria-controls="navbarNav"
    aria-expanded="false"
    aria-label="Toggle navigation"
  >
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto text-center">
       <li class="nav-item active ">
        <a href="{{ route('welcom') }}" class="nav-link"> Accueil</a>
      </li>
      @guest

      <li class="nav-item">
        <a href="{{ route('register') }}" class="nav-link"> Inscription</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('login') }}" class="nav-link"> Connexion</a>
      </li>
      @else
        <li class="nav-item ">
          <a href="" class="nav-link "> Dashboard</a>
        </li>
        <li class="nav-item ">
        <a href="{{ route('product.index') }}" class="nav-link"> Boutique</a>
        </li>


        <li class="nav-item">
        <a class="nav-link waves-effect waves-light" href="{{ route(config('chatify.path'))}}">1
                <i class="fa fa-envelope"></i>Messages
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('/images/portrait_defaut.png') }}" class="rounded-circle avatar-xs z-depth-0"
            alt="avatar image"></a>
            <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                <a class="dropdown-item" href="">Mon profil</a>
                <a class="dropdown-item" href="">Créer un post</a>
            <a class="dropdown-item" href="" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Déconnexion</a>

            <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">@csrf</form>
            </div>
        </li>

      @endguest
    </ul>
  </div>

</nav>

@if (isset($current_page) && $current_page === "shop")

<div class="container sticky-top pt-5 bg-white">
    @include('includes.navbar_shop')
</div>

@if (request()->input('q'))
           <div class="container col-md-8">
                <h4 class="alert alert-success text-center">
            {{ $products->total() }} résutat(s) pour la recherche "{{ request()->q }}"
            </h4>
           </div>
        @endif

@endif
