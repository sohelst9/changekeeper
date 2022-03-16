@extends('layouts.dashboard')
@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">Cupon</a></li>
    </ol>
</div>

<div class="row">
    <div class="col md-8">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-white">View Cupon</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                            <th>SL</th>
                            <th>Cupon Name</th>
                            <th>Discount</th>
                            <th>Validity</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_cupon as $key=>$cupons)

                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $cupons->cupon_name }}</td>
                            <td>{{ $cupons->cupon_discount }}</td>
                            <td>{{ $cupons->cupon_validity }}</td>
                            <td>{{ $cupons->created_at->diffForHumans() }}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-success">
                <h3 class="text-white">Add Cupon</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('/cupon/insert') }}" method="POST">
                    @csrf
                        <div class="input-success-o mt-3">
                            <label for="" class="form-label">Cupon name</label>
                            <input type="text" name="code" class="form-control">
                        </div>

                        <div class="input-success-o mt-3">
                            <label for="" class="form-label">Cupon Discount %</label>
                            <input type="number" name="discount" class="form-control">
                        </div>

                        <div class="input-success-o mt-3">
                            <label for="" class="form-label">Cupon Validity</label>
                            <input type="date" name="validity" class="form-control">
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-rounded btn-success">Add  Cupon</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')
    @if (session('cupon_insert'))
       <script>
            Swal.fire(
            'Success!',
            '{{ session('cupon_insert') }}',
            'success'
    )
       </script>
    @endif
@endsection
