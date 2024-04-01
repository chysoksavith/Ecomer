<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="p-2 d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{ $title }}</h4>
                        <a href="{{ route('admin.subadmin') }}" class="btn btn-warning ">Back</a>
                    </div>
                    <hr>

                    <form name="subAdminForm" id="subAdminForm"
                        action="{{ route('admin-updateRoles', ['id' => $id]) }}" method="post">

                        @csrf
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
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body">
                            {{-- <div class="form-group">
                                <label for="email">Email</label>
                                <input @if ($subadminData['id'] != '') disabled @else required @endif
                                    class="form-control" type="email" name="email" id="email"
                                    @if (!empty($subadminData['email'])) value="{{ $subadminData['email'] }}" @endif
                                    placeholder="Enter SubAdmin Email" style="background-color: #666666">
                            </div> --}}
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
                                    <strong>Success:</strong>{{ Session::get('success_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <input type="hidden" name="subadmin_id" value="{{ $id }}">
                            @if (!empty($subadminRoles))
                                @foreach ($subadminRoles as $role)
                                    @if ($role['module'] == 'cms_pages')
                                        @if ($role['view_access'] == 1)
                                            @php
                                                $viewCMSPages = 'checked';
                                            @endphp
                                        @else
                                            @php
                                                $viewCMSPages = '';
                                            @endphp
                                        @endif
                                        {{-- edit --}}
                                        @if ($role['edit_access'] == 1)
                                            @php
                                                $editCMSPages = 'checked';
                                            @endphp
                                        @else
                                            @php
                                                $editCMSPages = '';
                                            @endphp
                                        @endif
                                        {{-- full --}}
                                        @if ($role['full_access'] == 1)
                                            @php
                                                $fullCMSPages = 'checked';
                                            @endphp
                                        @else
                                            @php
                                                $fullCMSPages = '';
                                            @endphp
                                        @endif
                                    @endif
                                    {{-- module category --}}
                                    @if ($role['module'] == 'categories')
                                        @if ($role['view_access'] == 1)
                                            @php
                                                $viewCategories = 'checked';
                                            @endphp
                                        @else
                                            @php
                                                $viewCategories = '';
                                            @endphp
                                        @endif
                                        {{-- edit --}}
                                        @if ($role['edit_access'] == 1)
                                            @php
                                                $editCategories = 'checked';
                                            @endphp
                                        @else
                                            @php
                                                $editCategories = '';
                                            @endphp
                                        @endif
                                        {{-- full --}}
                                        @if ($role['full_access'] == 1)
                                            @php
                                                $fullCategories = 'checked';
                                            @endphp
                                        @else
                                            @php
                                                $fullCategories = '';
                                            @endphp
                                        @endif
                                    @endif
                                    {{-- module poducts --}}
                                    @if ($role['module'] == 'products')
                                        @if ($role['view_access'] == 1)
                                            @php
                                                $viewproducts = 'checked';
                                            @endphp
                                        @else
                                            @php
                                                $viewproducts = '';
                                            @endphp
                                        @endif
                                        {{-- edit --}}
                                        @if ($role['edit_access'] == 1)
                                            @php
                                                $editproducts = 'checked';
                                            @endphp
                                        @else
                                            @php
                                                $editproducts = '';
                                            @endphp
                                        @endif
                                        {{-- full --}}
                                        @if ($role['full_access'] == 1)
                                            @php
                                                $fullproducts = 'checked';
                                            @endphp
                                        @else
                                            @php
                                                $fullproducts = '';
                                            @endphp
                                        @endif
                                    @endif
                                    {{-- module Brands --}}
                                    @if ($role['module'] == 'brands')
                                        @if ($role['view_access'] == 1)
                                            @php
                                                $viewbrands = 'checked';
                                            @endphp
                                        @else
                                            @php
                                                $viewbrands = '';
                                            @endphp
                                        @endif
                                        {{-- edit --}}
                                        @if ($role['edit_access'] == 1)
                                            @php
                                                $editbrands = 'checked';
                                            @endphp
                                        @else
                                            @php
                                                $editbrands = '';
                                            @endphp
                                        @endif
                                        {{-- full --}}
                                        @if ($role['full_access'] == 1)
                                            @php
                                                $fullbrands = 'checked';
                                            @endphp
                                        @else
                                            @php
                                                $fullbrands = '';
                                            @endphp
                                        @endif
                                    @endif
                                    {{-- module Banners --}}
                                    @if ($role['module'] == 'banners')
                                        @if ($role['view_access'] == 1)
                                            @php
                                                $viewbanners = 'checked';
                                            @endphp
                                        @else
                                            @php
                                                $viewbanners = '';
                                            @endphp
                                        @endif
                                        {{-- edit --}}
                                        @if ($role['edit_access'] == 1)
                                            @php
                                                $editbanners = 'checked';
                                            @endphp
                                        @else
                                            @php
                                                $editbanners = '';
                                            @endphp
                                        @endif
                                        {{-- full --}}
                                        @if ($role['full_access'] == 1)
                                            @php
                                                $fullbanners = 'checked';
                                            @endphp
                                        @else
                                            @php
                                                $fullbanners = '';
                                            @endphp
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                            <div class="form-group">
                                <label for="title">CMS Pages</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="cms_pages[view]"
                                        value="1" @if (isset($viewCMSPages)) {{ $viewCMSPages }} @endif>
                                    <label class="form-check-label">View Access</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="cms_pages[edit]"
                                        value="1" @if (isset($editCMSPages)) {{ $editCMSPages }} @endif>
                                    <label class="form-check-label">Edit Access</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="cms_pages[full]"
                                        value="1" @if (isset($fullCMSPages)) {{ $fullCMSPages }} @endif>
                                    <label class="form-check-label">Full Access</label>
                                </div>
                            </div>
                            {{-- Module Category --}}
                            <div class="form-group">
                                <label for="title">Category</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="categories[view]"
                                        value="1"
                                        @if (isset($viewCategories)) {{ $viewCategories }} @endif>
                                    <label class="form-check-label">View Access</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="categories[edit]"
                                        value="1"
                                        @if (isset($editCategories)) {{ $editCategories }} @endif>
                                    <label class="form-check-label">Edit Access</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="categories[full]"
                                        value="1"
                                        @if (isset($fullCategories)) {{ $fullCategories }} @endif>
                                    <label class="form-check-label">Full Access</label>
                                </div>
                            </div>
                            {{-- Module Product --}}
                            <div class="form-group">
                                <label for="title">Products</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="products[view]"
                                        value="1" @if (isset($viewproducts)) {{ $viewproducts }} @endif>
                                    <label class="form-check-label">View Access</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="products[edit]"
                                        value="1" @if (isset($editproducts)) {{ $editproducts }} @endif>
                                    <label class="form-check-label">Edit Access</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="products[full]"
                                        value="1" @if (isset($fullproducts)) {{ $fullproducts }} @endif>
                                    <label class="form-check-label">Full Access</label>
                                </div>
                            </div>
                            {{-- Module Brands --}}
                            <div class="form-group">
                                <label for="title">Brands</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="brands[view]"
                                        value="1" @if (isset($viewbrands)) {{ $viewbrands }} @endif>
                                    <label class="form-check-label">View Access</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="brands[edit]"
                                        value="1" @if (isset($editbrands)) {{ $editbrands }} @endif>
                                    <label class="form-check-label">Edit Access</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="brands[full]"
                                        value="1" @if (isset($fullbrands)) {{ $fullbrands }} @endif>
                                    <label class="form-check-label">Full Access</label>
                                </div>
                            </div>
                            {{-- Module Banner --}}
                            <div class="form-group">
                                <label for="title">Banners</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="banners[view]"
                                        value="1" @if (isset($viewbanners)) {{ $viewbanners }} @endif>
                                    <label class="form-check-label">View Access</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="banners[edit]"
                                        value="1" @if (isset($editbanners)) {{ $editbanners }} @endif>
                                    <label class="form-check-label">Edit Access</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="banners[full]"
                                        value="1" @if (isset($fullbanners)) {{ $fullbanners }} @endif>
                                    <label class="form-check-label">Full Access</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

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
