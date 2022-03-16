@extends('frontend.master')

@section('content')

<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>Check Out</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<div class="container">
    <div class="row">
        <div class="col-md-8 m-auto">
            <div class="my-5">
                @if (session('order_success'))
                    <div class="alert alert-success py-5 text-center">
                        {{ session('order_success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
