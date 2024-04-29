@extends('admin.layouts.layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>shippings Recovery</h1>
                </div>
               
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <div class="row d-flex align-items-center">
                                <div class="col">
                                    <h3 class="card-title">Recovery Shipping Charges</h3>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ url('admin/shipping-charges') }}" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            @include('_message')
                        </div>
                        <div class="card-header ">
                            <form action="{{ route('recovery.shipping.all') }}" method="post">
                                @csrf
                                <table id="shippingRecoveryTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Country</th>
                                            <th>Rate</th>
                                            <th>Recovery</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recoveryShip as $shipping)
                                            <tr>
                                                <td>
                                                    <span>
                                                        <input type="checkbox" name="ids[]" value="{{ $shipping['id'] }}">
                                                    </span>
                                                    <span>
                                                        {{ $shipping['id'] }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $shipping['country'] }}
                                                </td>
                                                <td>
                                                    {{ $shipping['rate'] }}
                                                </td>

                                                <th class=" d-flex justify-content-evenly">
                                                    {{-- delete --}}
                                                    <a href="{{ route('recover.shipping', ['id' => $shipping->id]) }}">
                                                        <i class="fa-solid fa-rotate-left"></i>
                                                    </a>
                                                </th>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No item record</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>

                                        <tr>
                                            <td>
                                                <button class="btn btn-danger" type="submit">Delete
                                                    Record</button>
                                            </td>

                                        </tr>
                                    </tfoot>
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
