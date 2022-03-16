@extends('layouts.dashboard')
@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">SubCategory</a></li>
    </ol>
</div>
<!-----subcategory insert success msg------>
@if (session('subcategory_success'))

<div class="alert alert-info">
    {{ session('subcategory_success') }}
</div>

@endif
<div class="row">
    <div class="col-md-6 m-auto">
        <div class="card">
            <div class="card-header bg-success">
                <h3 class="text-white">Add SubCategory</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('/subcategory/insert') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="input-success-o mt-3">
                           <select name="category_id" class="form-control">
                               <option value="">--Select Category--</option>
                               @foreach ($all_category as $category)

                               <option value="{{ $category->id }}">{{ $category->category_name }}</option>

                               @endforeach

                            </select>
                            <!------category not select  error msg----->
                            @error('category_id')
                                <strong class="text-danger mt-2">{{ $message }}</strong>
                            @enderror

                        </div>

                        <div class="input-success-o mt-3">
                            <label for="" class="form-label">Subcategory Name :</label>
                            <input type="text" name="subcategory_name" class="form-control">
                        <!------subcategory empty field  error msg----->
                        @error('subcategory_name')
                            <strong class="text-danger mt-2">{{ $message }}</strong>
                        @enderror

                        <!------subcategory exists  error msg----->

                        @if(session('exists'))
                           <strong class="text-danger mt-2">{{ session('exists') }}</strong>
                        @endif

                        </div>

                        <div class="input-success-o mt-3">
                            <label for="" class="form-label">Subcategory Image :</label>
                            <input type="file" name="subcategory_image" class="form-control">
                            <!------subcategory empty field  error msg----->
                        @error('subcategory_image')
                        <strong class="text-danger mt-2">{{ $message }}</strong>
                    @enderror
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-rounded btn-success">Add  Subcategory</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
