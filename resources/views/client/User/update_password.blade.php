@extends('client.layouts.layout')
@section('content')
    <div class="containerAccount">
        <div class="leftContainAcc">
            <div class="leftAcc">
                @include('client.User.sidebarAccount')
            </div>
        </div>
        <div class="rightContainAcc">
                <div class="leftform">
                    <span class="notamember">
                        Update Password
                    </span>
                    <span class="detailResetpASS">
                       Please enter your current password to update your password
                    </span>
                    <form id="passwordForm" action="javascript:;" class="fromBilling" method="post">
                        @csrf
                        {{-- name address --}}
                        <div class="coverFromBill">
                            <div class="inputFiel">
                                <label class="tileLabelLogin">Current Password <span class="redValidation">*</span></label>
                                <input type="password" class="inputbilling" id="current_password passwordForm"  name="current_password">
                                <p id="password-current_password"></p>
                            </div>
                            <div class="inputFiel">
                                <label class="tileLabelLogin">New Password <span class="redValidation">*</span></label>
                                <input type="password" class="inputbilling" id="new_password passwordForm" name="new_password">
                                <p id="password-new_password"></p>
                            </div>
                        </div>
                        <div class="coverFromBill">
                            <div class="inputFiel">
                                <label class="tileLabelLogin">Confrim Password <span class="redValidation">*</span></label>
                                <input type="password" class="inputbilling" id="confirm_password passwordForm" name="confirm_password">
                                <p id="password-confirm_password"></p>
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
