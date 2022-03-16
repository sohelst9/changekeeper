@extends('layouts.dashboard')

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">Add Product</a></li>
    </ol>
</div>

<!-------------- Product Insert Form--------->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-success">
                <h3 class="text-white">Add Product</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/product/insert') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <div class="form-group input-success-o">
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">--Select Category--</option>
                                    @foreach ($all_category as $category)

                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>

                                    @endforeach
                                </select>

                                @error('category_id')
                                    <strong class="text-danger mt-3">{{ $message }}</strong>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group input-success-o">
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value="">--Select SubCategory--</option>
                                </select>

                                @error('subcategory_id')
                                    <strong class="text-danger mt-3">{{ $message }}</strong>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group input-success-o">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-control">

                                @error('product_name')
                                    <strong class="text-danger mt-3">{{ $message }}</strong>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group input-success-o">
                                <label for="" class="form-label">Product Price</label>
                                <input type="number" name="product_price" class="form-control">

                                @error('product_price')
                                    <strong class="text-danger mt-3">{{ $message }}</strong>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group input-success-o">
                                <label for="" class="form-label">Product Discount</label>
                                <input type="number" name="product_discount" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group input-success-o">
                                <label for="" class="form-label">Quantity</label>
                                <input type="number" name="quantity" class="form-control">

                                @error('quantity')
                                    <strong class="text-danger mt-3">{{ $message }}</strong>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="form-group input-success-o">
                                <label for="" class="form-label">Short Discription</label>
                                <input type="text" name="short_discription" class="form-control">

                                @error('short_discription')
                                    <strong class="text-danger mt-3">{{ $message }}</strong>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="form-group input-success-o">
                                <label for="" class="form-label">Long Discription</label>
                                <textarea type="text" name="long_discription" class="form-control"></textarea>

                                @error('long_discription')
                                    <strong class="text-danger mt-3">{{ $message }}</strong>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group input-success-o">
                                <label for="" class="form-label">Preview Image</label>
                                <input type="file" name="preview_image" class="form-control">

                                @error('preview_image')
                                    <strong class="text-danger mt-3">{{ $message }}</strong>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group input-success-o">
                                <label for="" class="form-label">Thumbnails Image</label>
                                <input type="file" multiple name="thambnails_image[]" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="form-group input-success-o text-center">
                                <button type="submit" class="btn btn-success btn-lg">Add Product</button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
  @section('footer_script')

  <!-------relation category to Subcategory-------->
    <script>
        $('#category_id').change(function(){
            var category_id = $('#category_id').val();

            //ajax setup er age meta tag a ekta csrf key dite hobe then setup code bosate hobe
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            //ajax start
            $.ajax({
                type:'POST',
                url:'/getcategory_ajax',
                data:{'category_id':category_id},
                success:function(data){
                    $('#subcategory_id').html(data);
                }
            });
        });
    </script>

    <!------sweetalert for product insert success----->
    @if (session('insert_success'))
        <script>
            Swal.fire(
            'success!',
            '{{ session('insert_success') }}',
            'success'
            )
        </script>
    @endif

  @endsection
