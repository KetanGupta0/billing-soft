@include('common.header');
<div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px">
                    </lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you Sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger " id="delete-record" data="0">Yes, Delete
                        It!</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="addAccountModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Account</h4>
                <button type="button" class="btn-close btn btn-danger rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="newAcForm">
                    <div class="mb-3 card p-2 ">
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="ac_name" id="ac_name" placeholder="">
                                    <label for="ac_name">Account Name<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="ac_balance" name="ac_balance" placeholder="">
                                    <label for="ac_balance">Account Balance <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-lg-12 mt-2">
                <div class="modal-footer">
                    <div id="save_and_new" class="btn btn-outline-primary rounded-pill">Save &
                        New</div>
                    <div id="save" class="btn btn-outline-success rounded-pill">Save</div>
                </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="editAccountModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Account</h4>
                <button type="button" class="btn-close btn btn-danger rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3 card p-2 ">
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <input type="hidden" name="ac_id_new" id="ac_id_new" value="0">
                                    <input type="text" class="form-control" name="ac_name_new" id="ac_name_new" placeholder="Account Name" value="">
                                    <label for="ac_name_new">Account Name<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="ac_balance_new" id="ac_balance_new" placeholder="Account Balance" value="">
                                    <label for="ac_balance_new">Account Balance <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-lg-12 mt-2">
                <div class="modal-footer">
                    <div id="update" type="submit" class="btn btn-outline-success rounded-pill">Update</div>
                </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="paymentModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="paymentModalTitle">Payment Received</h4>
                <button type="button" class="btn-close btn btn-danger rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="tranx-form">
                    <div class="mb-3 card p-2 ">
                        <div class="row g-3">
                            <div class="col-lg-6 pre_dues">
                                <div class="form-floating">
                                    <select class="form-select" id="txnType" placeholder="Select State">
                                        <option value="1">Recieved</option>
                                        <option value="2">Given</option>
                                    </select>
                                    <label for="floatingSelect">Transaction Type</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="t_date" placeholder="Name" value="" />
                                    <label for="t_date">Date<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <input type="hidden" name="accountId" id="accountId" value="0">
                                    <input type="text" class="form-control" id="t_amount" placeholder="Name" value="" />
                                    <label for="t_amount">Amount<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <textarea type="text" style="height: 120px!important; resize: none!important;" class="form-control" id="t_remark" placeholder=""></textarea>
                                    <label for="t_remark">Remarks<span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-lg-12 mt-2">
                <div class="modal-footer">
                    <div id="proceed" class="btn btn-outline-success rounded-pill">Proceed</div>
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
                            <button type="button" class="btn btn-info btn-label rounded-pill" data-bs-toggle="modal" data-bs-target="#addAccountModal"><i class="ri-add-circle-line label-icon align-middle rounded-pill me-2"></i>
                                Add Account
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th data-ordering="false">Account Name</th>
                                        <th data-ordering="false">Avl. Balance</th>
                                        <th>Credit</th>
                                        <th>Debit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="accountList">
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
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.clear();
        populateAccountList();

        function populateAccountList() {
            $.get("{{url('fetch-accounts')}}", function(res) {
                $('#example').DataTable().destroy();
                $('#accountList').html(``);

                $.each(res, function(key, value) {
                    $('#accountList').append(`
                        <tr>
                            <td>${key+1}</td>
                            <td data-ordering="false">${value.ac_name}</td>
                            <td data-ordering="false">${value.ac_balance}</td>
                            <td>
                                <button type="button" class="btn btn-success credit-btn" data-bs-target="#paymentModal" data-bs-toggle="modal" id="${value.ac_id}">
                                    <i class="ri-arrow-up-line"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger debit-btn" data-bs-target="#paymentModal" data-bs-toggle="modal" id="${value.ac_id}">
                                    <i class="ri-arrow-down-line"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success edit-btn" data-bs-target="#editAccountModal" data-bs-toggle="modal" id="${value.ac_id}">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <button type="button" class="btn btn-warning view-btn" id="${value.ac_id}">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-danger delete-btn" data-bs-target="#deleteRecordModal" data-bs-toggle="modal" id="${value.ac_id}">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>
                            </tr>
                        `);
                });
                $('#example').DataTable();
            }).fail(function(err) {
                console.log(err);
                alert(err.responseJSON.message);
            });
        }
        $(document).on('click', '.edit-btn', function() {
            let ac_id = $(this).attr('id');
            $.post("{{url('fetch-account-info')}}", {
                ac_id: ac_id
            }, function(res) {
                console.log(res);
                $('#ac_id_new').val(res.ac_id);
                $('#ac_name_new').val(res.ac_name);
                $('#ac_balance_new').val(res.ac_balance);
            }).fail(function(err) {
                console.log(err);
                alert(err.responseJSON.message);
            });
        });
        $(document).on('click', '#save_and_new', function() {
            const ac_name = $('#ac_name').val();
            const ac_balance = $('#ac_balance').val();
            $.post("{{url('create-new-account')}}", {
                ac_name: ac_name,
                ac_balance: ac_balance
            }, function(res) {
                if (res === true) {
                    populateAccountList();
                    $('#newAcForm')[0].reset();
                }
            }).fail(function(err) {
                console.log(err);
                alert(err.responseJSON.message);
            });
        });
        $(document).on('click', '#save', function() {
            const ac_name = $('#ac_name').val();
            const ac_balance = $('#ac_balance').val();
            $.post("{{url('create-new-account')}}", {
                ac_name: ac_name,
                ac_balance: ac_balance
            }, function(res) {
                if (res === true) {
                    populateAccountList();
                    $('#addAccountModal').modal('hide');
                    $('#newAcForm')[0].reset();
                }
            }).fail(function(err) {
                console.log(err);
                alert(err.responseJSON.message);
            });
        });
        $(document).on('click', '#update', function() {
            const ac_id = $('#ac_id_new').val();
            const ac_name = $('#ac_name_new').val();
            const ac_balance = $('#ac_balance_new').val();
            console.log(ac_id);
            $.post("{{url('update-account-info')}}", {
                ac_id: ac_id,
                ac_name: ac_name,
                ac_balance: ac_balance
            }, function(res) {
                console.log(res);
                $('#editAccountModal').modal('hide');
                populateAccountList();
            }).fail(function(err) {
                console.log(err);
                alert(err.responseJSON.message);
            });
        });
        $(document).on('click', '.delete-btn', function() {
            let ac_id = $(this).attr('id');
            $('#delete-record').attr('data', ac_id);
        });
        $(document).on('click', '#delete-record', function() {
            let ac_id = $(this).attr('data');
            $.post("{{url('delete-account-info')}}", {
                ac_id: ac_id
            }, function(res) {
                console.log(res);
                if (res === true) {
                    $('#deleteRecordModal').modal('hide');
                    populateAccountList();
                    alert("Account removed successfully");
                }
            }).fail(function(err) {
                console.log(err);
                alert(err.responseJSON.message);
            });
        });
        $(document).on('click', '.credit-btn', function() {
            let ac_id = $(this).attr('id');
            let currentDate = new Date();
            let formattedDate = currentDate.toISOString().split('T')[0];
            setTimeout(() => {
                $('#t_date').val(formattedDate);
                $('#txnType').val('1');
            }, 100);
            $('#accountId').val(ac_id);
            $('#paymentModalTitle').html('Payment Received');
            $('.tranx-form')[0].reset();
        });
        $(document).on('click', '.debit-btn', function() {
            let ac_id = $(this).attr('id');
            let currentDate = new Date();
            let formattedDate = currentDate.toISOString().split('T')[0];
            setTimeout(() => {
                $('#t_date').val(formattedDate);
                $('#txnType').val('2');
            }, 100);
            $('#accountId').val(ac_id);
            $('#paymentModalTitle').html('Payment Given');
            $('.tranx-form')[0].reset();
        });
        $(document).on('click', '#proceed', function() {
            const ac_id = $('#accountId').val();
            const t_amount = $('#t_amount').val();
            const t_remark = $('#t_remark').val();
            const t_type = $('#txnType').val();
            const t_date = $('#t_date').val();
            $.post("{{url('make-txn')}}", {
                ac_id: ac_id,
                t_amount: t_amount,
                t_remark: t_remark,
                t_type: t_type,
                t_date: t_date
            }, function(res) {
                console.log(res);
                if (res === true) {
                    alert('Transaction record added.');
                    $('#paymentModal').modal('hide');
                    populateAccountList();
                }
            }).fail(function(err) {
                console.log(err);
                alert(err.responseJSON.message)
            });
        });
        $(document).on('click', '.view-btn', function() {
            let id = $(this).attr('id');
            location.href = `{{url('account-view-${id}')}}`;
        });
    });
</script>