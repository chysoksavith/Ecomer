  <!-- Content Wrapper. Contains page content -->
  @extends('admin.layouts.layout')
  @section('content')
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Dashboard v2</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Dashboard v2</li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      @if (Session::has('error_message'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error:</strong>{{ Session::get('error_message') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif
      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <!-- Info boxes -->
              <div class="row">
                  <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box">
                          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                          <div class="info-box-content">
                              <span class="info-box-text">Categories</span>
                              <span class="info-box-number">
                                  {{ $categoryCount }}
                                  {{-- <small>%</small> --}}
                              </span>
                          </div>
                          <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                          <div class="info-box-content">
                              <span class="info-box-text">Products</span>
                              <span class="info-box-number">{{$ProductCount}}</span>
                          </div>
                          <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                  </div>
                  <!-- /.col -->

                  <!-- fix for small devices only -->
                  <div class="clearfix hidden-md-up"></div>

                  <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                          <div class="info-box-content">
                              <span class="info-box-text">Brands</span>
                              <span class="info-box-number">{{$brandCount}}</span>
                          </div>
                          <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                          <div class="info-box-content">
                              <span class="info-box-text">Users</span>
                              <span class="info-box-number">{{$userCount}}</span>
                          </div>
                      </div>
                      <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
              </div>

          </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->
  @endsection
  <!-- /.content-wrapper -->
