@extends('layouts.dashboard')

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('add.product') }}">Add Product</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('add.product') }}">View Product</a></li>
    </ol>
</div>

<!----view Product table---->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-white">View Product List</h3>
            </div>
            <div class="card-body">
                <table id="product" class="display min-w850 table-responsive">
                    <thead>
                            <th>SL</th>
                            <th>Category</th>
                            <th style="">Subcategory</th>
                            <th style="">Product Name</th>
                            <th>Price</th>
                            <th style="">Discount</th>
                            <th>After Discount</th>
                            <th style="">Quantity</th>
                            <th>short_disc</th>
                            <th>Long_disc</th>
                            <th>Preview Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($all_product as $key=>$product)

                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $product->product_to_category->category_name }}</td>
                            <td>{{ $product->product_to_subcategory->subcategory_name }}</td>
                            <td>{{ substr($product->product_name, 0,15).'..' }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td>{{ ($product->product_discount == ''?'N/A':$product->product_discount) }}</td>
                            <td>{{ $product->after_discount }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ substr($product->short_disc, 0,15.).'..' }}</td>
                            <td>{{ substr($product->long_disc, 0,20.).'..' }}</td>
                            <td><img width="90px" src="{{ asset('/uplode/product/preview_image/'.$product->preview_image) }}" alt=""></td>
                            <td>
                                <a href="" class="btn btn-primary shadow btn-xs sharp">
                                    <i class="fa fa-pencil"></i>
                                </a>

                                <a href="{{ route('product.delete',$product->id) }}" class="btn btn-danger shadow btn-xs sharp">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        @endforeach

                    </tbody>

                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Category</th>
                            <th style="">Subcategory</th>
                            <th style="">Product Name</th>
                            <th>Price</th>
                            <th style="">Discount</th>
                            <th>After Discount</th>
                            <th style="">Quantity</th>
                            <th>Short_desp</th>
                            <th>Long_desp</th>
                            <th>Preview Image</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')

<!---use Data Table---->
<script>
    $(document).ready( function () {
    $('#product').DataTable();
    } );
</script>

<!------sweetalert for product delete success----->
@if (session('delete_success'))
<script>
    Swal.fire(
    'delete!',
    '{{ session('delete_success') }}',
    'success'
    )
</script>
@endif

@endsection
