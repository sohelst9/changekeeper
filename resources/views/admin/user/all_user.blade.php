@extends('layouts.dashboard')
@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">User</a></li>
    </ol>
</div>
 <!-----delete Success Msg---->
 @if (session('delete_success'))
     <div class="alert alert-success">
         {{ session('delete_success') }}
     </div>
 @endif
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                All User Information <span class="float-end">Total User : {{ $total_user }}</span>
            </div>

            <div class="card-body">
                <table class="table table-bordered  table-striped verticle-middle table-responsive-sm">
                    <thead class="thead-primary">
                        <tr>
                            <th ><input type="checkbox" class="mr-2">Mark All</th>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($all_user as $key=>$user)

                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>
                                <a name="{{ route('user.delete',$user->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1 user_delete">
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
    $('.user_delete').click(function(){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this user !",
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
