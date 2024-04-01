@extends('admin.layouts.layout')
@section('content')
    <div class="content-header mt-5">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Shipping Charges</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Shipping Charges</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            @include('_message')
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="p-2 d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Edit Shipping Charge</h3>
                            <a href="{{ url('admin/shipping-charges') }}" class="btn btn-warning text-white ">Back</a>
                        </div>
                        <hr>

                        <form action="{{ url('admin/edit-shipping/' . $shippingCharges['id']) }}" method="post">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Country</label>

                                    <input type="text" class="form-control bg-gradient-gray" id="country"
                                        name="country" value="{{ $shippingCharges['country'] }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="title">Rate</label>
                                    <input type="number" class="form-control" id="rate" name="rate"
                                        value="{{ $shippingCharges['rate'] }}">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" id="sub" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
