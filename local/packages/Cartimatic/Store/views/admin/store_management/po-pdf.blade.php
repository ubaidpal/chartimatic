<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Purchase Order Print</title>
    <style>
        body{font-size: 12px;}
    </style>
</head>
<body>
<div>
    <h2 style="text-align: center;">Purchase Order</h2>
    <table width="100%">
        <tbody>
            <tr>
                <td width="20%">PO Number:</td>
                <td>{{$po->id}}</td>
            </tr>
            <tr>
                <td width="20%">Reference No:</td>
                <td>{{$po->reference_no}}</td>
            </tr>
            <tr>
                <td width="20%">Invoice Date:</td>
                <td>{{$po->invoice_date}}</td>
            </tr>
            <tr>
                <td width="20%">Delivery Date:</td>
                <td>{{$po->delivery_date}}</td>
            </tr>
            <tr>
                <td width="20%">Destination Address:</td>
                <td>{{$po->destination_address}}</td>
            </tr>
        </tbody>
    </table>

    <table width="100%" style="border: 1px solid #000;margin-top: 15px;">
        <thead>
            <tr>
                <th width="5%" style="text-align: center;border-bottom: 1px solid #000;">No</th>
                <th style="text-align: left;border-bottom: 1px solid #000;">Name</th>
                <th style="text-align: left;border-bottom: 1px solid #000;">&nbsp;</th>
                <th style="text-align: left;border-bottom: 1px solid #000;">&nbsp;</th>
                <th width="7%" style="text-align: center;border-bottom: 1px solid #000;">Quantity</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $counter = 1;
            $total = 0;
            ?>
            @foreach($poProducts as $product)
            <tr>
                <td style="text-align: center;border-bottom: 1px solid #000;">{{$counter++}}</td>
                <td style="border-bottom: 1px solid #000;">{{$product->name}}</td>
                <td style="border-bottom: 1px solid #000;">{{$product->master_attribute_1}}</td>
                <td style="border-bottom: 1px solid #000;">{{$product->master_attribute_2}}</td>
                <td style="text-align: center;border-bottom: 1px solid #000;">{{$product->quantity}}</td>

            </tr>
            @endforeach

        </tbody>
    </table>
</div>