{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 05-Dec-16 12:59 PM
    * File Name    : 

--}}
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GRN Print</title>
    <style>
        body {
            font-size: 12px;
        }
    </style>
</head>
<body>
<div>
    <h2 style="text-align: center;">GRN</h2>
    <table width="100%">
        <tbody>
        <tr>
            <td width="20%">GRN Number:</td>
            <td>{{$grn['id']}}</td>
        </tr>
        <tr>
            <td width="20%">Bill No:</td>
            <td>{{$grn['bill_no']}}</td>
        </tr>
        <tr>
            <td width="20%">Bill Date:</td>
            <td>{{\Carbon\Carbon::parse($grn['bill_date'])->format('d-m-Y')}}</td>
        </tr>
        <tr>
            <td width="20%">Payment Mode:</td>
            <td>{{$grn['payment_mode']}}</td>
        </tr>
        @if(!empty($grn['invoice_number']))
            <tr>
                <td width="20%">Invoice Number:</td>
                <td>{{$grn['invoice_number']}}</td>
            </tr>
            <tr>
                <td width="20%">Invoice Amount:</td>
                <td>{{format_currency($grn['invoice_amount'])}}</td>
            </tr>
        @endif
        <tr>
            <td width="20%">Loading Expense:</td>
            <td>{{format_currency($grn['loading_expense'])}}</td>
        </tr>
        <tr>
            <td width="20%">Freight Expense:</td>
            <td>{{format_currency($grn['freight_expense'])}}</td>
        </tr>
        <tr>
            <td width="20%">Other Expense:</td>
            <td>{{format_currency($grn['other_expense'])}}</td>
        </tr>
        <tr>
            <td width="20%">Adj Expense:</td>
            <td>{{format_currency($grn['adj_amount'])}}</td>
        </tr>
        <tr>
            <td width="20%">Sales Tax:</td>
            <td>{{$grn['sales_tax']}}%</td>
        </tr>
        <tr>
            <td width="20%">Sales Tax Amount:</td>
            <td>{{format_currency($grn['sales_tax_amount'])}}</td>
        </tr>
        <tr>
            <td width="20%">Total Amount:</td>
            <td>{{format_currency($grn['total_amount'])}}</td>
        </tr>
        </tbody>
    </table>

    <table width="100%" style="border: 1px solid #000;margin-top: 15px;">
        <thead>
        <tr>
            <th width="5%" style="text-align: center;border-bottom: 1px solid #000;">No</th>
            <th style="text-align: left;border-bottom: 1px solid #000;">Name</th>
            <th width="7%" style="text-align: center;border-bottom: 1px solid #000;">Quantity</th>
            <th width="15%" style="text-align: center;border-bottom: 1px solid #000;">Unit Price</th>
            <th width="20%" style="text-align: center;border-bottom: 1px solid #000;">Total</th>

        </tr>
        </thead>
        <tbody>
        <?php
        $counter = 1;
        $total = 0;
        ?>
        @foreach($grn['products'] as $product)
            <tr>
                <td style="text-align: center;border-bottom: 1px solid #000;">{{$counter++}}</td>
                <td style="border-bottom: 1px solid #000;">{{$product['product_name']}}</td>
                <td style="text-align: center;border-bottom: 1px solid #000;">{{$product['quantity']}}</td>
                <td style="text-align: center;border-bottom: 1px solid #000;">{{$product['price']}}</td>
                <td style="text-align: center;border-bottom: 1px solid #000;">{{$product['quantity'] * $product['price']}}</td>
            </tr>
            <?php $total += ($product['quantity'] * $product['price']); ?>
        @endforeach
        <tr>
            <td colspan="3"></td>
            <td style="text-align: center;"><b>Total</b></td>
            <td style="text-align: center;"><b>{{$total}}</b></td>
        </tr>
        </tbody>
    </table>
</div>
