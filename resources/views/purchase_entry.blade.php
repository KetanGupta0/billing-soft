@section('title', 'Purchase Entry');
@include('common.header');
<style>
    .nav-pills .nav-link {
        border: 1px solid var(--vz-vertical-menu-item-active-color)
    }
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <!-- <ul class="nav nav-pills nav-primary mb-3" role="tablist">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active me-2" data-bs-toggle="tab" href="#billing-details" role="tab">Billing
                                Details</a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-bs-toggle="tab" href="#item-details" role="tab">Item
                                Details</a>
                        </li>
                    </ul> -->
                    <form id="purchase-entry" autocomplete="off"><!-- Form Start -->
                        @csrf
                        <input type="hidden" name="p_id" id="p_id" class="party" value="0">
                        <input type="hidden" name="p_e_b_otp" id="p_e_b_otp" value="<?php echo rand(1111111111, 9999999999); ?>">
                        <input type="hidden" name="item_id" value="0" id="item_id">
                        <div class="tab-content">

                            <div class="tab-pane active" id="billing-details" role="tabpanel">
                                <div class="mb-3 card p-2 ">
                                    <p>Party Details</p>
                                    <div class="row g-3">
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control party search_name" id="p_name" placeholder="Name" name="p_name" required>
                                                <label for="p_name">Name <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control party" id="p_fmob" placeholder="Mob. No." name="p_fmob" required>
                                                <label for="p_fmob">Mob. No. <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control party" id="p_smob" placeholder="Alt. Mob. No." name="p_smob">
                                                <label for="p_smob">Alt. Mob. No.</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control party" id="p_gst" placeholder="G.S.T No." name="p_gst">
                                                <label for="p_gst">G.S.T No.</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <select class="form-select party state-select" id="p_state" placeholder="Select State" name="p_state">

                                                </select>
                                                <label for="p_state">Select State</label>
                                                <span class="d-none" id="party_state"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control party p_address" id="p_add" placeholder="Address" name="p_add">
                                                <label for="p_add">Address</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control party" id="p_desc" placeholder="Party Description" name="p_desc">
                                                <label for="p_desc">Party Description</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3 card p-2 ">
                                    <p>Billing Details</p>
                                    <div class="row g-3">
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="p_h_bill_no" placeholder="Bill No." name="p_h_bill_no">
                                                <label for="p_h_bill_no">Bill No.</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="p_h_bill_date" placeholder="Bill Date" name="p_h_bill_date" onfocus="this.showPicker()">
                                                <label for="p_h_bill_date">Bill Date</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="p_h_veh_no" placeholder="Vehicle No." name="p_h_veh_no">
                                                <label for="p_h_veh_no">Vehicle No.</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="p_h_del_date" placeholder="Delivery Date" name="p_h_del_date" onfocus="this.showPicker()">
                                                <label for="p_h_del_date">Delivery Date</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="p_h_other" placeholder="Other Charge" name="p_h_other">
                                                <label for="p_h_other">Other Charge</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control party" name="p_h_pre" id="p_h_pre" placeholder="Pre Dues" readonly />
                                                <label for="p_h_pre">Pre Dues</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="p_h_total" name="p_h_total" placeholder="Inv. Total" readonly />
                                                <label for="p_h_total">Inv. Total</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="p_h_dis" placeholder="Discount" name="p_h_dis" />
                                                <label for="p_h_dis">Discount</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="p_h_grand" name="p_h_grand" placeholder="Grand Total" readonly />
                                                <label for="p_h_grand">Grand Total</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="p_h_paid" placeholder="Paid Amt." name="p_h_paid" />
                                                <label for="p_h_paid">Paid Amt.</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <select class="form-select" id="tnx_account" name="tnx_account" placeholder=""></select>
                                                <label for="tnx_account">Account</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="p_h_dues" placeholder="Dues Amt." readonly name="p_h_dues" />
                                                <label for="p_h_dues">Dues Amt.</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-floating">
                                                <textarea type="text" style="height: 80px!important; resize: none!important;" class="form-control" id="p_h_desc" placeholder="Bill Desc." name="p_h_desc"></textarea>
                                                <label for="p_h_desc">Bill Desc.</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane active" id="item-details" role="tabpanel">

                                <div class="mb-3 card p-2 shadow-lg border border-1 border-dark">
                                    <p><b>Item Details</b></p>
                                    <div class="row g-3">
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
                                                <input type="text" class="form-control" id="item_hsn" placeholder="HSN/SAC" name="item_hsn">
                                                <label for="item_hsn">HSN/SAC</label>
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
                                                <select class="form-select" id="item_gst" placeholder="Tax Type (Purchase)" name="item_gst">
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
                                                    @foreach ($slab as $key=>$slab)
                                                    <option value="{{ $slab->sl_per }}" data-gst="{{ $slab->sl_per }}">{{ $slab->sl_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <label for="item_gst_slab">G.S.T Slab</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" id="item_stock_whole" placeholder="Opening Stock (Whole)" name="item_stock_whole" required>
                                                <label for="item_stock_whole">Purchased Qty. in <span class="base_unit"></span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" id="item_total" placeholder="Opening Stock (Whole)" name="item_total" value="0" readonly>
                                                <label for="item_total" id="item_total_gst_label">Item Total</label>
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

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div id="save_and_new" data-p_h_id="0" data="0" data-role="1" class="btn btn-primary rounded-pill submit_btn">Save &
                                                New</div>
                                            <div id="save" data-role="0" class="btn btn-danger rounded-pill submit_btn">Save</div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </form><!-- Form End -->
                    <div class="container-fluid">
                        <table class="table table-bordered dt-responsive nowrap align-middle" id="purchase_history_table" style="display: none;">
                            <!-- table data here -->
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Item Name</th>
                                    <th>Qty.</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="purchase_history_list">
                                <tr>
                                    <td>1</td>
                                    <td>Dummy Name</td>
                                    <td>Dummy Qty.</td>
                                    <td>Dummy Rate</td>
                                    <td>Dummy Amount</td>
                                    <td>
                                        <button type="button" class="btn btn-success edit-btn">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger delete-btn">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- End card-body -->
                <div class="px-4 w-100 position-absolute" id="partytable" style="margin-top:105px;display:none">
                    <div class="card border shadow">
                        <div>
                            <table class="table table-nowrap table-hover">
                                <thead class="text-danger">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Mobile</th>
                                        <th scope="col">Dues amt.</th>
                                    </tr>
                                </thead>
                                <tbody id="partiesdata"><!-- Dynamic Data --></tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- End Party table -->
                <div class="px-4 w-100 position-absolute" id="itemtable" style="margin-top:550px;display: none;">
                    <div class="card border shadow">
                        <div>
                            <table class="table table-nowrap table-hover">
                                <thead class="text-danger">
                                    <tr>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Item Name(Reg.Lang)</th>
                                        <th scope="col">Stock </th>
                                        <th scope="col">Item Location</th>
                                    </tr>
                                </thead>
                                <tbody id="itemsdata"><!-- Dynamic Data --></tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- End Item Table -->
            </div><!-- End card -->
        </div><!-- End container-fluid -->
    </div><!-- End Page-content -->
</div><!-- End main-content -->

<div style="display: none;" id="tempInv" data="0"></div>

@include('common.footer');
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.clear();
        let invTotals = 0;
        let previousDues = 0;
        let flag = 1;
        let previousItemID = 0;
        let newItemID = 0;
        let previousHistoryID = 0;
        let state_id = 0;

        function getAccountList() {
            $.get("{{url('fetch-account-list')}}", function(res) {
                $('#tnx_account').html(`<option value="">Select</option>`);
                $.each(res, function(key, val) {
                    $('#tnx_account').append(`<option value="${val.ac_id}">${val.ac_name}</option>`);
                });
            });
        }

        function pageSetup() {
            if ($('#item_gst').val() == '') {
                $('.gst').hide();
                $('#item_total_gst_label').text('Item Total');
            }
            $('#item_total').val(0);
            $('#p_h_other').val(0);
            $('#p_h_dis').val(0);
            $('#p_h_paid').val(0);
            $('#p_h_pre').val(0);
            $('#p_h_total').val(0);
            $('#p_h_grand').val(0);
            $('#p_h_dues').val(0);
            $('#item_stock_whole').val(0);
            $('#item_purchase_rate').val(0);
            get_state();
            get_parties();
            get_items();
            getAccountList();
            let currentDate = new Date();
            let formattedDate = currentDate.toISOString().split('T')[0];
            $('#p_h_bill_date').val(formattedDate);
            $('#p_h_del_date').val(formattedDate);
        }

        pageSetup();
        console.clear();

        function get_state() {
            var html = '<option value="">Select State</option>';
            $.ajax({
                method: 'post',
                url: "{{ url('get-state') }}",
                success: function(result) {
                    $.each(result, function(index, value) {
                        html +=
                            `<option value="${value.s_id}">${value.s_name} (${value.s_name_h})</option>`;
                    })
                    $('#p_state').html(html);
                }
            });
        }

        function get_parties() {
            var html = '';
            $.ajax({
                method: 'post',
                url: "{{ url('get-parties') }}",
                success: function(result) {
                    $.each(result, function(index, value) {
                        // var id = value.p_id * 456 * 789;
                        var id = value.p_id;
                        html +=
                            `<tr class="p_detail pdi${value.p_id}" data='${value.p_id}' id="${id}"><td>${value.p_name}</td><td>${value.p_add}</td><td>${value.p_fmob}</td><td>${value.p_dues}</td></tr>`;
                    })
                    $('#partiesdata').html(html);
                }
            });
        }

        function get_items() {
            var html = '';
            $.ajax({
                method: 'post',
                url: "{{ url('get-items') }}",
                success: function(result) {
                    $.each(result, function(index, value) {
                        // var id = value.item_id * 456 * 789;
                        var id = value.item_id;
                        html +=
                            `<tr id="${id}" class="pii${id}"><td>${value.item_name}</td><td>${value.item_name_local}</td><td>${value.item_stock_whole} ${value.item_base_unit} , ${value.item_stock_retail} ${value.item_sub_unit} </td><td>${value.item_location}</td></tr>`;
                    })
                    $('#itemsdata').html(html);
                }
            });
        }

        function validateForm() {
            let isValid = true;
            $("#purchase-entry [required]").each(function() {
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

        $(document).on('focus', '#p_name', function() {
            $('#partytable').show();
            search_party_table($(this).val());
            $('.party:not(:eq(1))').val('');
            $('#partiesdata tr:not([style*="display: none"])').removeClass("highlight_row");
            $('#p_h_pre').val(0);
        });

        $('body').on('keydown', '#p_name', function(e) {
            $('#partytable').show();
            if (e.which == 38) {
                highlightPartyRow(-1);
            } else if (e.which == 40) {
                highlightPartyRow(1);
            } else if (e.which == 37) {

            } else if (e.which == 9 || e.which == 13) {
                $('#partytable').hide();
                $('#partiesdata tr').each(function(index) {
                    if ($(this).hasClass("highlight_row")) {
                        var id = $(this).attr('id');
                        $('.pdi' + id).click();
                        console.log($('.pdi' + id));
                        return false;
                    }
                });
            }
        });

        function highlightPartyRow(direction) {
            var rows = $('#partiesdata tr:not([style*="display: none"])');
            var current = rows.filter('.highlight_row').index();
            var next = current + direction;

            // stop at the top
            if (direction < 0 && next < 0) next = 0
            // stop at the bottom
            if (direction > 0 && next >= rows.length) next = rows.length - 1;

            rows.removeClass("highlight_row");
            rows.eq(next).addClass('highlight_row');
        }

        $(document).on('input', '#p_name', function() {
            $('.party:not(:eq(1))').val('');
            $('#p_h_pre').val(0);
            search_party_table($(this).val());
        });

        function search_party_table(value) {
            $('#partiesdata tr').each(function() {
                var found = 'false';
                var i = 0;
                $(this).each(function() {
                    if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                        found = 'true';
                        i++;
                    }
                });
                if (found == 'true') {
                    $(this).show();
                } else {
                    $(this).hide();
                    $(this).removeClass("highlight_row");
                }
            });
        }

        $(document).on('click', '#partiesdata tr', function(event) {
            var id = $(this).attr('id');
            var org_id = parseFloat(id);
            $('#partytable').hide();
            $.ajax({
                url: "{{ url('edit-party') }}",
                method: 'POST',
                data: {
                    id: org_id
                },
                success: function(result) {
                    // console.log(result);
                    // Party Details
                    $('#p_id').val(result.p_id);
                    $('#p_name').val(result.p_name);
                    $('#p_fmob').val(result.p_fmob);
                    $('#p_smob').val(result.p_smob);
                    $('#p_gst').val(result.p_gst);
                    $('#p_state').val(result.p_state);
                    $('#p_add').val(result.p_add);
                    $('#p_desc').val(result.p_desc);

                    // Billing Details
                    previousDues = result.p_dues;
                    $('#p_h_pre').val(previousDues);
                    $('#p_h_grand').val(previousDues);
                    $('#p_h_dues').val(previousDues);
                    $('#p_h_total').val(0);
                    $('#p_h_dis').val(0);
                    $('#p_h_paid').val(0);
                    $('#p_h_other').val(0);
                },
                error: function(err) {
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
                    $('#purchase-entry')[0].reset();
                    $('#item_total').val(0);
                }
            });
        });

        $(document).on('change', '#item_gst', function() {
            if ($(this).val() === '') {
                $('.gst').hide();
                $('#item_gst_slab').val('');
                $('#item_purchase_tax_type').val('');
                $('#item_total_gst_label').text('Item Total');
            } else if ($(this).val() == 1) {
                $('.gst').show();
            } else {
                $('.gst').hide();
                $('#item_gst_slab').val('');
                $('#item_purchase_tax_type').val('');
                $('#item_total_gst_label').text('Item Total');
            }
            updateItemTotal();
            updateInvTotal();
            updateGrandTotal();
        });

        $(document).on('change', '#item_base_unit', function() {
            $('.base_unit').text($(this).val());
        });

        $(document).on('change', '#item_sub_unit', function() {
            $('.sub_unit').text($(this).val());
        });

        $(document).on('click', '.p_detail', function() {
            const id = $(this).attr('data');
        });

        function calculate() {
            var data = 500;
        }

        $(document).on('focus', '#p_fmob', function() {
            $('#partytable').hide();
        });

        $(document).on('focus', '#p_smob', function() {
            $('#partytable').hide();
        });

        $(document).on('focus', '#p_gst', function() {
            $('#partytable').hide();
        });

        $(document).on('focus', '#item_name', function() {
            $('#itemtable').show();
            search_item_table($(this).val());
            $('.item:not(:eq(1))').val(0);
            $('#itemsdata tr:not([style*="display: none"])').removeClass("highlight_row");
            calculate();
        });

        $('body').on('keydown', '#item_name', function(e) {
            $('#itemtable').show();
            if (e.which == 38) {
                highlightItemRow(-1);
            } else if (e.which == 40) {
                highlightItemRow(1);
            } else if (e.which == 37) {

            } else if (e.which == 9 || e.which == 13) {
                $('#itemtable').hide();
                $('#itemsdata tr').each(function(index) {
                    if ($(this).hasClass("highlight_row")) {
                        var id = $(this).attr('id');
                        var xyz = parseFloat(id);
                        $('.pii' + id).click();
                        return false;
                    }
                });
            }
        });

        // Show/hide partytable on focus/blur of p_name input
        $("#p_name").on("focus", function() {
            $("#partytable").show();
        }).on("blur", function() {
            // Delay hiding to check if click occurred within the partytable
            setTimeout(function() {
                if (!$("#partytable:hover").length) {
                    $("#partytable").hide();
                }
            }, 100);
        });

        // Show/hide itemtable on focus/blur of item_name input
        $("#item_name").on("focus", function() {
            $("#itemtable").show();
            $('#item_id').val(0);
        }).on("blur", function() {
            // Delay hiding to check if click occurred within the itemtable
            setTimeout(function() {
                if (!$("#itemtable:hover").length) {
                    $("#itemtable").hide();
                }
            }, 100);
        });

        function highlightItemRow(direction) {
            var rows = $('#itemsdata tr:not([style*="display: none"])');
            var current = rows.filter('.highlight_row').index();
            var next = current + direction;

            // stop at the top
            if (direction < 0 && next < 0) next = 0
            // stop at the bottom
            if (direction > 0 && next >= rows.length) next = rows.length - 1;

            rows.removeClass("highlight_row");
            rows.eq(next).addClass('highlight_row');
        }
        $(document).on('input', '#item_name', function() {
            search_item_table($(this).val());
        });

        function search_item_table(value) {
            $('#itemsdata tr').each(function() {
                var found = 'false';
                var i = 0;
                $(this).each(function() {
                    if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                        found = 'true';
                        i++;
                    }
                });
                if (found == 'true') {
                    $(this).show();
                } else {
                    $(this).hide();
                    $(this).removeClass("highlight_row");
                }
            });
        }
        $(document).on('click', '#itemsdata tr', function() {
            if ($('#p_state').val() == '' || $('#p_state').val() == null) {
                state_id = $('#party_state').html();
                $('#p_state').val(state_id);
            }
            var id = $(this).attr('id');
            var xyz = parseFloat(id);
            newItemID = xyz;
            $('#itemtable').hide();
            $.post("{{url('edit-item')}}", {
                id: xyz
            }, function(result) {
                $('#item_total').val(0);
                $('.base_unit').text(result.item_base_unit);
                $('.sub_unit').text(result.item_sub_unit);
                $('#item_id').val(result.item_id);
                $('#item_name').val(result.item_name);
                $('#item_name_local').val(result.item_name_local);
                $('#item_hsn').val(result.item_hsn);
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
                    $('#item_total_gst_label').text('Item Total (with GST)');
                } else {
                    $('.gst').hide();
                    $('#item_total_gst_label').text('Item Total');
                }
                $('#item_purchase_rate').val(result.item_purchase_rate);
                $('#item_stock_whole').val(0);
                $('#item_min_stock').val(result.item_min_stock);
                $('#item_sale_rate_whole_base').val(result.item_sale_rate_whole_base);
                $('#item_sale_rate_whole_sub').val(result.item_sale_rate_whole_sub);
                $('#item_sale_rate_retail_base').val(result.item_sale_rate_retail_base);
                $('#item_sale_rate_retail_sub').val(result.item_sale_rate_retail_sub);
                $('#item_mfg_date').val(result.item_mfg_date);
                $('#item_exp_date').val(result.item_exp_date);
                $('#item_exp_alert_time').val(result.item_exp_alert_time);
                $('#item_mrp').val(result.item_mrp);
                $('#item_disc_whole').val(result.item_disc_whole);
                $('#item_disc_retail').val(result.item_disc_retail);
                if ($('#item_gst').val() === '') {
                    $('.gst').hide();
                    $('#item_gst_slab').val('');
                    $('#item_purchase_tax_type').val('');
                    $('#item_total_gst_label').text('Item Total');
                } else if ($('#item_gst').val() == 1) {
                    $('.gst').show();
                } else {
                    $('.gst').hide();
                    $('#item_gst_slab').val('');
                    $('#item_purchase_tax_type').val('');
                    $('#item_total_gst_label').text('Item Total');
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
        });
        // Billing Logic on Input Start
        function validateIntInput() {
            if ($(this).val() == '') {
                $(this).val(0);
            } else if (!isInteger($(this).val())) {
                if ($(this).val().length <= 1) {
                    $(this).val(0);
                } else {
                    $(this).val($(this).val().slice(0, -1));
                }
            } else if ($(this).val()[0] == 0 && $(this).val().length > 1) {
                let newVal = $(this).val().slice(1);
                $(this).val(newVal);
            }
        }

        $(document).on('change', '#item_purchase_tax_type', function() {
            updateItemTotal();
            updateInvTotal();
            updateGrandTotal();
            $('#item_purchase_tax_type').css('border-color', '#ced4da');
        });

        $(document).on('input', '#p_h_other', function(e) {
            validateIntInput.call(this);
            if (!isInteger($(this).val())) {
                return;
            }
            updateInvTotal();
            updateGrandTotal();
        });

        $(document).on('input', '#p_h_dis', function(e) {
            validateIntInput.call(this);
            if (!isInteger($(this).val())) {
                return;
            }
            updateGrandTotal();
        });

        $(document).on('input', '#p_h_paid', function(e) {
            validateIntInput.call(this);
            if (!isInteger($(this).val())) {
                return;
            }
            updateGrandTotal();
        });

        $(document).on('input', '#item_stock_whole, #item_purchase_rate', function() {
            validateIntInput.call(this);
            if (!isInteger($(this).val())) {
                return;
            }
            if (item_stock_whole != 0) {
                $("#item_stock_whole").removeAttr('style');
            }
            updateItemTotal();
            updateInvTotal();
            updateGrandTotal();
        });

        $(document).on('change', '#item_gst_slab', function() {
            updateItemTotal();
            updateInvTotal();
            updateGrandTotal();
            $('#item_gst_slab').css('border-color', '#ced4da');
        });

        function isInteger(value) {
            return /^\d+$/.test(value);
        }
        // Billing Logic on Input End
        // Form Save
        $(document).on('click', '.submit_btn', function() {
            if (!validateForm()) {
                return;
            }
            if (previousItemID != newItemID && previousItemID != 0) {
                $(this).data('p_h_id', 0);
            } else {
                $(this).data('p_h_id', previousHistoryID);
            }
            previousItemID = newItemID;
            const button_role = $(this).attr('data-role');
            const p_h_id = $(this).data('p_h_id');
            const p_id = $('#p_id').val();
            const p_e_b_otp = $('#p_e_b_otp').val();
            const p_name = $('#p_name').val();
            const p_fmob = $('#p_fmob').val();
            const p_smob = $('#p_smob').val();
            const p_gst = $('#p_gst').val();
            const p_state = $('#p_state').val();
            const p_add = $('#p_add').val();
            const p_desc = $('#p_desc').val();
            const p_h_bill_no = $('#p_h_bill_no').val();
            const p_h_bill_date = $('#p_h_bill_date').val();
            const p_h_veh_no = $('#p_h_veh_no').val();
            const p_h_del_date = $('#p_h_del_date').val();
            const p_h_other = $('#p_h_other').val();
            const p_h_pre = $('#p_h_pre').val();
            const p_h_total = $('#p_h_total').val();
            const p_h_dis = $('#p_h_dis').val();
            const p_h_grand = $('#p_h_grand').val();
            const p_h_paid = $('#p_h_paid').val();
            const p_h_dues = $('#p_h_dues').val();
            const p_h_desc = $('#p_h_desc').val();
            const item_name = $('#item_name').val();
            const item_name_local = $('#item_name_local').val();
            const item_hsn = $('#item_hsn').val();
            const item_location = $('#item_location').val();
            const item_desc = $('#item_desc').val();
            const item_base_unit = $('#item_base_unit').val();
            const item_conversion_rate = $('#item_conversion_rate').val();
            const item_sub_unit = $('#item_sub_unit').val();
            const item_gst = $('#item_gst').val();
            const item_purchase_rate = $('#item_purchase_rate').val();
            const item_purchase_tax_type = $('#item_purchase_tax_type').val();
            const item_sale_tax_type = $('#item_sale_tax_type').val();
            const item_gst_slab = $('#item_gst_slab').val();
            const item_stock_whole = $('#item_stock_whole').val();
            const item_total = $('#item_total').val();
            const item_min_stock = $('#item_min_stock').val();
            const item_sale_rate_whole_base = $('#item_sale_rate_whole_base').val();
            const item_sale_rate_whole_sub = $('#item_sale_rate_whole_sub').val();
            const item_sale_rate_retail_base = $('#item_sale_rate_retail_base').val();
            const item_sale_rate_retail_sub = $('#item_sale_rate_retail_sub').val();
            const item_mfg_date = $('#item_mfg_date').val();
            const item_exp_date = $('#item_exp_date').val();
            const item_exp_alert_time = $('#item_exp_alert_time').val();
            const item_id = $('#item_id').val();
            const p_i_id = $(this).attr('data');
            const item_mrp = $('#item_mrp').val();
            const item_disc_whole = $('#item_disc_whole').val();
            const item_disc_retail = $('#item_disc_retail').val();
            const account = $('#tnx_account').val();
            if (p_h_bill_date === '') {
                Swal.fire({
                    title: "Error!",
                    text: "Bill Date is required",
                    icon: "error"
                });
                return false;
            }
            if (account === '') {
                Swal.fire({
                    title: "Error!",
                    text: "Please Select Account",
                    icon: "error"
                });
                return false;
            }
            if (item_gst == 1) {
                if (item_purchase_tax_type == 1) {
                    if (item_gst_slab === '') {
                        $('#item_gst_slab').focus();
                        $('#item_gst_slab').css('border-color', 'red');
                        return;
                    }
                }
            }
            if ($('#item_gst').val() == 1) {
                if ($('#item_purchase_tax_type').val() === '') {
                    Swal.fire({
                        title: "Error!",
                        text: "Please Select Tax Type (Purchase)",
                        icon: "error"
                    });
                    return;
                }
                if ($('#item_sale_tax_type').val() === '') {
                    Swal.fire({
                        title: "Error!",
                        text: "Please Select Tax Type (Sale)",
                        icon: "error"
                    });
                    return;
                }
                if ($('#item_gst_slab').val() === '') {
                    Swal.fire({
                        title: "Error!",
                        text: "Please Select GST Slab",
                        icon: "error"
                    });
                    return;
                }
            }
            if (item_stock_whole == 0) {
                $("#item_stock_whole").focus();
                $("#item_stock_whole").attr('style', 'border: 1px solid red !important');
                return;
            }
            let stateData = 0;
            $.post("{{url('save-purchase-entry')}}", {
                p_id: p_id,
                p_e_b_otp: p_e_b_otp,
                p_name: p_name,
                p_fmob: p_fmob,
                p_smob: p_smob,
                p_gst: p_gst,
                p_state: p_state,
                p_add: p_add,
                p_desc: p_desc,
                p_h_id: p_h_id,
                p_h_bill_no: p_h_bill_no,
                p_h_bill_date: p_h_bill_date,
                p_h_veh_no: p_h_veh_no,
                p_h_del_date: p_h_del_date,
                p_h_other: p_h_other,
                p_h_pre: p_h_pre,
                p_h_total: p_h_total,
                p_h_dis: p_h_dis,
                p_h_grand: p_h_grand,
                p_h_paid: p_h_paid,
                p_h_dues: p_h_dues,
                p_h_desc: p_h_desc,
                item_name: item_name,
                item_name_local: item_name_local,
                item_hsn: item_hsn,
                item_location: item_location,
                item_desc: item_desc,
                item_base_unit: item_base_unit,
                item_conversion_rate: item_conversion_rate,
                item_sub_unit: item_sub_unit,
                item_gst: item_gst,
                item_purchase_rate: item_purchase_rate,
                item_purchase_tax_type: item_purchase_tax_type,
                item_sale_tax_type: item_sale_tax_type,
                item_gst_slab: item_gst_slab,
                item_stock_whole: item_stock_whole,
                item_total: item_total,
                item_min_stock: item_min_stock,
                item_sale_rate_whole_base: item_sale_rate_whole_base,
                item_sale_rate_whole_sub: item_sale_rate_whole_sub,
                item_sale_rate_retail_base: item_sale_rate_retail_base,
                item_sale_rate_retail_sub: item_sale_rate_retail_sub,
                item_mfg_date: item_mfg_date,
                item_exp_date: item_exp_date,
                item_exp_alert_time: item_exp_alert_time,
                button_role: button_role,
                item_id: item_id,
                p_i_id: p_i_id,
                item_mrp: item_mrp,
                item_disc_whole: item_disc_whole,
                item_disc_retail: item_disc_retail,
                account: account
            }, function(res) {
                console.log(res);
                // return;
                $('#purchase-entry')[0].reset();
                $('#item_total').val(0);
                pageSetup();
                invTotals = res.invTotals;
                newItemID = res.previousItemID;
                previousHistoryID = res.previousHistoryID;
                $('#item_gst').val('');
                if (res.role == 1 || res.role == 3) {
                    $('#save_and_new').attr('data-role', 1);
                    $('#purchase_history_table').show();
                    $('#purchase_history_list').html(``);
                    $.each(res.data, function(key, value) {
                        $('#purchase_history_list').append(`
                            <tr>
                                <td>${key+1}</td>
                                <td>${value.item_name}</td>
                                <td>${value.p_i_qty}</td>
                                <td>${value.p_i_rate}</td>
                                <td>${value.p_i_total}</td>
                                <td>
                                    <div class="btn btn-success edit-btn" data="${value.p_i_id}" data-p_h_id="${value.p_i_id}" data-edit="0">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn btn-danger delete-btn" data="${value.p_i_id}" data-p_h_id="${value.p_i_id}">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </div>
                                </td>
                            </tr>
                        `);
                    });

                    // Party Details
                    $('#p_id').val(res.partyData.p_id);
                    $('#p_name').val(res.partyData.p_name);
                    $('#p_fmob').val(res.partyData.p_fmob);
                    $('#p_smob').val(res.partyData.p_smob);
                    $('#p_gst').val(res.partyData.p_gst);
                    $('#p_state').val(res.partyData.p_state);
                    $('#party_state').html(res.partyData.p_state);
                    $('#p_add').val(res.partyData.p_add);
                    $('#p_desc').val(res.partyData.p_desc);

                    stateData = res.partyData.p_state;

                    // Billing Details
                    // console.log('InvTotal -> '+invTotals);
                    $('#p_h_total').val(invTotals);
                    $('#p_h_pre').val(previousDues);

                    $('#p_h_bill_no').val(res.history.p_h_bill_no);
                    $('#p_h_bill_date').val(res.history.p_h_bill_date);
                    $('#p_h_veh_no').val(res.history.p_h_veh_no);
                    $('#p_h_del_date').val(res.history.p_h_del_date);
                    $('#p_h_desc').val(res.history.p_h_desc);
                    $('#p_h_dis').val(res.history.p_h_dis);
                    $('#p_h_other').val(res.history.p_h_other);
                    $('#p_h_pre').val(res.history.p_h_pre);
                    $('#p_h_paid').val(res.history.p_h_paid);
                    $('#p_h_other').val(res.history.p_h_other);

                    updateGrandTotal();

                    // Calculations
                } else if (res.role == 0) {
                    location.reload();
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

            setTimeout(() => {
                $('#p_state').val(stateData);
                $('#p_h_total').val(parseFloat(invTotals)+parseFloat($('#p_h_other').val()));
                $('#tnx_account').val(parseInt(account));
                $('#tnx_account').attr('disabled', 'disabled');
            }, 500);
        });

        $(document).on('click', '.edit-btn', function() {
            $(this).data('edit', '1');
            const p_h_id = $(this).data('p_h_id');
            const p_i_id = $(this).attr('data');
            $('#save_and_new').data('p_h_id', p_h_id);
            $('#save_and_new').attr('data', $(this).attr('data'));
            $('#save_and_new').attr('data-role', 3);
            $.post("{{url('fetch-purchase-history')}}", {
                p_h_id: p_h_id,
                p_i_id: p_i_id
            }, function(res) {
                console.log(res);
                if (res.status === true) {
                    // Party Details
                    $('#p_name').val(res.partyData.p_name);
                    $('#p_fmob').val(res.partyData.p_fmob);
                    $('#p_smob').val(res.partyData.p_smob);
                    $('#p_gst').val(res.partyData.p_gst);
                    $('#p_state').val(res.partyData.p_state);
                    state_id = res.partyData.p_state;
                    $('#p_add').val(res.partyData.p_add);
                    $('#p_desc').val(res.partyData.p_desc);

                    // Billing Details
                    $('#p_h_bill_no').val(res.billingData.p_h_bill_no);
                    $('#p_h_bill_date').val(res.billingData.p_h_bill_date);
                    $('#p_h_veh_no').val(res.billingData.p_h_veh_no);
                    $('#p_h_del_date').val(res.billingData.p_h_del_date);
                    $('#p_h_other').val(res.billingData.p_h_other);
                    $('#p_h_pre').val(res.billingData.p_h_pre);
                    // $('#p_h_total').val(res.billingData.p_h_total);
                    $('#p_h_dis').val(res.billingData.p_h_dis);
                    $('#p_h_grand').val(res.billingData.p_h_grand);
                    $('#p_h_paid').val(res.billingData.p_h_paid);
                    $('#p_h_dues').val(res.partyData.p_dues);
                    $('#p_h_desc').val(res.billingData.p_h_desc);

                    // Item Details
                    $('#item_name').val(res.itemData.item_name);
                    $('#item_name_local').val(res.itemData.item_name_local);
                    $('#item_id').val(res.itemData.item_id);
                    $('#item_hsn').val(res.itemData.item_hsn);
                    $('#item_location').val(res.itemData.item_location);
                    $('#item_desc').val(res.itemData.item_desc);
                    $('#item_base_unit').val(res.itemData.item_base_unit);
                    $('#item_conversion_rate').val(res.itemData.item_conversion_rate);
                    $('#item_sub_unit').val(res.itemData.item_sub_unit);
                    $('#item_gst').val(res.itemData.item_gst);
                    if (res.itemData.item_gst == 1) {
                        $('.gst').show();
                    }
                    $('#item_purchase_rate').val(res.itemData.item_purchase_rate);
                    $('#item_purchase_tax_type').val(res.itemData.item_purchase_tax_type);
                    $('#item_sale_tax_type').val(res.itemData.item_sale_tax_type);
                    $('#item_gst_slab').val(res.itemData.item_gst_slab);
                    $('#item_stock_whole').val(res.itemQty);
                    $('#item_total').val(0);
                    $('#item_min_stock').val(res.itemData.item_min_stock);
                    $('#item_sale_rate_whole_base').val(res.itemData.item_sale_rate_whole_base);
                    $('#item_sale_rate_whole_sub').val(res.itemData.item_sale_rate_whole_sub);
                    $('#item_sale_rate_retail_base').val(res.itemData.item_sale_rate_retail_base);
                    $('#item_sale_rate_retail_sub').val(res.itemData.item_sale_rate_retail_sub);
                    $('#item_mfg_date').val(res.itemData.item_mfg_date);
                    $('#item_mrp').val(res.itemData.item_mrp);
                    $('#item_disc_whole').val(res.itemData.item_disc_whole);
                    $('#item_disc_retail').val(res.itemData.item_disc_retail);
                    $('#item_exp_date').val(res.itemData.item_exp_date);
                    $('#item_exp_alert_time').val(res.itemData.item_exp_alert_time);

                    // Calculations
                    // $('#p_h_total').val(parseFloat(invTotals));
                    updateItemTotal();
                    invTotals = parseFloat(invTotals) - parseFloat(res.invtotal);
                    updateInvTotal();
                    updateGrandTotal();
                    $('#p_h_dues').val(parseFloat($('#p_h_dues').val()) - parseFloat($('#p_h_other').val()));
                    setTimeout(() => {
                        $('#p_state').val(state_id);
                    }, 100);
                    if (res.role == 3) {
                        $('#save_and_new').attr('data-role', 1);
                    }
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
        });

        $(document).on('click', '.delete-btn', function() {
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
                    const btn = $(this);
                    const p_h_id = btn.data('p_h_id');
                    $.post("{{url('delete-history-record')}}", {
                        p_h_id: p_h_id
                    }, function(res) {
                        if (res == true) {
                            btn.closest('tr').remove();
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
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

        function updateInvTotal() {
            let abc = parseFloat($('#p_h_total').val());
            let p_h_other = parseFloat($('#p_h_other').val());
            let item_total = parseFloat($('#item_total').val());
            let ass = parseFloat(invTotals) + p_h_other + item_total;
            $('#p_h_total').val(ass);
        }

        function updateGrandTotal() {
            let p_h_paid = parseFloat($('#p_h_paid').val());
            let p_h_dis = parseFloat($('#p_h_dis').val());

            let grandTotal = (parseFloat($('#p_h_total').val()) + parseFloat(previousDues)) - parseFloat(p_h_dis);
            $('#p_h_grand').val(grandTotal);
            grandTotal = parseFloat($('#p_h_grand').val());
            let final = parseFloat(grandTotal) - parseFloat($('#p_h_paid').val());
            $('#p_h_dues').val(final);
        }

        function updateItemTotal() {
            let item_purchase_rate = parseFloat($('#item_purchase_rate').val());
            let item_stock_whole = parseFloat($('#item_stock_whole').val());

            if ($('#item_gst').val() == 0) {
                if ($('#item_purchase_tax_type').val() === '') {
                    let item_total = item_purchase_rate * item_stock_whole;
                    $('#item_total').val(item_total);
                    return;
                }
                if ($('#item_gst_slab').val() === '') {
                    let item_total = item_purchase_rate * item_stock_whole;
                    $('#item_total').val(item_total);
                    return;
                }
                if ($('#item_purchase_tax_type').val() == 1) {
                    let selectedOption = $('#item_gst_slab').find('option:selected');
                    let item_gst_slab = selectedOption.data('gst');
                    if (item_gst_slab != NaN) {
                        let item_total = (item_purchase_rate * (100 + parseFloat(item_gst_slab))) / 100 * item_stock_whole;
                        console.log();
                        $('#item_total').val(item_total);
                        return;
                    }
                }
            }
            let item_total = item_purchase_rate * item_stock_whole;
            $('#item_total').val(item_total);
        }

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