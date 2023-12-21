<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="author" content="SpecBits" />
    <title>Bharat Electric Bill Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            margin: 0 !important;
            padding: 0 !important;
        }

        .subtitle {
            font-size: 12px;
        }

        td {
            font-weight: 500;
            font-size: 10px;
        }

        th {
            font-size: 11px;
        }

        .toptble td,
        .toptble th {
            font-size: 12px;
        }

        th:last-child,
        td:last-child {
            text-align: right;
        }

        .my-bdr-top-right {
            border-top: 1px solid #fff !important;
            border-right: 1px solid #fff !important;
        }

        .my-bdr-top {
            border-top: 1px solid #fff !important;
        }

        .my-bdr-bottom {
            border-bottom: 1px solid #fff !important;
        }

        .my-bdr-left {
            border-left: 1px solid #fff !important;
        }

        .my-bdr-right {
            border-right: 1px solid #fff !important;
        }

        .border-right-left {
            border-left: 1px solid #fff !important;
            border-right: 1px solid #fff !important;
        }

        .address p {
            font-size: 12px;
        }

        .mytbl {
            border-color: #dee2e6 !important;
        }

        .mytbl th {
            border-top: 1px solid #fff !important;
        }

        .mytbl th:last-child {
            border-right: 1px solid #fff !important;
        }

        .mytbl th:first-child {
            border-left: 1px solid #fff !important;
        }

        .mytbl td,
        .mytbl th {
            border-right: 1px solid #dee2e6;
        }

        .mytbl td:last-child {
            border-right: 1px solid #fff !important;
        }

        .mytbl td:first-child {
            border-left: 1px solid #fff !important;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="border">
        <div class="row">
            <div class="col-12 pt-1">
                <div class="px-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <p style="font-size: 13px;"></p>
                        <p style="font-size: 13px;"><i>Original Copy</i></p>
                    </div>
                    <div class="text-center mb-3">
                        <p class=" text-decoration-underline">Cash/Credit Memo</p>
                        <h4 style="text-transform: uppercase; font-weight: bold;">BE Invoice</h4>
                        <p class="subtitle">MOHAN BIGHA, DEHRI ON SONE</p>
                        <p class="subtitle">ROHTAS, 821307 <i>Tel. : <span>7250981144</span></i></p>
                        <p class="subtitle"></p>
                    </div>
                </div>
                <div>
                    <table class="table table-bordered mb-0 border-right-left toptble">
                        <tbody>
                            <tr>
                                <td class="border-end">
                                    <div class="row">
                                        <div class="col-3">Invoice No.</div>
                                        <div class="col-1">:</div>
                                        <div class="col-8">{{$historyID->s_h_bill_no}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">Dated</div>
                                        <div class="col-1">:</div>
                                        <div class="col-8">{{implode("-",array_reverse(explode("-",$historyID->s_h_bill_date)))}}</div>
                                    </div>
                                </td>
                                <td class="text-start">
                                    <div class="row">
                                        <div class="col-4">Transport</div>
                                        <div class="col-1">:</div>
                                        <div class="col-7"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">Vehicle No.</div>
                                        <div class="col-1">:</div>
                                        <div class="col-7"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="address">
                                <td class="border-end">
                                    <p class=""><i>Billed to :</i></p>
                                    <p style="text-align: justify; word-wrap:break-word;">{{$customer->c_add}}</p>
                                    <p class="mt-2">CUSTOMER PHONE : {{$customer->c_smob}}</p>
                                </td>
                                <td class="text-start">
                                    <p class=""><i>Shipped to :</i></p>
                                    <p style="text-align: justify; word-wrap:break-word;">{{$customer->c_add}}</p>
                                    <p class="mt-2">CUSTOMER PHONE : {{$customer->c_smob}}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @php
                    $serial = 1;
                    $total = 0;
                    @endphp
                    <table class="mytbl border-right-left w-100 ">
                        <thead>
                            <tr class="border-bottom">
                                <th>S.N.</th>
                                <th>Description of Goods</th>
                                <th>Qty</th>
                                <th>Unit</th>
                                <th>List Price</th>
                                <th>Discount</th>
                                <th>Price</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $res)
                            <tr>
                                <td>{{$serial++}}</td>
                                <td>{{$res['s_i_item_name']}}</td>
                                <td>{{sprintf('%.2f',$res['s_i_qty'])}}</td>
                                <td>{{$res['s_i_unit_new']}}</td>
                                <td>{{sprintf('%.2f',$res['s_i_rate'])}}</td>
                                <td>{{sprintf('%.2f',$res['s_i_discount'])}}%</td>
                                <td>{{sprintf('%.2f',$res['s_i_rate'] * ((100 - $res['s_i_discount']) / 100))}}</td>
                                <td>{{sprintf('%.2f',$res['s_i_rate'] * ((100 - $res['s_i_discount']) / 100) * $res['s_i_qty'])}}</td>
                            </tr>
                            @php
                            $total += $res['s_i_rate'] * ((100 - $res['s_i_discount']) / 100) * $res['s_i_qty'];
                            @endphp
                            @endforeach
                            @foreach ($newSelling as $res)
                            <tr>
                                <td>{{$serial++}}</td>
                                <td>{{$res['s_i_item_name']}}</td>
                                <td>{{sprintf('%.2f',$res['s_i_qty'])}}</td>
                                <td>{{$res['s_i_unit_new']}}</td>
                                <td>{{sprintf('%.2f',$res['s_i_rate'])}}</td>
                                <td>{{sprintf('%.2f',$res['s_i_discount'])}}%</td>
                                <td>{{sprintf('%.2f',$res['s_i_rate'] * ((100 - $res['s_i_discount']) / 100))}}</td>
                                <td>{{sprintf('%.2f',$res['s_i_rate'] * ((100 - $res['s_i_discount']) / 100) * $res['s_i_qty'])}}</td>
                            </tr>
                            @php
                            $total += $res['s_i_rate'] * ((100 - $res['s_i_discount']) / 100) * $res['s_i_qty'];
                            @endphp
                            @endforeach
                            <tr class="border-top">
                                <td colspan="5" class="text-center  my-bdr-right"></td>
                                <td colspan="2">L & T Charges</td>
                                <td colspan="1" class="">
                                    {{sprintf('%.2f',$historyID->s_h_other)}}
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <td colspan="5" class="text-center  my-bdr-right"></td>
                                <td colspan="2">Invoice Total</td>
                                <td colspan="1" class="">
                                    {{sprintf('%.2f',$total+=$historyID->s_h_other)}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="w-50">
                        <thead>
                            <tr class="border-bottom my-bdr-right">
                                <th>Prev. Dues</th>
                                <th>Grand Total</th>
                                <th>Paid</th>
                                <th>Dues</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-bottom border-right">
                                <td>{{sprintf('%.2f',$historyID->s_h_pre)}}</td>
                                <td>{{sprintf('%.2f',$total+=$historyID->s_h_pre)}}</td>
                                <td>{{sprintf('%.2f',$historyID->s_h_paid)}}</td>
                                <td>{{sprintf('%.2f',$total-=$historyID->s_h_paid)}}</td>
                            </tr>
                        </tbody>
                    </table>
                    @php
                    $number = $total;
                    $no = floor($number);
                    $point = round($number - $no, 2) * 100;
                    $hundred = null;
                    $digits_1 = strlen($no);
                    $i = 0;
                    $str = array();
                    $words = array('0' => '', '1' => 'One', '2' => 'Two',
                    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
                    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
                    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
                    '13' => 'Thirteen', '14' => 'Fourteen',
                    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
                    '18' => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty',
                    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
                    '60' => 'Sixty', '70' => 'Seventy',
                    '80' => 'Eighty', '90' => 'Ninety');
                    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');

                    while ($i < $digits_1) { $divider=($i==2) ? 10 : 100; $number=floor($no % $divider); $no=floor($no / $divider); $i +=($divider==10) ? 1 : 2; if ($number) { $plural=(($counter=count($str)) && $number> 9) ? 'S' : null;
                        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                        $str [] = ($number < 21) ? $words[$number] . " " . $digits[$counter] . $plural . " " . $hundred : $words[floor($number / 10) * 10] . " " . $words[$number % 10] . " " . $digits[$counter] . $plural . " " . $hundred; } else $str[]=null; } $str=array_reverse($str); $result=implode('', $str); $points=($point) ? " point " . $words[$point / 10] . " " . $words[$point=$point % 10] : '' ; @endphp <div class="border border-top-0 border-right-left">
                            <p class="p-2 " style="font-size: 15px;">Rupees {{$result}} Only</p>
                </div>
                <div class="border border-right-left my-bdr-bottom">
                    <div class="row p-0">
                        <div class="col-6">
                            <div class="p-2">
                                <p class="subtitle ">Terms & Conditions</p>
                                <p class="subtitle">1. ENQUIRY NO:-6204655198 (WHATSAPP/CALL) </p>
                                <p class="subtitle">2. BEET&PIPE ACCESSORIES WILL NOT BE TAKEN BACK </p>
                                <p class="subtitle">3. REPLACEMENT WITH IN 15 DAYS </p>
                                <p class="subtitle">4. WEDNESDAY CLOSING </p>
                                <p class="subtitle">5. REPLACEMENT AFTER 12:30PM </p>
                            </div>
                        </div>
                        <div class="col-6 border-start ps-0">
                            <div class="border-bottom p-1">
                                <p class="subtitle ">Receiver's Signature :</p>
                            </div>
                            <div class="p-2">
                                <h6 class="text-end " style="font-size: 13px;">For CASH CREDIT MEMO</h6>
                                <h6 class="text-end mt-5 " style="font-size: 13px;">Authorised Signatory</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = "{{url('sales-entry')}}";
        }, 1000);
    </script>
</body>

</html>