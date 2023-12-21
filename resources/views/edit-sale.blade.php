@section('title', 'Sales Entry');
@include('common.header');
<style>
    .listtable,
    .listtablebarcode {
        display: none
    }

    .listtable {
        top: 130px;
    }

    .listtablebarcode {
        top: 330px;
    }
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form id="salse-entry">
                        @csrf
                        <input type="hidden" name="btn-type" id="btn-type" value="0">
                        <input type="hidden" name="c_id" id="c_id" class="party" value="{{$history->s_h_customer_id}}">
                        <input type="hidden" name="p_h_otp" id="p_h_otp" value="{{$history->s_h_otp}}">
                        <input type="hidden" name="s_h_id" value="0" id="s_h_id">
                        <div class="tab-content">
                            <div class="mb-3 card p-2 ">
                                <div class="row g-3">
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <select class="form-select" id="custType" placeholder="Customer Type" value="{{$customer->c_type}}" disabled>
                                                <option value="">Select</option>
                                                <option value="1" {{ $customer->c_type == '1' ? 'selected' : '' }}>Whole Sale</option>
                                                <option value="2" {{ $customer->c_type == '2' ? 'selected' : '' }}>Retail</option>
                                            </select>
                                            <label for="floatingSelect">Customer Type</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <select class="form-select" id="billType" data-type="0" placeholder="Bill Type" value="{{$history->s_h_bill_type}}" disabled>
                                                <option value="">Select</option>
                                                <option value="1" {{ $history->s_h_bill_type == '1' ? 'selected' : '' }}>With GST</option>
                                                <option value="2" {{ $history->s_h_bill_type == '2' ? 'selected' : '' }}>Without GST</option>
                                            </select>
                                            <label for="billType">Bill Type</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 offset-lg-4">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="billDate" value="{{$history->s_h_bill_date}}" placeholder="Date" onfocus="this.showPicker()" disabled>
                                            <label for="billDate">Date <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="c_name" placeholder="Name" value="{{$customer->c_name}}" disabled>
                                            <label for="c_name">Name <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="c_add" placeholder="Address" value="{{$customer->c_add}}" disabled>
                                            <label for="c_add">Address <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="c_fmob" placeholder="Mob. No." value="{{$customer->c_fmob}}" disabled>
                                            <label for="c_fmob">Mob. No. <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="c_smob" placeholder="Alt. Mob. No." value="{{$customer->c_smob}}" disabled>
                                            <label for="c_smob">Alt. Mob. No. <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="c_gst" placeholder="G.S.T No." value="{{$customer->c_gst}}" disabled>
                                            <label for="c_gst">G.S.T No. <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <select class="form-select" id="c_state" placeholder="State of Supply" value="{{$state->s_id}}" disabled>
                                                <option value="{{$state->s_id}}">{{$state->s_name}} ({{$state->s_name_h}})</option>
                                            </select>
                                            <label for="c_state">State of Supply</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="c_desc" placeholder="Party Description" value="{{$customer->c_desc}}" disabled>
                                            <label for="c_desc">Party Description <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="s_h_bill_desc" name="s_h_bill_desc" placeholder="Bill Desc." value="{{$history->s_h_bill_desc}}" disabled />
                                            <label for="s_h_bill_desc">Bill Desc. <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 card p-2 ">
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class='table'>
                                                <thead>
                                                    <tr>
                                                        <th>S.N</th>
                                                        <th>Item Name</th>
                                                        <th>Rate</th>
                                                        <th class="gst">Tax %</th>
                                                        <th>Qty.</th>
                                                        <th>Unit</th>
                                                        <th>Stock</th>
                                                        <th>Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="billingTable">
                                                    @foreach ($saleItems as $key=>$item)
                                                        <tr class="billing-rows" id="row-1" data-row="1">
                                                            <td class="sno">{{$key+1}}</td>
                                                            <td>
                                                                <input type="hidden" class="item_id" name="item_id[]" data-i_id="{{$item['s_i_item_id']}}" value="{{$item['s_i_item_id']}}">
                                                                <input type="hidden" class="sent_info" name="sent_info[]" value="1">
                                                                <input type="hidden" class="item_conversion_rate" name="item_conversion_rate[]" value="{{$item['item_conversion_rate']}}">
                                                                <input type="text" class="form-control item_name" name="item_name[]" placeholder="" required="" value="{{$item['item_name']}}">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control item_rate" name="item_rate[]" placeholder="" value="{{$customer->c_type == '1' ? $item['item_sale_rate_whole_base'] : $item['item_sale_rate_retail_base']}}" required="">
                                                            </td>
                                                            <td class="gst" {{$history->s_h_bill_type == '1' ? '' : 'style="display: none;"'}}>
                                                                <select class="form-select gstslab" name="gstslab[]" placeholder="Select Tax" disabled="">
                                                                    <option value="">Select Tax</option>
                                                                    <option value="18" {{ $item['item_gst_slab'] == '18' ? 'selected' : '' }}>G.S.T 18%</option>
                                                                    <option value="5" {{ $item['item_gst_slab'] == '5' ? 'selected' : '' }}>G.S.T 5%</option>
                                                                </select>
                                                            </td>
                                                            <td class="qty"><input type="text" class="form-control s_h_qty" name="s_h_qty[]" value="{{$item['s_i_qty']}}" placeholder=" " required="">
                                                            </td>
                                                            <td>
                                                                <select class="form-select base_unit" name="base_unit[]" placeholder="Select Unit">
                                                                    <option value="">Select Unit</option>
                                                                    <option value="Pcs" {{ $item['item_sub_unit'] == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                                                                    <option value="Meter" {{ $item['item_sub_unit'] == 'Meter' ? 'selected' : '' }}>Meter</option>
                                                                    <option value="Cartoon" {{ $item['item_sub_unit'] == 'Cartoon' ? 'selected' : '' }}>Cartoon</option>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" class="form-control stock" name="stock[]" placeholder="0" value="{{$item['item_stock_whole']}}" disabled="" required=""></td>
                                                            <td><input type="text" class="form-control amount" name="amount[]" placeholder="" value="{{$item['s_i_total']}}" disabled="" required=""></td>
                                                            <td class="d-flex">
                                                                <button type="button" class="btn rm btn-outline-danger btn-icon waves-effect waves-light" data="{{$item['s_i_id']}}"><i class="ri-subtract-line"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="text-end">
                                                <button type="button" class="btn ad btn-success btn-label waves-effect waves-light"><i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 card p-2 ">
                                <div class="row g-3">
                                    <div class="col-lg-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="0" id="s_h_other" placeholder="L & T Charges">
                                            <label for="s_h_other">L & T Charges</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="s_h_total" placeholder="Inv. Total" value="0" disabled />
                                            <label for="s_h_total">Inv. Total</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="0" id="s_h_dis" placeholder="Discount">
                                            <label for="s_h_dis">Discount</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="0" id="c_dues" placeholder="Pre" disabled />
                                            <label for="c_dues">Pre</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="s_h_grand" placeholder="Grand Total" value="0" disabled />
                                            <label for="s_h_grand">Grand Total</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="0" id="s_h_paid" placeholder="Paid">
                                            <label for="s_h_paid">Paid</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="s_h_due" placeholder="Rem." value="0" disabled />
                                            <label for="s_h_due">Rem.</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <button type="button" class="btn btn-outline-success rounded-pill" id="generate_invoice">Generate
                                                    Invoice</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
                <div class="px-4 listtable w-100 position-absolute" id="customertable">
                    <div class="card border shadow">
                        <div>
                            <table class="table table-nowrap table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Mobile</th>
                                        <th scope="col">Dues amt.</th>
                                    </tr>
                                </thead>
                                <tbody id="customerdata">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="px-4 listtablebarcode w-100 position-absolute" id="itemtable">
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
                                <tbody id="itemsdata">
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
    @include('common.footer');
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // let currentDate = new Date().toISOString().split('T')[0];
            // $('#billDate').val(currentDate);
            $(document).on('click', 'body', function() {
                var excludedInputIds = ['c_name'];
                if (!excludedInputIds.includes(event.target.id)) {
                    $('#customertable').hide();
                } else {}
            });
            get_parties();
            // get_state();
            get_items();
            // getGstSlab();
            // getUnits();
            // $('.gst').hide();
            // $('.gstslab').val('');
            let lastIndex = 0;

            calculateTotal();

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
                        $('#c_state').html(html);
                    }
                });
            }
            //--------------------------- Customer Data Manipulation ------------------------------------//
            $(document).on('focus', '#c_name', function() {
                $('#customertable').show();
                search_party_table($(this).val());
                $('.party:not(:eq(1))').val('');
                $('#customerdata tr:not([style*="display: none"])').removeClass("highlight_row");
                $('#c_add').val('');
                $('#c_fmob').val('');
                $('#c_smob').val('');
                $('#c_gst').val('');
                $('#c_state').val('');
                $('#c_desc').val('');
            });

            function get_parties() {
                var html = '';
                $.ajax({
                    method: 'post',
                    url: "{{ url('get-customers') }}",
                    success: function(result) {
                        $.each(result.data, function(index, value) {
                            var id = value.c_id;
                            html +=
                                `<tr class="c_detail" data='${id}' id="${id}"><td>${value.c_name}</td><td>${value.c_add}</td><td>${value.c_fmob}</td><td>${value.c_dues}</td></tr>`;
                        })
                        $('#customerdata').html(html);
                    }
                });
            }
            $('body').on('keydown', '#c_name', function(e) {
                $('#customertable').show();
                if (e.which == 38) {
                    highlightPartyRow(-1);
                } else if (e.which == 40) {
                    highlightPartyRow(1);
                } else if (e.which == 37) {

                } else if (e.which == 9 || e.which == 13) {
                    $('#customertable').hide();
                    $('#customerdata tr').each(function(index) {
                        if ($(this).hasClass("highlight_row")) {
                            var id = $(this).attr('id');
                            var xyz = parseFloat(id);
                            $('#customerdata tr:nth-child(' + xyz + ')').trigger('click');
                            return false;
                        }
                    });
                }
            });

            function highlightPartyRow(direction) {
                var rows = $('#customerdata tr:not([style*="display: none"])');
                var current = rows.filter('.highlight_row').index();
                var next = current + direction;
                if (direction < 0 && next < 0) next = 0
                if (direction > 0 && next >= rows.length) next = rows.length - 1;
                rows.removeClass("highlight_row");
                rows.eq(next).addClass('highlight_row');
            }
            $(document).on('input', '#c_name', function() {
                $('.party:not(:eq(1))').val('');
                search_party_table($(this).val());
            });

            function search_party_table(value) {
                $('#customerdata tr').each(function() {
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
            $(document).on('click', '#customerdata tr', function(event) {
                var org_id = $(this).attr('id');
                $('#customertable').hide();
                $('#custType').attr('disabled', 'disabled');
                $.ajax({
                    url: "{{ url('edit-customer') }}",
                    method: 'POST',
                    data: {
                        id: org_id
                    },
                    success: function(result) {
                        $('#c_id').val(result.data.c_id);
                        $('#c_name').val(result.data.c_name);
                        $('#c_add').val(result.data.c_add);
                        $('#c_fmob').val(result.data.c_fmob);
                        $('#c_smob').val(result.data.c_smob);
                        $('#c_gst').val(result.data.c_gst);
                        $('#c_state').val(result.data.c_state);
                        $('#c_desc').val(result.data.c_desc);
                        $('#c_dues').val(parseFloat(result.data.c_dues));
                        $('#custType').val(parseFloat(result.data.c_type));
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
                        $('#salse-entry')[0].reset();
                    }
                });
            });
            // Billing Table
            $(document).on('click', '.ad', function() {
                if ($('#s_h_bill_desc').val() === '') {
                    $('#s_h_bill_desc').focus();
                    return;
                }
                let shouldContinue = true;
                $.each($('.s_h_qty'), function(key, value) {
                    if ($(this).val() === '' || $(this).val() == 0) {
                        $(this).focus();
                        shouldContinue = false;
                        return;
                    }
                });
                if (!shouldContinue) {
                    return;
                }

                // Check if there is at least one row available
                if ($('#billingTable .billing-rows').length === 0) {
                    $('#billingTable').append(`
                        <tr class="billing-rows" id="row-1" data-row="1">
                            <td class="sno">1</td>
                            <td>
                                <input type="hidden" class="item_id" name="item_id[]" data-i_id="0">
                                <input type="hidden" class="sent_info" name="sent_info[]" value="0">
                                <input type="hidden" class="item_conversion_rate" name="item_conversion_rate[]">
                                <input type="text" class="form-control item_name" name="item_name[]" placeholder="" required />
                            </td>
                            <td>
                                <input type="text" class="form-control item_rate" value="0" name="item_rate[]" placeholder="" required />
                            </td>
                            <td class="gst" style="display: none;">
                                <select class="form-select gstslab" name="gstslab[]" disabled placeholder="Select Tax">
                                    <option value="">Select</option>
                                </select>
                            </td>
                            <td class="qty"><input type="text" value="0" class="form-control s_h_qty" name="s_h_qty[]" placeholder=" " required />
                            </td>
                            <td>
                                <select class="form-select base_unit" name="base_unit[]" placeholder="Select Unit">
                                    <option value="">Base Unit</option>
                                </select>
                            </td>
                            <td><input type="text" class="form-control stock" value="0" name="stock[]" placeholder="" disabled required /></td>
                            <td><input type="text" class="form-control amount" value="0" name="amount[]" placeholder="" disabled required /></td>
                            <td class="d-flex">
                                <button type="button" class="btn rm btn-outline-danger btn-icon waves-effect waves-light" data="0"><i class="ri-subtract-line"></i></button>
                            </td>
                        </tr>
                    `);

                    fetchGstSlab().then(gstSlab => {
                        updateGstSlabDropdown(gstSlab);
                    });

                    // Fetch base units from the database
                    fetchBaseUnits().then(baseUnits => {
                        // Update the base unit dropdown in the newly created row
                        updateBaseUnitDropdown(baseUnits);

                        updateSerialNumbers();

                        let billType = $('#billType').val();
                        if (billType != 1) {
                            $('.gst').hide();
                        } else {
                            $('.gst').show();
                        }
                    });
                    get_items();
                    return;
                }

                // Assuming you have a function to get the data from the previous row
                const previousRowData = getPreviousRowData();

                // Send the previous row data to the database
                sendToDatabase(previousRowData)
                    .then(response => {
                        // Find the last <tr> in the table
                        var lastRow = $('#billingTable tr.billing-rows:last');

                        // Find the <button> with the class '.rm' within the last <tr>
                        var removeBtn = lastRow.find('button.rm');
                        removeBtn.attr('data', response.s_i_id);
                        $('.billing-rows:last-child .sent_info').val(1);

                        $('#billingTable').append(`
                            <tr class="billing-rows" id="row-1" data-row="1">
                                <td class="sno">1</td>
                                <td>
                                    <input type="hidden" class="item_id" name="item_id[]" data-i_id="0">
                                    <input type="hidden" class="sent_info" name="sent_info[]" value="0">
                                    <input type="hidden" class="item_conversion_rate" name="item_conversion_rate[]">
                                    <input type="text" class="form-control item_name" name="item_name[]" placeholder="" required />
                                </td>
                                <td>
                                    <input type="text" class="form-control item_rate" value="0" name="item_rate[]" placeholder="" required />
                                </td>
                                <td class="gst" style="display: none;">
                                    <select class="form-select gstslab" name="gstslab[]" disabled placeholder="Select Tax">
                                        <option value="">Select</option>
                                    </select>
                                </td>
                                <td class="qty"><input type="text" class="form-control s_h_qty" value="0" name="s_h_qty[]" placeholder=" " required />
                                </td>
                                <td>
                                    <select class="form-select base_unit" name="base_unit[]" placeholder="Select Unit">
                                        <option value="">Base Unit</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control stock" value="0" name="stock[]" placeholder="0" disabled required /></td>
                                <td><input type="text" class="form-control amount" value="0" name="amount[]" placeholder="0.00" disabled required /></td>
                                <td class="d-flex">
                                    <button type="button" class="btn rm btn-outline-danger btn-icon waves-effect waves-light" data="0"><i class="ri-subtract-line"></i></button>
                                </td>
                            </tr>
                        `);

                        fetchGstSlab().then(gstSlab => {
                            updateGstSlabDropdown(gstSlab);
                        });

                        // Fetch base units from the database
                        fetchBaseUnits().then(baseUnits => {
                            // Update the base unit dropdown in the newly created row
                            updateBaseUnitDropdown(baseUnits);

                            updateSerialNumbers();

                            let billType = $('#billType').val();
                            if (billType != 1) {
                                $('.gst').hide();
                            } else {
                                $('.gst').show();
                            }
                        });
                    })
                    .catch(error => {
                        console.error("Error sending data to the database:", error);
                    });
                calculateTotal();
                get_items();
            });

            function getUnits() {
                $.post("{{url('fetch-base-units')}}", {}, function(res) {
                    updateBaseUnitDropdown(res)
                }).fail(function(err) {
                    console.log(err.responseJSON.status);
                });
            }

            function getGstSlab() {
                $.post("{{url('fetch-gst-slab')}}", {}, function(res) {
                    updateGstSlabDropdown(res)
                }).fail(function(err) {
                    console.log(err.responseJSON.status);
                });
            }
            // Function to fetch gst slab asynchronously
            function fetchGstSlab() {
                return new Promise((resolve, reject) => {
                    // Make an AJAX call to fetch base units from the database
                    $.ajax({
                        method: 'post',
                        url: "{{ url('fetch-gst-slab') }}",
                        success: function(result) {
                            resolve(result);
                        },
                        error: function(err) {
                            reject(err);
                        }
                    });
                });
            }
            // Function to fetch base units asynchronously
            function fetchBaseUnits() {
                return new Promise((resolve, reject) => {
                    // Make an AJAX call to fetch base units from the database
                    $.ajax({
                        method: 'post',
                        url: "{{ url('fetch-base-units') }}",
                        success: function(result) {
                            resolve(result);
                        },
                        error: function(err) {
                            reject(err);
                        }
                    });
                });
            }

            function updateGstSlabDropdown(gstSlab) {
                const dropdown = $('.billing-rows:last-child .gstslab');
                dropdown.empty();
                dropdown.append(`<option value="">Select Tax</option>`);
                if (Array.isArray(gstSlab)) {
                    gstSlab.forEach(slab => {
                        dropdown.append(`<option value="${slab.sl_per}">${slab.sl_name}</option>`);
                    });
                } else {
                    console.error("GST Slab data is not an array:", gstSlab);
                }
            }
            // Function to update the base unit dropdown in the newly created row
            function updateBaseUnitDropdown(baseUnits) {
                // Assuming the dropdown in the row has the class 'base_unit'
                const dropdown = $('.billing-rows:last-child .base_unit');
                dropdown.empty();
                dropdown.append(`<option value="">Select Unit</option>`);
                if (Array.isArray(baseUnits)) {
                    baseUnits.forEach(unit => {
                        dropdown.append(`<option value="${unit.u_name}">${unit.u_name}</option>`);
                    });
                } else {
                    console.error("Base units data is not an array:", baseUnits);
                }
            }

            function updateSerialNumbers() {
                $('.sno').each(function(index, element) {
                    $(element).text(index + 1);
                    lastIndex = (index + 1);
                });
                $('.billing-rows').each(function(index, element) {
                    $(element).attr('id', 'row-' + (index + 1));
                    $(element).attr('data-row', (index + 1));
                    // $(element).find('td').each(function(index1, element1) {
                    //     $(element1).addClass('column-set-'+(index+1));
                    // });
                });
            }
            updateSerialNumbers();
            $(document).on('click', '.rm', function() {
                var closestTr = $(this).closest('tr');
                var siblingTds = closestTr.find('td');
                siblingTds.find('input').addClass('activeItem');
                siblingTds.find('select').addClass('activeItem');
                siblingTds.find('select').addClass('activeItem');
                let confirmation = confirm("Do you really want to remove this item?");
                if (confirmation) {
                    const item_id = siblingTds.find('.item_id').val();
                    if (item_id === '') {
                        closestTr.remove();
                        calculateTotal();
                        updateSerialNumbers();
                        get_items();
                        return;
                    }
                    const item_name = siblingTds.find('.item_name').val();
                    const item_rate = siblingTds.find('.item_rate').val();
                    const gstslab = siblingTds.find('.gstslab').val();
                    const s_h_qty = siblingTds.find('.s_h_qty').val();
                    const base_unit = siblingTds.find('.base_unit').val();
                    const stock = siblingTds.find('.stock').val();
                    const amount = siblingTds.find('.amount').val();
                    const otp = $('#p_h_otp').val();
                    $.post("{{url('remove-item-generate-invoice')}}", {
                        item_id: item_id,
                        item_name: item_name,
                        item_rate: item_rate,
                        gstslab: gstslab,
                        s_h_qty: s_h_qty,
                        base_unit: base_unit,
                        stock: stock,
                        amount: amount,
                        otp: otp
                    }, function(res) {
                        console.log(res);
                        if (res.status === true) {
                            closestTr.remove();
                            calculateTotal();
                            updateSerialNumbers();
                            get_items();
                        } else {
                            console.log("Item not deleted!");
                        }
                    }).fail(function(err) {
                        console.log(err);
                    });
                }
                siblingTds.find('input').removeClass('activeItem');
                siblingTds.find('select').removeClass('activeItem');
                siblingTds.find('select').removeClass('activeItem');
            });
            // Function to get data from the previous row
            function getPreviousRowData() {
                const item_id = $('.billing-rows:last-child .item_id').val();
                const sent_info = $('.billing-rows:last-child .sent_info').val();
                const item_name = $('.billing-rows:last-child .item_name').val();
                const item_rate = $('.billing-rows:last-child .item_rate').val();
                const gstslab = $('.billing-rows:last-child .gstslab').val();
                const s_h_qty = $('.billing-rows:last-child .s_h_qty').val();
                const base_unit = $('.billing-rows:last-child .base_unit').val();
                const stock = $('.billing-rows:last-child .stock').val();
                const amount = $('.billing-rows:last-child .amount').val();
                const p_h_otp = $('#p_h_otp').val();
                const s_h_id = $('#s_h_id').val();
                const c_id = $('#c_id').val();
                const billDate = $('#billDate').val();
                const billType = $('#billType').val();
                const custType = $('#custType').val();
                const s_h_bill_desc = $('#s_h_bill_desc').val();
                const s_h_other = $('#s_h_other').val();
                const s_h_total = $('#s_h_total').val();
                const c_dues = $('#c_dues').val();
                const s_h_grand = $('#s_h_grand').val();
                const s_h_paid = $('#s_h_paid').val();
                const s_h_due = $('#s_h_due').val();
                const c_name = $('#c_name').val();
                const c_add = $('#c_add').val();
                const c_fmob = $('#c_fmob').val();
                const c_smob = $('#c_smob').val();
                const c_gst = $('#c_gst').val();
                const c_state = $('#c_state').val();
                const c_desc = $('#c_desc').val();
                const s_h_dis = $('#s_h_dis').val();
                const btnType = $('#btn-type').val();
                return {
                    item_id,
                    item_name,
                    item_rate,
                    gstslab,
                    s_h_qty,
                    base_unit,
                    stock,
                    amount,
                    s_h_id,
                    p_h_otp,
                    c_id,
                    billDate,
                    billType,
                    custType,
                    s_h_bill_desc,
                    s_h_other,
                    s_h_total,
                    s_h_dis,
                    c_dues,
                    s_h_grand,
                    s_h_due,
                    s_h_paid,
                    c_name,
                    c_add,
                    c_fmob,
                    c_smob,
                    c_gst,
                    c_state,
                    c_desc,
                    btnType,
                    sent_info
                    // Add other fields
                };
            }
            // Function to send data to the database
            function sendToDatabase(data) {
                return new Promise((resolve, reject) => {
                    if (data.sent_info == 1) {
                        resolve(true);
                        return;
                    }
                    $.ajax({
                        method: 'post',
                        url: "{{ url('save-sales-items') }}",
                        data: data,
                        success: function(response) {
                            let c_id = $('#c_id').val();
                            console.log(response);
                            if (c_id === '' || c_id == 0) {
                                $('#c_id').val(response.data.c_id);
                            }
                            resolve(response);
                        },
                        error: function(error) {
                            reject(error);
                        }
                    });
                });
            }
            //--------------------------- Item Data Manipulation ------------------------------------//
            $(document).on('focus', '.item_name', function() {
                var dataRow = $(this).closest('tr').data('row');
                var trHeight = $(this).closest('tr').height();
                var height = (parseInt(dataRow - 1) * (trHeight + 0.2));
                $('#itemtable').css('margin-top', height);
                $('#itemtable').show();
                search_item_table($(this).val());
                $('.item:not(:eq(1))').val(0);
                $('#itemsdata tr:not([style*="display: none"])').removeClass("highlight_row");
                // $(this).addClass('activeItemRow');
                var closestTr = $(this).closest('tr');
                // Find all sibling 'td' elements within the same 'tr'
                var siblingTds = closestTr.find('td');
                // Add the class "activeItemRow" to inputs within the sibling 'td' elements
                siblingTds.find('input').addClass('activeItem');
                siblingTds.find('select').addClass('activeItem');
                siblingTds.find('button').addClass('activeItem');
            });
            $('body').on('keydown', '.item_name', function(e) {
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
                            $('#itemsdata tr:nth-child(' + xyz + ')').trigger('click');
                            return false;
                        }
                    });
                }
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
            $(document).on('input', '.item_name', function() {
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
                                `<tr id="${id}">
                                    <td>${value.item_name}</td>
                                    <td>${value.item_name_local}</td>
                                    <td>${value.item_stock_whole} ${value.item_base_unit} , ${value.item_stock_retail} ${value.item_sub_unit} </td>
                                    <td>${value.item_location}</td>
                                </tr>`;
                        })
                        $('#itemsdata').html(html);
                    }
                });
            }
            $(document).on('click', '#itemsdata tr', function() {
                $('#itemtable').hide();
                if ($('#custType').val() === '') {
                    alert('Please select customer type first!');
                    return;
                }
                if ($('#billType').val() === '') {
                    alert('Please select bill type first!');
                    return;
                }
                if ($('#c_name').val() === '') {
                    alert('Please select a customer first!');
                    return;
                }
                $('#custType').attr('disabled', 'disabled');
                $('#billType').attr('disabled', 'disabled');
                $('#c_name').attr('disabled', 'disabled');
                $('#c_add').attr('disabled', 'disabled');
                $('#c_fmob').attr('disabled', 'disabled');
                $('#c_smob').attr('disabled', 'disabled');
                $('#c_gst').attr('disabled', 'disabled');
                $('#c_state').attr('disabled', 'disabled');
                $('#c_desc').attr('disabled', 'disabled');

                // Find the input with name "item_id" within the active row in #billingTable
                var targetInput = $('#billingTable input[name="item_id[]"].activeItem');
                var targetButton = $('#billingTable button[type="button"].activeItem');

                let item_name = $('#billingTable input[name="item_name[]"].activeItem');
                let item_conversion_rate = $('#billingTable input[name="item_conversion_rate[]"].activeItem');
                let item_rate = $('#billingTable input[name="item_rate[]"].activeItem');
                let gstslab = $('#billingTable select[name="gstslab[]"].activeItem');
                let base_unit = $('#billingTable select[name="base_unit[]"].activeItem');
                let stock = $('#billingTable input[name="stock[]"].activeItem');
                let amount = $('#billingTable input[name="amount[]"].activeItem');
                var itemId = $(this).closest('tr').attr('id');
                targetButton.attr("data-i_id", itemId);
                targetInput.attr("data-i_id", itemId);
                targetInput.val(itemId);
                $.post("{{url('edit-item')}}", {
                    id: itemId
                }, function(res) {
                    // console.log(res);
                    item_name.val(res.item_name);
                    item_conversion_rate.val(res.item_conversion_rate);
                    if ($('#custType').val() == 1) {
                        item_rate.val(res.item_sale_rate_whole_base);
                    } else if ($('#custType').val() == 2) {
                        item_rate.val(res.item_sale_rate_retail_base);
                    }


                    gstslab.val(res.item_gst_slab);
                    base_unit.val(res.item_base_unit);
                    stock.val(res.item_stock_whole);
                    amount.val(0);
                }).fail(function(err) {});
                $('input').removeClass('activeItem');
                $('select').removeClass('activeItem');
                $('button').removeClass('activeItem');
            });
            $(document).on('change', '#billType', function() {
                let billType = $(this).val();
                $('.gst').hide();
                if (billType == '') {
                    $(this).attr('data-type', 0);
                } else {
                    $(this).attr('data-type', billType);
                    if (billType == 1) {
                        $('.gst').show();
                    }
                }
            });
            $(document).on('input', '.item_rate', function() {
                let currentItemStock = 0
                validateIntInput.call(this);
                if (!isInteger($(this).val())) {
                    return;
                }
                let value = $(this).val();
                let item_id = $('#billingTable input[name="item_id[]"].activeItem');
                let s_h_qty = $('#billingTable input[name="s_h_qty[]"].activeItem');
                let qty = s_h_qty.val();
                let amount = $('#billingTable input[name="amount[]"].activeItem');
                let stock = $('#billingTable input[name="stock[]"].activeItem');
                let gstslab = $('#billingTable select[name="gstslab[]"].activeItem');
                $.post("{{url('fetch-item-stock')}}", {
                    id: item_id.val()
                }, function(res) {
                    currentItemStock = res;
                    let finalStock = parseFloat(currentItemStock) - parseFloat(qty);
                    stock.val(finalStock);
                }).fail(function(err) {
                    console.log(err);
                });

                let finalAmount = parseFloat(qty) * parseFloat(value);
                amount.val(finalAmount);
                calculateTotal();
            });
            $(document).on('focus', '.item_rate', function() {
                var closestTr = $(this).closest('tr');
                var siblingTds = closestTr.find('td');
                siblingTds.find('input').addClass('activeItem');
                siblingTds.find('select').addClass('activeItem');
                siblingTds.find('select').addClass('activeItem');
            });
            $(document).on('blur', '.item_rate', function() {
                var closestTr = $(this).closest('tr');
                var siblingTds = closestTr.find('td');
                siblingTds.find('input').removeClass('activeItem');
                siblingTds.find('select').removeClass('activeItem');
                siblingTds.find('select').removeClass('activeItem');
            });
            $(document).on('input', '.s_h_qty', function() {
                let currentItemStock = 0
                validateIntInput.call(this);
                if (!isInteger($(this).val())) {
                    return;
                }
                let value = $(this).val();
                let item_id = $('#billingTable input[name="item_id[]"].activeItem');
                let item_rate = $('#billingTable input[name="item_rate[]"].activeItem');
                let amount = $('#billingTable input[name="amount[]"].activeItem');
                let stock = $('#billingTable input[name="stock[]"].activeItem');
                let gstslab = $('#billingTable select[name="gstslab[]"].activeItem');
                $.post("{{url('fetch-item-stock')}}", {
                    id: item_id.val()
                }, function(res) {
                    currentItemStock = res;
                    let finalStock = parseFloat(currentItemStock) - parseFloat(value);
                    stock.val(finalStock);
                }).fail(function(err) {
                    console.log(err);
                });


                let finalAmount = parseFloat(value) * parseFloat(item_rate.val());
                amount.val(finalAmount);
                calculateTotal();
            });
            $(document).on('focus', '.s_h_qty', function() {
                var closestTr = $(this).closest('tr');
                var siblingTds = closestTr.find('td');
                siblingTds.find('input').addClass('activeItem');
                siblingTds.find('select').addClass('activeItem');
                siblingTds.find('select').addClass('activeItem');
            });
            $(document).on('blur', '.s_h_qty', function() {
                var closestTr = $(this).closest('tr');
                var siblingTds = closestTr.find('td');
                siblingTds.find('input').removeClass('activeItem');
                siblingTds.find('select').removeClass('activeItem');
                siblingTds.find('select').removeClass('activeItem');
            });

            function isInteger(value) {
                return /^\d+$/.test(value);
            }

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

            $(document).on('input', '#s_h_other', function() {
                validateIntInput.call(this);
                if (!isInteger($(this).val())) {
                    return;
                }
                calculateTotal();
            });
            $(document).on('input', '#s_h_dis', function() {
                validateIntInput.call(this);
                if (!isInteger($(this).val())) {
                    return;
                }
                calculateTotal();
            });
            $(document).on('input', '#s_h_paid', function() {
                validateIntInput.call(this);
                if (!isInteger($(this).val())) {
                    return;
                }
                calculateTotal();
            });

            function calculateTotal() {
                var totalAmount = 0;

                // Loop through each row and add the amount to the total
                $('.billing-rows').each(function() {
                    var amount = parseFloat($(this).find('.amount').val()) || 0;
                    totalAmount += amount;
                });
                let invTotal = $('#s_h_other').val();
                totalAmount += parseFloat(invTotal);

                // console.log(totalAmount);

                // Update the totalAmount field
                $('#s_h_total').val(totalAmount.toFixed(2));

                let s_h_total = $('#s_h_total').val();
                let s_h_other = $('#s_h_other').val();
                let s_h_dis = $('#s_h_dis').val();
                let c_dues = $('#c_dues').val();

                let grandTotal = (parseFloat(s_h_total) + parseFloat(c_dues)) - parseFloat(s_h_dis);

                $('#s_h_grand').val(grandTotal);
                let s_h_grand = $('#s_h_grand').val();
                let s_h_paid = $('#s_h_paid').val();

                let due = parseFloat(s_h_grand) - parseFloat(s_h_paid);

                $('#s_h_due').val(due);

            }

            $(document).on('click', '#generate_invoice', function() {
                $('#btn-type').val(1);
                if ($('#custType').val() === '') {
                    alert('Please select customer type first!');
                    return;
                }
                if ($('#billType').val() === '') {
                    alert('Please select bill type first!');
                    return;
                }
                if ($('#c_name').val() === '') {
                    alert('Please select a customer first!');
                    return;
                }
                if ($('#s_h_bill_desc').val() === '') {
                    $('#s_h_bill_desc').focus();
                    return;
                }
                let shouldContinue = true;
                $.each($('.s_h_qty'), function(key, value) {
                    if ($(this).val() === '' || $(this).val() == 0) {
                        $(this).focus();
                        shouldContinue = false;
                        return;
                    }
                });
                if (!shouldContinue) {
                    return;
                }
                const previousRowData = getPreviousRowData();
                console.log(previousRowData);

                // Send the previous row data to the database
                sendToDatabase(previousRowData).then(response => {
                    let otp = $('#p_h_otp').val();
                    let url = `{{url('${otp}-salesentry-generate-invoice')}}`;
                    window.location.href = url;
                    // console.log('done');
                }).catch(error => {
                    console.error("Error sending data to the database:", error);
                });
                $('#btn-type').val(0);
            });
        });
    </script>