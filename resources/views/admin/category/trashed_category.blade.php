@extends('layouts.dashboard')
@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('ViewCategory') }}">view Category</a></li>
        <li class="breadcrumb-item active"><a href="#">Trashed Category</a></li>
    </ol>
</div>
<!----alert Category delete msg---->
@if (session('delete_success'))
    <div class="alert alert-success">
        {{ session('delete_success') }}
    </div>
@endif


<!----alert Category restore msg---->
@if (session('restore_success'))
    <div class="alert alert-success">
        {{ session('restore_success') }}
    </div>
@endif

<!----view  Trashed Category table---->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-white">View Trashed Category Table</h3>
            </div>
            <div class="card-body">
                <table id="" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox">
                            </th>
                            <th style="width: 25px">SL</th>
                            <th style="">Category Name</th>
                            <th style="">Added By</th>
                            <th>Category Image</th>
                            <th style="width: 130px">Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_trashedcategory as $key=>$category)

                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>
                                @php
                                if(App\Models\User::where('id', $category->added_by)->exists()){
                                    echo $category->category_to_user->name;
                                }
                                else{
                                    echo "N/A";
                                }
                            @endphp
                            </td>
                            <td><img height="100px" width="100px" src="{{ asset('uplode/category/'.$category->category_image) }}" alt=""></td>
                            <td>{{ $category->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="" class="btn btn-success">Active</a>
                            </td>
                            <td>
                                <a href="{{ route('category.restore',$category->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a name="{{ route('category.forcedelete',$category->id) }}" class="btn btn-danger shadow btn-xs sharp category_delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')

<script>
    $('.category_delete').click(function(){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this Category !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
          var link = $(this).attr('name');
          window.location.href=link;
        }
        })
    })
    </script>

@endsection
