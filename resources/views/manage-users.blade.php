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
                    <button type="button" class="btn w-sm btn-danger " data="0" id="delete-record">Yes, Delete
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
                <h4 class="modal-title">New Party</h4>
                <button type="button" class="btn-close btn btn-danger rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_party_form">
                    <div class="mb-3 card p-2 ">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="p_name" name="p_name" placeholder="Name">
                                    <label for="p_name">Name<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <select class="form-select" id="p_type" name="p_type" placeholder="Customer Type">
                                        <option value="">Select</option>
                                        <option value="1">Whole Sale</option>
                                        <option value="2">Retail</option>
                                    </select>
                                    <label for="p_type">Customer Type <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="p_fmob" name="p_fmob" placeholder="Mob. No. ">
                                    <label for="p_fmob">Mob. No. <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="p_smob" name="p_smob" placeholder="Alt. Mob. No. ">
                                    <label for="p_smob">Alt. Mob. No. <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="p_gst" name="p_gst" placeholder="G.S.T No. ">
                                    <label for="p_gst">G.S.T No. <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <select class="form-select" id="p_state" name="p_state" placeholder="State of Supply">
                                        <option value="Bihar">Bihar</option>
                                        <option value="Utter Pradesh">Utter Pradesh</option>
                                        <option value="Assam">Assam</option>
                                        <option value="Punjab">Punjab</option>
                                    </select>
                                    <label for="p_state">State of Supply <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="p_add" name="p_add" placeholder="Address ">
                                    <label for="p_add">Address <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="p_desc" name="p_desc" placeholder="Party Description">
                                    <label for="p_desc">Party Description <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="p_dues" name="p_dues" placeholder="Pre Dues">
                                    <label for="p_dues">Pre Dues</label>
                                </div>
                            </div>
                            <p id="message" class="fw-bold text-center text-danger"></p>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <div class="modal-footer">
                            <div id="save_and_new_customer" class="btn btn-outline-primary rounded-pill">Save &
                                New</div>
                            <div id="save_party" class="btn btn-outline-success rounded-pill">Save</div>
                            <div id="update_party" class="btn btn-outline-success rounded-pill" data-id="0" style="display: none;">Update</div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="editcustomerModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Customer</h4>
                <button type="button" class="btn-close btn btn-danger rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3 card p-2 ">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="namefloatingInput" placeholder="Name" value="Avinash Kumar">
                                    <label for="namefloatingInput">Name<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="mobnofloatingInput" placeholder="Mob. No. " value="8451245125">
                                    <label for="mobnofloatingInput">Mob. No. <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="altmobnofloatingInput" placeholder="Alt. Mob. No. " value="8451245125">
                                    <label for="altmobnofloatingInput">Alt. Mob. No. <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="gstfloatingInput" placeholder="G.S.T No." value="U312000HR1981FTC088701">
                                    <label for="gstfloatingInput">G.S.T No. <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <select class="form-select" id="statefloatingSelect" placeholder="State of Supply">
                                        <option value="Bihar">Bihar</option>
                                        <option value="Utter Pradesh">Utter Pradesh</option>
                                        <option value="Assam">Assam</option>
                                        <option value="Punjab">Punjab</option>
                                    </select>
                                    <label for="statefloatingSelect">State of Supply</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="addfloatingInput" placeholder="Address " value="Patna, Bihar">
                                    <label for="addfloatingInput">Address <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="partydfloatingInput" placeholder="Party Description" value="N/A">
                                    <label for="partydfloatingInput">Party Description <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-lg-12 mt-2">
                <div class="modal-footer">
                    <button id="save_and_new" type="submit" class="btn btn-outline-primary rounded-pill">Save &
                        New</button>
                    <button id="save" type="submit" class="btn btn-outline-success rounded-pill">Save</button>
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
                                    <input type="text" class="form-control" id="p_name_payment" placeholder="Name" data="0" value="Customer Name" disabled />
                                    <label for="p_name_payment">Name<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="p_fmob_payment" placeholder="Mob. No. " value="8542154784" disabled />
                                    <label for="p_fmob_payment">Mob. No. <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="p_smob_payment" placeholder="Alt. Mob. No. " value="8451245954" disabled />
                                    <label for="p_smob_payment">Alt. Mob. No. <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="p_add_payment" placeholder="Address " value="Patna, Bihar" disabled />
                                    <label for="p_add_payment">Address <span class="text-danger">*</span></label>
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
                                New Party
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

        function getPartiesList() {
            $.get("{{url('fetch-parties-list')}}", function(res) {
                if (res) {
                    $('#example').DataTable().destroy();
                    $('#customers-list').html(``);
                    $.each(res, function(key, value) {
                        $('#customers-list').append(`
                                <tr>
                                    <td>${key+1}</td>
                                    <td>${value.p_name}</td>
                                    <td>${value.p_add}</td>
                                    <td>${value.p_fmob}</td>
                                    <td>${value.p_dues}</td>
                                    <td>
                                        <button class="btn btn-success btn-label rounded-pill shareBtn" data="${value.p_id}"><i
                                                class="ri-whatsapp-line label-icon align-middle rounded-pill me-2"></i>
                                            Share
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-label rounded-pill paymentBtn" data="${value.p_id}" data-type="1"
                                            data-bs-toggle="modal" data-bs-target="#paymentModal"><i
                                                class="ri-arrow-down-line label-icon align-middle rounded-pill me-2"></i>
                                            Received
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-label rounded-pill paymentBtn" data="${value.p_id}" data-type="2"
                                            data-bs-toggle="modal" data-bs-target="#paymentModal"><i
                                                class="ri-arrow-up-line label-icon align-middle rounded-pill me-2"></i>
                                            Given
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-label rounded-pill editBtn" data="${value.p_id}" data-bs-toggle="modal" data-bs-target="#addcustomerModal">
                                            <i class="ri-edit-line label-icon align-middle rounded-pill me-2"></i>Edit
                                        </button>
                                        <button type="button" class="btn btn-warning btn-label rounded-pill viewBtn" data="${value.p_id}"><i
                                                class="ri-eye-line label-icon align-middle rounded-pill me-2"></i>
                                            View
                                        </button>
                                        <button type="button" class="btn btn-danger btn-label rounded-pill delete-party" data="${value.p_id}" data-bs-toggle="modal" data-bs-target="#deleteRecordModal"><i
                                                class="ri-delete-bin-line label-icon align-middle rounded-pill me-2"></i>
                                            Delete
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
        getPartiesList();
        getAccountList();

        $.post("{{url('get-state')}}", {}, function(res) {
            $('#p_state').html(`<option value="">Select State</option>`);
            $.each(res, function(key, value) {
                $('#p_state').append(`<option value="${value.s_id}">${value.s_name}(${value.s_name_h})</option>`);
            });
        }).fail(function(err) {
            console.log(err);
        });

        $(document).on('click', '#save_party', function(event) {
            event.preventDefault();
            const p_name = $('#p_name').val();
            const p_type = $('#p_type').val();
            const p_fmob = $('#p_fmob').val();
            const p_smob = $('#p_smob').val();
            const p_gst = $('#p_gst').val();
            const p_state = $('#p_state').val();
            const p_add = $('#p_add').val();
            const p_desc = $('#p_desc').val();
            const p_dues = $('#p_dues').val();
            if (p_name === '' || p_type === '' || p_fmob === '' || p_gst === '' || p_state === '' || p_add === '' || p_dues === '') {
                $('#message').html('All fields with (*) are Required');
                return;
            }
            $.post("{{url('save-new-party')}}", {
                p_name: p_name,
                p_type: p_type,
                p_fmob: p_fmob,
                p_smob: p_smob,
                p_gst: p_gst,
                p_state: p_state,
                p_add: p_add,
                p_desc: p_desc,
                p_dues: p_dues
            }, function(res) {
                console.log(res);
                getPartiesList();
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
            $('#add_party_form')[0].reset();
        });

        $(document).on('click', '#save_and_new_customer', function(event) {
            event.preventDefault();
            const p_name = $('#p_name').val();
            const p_type = $('#p_type').val();
            const p_fmob = $('#p_fmob').val();
            const p_smob = $('#p_smob').val();
            const p_gst = $('#p_gst').val();
            const p_state = $('#p_state').val();
            const p_add = $('#p_add').val();
            const p_desc = $('#p_desc').val();
            const p_dues = $('#p_dues').val();
            if (p_name === '' || p_type === '' || p_fmob === '' || p_gst === '' || p_state === '' || p_add === '' || p_dues === '') {
                $('#message').html('All fields with (*) are Required');
                return;
            }
            $.post("{{url('save-new-customer')}}", {
                p_name: p_name,
                p_type: p_type,
                p_fmob: p_fmob,
                p_smob: p_smob,
                p_gst: p_gst,
                p_state: p_state,
                p_add: p_add,
                p_desc: p_desc,
                p_dues: p_dues
            }, function(res) {
                // Clear the form fields
                $('#add_party_form')[0].reset();
                getPartiesList();
            }).fail(function(err) {
                console.log(err);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: err.responseJSON.message
                });
            });
        });

        $(document).on('click', '.delete-party', function() {
            let id = $(this).attr('data');
            $('#delete-record').attr('data', id);
        });

        $(document).on('click', '#delete-record', function() {
            let id = $(this).attr('data');
            $.post("{{url('delete-party-data')}}", {
                p_id: id
            }, function(res) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Party deleted successfully",
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#deleteRecordModal').modal('hide');
                $('#delete-record').attr('data', 0);
                getPartiesList();
            }).fail(function(err) {
                console.log(err);
                alert(err.responseJSON.message);
            });
        });

        $(document).on('click', '.paymentBtn', function() {
            $('#user-payment-form')[0].reset();
            let id = $(this).attr('data');
            console.log("id: " + id);
            let type = $(this).attr('data-type');
            console.log("Type: " + type);
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
            $.post("{{url('get-party-record')}}", {
                p_id: id
            }, function(res) {
                $('#p_name_payment').val(res.p_name);
                $('#p_fmob_payment').val(res.p_fmob);
                $('#p_smob_payment').val(res.p_smob);
                $('#p_add_payment').val(res.p_add);
                $('#p_name_payment').attr('data', res.p_id);
            }).fail(function(err) {
                console.log(err);
                alert(err.responseJSON.message);
            });
        }); // Payment Modal

        $(document).on('click', '#save-payment', function() {
            let tnx_type = $('#tnxType').val();
            let tnx_date = $('#tnx_date').val();
            let tnx_user_id = $('#p_name_payment').attr('data');
            let tnx_user_type = 2; // User type party
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
                getPartiesList();
            }).fail(function(err) {
                console.log(err);
                alert(err.responseJSON.message);
            });
        });

        $(document).on('click', '.viewBtn', function() {
            let id = $(this).attr('data');
            location.href = `{{url('view-party-${id}')}}`;
        });

        $(document).on('click', '.editBtn', function() {
            $('#save_and_new_customer').hide();
            $('#save_party').hide();
            $('#update_party').show();
            $('#update_party').attr('data-id', $(this).attr('data'));
            $('#p_dues').attr('disabled', true);
            let id = $(this).attr('data');
            $.post("{{url('fetch-party-info')}}", {
                id: id
            }, function(res) {
                $('#p_name').val(res.p_name);
                setTimeout(() => {
                    $('#p_type').val(res.p_type);
                }, 100);
                $('#p_fmob').val(res.p_fmob);
                $('#p_smob').val(res.p_smob);
                $('#p_gst').val(res.p_gst);
                $('#p_state').val(res.p_state);
                $('#p_add').val(res.p_add);
                $('#p_desc').val(res.p_desc);
                $('#p_dues').val(res.p_dues);
            });
        });

        $(document).on('click', '#newBtn', function() {
            $('#add_party_form')[0].reset();
            $('#save_and_new_customer').show();
            $('#save_party').show();
            $('#update_party').hide();
            $('#update_party').attr('data-id', 0);
            $('#p_dues').attr('disabled', false);
        });

        $(document).on('click', '#update_party', function() {
            let id = $(this).attr('data-id');
            let p_name = $('#p_name').val();
            let p_type = $('#p_type').val();
            let p_fmob = $('#p_fmob').val();
            let p_smob = $('#p_smob').val();
            let p_gst = $('#p_gst').val();
            let p_state = $('#p_state').val();
            let p_add = $('#p_add').val();
            let p_desc = $('#p_desc').val();
            $.post("{{url('update-party-info')}}", {
                p_id: id,
                p_name: p_name,
                p_type: p_type,
                p_fmob: p_fmob,
                p_smob: p_smob,
                p_gst: p_gst,
                p_state: p_state,
                p_add: p_add,
                p_desc: p_desc
            }, function(res) {
                console.log(res);
                getPartiesList();
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
            $.post("{{url('fetch-party-transactions')}}", {
                id: $(this).attr('data')
            }, function(res) {
                wamobile = res.user.p_fmob;
                if (res.tnx.length == 0) {
                    wadata = `Dear ${res.user.p_name} %0D%0APresent Dues: Rs ${res.user.p_dues}/-%0D%0ANo. of Transactions ${parseInt(res.tnx.length)}`;
                    let url = `https://api.whatsapp.com/send?phone=91${wamobile}&text=${wadata}`;
                    window.open(url, '_blank');
                } else {
                    let end = new Date(res.tnx[res.tnx.length - 1].tnx_date);
                    let start = new Date();
                    // Format the dates to DD-MM-YYYY
                    let formattedStartDate = start.toLocaleDateString('en-GB');
                    let formattedEndDate = end.toLocaleDateString('en-GB');
                    wadata = `Dear ${res.user.p_name} Your Statements are:%0D%0ADate: From ${formattedEndDate} to ${formattedStartDate}%0D%0APresent Dues: Rs ${res.user.p_dues}/-%0D%0ANo. of Transactions ${parseInt(res.tnx.length)}:%0D%0A`;
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