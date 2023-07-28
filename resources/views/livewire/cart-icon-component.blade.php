<div class="header-action-icon-2">
    <a class="mini-cart-icon" href="{{route('shop.cart')}}">
        <img alt="Cart" src="{{ asset('assets/imgs/theme/icons/icon-cart.svg')}}">
        <span class="pro-count blue">{{Cart::instance('cart')->count()}}</span>
    </a>

    <div class="cart-dropdown-wrap cart-dropdown-hm2">
        @if (Cart::instance('cart')->count()>0)
        <ul>
            @foreach (Cart::instance('cart')->content() as $item)
                <li>
                    <div class="shopping-cart-img">
                        <a href="{{route('product.details', ['slug' => $item->model->slug])}}"><img alt="{{$item->model->name}}" src="{{ asset('assets/imgs/shop/product-')}}{{$item->model->id}}-1.jpg"></a>
                    </div>
                    <div class="shopping-cart-title">
                        <h4><a href="{{route('product.details', ['slug' => $item->model->slug])}}">{{substr($item->model->name, 0, 20)}}...</a></h4>
                        <h4>
                            @if (is_null($item->model->sale_price))
                                <span>${{$item->model->regular_price}}</span>
                            @else
                                <span>${{$item->model->sale_price}}</span>
                                <span style="color: gray;"><s>${{$item->model->regular_price}}</s></span>
                            @endif
                        </h4>
                    </div>
                    {{-- <div class="shopping-cart-delete">
                        <a href="" wire:click.prevent = "destroy('{{$item->rowId}}')"><i class="fi-rs-cross-small"></i></a>
                    </div> --}}
                </li>
            @endforeach
        </ul>
        @else
            <p>Nothing is in the cart yet! Please add more items!</p>
        @endif
        <div class="shopping-cart-footer">
            <div class="shopping-cart-total">
                <h4>Total <span>${{Cart::total()}}</span></h4>
            </div>
            <div class="shopping-cart-button">
                <a href="{{route('shop.cart')}}" class="outline">View cart</a>
                <a href="{{route('shop.checkout')}}">Checkout</a>
            </div>
        </div>
    </div>
</div>
