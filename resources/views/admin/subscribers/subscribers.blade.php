@extends('admin.layouts.layout')
@section('scritps')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Subscribers</h1>
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
                        <div class="card-header">
                            <div class=" float-right">
                            </div>
                        </div>
                        <hr>
                        <div class="card-header ">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Sucess:</strong>{{ Session::get('success_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <table id="subTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Email</th>
                                        <th>Subscribe on</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($subscribers as $subscriber)
                                        <tr>
                                            <td>{{ optional($subscriber)->id ?? 'N/A' }}</td>
                                            <td>{{ optional($subscriber)->email ?? 'N/A' }}</td>
                                            <td>
                                                @if (optional($subscriber->created_at)->diffForHumans())
                                                    {{ optional($subscriber->created_at)->diffForHumans() }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            @if ($subscribersModule['edit_access'] == 1 || $subscribersModule['full_access'])
                                                <td>
                                                    <a class="updatesubscriberstatus"
                                                        id="subscriber-{{ $subscriber['id'] }}"
                                                        subscriber_id="{{ $subscriber['id'] }}" href="javascript:void(0)">
                                                        @if ($subscriber['status'] == 1)
                                                            <i class="fas fa-toggle-on" status="Active"></i>
                                                        @else
                                                            <i class="fas fa-toggle-off" style="color: grey"
                                                                status="Inactive"></i>
                                                        @endif
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="confirmDelete" name="subscriber" title="Delete subscriber"
                                                        href="javascript:void(0)" record="subscriber"
                                                        recordid="{{ $subscriber->id }}"><i class="fas fa-trash"
                                                            style="font-size: red"></i></a>
                                                </td>
                                            @endif

                                        </tr>
                                        {{-- href="{{ url('admin/delete-cms-pages/' . $page->id) }}" --}}
                                    @empty
                                        <tr>
                                            <td colspan="5">No item record</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-header -->
                    </div>

                </div>
            </div>
        </div>

        </div>
    </section>
@endsection
