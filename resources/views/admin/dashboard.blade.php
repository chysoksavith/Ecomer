  @extends('admin.layouts.layout')
  @section('content')
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Dashboard</h1>
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
