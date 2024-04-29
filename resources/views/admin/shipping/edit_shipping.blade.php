@extends('admin.layouts.layout')
@section('content')
    <div class="content-header mt-5">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Shipping Charges</h1>
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
                                    <label for="title">Rate (0g to 500g)</label>
                                    <input type="number" class="form-control" id="0_500g" name="0_500g"
                                        value="{{ $shippingCharges['0_500g'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="title">Rate (501g to 1000g)</label>
                                    <input type="number" class="form-control" id="501_1000g" name="501_1000g"
                                        value="{{ $shippingCharges['501_1000g'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="title">Rate (1001g to 2000g)</label>
                                    <input type="number" class="form-control" id="1001_2000g" name="1001_2000g"
                                        value="{{ $shippingCharges['1001_2000g'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="title">Rate (2001g to 5000g)</label>
                                    <input type="number" class="form-control" id="2001_5000g" name="2001_5000g"
                                        value="{{ $shippingCharges['2001_5000g'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="title">Rate (above to 5000g)</label>
                                    <input type="number" class="form-control" id="above_5000g" name="above_5000g"
                                        value="{{ $shippingCharges['above_5000g'] }}">
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
