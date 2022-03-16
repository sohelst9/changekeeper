@extends('frontend.master')

@section('content')

<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="">Home</a></li>
            <li>Product Details</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<!-- product_details - start
================================================== -->
<section class="product_details section_space pb-0">
    <div class="container">
        <div class="row">
            <div class="col col-lg-6">
                <div class="product_details_image">
                    <div class="details_image_carousel">

                        @foreach ($product_info->product_to_productThaumbnails as $thumbnails)

                        <div class="slider_item">
                            <img src="{{ asset('uplode/product/product_Image_thumbnails/'.$thumbnails->thumbnails_name) }}" alt="image_not_found">
                        </div>

                        @endforeach

                    </div>

                    <div class="details_image_carousel_nav">
                        @foreach ($product_info->product_to_productThaumbnails as $thumbnails)

                        <div class="slider_item">
                            <img src="{{ asset('uplode/product/product_Image_thumbnails/'.$thumbnails->thumbnails_name) }}" alt="image_not_found">
                        </div>

                        @endforeach

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="product_details_content">
                    <h2 class="item_title">{{ $product_info->product_name }}</h2>
                    <p>{{ $product_info->short_disc }}</p>
                    <div class="item_review">
                        <ul class="rating_star ul_li">
                            <li><i class="fas fa-star"></i>></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star-half-alt"></i></li>
                        </ul>
                        <span class="review_value">3 Rating(s)</span>
                    </div>

                    <div class="item_price">
                        <span>TK <span id="after_discount">{{ $product_info->after_discount }}</span></span>
                        <del>TK {{ $product_info->product_price }}</del>
                    </div>
                    <hr>


                    <form action="{{ url('/cart/insert') }}" method="POST">
                        @csrf
                        <div class="quantity_wrap">
                            <div class="quantity_input">
                                <input name="product_id" type="hidden" value="{{ $product_info->id }}">
                                <button type="button" class="input_number_decrement">
                                    <i class="fal fa-minus"></i>
                                </button>
                                <input class="input_number" name="quantity" type="text" value="1">
                                <button type="button" class="input_number_increment">
                                    <i class="fal fa-plus"></i>
                                </button>
                            </div>
                            <div class="total_price">Total : TK <span class="total_Product_amount">{{ $product_info->after_discount }}</span></div>
                        </div>

                        <ul class="default_btns_group ul_li">
                            @auth('CustomerLogin')
                            <li><button class="btn btn_primary addtocart_btn" type="submit">Add To Cart</button></li>
                            @else
                            <li><a class="btn btn_primary addtocart_btn" href="{{ route('register') }}">Add To Cart</a></li>

                            @endauth
                        </ul>
                    </form>
                </div>
            </div>
        </div>

        <div class="details_information_tab">
            <ul class="tabs_nav nav ul_li" role=tablist>
                <li>
                    <button class="active" data-bs-toggle="tab" data-bs-target="#description_tab" type="button" role="tab" aria-controls="description_tab" aria-selected="true">
                    Description
                    </button>
                </li>
                <li>
                    <button data-bs-toggle="tab" data-bs-target="#additional_information_tab" type="button" role="tab" aria-controls="additional_information_tab" aria-selected="false">
                    Additional information
                    </button>
                </li>
                <li>
                    <button data-bs-toggle="tab" data-bs-target="#reviews_tab" type="button" role="tab" aria-controls="reviews_tab" aria-selected="false">
                    Reviews(2)
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="description_tab" role="tabpanel">
                    <p>{{ $product_info->long_disc }}</p>
                </div>

                <div class="tab-pane fade" id="additional_information_tab" role="tabpanel">
                    <p>
                    Return into stiff sections the bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked what's happened to me he thought It wasn't a dream. His room, a proper human room although a little too small
                    </p>

                    <div class="additional_info_list">
                        <h4 class="info_title">Additional Info</h4>
                        <ul class="ul_li_block">
                            <li>No Side Effects</li>
                            <li>Made in USA</li>
                        </ul>
                    </div>

                    <div class="additional_info_list">
                        <h4 class="info_title">Product Features Info</h4>
                        <ul class="ul_li_block">
                            <li>Compatible for indoor and outdoor use</li>
                            <li>Wide polypropylene shell seat for unrivalled comfort</li>
                            <li>Rust-resistant frame</li>
                            <li>Durable UV and weather-resistant construction</li>
                            <li>Shell seat features water draining recess</li>
                            <li>Shell and base are stackable for transport</li>
                            <li>Choice of monochrome finishes and colourways</li>
                            <li>Designed by Nagi</li>
                        </ul>
                    </div>
                </div>

                <div class="tab-pane fade" id="reviews_tab" role="tabpanel">
                    <div class="average_area">
                        <div class="row align-items-center">
                            <div class="col-md-12 order-last">
                                <div class="average_rating_text">
                                    <ul class="rating_star ul_li_center">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                    <p class="mb-0">
                                    Average Star Rating: <span>4 out of 5</span> (2 vote)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="customer_reviews">
                        <h4 class="reviews_tab_title">2 reviews for this product</h4>
                        <div class="customer_review_item clearfix">
                            <div class="customer_image">
                                <img src="assets/images/team/team_1.jpg" alt="image_not_found">
                            </div>
                            <div class="customer_content">
                                <div class="customer_info">
                                    <ul class="rating_star ul_li">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                    </ul>
                                    <h4 class="customer_name">Aonathor troet</h4>
                                    <span class="comment_date">JUNE 2, 2021</span>
                                </div>
                                <p class="mb-0">Nice Product, I got one in black. Goes with anything!</p>
                            </div>
                        </div>

                        <div class="customer_review_item clearfix">
                            <div class="customer_image">
                                <img src="assets/images/team/team_2.jpg" alt="image_not_found">
                            </div>
                            <div class="customer_content">
                                <div class="customer_info">
                                    <ul class="rating_star ul_li">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                    </ul>
                                    <h4 class="customer_name">Danial obrain</h4>
                                    <span class="comment_date">JUNE 2, 2021</span>
                                </div>
                                <p class="mb-0">
                                Great product quality, Great Design and Great Service.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="customer_review_form">
                        <h4 class="reviews_tab_title">Add a review</h4>
                        <form action="#">
                            <div class="form_item">
                                <input type="text" name="name" placeholder="Your name*">
                            </div>
                            <div class="form_item">
                                <input type="email" name="email" placeholder="Your Email*">
                            </div>
                            <div class="your_ratings">
                                <h5>Your Ratings:</h5>
                                <button type="button"><i class="fal fa-star"></i></button>
                                <button type="button"><i class="fal fa-star"></i></button>
                                <button type="button"><i class="fal fa-star"></i></button>
                                <button type="button"><i class="fal fa-star"></i></button>
                                <button type="button"><i class="fal fa-star"></i></button>
                            </div>
                            <div class="form_item">
                                <textarea name="comment" placeholder="Your Review*"></textarea>
                            </div>
                            <button type="submit" class="btn btn_primary">Submit Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product_details - end
================================================== -->

<!-- related_products_section - start
================================================== -->
<section class="related_products_section section_space">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="best-selling-products related-product-area">
                    <div class="sec-title-link">
                        <h3>Related products</h3>
                        <div class="view-all"><a href="#">View all<i class="fal fa-long-arrow-right"></i></a></div>
                    </div>
                    <div class="product-area clearfix">
                        @forelse ($related_product as $related)

                        <div class="grid">
                            <div class="product-pic">
                                <img src="{{ asset('uplode/product/preview_image/'.$related->preview_image) }}" alt>
                                <div class="actions">
                                    <ul>
                                        <li>
                                            <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></a>
                                        </li>
                                        <li>
                                            <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Shuffle</title> <path d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7"/> <path d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17"/> <path d="M19 4L22 7L19 10"/> <path d="M19 13L22 16L19 19"/> </svg></a>
                                        </li>
                                        <li>
                                            <a class="quickview_btn" data-bs-toggle="modal" href="#product_id{{ $related->id }}" role="button" tabindex="0"><svg width="48px" height="48px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Visible (eye)</title> <path d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z"/> <circle cx="12" cy="12" r="3"/> </svg></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="details">
                                <h4><a href="{{ route('product_details',$related->id) }}">{{ $related->product_name }}</a></h4>
                                <p><a href="{{ route('product_details',$related->id) }}">{{ $related->short_disc }}</a></p>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="price">
                                    <ins>
                                        <span class="woocommerce-Price-amount amount">
                                            <bdi>
                                                <span class="woocommerce-Price-currencySymbol">TK </span>{{ $related->after_discount }}
                                            </bdi>
                                        </span>
                                    </ins>
                                </span>
                                <div class="add-cart-area">
                                    <button class="add-to-cart">Add to cart</button>
                                </div>
                            </div>
                        </div>

                        <!-- product quick view modal - start
            ================================================== -->
            <div class="modal fade" id="product_id{{ $related->id }}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel2">Product Quick View</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="product_details">
                                <div class="container">
                                    <div class="row">
                                        <div class="col col-lg-6">
                                            <div class="product_details_image p-0">
                                                <img src="{{ asset('uplode/product/preview_image/'.$related->preview_image) }}" alt>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="product_details_content">
                                                <h2 class="item_title">{{ $related->product_name }}</h2>
                                                <p>
                                                    {{ $related->short_disc }}
                                                </p>
                                                <div class="item_review">
                                                    <ul class="rating_star ul_li">
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                    </ul>
                                                    <span class="review_value">3 Rating(s)</span>
                                                </div>
                                                <div class="item_price">
                                                    <span>TK {{ $related->after_discount }}</span>
                                                    <del>TK {{ $related->product_price }}</del>
                                                </div>
                                                <hr>


                                                <div class="quantity_wrap">
                                                    <form action="#">
                                                        <div class="quantity_input">
                                                            <button type="button" class="input_number_decrement">
                                                                <i class="fal fa-minus"></i>
                                                            </button>
                                                            <input class="input_number" type="text" value="1">
                                                            <button type="button" class="input_number_increment">
                                                                <i class="fal fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                    <div class="total_price">
                                                        Total: $620,99
                                                    </div>
                                                </div>

                                                <ul class="default_btns_group ul_li">
                                                    <li><a class="addtocart_btn" href="#!">Add To Cart</a></li>
                                                    <li><a href="#!"><i class="far fa-compress-alt"></i></a></li>
                                                    <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                                                </ul>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- product quick view modal - end
            ================================================== -->
                        @empty
                        <h4 style="color: red">Related Product Not Avilable</h4>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- related_products_section - end
================================================== -->

@endsection

@section('footer_script')

<script>
    $('.input_number_increment').click(function(){
        var input_number = $('.input_number').val();
        var Product_amount = $('#after_discount').html();
        var quantity_price_multi = input_number*Product_amount;
        $('.total_Product_amount').html(quantity_price_multi);
    });

    $('.input_number_decrement').click(function(){
        var input_number = $('.input_number').val();
        var Product_amount = $('#after_discount').html();
        var quantity_price_multi = input_number*Product_amount;
        $('.total_Product_amount').html(quantity_price_multi);
    });
</script>

    @if (session('add_cart'))

        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'success',
            title: '{{ session('add_cart') }}'
            })
        </script>

    @endif

@endsection
