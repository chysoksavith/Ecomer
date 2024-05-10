@extends('client.layouts.layout')
@section('content')
    <div class="containContactUs">
        <div class="MapContain">
            <span>Comming Soon</span>
        </div>
        <div class="EmailSendContain">
            <form action="{{ url('contact-us') }}" id="formContactUs" method="post">
                @csrf
                <div class="MainSendEmail">
                    <span class="notamember">
                        Write Us
                    </span>
                    <span class="detailResetpASS">
                        Jot us a note and we’ll get back to you as quickly as possible.
                    </span>
                    <p id="forgot-success"></p>
                    <div class="inputFiel">
                        <label class="tileLabelLogin">Name <span class="redValidation">*</span></label>
                        <input type="text" id="contact-name" name="name" class="inputLogin"
                            value="{{ old('name') }}">
                        <p class="-error"></p>
                    </div>
                    <div class="inputFiel">
                        <label class="tileLabelLogin">Email <span class="redValidation">*</span></label>
                        <input type="email" id="contact-email" name="email" class="inputLogin"
                            value="{{ old('email') }}">
                        <p class="-error"></p>
                    </div>
                    <div class="inputFiel">
                        <label class="tileLabelLogin">Subject <span class="redValidation">*</span></label>
                        <input type="text" id="contact-subject" name="subject" class="inputLogin"
                            value="{{ old('subject') }}">
                        <p class="-error"></p>
                    </div>
                    <div class="inputFiel">
                        <label class="tileLabelLogin">Message <span class="redValidation">*</span></label>
                        <textarea name="message" rows="4" id="contact-message">{{ old('message') }}</textarea>
                        <p class="-error"></p>
                    </div>
                    <div class="btnContactUs" style="margin-top: 40px">
                        <button type="submit" class="SignUptBtn" style="width: 200px">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="section__infoShop">
        <div class="box__info">
            <span class="main__ifo">
                SHOP ADDRESS
            </span>
            <ul class="ul__infoShop">
                <li class="li__info">
                    <span class="tex__shop">
                        SHOP AND SHIPPING ADDRESS
                    </span>

                </li>
                <li>
                    <span class="tex__shop_lighter">
                        SHOP AND SHIPPING ADDRESS
                    </span>
                </li>
            </ul>
            <ul class="ul__infoShop">
                <li class="li__info">
                    <span class="tex__shop">
                        OPENING HOURS
                    </span>

                </li>
                <li>
                    <span class="tex__shop_lighter">
                        Monday-Friday: 10-17 CET
                    </span>

                </li>
                <li>
                    <span class="tex__shop_lighter">
                        Saturday: 10-13 CET
                    </span>
                </li>
            </ul>
            <ul class="ul__infoShop">
                <li class="li__info">
                    <span class="tex__shop">
                        BILLING ADDRESS
                    </span>

                </li>
                <li>
                    <span class="tex__shop_lighter">
                        Phnom Penh Stt 2003 Cambodia
                    </span>

                </li>

            </ul>
        </div>
        <div class="box__info">
            <span class="main__ifo">
                CONTACT US
            </span>
            <ul class="ul__infoShop">
                <li class="li__info">
                    <span class="tex__shop">
                        PHONE NUMBER
                    </span>

                </li>
                <li>
                    <span class="tex__shop_lighter">
                        +12121221212
                    </span>
                </li>
            </ul>
            <ul class="ul__infoShop">
                <li class="li__info">
                    <span class="tex__shop">
                        EMAIL ADDRESS
                    </span>

                </li>
                <li>
                    <span class="tex__shop_lighter">
                        Sike@gmail.com
                    </span>

                </li>
                <li>
                    <span class="tex__shop_lighter">
                        Answering mail is not limited to our opening hours. We will reply as soon as possible. Please use
                        this contact form to send us a message.

                    </span>
                </li>
            </ul>
            <ul class="ul__infoShop">
                <li class="li__info">
                    <span class="tex__shop">
                        BILLING ADDRESS
                    </span>

                </li>
                <li>
                    <span class="tex__shop_lighter">
                        Phnom Penh Stt 2003 Cambodia
                    </span>

                </li>

            </ul>
        </div>
        <div class="box__info">
            <span class="main__ifo">
                PAYMENT OPTIONS
            </span>
            <ul class="ul__infoShop">
                <li class="li__info">
                    <span class="tex__shop">
                        BANK NAME (ABA)
                    </span>

                </li>
                <li>
                    <span class="tex__shop_lighter">
                        ******* (*****)
                    </span>
                </li>
            </ul>

        </div>
        <div class="box__info">
            <span class="main__ifo">
                COMPANY
            </span>
            <ul class="ul__infoShop">
                <li class="li__info">
                    <span class="tex__shop">
                        COMPANY NAME
                    </span>

                </li>
                <li>
                    <span class="tex__shop_lighter">
                        sike
                    </span>
                </li>
            </ul>

        </div>
    </div>
@endsection
