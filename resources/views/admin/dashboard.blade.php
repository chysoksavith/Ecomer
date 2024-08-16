  @extends('admin.layouts.layout')
  @section('content')
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="d-flex justify-content-between align-items-center p-3" style="background-color: #343a40;">
                      <h3>Dashboard</h3>
                      <div>
                          <a href="{{ url('admin/dashboard') }}" class=" text-white mr-2">Data Refresh</a> <i
                              class="fa-solid fa-arrows-rotate"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="p-2">
          @include('_message')
      </div>
      <section class="content">
          <div class="container-fluid">
              <div class="container-fluid">
                  <div class="row">
                      @include('admin.component_dashboard.listingTotal')
                  </div>

              </div>
              <div class="row">

                  @include('admin.component_dashboard.totalheaderIncome')

              </div>

              <div class="row">
                  <div class="col-md-12">
                      <div class="card">

                          <div class="card-body">
                              <div class="row justify-content-between">
                                  @include('admin.component_dashboard.goalComplete')
                              </div>
                          </div>

                      </div>
                  </div>

              </div>

          </div>

          <div class="container-fluid">
              {{-- <div class="row mb-2">
                  <div class="col-sm-6">
                      <h3 class="m-0">Listing</h3>
                  </div>
              </div> --}}

              {{-- Top sale --}}
              <div class="row">
                  @include('admin.component_dashboard.topsale')
              </div>
          </div>
      </section>
  @endsection
