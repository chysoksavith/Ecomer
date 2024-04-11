@extends('admin.layouts.layout')
@section('scritps')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Handle delete button click to trigger modal
            document.getElementById('deleteButton').addEventListener('click', function() {
                var selectedCount = document.querySelectorAll('input[name="ids[]"]:checked').length;
                if (selectedCount === 0) {
                    alert('Please select at least one shipping charge to delete.');
                    return false;
                } else {
                    $('#confirmDeleteModal').modal('show');
                }
            });

            // Handle confirmation modal's delete button click
            document.getElementById('confirmDeleteButton').addEventListener('click', function() {
                // Submit the form when delete is confirmed
                document.getElementById('deleteForm').submit();
            });
        });
    </script>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>shippings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">
                            <a href="">Categories Cms Pages</a>
                        </li>
                    </ol>
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
                                <table id="shippingTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Country</th>
                                            <th>Rate (0g to 500g)</th>
                                            <th>Rate (501g to 1000g)</th>
                                            <th>Rate (1001g to 2000g)</th>
                                            <th>Rate (2001g to 5000g)</th>
                                            <th>Rate (above to 5000g)</th>
                                            <th>status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($shippingCharges as $shipping)
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
                                                    {{ $shipping['0_500g'] }}
                                                </td>
                                                <td>
                                                    {{ $shipping['501_1000g'] }}
                                                </td>
                                                <td>
                                                    {{ $shipping['1001_2000g'] }}
                                                </td>
                                                <td>
                                                    {{ $shipping['2001_5000g'] }}
                                                </td>
                                                <td>
                                                    {{ $shipping['above_5000g'] }}
                                                </td>
                                                <td>
                                                    <a class="updatShippingstatus" id="shipping-{{ $shipping['id'] }}"
                                                        shipping_id="{{ $shipping['id'] }}" href="javascript:void(0)">
                                                        @if ($shipping['status'] == 1)
                                                            <i class="fas fa-toggle-on" status="Active"></i>
                                                        @else
                                                            <i class="fas fa-toggle-off" style="color: grey"
                                                                status="Inactive"></i>
                                                        @endif
                                                    </a>
                                                </td>
                                                <th class=" d-flex justify-content-evenly">
                                                    <a href="{{ url('admin/edit-shipping/' . $shipping['id']) }}"><i
                                                            class="fas fa-edit" style="font-size: #3fed3"></i></a>
                                                    {{-- delete --}}
                                                    <a class="confirmDelete" name="shipping" title="Delete shipping"
                                                        href="javascript:void(0)" record="shipping"
                                                        recordid="{{ $shipping->id }}"><i class="fas fa-trash"
                                                            style="font-size: red"></i></a>
                                                </th>

                                            </tr>
                                            {{-- href="{{ url('admin/delete-cms-pages/' . $page->id) }}" --}}
                                        @empty
                                            <tr>
                                                <td colspan="5">No item record</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>

                                        <tr>
                                            <td>
                                                <button class="btn btn-danger" type="button" id="deleteButton"
                                                    data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete
                                                    Record</button>
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/shipping-recovery') }}">
                                                    <button class="btn btn-info" type="button">Recovery
                                                        Record</button>
                                                </a>
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
    <!-- Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the selected shipping charges?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
