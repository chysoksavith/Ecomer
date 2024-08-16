@extends('admin.layouts.layout')
@section('content')
    <div class="content-header mt-5">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="p-2">
                @include('_message')
            </div>
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">

                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="p-2 d-flex justify-content-between align-items-center">
                            <h3 class="card-title">{{ $title }}</h3>
                            <a href="{{ url('admin/coupons') }}" class="btn btn-warning ">Back</a>
                        </div>
                        <hr>

                        <form name="couponForm" id="couponForm" method="post" enctype="multipart/form-data"
                            @if (empty($coupon['id'])) action="{{ url('admin/add-edit-coupon') }}"
                        @else
                            action="{{ url('admin/add-edit-coupon', ['id' => $coupon['id']]) }}" @endif>
                            @csrf

                            <div class="card-body">
                                @if (empty($coupon['coupon_code']))
                                    <div class="form-group">
                                        <label for="coupon_option">coupon option*</label> <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="coupon_options"
                                                id="AutomticCoupon" value="Automatic" checked>
                                            <label class="form-check-label">
                                                Automatic
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="coupon_options"
                                                id="ManualCoupon" value="Manual">
                                            <label class="form-check-label">
                                                Manual
                                            </label>
                                        </div>
                                    </div>
                                    {{-- coupon code --}}
                                    <div class="form-group" style="display:none;" id="couponField">
                                        <label for="coupon_code">coupon Code</label>
                                        <input type="text" class="form-control" id="coupon_code" name="coupon_code"
                                            placeholder="Enter coupon code">
                                        @error('coupon_code')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @else
                                    <input type="hidden" name="coupon_options" value="{{ $coupon['coupon_options'] }}">
                                    <input type="hidden" name="coupon_code" value="{{ $coupon['coupon_code'] }}">
                                    <div class="form-group">
                                        <label for="">Coupon Code</label>
                                        <span> &nbsp;&nbsp; {{ $coupon['coupon_code'] }}</span>
                                    </div>
                                @endif
                                {{-- coupon type --}}
                                <div class="form-group">
                                    <label for="coupon_type">coupon type*</label> <br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="coupon_type"
                                            value="Single Time"
                                            @if (isset($coupon['coupon_type']) && $coupon['coupon_type'] == 'Single Time') checked @elseif (!isset($coupon['coupon_type'])) checked @endif>
                                        <label class="form-check-label">
                                            Single Time
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="coupon_type"
                                            value="Multiple Times" @if (isset($coupon['coupon_type']) && $coupon['coupon_type'] == 'Multiple Times') checked @endif>
                                        <label class="form-check-label">
                                            Multiple Times
                                        </label>
                                    </div>

                                </div>

                                {{-- Amount type --}}
                                <div class="form-group">
                                    <label for="amount_type">Amount type*</label> <br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="amount_type" value="Percentage"
                                            @if (isset($coupon['amount_type']) && $coupon['amount_type'] == 'Percentage') checked @elseif (!isset($coupon['amount_type'])) checked @endif>
                                        <label class="form-check-label">
                                            Percentage
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="amount_type" value="Fixed"
                                            @if (isset($coupon['amount_type']) && $coupon['amount_type'] == 'Fixed') checked @endif>
                                        <label class="form-check-label">
                                            Fixed
                                        </label>
                                    </div>
                                </div>

                                {{-- Amount --}}
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount"
                                        placeholder="Enter Amount Coupon" value="{{ $coupon['amount'] }}">
                                    <span style="color: red; font-size: 13px;">{{ $errors->first('amount') }}</span>
                                </div>

                                {{-- Expiry Date --}}
                                <div class="form-group">
                                    <label for="expiry_date"> Expiry Date</label>
                                    <input type="date" class="form-control" id="expiry_date" name="expiry_date"
                                        value="{{ $coupon['expiry_date'] }}">

                                    <span style="color: red; font-size: 13px;">{{ $errors->first('expiry_date') }}</span>
                                </div>



                                {{-- select category --}}



                                <div class="form-group">
                                    <label for="selectCategory">Click to select Category</label>
                                    <select name="categories[]" multiple class="form-select select2" id="selectCategory">
                                        @foreach ($getCategories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ in_array($cat->id, old('categories', $selCats)) ? 'selected' : '' }}>
                                                {{ $cat->category_name }} (Main Category)
                                            </option>
                                            @foreach ($cat->subCategories as $subcat)
                                                <option value="{{ $subcat->id }}"
                                                    {{ in_array($subcat->id, old('categories', $selCats)) ? 'selected' : '' }}>
                                                    &emsp; &emsp; {{ $subcat->category_name }} (Sub Category)
                                                </option>
                                                @foreach ($subcat->subCategories as $subsubcat)
                                                    <option value="{{ $subsubcat->id }}" class="red-text"
                                                        {{ in_array($subsubcat->id, old('categories', $selCats)) ? 'selected' : '' }}>
                                                        &emsp; &emsp; &emsp; &emsp; {{ $subsubcat->category_name }} (Sub
                                                        Sub Category)
                                                    </option>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <span style="color: red; font-size: 13px;">{{ $errors->first('categories') }}</span>
                                </div>

                                <div class="form-group">
                                    <label>Click to select Brands</label>
                                    <select name="brands[]" multiple class="form-select select2" id="selectBrands">
                                        @foreach ($getBrands as $brand)
                                            <option value="{{ $brand['id'] }}"
                                                @if (in_array($brand['id'], $selBrands)) selected @endif>
                                                ⚫{{ $brand['brand_name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span style="color: red; font-size: 13px;">{{ $errors->first('brands') }}</span>
                                </div>

                                {{-- select users --}}
                                <div class="form-group">
                                    <label>Click to select Users</label>
                                    <select name="users[]" multiple class="form-select select2" id="selectUsers">

                                        @foreach ($getUsers as $user)
                                            <option value="{{ $user['email'] }}"
                                                @if (in_array($user['email'], $selUsers)) selected @endif>
                                                ⚫{{ $user['email'] }}
                                            </option>
                                        @endforeach
                                    </select>
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
@endsection
