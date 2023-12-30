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
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <select class="form-select" name="depressible_type" id="depressible_type"
                                        aria-label="Floating label select example">
                                        <option selected>Select</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                    </select>
                                    <label for="depressible-type">Depressible type</label>
                                </div>
                            </div>
                            <div class="col-lg-6 d-type" style="display: none">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="depressible_rate"
                                        id="depressible_rate" placeholder="">
                                    <label for="depressible_rate">Depressible % Per Year<span
                                            class="text-danger">*</span></label>
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
                <h4 class="modal-title" id="expense_name_heading">Expense Entry</h4>
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
                            <div id="e_save_and_new" data-role="2" class="btn btn-outline-primary rounded-pill me-3"
                                data-id="0">Save
                                & New</div>
                            <div id="e_save" data-role="1" class="btn btn-outline-success rounded-pill"
                                data-id="0">Save
                            </div>
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
                        <div class="card-header">
                            <button type="button" class="btn btn-info btn-label rounded-pill" data-bs-toggle="modal"
                                data-bs-target="#addExpense"><i
                                    class="ri-add-circle-line label-icon align-middle rounded-pill me-2"></i>
                                Add New Expense
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="example"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="55%">Expense Name</th>
                                        <th width="40%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="expenseList"></tbody>
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
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function updateList(res) {
            $('#example').DataTable().destroy();
            $('#expenseList').html(``);
            $.each(res, function(key, value) {
                $('#expenseList').append(`
                    <tr>
                        <td>${key+1}</td>
                        <td>${value.expense_name}</td>
                        <td>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div>
                                        <div class="btn btn-secondary btn-label rounded-pill expense_entry" data-name="${value.expense_name}" data-id="${value.id}" data-bs-toggle="modal"
                                data-bs-target="#expenseEntry">
                                            <i class="ri-quill-pen-line label-icon align-middle rounded-pill me-2"></i>Entry
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <div class="btn btn-warning btn-label rounded-pill expense_view" data-id="${value.id}">
                                            <i class="ri-eye-line label-icon align-middle rounded-pill me-2"></i>View
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <div class="btn btn-danger btn-label rounded-pill expense_delete" data-id="${value.id}" data-bs-toggle="modal"
                                data-bs-target="#deleteRecordModal">
                                            <i class="ri-delete-bin-2-line label-icon align-middle rounded-pill me-2"></i>Delete
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                `);
            });
            $('#example').DataTable();
        }

        function pageSetup() {
            let currentDate = new Date();
            let formattedDate = currentDate.toISOString().split('T')[0];
            $('#e_Date').val(formattedDate);
            $.get("{{ url('load-expense-list') }}", function(res) {
                updateList(res);
            }).fail(function(err) {
                console.log(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: err.responseJSON.message
                });
            });
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

        pageSetup();

        $(document).on('click', '#save, #save_and_new', function() {
            const name = $('#expense_name').val();
            const depressible_type = $('#depressible_type').val();
            const depressible_rate = $('#depressible_rate').val();
            $.post("{{ url('save-expense') }}", {
                name: name,
                depressible_type: depressible_type,
                depressible_rate: depressible_rate
            }, function(res) {
                updateList(res);
            }).fail(function(err) {
                console.log(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: err.responseJSON.message
                });
            });
            $('#newForm')[0].reset();
            if ($(this).attr('data-role') == '1') {
                $('#addExpense').modal('hide');
            } else if ($(this).attr('data-role') == '2') {
                return;
            }
        });

        $(document).on('click', '.expense_entry', function() {
            let id = $(this).attr('data-id');
            $('#e_save_and_new').attr('data-id', id);
            $('#e_save').attr('data-id', id);
            $('#expense_name_heading').html($(this).attr('data-name'));
        });

        $(document).on('click', '.expense_view', function() {
            let id = $(this).attr('data-id');
            let url = "<?php echo url('expense-view-" + id + "'); ?>";
            location.href = url;
        });

        $(document).on('click', '.expense_delete', function() {
            let id = $(this).attr('data-id');
            $('#delete-record').attr('data', id);
        });

        $(document).on('click', '#delete-record', function() {
            $.post("{{ url('delete-expence') }}", {
                id: $(this).attr('data')
            }, function(res) {
                if (res === true) {
                    pageSetup();
                    $('#deleteRecordModal').modal('hide');
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

        $(document).on('click', '#e_save_and_new, #e_save', function() {
            let e_amount = $('#e_amount').val();
            let e_Date = $('#e_Date').val();
            let e_account = $('#e_account').val();
            let e_remarks = $('#e_remarks').val();
            let e_for = $(this).attr('data-id');
            let role = $(this).attr('data-role');
            $.post("{{ url('save-new-expense-record') }}", {
                    e_amount: e_amount,
                    e_Date: e_Date,
                    e_account: e_account,
                    e_remarks: e_remarks,
                    e_for: e_for
                },

                function(res) {
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

        $(document).on('change', '#depressible-type', function() {
            let value = $(this).val();
            if (value == 1) {
                $('.d-type').show();
            } else if (value == 2 || value === '') {
                $('.d-type').hide();
            }
        });
    });
</script>
