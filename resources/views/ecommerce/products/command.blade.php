@extends('layouts.master')

@section('title')
    Commandes
@endsection
@section('content')
    <div class="container">
        @foreach (Auth()->user()->order as $order)
            <div class="card">
                <div class="card-header">
                Commande passée le {{ Carbon\Carbon::pars($order->payment_created_at) }} d'un montant de <strong>{{ getPrice($order->amount) }}</strong>
                </div>
                <div class="card-body">
                    <h6>Liste des produits</h6>
                    @foreach (unserialize($order->products) as $product)
                    <div>Nom du produit : {{ $product[0] }}</div>
                    <div>Prix : {{ getPrice($product[1]) }}</div>
                    <div>Quantité : {{ $product[2] }}</div>
                    <hr>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
