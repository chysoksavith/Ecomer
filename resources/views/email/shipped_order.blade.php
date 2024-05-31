<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order</title>
</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap");

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        letter-spacing: 1px;
    }

    body {
        font-family: "Poppins", sans-serif;
    }

    .data {
        font-size: 14px;
    }

    .header_ship {
        padding: 40px 40px 80px;
        margin: auto;
        width: 80%;
    }

    .pro__info {
        background-color: #f8f8f8;
    }

    .headerText {
        display: block;
        margin-bottom: 30px;
        font-size: 48px;
        font-weight: 700;
    }

    .headerText1 {
        font-size: 48px;
        display: block;

        font-weight: 700;
    }

    .headerText2 {
        display: block;
        font-size: 18px;
        font-weight: 600;
    }

    .wrap_proInfo {
        margin-top: 30px;
        background-color: #f8f8f8;
        padding: 10px;
    }

    .table {
        width: 100%;

        border-collapse: collapse;
    }

    .table td,
    .table th {
        padding: 16px 16px 16px 36px;
        text-align: center;
        font-size: 14px;
    }

    .table th {
        border-bottom: 1px solid black;
        color: black;
    }

    .table tbody tr:nth-child(even) {
        background-color: white;
    }

    .text_sub {
        background-color: white;
        text-align: end !important;
    }

    .r {
        content: attr(data-label);
        font-weight: 400;
        text-align: end !important;
    }

    .z {
        font-weight: 600 !important;
    }

    .a {
        font-weight: 600 !important;
    }

    .div_infoUSER {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
    }

    .box1 {
        width: 25%;
    }

    .box1 ul {
        padding: 10px;
        list-style: none;
        font-size: 14px;
    }

    .box1 li {
        padding: 10px;
    }

    .main {
        font-size: 20px;
        font-weight: 600;
    }

    .ahref {
        text-decoration: none;
        font-weight: 600;
        color: black;

    }

    /* Small Devices (Mobile Portrait) */
    @media (max-width: 575.98px) {
        .headerText1 {
            font-size: 18px;
            display: block;

            font-weight: 700;
        }

        .headerText2 {
            display: block;
            font-size: 14px;
            font-weight: 600;
        }

        .div_infoUSER {
            display: block;
        }

        .box1 {
            width: 100%;
        }

        .table thead {
            display: none;
        }

        .sub {
            font-weight: lighter !important;
            display: none !important;
        }

        .container_ship {
            padding: px;
        }

        .wrap_proInfo {
            padding: 1px;
        }

        .table,
        .table tbody,
        .table tfoot,
        .table tr,
        .table td {
            display: block;
            width: 100%;
        }

        .table tr {
            margin-bottom: 15px;
        }

        .table td {
            padding-left: 50%;
            text-align: left;
            position: relative;
        }

        .table td::before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 50%;
            padding-left: 15px;
            font-size: 14px;
            font-weight: bold;
            text-align: left;
        }

        .pro {
            border-bottom: 2px solid black;
        }

        .header_ship {
            padding: 4px;
        }

    }

    /* Medium Devices (Tablet Landscape) */
    @media (min-width: 576px) and (max-width: 767.98px) {

        .headerText1 {
            font-size: 18px;
            display: block;

            font-weight: 700;
        }

        .headerText2 {
            display: block;
            font-size: 14px;
            font-weight: 600;
        }

        .div_infoUSER {
            display: block;
        }

        .box1 {
            width: 100%;
        }

        .table thead {
            display: none;
        }

        .sub {
            font-weight: lighter !important;
            display: none !important;
        }

        .container_ship {
            padding: px;
        }

        .wrap_proInfo {
            padding: 1px;
        }

        .table,
        .table tbody,
        .table tfoot,
        .table tr,
        .table td {
            display: block;
            width: 100%;
        }

        .table tr {
            margin-bottom: 15px;
        }

        .table td {
            padding-left: 50%;
            text-align: left;
            position: relative;
        }

        .table td::before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 50%;
            padding-left: 15px;
            font-size: 14px;
            font-weight: bold;
            text-align: left;
        }

        .pro {
            border-bottom: 2px solid black;
        }

        .header_ship {
            padding: 4px;
        }
    }

    /* Large Devices (Tablet Landscape) */
    @media (min-width: 768px) and (max-width: 991.98px) {

        .headerText1 {
            font-size: 18px;
            display: block;

            font-weight: 700;
        }

        .headerText2 {
            display: block;
            font-size: 14px;
            font-weight: 600;
        }

        .div_infoUSER {
            display: block;
        }

        .box1 {
            width: 100%;
        }

        .table thead {
            display: none;
        }

        .sub {
            font-weight: lighter !important;
            display: none !important;
        }

        .container_ship {
            padding: px;
        }

        .wrap_proInfo {
            padding: 1px;
        }

        .table,
        .table tbody,
        .table tfoot,
        .table tr,
        .table td {
            display: block;
            width: 100%;
        }

        .table tr {
            margin-bottom: 15px;
        }

        .table td {
            padding-left: 50%;
            text-align: left;
            position: relative;
        }

        .table td::before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 50%;
            padding-left: 15px;
            font-size: 14px;
            font-weight: bold;
            text-align: left;
        }

        .pro {
            border-bottom: 2px solid black;
        }

        .header_ship {
            padding: 4px;
        }
    }

    /* Large Devices (Desktops) */
    @media (min-width: 992px) and (max-width: 1199.98px) {}

    /* Extra Large Devices (Large Desktops) */
    @media (min-width: 1200px) {
        /* Your styles for extra large devices go here */
    }
</style>

<body>

    <div class="header_ship">
        <span class="headerText"> Order# {{ $order_id }} </span>
        @if (!empty($order_status))
            <span class="headerText2"> Order Status : {{ $order_status ?? 'None' }} </span>
        @endif
        <span class="data">
            {{ date('F j, g:i a', strtotime($orderDetails['created_at'])) }}
        </span>
        <!-- info product -->
        <div class="pro__info">
            <div class="wrap_proInfo">
                <table class="table">
                    <thead>
                        <th>Product name</th>
                        <th>Product Code</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </thead>
                    <tbody>
                        @php $total_price = 0; @endphp
                        @foreach ($orderDetails['orders_products'] as $orderProduct)
                            <tr>
                                <td data-label="Product name"> {{ $orderProduct['product_name'] }}</td>
                                <td data-label="Product Code">{{ $orderProduct['product_code'] }}</td>
                                <td data-label="Price" class="a">{{ $orderProduct['product_price'] }} $</td>
                                <td data-label="Qty">{{ $orderProduct['product_qty'] }}</td>
                                <td data-label="Subtotal" class="pro">
                                    {{ $orderProduct['product_price'] }}
                                </td>
                            </tr>
                        @endforeach
                        @php
                            $total_price += $orderProduct['product_price'] * $orderProduct['product_qty'];
                        @endphp
                    </tbody>

                    <tfoot>

                        <tr>
                            <td class="sub r" colspan="4">Subtotal</td>
                            <td data-label="Subtotal" colspan="4" class="a">
                                {{ $total_price }} $
                            </td>
                        </tr>
                        <tr>
                            <td class="sub r" colspan="4">
                                Shipping & Handling
                            </td>
                            <td data-label="Shipping & Handling" colspan="4">
                                {{ $orderDetails['shipping_charges'] }} $
                            </td>
                        </tr>
                        <tr>
                            <td class="sub r" colspan="4">
                                Coupon Discount
                            </td>

                            <td data-label="Coupon Discount" colspan="4">
                                @if ($orderDetails['coupon_amount'] > 0)
                                    ${{ $orderDetails['coupon_amount'] }}
                                @else
                                    <span class="zero-amount">$0</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="sub r z" colspan="4">Grand Total</td>
                            <td data-label="Grand Total" colspan="4" class="a">
                                {{ $orderDetails['grand_total'] }} $
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <span class="headerText1"> Order Information</span>
        <div class="div_infoUSER">
            <div class="box1">
                <ul>
                    <li>
                        <span class="textUser main"> Sike </span>
                    </li>
                    <li>
                        <span class="textUser"> Cambodia </span>
                    </li>
                    <li>
                        <span class="textUser">
                            Phone: 111-111-111 | Email: Sike@gmail.com
                        </span>
                    </li>


                </ul>
            </div>

            <div class="box1">
                <ul>
                    <li>
                        <span class="textUser main">
                            Delivery Address
                        </span>
                    </li>
                    <li>
                        <span class="textUser"> {{ $orderDetails['name'] }} </span>
                    </li>
                    <li>
                        <span class="textUser"> {{ $orderDetails['address'] }} </span>
                    </li>
                    <li>
                        <span class="textUser"> {{ $orderDetails['user']['city'] }},
                            {{ $orderDetails['user']['pincode'] }}
                        </span>
                    </li>
                    @if (!empty($order_status))
                        <li>
                            <span class="textUser">
                                <strong>Order status :</strong>
                                {{ $order_status ?? 'None' }}
                            </span>
                        </li>
                    @endif
                    @if (!empty($courier_name))
                        <li>
                            <span class="textUser">
                                <strong>
                                    Courier Name :
                                </strong>
                                {{ $courier_name ?? 'None' }}
                            </span>
                        </li>
                    @endif
                    @if (!empty($tracking_number))
                        <li>
                            <span class="textUser">
                                <strong>
                                    Tracking Number :
                                </strong>
                                {{ $tracking_number ?? 'None' }}
                            </span>
                        </li>
                    @endif

                </ul>
            </div>
            <div class="box1">
                <ul>
                    <li>
                        <span class="textUser main"> Billing Address </span>
                    </li>
                    <li>
                        <span class="textUser"> {{ $orderDetails['user']['name'] }} </span>
                    </li>
                    <li>
                        <span class="textUser">
                            {{ $orderDetails['user']['address'] }}
                        </span>
                    </li>
                    <li>
                        <span class="textUser"> {{ $orderDetails['user']['city'] }},
                            {{ $orderDetails['user']['pincode'] }}</span>
                    </li>
                </ul>
            </div>
            <div class="box1">
                <ul>
                    <li>
                        <span class="textUser main"> Method Payment</span>
                    </li>
                    <li>
                        <span class="textUser">
                            Bank Transfer - Pre-Payment
                        </span>
                    </li>
                    <li>
                        <span class="textUser">
                            Please send the total amount to the following
                            bank account number:
                        </span>
                    </li>
                    <li>
                        <span class="textUser"> SikeBay</span>
                    </li>
                    <li>
                        <span class="textUser"> Bank: ABA</span>
                    </li>
                    <li>
                        <span class="textUser">
                            Upon the transfer arrival, we will pack your
                            order and will start the shipment</span>
                    </li>
                </ul>
            </div>
        </div>
        <!--  -->
        <div class="div_infoUSER">
            <div class="box1">
                <ul>
                    <li>
                        <span class="textUser">
                            Download Order Invoice
                            <a href="{{ url('download-order-pdf-invoice/' . $order_id) }}" class="ahref">
                                Print Order
                            </a>
                        </span>
                    </li>
                    <li>
                        <span class="textUser">
                            (Copy & Paste to open if link does not work )
                        </span>
                    </li>
                    <li>
                        <span class="textUser"> Regards, Team Sike </span>
                    </li>
                    <li>
                        <span class="textUser"> Order Number: {{ $order_id }} </span>
                    </li>
                    <li>
                        <span class="textUser">
                            Order Date: {{ date('F j, g:i a', strtotime($orderDetails['created_at'])) }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
