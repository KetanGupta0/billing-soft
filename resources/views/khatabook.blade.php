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
                    <button type="button" class="btn w-sm btn-danger " id="delete-record">Yes, Delete
                        It!</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="addcustomerModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Customer</h4>
                <button type="button" class="btn-close btn btn-danger rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_customer_form">
                    <div class="mb-3 card p-2 ">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="c_name" name="c_name" placeholder="Name">
                                    <label for="c_name">Name<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <select class="form-select" id="c_type" name="c_type" placeholder="Customer Type">
                                        <option value="">Select</option>
                                        <option value="1">Whole Sale</option>
                                        <option value="2">Retail</option>
                                    </select>
                                    <label for="c_type">Customer Type <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="c_fmob" name="c_fmob" placeholder="Mob. No. ">
                                    <label for="c_fmob">Mob. No. <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="c_smob" name="c_smob" placeholder="Alt. Mob. No. ">
                                    <label for="c_smob">Alt. Mob. No. <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="c_gst" name="c_gst" placeholder="G.S.T No. ">
                                    <label for="c_gst">G.S.T No. <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <select class="form-select" id="c_state" name="c_state" placeholder="State of Supply">
                                        <option value="Bihar">Bihar</option>
                                        <option value="Utter Pradesh">Utter Pradesh</option>
                                        <option value="Assam">Assam</option>
                                        <option value="Punjab">Punjab</option>
                                    </select>
                                    <label for="c_state">State of Supply <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="c_add" name="c_add" placeholder="Address ">
                                    <label for="c_add">Address <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="c_desc" name="c_desc" placeholder="customer Description">
                                    <label for="c_desc">customer Description <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="c_dues" name="c_dues" placeholder="Pre Dues">
                                    <label for="c_dues">Pre Dues</label>
                                </div>
                            </div>
                            <p id="message" class="fw-bold text-center text-danger"></p>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <div class="modal-footer">
                            <div id="save_and_new_customer" class="btn btn-outline-primary rounded-pill">Save &
                                New</div>
                            <div id="save_customer" class="btn btn-outline-success rounded-pill">Save</div>
                            <div id="update_customer" class="btn btn-outline-success rounded-pill" data-id="0" style="display: none;">Update</div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="paymentModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Payment Received</h4>
                <button type="button" class="btn-close btn btn-danger rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="user-payment-form">
                    <div class="mb-3 card p-2 ">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <select class="form-select" id="tnxType" name="tnxType" placeholder="">
                                        <option value="1">Recieved</option>
                                        <option value="2">Given</option>
                                    </select>
                                    <label for="tnxType">Transaction Type</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="tnx_date" placeholder="Date">
                                    <label for="tnx_date">Date</label>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="c_name_payment" placeholder="Name" data="0" value="Customer Name" disabled />
                                    <label for="c_name_payment">Name<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="c_fmob_payment" placeholder="Mob. No. " value="8542154784" disabled />
                                    <label for="c_fmob_payment">Mob. No. <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="c_smob_payment" placeholder="Alt. Mob. No. " value="8451245954" disabled />
                                    <label for="c_smob_payment">Alt. Mob. No. <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="c_add_payment" placeholder="Address " value="Patna, Bihar" disabled />
                                    <label for="c_add_payment">Address <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <select class="form-select" id="tnx_account" name="tnx_account" placeholder=""></select>
                                    <label for="tnx_account">Account</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="tnx_amount" placeholder="Amount">
                                    <label for="tnx_amount">Amount <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <textarea type="text" style="height: 120px!important; resize: none!important;" class="form-control" id="tnx_remark" placeholder=""></textarea>
                                    <label for="tnx_remark">Remarks<span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <div class="modal-footer">
                            <div id="save-payment" class="btn btn-outline-success rounded-pill">Save Changes</div>
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
                            <button type="button" id="newBtn" class="btn btn-info btn-label rounded-pill" data-bs-toggle="modal" data-bs-target="#addcustomerModal"><i class="ri-add-circle-line label-icon align-middle rounded-pill me-2"></i>
                                New Customer
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th data-ordering="false">Name</th>
                                        <th data-ordering="false">Address</th>
                                        <th data-ordering="false">Mob</th>
                                        <th data-ordering="false">Dues amt. Rate</th>
                                        <th>Share</th>
                                        <th>Received</th>
                                        <th>Given</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="customers-list">

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

        function getCustomersList() {
            $.post("{{url('fetch-khatabook-customers-list')}}", {}, function(res) {
                if (res.status == true) {
                    $('#example').DataTable().destroy();
                    $('#customers-list').html(``);
                    $.each(res.data, function(key, value) {
                        $('#customers-list').append(`
                                <tr>
                                    <td>${key+1}</td>
                                    <td>${value.c_name}</td>
                                    <td>${value.c_add}</td>
                                    <td>${value.c_fmob}</td>
                                    <td>${value.c_dues}</td>
                                    <td>
                                        <button class="btn btn-success btn-label rounded-pill shareBtn" data="${value.c_id}"><i
                                                class="ri-whatsapp-line label-icon align-middle rounded-pill me-2"></i>
                                            Share
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-label rounded-pill paymentBtn" data="${value.c_id}" data-type="1"
                                            data-bs-toggle="modal" data-bs-target="#paymentModal"><i
                                                class="ri-arrow-down-line label-icon align-middle rounded-pill me-2"></i>
                                            Received
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-label rounded-pill paymentBtn" data="${value.c_id}" data-type="2"
                                            data-bs-toggle="modal" data-bs-target="#paymentModal"><i
                                                class="ri-arrow-up-line label-icon align-middle rounded-pill me-2"></i>
                                            Given
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-label rounded-pill editBtn" data="${value.c_id}" data-bs-toggle="modal" data-bs-target="#addcustomerModal">
                                            <i class="ri-edit-line label-icon align-middle rounded-pill me-2"></i>Edit
                                        </button>
                                        <button type="button" class="btn btn-warning btn-label rounded-pill viewBtn" data="${value.c_id}">
                                            <i class="ri-eye-line label-icon align-middle rounded-pill me-2"></i>View
                                        </button>
                                        <button type="button" class="btn btn-danger btn-label rounded-pill delete-customer" data="${value.c_id}" data-bs-toggle="modal" data-bs-target="#deleteRecordModal"><i
                                                class="ri-delete-bin-line label-icon align-middle rounded-pill me-2"></i>Delete
                                        </button>
                                    </td>
                                </tr>
                            `);
                    });
                    $('#example').DataTable();
                }
            }).fail(function(err) {
                console.log(err);
            });
        }

        function getAccountList() {
            $.get("{{url('fetch-account-list')}}", function(res) {
                $('#tnx_account').html(`<option value="">Select</option>`);
                $.each(res, function(key, val) {
                    $('#tnx_account').append(`<option value="${val.ac_id}">${val.ac_name}</option>`);
                });
            });
        }
        getCustomersList();
        getAccountList();
        $.post("{{url('get-state')}}", {}, function(res) {
            $('#c_state').html(`<option value="">Select State</option>`);
            $.each(res, function(key, value) {
                $('#c_state').append(`<option value="${value.s_id}">${value.s_name}(${value.s_name_h})</option>`);
            });
        }).fail(function(err) {
            console.log(err);
        });
        $(document).on('click', '#save_customer', function(event) {
            event.preventDefault();
            const c_name = $('#c_name').val();
            const c_type = $('#c_type').val();
            const c_fmob = $('#c_fmob').val();
            const c_smob = $('#c_smob').val();
            const c_gst = $('#c_gst').val();
            const c_state = $('#c_state').val();
            const c_add = $('#c_add').val();
            const c_desc = $('#c_desc').val();
            const c_dues = $('#c_dues').val();
            if (c_name === '' || c_type === '' || c_fmob === '' || c_gst === '' || c_state === '' || c_add === '' || c_dues === '') {
                $('#message').html('All fields with (*) are Required');
                return;
            }
            $.post("{{url('save-new-customer')}}", {
                c_name: c_name,
                c_type: c_type,
                c_fmob: c_fmob,
                c_smob: c_smob,
                c_gst: c_gst,
                c_state: c_state,
                c_add: c_add,
                c_desc: c_desc,
                c_dues: c_dues
            }, function(res) {
                console.log(res);
                getCustomersList();
            }).fail(function(err) {
                console.log(err);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: err.responseJSON.message
                });
            });
            $('#addcustomerModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            // Clear the form fields
            $('#add_customer_form')[0].reset();
        });
        $(document).on('click', '#save_and_new_customer', function(event) {
            event.preventDefault();
            const c_name = $('#c_name').val();
            const c_type = $('#c_type').val();
            const c_fmob = $('#c_fmob').val();
            const c_smob = $('#c_smob').val();
            const c_gst = $('#c_gst').val();
            const c_state = $('#c_state').val();
            const c_add = $('#c_add').val();
            const c_desc = $('#c_desc').val();
            const c_dues = $('#c_dues').val();
            if (c_name === '' || c_type === '' || c_fmob === '' || c_gst === '' || c_state === '' || c_add === '' || c_dues === '') {
                $('#message').html('All fields with (*) are Required');
                return;
            }
            $.post("{{url('save-new-customer')}}", {
                c_name: c_name,
                c_type: c_type,
                c_fmob: c_fmob,
                c_smob: c_smob,
                c_gst: c_gst,
                c_state: c_state,
                c_add: c_add,
                c_desc: c_desc,
                c_dues: c_dues
            }, function(res) {
                // Clear the form fields
                $('#add_customer_form')[0].reset();
                getCustomersList();
            }).fail(function(err) {
                console.log(err);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: err.responseJSON.message
                });
            });
        });
        $(document).on('click', '.delete-customer', function() {
            let id = $(this).attr('data');
            $('#delete-record').attr('data', id);
        });
        $(document).on('click', '#delete-record', function() {
            let id = $(this).attr('data');
            $.post("{{url('delete-customer-record')}}", {
                c_id: id
            }, function(res) {
                console.log(res);
                $('#deleteRecordModal').modal('hide');
                $('.modal-backdrop').remove();
                $('#deleteRecordModal').on('hidden.bs.modal', function(e) {
                    $(this).data('bs.modal', null);
                });

                $('#delete-record').attr('data', 0);
                getCustomersList();
            }).fail(function(err) {
                console.log(err);
                alert(err.responseJSON.message);
            });
        });
        $(document).on('click', '.paymentBtn', function() {
            $('#user-payment-form')[0].reset();
            let id = $(this).attr('data');
            let type = $(this).attr('data-type');
            let currentDate = new Date();
            let formattedDate = currentDate.toISOString().split('T')[0];
            $('#tnx_date').val(formattedDate);
            if (type == 1) {
                $('.modal-title').html('Payment Received');
                $('#tnxType option[value="1"]').prop('selected', true);
            } else if (type == 2) {
                $('.modal-title').html('Payment Given');
                $('#tnxType option[value="2"]').prop('selected', true);
            }
            $.post("{{url('get-customer-record')}}", {
                c_id: id
            }, function(res) {
                console.log(res);
                $('#c_name_payment').val(res.c_name);
                $('#c_fmob_payment').val(res.c_fmob);
                $('#c_smob_payment').val(res.c_smob);
                $('#c_add_payment').val(res.c_add);
                $('#c_name_payment').attr('data', res.c_id);
                // $('#paymentModal').modal('show');
                // $('.modal-backdrop').remove();
                // $('#paymentModal').on('hidden.bs.modal', function(e) {
                //     $(this).data('bs.modal', null);
                // });
            }).fail(function(err) {
                console.log(err);
                alert(err.responseJSON.message);
            });
        }); // Payment Modal
        $(document).on('click', '#save-payment', function() {
            let tnx_type = $('#tnxType').val();
            let tnx_date = $('#tnx_date').val();
            let tnx_user_id = $('#c_name_payment').attr('data');
            let tnx_user_type = 1; // User type customer
            let tnx_account = $('#tnx_account').val();
            let tnx_amount = $('#tnx_amount').val();
            let tnx_remark = $('#tnx_remark').val();
            $.post("{{url('save-user-transaction')}}", {
                tnx_type: tnx_type,
                tnx_date: tnx_date,
                tnx_user_id: tnx_user_id,
                tnx_user_type: tnx_user_type,
                tnx_account: tnx_account,
                tnx_amount: tnx_amount,
                tnx_remark: tnx_remark
            }, function(response) {
                console.log(response);
                // return;
                $('#paymentModal').modal('hide');
                $('.modal-backdrop').remove();
                $('#paymentModal').on('hidden.bs.modal', function(e) {
                    $(this).data('bs.modal', null);
                });
                $('#user-payment-form')[0].reset();
                getCustomersList();
            }).fail(function(err) {
                console.log(err);
                alert(err.responseJSON.message);
            });
        });
        $(document).on('click', '.viewBtn', function() {
            let id = $(this).attr('data');
            location.href = `{{url('view-customer-${id}')}}`;
        });

        $(document).on('click', '.editBtn', function() {
            $('#save_and_new_customer').hide();
            $('#save_customer').hide();
            $('#update_customer').show();
            $('#update_customer').attr('data-id', $(this).attr('data'));
            $('#c_dues').attr('disabled', true);
            let id = $(this).attr('data');
            $.post("{{url('fetch-customer-info')}}", {
                id: id
            }, function(res) {
                $('#c_name').val(res.c_name);
                $('#c_type').val(res.c_type);
                $('#c_fmob').val(res.c_fmob);
                $('#c_smob').val(res.c_smob);
                $('#c_gst').val(res.c_gst);
                $('#c_state').val(res.c_state);
                $('#c_add').val(res.c_add);
                $('#c_desc').val(res.c_desc);
                $('#c_dues').val(res.c_dues);
            });
        });

        $(document).on('click', '#newBtn', function() {
            $('#add_customer_form')[0].reset();
            $('#save_and_new_customer').show();
            $('#save_customer').show();
            $('#update_customer').hide();
            $('#update_customer').attr('data-id', 0);
            $('#c_dues').attr('disabled', false);
        });

        $(document).on('click', '#update_customer', function() {
            let id = $(this).attr('data-id');
            let c_name = $('#c_name').val();
            let c_type = $('#c_type').val();
            let c_fmob = $('#c_fmob').val();
            let c_smob = $('#c_smob').val();
            let c_gst = $('#c_gst').val();
            let c_state = $('#c_state').val();
            let c_add = $('#c_add').val();
            let c_desc = $('#c_desc').val();
            $.post("{{url('update-customer-info')}}", {
                c_id: id,
                c_name: c_name,
                c_type: c_type,
                c_fmob: c_fmob,
                c_smob: c_smob,
                c_gst: c_gst,
                c_state: c_state,
                c_add: c_add,
                c_desc: c_desc
            }, function(res) {
                getCustomersList();
                $('#addcustomerModal').modal('hide');
                $('.modal-backdrop').remove();
                $('#addcustomerModal').on('hidden.bs.modal', function(e) {
                    $(this).data('bs.modal', null);
                });
            }).fail(function(err) {
                console.log(err.responseJSON.message);
            });
        });

        $(document).on('click', '.shareBtn', function() {
            let wadata = '';
            let wamobile = 0;
            $.post("{{url('fetch-customer-transactions')}}", {
                id: $(this).attr('data')
            }, function(res) {
                wamobile = res.user.c_fmob;
                if (res.tnx.length == 0) {
                    wadata = `Dear ${res.user.c_name} %0D%0APresent Dues: Rs ${res.user.c_dues}/-%0D%0ANo. of Transactions ${parseInt(res.tnx.length)}`;
                    let url = `https://api.whatsapp.com/send?phone=91${wamobile}&text=${wadata}`;
                    window.open(url, '_blank');
                } else {
                    let end = new Date(res.tnx[res.tnx.length - 1].tnx_date);
                    let start = new Date();
                    // Format the dates to DD-MM-YYYY
                    let formattedStartDate = start.toLocaleDateString('en-GB');
                    let formattedEndDate = end.toLocaleDateString('en-GB');
                    wadata = `Dear ${res.user.c_name} Your Statements are:%0D%0ADate: From ${formattedEndDate} to ${formattedStartDate}%0D%0APresent Dues: Rs ${res.user.c_dues}/-%0D%0ANo. of Transactions ${parseInt(res.tnx.length)}:%0D%0A`;
                    $.each(res.tnx, function(key, val) {
                        let date = new Date(val.created_at);
                        let fDate = date.toLocaleDateString('en-GB');
                        let fTime = date.toLocaleTimeString('en-GB');

                        console.log(`${fDate} ${fTime}`);
                        let tnx_type = '';
                        if (val.tnx_type == 1) {
                            tnx_type = "Paid";
                        } else if (val.tnx_type == 2) {
                            tnx_type = "Dues";
                        }
                        wadata += `%0D%0AAmount: Rs ${val.tnx_amount}/- ${tnx_type}%0D%0ADues Amount: Rs ${val.tnx_final_dues}/-%0D%0ARemarks: ${val.tnx_remark}%0D%0ADate: ${fDate} ${fTime}%0D%0A`;
                    });
                    let url = `https://api.whatsapp.com/send?phone=91${wamobile}&text=${wadata}`;
                    window.open(url, '_blank');
                }
            }).fail();
        });
    });
</script>