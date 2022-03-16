@extends('frontend.master')

@section('content')

<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Check Out</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->


<!-- checkout-section - start
================================================== -->
<section class="checkout-section section_space">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
            <div class="woocommerce bg-light p-3">
                <form name="checkout" method="POST" class="checkout woocommerce-checkout" action="{{ url('/order/insert') }}">
                    @csrf
                    <div class="col2-set" id="customer_details">
                        <div class="coll-1">
                            <div class="woocommerce-billing-fields">
                                <h3>Billing Details</h3>
                                <p class="form-row form-row form-row-first validate-required" id="billing_first_name_field">
                                    <label for="billing_first_name" class="">Name <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" class="input-text " name="name" id="billing_first_name" value="{{ Auth::guard('CustomerLogin')->user()->name }}" />

                                    @error('name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        <span>
                                    @enderror
                                </p>
                                <p class="form-row form-row form-row-last validate-required validate-email" id="billing_email_field">
                                    <label for="billing_email" class="">Email Address <abbr class="required" title="required">*</abbr></label>
                                    <input type="email" class="input-text " name="email" id="billing_email" value="{{ Auth::guard('CustomerLogin')->user()->email }}" />

                                    @error('email')
                                        <span class="text-danger">
                                            {{ $message }}
                                        <span>
                                    @enderror
                                </p>
                                <div class="clear"></div>
                                <p class="form-row form-row form-row-first" id="billing_company_field">
                                    <label for="billing_company" class="">Company Name</label>
                                    <input type="text" class="input-text " name="company" id="billing_company">
                                </p>

                                <p class="form-row form-row form-row-last validate-required validate-phone" id="billing_phone_field">
                                    <label for="billing_phone" class="">Phone <abbr class="required" title="required">*</abbr></label>
                                    <input type="tel" class="input-text " name="phone" id="billing_phone">

                                    @error('phone')
                                        <span class="text-danger">
                                            {{ $message }}
                                        <span>
                                    @enderror

                                </p>
                                <div class="clear"></div>
                                <p class="form-row form-row form-row-first address-field update_totals_on_change validate-required" id="billing_country_field">
                                    <label for="billing_country" class="">Country <abbr class="required" title="required">*</abbr></label>
                                    <select name="country_id" id="country_id">
                                        <option value="">Select a country&hellip;</option>
                                        @foreach ($countries as $country)

                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>

                                @error('country_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    <span>
                                @enderror

                                </p>
                                <p class="form-row form-row form-row-last address-field update_totals_on_change validate-required" id="billing_country_field">
                                    <label for="billing_country" class="">City <abbr class="required" title="required">*</abbr></label>
                                    <select name="city_id" id="city_id">
                                        <option value="">Select a City&hellip;</option>
                                    </select>

                                @error('city_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    <span>
                                @enderror
                                </p>
                                <p class="form-row form-row form-row-wide address-field validate-required" id="billing_address_1_field">
                                    <label for="billing_address_1" class="">Address <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" class="input-text " name="address" id="billing_address_1">

                                @error('address')
                                    <span class="text-danger">
                                        {{ $message }}
                                    <span>
                                @enderror
                                </p>
                            </div>
                            <p class="form-row form-row notes" id="order_comments_field">
                                <label for="order_comments" class="">Order Notes</label>
                                <textarea name="notes" class="input-text " id="order_comments" rows="2" cols="5"></textarea>
                            </p>
                        </div>
                    </div>
                    <h3 id="order_review_heading">Your order</h3>
                    <div id="order_review" class="woocommerce-checkout-review-order">
                        <table class="shop_table woocommerce-checkout-review-order-table">
                            <tr class="cart-subtotal">
                                <th>Subtotal</th>
                                <input type="hidden" name="total" value="{{ $sub_total }}">
                                <td>TK <span class="sub_totals">{{ $sub_total }}</span>
                                </td>
                            </tr>
                            <tr class="cart-subtotal">
                                <th>Discount %</th>
                                <input type="hidden" name="discount" value="{{ session('discount') }}">
                                <td><span>{{ session('discount') }}</span>
                                </td>
                            </tr>
                            <tr class="shipping">
                                <th>Delivery Charge</th>
                                <td data-title="Shipping">
                                <span class="delivery_charge">0</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>Delivery Location</h3>
                                    <input id="inside" type="radio" class="input-radio delivery" name="delivery_location" value="60" />
                                    <label for="inside">Inside City</label>
                                    <br>
                                    <input id="outside" type="radio" class="input-radio delivery" name="delivery_location" value="100" />
                                    <label for="outside">Outside City</label>
                                    <br>
                                    @error('delivery_location')
                                        <span class="text-danger">
                                            {{ $message }}
                                        <span>
                                    @enderror

                                </td>
                            </tr>
                            <tr class="order-total">
                                <th>Total</th>
                                <td><strong>TK <span class="totals">{{ $sub_total }}</span></strong> </td>
                            </tr>
                        </table>
                        <div id="payment" class="woocommerce-checkout-payment py-3 mt-5">
                        <ul class="wc_payment_methods payment_methods methods">

                            <li class="wc_payment_method payment_method_cheque mb-2">
                                <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="1" checked='checked' data-order_button_text="" />
                                <!--grop add span for radio button style-->
                                <span class='grop-woo-radio-style'></span>
                                <!--custom change-->
                                <label for="payment_method_cheque">Cash On Delivery</label>
                            </li>

                            <li class="wc_payment_method payment_method_paypal mb-2">
                                <input id="payment_method_ssl" type="radio" class="input-radio" name="payment_method" value="2" data-order_button_text="Proceed to SSL Commerz" />
                                <!--grop add span for radio button style-->
                                <span class='grop-woo-radio-style'></span>
                                <!--custom change-->
                                <label for="payment_method_ssl">SSL Commerz</label>
                            </li>

                            <li class="wc_payment_method payment_method_paypal">
                                <input id="payment_method_stripe" type="radio" class="input-radio" name="payment_method" value="3" data-order_button_text="Proceed to SSL Commerz" />
                                <!--grop add span for radio button style-->
                                <span class='grop-woo-radio-style'></span>
                                <!--custom change-->
                                <label for="payment_method_stripe">Stripe Payment</label>
                            </li>

                                    @error('payment_method')
                                        <span class="text-danger">
                                            {{ $message }}
                                        <span>
                                    @enderror

                        </ul>
                        <div class="form-row place-order">
                            <noscript>
                                Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.
                                <br/>
                                <input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals" />
                            </noscript>
                            <input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Place order" data-value="Place order" />
                            <input type="hidden" id="_wpnonce5" name="_wpnonce" value="783c1934b0" />
                            <input type="hidden" name="_wp_http_referer" value="/wp/?page_id=6" />
                        </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</section>
<!-- checkout-section - end
================================================== -->

@endsection

@section('footer_script')

<script>
    $('#country_id').change(function(){
        var country_id = $(this).val();

        //ajax setup
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
        });
        //ajax start
        $.ajax({
            type:'POST',
            url:'/getCity',
            data:{'country_id':country_id},
            success:function(success){
                $('#city_id').html(success);

            }


        })
    });

    // city r jonno select2 use
    $('#city_id').select2();

    // country r jonno select2 use
    $('#country_id').select2();
</script>


<script>
    $('.delivery').click(function(){
        var charge =$(this).val();
        $('.delivery_charge').html(charge);
        var sub_total = $('.sub_totals').text();
        var total = parseInt(sub_total)+parseInt(charge);
        $('.totals').html(total);
    });
</script>

@endsection
