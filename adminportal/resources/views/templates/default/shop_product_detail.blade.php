@extends($theme.'.shop_layout')
@section('banner')
@endsection

@section('content')
          <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
              <div class="view-product">
                <img src="{{ asset($product->getImage()) }}" alt="" />
              </div>
          @if ($product->images->count())
              <div id="similar-product" class="carousel slide" data-ride="carousel">
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                    <div class="item active">
                        <a href="#" class="col-sm-4">
                          <img src="{{ asset($product->getThumb()) }}" alt="">
                        </a>
                       @foreach ($product->images as $key=>$image)
                        <a href="#" class="col-sm-4">
                          <img src="{{ asset($image->getThumb()) }}" alt="">
                        </a>
                          @if ($key % 3 == 1)
                            </div>
                            <div class="item">
                          @endif
                        @endforeach
                    </div>
                  </div>
                  <!-- Controls -->
                  <a class="left item-control" href="#similar-product" data-slide="prev">
                  <i class="fa fa-angle-left"></i>
                  </a>
                  <a class="right item-control" href="#similar-product" data-slide="next">
                  <i class="fa fa-angle-right"></i>
                  </a>
              </div>
          @endif
            </div>

        <form id="buy_block" action="{{ route('postCart') }}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="product_id" value="{{ $product->id }}" />
            <div class="col-sm-7">
              <div class="product-information"><!--/product-information-->
                @if ($product->price != $product->getPrice())
                <img src="{{ asset($theme_asset.'/images/home/sale2.png') }}" class="newarrival" alt="" />
                @elseif($product->type == 1)
                <img src="{{ asset($theme_asset.'/images/home/new2.png') }}" class="newarrival" alt="" />
                @endif
                <h2>{{ $product->name }}</h2>
                <p>SKU: {{ $product->sku }}</p>
                  {!! $product->showPrice() !!}
                <span>
                  <label>Quantity:</label>
                  <input type="number" name="qty" value="1" />
                  <button type="submit" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                    {{trans('language.add_to_cart')}}
                  </button>
                </span>
                @if ($product->attGroupBy())
                <div class="form-group">
                  @foreach ($product->attGroupBy() as $keyAtt => $attributes)
                    @if ($attributesGroup[$keyAtt]['type'] =='select')
                    <div class="input-group">
                      <label>{{ $attributesGroup[$keyAtt]['name'] }}:</label>
                       <select class="form-control" style="max-width: 100px;" name="attribute[{{ $keyAtt }}]">
                        @foreach ($attributes as $attribute)
                          <option value="{{ $attribute->name }}" {{ ($k ==0)?'selected':'' }}> {{ $attribute->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    @elseif($attributesGroup[$keyAtt]['type'] =='radio')
                     <div class="input-group">
                      <label>{{ $attributesGroup[$keyAtt]['name'] }}:</label><br>
                      @foreach ($attributes as $k => $attribute)
                        <label class="radio-inline"><input type="radio" name="attribute[{{ $keyAtt }}]" value="{{ $attribute->name }}" {{ ($k ==0)?'checked':'' }}> {{ $attribute->name }}</label>
                      @endforeach
                    </div>
                    @endif
                  @endforeach
                </div>
                @endif
                <p><b>Availability:</b>
                @if ($configs['show_date_available'] && $product->date_available >= date('Y-m-d H:i:s'))
                {{ $product->date_available }}
                @else
                In Stock
                @endif
              </p>
                <p><b>Condition:</b> New</p>
                <p><b>Brand:</b> {{ empty($product->brand->name)?'None':$product->brand->name }}</p>
                <div class="short-description">
                  <b>Quick Overview:</b>
                  <p>{{ $product->description }}</p>
                </div>
              <div class="addthis_inline_share_toolbox_yprn"></div>
              </div><!--/product-information-->
            </div>
          </div><!--/product-details-->
        </form>

          <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                <li><a href="#reviews" data-toggle="tab">Comment</a></li>
              </ul>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade  active in" id="details" >
                {!! $product->content !!}
              </div>

              <div class="tab-pane fade" id="reviews" >
                <div class="col-sm-12">
<div class="fb-comments" data-href="{{ $product->getUrl() }}" data-numposts="5"></div>
                </div>
              </div>

            </div>
          </div><!--/category-tab-->

          <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">{{ trans('language.recommended_items') }}</h2>

            <div id="recommended-item-carousel" class="carousel slide">
              <div class="carousel-inner">
               @foreach ($productsToCategory as  $key => $product_real)
                @if ($key % 4 == 0)
                  <div class="item {{  ($key ==0)?'active':'' }}">
                @endif
                  <div class="col-sm-3">
                    <div class="product-image-wrapper">
                      <div class="single-products   product-box-{{ $product_real->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product_real->getUrl() }}"><img src="{{ asset($product_real->getThumb()) }}" alt="{{ $product_real->name }}" /></a>
                        {!! $product_real->showPrice() !!}
                            <a href="{{ $product_real->getUrl() }}"><p>{{ $product_real->name }}</p></a>
                          </div>
                          @if ($product_real->price != $product_real->getPrice())
                          <img src="{{ asset($theme_asset.'/images/home/sale.png') }}" class="new" alt="" />
                          @elseif($product_real->type == 1)
                          <img src="{{ asset($theme_asset.'/images/home/new.png') }}" class="new" alt="" />
                          @endif
                      </div>
                    </div>
                  </div>
                @if ($key % 4 == 3)
                  </div>
                @endif
               @endforeach
              </div>
            </div>
          </div><!--/recommended_items-->
@endsection

@section('breadcrumb')
@endsection

@push('styles')

@endpush
@push('scripts')
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5bd09e60b8c26cab"></script>
@endpush
