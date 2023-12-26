<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="author" content="SpecBits" />
    <title>Bharat Electric GST Bill Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
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
            font-weight: 400;
            font-size: 12px;
            text-align: center;
        }

        th {
            font-weight: 600;
            font-size: 12px;
            text-align: center;
        }

        td:last-child,
        th:last-child {
            font-weight: 600;
            text-align: center;
            border-right: 1px solid #fff !important;
        }

        td:first-child,
        th:first-child {
            border-left: 1px solid #fff !important;
        }

        .table-bordered {
            border-color: #dee2e6 !important;
        }
    </style>
</head>

<body>
    <div class="border border-bottom-0">
        <div class="row">
            <div class="col-12 pt-1">
                <div class="d-flex align-items-center justify-content-between px-2">
                    <p style="font-size: 13px;">GSTIN : 10AOTPS7836R1ZV</p>
                    <p style="font-size: 13px;"><i>
                            @if ($for == 1)
                                Purchase
                            @else
                                Sales
                            @endif Report
                        </i></p>
                </div>
                <div class="text-center pb-3">
                    <p class=" text-decoration-underline">GST INVOICE REPORT</p>
                    <h4 class="">BHARAT ELECTRICALS</h4>
                    <p class="subtitle">MOHAN BIGHA, DEHRI ON SONE</p>
                    <p class="subtitle">ROHTAS, 821307 PAN : AOTPS7836R</p>
                    <p class="subtitle"><i>Tel. : <span>7250981144</span></i></p>
                </div>
                <div>
                    <div class="">
                        <table class="w-100 table-bordered">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Date</th>
                                    <th>Bill No</th>
                                    <th>Name</th>
                                    <th>GST No</th>
                                    <th>State</th>
                                    <th>Taxable Amount</th>
                                    <th>CGST</th>
                                    <th>SGST</th>
                                    <th>IGST</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $final = 0;
                                    $taxableAmt = 0;
                                @endphp
                                {{-- 
                                    For defines Purchase and Sales
                                    For example:
                                    if "for" contains 1, it means this report belongs to purchase
                                    and if "for" contains 2, it means this report belongs to sales
                                 --}}
                                @if ($for == 1)
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $d['p_h_bill_date'] }}</td>
                                            <td>{{ $d['p_h_bill_no'] }}</td>
                                            <td>{{ $d['p_name'] }}</td>
                                            <td>{{ $d['p_gst'] }}</td>
                                            <td>{{ $d['p_state_name'] }}</td>
                                            <td>
                                                @php
                                                    foreach ($d['item'] as $item) {
                                                        $gst = (float) $item['gst'];
                                                        $taxableAmt += (float) $item['p_i_rate'] * (100 / (100 + $gst)) * (float) $item['p_i_qty'];
                                                    }
                                                @endphp
                                                {{ sprintf('%.2f', $taxableAmt) }}
                                            </td>
                                            @php
                                                $temp = 0;
                                                $cgst = 0;
                                                $sgst = 0;
                                                $igst = 0;
                                                foreach ($d['item'] as $item) {
                                                    $gst = (float) $item['gst'];
                                                    $temp += ((float) $item['p_i_rate'] - (float) $item['p_i_rate'] * (100 / (100 + $gst))) * (float) $item['p_i_qty'];
                                                }
                                                if ($d['p_state'] == 4) {
                                                    $cgst = $sgst = $temp / 2;
                                                } else {
                                                    $igst = $temp;
                                                }
                                                $final = $temp + $taxableAmt;
                                            @endphp
                                            <td>{{ sprintf('%.2f', $cgst) }}</td>
                                            <td>{{ sprintf('%.2f', $sgst) }}</td>
                                            <td>{{ sprintf('%.2f', $igst) }}</td>
                                            <td>{{ sprintf('%.2f', $final) }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $d['s_h_bill_date'] }}</td>
                                            <td>{{ $d['s_h_bill_no'] }}</td>
                                            <td>{{ $d['c_name'] }}</td>
                                            <td>{{ $d['c_gst'] }}</td>
                                            <td>{{ $d['c_state_name'] }}</td>
                                            <td>
                                                @php
                                                    foreach ($d['item'] as $item) {
                                                        $gst = (float) $item['gst'];
                                                        $taxableAmt += (float) $item['s_i_rate'] * (100 / (100 + $gst)) * (float) $item['s_i_qty'];
                                                    }
                                                @endphp
                                                {{ sprintf('%.2f', $taxableAmt) }}
                                            </td>
                                            @php
                                                $temp = 0;
                                                $cgst = 0;
                                                $sgst = 0;
                                                $igst = 0;
                                                foreach ($d['item'] as $item) {
                                                    $temp += ((float) $item['s_i_rate'] - (float) $item['s_i_rate'] * (100 / (100 + $item['s_i_tax']))) * (float) $item['s_i_qty'];
                                                }
                                                if ($d['c_state'] == 4) {
                                                    $cgst = $sgst = $temp / 2;
                                                } else {
                                                    $igst = $temp;
                                                }
                                                $final = $temp + $taxableAmt;
                                            @endphp
                                            <td>{{ sprintf('%.2f', $cgst) }}</td>
                                            <td>{{ sprintf('%.2f', $sgst) }}</td>
                                            <td>{{ sprintf('%.2f', $igst) }}</td>
                                            <td>{{ sprintf('%.2f', $final) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
