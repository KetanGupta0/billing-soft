@include('common.header');
<style>
    table tr td {
        font-weight: bolder!important;
    }
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                    <form action="{{url('print-party-statement')}}" method="post" id="filter-form">
                            @csrf
                            <div class="row border-bottom p-3 d-flex align-items-center">
                                <div class="col-lg-6">
                                    <h2 class="m-0">{{$customer->c_name}}</h2>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <input type="hidden" name="p_id" id="p_id" value="{{$customer->c_id}}">
                                                <input type="hidden" name="user_type" id="user_type" value="1">
                                                <input type="date" class="form-control" id="from_date" placeholder="From Date" name="from_date" onfocus="this.showPicker()">
                                                <label for="from_date">From Date</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="to_date" placeholder="To Date" name="to_date" onfocus="this.showPicker()">
                                                <label for="to_date">To Date</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div>
                                                <div class="btn btn-secondary btn-label rounded-pill" id="clear_filter">
                                                    <i class="ri-format-clear label-icon align-middle rounded-pill me-2"></i>Clear
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div>
                                                <button type="submit" class="btn btn-info btn-label rounded-pill" id="statement_print">
                                                    <i class="ri-printer-fill label-icon align-middle rounded-pill me-2"></i>Print
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div>
                                                <div class="btn btn-success btn-label rounded-pill" id="share_wp">
                                                    <i class="ri-whatsapp-line label-icon align-middle rounded-pill me-2"></i>Share
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-body">
                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sn.</th>
                                        <th>Date</th>
                                        <th>Remarks</th>
                                        <th>Credit</th>
                                        <th>Debit</th>
                                        <th>Dues</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="transactions-list">
                                    @foreach ($transactions as $key=>$transaction)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$transaction->tnx_date}}</td>
                                        <td>{{$transaction->tnx_remark}}</td>
                                        <td>
                                            @if ($transaction->tnx_type == 1)
                                            <div class="text-success">{{$transaction->tnx_amount}}</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($transaction->tnx_type == 2)
                                            <div class="text-danger">{{$transaction->tnx_amount}}</div>
                                            @endif
                                        </td>
                                        <td>{{$transaction->tnx_final_dues}}</td>
                                        <td>
                                            <button type="button" class="btn btn-success edit-btn" data="{{$transaction->tnx_id}}">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger delete-btn" data="{{$transaction->tnx_id}}">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
@include('common.footer');
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.clear();
        $(document).on('click', '#clear_filter', function() {
            $('#filter-form')[0].reset();
            let from_date = $('#from_date').val();
            let to_date = $('#to_date').val();
            let user_type = 1;
            let p_id = $('#p_id').val();
            $.post('filter-user-transaction-list', {
                from_date: from_date,
                to_date: to_date,
                user_type: user_type,
                p_id: p_id,
            }, function(res) {
                loadUpdatedList(res);
            }).fail(function(err) {
                console.log(err.responseJSON.message);
            });
        });

        $(document).on('input', '#from_date, #to_date', function() {
            let from_date = $('#from_date').val();
            let to_date = $('#to_date').val();
            let user_type = 1;
            let p_id = $('#p_id').val();
            $.post('filter-user-transaction-list', {
                from_date: from_date,
                to_date: to_date,
                user_type: user_type,
                p_id: p_id
            }, function(res) {
                loadUpdatedList(res);
            }).fail(function(err) {
                console.log(err.responseJSON.message);
            });
        });

        function isValidDate(dateString) {
            const datePart = dateString.split('GMT')[0].trim();
            return !isNaN(new Date(datePart));
        }

        function loadUpdatedList(data) {
            console.log(data);
            $('#transactions-list').html('');
            $.each(data, function(key, value) {
                let paid = '';
                let dues = '';
                let final_dues = '';
                let amt = value.tnx_amount;
                if (value.tnx_type == 1) {
                    paid = `<div class="text-success">${value.tnx_amount}</div>`;
                } else if (value.tnx_type == 2) {
                    dues = value.tnx_p_amount != null ? `<div class="text-danger">${value.tnx_p_amount}</div>` : `<div class="text-danger">${value.tnx_amount}</div>`;
                }
                $('#transactions-list').append(`
                <tr>
                    <td>${key+1}</td>
                    <td>${value.tnx_date}</td>
                    <td>${value.tnx_remark}</td>
                    <td>${paid}</td>
                    <td>${dues}</td>
                    <td>${value.tnx_final_dues}</td>
                    <td>
                        <button type="button" class="btn btn-success edit-btn" data="${value.tnx_id}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger delete-btn" data="${value.tnx_id}">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </td>
                </tr>
                `);
            });
        }
        $(document).on('click', '#share_wp', function() {
            var url = '';
            let from_date = $('#from_date').val();
            let to_date = $('#to_date').val();
            let p_id = $('#p_id').val();
            $.post("{{url('generate-user-statement-wplink')}}", {
                p_id: p_id,
                from_date: from_date,
                to_date: to_date,
                user_type: 1
            }, function(res) {
                console.log(res);
                let wadata = '';
                let url = '';
                if (res.transactions.length == 0){
                    wadata = `Dear ${res.user.c_name}, %0D%0APresent Dues: Rs ${res.user.c_dues}/-%0D%0ANo. of Transactions ${res.transactions.length}`;
                }else{
                    let start_date = new Date(res.transactions[0].tnx_date);
                    let end_date = new Date(res.transactions[res.transactions.length - 1].tnx_date);
                    sdate = start_date.toLocaleDateString('en-GB');
                    edate = end_date.toLocaleDateString('en-GB');
                    wadata = `Dear *${res.user.c_name}*, Your Statements are:%0D%0ADate: *From* ${sdate} *to* ${edate}%0D%0APresent Dues: Rs ${res.user.c_dues}/-%0D%0A*No. of Transactions* ${res.transactions.length}:%0D%0A`;
                    $.each(res.transactions, function(key, value) {
                        let date = new Date(value.created_at);
                        let fDate = date.toLocaleDateString('en-GB');
                        let fTime = date.toLocaleTimeString('en-GB');
                        let tnx_type = '';
                        if (value.tnx_type == 1) {
                            tnx_type = "Paid";
                        } else if (value.tnx_type == 2) {
                            tnx_type = "Dues";
                        }
                        let amount = '';
                        if (value.tnx_p_amount != null) {
                            amount = value.tnx_p_amount;
                        } else {
                            amount = value.tnx_amount;
                        }
                        wadata += `%0D%0A*Amount*: Rs ${amount}/- *${tnx_type}*%0D%0A*Dues Amount*: Rs ${value.tnx_final_dues}/-%0D%0A*Remarks*: ${value.tnx_remark}%0D%0A*Date*: ${fDate}${fTime}%0D%0A`
                    });
                }
                url = `https://api.whatsapp.com/send?phone=91${res.user.c_fmob}&text=${wadata}`;
                window.open(url, '_blank');
            }).fail(function(err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    message: err.responseJSON.message
                });
            });
        });
    });
</script>