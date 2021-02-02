@extends('layouts.master')

@section('title')
    Info-produit
@endsection

@section('content')
    <div class="container ">
        <div class="col-md-12">
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-3 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-default h3">
                        @foreach ($product->categories as $category)
                                    {{ $category->name }}
                                @endforeach
                    </strong>
                    <h3 class="mb-0">{{ $product->title }}</h3>
                    <div class="mb-1 text-muted">
                                {{ $product->created_at->format('d/m/Y') }}
                    </div>
                    <p class="card-text mb-auto">
                                {!! $product->description !!}
                    </p>
                    <strong class="card-text mb-auto display-4">{{ $product->getFormattedPrice() }}</strong>
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-dark">Ajouter au panier</button>
                    </form>
                     </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="{{ asset('storage/'.$product->image) }}" alt="" height="300" id="mainImage" width="300">
                            <div class="mt-2 mb-2">
                                @if ($product->images)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="" width="60" class="img-thumbnail" height="50" >
                                @foreach (json_decode($product->images, true) as $image)
                                <img src="{{ asset('storage/'.$image) }}" alt="" width="60" class="img-thumbnail" height="50">
                                @endforeach
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
    </div>
@endsection

@section('extra-js')
    <script>
        var mainImage = document.querySelector("#mainImage")
        var thumbnails = document.querySelectorAll(".img-thumbnail");


        thumbnails.forEach((element) => element.addEventListener('click', changeImage));

        function changeImage(e)
        {
            mainImage.src = this.src;
        }
    </script>
@endsection
