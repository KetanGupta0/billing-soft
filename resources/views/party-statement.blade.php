<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="author" content="SpecBits" />
    <title>Party Statement</title>
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
            /* text-align: right; */
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

<body onload="window.print()">
    <div class="border border-bottom-0">
        <div class="row">
            <div class="col-12 pt-1">
                <div class="row p-3">
                    <div class="col-6">
                        <h4 class="">BHARAT ELECTRICALS</h4>
                        <p class="subtitle">MOHAN BIGHA, DEHRI ON SONE</p>
                        <p class="subtitle">ROHTAS, 821307 PAN : AOTPS7836R</p>
                        <p class="subtitle"><i>Tel. : <span>7250981144</span></i></p>
                    </div>
                    <div class="col-6 text-end">
                        <h6 class="">{{$user->p_name}}{{$user->c_name}}</h6>
                        <h6 class=""> Your Dues - ₹ {{$user->p_dues}}{{$user->c_dues}}</h6>
                        <p style="font-size:12px"><span class="fw-bold">Print Date:</span> {{date('d-m-Y')}}</p>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    @php
                    if($userTransactions->count() != 0){
                        if($from_date == NULL){
                        $from_date = $userTransactions[0]->tnx_date;
                        }
                        $formattedStartDate = date('d M Y', strtotime($from_date));
                        if($to_date == NULL){
                        $to_date = $userTransactions[count($userTransactions) - 1]->tnx_date;
                        }
                        $formattedEndDate = date('d M Y', strtotime($to_date));
                    }else{
                        $formattedStartDate = date('d-m-Y');
                        $formattedEndDate = date('d-m-Y');
                    }
                    @endphp
                    <div class="col-8 mx-auto">
                        <div class="d-flex gap-2 text-center align-items-center justify-content-center">
                            <p style="font-size:12px"><span class="fw-bold">From Date:</span> {{$formattedStartDate}}</p>
                            <p style="font-size:12px"><span class="fw-bold">To :</span> {{$formattedEndDate}}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="">
                        <table class="w-100 table-bordered">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Date</th>
                                    <th>Remark</th>
                                    <th>Paid</th>
                                    <th>Dues</th>
                                    <th>Final Dues</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $index=1;
                                @endphp
                                @foreach ($userTransactions as $tnx)
                                <tr>
                                    <td>{{$index++}}</td>
                                    <td>{{date('d-m-Y',strtotime($tnx->tnx_date))}}</td>
                                    <td>{{$tnx->tnx_remark}}</td>
                                    @if($tnx->tnx_type == 1)
                                    <td>{{sprintf('%.2f',$tnx->tnx_amount)}}</td>
                                    <td></td>
                                    @elseif($tnx->tnx_type == 2)
                                    <td></td>
                                    <td>
                                        @if ($tnx->tnx_p_amount != 0)
                                        {{sprintf('%.2f',$tnx->tnx_p_amount)}}
                                        @else
                                        {{sprintf('%.2f',$tnx->tnx_amount)}}
                                        @endif
                                    </td>
                                    @endif
                                    <td>{{sprintf('%.2f',$tnx->tnx_final_dues)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        let userType = "{{Session::get('userType')}}";
        let userId = "{{$user->p_id}}{{$user->c_id}}";
        setInterval(() => {
            window.location.href = `{{url('view-${userType}-${userId}')}}`;
        }, 1000);
    </script>
</body>

</html>