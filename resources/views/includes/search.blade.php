<form action="{{ route('product.search') }}" class="d-flex mr-0">
    @csrf
    <div class="form-group mb-0 mr-1 mt-4">

    <input  type="text" class="form-control @error('email') is-invalid @enderror" name="q" value="{{ request()->q ?? ''}}" required autocomplete="q">

    @error('q')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    <button type="submit" class="btn btn-default btn-sm pb-0 pt-0 mt-3">Search</button>
</form>
