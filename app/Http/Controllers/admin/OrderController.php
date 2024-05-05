<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRoles;
use App\Models\OrderLog;
use App\Models\Orders;
use App\Models\OrderStatus;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Return_;

class OrderController extends Controller
{
    public function Order()
    {
        Session::put('page', 'order');
        $orders = Orders::with('orders_products', 'user')->orderBy('id', 'Desc')->get()->toArray();
        // permission
        $orderModuleCount = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'orders'])->count();
        $ordersModule = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $ordersModule['view_access'] = 1;
            $ordersModule['edit_access'] = 1;
            $ordersModule['full_access'] = 1;
        } else if ($orderModuleCount == 0) {
            $message = "This feature is restricted for you";
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $ordersModule = AdminRoles::where(['subadmins_id' => Auth::guard('admin')->user()->id, 'module' => 'orders'])->first()->toArray();
        }
        return view('admin.order.order')->with(compact('orders', 'ordersModule'));
    }
    public function DetailOrder(Request $request, $id)
    {
        $orderDetails =  Orders::with('orders_products', 'user')->where('id', $id)->first()->toArray();
        // fetch order status
        $orderStatues = OrderStatus::where('status', 1)->get()->toArray();
        // fetch order log
        $orderLog = OrderLog::Where('order_id', $id)->get()->toArray();


        return view('admin.order.order_detail')->with(compact('orderDetails', 'orderStatues', 'orderLog'));
    }
    public function updateOrderStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // update order status
            Orders::where('id', $data['order_id'])->update(['order_status' => $data['order_status']]);
            // update courier name and tracking number
            if (!empty($data['courier_name']) && !empty($data['tracking_number'])) {
                Orders::where('id', $data['order_id'])->update([
                    'courier_name' => $data['courier_name'],
                    'tracking_number' => $data['tracking_number']
                ]);

                // Send Order shipped email to customer tracking details
                $orderDetails = Orders::with('orders_products', 'user')->where('id', $data['order_id'])->first()->toArray();
                // Send order shipped email
                $email =  $orderDetails['user']['email'];
                $messageData = [
                    'email' => $email,
                    'name' =>  $orderDetails['user']['name'],
                    'order_id' => $data['order_id'],
                    'order_status' => $data['order_status'],
                    'tracking_number' => $data['tracking_number'],
                    'courier_name' => $data['courier_name'],
                    'orderDetails' => $orderDetails,
                ];
                Mail::send('email.shipped_order', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Order Shipped');
                });
            }
            // update order log
            $log = new OrderLog;
            $log->order_id = $data['order_id'];
            $log->order_status = $data['order_status'];
            $log->save();




            $message = "Order status has been updated successfully ";
            return redirect()->back()->with('success_message', $message);
        }
    }
    // print invoice
    public function printHtmlOrderInvoice($order_id)
    {
        $orderDetails = Orders::with('orders_products', 'user')->where('id', $order_id)->first()->toArray();
        return view('admin.order.print-html-order-invoice')->with(compact('orderDetails'));
    }
    //print pdf
    public function printPdfOrderInvoice($order_id)
    {
        $orderDetails = Orders::with('orders_products', 'user')->where('id', $order_id)->first()->toArray();
        $output = '
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
                    font-weight: 700;
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
                @media (min-width: 992px) and (max-width: 1199.98px) {
                }

                /* Extra Large Devices (Large Desktops) */
                @media (min-width: 1200px) {
                    /* Your styles for extra large devices go here */
                }
            </style>

            <body>
                <div class="header_ship">
                    <span class="headerText"> Order# ' . $orderDetails['id'] . ' </span>
                    <span class="data"> ' . $orderDetails['created_at'] . ' </span>
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
                                    ';
        $total_price = 0;
        foreach ($orderDetails['orders_products'] as $order) {
            $product_total = $order['product_price'] *
                $order['product_qty'];
            $total_price +=
                $product_total;
            $output .= '
                                    <tr>
                                        <td data-label="Product name">
                                            ' . $order['product_name'] . '
                                        </td>
                                        <td data-label="Product Code">
                                            ' . $order['product_code'] . '
                                        </td>
                                        <td data-label="Price" class="a">
                                            ' . $order['product_price'] . ' $
                                        </td>
                                        <td data-label="Qty">
                                            ' . $order['product_qty'] . '
                                        </td>
                                        <td data-label="Subtotal" class="pro">
                                            ' . $product_total . '
                                        </td>
                                    </tr>
                                    ';
        }
        $output .= '
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td class="sub r" colspan="4">Subtotal</td>
                                        <td data-label="Subtotal" colspan="4" class="a">
                                        $' . $total_price . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="sub r" colspan="4">
                                            Shipping & Handling
                                        </td>
                                        <td
                                            data-label="Shipping & Handling"
                                            colspan="4"
                                        >
                                        $ ' . $orderDetails['shipping_charges'] . '
                                    </tr>
                                    <tr>
                                        <td class="sub r" colspan="4">
                                            Coupon Discount
                                        </td>

                                        <td data-label="Coupon Discount" colspan="4">
                                        $' . ($orderDetails['coupon_amount'] > 0 ?
            $orderDetails['coupon_amount'] : 0) . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="sub r z" colspan="4">Grand Total</td>
                                        <td
                                            data-label="Grand Total"
                                            colspan="4"
                                            class="a"
                                        >
                                        $' . $orderDetails['grand_total'] . '
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
                                    <span class="textUser">
                                        ' . $orderDetails['name'] . '
                                    </span>
                                </li>
                                <li>
                                    <span class="textUser">
                                        ' . $orderDetails['address'] . '
                                    </span>
                                </li>
                                <li>
                                    <span class="textUser">
                                        ' . $orderDetails['state'] . '
                                    </span>
                                </li>
                                <li>
                                    <span class="textUser">
                                        ' . $orderDetails['city'] . ' , ' . $orderDetails['pincode'] . '
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="box1">
                            <ul>
                                <li>
                                    <span class="textUser main"> Billing Address </span>
                                </li>
                                <li>
                                    <span class="textUser">
                                        ' . $orderDetails['user']['name'] . '
                                    </span>
                                </li>
                                <li>
                                    <span class="textUser">
                                        ' . $orderDetails['user']['address'] . '
                                    </span>
                                </li>
                                <li>
                                    <span class="textUser">
                                        ' . $orderDetails['user']['state'] . '
                                    </span>
                                </li>
                                <li>
                                    <span class="textUser">
                                        ' . $orderDetails['user']['country'] . ' , ' .
            $orderDetails['user']['pincode'] . '
                                    </span>
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
                                        order and will start the shipment</span
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--  -->
                    <div class="div_infoUSER">
                        <div class="box1">
                            <ul>
                                <li>
                                    <span class="textUser"> Thank you! </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </body>
        </html>

        ';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($output);
        //render the html to pdf
        $dompdf->render();
        // output generate
        $dompdf->stream();
    }
}
