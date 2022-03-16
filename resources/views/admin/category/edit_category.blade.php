@extends('layouts.dashboard')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('ViewCategory') }}">View Category</a></li>
        <li class="breadcrumb-item active"><a href="#">Edit Category</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-md-6 m-auto">
        <div class="card">
            <div class="card-header bg-success">
                <h3 class="text-white">Edit Category</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/category/update_category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="category_id" class="form-control" value="{{ $category_id_info->id }}">

                    <div class="mt-3 input-success-o">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="category_name" class="form-control" value="{{ $category_id_info->category_name }}">
                    </div>

                    <div class="mt-3 input-success-o">
                        <label class="form-label">Category Image</label>
                        <input type="file" name="category_image" class="form-control" value="">
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Update Category</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
