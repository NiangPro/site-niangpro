@extends('layouts.master')

@section('title')
    Accueil - NiangProCodeur
@endsection

@section('content')
    <div class="container-fluid home">
        <div class="container col-md-5 mr-auto p-5">
            <p class="p-5 m-5">
				Niang<span class="pro">Pro</span><sub>Codeur</sub> est le réseau des dévéloppeurs.<br>
				Dans le souci de permettre aux développeurs déclencher avec
				leurs collègues et camarades, nous avons envisagé de mettre
				en place une plateforme d'échanges et de partage entre
				développeurs pour la mutualisation de leurs expériences et
                de leurs savoir .<br>
                @if (Auth::user())
                Alors n'hésitez plus et <a href="{{ route('register') }}">rejoignez dès maintenant la communauté Niang<span class="pro">Pro</span><sub>Codeur</sub></a><br>
                @endif
			</p>
        </div>
    </div>
@endsection
