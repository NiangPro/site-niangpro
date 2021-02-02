@extends('layouts.master')

@section('title')
    Recherche
@endsection

@section('content')
    <div class="container">

        {{-- Produits --}}
        <div class="row mb-2">
            @foreach ($products as $product)
                <div class="col-md-6">
                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary ml-2 h4">
                                @foreach ($product->categories as $category)
                                    {{ $category->name }}
                                @endforeach
                            </strong>
                            <h4 class="mb-0">{{ $product->title }}</h4>
                            <div class="mb-1 text-muted">
                                {{ $product->created_at->format('d/m/Y') }}
                            </div>
                            <p class="card-text mb-auto">
                                {{ $product->subtitle }}
                            </p>
                            <strong class="card-text mb-auto h1 ml-3">{{ $product->getFormattedPrice() }}</strong>
                            <a href="{{ route('product.show', $product->slug) }}" class="stretched-link btn btn-default">Voir larticle</a>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="{{ asset('storage/'.$product->image) }}" alt="">
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $products->appends(request()->input())->links() }}
        </div>
    </div>
@endsection
