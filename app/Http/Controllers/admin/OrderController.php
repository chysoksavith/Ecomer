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
            <meta charset="utf-8">
            <title>Example 2</title>
            <style>
              @font-face {
                font-family: SourceSansPro;
                src: url(SourceSansPro-Regular.ttf);
              }

              .clearfix:after {
                content: "";
                display: table;
                clear: both;
              }

              a {
                color: #0087C3;
                text-decoration: none;
              }

              body {
                position: relative;
                width: 18cm;
                height: 29.7cm;
                margin: 0 auto;
                color: #555555;
                background: #FFFFFF;
                font-family: Arial, sans-serif;
                font-size: 14px;
                font-family: SourceSansPro;
              }

              header {
                padding: 10px 0;
                margin-bottom: 20px;
                border-bottom: 1px solid #AAAAAA;
              }

              #logo {
                float: left;
                margin-top: 8px;
              }

              #logo img {
                height: 70px;
              }

              #company {
                float: right;
                text-align: right;
              }


              #details {
                margin-bottom: 50px;
              }

              #client {
                padding-left: 6px;
                border-left: 6px solid #0087C3;
                float: left;
              }

              #client .to {
                color: #777777;
              }

              h2.name {
                font-size: 1.4em;
                font-weight: normal;
                margin: 0;
              }

              #invoice {
                float: right;
                text-align: right;
              }

              #invoice h1 {
                color: #0087C3;
                font-size: 2.4em;
                line-height: 1em;
                font-weight: normal;
                margin: 0  0 10px 0;
              }

              #invoice .date {
                font-size: 1.1em;
                color: #777777;
              }

              table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
              }

              table th,
              table td {
                padding: 20px;
                background: #EEEEEE;
                text-align: center;
                border-bottom: 1px solid #FFFFFF;
              }

              table th {
                white-space: nowrap;
                font-weight: normal;
              }

              table td {
                text-align: right;
              }

              table td h3{
                color: #57B223;
                font-size: 1.2em;
                font-weight: normal;
                margin: 0 0 0.2em 0;
              }

              table .no {
                color: #FFFFFF;
                font-size: 1.6em;
                background: #57B223;
              }

              table .desc {
                text-align: left;
              }

              table .unit {
                background: #DDDDDD;
              }

              table .qty {
              }

              table .total {
                background: #57B223;
                color: #FFFFFF;
              }

              table td.unit,
              table td.qty,
              table td.total {
                font-size: 1.2em;
              }

              table tbody tr:last-child td {
                border: none;
              }

              table tfoot td {
                padding: 10px 20px;
                background: #FFFFFF;
                border-bottom: none;
                font-size: 1.2em;
                white-space: nowrap;
                border-top: 1px solid #AAAAAA;
              }

              table tfoot tr:first-child td {
                border-top: none;
              }

              table tfoot tr:last-child td {
                color: #57B223;
                font-size: 1.4em;
                border-top: 1px solid #57B223;

              }

              table tfoot tr td:first-child {
                border: none;
              }

              #thanks{
                font-size: 2em;
                margin-bottom: 50px;
              }

              #notices{
                padding-left: 6px;
                border-left: 6px solid #0087C3;
              }

              #notices .notice {
                font-size: 1.2em;
              }

              footer {
                color: #777777;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #AAAAAA;
                padding: 8px 0;
                text-align: center;
              }


            </style>
          </head>
          <body>
            <header class="clearfix">
              <div id="logo">
              </div>
              <div id="company">
                <h2 class="name">Sike</h2>
                <div> Stt 2003, Phnom Penh AZ 85004, Cambodia</div>
                <div>(602) 519-0450</div>
                <div><a href="mailto:company@example.com">sike@example.com</a></div>
              </div>
              </div>
            </header>
            <main>
              <div id="details" class="clearfix">
                <div id="client">
                  <div class="to">ORDER NUMBER</div>
                  <h2 class="name">' . $orderDetails['id'] . '</h2>
                  <div><span>DATE</span> ' . $orderDetails['created_at'] . '</div>
                  <div class="address">
                    <span>BILLING ADDRESS</span>
                    ' . $orderDetails['user']['name'] . ',' .
            $orderDetails['user']['address'] . ',' .
            $orderDetails['user']['city'] . ', ' .
            $orderDetails['user']['state'] . ',' .
            $orderDetails['user']['country'] . ',' .
            $orderDetails['user']['pincode'] . ',
                  </div>
                  <div  class="address">
                    <span>DELIVERY ADDRESS</span>
                    ' . $orderDetails['name'] . ',' . $orderDetails['address'] .
            ',' . $orderDetails['city'] . ', ' . $orderDetails['state']
            . ',' . $orderDetails['country'] . ',' .
            $orderDetails['pincode'] . ',
                </div>
                </div>
              </div>
              <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                  <tr>
                    <th class="desc">Product</th>
                    <th class="unit">Size</th>
                    <th class="unit">Color</th>
                    <th class="unit">UNIT PRICE</th>
                    <th class="qty">QUANTITY</th>
                    <th class="total">TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                  ';
        $total_price = 0;
        foreach ($orderDetails['orders_products'] as $order) {
            $product_total = $order['product_price'] *
                $order['product_qty'];
            $total_price += $product_total;
            $output .= '
                  <tr>
                    <td class="desc"><h3>  ' . $order['product_code'] . '</h3></td>
                    <td class="unit">' . $order['product_size'] . '</td>
                    <td class="unit">' . $order['product_color'] . '</td>
                    <td class="unit">' . $order['product_price'] . '</td>
                    <td class="qty">' . $order['product_qty'] . '</td>
                    <td class="total">' . $product_total . '</td>
                  </tr>
                  ';
        }
        $output .= '
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="3"></td>
                    <td colspan="2">SUBTOTAL</td>
                    <td class="total">$' . $total_price . '</td>
                  </tr>
                  <tr>
                    <td colspan="3"></td>
                    <td colspan="2">SHIPPING CHARGES</td>
                    <td class="total"> $ ' . $orderDetails['shipping_charges'] . '</td>
                  </tr>
                  <tr>
                    <td colspan="3"></td>
                    <td colspan="2">COUPON DISCOUNT</td>
                    <td class="total">
                      $' . ($orderDetails['coupon_amount'] > 0 ?
            $orderDetails['coupon_amount'] : 0) . '
                     </td>
                  </tr>
                  <tr>
                    <td colspan="3"></td>
                    <td colspan="2">GRAND TOTAL</td>
                    <td class="total">
                      $' . $orderDetails['grand_total'] . '
                     </td>
                  </tr>
                </tfoot>
              </table>
              ';
        $output .= '
              <div id="thanks">Thank you!</div>
              <div id="notices">
                <div>NOTICE:</div>
                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
              </div>
            </main>
            <footer>
              Invoice was created on a computer and is valid without the signature and seal.
            </footer>
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
