@extends('layouts.dashboard')
@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('add.subcategory') }}">Add SubCategory</a></li>
        <li class="breadcrumb-item active"><a href="#">View SubCategory</a></li>
    </ol>
</div>
<!----view SubCategory table---->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-white">View SubCategory Table</h3>
            </div>
            <div class="card-body">
                <table id="subcategory" class="display min-w850 table-responsive">
                    <thead>
                            <th>SL</th>
                            <th>Cate_Name</th>
                            <th style="">SubCate_Name</th>
                            <th style="">Added By</th>
                            <th>SubCate_Image</th>
                            <th style="">Created At</th>
                            <th>Status</th>
                            <th style="">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_subcategory as $key=>$subcategory)

                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                @php
                                    if(App\Models\category::where('id', $subcategory->category_id)->exists()){
                                        echo $subcategory->subcategory_to_category->category_name;
                                    }
                                    else{
                                        echo "nai";
                                    }
                                @endphp
                            </td>
                            <td>{{ $subcategory->subcategory_name }}</td>
                            <td>
                                @php
                                    if(App\Models\User::where('id', $subcategory->added_by)->exists()){
                                        echo $subcategory->subcategory_to_user->name;
                                    }
                                    else{
                                        echo "N/A";
                                    }
                                @endphp
                            </td>
                            <td><img height="100px" width="100px" src="{{ asset('uplode/subcategory/'.$subcategory->subcategory_image) }}" alt=""></td>
                            <td>{{ $subcategory->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="" class="btn btn-success">Active</a>
                            </td>
                            <td>
                                <a href="{{ route('subcategory.edit',$subcategory->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-danger shadow btn-xs sharp">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                    <thead>
                        <tr>
                            <th style="">SL</th>
                            <th>Cate_Name</th>
                            <th style="">SubCate_Name</th>
                            <th style="">Added By</th>
                            <th>SubCate_Image</th>
                            <th style="">Created At</th>
                            <th>Status</th>
                            <th style="">Action</th>
                        </tr>
                    </thead>

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
    $('#subcategory').DataTable();
    } );
    </script>
@endsection

