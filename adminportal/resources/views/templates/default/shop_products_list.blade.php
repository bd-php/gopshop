@extends($theme.'.shop_layout')
@section('banner')
@endsection

@section('content')
  <div class="features_items">
    <h2 class="title text-center">{{ $title }}</h2>
      @if (count($products) ==0)
        Not found content!
      @else
          @foreach ($products as  $key => $product)
          <div class="col-sm-4 col-xs-6">
              <div class="product-image-wrapper">
                <div class="single-products">
                  <div class="productinfo text-center product-box-{{ $product->id }}">
                    <a href="{{ $product->getUrl() }}"><img src="{{ asset($product->getThumb()) }}" alt="{{ $product->name }}" /></a>

                    {!! $product->showPrice() !!}

                    <a href="{{ $product->getUrl() }}"><p>{{ $product->name }}</p></a>
                    <a href="#" class="btn btn-default add-to-cart" onClick="addToCart({{ $product->id }})"><i class="fa fa-shopping-cart"></i>{{trans('language.add_to_cart')}}</a>
                  </div>
                  @if ($product->price != $product->getPrice())
                  <img src="{{ asset($theme_asset.'/images/home/sale.png') }}" class="new" alt="" />
                  @elseif($product->type == 1)
                  <img src="{{ asset($theme_asset.'/images/home/new.png') }}" class="new" alt="" />
                  @endif
                </div>
                <div class="choose">
                  <ul class="nav nav-pills nav-justified">
                    <li><a href="#" onClick="addToCart({{ $product->id }},'wishlist')"><i class="fa fa-plus-square"></i>{{trans('language.add_to_wishlist')}}</a></li>
                    <li><a href="#" onClick="addToCart({{ $product->id }},'compare')"><i class="fa fa-plus-square"></i>{{trans('language.add_to_compare')}}</a></li>
                  </ul>
                </div>
              </div>
          </div>
          @endforeach
      @endif
<div style="clear: both; ">
    <ul class="pagination">
      {{ $products->links() }}
  </ul>
</div>

</div>
@endsection


@section('breadcrumb')
    <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li class="active">{{ $title }}</li>
        </ol>
      </div>
@endsection


@push('styles')
@endpush
@push('scripts')
@endpush
