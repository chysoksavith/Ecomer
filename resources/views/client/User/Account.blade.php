@extends('client.layouts.layout')
@section('content')
    <div class="containerAccount">
        <div class="leftContainAcc">
            <div class="leftAcc">
                <span class="accSpan">
                    Hello {{ Auth::user()->name }}
                </span>
                <ul class="acc">
                    <li>
                        <a href="" class="hoverunderLine">
                            My Billing Contact Address
                        </a>
                    </li>
                    <li>
                        <a href="" class="hoverunderLine">
                            My Orders
                        </a>
                    </li>
                    <li>
                        <a href=""class="hoverunderLine">
                            My WishList
                        </a>
                    </li>
                    <li>
                        <a href=""class="hoverunderLine">
                            Update Password
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="rightContainAcc">
            <form name="accountForm" id="accountForm" action="javascript:;" method="post">
                @csrf
                <div class="leftform">
                    <span class="notamember">
                        My Billing/Contact Address
                    </span>
                    <span class="detailResetpASS">
                        Please add your Billing/Contact Address
                    </span>
                    <form action="" class="fromBilling">
                        @csrf
                        {{-- name address --}}
                        <div class="coverFromBill">
                            <div class="inputFiel">
                                <label class="tileLabelLogin">Name <span class="redValidation">*</span></label>
                                <input type="text" class="inputbilling" id="billing-name" name="name"
                                    value="{{ Auth::user()->name }}">
                                <p id="account-name"></p>
                            </div>
                            <div class="inputFiel">
                                <label class="tileLabelLogin">Email <span class="redValidation">*</span></label>
                                <input type="email" class="inputbilling" id="billing-emal" name="email"
                                    value="{{ Auth::user()->email }}">
                                <p id="account-email"></p>
                            </div>
                        </div>
                        {{-- city state  --}}
                        <div class="coverFromBill">
                            <div class="inputFiel">
                                <label class="tileLabelLogin">City <span class="redValidation">*</span></label>
                                <input type="text" class="inputbilling" id="billing-city" name="city"
                                    value="{{ Auth::user()->city }}">
                                <p id="account-city"></p>
                            </div>
                            <div class="inputFiel">
                                <label class="tileLabelLogin">State <span class="redValidation">*</span></label>
                                <input type="text" class="inputbilling" id="billing-state" name="state"
                                    value="{{ Auth::user()->state }}">
                                <p id="account-state"></p>
                            </div>
                        </div>
                        {{-- country pincode --}}
                        <div class="coverFromBill">
                            <div class="inputFiel">
                                <label class="tileLabelLogin">Country <span class="redValidation">*</span></label>
                                <select name="country" id="" class="inputbilling" required>
                                    <option value="" selected>Select Your Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country['country_name'] }}"
                                            @if ($country['country_name'] == Auth::user()->country) selected @endif>
                                            {{ $country['country_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <p id="account-country"></p>
                            </div>
                            <div class="inputFiel">
                                <label class="tileLabelLogin">Address <span class="redValidation">*</span></label>
                                <input type="text" class="inputbilling" id="billing-address" name="address"
                                    value="{{ Auth::user()->address }}">
                                <p id="account-address"></p>
                            </div>

                        </div>
                        {{-- mobile email --}}
                        <div class="coverFromBill">
                            <div class="inputFiel">
                                <label class="tileLabelLogin">Mobile <span class="redValidation">*</span></label>
                                <input type="number" class="inputbilling" id="billing-mobile" name="mobile"
                                    value="{{ Auth::user()->mobile }}">
                                <p id="account-mobile"></p>
                            </div>
                            <div class="inputFiel">
                                <label class="tileLabelLogin">Pincode <span class="redValidation">*</span></label>
                                <input type="text" class="inputbilling" id="billing-code" name="pincode"
                                    value="{{ Auth::user()->pincode }}">
                                <p id="account-pincode"></p>
                            </div>

                        </div>
                        <div class="coverFromBill btncoverformbill">
                            <button type="submit" class="SignIntBtnDetail">Save</button>
                        </div>
                    </form>
                </div>

        </div>
    </div>
@endsection
