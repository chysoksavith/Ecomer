@extends('admin.layouts.layout')
@section('content')
    <div class="content-header mt-5">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Permission</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h3 class="card-title">Permission</h3>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('admin.subadmin') }}" class="btn btn-warning text-white bold">Back</a>
                                </div>
                                <div class="py-2">
                                    @include('_message')
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Module</th>
                                        <th>View Access</th>
                                        <th>Edit Access</th>
                                        <th>Full Access</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <form name="subAdminForm" id="subAdminForm"
                                        action="{{ route('admin-updateRoles', ['id' => $id]) }}" method="post">
                                        @csrf
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
                                                {{-- module orders --}}
                                                @if ($role['module'] == 'orders')
                                                    @if ($role['view_access'] == 1)
                                                        @php
                                                            $viewOrders = 'checked';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $viewOrders = '';
                                                        @endphp
                                                    @endif
                                                    {{-- edit --}}
                                                    @if ($role['edit_access'] == 1)
                                                        @php
                                                            $editOrders = 'checked';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $editOrders = '';
                                                        @endphp
                                                    @endif
                                                    {{-- full --}}
                                                    @if ($role['full_access'] == 1)
                                                        @php
                                                            $fullOrders = 'checked';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $fullOrders = '';
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
                                                {{-- module subscriber --}}
                                                @if ($role['module'] == 'subscribers')
                                                    @if ($role['view_access'] == 1)
                                                        @php
                                                            $viewsubscribers = 'checked';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $viewsubscribers = '';
                                                        @endphp
                                                    @endif
                                                    {{-- edit --}}
                                                    @if ($role['edit_access'] == 1)
                                                        @php
                                                            $editsubscribers = 'checked';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $editsubscribers = '';
                                                        @endphp
                                                    @endif
                                                    {{-- full --}}
                                                    @if ($role['full_access'] == 1)
                                                        @php
                                                            $fullsubscribers = 'checked';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $fullsubscribers = '';
                                                        @endphp
                                                    @endif
                                                @endif
                                                {{-- module Rating --}}
                                                @if ($role['module'] == 'ratings')
                                                    @if ($role['view_access'] == 1)
                                                        @php
                                                            $viewratings = 'checked';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $viewratings = '';
                                                        @endphp
                                                    @endif
                                                    {{-- edit --}}
                                                    @if ($role['edit_access'] == 1)
                                                        @php
                                                            $editratings = 'checked';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $editratings = '';
                                                        @endphp
                                                    @endif
                                                    {{-- full --}}
                                                    @if ($role['full_access'] == 1)
                                                        @php
                                                            $fullratings = 'checked';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $fullratings = '';
                                                        @endphp
                                                    @endif
                                                @endif
                                                {{-- color --}}
                                                @if ($role['module'] == 'colors')
                                                    @if ($role['view_access'] == 1)
                                                        @php
                                                            $viewColor = 'checked';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $viewColor = '';
                                                        @endphp
                                                    @endif
                                                    {{-- edit --}}
                                                    @if ($role['edit_access'] == 1)
                                                        @php
                                                            $editColor = 'checked';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $editColor = '';
                                                        @endphp
                                                    @endif
                                                    {{-- full --}}
                                                    @if ($role['full_access'] == 1)
                                                        @php
                                                            $fullColor = 'checked';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $fullColor = '';
                                                        @endphp
                                                    @endif
                                                @endif
                                                   {{-- coupon --}}
                                                   @if ($role['module'] == 'coupons')
                                                   @if ($role['view_access'] == 1)
                                                       @php
                                                           $viewCoupon = 'checked';
                                                       @endphp
                                                   @else
                                                       @php
                                                           $viewCoupon = '';
                                                       @endphp
                                                   @endif
                                                   {{-- edit --}}
                                                   @if ($role['edit_access'] == 1)
                                                       @php
                                                           $editCoupon = 'checked';
                                                       @endphp
                                                   @else
                                                       @php
                                                           $editCoupon = '';
                                                       @endphp
                                                   @endif
                                                   {{-- full --}}
                                                   @if ($role['full_access'] == 1)
                                                       @php
                                                           $fullCoupon = 'checked';
                                                       @endphp
                                                   @else
                                                       @php
                                                           $fullCoupon = '';
                                                       @endphp
                                                   @endif
                                               @endif
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td>
                                                Cms Pages
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($viewCMSPages)) {{ $viewCMSPages }} @endif
                                                        name="cms_pages[view]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        View Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($editCMSPages)) {{ $editCMSPages }} @endif
                                                        name="cms_pages[edit]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Edit Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($fullCMSPages)) {{ $fullCMSPages }} @endif
                                                        name="cms_pages[full]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Full Access
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Categories
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($viewCategories)) {{ $viewCategories }} @endif
                                                        name="categories[view]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        View Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($editCategories)) {{ $editCategories }} @endif
                                                        name="categories[edit]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Edit Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($fullCategories)) {{ $fullCategories }} @endif
                                                        name="categories[full]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Full Access
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Brands
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($viewbrands)) {{ $viewbrands }} @endif
                                                        name="brands[view]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        View Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($editbrands)) {{ $editbrands }} @endif
                                                        name="brands[edit]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Edit Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($fullbrands)) {{ $fullbrands }} @endif
                                                        name="brands[full]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Full Access
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Products
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($viewproducts)) {{ $viewproducts }} @endif
                                                        name="products[view]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        View Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($editproducts)) {{ $editproducts }} @endif
                                                        name="products[edit]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Edit Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($fullproducts)) {{ $fullproducts }} @endif
                                                        name="products[full]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Full Access
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Orders
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($viewOrders)) {{ $viewOrders }} @endif
                                                        name="orders[view]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        View Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($editOrders)) {{ $editOrders }} @endif
                                                        name="orders[edit]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Edit Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($fullOrders)) {{ $fullOrders }} @endif
                                                        name="orders[full]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Full Access
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Banners
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($viewbanners)) {{ $viewbanners }} @endif
                                                        name="banners[view]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        View Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($editbanners)) {{ $editbanners }} @endif
                                                        name="banners[edit]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Edit Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($fullbanners)) {{ $fullbanners }} @endif
                                                        name="banners[full]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Full Access
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                subscribers
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($viewsubscribers)) {{ $viewsubscribers }} @endif
                                                        name="subscribers[view]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        View Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($editsubscribers)) {{ $editsubscribers }} @endif
                                                        name="subscribers[edit]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Edit Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($fullsubscribers)) {{ $fullsubscribers }} @endif
                                                        name="subscribers[full]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Full Access
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Ratings
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($viewratings)) {{ $viewratings }} @endif
                                                        name="ratings[view]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        View Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($editratings)) {{ $editratings }} @endif
                                                        name="ratings[edit]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Edit Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($fullratings)) {{ $fullratings }} @endif
                                                        name="ratings[full]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Full Access
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- color --}}
                                        <tr>
                                            <td>
                                                Color
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($viewColor)) {{ $viewColor }} @endif
                                                        name="colors[view]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        View Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($editColor)) {{ $editColor }} @endif
                                                        name="colors[edit]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Edit Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($fullColor)) {{ $fullColor }} @endif
                                                        name="colors[full]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Full Access
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                         {{-- Coupon --}}
                                         <tr>
                                            <td>
                                                Coupon
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($viewCoupon)) {{ $viewCoupon }} @endif
                                                        name="coupons[view]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        View Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($editCoupon)) {{ $editCoupon }} @endif
                                                        name="coupons[edit]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Edit Access
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="flexCheckChecked"
                                                        @if (isset($fullCoupon)) {{ $fullCoupon }} @endif
                                                        name="coupons[full]">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Full Access
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <div class="card-footer">
                                                    <button type="submit" id="sub"
                                                        class="btn btn-primary">Submit</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </form>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        {{-- <div class="card-footer clearfix">

                    </div> --}}
                    </div>
                </div>

            </div><!-- /.container-fluid -->
    </section>


@endsection
