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

<body>
    @php
    $total = 0;
    $totalqty = 0;
    $grandTotal = 0;
    $totalTaxable = 0;
    $totalcgst = 0;
    $totalsgst = 0;
    $totalgst = 0;
    $uniqueItemHsns = $result->pluck('item_hsn')->unique()->toArray();
    $sums = [];
    foreach($uniqueItemHsns as $key => $hsn){
        $temp = 0;
        foreach($result as $r){
            if($hsn == $r->item_hsn){
                if($customer->c_type == 2){
                    $temp += $r->s_i_qty * $r->item_sale_rate_retail_base; // Added semicolon and fixed typo
                } else if($customer->c_type == 1){
                    $temp += $r->s_i_qty * $r->item_sale_rate_whole_base; // Added semicolon and fixed typo
                }
            }
        }
        $sums[$hsn] = $temp; // Fixed array assignment
    }
    @endphp

    <div class="border">
        <div class="row">
            <div class="col-12 pt-1">
                <div class="px-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <p style="font-size: 13px;">GSTIN : {{$admin->a_gst}}</p>
                        <p style="font-size: 13px;"><i>Original Copy</i></p>
                    </div>
                    <div class="text-center mb-3">
                        <p class=" text-decoration-underline"> TAX INVOICE</p>
                        <h4 class="">BHARAT ELECTRICALS</h4>
                        <p class="subtitle">MOHAN BIGHA, DEHRI ON SONE</p>
                        <p class="subtitle">ROHTAS, 821307 PAN : AOTPS7836R</p>
                        <p class="subtitle"><i>Tel. : <span>7250981144</span></i></p>
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
                                        <div class="col-8" id="invNo">BE-725/2023-24</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">Dated</div>
                                        <div class="col-1">:</div>
                                        <div class="col-8" id="invDate">04-07-2023</div>
                                    </div>
                                </td>
                                <td class="text-start">
                                    <div class="row">
                                        <div class="col-4">Place of Supply</div>
                                        <div class="col-1">:</div>
                                        <div class="col-7">
                                            @foreach ($state as $s)
                                                @if ($s->s_id == $customer->c_state)
                                                    {{$s->s_name}}
                                                    @break
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">Reverse Charge</div>
                                        <div class="col-1">:</div>
                                        <div class="col-7">N</div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="address">
                                <td class="border-end">
                                    <p class=""><i>Billed to :</i></p>
                                    <p style="text-transform: uppercase;">{{$customer->c_add}}</p>
                                    <!-- <p>SHIVA BIGHA, NABINAGAR, AURANGABAD 824301</p> -->
                                    <p class="mt-2">GSTIN / UIN : {{$customer->c_gst}}</p>
                                </td>
                                <td class="text-start">
                                    <p class=""><i>Shipped to :</i></p>
                                    <p style="text-transform: uppercase;">{{$customer->c_add}}</p>
                                    <!-- <p>SHIVA BIGHA, NABINAGAR, AURANGABAD 824301</p> -->
                                    <p class="mt-2">GSTIN / UIN : {{$customer->c_gst}}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="mytbl border-right-left w-100 ">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Description of Goods</th>
                                <th>HSN/SAC</th>
                                <th>Qty</th>
                                <th>Unit</th>
                                <th>List Price</th>
                                <th>Discount</th>
                                <th>Disc./Unit</th>
                                <th>Total Discount</th>
                                <th>Price</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        @php
                        $serial = 1;
                        @endphp
                        <tbody>
                            @foreach($result as $key=>$data)
                            @php
                            $temp = 0;
                            @endphp
                            <tr>
                                <td>{{$serial++}}.</td>
                                <td>{{$data->item_name}}</td>
                                <td>{{$data->item_hsn}}</td>
                                <td>{{sprintf("%.2f", $data->s_i_qty)}}</td>
                                <td>{{$data->item_sub_unit}}</td>
                                <td>{{sprintf("%.2f", $data->item_mrp)}}</td>
                                <td>{{sprintf("%.2f", 0)}}%</td>
                                <td>{{sprintf("%.2f", 0)}}</td>
                                <td>{{sprintf("%.2f", $data->s_h_dis)}}</td>
                                @if($customer->c_type == 1)
                                <td>{{sprintf("%.2f", ($data->item_sale_rate_whole_base)*(100/(100+$data->item_gst_slab)))}}</td>
                                @elseif($customer->c_type == 2)
                                <td>{{sprintf("%.2f", ($data->item_sale_rate_retail_base)*(100/(100+$data->item_gst_slab)))}}</td>
                                @endif
                                @if($customer->c_type == 1)
                                <td>{{sprintf("%.2f", $temp = ($data->s_i_qty*$data->item_sale_rate_whole_base)*(100/(100+$data->item_gst_slab)))}}</td>
                                @elseif($customer->c_type == 2)
                                <td>{{sprintf("%.2f", $temp = ($data->s_i_qty*$data->item_sale_rate_retail_base)*(100/(100+$data->item_gst_slab)))}}</td>
                                @endif
                            </tr>
                            @php
                            $total+=$temp;
                            $totalqty+=$data->s_i_qty;
                            @endphp
                            @endforeach
                            @foreach ($newSelling as $item)
                            @php
                            $temp = 0;
                            @endphp
                            <tr>
                                <td>{{$serial++}}.</td>
                                <td>{{$item->s_i_item_name}}</td>
                                <td></td>
                                <td>{{sprintf("%.2f", $item->s_i_qty)}}</td>
                                <td>{{$item->s_i_unit_new}}</td>
                                <td>{{sprintf("%.2f", $item->s_i_rate)}}</td>
                                <td>{{sprintf("%.2f", 0)}}%</td>
                                <td>{{sprintf("%.2f", 0)}}</td>
                                <td>{{sprintf("%.2f", 0)}}</td>
                                <td>{{sprintf("%.2f", $item->s_i_rate*(100/(100+$item->s_i_tax)))}}</td>
                                <td>{{sprintf("%.2f", $temp=$item->s_i_rate*(100/(100+$item->s_i_tax))*$item->s_i_qty)}}</td>
                            </tr>
                            @php
                            $total+=$temp;
                            $totalqty+=$item->s_i_qty;
                            @endphp
                            @endforeach
                            <tr class="border-top">
                                <td colspan="10"></td>
                                <td class=" text-end">
                                    {{sprintf("%.2f", $total)}}
                                </td>
                            </tr>
                            @php
                                $keys = array_values($uniqueItemHsns); // Extract values from the first array
                                $values = $sums[$keys[0]];   // Use the extracted value as a key to get the corresponding value from the second array
                                $combinedArray = [$keys[0] => $values];

                                $uniqueItemSlabs = $result->pluck('item_gst_slab')->unique()->toArray();
                                $uniqueNewItemSlabs = $newSelling->pluck('s_i_tax')->unique()->toArray();
                                $combinedUniqueSlabs = array_merge($uniqueItemSlabs, $uniqueNewItemSlabs);
                                $combinedUniqueSlabs = array_map(function($value) {
                                    return round(floatval($value), 2); // Adjust the precision (2 decimal places) as needed
                                }, $combinedUniqueSlabs);
                                $uniqueSlabs = array_unique($combinedUniqueSlabs);

                                $allItems = array_merge($result->toArray(), $newSelling->toArray());
                                //dd($allItems);

                                @endphp
                            @foreach($uniqueSlabs as $key=>$slab)
                            <tr>
                                <td colspan="4" class="my-bdr-top-right"></td>
                                <td colspan="4" class="my-bdr-top-right border-right-left">
                                    <i>Add : CGST</i>
                                </td>
                                <td colspan="1" class="text-end" style="border: 1px solid #fff;">
                                    @
                                </td>
                                <td class="my-bdr-top">
                                    {{$slab/2}}%
                                </td>
                                <td class="my-bdr-top">
                                @php
                                    $hold = 0;
                                @endphp

                                @foreach ($allItems as $item)
                                    @if (isset($item['item_id']) && $slab == $item['item_gst_slab'])
                                        @php
                                        $hold += ($item['s_i_rate']*$item['s_i_qty']* $item['item_gst_slab']/100)/2;
                                        @endphp
                                    @elseif (!isset($item['item_id']) && $slab == $item['s_i_tax'])
                                        @php
                                        $hold += ($item['s_i_rate']*$item['s_i_qty']* $item['s_i_tax']/100)/2;
                                        @endphp
                                    @endif
                                @endforeach

                                {{sprintf("%.2f",$hold)}}

                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="my-bdr-top-right"></td>
                                <td colspan="4" class="my-bdr-top-right border-right-left">
                                    <i>Add : SGST</i>
                                </td>
                                <td colspan="1" class="text-end" style="border: 1px solid #fff;">
                                    @
                                </td>
                                <td class="my-bdr-top">
                                    {{$slab/2}}%
                                </td>
                                <td class="my-bdr-top">
                                @php
                                    $hold = 0;
                                @endphp

                                @foreach ($allItems as $item)
                                    @if (isset($item['item_id']) && $slab == $item['item_gst_slab'])
                                        @php
                                        $hold += ($item['s_i_rate']*$item['s_i_qty']* $item['item_gst_slab']/100)/2;

                                        @endphp
                                    @elseif (!isset($item['item_id']) && $slab == $item['s_i_tax'])
                                        @php
                                        $hold += ($item['s_i_rate']*$item['s_i_qty']* $item['s_i_tax']/100)/2;

                                        @endphp
                                    @endif
                                @endforeach

                                {{sprintf("%.2f",$hold)}}
                                </td>
                            </tr>
                            @php
                            $grandTotal+=$hold*2;
                            @endphp
                            @endforeach
                            <tr>
                                <td colspan="4" class="my-bdr-top-right"></td>
                                <td colspan="4" class="my-bdr-top-right">
                                    @php
                                    $roundedValue = round($grandTotal+$total);
                                    $addedForRoundoff = $roundedValue - ($grandTotal+$total);
                                    @endphp
                                    <i>Add : Rounded Off @if ($addedForRoundoff >= 0)
                                        (+)
                                        @else
                                        (-)
                                        @endif</i>
                                </td>
                                <td colspan="2" class="my-bdr-top">

                                </td>
                                <td class="my-bdr-top">
                                    {{sprintf("%.2f", $addedForRoundoff)}}
                                </td>
                            </tr>
                            <tr class="border-top border-bottom">
                                <td colspan="2" class="text-center  my-bdr-right">Grand Total</td>
                                <td colspan="2" class="text-end  my-bdr-right ">{{sprintf("%.2f", $totalqty)}}</td>
                                <td class=" my-bdr-right">PCS</td>
                                <td colspan="5"></td>
                                <td class="">
                                    {{sprintf("%.2f", $grandTotal+=$total+$addedForRoundoff)}}
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <table class="mytbl border-right-left my-0 " style="width: 70%;">
                        <thead class="border-bottom">
                            <tr>
                                <th width="7%">HSN/SAC</th>
                                <th width="12.28%">Tax Rate</th>
                                <th width="12.28%">Taxable Amt.</th>
                                <th width="12.28%">CGST Amt.</th>
                                <th width="12.28%">SGST Amt.</th>
                                <th width="12.28%">Total Tax</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td width="7%">{{$item['item_hsn']}}</td>
                                <td width="12.28%">{{$item['item_gst_slab']}}%</td>
                                @php
                                    $baseprice = 0;
                                    foreach ($result as $r){
                                        if($item['item_hsn'] == $r->item_hsn){
                                            if($customer->c_type == 1){
                                                $baseprice += ($r->item_sale_rate_whole_base*(100/(100+$r->item_gst_slab))*$r->s_i_qty);
                                                $rootprice = $r->item_sale_rate_whole_base*$r->s_i_qty;
                                            } else {
                                                $baseprice += ($r->item_sale_rate_retail_base*(100/(100+$r->item_gst_slab))*$r->s_i_qty);
                                                $rootprice = $r->item_sale_rate_retail_base*$r->s_i_qty;
                                            }
                                        }
                                    }
                                @endphp
                                <td width="12.28%">{{sprintf("%.2f", $baseprice)}}</td>
                                <td width="12.28%">{{sprintf("%.2f", (($rootprice*$item['item_gst_slab'])/100)/2)}}</td>
                                <td width="12.28%">{{sprintf("%.2f", (($rootprice*$item['item_gst_slab'])/100)/2)}}</td>
                                <td width="12.28%">{{sprintf("%.2f", ($rootprice*$item['item_gst_slab'])/100)}}</td>
                                @php
                                $totalTaxable+=$baseprice;
                                $totalcgst+=(($rootprice*$item['item_gst_slab'])/100)/2;
                                $totalsgst+=(($rootprice*$item['item_gst_slab'])/100)/2;
                                $totalgst+=($rootprice*$item['item_gst_slab'])/100;
                                @endphp
                            </tr>
                            @endforeach
                            @foreach ($newSelling as $item)
                            <tr>
                                <td width="7%"></td>
                                <td width="12.28%">{{$item->s_i_tax}}%</td>
                                @php
                                    $baseprice = $item->s_i_rate*(100/(100+$item->s_i_tax))*$item->s_i_qty;
                                    $rootprice = $item->s_i_rate*$item->s_i_qty;
                                @endphp
                                <td width="12.28%">{{sprintf("%.2f", $baseprice)}}</td>
                                <td width="12.28%">{{sprintf("%.2f", (($rootprice*$item->s_i_tax)/100)/2)}}</td>
                                <td width="12.28%">{{sprintf("%.2f", (($rootprice*$item->s_i_tax)/100)/2)}}</td>
                                <td width="12.28%">{{sprintf("%.2f", ($rootprice*$item->s_i_tax)/100)}}</td>
                                @php
                                $totalTaxable+=$baseprice;
                                $totalcgst+=(($rootprice*$item->s_i_tax)/100)/2;
                                $totalsgst+=(($rootprice*$item->s_i_tax)/100)/2;
                                $totalgst+=($rootprice*$item->s_i_tax)/100;
                                @endphp
                            </tr>
                            @endforeach
                            <tr class="border-top border-bottom ">
                                <td class="border-right-left" width="7%">Total</td>
                                <td class="border-right-left" width="12.28%"></td>
                                <td class="border-right-left" width="12.28%">{{sprintf("%.2f", $totalTaxable)}}</td>
                                <td class="border-right-left" width="12.28%">{{sprintf("%.2f", $totalcgst)}}</td>
                                <td class="border-right-left" width="12.28%">{{sprintf("%.2f", $totalsgst)}}</td>
                                <td class="border-right-left" width="12.28%">{{sprintf("%.2f", $totalgst)}}</td>

                            </tr>

                        </tbody>
                    </table>
                    @php
                    $number = $grandTotal;
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

   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 'S' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    " point " . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
                    @endphp
                    <div class="border border-top-0 border-right-left">
                        <p class="p-2 " style="font-size: 15px;">Rupees {{ucfirst($result)}} Only</p>
                    </div>
                    <div class="text-center my-3">
                        <p class=" text-decoration-underline">Bank details</p>
                        <p class="subtitle">Company Name:- Bharat Electricals</p>
                        <p class="subtitle">Bank Name:- Punjab National Bank A/c no:- 0607008700004211</p>
                        <p class="subtitle">IFSC Code & Branch:- PUNB0060700 G.T Road Dehri</p>
                    </div>
                    <div class="border border-right-left my-bdr-bottom">
                        <div class="row p-0">
                            <div class="col-6">
                                <div class="p-2">
                                    <p class="subtitle ">Terms & Conditions</p>
                                    <p class="subtitle">E.& O.E.</p>
                                    <p class="subtitle">1. Goods once sold will not be taken back.</p>
                                    <p class="subtitle">2. Interest @ 18% p.a. will be charged if the payment is not
                                        made with in the stipulated time.</p>
                                    <p class="subtitle">3. Subject to 'Bihar' Jurisdiction only.</p>
                                </div>
                            </div>
                            <div class="col-6 border-start ps-0">
                                <div class="border-bottom p-1">
                                    <p class="subtitle ">Receiver's Signature :</p>
                                </div>
                                <div class="p-2">
                                    <h6 class="text-end " style="font-size: 13px;">For BHARAT ELECTRICALS</h6>
                                    <h6 class="text-end mt-5 " style="font-size: 13px;">Authorised Signatory</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="" id="billfor" value="{{$billfor}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = currentDate.getMonth();
            var date = currentDate.getDate();

            $('#invDate').text(date + '-' + (month + 1) + '-' + year);
            $('#invNo').text('BE-' + (month + 1) + date + '/' + year + '-24');
            const billfor = $('#billfor').val();
            if (billfor == 'salesentry') {
                window.print();
                setTimeout(function() {
                    window.location.href = "{{url('sales-entry')}}";
                }, 1000);
            }
        });
    </script>
</body>

</html>