@section('title', 'Purchase Entry');
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
                        <form action="{{url('print-account-statement')}}" method="post" id="filter-form">
                            @csrf
                            <div class="row border-bottom p-3 d-flex align-items-center">
                                <div class="col-lg-7">
                                    <h2 class="m-0">{{$account->ac_name}}</h2>
                                </div>
                                <div class="col-lg-5">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="hidden" class="form-control" id="ac_id" placeholder="ac_id" name="ac_id" value="{{$account->ac_id}}">
                                                <input type="date" class="form-control" id="from_date" placeholder="From Date" name="from_date" onfocus="this.showPicker()">
                                                <label for="from_date">From Date</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="to_date" placeholder="To Date" name="to_date" onfocus="this.showPicker()">
                                                <label for="to_date">To Date</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div>
                                                <div class="btn btn-warning btn-label rounded-pill" id="clear_filter">
                                                    <i class="ri-format-clear label-icon align-middle rounded-pill me-2"></i>Clear
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div>
                                                <button type="submit" class="btn btn-success btn-label rounded-pill" id="statement_print">
                                                    <i class="ri-printer-fill label-icon align-middle rounded-pill me-2"></i>Print
                                                </button>
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
                                        <th>Balance</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="account-list">
                                    @if (!empty($mergedTransactions))
                                        @foreach ($mergedTransactions as $key => $transaction)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {{ $transaction['tnx_date'] }}
                                            </td>
                                            <td>
                                                @if ($transaction['tnx_user_name']) {{$transaction['tnx_user_name']}}, @endif {{$transaction->t_remarks}}
                                            </td>
                                            @if ($transaction->t_type == 1)
                                            <td><div class="text-success">{{ $transaction['t_amount'] }}</div></td>
                                            <td></td>
                                            @elseif ($transaction->t_type == 2)
                                            <td></td>
                                            <td><div class="text-danger">{{ $transaction['t_amount'] }}</div></td>
                                            @endif
                                            <td>{{ $transaction->t_final_amount}}</td>
                                            <td>
                                                {{-- Edit link or button --}}
                                                <button type="button" class="btn btn-success edit-btn" <?php echo 'id="' . $transaction['t_id'] . '"';
                                                                                                        if ($transaction['tnx_user_name']) echo 'data-from="2"';
                                                                                                        else echo 'data-from="1"' ?>>
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <!-- data-from="1" = transaction table data || data-from="2" = user_transaction table data -->
                                            </td>
                                            <td>
                                                {{-- Delete link or button --}}
                                                <button type="button" class="btn btn-danger delete-btn" <?php echo 'id="' . $transaction['t_id'] . '"';
                                                                                                        if ($transaction['tnx_user_name']) echo 'data-from="2"';
                                                                                                        else echo 'data-from="1"' ?>>
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                                <!-- data-from="1" = transaction table data || data-from="2" = user_transaction table data -->
                                            </td>
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
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
@include('common.footer');
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.clear();
        $(document).on('click', '.edit-btn', function() {
            let table = $(this).attr('data-from');
            let id = $(this).attr('id');
        });
        $(document).on('click', '.delete-btn', function() {
            let table = $(this).attr('data-from');
            let id = $(this).attr('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{url('delete-transaction-record')}}", {
                        table: table,
                        id: id
                    }, function(res) {
                        if (res === true) {
                            location.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: res
                            });
                        }
                    });
                }
            });
        });
        $(document).on('click', '#statement_print', function() {
            let from = $('#from_date').val();
            let to = $('#to_date').val();
            let ac_id = $(this).attr('data');
            $.post("{{url('print-account-statement')}}", {
                from: from,
                to: to,
                ac_id: ac_id
            }, function(res) {
                console.log(res);
            }).fail(function(err) {
                console.log(err.responseJSON.message);
            });
        });
        $(document).on('click', '#clear_filter', function() {
            $('#filter-form')[0].reset();
            let from_date = $('#from_date').val();
            let to_date = $('#to_date').val();
            let ac_id = $('#ac_id').val();
            $.post('filter-account-list', {
                ac_id: ac_id,
                from_date: from_date,
                to_date: to_date
            }, function(res) {
                loadUpdatedList(res);
            }).fail(function(err) {
                console.log(err.responseJSON.message);
            });
        });
        $(document).on('input', '#from_date, #to_date', function() {
            let from_date = $('#from_date').val();
            let to_date = $('#to_date').val();
            let ac_id = $('#ac_id').val();
            $.post('filter-account-list', {
                ac_id: ac_id,
                from_date: from_date,
                to_date: to_date
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
            $('#account-list').html('');
            $.each(data,function(key,value){
                let username = '';
                let t_type = 0;
                let paid = 0;
                let dues = 0;
                let data_from = 1;
                if(value.tnx_user_name){
                    username = value.tnx_user_name+',';
                    data_from = 2;
                }
                if(value.t_type == 1){
                    paid = value.t_amount;
                }else if(value.t_type == 2){
                    dues = value.t_amount;
                }
                $('#account-list').append(`
                    <tr>
                        <td>${key+1}</td>
                        <td>${value.tnx_date}</td>
                        <td>${username} ${value.t_remarks}</td>
                        <td>${paid}</td>
                        <td>${dues}</td>
                        <td>${value.t_final_amount}</td>
                        <td>
                            <button type="button" class="btn btn-success edit-btn" id="${value.t_id}" data-from="${data_from}">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger delete-btn" id="${value.t_id}" data-from="${data_from}">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                `);
            });
        }
    });
</script>