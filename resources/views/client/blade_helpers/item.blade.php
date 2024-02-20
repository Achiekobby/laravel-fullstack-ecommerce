<div class="col-lg-3 col-md-4 col-sm-6 pb-1">
    <div class="product-item bg-light mb-4">
        <div class="product-img position-relative overflow-hidden">
            <img class="img-fluid w-100"
                src="{{ asset('/uploads/products/' . $product->photos['image_one']) }}"
                alt="{{ $product->name }}" />
            <div class="product-action">
                <a class="btn btn-outline-dark btn-square" href=""><i
                        class="fa fa-shopping-cart"></i></a>
                <a class="btn btn-outline-dark btn-square" href=""><i
                        class="far fa-heart"></i></a>
                <a class="btn btn-outline-dark btn-square" href=""><i
                        class="fa fa-sync-alt"></i></a>
                <a class="btn btn-outline-dark btn-square" href="{{route('shop.product.show',['slug'=>$product->slug])}}"><i
                        class="fa fa-search"></i></a>
            </div>
        </div>
        <div class="text-center py-4">
            <a class="h6 text-decoration-none text-truncate" href="{{route('shop.product.show',['slug'=>$product->slug])}}">{{ $product->name }}</a>
            <div class="d-flex align-items-center justify-content-center mt-2">
                @if ($product->sales_price !== 0 || !is_null($product->sales_price))
                    <h5>GHS.{{ $product->sales_price }}</h5>
                @else
                    <h5>GHS.{{ $product->regular_price }}</h5>
                @endif
                <h6 class="text-muted ml-2">
                    @if ($product->sales_price !== 0 || !is_null($product->sales_price))
                        <del>GHS.{{ $product->regular_price }}</del>
                    @endif
                </h6>
            </div>
            <div class="d-flex align-items-center justify-content-center mb-1">
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small>({{$product->quantity}} left)</small>
            </div>
        </div>
    </div>
</div>
