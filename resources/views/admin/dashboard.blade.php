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
      <div class="p-2">
          @include('_message')
      </div>
      <!-- /.content-header -->
      <section class="content">
          <div class="container-fluid">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-info">
                          <div class="inner">
                              <h3>{{ $brandCount }}</h3>

                              <p>Brands</p>
                          </div>
                          <div class="icon">
                              <i class="fa-solid fa-b"></i>
                          </div>
                          <a href="{{ url('admin/brands') }}" class="small-box-footer">More info <i
                                  class="fas fa-arrow-circle-right"></i></a>
                      </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                          <div class="inner">
                              <h3>{{ $categoryCount }}</h3>

                              <p>Categories</p>
                          </div>
                          <div class="icon">
                              <i class="fa-solid fa-list"></i>
                          </div>
                          <a href="{{ url('admin/categories') }}" class="small-box-footer">More info <i
                                  class="fas fa-arrow-circle-right"></i></a>
                      </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                          <div class="inner">
                              <h3 class=" text-white">{{ $ProductCount }}</h3>

                              <p class=" text-white">Products</p>
                          </div>
                          <div class="icon">
                              <i class="fa-brands fa-product-hunt"></i>
                          </div>
                          <a href="{{ url('admin/products') }}" class="small-box-footer text-white">More info <i
                                  class="fas fa-arrow-circle-right"></i></a>
                      </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                          <div class="inner">
                              <h3>{{ $userCount }}</h3>

                              <p>Users</p>
                          </div>
                          <div class="icon">
                              <i class="fa-solid fa-users"></i>
                          </div>
                          <a href="{{ url('admin/users') }}" class="small-box-footer">More info <i
                                  class="fas fa-arrow-circle-right"></i></a>
                      </div>
                  </div>
                  <!-- ./col -->
              </div>
              <!-- /.row -->

          </div><!-- /.container-fluid -->
      </section>
  @endsection
  <!-- /.content-wrapper -->
