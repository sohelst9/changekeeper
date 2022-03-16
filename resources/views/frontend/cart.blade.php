@extends('frontend.master')
@section('content')
    <!-- breadcrumb_section - start
                    ================================================== -->
    <div class="breadcrumb_section">
        <div class="container">
            <ul class="breadcrumb_nav ul_li">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>Cart</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb_section - end
                    ================================================== -->

    <!-- cart_section - start
                    ================================================== -->
    <section class="cart_section section_space">
        <div class="container">

            <div class="cart_table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Total(TK)</th>
                                <th class="text-center">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ url('/cart/update') }}" method="POST">
                                @csrf
                            @php
                                $sub_total = 0;
                            @endphp
                            @forelse ($cart_info as $carts)
                                <tr>
                                    <td>
                                        <div class="cart_product">
                                            <img src="{{ asset('uplode/product/preview_image/' . $carts->cart_to_product->preview_image) }}"
                                                alt="image_not_found">
                                            <h3><a href="">{{ $carts->cart_to_product->product_name }}</a>
                                            </h3>
                                        </div>
                                    </td>
                                    <td class="text-center single_inc_dec"><span class="price_text">TK
                                            {{ $carts->cart_to_product->after_discount }}</span></td>
                                    <td class="text-center single_inc_dec">
                                        <div class="quantity_input">
                                            <button type="button" class="">
                                                <i data-price="{{ $carts->cart_to_product->after_discount }}" class="fal fa-minus"></i>
                                            </button>
                                            <input class="input_number2" name="quantity[{{ $carts->id }}]" type="text" value="{{ $carts->quantity }}" />
                                            <button type="button" class="">
                                                <i data-price="{{ $carts->cart_to_product->after_discount }}" class="fal fa-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-center single_inc_dec">{{ $carts->cart_to_product->after_discount * $carts->quantity }}</td>
                                <td class="text-center"><a href="{{ route('cart.delete',$carts->id) }}" class="remove_btn">
                                        <i class="fal fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @php
                                    $sub_total += $carts->cart_to_product->after_discount * $carts->quantity;
                                @endphp
                                @empty
                                        <!-- empty_cart_section - start
                                        ================================================== -->
                                        <section class="empty_cart_section section_space">
                                            <div class="container">
                                                <div class="empty_cart_content text-center">
                                                    <span class="cart_icon">
                                                        <i class="icon icon-ShoppingCart"></i>
                                                    </span>
                                                    <h3>There are no more items in your cart</h3>
                                                    <a class="btn btn_secondary" href="{{ url('/') }}"><i class="far fa-chevron-left"></i> Continue shopping </a>
                                                </div>
                                            </div>
                                        </section>
                                        <!-- empty_cart_section - end
                                        ================================================== -->

                            @endforelse
                        </tbody>
                    </table>
            </div>

            <div class="cart_btns_wrap">
                <div class="row">
                    <div class="col col-lg-6">
                        <ul class="btns_group ul_li_right">
                            <li><button class="btn border_black" type="submit">Update Cart</button></li>
                        </form>
                        @php
                            session([
                                'discount'=>$discount
                            ])
                        @endphp
                            <li><a class="btn btn_dark" href="{{ route('checkout') }}">Prceed To Checkout</a></li>
                        </ul>
                    </div>

                    <div class="col col-lg-6">
                        <form action="{{ url('/cart') }}" method="GET">
                            <div class="coupon_form form_item mb-0">
                                <input type="text" name="cupon_code" value="{{ $cupon_code }}" placeholder="Coupon Code...">
                                <button type="submit" class="btn btn_dark">Apply Coupon</button>
                                <div class="info_icon">
                                    <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Your Info Here"></i>
                                </div>
                            </div>
                            @if ($message)
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @endif
                        </form>
                    </div>

                </div>
            </div>

            <div class="row">

                <div class="col col-lg-12">
                    <div class="cart_total_table">
                        <h3 class="wrap_title">Cart Totals</h3>
                        <ul class="ul_li_block">
                            <li>
                                <span>Cart Subtotal</span>
                                <span>TK {{ $sub_total }}</span>
                            </li>
                            <li>
                                <span>Discount %</span>
                                <span>{{ $discount }}</span>
                            </li>
                            <li>
                                <span>Order Total</span>
                                <span class="total_price">TK {{ $sub_total-($sub_total*$discount)/100 }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cart_section - end
                    ================================================== -->
@endsection

@section('footer_script')
<!-------cart quantity update then total price auto update start---->
<script>
    let quantity_input = document.querySelectorAll('.single_inc_dec') //class gula dora hoice
    let quantity_input_array = Array.from(quantity_input) // class gula ke alada korar jonno array akare neuya hoice

    //javascript foreach loop create
    quantity_input_array.map(item=>{
        item.addEventListener('click', function(a){
            if(a.target.className == 'fal fa-plus'){
                a.target.parentElement.previousElementSibling.value++
                let quantity = a.target.parentElement.previousElementSibling.value
                let price = a.target.dataset.price
                item.nextElementSibling.innerHTML = price*quantity
            }
            if(a.target.className == 'fal fa-minus'){
                if(a.target.parentElement.nextElementSibling.value > 1){
                a.target.parentElement.nextElementSibling.value--
                let quantity = a.target.parentElement.nextElementSibling.value
                let price = a.target.dataset.price
                item.nextElementSibling.innerHTML = price*quantity
               }

            }
        })
    })

</script>
<!-------cart quantity update then total price auto update end---->

<!-------cart  update success msg---->
@if (session('cart_update'))
    <script>
      Swal.fire(
      'Success!',
      '{{ session('cart_update') }}',
      'success'
    )
    </script>
@endif
@endsection
