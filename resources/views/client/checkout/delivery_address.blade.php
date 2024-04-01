<div class="radio-list">
    @if (!is_null($deliveryAddress) && count($deliveryAddress) > 0)
        @foreach ($deliveryAddress as $index => $address)
            <div class="radio-item">
                <input class="setDefaultStatus" type="radio" name="radio  address_id" id="radio{{ $address['id'] }}"
                    value="{{ $address['id'] }}" @if ($address['is_default'] == 1) checked @endif
                    data-addressid={{ $address['id'] }} />
                <label for="radio{{ $address['id'] }}">
                    <p>
                        {{ $address['name'] }},{{ $address['address'] }},{{ $address['city'] }},{{ $address['state'] }},{{ $address['country'] }}
                    </p>

                </label>

                <div class="divEditcheckout">
                    {{-- edit --}}
                    <button data-addressid={{ $address['id'] }} class="editaddress" id="editAddress">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16">
                            <path fill="currentColor"
                                d="M15.49 7.3h-1.16v6.35H1.67V3.28H8V2H1.67A1.21 1.21 0 0 0 .5 3.28v10.37a1.21 1.21 0 0 0 1.17 1.25h12.66a1.21 1.21 0 0 0 1.17-1.25z" />
                            <path fill="currentColor"
                                d="M10.56 2.87L6.22 7.22l-.44.44l-.08.08l-1.52 3.16a1.08 1.08 0 0 0 1.45 1.45l3.14-1.53l.53-.53l.43-.43l4.34-4.36l.45-.44l.25-.25a2.18 2.18 0 0 0 0-3.08a2.17 2.17 0 0 0-1.53-.63a2.19 2.19 0 0 0-1.54.63l-.7.69l-.45.44zM5.51 11l1.18-2.43l1.25 1.26zm2-3.36l3.9-3.91l1.3 1.31L8.85 9zm5.68-5.31a.91.91 0 0 1 .65.27a.93.93 0 0 1 0 1.31l-.25.24l-1.3-1.3l.25-.25a.88.88 0 0 1 .69-.25z" />
                        </svg>
                    </button>
                    {{-- delete --}}
                    <button data-addressid={{ $address['id'] }} id="deleteaddress">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M7.5 1h9v3H22v2h-2.029l-.5 17H4.529l-.5-17H2V4h5.5zm2 3h5V3h-5zM6.03 6l.441 15h11.058l.441-15zM13 8v11h-2V8z" />
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    @else
        <span>No Delivery Address Please add a new one !</span>
    @endif
</div>
