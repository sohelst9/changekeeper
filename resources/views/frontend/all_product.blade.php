@extends('frontend.master')

@section('content')

<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>All Product</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<!-- product_section - start
================================================== -->
<section class="product_section section_space">
    <h2 class="hidden">Product sidebar</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <aside class="sidebar_section p-0 mt-0">
                    <div class="sb_widget sb_category">
                        <h3 class="sb_widget_title">Categories</h3>
                        <ul class="sb_category_list ul_li_block">
                            @foreach ($all_category as $category)

                            <li>
                                <a href="#!">{{ $category->category_name }} <span>()</span></a>
                            </li>
                            @endforeach

                            <li>
                                <a href="{{ route('all_product') }}"><span>All Categories</span></a>
                            </li>
                        </ul>
                    </div>

                    <div class="sb_widget">
                        <h3 class="sb_widget_title">Your Filter</h3>
                        <div class="filter_sidebar">
                            <div class="fs_widget">
                                <h3 class="fs_widget_title">Category</h3>
                                <form action="#">
                                    <div class="select_option clearfix">
                                        <select>
                                            <option data-display="Select Category">Select Your Option</option>
                                            @foreach ($all_category as $category)

                                            <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>

                            <div class="fs_widget">
                                <h3 class="fs_widget_title">Manufacturer</h3>
                                <form action="#">
                                    <ul class="fs_brand_list ul_li_block">
                                        <li>
                                            <div class="checkbox_item">
                                                <input id="apple_brand" type="checkbox" name="brand_checkbox" />
                                                <label for="apple_brand">Apple <span>(19)</span></label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox_item">
                                                <input id="asus_brand" type="checkbox" name="brand_checkbox" />
                                                <label for="asus_brand">Asus <span>(1)</span></label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox_item">
                                                <input id="bank_oluvsen_brand" type="checkbox" name="brand_checkbox" />
                                                <label for="bank_oluvsen_brand">Bank & Oluvsen <span>(1)</span></label>
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

            <div class="col-lg-9">
                <div class="filter_topbar">
                    <div class="row align-items-center">
                        <div class="col col-md-4">
                            <ul class="layout_btns nav" role="tablist">
                                <li>
                                    <button class="active" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fal fa-bars"></i></button>
                                </li>
                                <li>
                                    <button data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                        <i class="fal fa-th-large"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="col col-md-4">
                            <form action="#">
                                <div class="select_option clearfix">
                                    <select>
                                        <option data-display="Defaul Sorting">Select Your Option</option>
                                        <option value="1">Sorting By Name</option>
                                        <option value="2">Sorting By Price</option>
                                        <option value="3">Sorting By Size</option>
                                    </select>
                                </div>
                            </form>
                        </div>

                        <div class="col col-md-4">
                            <div class="result_text">Showing 1-12 of 30 relults</div>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <div class="shop-product-area shop-product-area-col">
                            <div class="product-area shop-grid-product-area clearfix">
                                @foreach ($all_product as $product)

                                <div class="grid">
                                    <div class="product-pic">
                                        <img src="{{ asset('uplode/product/preview_image/'.$product->preview_image) }}" alt />
                                        <div class="actions">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <svg
                                                            role="img"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="48px"
                                                            height="48px"
                                                            viewBox="0 0 24 24"
                                                            stroke="#2329D6"
                                                            stroke-width="1"
                                                            stroke-linecap="square"
                                                            stroke-linejoin="miter"
                                                            fill="none"
                                                            color="#2329D6"
                                                        >
                                                            <title>Favourite</title>
                                                            <path
                                                                d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"
                                                            />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <svg
                                                            role="img"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="48px"
                                                            height="48px"
                                                            viewBox="0 0 24 24"
                                                            stroke="#2329D6"
                                                            stroke-width="1"
                                                            stroke-linecap="square"
                                                            stroke-linejoin="miter"
                                                            fill="none"
                                                            color="#2329D6"
                                                        >
                                                            <title>Shuffle</title>
                                                            <path d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7" />
                                                            <path d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17" />
                                                            <path d="M19 4L22 7L19 10" />
                                                            <path d="M19 13L22 16L19 19" />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button" tabindex="0">
                                                        <svg
                                                            width="48px"
                                                            height="48px"
                                                            viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            stroke="#2329D6"
                                                            stroke-width="1"
                                                            stroke-linecap="square"
                                                            stroke-linejoin="miter"
                                                            fill="none"
                                                            color="#2329D6"
                                                        >
                                                            <title>Visible (eye)</title>
                                                            <path d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z" />
                                                            <circle cx="12" cy="12" r="3" />
                                                        </svg>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="details">
                                        <h4><a href="#">{{ $product->product_name }}</a></h4>
                                        <p><a href="#">{{ $product->short_disc }} </a></p>
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
                                                    <bdi> <span class="woocommerce-Price-currencySymbol">TK</span>{{ $product->after_discount }} </bdi>
                                                </span>
                                            </ins>
                                        </span>
                                        <div class="add-cart-area">
                                            <button class="add-to-cart">Add to cart</button>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>

                        <div class="pagination_wrap">
                            <ul class="pagination_nav">
                                <li class="active"><a href="#!">01</a></li>
                                <li><a href="#!">02</a></li>
                                <li><a href="#!">03</a></li>
                                <li class="prev_btn">
                                    <a href="#!"><i class="fal fa-angle-left"></i></a>
                                </li>
                                <li class="next_btn">
                                    <a href="#!"><i class="fal fa-angle-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="profile" role="tabpanel">
                        <div class="product_layout2_wrap">
                            <div class="product-area-row">
                                @foreach ($all_product as $product)

                                <div class="grid clearfix">
                                    <div class="product-pic">
                                        <img src="{{ asset('uplode/product/preview_image/'.$product->preview_image) }}" alt />
                                        <div class="actions">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <svg
                                                            role="img"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="48px"
                                                            height="48px"
                                                            viewBox="0 0 24 24"
                                                            stroke="#2329D6"
                                                            stroke-width="1"
                                                            stroke-linecap="square"
                                                            stroke-linejoin="miter"
                                                            fill="none"
                                                            color="#2329D6"
                                                        >
                                                            <title>Favourite</title>
                                                            <path
                                                                d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"
                                                            />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <svg
                                                            role="img"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="48px"
                                                            height="48px"
                                                            viewBox="0 0 24 24"
                                                            stroke="#2329D6"
                                                            stroke-width="1"
                                                            stroke-linecap="square"
                                                            stroke-linejoin="miter"
                                                            fill="none"
                                                            color="#2329D6"
                                                        >
                                                            <title>Shuffle</title>
                                                            <path d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7" />
                                                            <path d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17" />
                                                            <path d="M19 4L22 7L19 10" />
                                                            <path d="M19 13L22 16L19 19" />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button" tabindex="0">
                                                        <svg
                                                            width="48px"
                                                            height="48px"
                                                            viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            stroke="#2329D6"
                                                            stroke-width="1"
                                                            stroke-linecap="square"
                                                            stroke-linejoin="miter"
                                                            fill="none"
                                                            color="#2329D6"
                                                        >
                                                            <title>Visible (eye)</title>
                                                            <path d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z" />
                                                            <circle cx="12" cy="12" r="3" />
                                                        </svg>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="details">
                                        <h4><a href="#">{{ $product->product_name }}</a></h4>
                                        <p><a href="#">{{ $product->short_disc }}</a></p>
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
                                                    <bdi> <span class="woocommerce-Price-currencySymbol">TK</span>{{ $product->after_discount }}</bdi>
                                                </span>
                                            </ins>
                                        </span>
                                        <div class="add-cart-area">
                                            <button class="add-to-cart">Add to cart</button>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                            </div>
                        </div>

                        <div class="pagination_wrap">
                            <ul class="pagination_nav">
                                <li class="active"><a href="#!">01</a></li>
                                <li><a href="#!">02</a></li>
                                <li><a href="#!">03</a></li>
                                <li class="prev_btn">
                                    <a href="#!"><i class="fal fa-angle-left"></i></a>
                                </li>
                                <li class="next_btn">
                                    <a href="#!"><i class="fal fa-angle-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product_section - end
================================================== -->

@endsection
