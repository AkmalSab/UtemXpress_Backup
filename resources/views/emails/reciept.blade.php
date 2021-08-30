<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>A simple, clean, and responsive HTML invoice template</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>
<h1>Your order has been delivered. Thank You !</h1>
<br>
<div class="invoice-box">
    <table>
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="http://localhost:8000/img/company-logo.jpg" alt="Company logo" style="width: 100%; max-width: 300px" />
                        </td>
                        <td>
                            Order id: #{{$order->order_id}}<br />
                            Order Date: {{date('d M Y', strtotime($order->order_date))}}<br />
                            Order Time: {{date('g:i A', strtotime($order->order_time))}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            Universiti Teknikal Malaysia Melaka<br />
                            Jalan Hang Tuah Jaya,<br />
                            76100 Durian Tunggal, Melaka
                        </td>

                        <td>
                            To:
                            {{$user->name}}<br />
                            {{$user->email}}<br />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>Runner Name</td>

            <td>Runner Contact</td>
        </tr>

        <tr class="details">
            <td>{{$runner->name}}</td>

            <td>{{$runner->user_phone}}</td>
        </tr>

        <tr class="heading">
            <td>Pickup</td>

            <td>Drop Off</td>
        </tr>

        <tr class="details">
            <td>{{$order->order_pickup_location}}</td>

            <td>{{$order->order_dropoff_location}}</td>
        </tr>

        <tr class="heading">
            <td>Receiver's name</td>

            <td>Receiver's Contact</td>
        </tr>

        <tr class="details">
            <td>{{$order->receiver_name}}</td>

            <td>{{$order->receiver_phone}}</td>
        </tr>

        <tr class="heading">
            <td>Order Remarks</td>

            <td>Order Type</td>
        </tr>

        <tr class="details">
            <td>{{$order->order_remarks}}</td>

            <td>{{$order->order_type}}
                @if($order->vehicle_id == 1)
                    (Walk/Bicycle)
                @endif
                @if($order->vehicle_id == 2)
                    (Motorcycle)
                @endif
                @if($order->vehicle_id == 3)
                    (Car)
                @endif
            </td>
        </tr>

        <tr class="heading">
            <td>Payment Method</td>

            <td></td>
        </tr>

        <tr class="details">
            <td>Cash</td>

            <td></td>
        </tr>

        <tr class="heading">
            <td>Services</td>

            <td>Price</td>
        </tr>

        <tr class="item">
            <td>Base Price</td>

            <td>RM4.00</td>
        </tr>

        @if(isset($services))
            @foreach($services as $item)
                @if($item->service_id == 1)
                    <tr class="item">
                        <td>Xpress Bag</td>
                        <td>RM0.00</td>
                    </tr>
                @endif
                @if($item->service_id == 2)
                    <tr class="item">
                        <td>Buy For You</td>

                        <td>RM4.00</td>
                    </tr>
                @endif
                @if($item->service_id == 3)
                    <tr class="item">
                        <td>Return Trip</td>

                        <td>RM4.00</td>
                    </tr>
                @endif
                @if($item->service_id == 4)
                    <tr class="item">
                        <td>Door to Door</td>

                        <td>RM4.00</td>
                    </tr>
                @endif
            @endforeach
        @endif

        <tr class="item">
            <td>Distance Price</td>

            <td>RM{{number_format((float)$balance, 2, '.', '')}}</td>
        </tr>

        <tr class="total">
            <td></td>

            <td>Total: RM{{$order->order_fee}}</td>
        </tr>
    </table>
</div>
</body>
</html>
