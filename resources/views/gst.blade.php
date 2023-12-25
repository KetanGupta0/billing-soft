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
            text-align: right;
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
                                    <th>CGST Amount</th>
                                    <th>SGST Amount</th>
                                    <th>IGST Amount</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($for == 1)
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $d['p_h_bill_date'] }}</td>
                                            <td>{{ $d['p_h_bill_no'] }}</td>
                                            <td>{{ $d['p_name'] }}</td>
                                            <td>251SPC54124</td>
                                            <td>Bihar</td>
                                            <td>75000.00</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                            <td>10000.00</td>
                                            <td>95000.00</td>
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>16/11/2023</td>
                                            <td>VO123</td>
                                            <td>SpecBits IT</td>
                                            <td>251SPC54124</td>
                                            <td>Bihar</td>
                                            <td>75000.00</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                            <td>10000.00</td>
                                            <td>95000.00</td>
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
