@extends('client_layout.app')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('home.index') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('home.shop.index') }}">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    @if (is_null($cart))
                        <h1 class="text-center">NO ITEM IN CART</h1>
                    @else
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @php
                                $items = $cart->cartItems;
                            @endphp
                            @foreach ($items as $item)
                                <tr>
                                    <td class="align-middle"><img
                                            src="{{ asset('/uploads/products/' . $item->product->photos['image_one']) }}"
                                            alt="{{ $item->product->name }}"
                                            style="width: 50px;">{{ strlen($item->product->name) > 20 ? substr($item->product->name, 0, 20) . '...' : $item->product->name }}
                                    </td>
                                    <td class="align-middle">GHS. {{ $item->item_price }}</td>
                                    @php
                                        $discount_percentage = $item->discount;
                                        echo gettype($discount_percentage);
                                        $total = $item->item_price;
                                        $discount = 0;
                                        if ($discount_percentage === '0') {
                                            $discount = '0.00';
                                            $total = number_format((float) ($item->item_price * $item->quantity), 2, '.', '');
                                        } else {
                                            $discount = number_format((float) ($item->item_price - $item->sales_price), 2, '.', '');
                                            $total = number_format((float) (($item->item_price - $discount) * $item->quantity), 2, '.', '');
                                        }

                                    @endphp
                                    <td class="align-middle">GHS.{{ $discount }}</td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <a href="{{route('cart.decrease_quantity',['item_id'=>$item->product_id])}}" class="btn btn-sm btn-primary btn-minus">
                                                    <i class="fa fa-minus"></i>
                                                </a>
                                            </div>
                                            <input type="text" disabled
                                                class="form-control form-control-sm bg-secondary border-0 text-center"
                                                value="{{ $item->quantity }}">
                                            <div class="input-group-btn">
                                                <a href="{{route('cart.increase_quantity',['item_id'=>$item->product_id])}}" class="btn btn-sm btn-primary btn-plus">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="align-middle">GHS.{{ $total }}</td>
                                    <td class="align-middle"><a
                                            href="{{ route('user.remove_cart_item', ['item_id' => $item->product->id]) }}"
                                            class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a></td>
                                </tr>
                            @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input disabled type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button disabled class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>GHS.{{ $cart->total_amount ?? ' 0.00' }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">GHS.{{ !is_null($cart) ? '10.00' : '0.00' }}</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>GHS.{{ !is_null($cart) ? number_format((float) ($cart->total_amount + 10), 2, '.', '') : '0.00' }}
                            </h5>
                        </div>
                        <button {{ !is_null($cart) ? '' : 'disabled' }}
                            class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
