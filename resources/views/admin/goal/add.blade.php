@extends('admin.layouts.layout')
@section('content')
    <div class="content-header mt-5">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Goal</h1>
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
                            <h3 class="card-title">Add Goal</h3>
                            <a href="{{ url('admin/goal-list') }}" class="btn btn-warning text-white ">Back</a>
                        </div>
                        <hr>

                        <form action="{{ url('admin/goal-insert') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Goal Name</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                    <span style=" font-size: 14px; color:red;">{{ $errors->first('name') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="target_value">Target Value</label>
                                    <input type="number" class="form-control" name="target_value" id="target_value"
                                        required>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" id="sub" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scritps')
    <script>
        $(document).ready(function() {
            $('#logo').change(function() {
                const input = this;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#logoPreview').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#logoPreview').attr('src', '').hide();
                }
            });
        });
    </script>
@endsection
