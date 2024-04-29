@extends('admin.layouts.layout')
@section('scritps')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories</h1>
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
                                @if ($categoriesModule['edit_access'] == 1 || $categoriesModule['full_access'] == 1)
                                    <a href="{{ route('admin.add.edit.category') }}" class=" btn btn-primary">Create
                                        Category</a>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="card-header ">
                            <div class="p-2">
                                @include('_message')
                            </div>

                            <table id="categoryTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Parent Category</th>
                                        <th>Url</th>
                                        <th>Create on</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td>{{ optional($category)->id ?? 'N/A' }}</td>
                                            <td>{{ optional($category)->category_name ?? 'N/A' }}</td>
                                            <td>
                                                @if (isset($category['parentCategory']['category_name']))
                                                    {{ $category['parentCategory']['category_name'] }}
                                                @endif
                                            </td>
                                            <td>{{ optional($category)->url ?? 'N/A' }}</td>
                                            <td>
                                                @if (optional($category->created_at)->format('Y-m-d'))
                                                    {{ optional($category->created_at)->format('Y-m-d') }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($categoriesModule['edit_access'] == 1 || $categoriesModule['full_access'] == 1)
                                                    <a class="updateCategoryStatus" id="category-{{ $category['id'] }}"
                                                        category_id="{{ $category['id'] }}" href="javascript:void(0)">
                                                        @if ($category['status'] == 1)
                                                            <i class="fas fa-toggle-on" status="Active"></i>
                                                        @else
                                                            <i class="fas fa-toggle-off" style="color: grey"
                                                                status="Inactive"></i>
                                                        @endif
                                                    </a>
                                                @endif
                                            </td>
                                            <td class=" d-flex justify-content-around align-items-center">
                                                @if ($categoriesModule['edit_access'] == 1 || $categoriesModule['full_access'] == 1)
                                                    <a href="{{ url('admin/add-edit-category/' . $category->id) }}"><i
                                                            class="fas fa-edit" style="font-size: #3fed3"></i></a>
                                                @endif
                                                @if ($categoriesModule['full_access'] == 1)
                                                    <a class="confirmDelete" name="category" title="Delete category"
                                                        href="javascript:void(0)" record="category"
                                                        recordid="{{ $category->id }}"><i class="fas fa-trash"
                                                            style="font-size: red"></i></a>
                                                @endif
                                            </td>
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
                    <div>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>

        </div>
    </section>
@endsection
