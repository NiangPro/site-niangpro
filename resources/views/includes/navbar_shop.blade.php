 <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center sticky">
      <div class="col-4 pt-1">
          <div class="row">
              <div class="col-6">
                  <a class="text-muted sub-active" href="{{ route('cart.index') }}">Panier <span class="badge badge-pill badge-dark">{{ Cart::count() }}</span></a>

              </div>

          </div>
      </div>
      <div class="col-4 text-center">
      <a class="blog-header-logo text-dark h2" href="{{route("product.index")}}"><img src="{{ asset('images/shop.jpg')}}" alt="" class="avatar-xs"> NiangPro<span class="pro">Shop</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        @include('includes.search')
      </div>
    </div>
  </header>

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
    @foreach (App\Category::all() as $category)
        <a class="p-2 text-muted @if (isset(request()->categorie) && request()->categorie === $category->slug)
            sub-active
        @endif" href="{{ route('product.index', ['categorie'=>$category->slug])}}">{{ $category->name }}</a>

    @endforeach
    </nav>
  </div>
