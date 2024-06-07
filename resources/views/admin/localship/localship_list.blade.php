@extends('admin.layouts.layout')


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Local shipping charge</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="p-2">
                            @include('_message')
                        </div>
                        <div class="card-header ">
                            <form id="deleteForm" action="{{ route('delete.shipping.all') }}" method="post">
                                @csrf
                                <table id="localShippingTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Province</th>
                                            <th>Rate</th>
                                            <th>status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($localShip as $localshipping)
                                            <tr>
                                                <td>
                                                    <span>
                                                        {{ $localshipping['id'] }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $localshipping['province'] }}
                                                </td>
                                                <td>
                                                    {{ $localshipping['rate'] }}
                                                </td>
                                                <td>
                                                    <a class="updatLocalShippingstatus"
                                                        id="localshipping-{{ $localshipping['id'] }}"
                                                        localshipping_id="{{ $localshipping['id'] }}"
                                                        href="javascript:void(0)">
                                                        @if ($localshipping['status'] == 1)
                                                            <i class="fas fa-toggle-on" status="Active"></i>
                                                        @else
                                                            <i class="fas fa-toggle-off" style="color: grey"
                                                                status="Inactive"></i>
                                                        @endif
                                                    </a>
                                                </td>
                                                <td class=" d-flex justify-content-evenly">
                                                    <a href="{{ url('admin/edit-localshipping/' . $localshipping['id']) }}"><i
                                                            class="fas fa-edit" style="font-size: #3fed3"></i></a>
                                                    <a class="confirmDelete" name="localshipping"
                                                        title="Delete localshipping"
                                                        href="{{ url('admin/delete-Localshipping/' . $localshipping['id']) }}"><i
                                                            class="fas fa-trash" style="font-size: red"></i></a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </form>
                        </div>
                        <!-- /.card-header -->
                    </div>

                </div>
            </div>
        </div>

        </div>
    </section>
@endsection
