@include('common.header');
<div class="modal fade zoomIn" id="deleteRecordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                        colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px">
                    </lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you Sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-record" data="0">Yes, Delete
                        It!</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="addExpense" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Expense</h4>
                <button type="button" class="btn-close btn btn-danger rounded-circle" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="newForm">
                    <div class="mb-3 card p-2 ">
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="expense_name" id="expense_name"
                                        placeholder="">
                                    <label for="expense_name">Expense Name<span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <div class="w-100 d-flex justify-content-end">
                            <div id="save_and_new" data-role="2" class="btn btn-outline-primary rounded-pill me-3">Save
                                & New</div>
                            <div id="save" data-role="1" class="btn btn-outline-success rounded-pill">Save</div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="expenseEntry" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="expense_name_heading">lol Entry</h4>
                <button type="button" class="btn-close btn btn-danger rounded-circle" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="newEntryForm">
                    <div class="mb-3 card p-2 ">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="e_amount" id="e_amount"
                                        placeholder="">
                                    <label for="e_amount">Amount<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" name="e_Date" id="e_Date"
                                        placeholder="" onfocus="showPicker()">
                                    <label for="e_Date">Date<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <select class="form-select" id="e_account" name="e_account"
                                        placeholder=""></select>
                                    <label for="e_account">Account</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="e_remarks" id="e_remarks"
                                        style="height: 150px!important; resize:none!important;"></textarea>
                                    <label for="e_remarks">Description<span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <div class="w-100 d-flex justify-content-end">
                            <div id="e_save_and_new" data-role="2" data-type="0"
                                class="btn btn-outline-primary rounded-pill me-3" data-id="0">Save & New</div>
                            <div id="e_save" data-role="1" data-type="0"
                                class="btn btn-outline-success rounded-pill" data-id="0">Save</div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        {{-- @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif --}}
                        <div class="card-header">
                            <form action="{{ url('print-expense-statement') }}" method="post" id="filter-form">
                                @csrf
                                <div class="row border-bottom p-3 d-flex align-items-center">
                                    <div class="col-lg-7">
                                        <button type="button" id="newExpenseEntry"
                                            class="btn btn-info btn-label rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#expenseEntry"><i
                                                class="ri-add-circle-line label-icon align-middle rounded-pill me-2"></i>
                                            New Expense Entry
                                        </button>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="hidden" name="expense_id" id="expense_id"
                                                        value="{{ $id }}">
                                                    <input type="date" class="form-control" id="from_date"
                                                        placeholder="From Date" name="from_date"
                                                        onfocus="this.showPicker()">
                                                    <label for="from_date">From Date</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control" id="to_date"
                                                        placeholder="To Date" name="to_date"
                                                        onfocus="this.showPicker()">
                                                    <label for="to_date">To Date</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div>
                                                    <div class="btn btn-secondary btn-label rounded-pill"
                                                        id="clear_filter">
                                                        <i
                                                            class="ri-format-clear label-icon align-middle rounded-pill me-2"></i>Clear
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div>
                                                    <button type="submit"
                                                        class="btn btn-success btn-label rounded-pill"
                                                        id="statement_print">
                                                        <i
                                                            class="ri-printer-fill label-icon align-middle rounded-pill me-2"></i>Print
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table id="example"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="19%">Date</th>
                                        <th width="19%">Remark</th>
                                        <th width="19%">Amount</th>
                                        <th width="19%">Account</th>
                                        <th width="19%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="expenseList">
                                    @foreach ($records as $r)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            @php
                                                $dateTime = new DateTime($r->e_r_date);
                                                $formattedDate = $dateTime->format('d-m-Y');
                                            @endphp
                                            <td>{{ $formattedDate }}</td>
                                            <td>{{ $r->e_r_remark }}</td>
                                            <td>{{ $r->e_r_amount }}</td>
                                            <td>{{ $r->account }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <div class="btn btn-secondary btn-label rounded-pill expense_record_edit"
                                                                data-id="{{ $r->id }}" data-bs-toggle="modal"
                                                                data-bs-target="#expenseEntry">
                                                                <i
                                                                    class="ri-quill-pen-line label-icon align-middle rounded-pill me-2"></i>Edit
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <div class="btn btn-danger btn-label rounded-pill expense_record_delete"
                                                                data-id="{{ $r->id }}" data-bs-toggle="modal"
                                                                data-bs-target="#deleteRecordModal">
                                                                <i
                                                                    class="ri-delete-bin-2-line label-icon align-middle rounded-pill me-2"></i>Delete
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
</div>
@include('common.footer');
@if (session('error'))
    <script>
        // Display SweetAlert2 modal with the error message
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
        });
    </script>
@endif
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function listFormation(res) {
            $('#example').DataTable().destroy();
            $('#expenseList').html(``);
            $.each(res, function(key, value) {
                const originalDate = new Date(value.e_r_date);
                const day = String(originalDate.getDate()).padStart(2, '0');
                const month = String(originalDate.getMonth() + 1).padStart(2,
                    '0'); // Month is zero-based
                const year = originalDate.getFullYear();

                const formattedDate = `${day}-${month}-${year}`;
                $('#expenseList').append(`
                        <tr>
                            <td>${key+1}</td>
                            <td>${formattedDate}</td>
                            <td>${value.e_r_remark}</td>
                            <td>${value.e_r_amount}</td>
                            <td>${value.account}</td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="btn btn-secondary btn-label rounded-pill expense_record_edit"
                                                data-id="${value.id}" data-bs-toggle="modal"
                                                data-bs-target="#expenseEntry">
                                                <i class="ri-quill-pen-line label-icon align-middle rounded-pill me-2"></i>Edit
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="btn btn-danger btn-label rounded-pill expense_record_delete"
                                                data-id="${value.id}" data-bs-toggle="modal"
                                                data-bs-target="#deleteRecordModal">
                                                <i class="ri-delete-bin-2-line label-icon align-middle rounded-pill me-2"></i>Delete
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    `)
            });
            $('#example').DataTable();
        }

        function getFreshList() {
            $.post("{{ url('get-all-expense-record') }}", {
                id: $('#expense_id').val()
            }, function(res) {
                listFormation(res);
            }).fail();
        }

        function getAccountList() {
            $.get("{{ url('fetch-account-list') }}", function(res) {
                $('#e_account').html(`<option value="">Select</option>`);
                $.each(res, function(key, val) {
                    $('#e_account').append(
                        `<option value="${val.ac_id}">${val.ac_name}</option>`);
                });
            });
        }

        getAccountList();

        $(document).on('click', '.expense_record_edit', function() {
            let id = $(this).attr('data-id');
            $('#newEntryForm')[0].reset();
            $('#expense_name_heading').html('Edit Entry');
            $('#e_save_and_new, #e_save').attr('data-type', 2);
            $('#e_save_and_new, #e_save').attr('data-id', id);
            $('#e_save_and_new').hide();
            $('#e_save').html('Update');
            $.post("{{ url('fetch-expense-record-data') }}", {
                id: id
            }, function(res) {
                if (res.status === true) {
                    let formattedDate = new Date(res.data.created_at).toISOString().split('T')[
                        0];
                    $('#e_amount').val(res.data.e_r_amount);
                    $('#e_Date').val(formattedDate);
                    $('#e_account').val(res.data.e_r_ac_from);
                    $('#e_remarks').val(res.data.e_r_remark);
                }
            }).fail(function(err) {
                console.log(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: err.responseJSON.message
                });
            });
        });

        $(document).on('click', '#newExpenseEntry', function() {
            $('#newEntryForm')[0].reset();
            $('#expense_name_heading').html('New Expense Entry');
            $('#e_save_and_new, #e_save').attr('data-type', 1);
            $('#e_save').html('Save');
            $('#e_save_and_new').show();
            $('#e_save_and_new, #e_save').attr('data-id', 0);
            let currentDate = new Date();
            let formattedDate = currentDate.toISOString().split('T')[0];
            $('#e_Date').val(formattedDate);
        });

        $(document).on('click', '#e_save_and_new, #e_save', function() {
            let e_amount = $('#e_amount').val();
            let e_Date = $('#e_Date').val();
            let e_account = $('#e_account').val();
            let e_remarks = $('#e_remarks').val();
            let e_for = $('#expense_id').val();
            let role = $(this).attr('data-role');
            if ($(this).attr('data-type') == 1) {
                $.post("{{ url('save-new-expense-record') }}", {
                    e_amount: e_amount,
                    e_Date: e_Date,
                    e_account: e_account,
                    e_remarks: e_remarks,
                    e_for: e_for
                }, function(res) {
                    if (res === true) {
                        if (role == 1) {
                            $('#expenseEntry').modal('hide');
                        }
                        $('#newEntryForm')[0].reset();
                        $('#e_save_and_new').attr('data-id', 0);
                        $('#e_save').attr('data-id', 0);
                        let currentDate = new Date();
                        let formattedDate = currentDate.toISOString().split('T')[0];
                        $('#e_Date').val(formattedDate);
                        getFreshList();
                    }
                }).fail(function(err) {
                    console.log(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: err.responseJSON.message
                    });
                });
            } else if ($(this).attr('data-type') == 2) {
                const e_id = $(this).attr('data-id');
                $.post("{{ url('update-new-expense-record') }}", {
                    e_amount: e_amount,
                    e_Date: e_Date,
                    e_account: e_account,
                    e_remarks: e_remarks,
                    e_for: e_for,
                    e_id: e_id
                }, function(res) {
                    if (res === true) {
                        if (role == 1) {
                            $('#expenseEntry').modal('hide');
                        }
                        getFreshList();
                        $('#newEntryForm')[0].reset();
                        $('#e_save_and_new').attr('data-id', 0);
                        $('#e_save').attr('data-id', 0);
                        let currentDate = new Date();
                        let formattedDate = currentDate.toISOString().split('T')[0];
                        $('#e_Date').val(formattedDate);
                    }
                }).fail(function(err) {
                    console.log(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: err.responseJSON.message
                    });
                });
            }
        });

        function filterList() {
            let from_date = $('#from_date').val();
            let to_date = $('#to_date').val();
            let expense_id = $('#expense_id').val();
            $.post("{{ url('filter-expense-record') }}", {
                from_date: from_date,
                to_date: to_date,
                expense_id: expense_id
            }, function(res) {
                listFormation(res);
            }).fail();
        }

        $(document).on('click', '#clear_filter', function() {
            $('#filter-form')[0].reset();
            filterList();
        });

        $(document).on('input', '#from_date, #to_date', function() {
            filterList();
        });
    });
</script>
