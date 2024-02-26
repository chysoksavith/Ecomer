@extends('client.layouts.layout')
@section('content')
    <div class="containContactUs">
        <div class="MapContain">
            {{-- <iframe class="mappp"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15637.428379179912!2d104.84880514060058!3d11.526221476813099!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31094f1c34b114c5%3A0x6d918c28dfe9c040!2sHotel%2030!5e0!3m2!1sen!2skh!4v1706854371790!5m2!1sen!2skh"
                style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe> --}}

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
                        <p class="forgot-email"></p>
                    </div>
                    <div class="inputFiel">
                        <label class="tileLabelLogin">Email <span class="redValidation">*</span></label>
                        <input type="email" id="contact-email" name="email" class="inputLogin"
                            value="{{ old('email') }}">
                        <p class="forgot-email"></p>
                    </div>
                    <div class="inputFiel">
                        <label class="tileLabelLogin">Subject <span class="redValidation">*</span></label>
                        <input type="text" id="contact-subject" name="subject" class="inputLogin"
                            value="{{ old('subject') }}">
                        <p class="forgot-email"></p>
                    </div>
                    <div class="inputFiel">
                        <label class="tileLabelLogin">Message <span class="redValidation">*</span></label>
                        <textarea name="message" rows="4" id="contact-message">{{ old('message') }}</textarea>
                        <p class="forgot-email"></p>
                    </div>
                    <div class="btnContactUs" style="margin-top: 40px">
                        <button type="submit" class="SignUptBtn" style="width: 200px">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
    {{-- <script>
        var map = L.map('map').setView([11.5564, 104.9282], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    </script> --}}
@endsection
