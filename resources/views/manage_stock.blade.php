@include('common.header');
<div id="adjustModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" id="adjust-stock">
                @csrf
                <input type="hidden" name="item_id" id="item_id2">
                <div class="modal-header">
                    <h4 class="modal-title">Add / Reduce Stock</h4>
                    <button type="button" class="btn-close btn btn-danger rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="mg"></p>
                    <div class="mb-3 card p-2">
                        <div class="row g-3">
                            <div class="col-lg-12 pre_dues">
                                <input type="radio" id="party_received" name="stock_type" value="1" checked>
                                <label class="h6" for="party_received">Add Stock</label>
                                <input type="radio" id="party_given" name="stock_type" value="0">
                                <label class="h6" for="party_given">Reduce Stock</label>
                            </div>
                            <span id="stock_type_error" style="color:red"></span>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="addfloatingInput" placeholder="Address" name="base_quantity" />
                                    <label for="addfloatingInput">Qty. (in <span id="base_unit">Box</span>) <span class="text-danger">*</span></label>
                                </div>
                                <span id="stock_type_error" style="color:red"></span>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="amtfloatingInput" placeholder="Amount" name="sub_quantity">
                                    <label for="amtfloatingInput">Qty. (in <span id="sec_unit"> Pcs</span>) </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="datefloatingInput" placeholder="Date" name="date" value="{{ date('Y-m-d') }}">
                                    <label for="datefloatingInput">Date</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="remksfloatingInput" placeholder="Remarks">
                                    <label for="remksfloatingInput">Remarks</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <div class="modal-footer">
                        <button id="save" type="submit" class="btn btn-outline-success rounded-pill">Save
                            Changes</button>
                    </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
                    <button type="button" class="btn w-sm btn-danger" id="delete-record">Yes, Delete
                        It!</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <p id="msg" class="fw-bold text-center"></p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-success btn-label rounded-pill" id="add_btn"><i class="ri-add-circle-line label-icon align-middle rounded-pill me-2"></i>
                                Add New Item
                            </button>
                            <form method="POST" action="{{ url('save-product') }}" id="add-product">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="item_id" value="0" id="item_id">
                                    <input type="hidden" name="submit_type" value="0" id="submit_type">
                                    <div class="mb-3 card p-2 shadow-lg border border-1 border-dark">
                                        <p><b>Item Details</b></p>
                                        <div class="row g-3">
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="item_hsn" placeholder="HSN/SAC" name="item_hsn">
                                                    <label for="item_hsn">HSN/SAC</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="item_name" placeholder="Item Name" name="item_name" required>
                                                    <label for="item_name">Item Name <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="item_name_local" placeholder="Item Name (Local Language)" name="item_name_local">
                                                    <label for="item_name_local">Item Name (Local Language)
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="item_location" name="item_location" placeholder="Item Location" />
                                                    <label for="item_location">Item Location</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="item_desc" placeholder="Item Description" name="item_desc">
                                                    <label for="item_desc">Item Description </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3 card p-2 shadow-lg border border-1 border-dark">
                                        <p><b>Pricing & Stock</b></p>
                                        <div class="row g-3">
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <select class="form-select did-floating-select" id="item_base_unit" placeholder="Base unit" name="item_base_unit" required>
                                                        <option value="">Select Unit</option>
                                                        @foreach ($units as $unit)
                                                        <option value="{{ $unit->u_name }}">{{ $unit->u_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="item_base_unit">Base unit<span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="item_conversion_rate" placeholder="Conversion Rate" name="item_conversion_rate" required>
                                                    <label for="item_conversion_rate">Conversion Rate <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <select class="form-select did-floating-select" id="item_sub_unit" placeholder="Sub-unit" name="item_sub_unit" required>
                                                        <option value="">Select Unit</option>
                                                        @foreach ($units as $unit)
                                                        <option value="{{ $unit->u_name }}">{{ $unit->u_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="item_sub_unit">Sub-unit<span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <select class="form-select" id="item_gst" placeholder="Tax Type (Purchase)" name="item_gst" required>
                                                        <option value="">Select</option>
                                                        <option value="1">Yes</option>
                                                        <option value="2">No</option>
                                                    </select>
                                                    <label for="item_gst">GST Item (Yes/No) <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="item_purchase_rate" placeholder="Purchase Rate" name="item_purchase_rate" required>
                                                    <label for="item_purchase_rate">Purchase Rate per <span class="base_unit"></span><span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 gst">
                                                <div class="form-floating">
                                                    <select class="form-select" id="item_purchase_tax_type" placeholder="Tax Type (Purchase)" name="item_purchase_tax_type">
                                                        <option value="">Select</option>
                                                        <option value="1">With G.S.T</option>
                                                        <option value="2">Without G.S.T</option>
                                                    </select>
                                                    <label for="item_purchase_tax_type">Tax Type (Purchase) <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 gst">
                                                <div class="form-floating">
                                                    <select class="form-select" id="item_sale_tax_type" placeholder="Tax Type (Sale)" name="item_sale_tax_type">
                                                        <option value="">Select</option>
                                                        <option value="1">With G.S.T</option>
                                                        <option value="2">Without G.S.T</option>
                                                    </select>
                                                    <label for="item_sale_tax_type">Tax Type (Sale) <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 gst">
                                                <div class="form-floating">
                                                    <select class="form-select" id="item_gst_slab" placeholder="G.S.T Slab" name="item_gst_slab">
                                                        <option value="">Select tax</option>
                                                        @foreach ($slab as $slb)
                                                        <option value="{{ $slb->sl_per }}">{{ $slb->sl_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="item_gst_slab">G.S.T Slab</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="item_stock_whole" placeholder="Opening Stock (Whole)" name="item_stock_whole">
                                                    <label for="item_stock_whole">Opening Stock in <span class="base_unit"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="item_min_stock" placeholder="Min. Stock Qty." name="item_min_stock" />
                                                    <label for="item_min_stock">Min. Stock Qty. in <span class="base_unit"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="item_mrp" placeholder="Min. Stock Qty." name="item_mrp" />
                                                    <label for="item_mrp">M.R.P. <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="item_disc_whole" placeholder="Min. Stock Qty." name="item_disc_whole" />
                                                    <label for="item_disc_whole">Whole Discount in % <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="item_disc_retail" placeholder="Min. Stock Qty." name="item_disc_retail" />
                                                    <label for="item_disc_retail">Retail Discount in % <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-n4">
                                                <p><b>For Wholesalers</b></p>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="item_sale_rate_whole_base" placeholder="Sales Rate (Whole.)" name="item_sale_rate_whole_base" required>
                                                    <label for="item_sale_rate_whole_base">Sales Rate per <span class="base_unit"></span>
                                                        <span class="text-danger">*</span></label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="item_sale_rate_whole_sub" placeholder="Sales Rate (Retail.)" name="item_sale_rate_whole_sub" required>
                                                    <label for="item_sale_rate_whole_sub">Sales Rate per <span class="sub_unit"></span>
                                                        <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-n4">
                                                <p><b>For Retailers</b></p>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="item_sale_rate_retail_base" placeholder="Sales Rate (Whole.)" name="item_sale_rate_retail_base" required>
                                                    <label for="item_sale_rate_retail_base">Sales Rate per <span class="base_unit"></span>
                                                        <span class="text-danger">*</span></label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="item_sale_rate_retail_sub" placeholder="Sales Rate (Retail.)" name="item_sale_rate_retail_sub" required>
                                                    <label for="item_sale_rate_retail_sub">Sales Rate per <span class="sub_unit"></span>
                                                        <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 card p-2 shadow-lg border border-1 border-dark">
                                        <p><b>Other Details</b></p>
                                        <div class="row g-3">
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control" id="item_mfg_date" placeholder="Mfg. Date" name="item_mfg_date" onfocus="this.showPicker()" />
                                                    <label for="item_mfg_date">Mfg. Date</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control" id="item_exp_date" name="item_exp_date" placeholder="Exp. Date" onfocus="this.showPicker()" />
                                                    <label for="item_exp_date">Exp. Date</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="item_exp_alert_time" placeholder="Exp. Alert Time" name="item_exp_alert_time" />
                                                    <label for="item_exp_alert_time">Exp. Alert Time</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <p id="message" class="fw-bold text-center text-danger"></p>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <div class="modal-footer">
                                        <button id="save_and_new" class="btn btn-outline-primary rounded-pill me-3 submit_btn">Save &
                                            New</button>
                                        <button id="save" class="btn btn-outline-success rounded-pill me-3 submit_btn">Save</button>
                                        <button id="cancel" class="btn btn-outline-danger rounded-pill me-3">Cancel</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body" id="table_body">
                        <table id="example" class="table table-bordered dt-responsive nowrap align-middle">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Item Name</th>
                                    <th>Purchase Rate</th>
                                    <th>Stock</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="items">

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
<!-- <div style="display: none;" id="yourElement" data-submit-type="{{ session('submitType') }}"></div> -->
@include('common.footer')


<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        
        get_items();
        $('#add-product').hide();
        // alert('Session Data = '+$('#yourElement').attr('data-submit-type'));
        // GST Toggler
        $(document).on('change', '#item_gst', function() {
            if ($(this).val() == 1) {
                $('.gst').show();
            } else {
                $('.gst').hide();
            }
        });

        // Text Toggler Functions
        $(document).on('change', '#item_base_unit', function() {
            $('.base_unit').text($(this).val());
        });
        $(document).on('change', '#item_sub_unit', function() {
            $('.sub_unit').text($(this).val());
        });

        // Add Button Function
        $(document).on('click', '#add_btn', function() {
            $('#add-product').show();
            $('#save_and_new').show();
            $('#table_body').hide();
            $('#add_btn').hide();
        });

        // Submit Button Function
        $(document).on('click', '.submit_btn', function(event) {
            event.preventDefault();
            if($('#item_gst').val() == 1){
                if($('#item_purchase_tax_type').val() != 1){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: 'Please select Item Purchase Tax Type',
                    });
                    return;
                }
                if($('#item_sale_tax_type').val() != 1){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: 'Please select Item Sale Tax Type',
                    });
                    return;
                }
                if($('#item_gst_slab').val() === ''){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: 'Please select GST Slab',
                    });
                    return;
                }
            }
            if (validateForm()) {
                if ($(this).attr('id') == 'save_and_new') {
                    $('#submit_type').val(1);
                } else if ($(this).attr('id') == 'save') {
                    $('#submit_type').val(0);
                }
                $('#add-product').submit();
            }
        });

        // Form Validation
        function validateForm() {
            let isValid = true;
            $("#add-product [required]").each(function() {
                const $input = $(this);
                if ($input.length > 0) {
                    if ($input.is("input, textarea, select")) {
                        if ($input.is("select")) {
                            if ($input.val() === "") {
                                isValid = false;
                                $input.addClass("error");
                                $('#message').html('All fields with (*) are Required');
                            } else {
                                $input.removeClass("error");
                            }
                        } else {
                            if ($input.val().trim() === "") {
                                isValid = false;
                                $input.addClass("error");
                                $('#message').html('All fields with (*) are Required');
                            } else {
                                $input.removeClass("error");
                            }
                        }
                    }
                }
            });
            return isValid;
        }

        // Load stock list
        function get_items() {
            $('#items').html(``);
            var html = '';
            var i = 0;
            $.ajax({
                method: 'post',
                url: "{{ url('get-items') }}",
                success: function(result) {
                    $.each(result, function(index, value) {
                        i++;
                        html += `<tr>
                                    <td>${i}</td>
                                    <td>${value.item_name}</td>
                                    <td>${value.item_purchase_rate}</td>
                                    <td>${value.item_stock_whole} ${value.item_base_unit} , ${value.item_stock_retail} ${value.item_sub_unit} </td>
                                    <td>
                                    <button type="button" class="btn btn-success edit-btn" id="${value.item_id}">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    </td>
                                    <td><button type="button" class="btn btn-danger delete-btn" id="${value.item_id}"><i class="fa-regular fa-trash-can"></i></button></td>
                            </tr>`;
                    });
                    $('#example').DataTable().destroy();
                    $('#items').append(html);
                    $('#example').DataTable();
                }
            });
        }

        // Delete Button Configuration
        $(document).on('click', '.delete-btn', function() {
            const id = $(this).attr('id');
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
                    $.post("{{url('delete-stock')}}", {
                        id: id
                    }, function(res) {
                        if (res.status == true) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Stock deleted.",
                                icon: "success"
                            });
                            get_items();
                        }
                    }).fail(function(err) {
                        if (err.responseJSON.status) {
                            Swal.fire({
                                title: "Error!",
                                text: err.responseJSON.status,
                                icon: "error"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: err.responseJSON.message,
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });

        // Cancel Button Configuration
        $(document).on('click', '#cancel', function() {
            $('#add-product')[0].reset();
            $('#table_body').show();
            $('#add_btn').show();
            $('#add-product').hide();
        });

        // Edit Button Configuration
        $(document).on('click', '.edit-btn', function() {
            $('#add_btn').hide();
            $('#add-product').show();
            $('#table_body').hide();
            $('#save_and_new').hide();
            var id = $(this).attr('id');
            $.ajax({
                method: 'post',
                url: "{{ url('edit-item') }}",
                data: {
                    id: id
                },
                success: function(result) {
                    console.log(result);
                    $('.base_unit').text(result.item_base_unit);
                    $('.sub_unit').text(result.item_sub_unit);
                    $('#item_id').val(result.item_id);
                    $('#item_hsn').val(result.item_hsn);
                    $('#item_name').val(result.item_name);
                    $('#item_name_local').val(result.item_name_local);
                    $('#item_location').val(result.item_location);
                    $('#item_desc').val(result.item_desc);
                    $('#item_base_unit').val(result.item_base_unit);
                    $('#item_conversion_rate').val(result.item_conversion_rate);
                    $('#item_sub_unit').val(result.item_sub_unit);
                    $('#item_gst').val(result.item_gst);
                    if (result.item_gst == 1) {
                        $('.gst').show();
                        $('#item_purchase_tax_type').val(result.item_purchase_tax_type);
                        $('#item_sale_tax_type').val(result.item_sale_tax_type);
                        $('#item_gst_slab').val(result.item_gst_slab);
                    } else {
                        $('.gst').hide();
                    }
                    $('#item_purchase_rate').val(result.item_purchase_rate);

                    $('#item_stock_whole').val(result.item_stock_whole);
                    $('#item_min_stock').val(result.item_min_stock);
                    $('#item_mrp').val(result.item_mrp);
                    $('#item_disc_whole').val(result.item_disc_whole);
                    $('#item_disc_retail').val(result.item_disc_retail);
                    $('#item_sale_rate_whole_base').val(result
                        .item_sale_rate_whole_base);
                    $('#item_sale_rate_whole_sub').val(result
                        .item_sale_rate_whole_sub);
                    $('#item_sale_rate_retail_base').val(result
                        .item_sale_rate_retail_base);
                    $('#item_sale_rate_retail_sub').val(result
                        .item_sale_rate_retail_sub);
                    $('#item_mfg_date').val(result.item_mfg_date);
                    $('#item_exp_date').val(result.item_exp_date);
                    $('#item_exp_alert_time').val(result.item_exp_alert_time);
                    if ($('#item_gst').val() == 1) {
                        $('.gst').show();
                    } else {
                        $('.gst').hide();
                    }
                }
            });
        });
        // Calculate Final Rate based on MRP and Discounts
        $("#item_mrp, #item_disc_whole, #item_disc_retail, #item_conversion_rate, #item_purchase_rate").on("input", function() {
            var item_mrp = parseFloat($("#item_mrp").val()) || 0;
            var item_disc_whole = parseFloat($("#item_disc_whole").val()) || 0;
            var item_disc_retail = parseFloat($('#item_disc_retail').val()) || 0;
            var item_conversion_rate = parseFloat($('#item_conversion_rate').val()) || 0;
            var item_purchase_rate = parseFloat($('#item_purchase_rate').val()) || 0;

            var item_sale_rate_whole_base = item_mrp - (item_mrp * item_disc_whole / 100);
            $("#item_sale_rate_whole_base").val(item_sale_rate_whole_base);

            var item_sale_rate_whole_sub = item_sale_rate_whole_base / item_conversion_rate;
            $("#item_sale_rate_whole_sub").val(item_sale_rate_whole_sub.toFixed(2));

            var item_sale_rate_retail_base = item_mrp - (item_mrp * item_disc_retail / 100);
            $("#item_sale_rate_retail_base").val(item_sale_rate_retail_base);

            var item_sale_rate_retail_sub = item_sale_rate_retail_base / item_conversion_rate;
            $("#item_sale_rate_retail_sub").val(item_sale_rate_retail_sub.toFixed(2));
        });

        // Calculate Discount % based on MRP and Final Rates
        $("#item_mrp, #item_sale_rate_whole_base, #item_sale_rate_retail_base").on("input", function() {
            var item_mrp = parseFloat($("#item_mrp").val()) || 0;
            var item_sale_rate_whole_base = parseFloat($("#item_sale_rate_whole_base").val()) || 0;
            var item_sale_rate_retail_base = parseFloat($("#item_sale_rate_retail_base").val()) || 0;

            if (item_mrp !== 0 && item_sale_rate_whole_base !== 0) {
                var item_disc_whole = ((item_mrp - item_sale_rate_whole_base) / item_mrp) * 100;
                $("#item_disc_whole").val(item_disc_whole);
            }

            if (item_mrp !== 0 && item_sale_rate_retail_base !== 0) {
                var item_disc_retail = ((item_mrp - item_sale_rate_retail_base) / item_mrp) * 100;
                $("#item_disc_retail").val(item_disc_retail);
            }
        });



    });
</script>