@extends('layouts.dashboard')
@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">Category</a></li>
    </ol>
</div>
<!-----category insert success msg------>
@if (session('insert_success'))

  <div class="alert alert-success alert-dismissible fade show ">
      {{ session('insert_success') }}
  </div>

@endif
<div class="row">
    <div class="col-md-6 m-auto">
        <div class="card">
            <div class="card-header bg-success">
                <h3 class="text-white">Add Category</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('/category/insert') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="input-success-o mt-3">
                            <label for="" class="form-label">Category Name :</label>
                            <input type="text" name="category_name" class="form-control">
                            @error('category_name')
                              <p style="color:red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input-success-o mt-3">
                            <label for="" class="form-label">Category Image :</label>
                            <input type="file" name="category_image" class="form-control">
                            @error('category_image')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-rounded btn-success">Add category</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
