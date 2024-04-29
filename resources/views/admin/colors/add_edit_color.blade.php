@extends('admin.layouts.layout')
@section('content')
    <div class="content-header mt-5">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="p-2">
                @include('_message')
            </div>
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="p-2 d-flex justify-content-between align-items-center">
                            <h3 class="card-title">{{ $title }}</h3>
                            <a href="{{ route('admin.color') }}" class="btn btn-warning ">Back</a>
                        </div>
                        <hr>

                        <form name="colorForm" id="colorForm" method="post" enctype="multipart/form-data"
                            @if (empty($color['id'])) action="{{ route('add.edit.color') }}"
                        @else
                            action="{{ route('add.edit.color', ['id' => $color['id']]) }}" @endif>
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="color_name">Color Name</label>
                                    <input type="text" class="form-control" id="color_name" name="color_name"
                                        placeholder="Enter color name"
                                        @if (!empty($color['color_name'])) value="{{ $color['color_name'] }}"  @else value="{{ old('color_name') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="color_picker">Choose a color:</label>
                                    <input type="color" id="color_picker" name="color_code" class="form-control"
                                        @if (!empty($color['color_code'])) value="{{ $color['color_code'] }}" @else value="{{ old('color_code') }}" @endif>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" id="sub" class="btn btn-primary">Submit</button>
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
