@extends('layouts.dashboard')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('View.SubCategory') }}">View SubCategory</a></li>
        <li class="breadcrumb-item active"><a href="#">Edit SubCategory</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-md-6 m-auto">
        <div class="card">
            <div class="card-header bg-success">
                <h3 class="text-white">Edit SubCategory</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/subcategory/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="subcategory_id" class="form-control" value="{{ $subcategory_id_allinfo->id }}">

                    <div class="input-success-o mt-3">
                        <select name="category_id" class="form-control">
                            <option value="">--Select Category--</option>
                            @foreach ($all_category as $category)

                            <option {{ ($category->id == $subcategory_id_allinfo->category_id?'selected':'') }} value="{{ $category->id }}">{{ $category->category_name }}</option>

                            @endforeach

                        </select>
                        @error('category_id')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="mt-3 input-success-o">
                        <label class="form-label">SubCategory Name</label>
                        <input type="text" name="subcategory_name" class="form-control" value="{{ $subcategory_id_allinfo->subcategory_name }}">
                        @error('subcategory_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                        <!---subcategory already exist same category: error msg--->
                        @if (session('exist'))
                            <strong class="text-danger mt-3">{{ session('exist') }}</strong>
                        @endif
                    </div>

                    <div class="mt-3 input-success-o">
                        <label class="form-label">SubCategory Image</label>
                        <input type="file" name="subcategory_image" class="form-control" value="">
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Update SubCategory</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
