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
                        <input type="hidden" name="c_id" id="c_id" class="party" value="0">
                        <input type="hidden" name="p_h_otp" id="p_h_otp" value="<?php echo rand(1111111111, 9999999999); ?>">
                        <input type="hidden" name="old_unit" id="old_unit" value="0">
                        <input type="hidden" name="old_qty" id="old_qty" value="0">
                        <div class="tab-content">
                            <div class="mb-3 card p-2 ">
                                <div class="row g-3">
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <select class="form-select" id="custType" placeholder="Customer Type">
                                                <option value="">Select</option>
                                                <option value="1">Whole Sale</option>
                                                <option value="2">Retail</option>
                                            </select>
                                            <label for="floatingSelect">Customer Type</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <select class="form-select" id="billType" data-type="0" placeholder="Bill Type">
                                                <option value="">Select</option>
                                                <option value="1">With GST</option>
                                                <option value="2">Without GST</option>
                                            </select>
                                            <label for="billType">Bill Type</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 offset-lg-4">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="billDate" placeholder="Date" onfocus="this.showPicker()">
                                            <label for="billDate">Date <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="c_name" placeholder="Name">
                                            <label for="c_name">Name <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="c_add" placeholder="Address">
                                            <label for="c_add">Address <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="c_fmob" placeholder="Mob. No.">
                                            <label for="c_fmob">Mob. No. <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="c_smob" placeholder="Alt. Mob. No.">
                                            <label for="c_smob">Alt. Mob. No. <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="c_gst" placeholder="G.S.T No.">
                                            <label for="c_gst">G.S.T No. <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <select class="form-select" id="c_state" placeholder="State of Supply">
                                                <option value="Bihar">Bihar</option>
                                                <option value="Utter Pradesh">Utter Pradesh</option>
                                                <option value="Assam">Assam</option>
                                                <option value="Punjab">Punjab</option>
                                            </select>
                                            <label for="c_state">State of Supply</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="c_desc" placeholder="Party Description">
                                            <label for="c_desc">Party Description <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="s_h_bill_desc" name="s_h_bill_desc" placeholder="Bill Desc." />
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
                                                        <th>List Price</th>
                                                        <th>Discount%</th>
                                                        <th>Rate</th>
                                                        <th class="gst">Tax %</th>
                                                        <th>Qty.</th>
                                                        <th>Unit</th>
                                                        <th>Stock</th>
                                                        <th>Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="billingTable"></tbody>
                                            </table>
                                            <div class="text-end">
                                                <button type="button" id="newRow" class="btn btn-success btn-label waves-effect waves-light"><i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 card p-2 ">
                                <div class="row g-3">
                                    <div class="col-lg-2 lnt">
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
                                    <div class="col-lg-2" style="display: none;">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="0" id="s_h_dis" placeholder="Discount">
                                            <label for="s_h_dis">Discount</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
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
                                            <select class="form-select" id="tnx_account" name="tnx_account" placeholder=""></select>
                                            <label for="tnx_account">Account</label>
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
            console.clear();

            function getAccountList() {
                $.get("{{url('fetch-account-list')}}", function(res) {
                    $('#tnx_account').html(`<option value="">Select</option>`);
                    $.each(res, function(key, val) {
                        $('#tnx_account').append(`<option value="${val.ac_id}">${val.ac_name}</option>`);
                    });
                });
            }
            getAccountList();
            let currentDate = new Date().toISOString().split('T')[0];
            $('#billDate').val(currentDate);
            $(document).on('click', 'body', function() {
                var excludedInputIds = ['c_name'];
                if (!excludedInputIds.includes(event.target.id)) {
                    $('#customertable').hide();
                } else {}
            });
            get_parties();
            get_state();
            get_items();
            $('.gst').hide();
            $('.gstslab').val('');
            let lastIndex = 0;
            let activerow;

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

            function get_items() {
                var html = '';
                $.ajax({
                    method: 'post',
                    url: "{{ url('get-items') }}",
                    data: {
                        type: $('#billType').val()
                    },
                    success: function(result) {
                        $.each(result, function(index, value) {
                            // var id = value.item_id * 456 * 789;
                            var id = value.item_id;
                            html +=
                                `<tr id="${id}" class="pii${id}">
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

            $(document).on('focus', '.item_name', function() {
                activerow = $(this).closest('tr');
                var trHeight = $(this).closest('tr').height();
                // console.log(trHeight);
                var height = (parseInt(activerow.index()) * (trHeight + 0.1));
                $('#itemtable').css('margin-top', height);
                $('#itemtable').show();
                search_item_table($(this).val());
                $('.item:not(:eq(1))').val(0);
                $('#itemsdata tr:not([style*="display: none"])').removeClass("highlight_row");
                let unit = `<option value="">Select Unit</option>`;
                $.post("{{url('fetch-base-units')}}", {}, function(res) {
                    $.each(res, function(key, val) {
                        unit += `<option value="${val.u_name}">${val.u_name}</option>`
                    });
                    // console.log(unit);
                    let slab = `<option value="">Select</option>`;
                    $.post("{{url('fetch-gst-slab')}}", {}, function(response) {
                        $.each(response, function(key, val) {
                            slab += `<option value="${val.sl_per}">${val.sl_name}</option>`
                        });
                        // console.log(slab);
                        let style = '';
                        if ($('#billType').val() != 1) {
                            style = `style="display: none;"`;
                        }
                        updateCalculations();
                    }).fail(function(err) {
                        console.log(err);
                    });
                }).fail(function(err) {
                    console.log(err);
                });
                // console.log(res);
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
                            $('.pii'+id).click();
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
                        $('#itemtable').show();
                        $(this).show();
                    } else {
                        $(this).hide();
                        $(this).removeClass("highlight_row");
                        // $('#itemtable').hide();
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

                var itemId = $(this).closest('tr').attr('id');
                $.post("{{url('edit-item')}}", {
                    id: itemId
                }, function(res) {
                    // console.log(res);
                    activerow.find('.item_id').val(res.item_id);
                    // activerow.find('.p_i_id').val(0);
                    activerow.find('.item_conversion_rate').val(res.item_conversion_rate);
                    activerow.find('.item_purchase_rate').val(res.item_purchase_rate);
                    activerow.find('.item_sale_rate_whole_base').val(res.item_sale_rate_whole_base);
                    activerow.find('.item_sale_rate_whole_sub').val(res.item_sale_rate_whole_sub);
                    activerow.find('.item_sale_rate_retail_base').val(res.item_sale_rate_retail_base);
                    activerow.find('.item_sale_rate_retail_sub').val(res.item_sale_rate_retail_sub);
                    activerow.find('.item_purchase_tax_type').val(res.item_purchase_tax_type);
                    activerow.find('.item_stock_whole').val(res.item_stock_whole);
                    activerow.find('.item_stock_retail').val(res.item_stock_retail);
                    activerow.find('.item_base_unit').val(res.item_base_unit);
                    activerow.find('.item_gst_slab').val(res.item_gst_slab);
                    activerow.find('.item_amount').val('');
                    activerow.find('.item_mrp').val(res.item_mrp);
                    activerow.find('.item_sub_unit').val(res.item_sub_unit);
                    activerow.find('.item_name').val(res.item_name);
                    if ($('#custType').val() == 1) {
                        activerow.find('.item_rate').val(res.item_mrp);
                        activerow.find('.item_discount').val(res.item_disc_whole);
                    } else {
                        activerow.find('.item_rate').val(res.item_mrp);
                        activerow.find('.item_discount').val(res.item_disc_retail);
                    }
                    activerow.find('.gstslab').val(res.item_gst_slab);
                    activerow.find('.gstslab').attr('disabled', 'disabled');
                    activerow.find('.item_qty').val(0);
                    activerow.find('.base_unit').html(`<option value="">Select Unit</option><option value="${res.item_base_unit}" selected>${res.item_base_unit}</option><option value="${res.item_sub_unit}">${res.item_sub_unit}</option>`);
                    activerow.find('.stock').val(res.item_stock_whole);
                    activerow.find('.amount').val(0);
                    if (activerow.find('.item_name').val() != '') {
                        activerow.find('.item_name').css('border-color', '#ced4da');
                    }
                    updateCalculations();
                }).fail(function(err) {
                    console.log(err);
                    alert(err.responseJSON.message);
                });
            });

            $(document).on('change', '#billType', function() {
                let billType = $(this).val();
                $('.gst').hide();
                $('.lnt').show();
                if (billType == '') {
                    $(this).attr('data-type', 0);
                } else {
                    $(this).attr('data-type', billType);
                    if (billType == 1) {
                        $('.gst').show();
                        $('.lnt').hide();
                    }
                }
            });

            $(document).on('blur', '.item_name', function() {
                setTimeout(function() {
                    if (!$("#itemtable:hover").length) {
                        $("#itemtable").hide();
                    }
                }, 100);
                saveActiveRowData();
            });

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
                $('#c_id').val(0);
            });

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
                        $('#customertable').show();
                        $(this).show();
                    } else {
                        $(this).hide();
                        $(this).removeClass("highlight_row");
                        $('#customertable').hide();
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
                        updateCalculations();
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

            $(document).on('click', '#newRow', function() {
                if (validateRowInputs()) {
                    firstBillingRow();
                    updateSerialNumbers();
                    saveActiveRowData()
                }
            });

            // Function to create the first billing row
            function firstBillingRow() {
                let unit = '';
                $.post("{{url('fetch-base-units')}}", {}, function(res) {
                    $.each(res, function(key, val) {
                        unit += `<option value="${val.u_name}">${val.u_name}</option>`
                    });
                    // console.log(unit);
                    let slab = "";
                    $.post("{{url('fetch-gst-slab')}}", {}, function(response) {
                        $.each(response, function(key, val) {
                            slab += `<option value="${val.sl_per}">${val.sl_name}</option>`
                        });
                        // console.log(slab);
                        let style = '';
                        if ($('#billType').val() != 1) {
                            style = `style="display: none;"`;
                        }
                        var row = `<tr>
                            <td class="sn">1</td>
                            <td>
                                <input type="hidden" class="p_i_id" name="p_i_id[]" value="0" />
                                <input type="hidden" class="item_id" name="item_id[]" value="0" />
                                <input type="hidden" class="item_conversion_rate" name="item_conversion_rate[]" value="0" />
                                <input type="hidden" class="form-control item_purchase_rate" name="item_purchase_rate[]" placeholder="" value="0" />
                                <input type="hidden" class="form-control item_sale_rate_whole_base" name="item_sale_rate_whole_base[]" placeholder="" value="0" />
                                <input type="hidden" class="form-control item_sale_rate_whole_sub" name="item_sale_rate_whole_sub[]" placeholder="" value="0" />
                                <input type="hidden" class="form-control item_sale_rate_retail_base" name="item_sale_rate_retail_base[]" placeholder="" value="0" />
                                <input type="hidden" class="form-control item_sale_rate_retail_sub" name="item_sale_rate_retail_sub[]" placeholder="" value="0" />
                                <input type="hidden" class="form-control item_purchase_tax_type" name="item_purchase_tax_type[]" placeholder="" value="0" />
                                <input type="hidden" class="form-control item_stock_whole" name="item_stock_whole[]" placeholder="" value="0" />
                                <input type="hidden" class="form-control item_stock_retail" name="item_stock_retail[]" placeholder="" value="0" />
                                <input type="hidden" class="form-control item_base_unit" name="item_base_unit[]" placeholder="" value="0" />
                                <input type="hidden" class="form-control item_gst_slab" name="item_gst_slab[]" placeholder="" value="0" />
                                <input type="hidden" class="form-control item_amount" name="item_amount[]" placeholder="" value="0" />
                                <input type="hidden" class="form-control item_mrp" name="item_mrp[]" placeholder="" value="0" />
                                <input type="hidden" class="form-control item_sub_unit" name="item_sub_unit[]" placeholder="" value="0" />
                                <input type="text" class="form-control item_name" name="item_name[]" placeholder="" required />
                            </td>
                            <td><input type="text" class="form-control item_rate" name="item_rate[]" placeholder="" value="0" required /></td>
                            <td><input type="text" class="form-control item_discount" name="item_discount[]" placeholder="" value="0" required /></td>
                            <td><input type="text" class="form-control final_item_rate" name="final_item_rate[]" placeholder="" value="0" disabled required /></td>
                            <td class="gst" ${style}>
                                <select class="form-select gstslab" name="gstslab[]" placeholder="Select Tax">
                                    <option value="">Select</option>${slab}
                                </select>
                            </td>
                            <td><input type="text" class="form-control item_qty" name="item_qty[]" value="0" placeholder=" " required /></td>
                            <td>
                                <select class="form-select base_unit" name="base_unit[]" placeholder="Select Unit">
                                    <option value="">Select Unit</option>${unit}
                                </select>
                            </td>
                            <td><input type="text" class="form-control stock" name="stock[]" placeholder="0" value="0" disabled required /></td>
                            <td><input type="text" class="form-control amount" name="amount[]" placeholder="" value="0" disabled required /></td>
                            <td><span class="btn btn-danger btn-sm remove">Remove</span></td>
                        </tr>`;

                        $('#billingTable').append(row);
                        updateSerialNumbers();
                    }).fail(function(err) {
                        console.log(err);
                    });
                }).fail(function(err) {
                    console.log(err);
                });
            }

            // Function to update serial numbers
            function updateSerialNumbers() {
                $('.sn').each(function(index) {
                    $(this).text(index + 1);
                });
            }

            // Function to remove a row
            $(document).on('click', '.remove', function() {
                var rowCount = $('#billingTable tr').length;
                console.log(rowCount);
                activerow = $(this).closest('tr');
                if (rowCount >= 1) {
                    $.post("{{url('delete-saved-sales-entry')}}", {
                        id: activerow.find('.p_i_id').val(),
                        otp: $('#p_h_otp').val()
                    }, function(res) {
                        console.log(res);
                        activerow.remove();
                    }).fail(function(err) {
                        console.log(err);
                    });
                } else {
                    $(this).closest('tr').remove();
                    firstBillingRow();
                }
                updateSerialNumbers();
                updateCalculations();
            });

            // Initial setup
            firstBillingRow();

            function validateRowInputs() {
                // Select all rows in the billing table
                var rows = $('#billingTable tr');

                // Iterate through each row
                for (var i = 0; i < rows.length; i++) {
                    // Get the input fields within the current row
                    if ($('#billType').val() == 1) {
                        var inputs = $(rows[i]).find('.item_name, .gstslab, .item_rate, .item_qty, .base_unit');
                    } else {
                        var inputs = $(rows[i]).find('.item_name, .item_rate, .item_qty, .base_unit');
                    }

                    // Iterate through each input field in the current row
                    for (var j = 0; j < inputs.length; j++) {
                        if (!$(inputs[j]).val() || $(inputs[j]).val() == "0") {
                            $(inputs[j]).css('border-color', 'red');
                            return false; // Stop further processing if validation fails
                        }
                    }
                }

                return true; // All rows passed validation
            }

            // Function to update calculations based on rows
            function updateCalculations() {
                var invoiceTotal = 0;
                var grandTotal = 0;
                var paidAmount = parseFloat($('#s_h_paid').val()) || 0;
                $('#billingTable tr').each(function() {
                    var row = $(this);
                    var rate = parseFloat(row.find('.item_rate').val()) || 0;
                    var quantity = parseFloat(row.find('.item_qty').val()) || 0;
                    var gst = parseFloat(row.find('.gstslab').val()) || 0;
                    var stock = parseFloat(row.find('.stock').val()) || 0;
                    var item_discount = parseFloat(row.find('.item_discount').val()) || 0;
                    var amount = (rate * ((100 - item_discount) / 100)) * quantity;
                    var final_item_rate = (rate * ((100 - item_discount) / 100));
                    var finalStock = 0;
                    if (row.find('.base_unit').val() == row.find('.item_sub_unit').val()) {
                        finalStock = (parseFloat(row.find('.item_stock_whole').val()) * parseFloat(row.find('.item_conversion_rate').val())) + parseFloat(row.find('.item_stock_retail').val()) - quantity;
                    } else {
                        finalStock = parseFloat(row.find('.item_stock_whole').val()) - quantity;
                    }
                    row.find('.amount').val(amount.toFixed(2));
                    row.find('.final_item_rate').val(final_item_rate.toFixed(2));
                    row.find('.stock').val(finalStock);
                    invoiceTotal += amount;
                    // console.log(rate);
                });

                var discount = parseFloat($('#s_h_dis').val()) || 0;
                var lAndTCharges = parseFloat($('#s_h_other').val()) || 0;
                var preAmount = parseFloat($('#c_dues').val()) || 0;

                // Update the UI with the calculated values
                $('#s_h_total').val(invoiceTotal.toFixed(2));

                grandTotal = invoiceTotal + lAndTCharges - discount + preAmount;
                $('#s_h_grand').val(grandTotal.toFixed(2));

                var remainingAmount = grandTotal - paidAmount;
                $('#s_h_due').val(remainingAmount.toFixed(2));
            }

            // Event listener for changes in paid amount
            $(document).on('input', '#s_h_paid', function() {
                updateCalculations();
            });

            // Event listener for changes in discount, L&T charges, and rows
            $(document).on('input', '#s_h_dis, #s_h_other', function() {
                updateCalculations();
            });

            // Event listener for changes in any input field within the billing table
            $(document).on('input', '#billingTable tr td input, #billingTable tr td select', function() {
                $(this).css('border-color', '#ced4da');
                updateCalculations();
            });

            let newstockwhole = 0;
            let newstockretail = 0;
            let oldunit = 0;
            let oldqty = 0;

            $(document).on('input', '.item_qty', function() {
                updateCalculations();
                saveActiveRowData();
            });

            $(document).on('focus', '.item_qty, .base_unit', function() {
                let row = $(this).closest('tr');
                $('.item_qty').removeClass('active');
                $('.item_stock_whole').removeClass('active');
                $('.item_stock_retail').removeClass('active');
                row.find('.item_qty').addClass('active');
                row.find('.item_stock_whole').addClass('active');
                row.find('.item_stock_retail').addClass('active');
                console.log($('.item_qty.active').val());
                let itemid = row.find('.item_id').val();
                let saleitemid = row.find('.p_i_id').val();

                // Create a closure to capture the current row
                (function(currentRow) {
                    $.post("{{url('old-qty-unit')}}", {
                        id: itemid,
                        p_i_id: saleitemid
                    }, function(res) {
                        let oldqty = res.s_i_qty;
                        let oldunit = res.s_i_unit;
                        let newstockwhole = res.newstockwhole;
                        let newstockretail = res.newstockretail;

                        $('#old_qty').val(oldqty);
                        $('#old_unit').val(oldunit);

                        if (oldunit == 1) {
                            currentRow.find('.item_stock_whole.active').val(parseFloat(newstockwhole) + parseFloat(oldqty));
                            currentRow.find('.item_stock_retail.active').val(parseFloat(newstockretail) + parseFloat(oldqty));
                            console.log('Whole');
                        } else if (oldunit == 2) {
                            currentRow.find('.item_stock_whole.active').val(parseFloat(newstockwhole) + parseFloat(oldqty));
                            currentRow.find('.item_stock_retail.active').val(parseFloat(newstockretail) + parseFloat(oldqty));
                            console.log('Retail');

                        }
                        updateCalculations();
                    }).fail(function(err) {
                        console.log(err);
                    });
                })(row);
            });

            // Initial calculations
            updateCalculations();

            function saveActiveRowData() {
                if (validateRowInputs()) {
                    $('#custType').attr('disabled', 'disabled');
                    $('#billType').attr('disabled', 'disabled');
                    $('#c_name').attr('disabled', 'disabled');
                    $('#c_add').attr('disabled', 'disabled');
                    $('#c_fmob').attr('disabled', 'disabled');
                    $('#c_smob').attr('disabled', 'disabled');
                    $('#c_gst').attr('disabled', 'disabled');
                    $('#c_state').attr('disabled', 'disabled');
                    $('#c_desc').attr('disabled', 'disabled');
                    let item_id = activerow.find('.item_id').val();
                    let p_i_id = activerow.find('.p_i_id').val();
                    let item_conversion_rate = activerow.find('.item_conversion_rate').val();
                    let item_purchase_rate = activerow.find('.item_purchase_rate').val();
                    let item_sale_rate_whole_base = activerow.find('.item_sale_rate_whole_base').val();
                    let item_sale_rate_whole_sub = activerow.find('.item_sale_rate_whole_sub').val();
                    let item_sale_rate_retail_base = activerow.find('.item_sale_rate_retail_base').val();
                    let item_sale_rate_retail_sub = activerow.find('.item_sale_rate_retail_sub').val();
                    let item_purchase_tax_type = activerow.find('.item_purchase_tax_type').val();
                    let item_stock_whole = activerow.find('.item_stock_whole').val();
                    let item_stock_retail = activerow.find('.item_stock_retail').val();
                    let item_base_unit = activerow.find('.item_base_unit').val();
                    let item_gst_slab = activerow.find('.item_gst_slab').val();
                    let item_amount = activerow.find('.item_amount').val();
                    let item_mrp = activerow.find('.item_mrp').val();
                    let item_sub_unit = activerow.find('.item_sub_unit').val();
                    let item_name = activerow.find('.item_name').val();
                    let item_rate = activerow.find('.item_rate').val();
                    let gstslab = activerow.find('.gstslab').val();
                    let item_qty = activerow.find('.item_qty').val();
                    let base_unit = activerow.find('.base_unit').val();
                    let stock = activerow.find('.stock').val();
                    let amount = activerow.find('.amount').val();
                    let item_discount = activerow.find('.item_discount').val();
                    let c_id = $('#c_id').val();
                    let p_h_otp = $('#p_h_otp').val();
                    let custType = $('#custType').val();
                    let billType = $('#billType').val();
                    let billDate = $('#billDate').val();
                    let c_name = $('#c_name').val();
                    let c_add = $('#c_add').val();
                    let c_fmob = $('#c_fmob').val();
                    let c_smob = $('#c_smob').val();
                    let c_gst = $('#c_gst').val();
                    let c_state = $('#c_state').val();
                    let c_desc = $('#c_desc').val();
                    let s_h_bill_desc = $('#s_h_bill_desc').val();
                    let s_h_other = $('#s_h_other').val();
                    let s_h_total = $('#s_h_total').val();
                    let s_h_dis = $('#s_h_dis').val();
                    let s_h_paid = $('#s_h_paid').val();
                    let c_dues = $('#c_dues').val();
                    let s_h_grand = $('#s_h_grand').val();
                    let s_h_due = $('#s_h_due').val();
                    $.post("{{url('save-sale-data')}}", {
                        item_id: item_id,
                        p_i_id: p_i_id,
                        item_conversion_rate: item_conversion_rate,
                        item_purchase_rate: item_purchase_rate,
                        item_sale_rate_whole_base: item_sale_rate_whole_base,
                        item_sale_rate_whole_sub: item_sale_rate_whole_sub,
                        item_sale_rate_retail_base: item_sale_rate_retail_base,
                        item_sale_rate_retail_sub: item_sale_rate_retail_sub,
                        item_purchase_tax_type: item_purchase_tax_type,
                        item_stock_whole: item_stock_whole,
                        item_stock_retail: item_stock_retail,
                        item_base_unit: item_base_unit,
                        item_gst_slab: item_gst_slab,
                        item_amount: item_amount,
                        item_mrp: item_mrp,
                        item_sub_unit: item_sub_unit,
                        item_name: item_name,
                        item_rate: item_rate,
                        gstslab: gstslab,
                        item_qty: item_qty,
                        base_unit: base_unit,
                        stock: stock,
                        amount: amount,
                        item_discount: item_discount,
                        c_id: c_id,
                        p_h_otp: p_h_otp,
                        custType: custType,
                        billType: billType,
                        billDate: billDate,
                        c_name: c_name,
                        c_add: c_add,
                        c_fmob: c_fmob,
                        c_smob: c_smob,
                        c_gst: c_gst,
                        c_state: c_state,
                        c_desc: c_desc,
                        s_h_bill_desc: s_h_bill_desc,
                        s_h_other: s_h_other,
                        s_h_total: s_h_total,
                        s_h_dis: s_h_dis,
                        s_h_paid: s_h_paid,
                        c_dues: c_dues,
                        s_h_grand: s_h_grand,
                        s_h_due: s_h_due
                    }, function(res) {
                        // console.log(res);
                        activerow.find('.p_i_id').val(res.p_i_id);
                        activerow.find('.item_stock_whole').val(res.remStock);
                        $('#c_id').val(res.c_id);
                        get_items();
                    }).fail(function(err) {
                        console.log(err);
                    });
                }
            }

            $(document).on('focus', '.item_rate, .item_qty, .base_unit, .item_discount', function() {
                activerow = $(this).closest('tr');
            });

            $(document).on('blur', '.item_rate, .item_qty, .base_unit, .item_discount', function() {
                $('.item_qty').removeClass('active');
                $('.item_stock_whole').removeClass('active');
                $('.item_stock_retail').removeClass('active');
                $('.item_discount').removeClass('active');
                if ($(this).val() != '') {
                    $(this).css('border-color', '#ced4da');
                }
                saveActiveRowData();
            });

            $(document).on('change', '.base_unit', function() {
                activerow = $(this).closest('tr');
                if ($(this).val() != '') {
                    $(this).css('border-color', '#ced4da');
                    if (activerow.find('.base_unit').val() == activerow.find('.item_sub_unit').val()) {
                        if ($('#custType').val() == 1) {
                            activerow.find('.item_rate').val(activerow.find('.item_sale_rate_whole_sub').val());
                        } else {
                            activerow.find('.item_rate').val(activerow.find('.item_sale_rate_retail_sub').val());
                        }
                    } else {
                        if ($('#custType').val() == 1) {
                            activerow.find('.item_rate').val(activerow.find('.item_sale_rate_whole_base').val());
                        } else {
                            activerow.find('.item_rate').val(activerow.find('.item_sale_rate_retail_base').val());
                        }
                    }
                }
                updateCalculations();
                saveActiveRowData();
            });

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
                let otp = $('#p_h_otp').val();
                let url = '';
                if ($('#billType').val() == 1) {
                    url = `{{url('${otp}-salesentry-gst-invoice')}}`;
                } else if ($('#billType').val() == 2) {
                    url = `{{url('${otp}-salesentry-nongst-invoice')}}`;
                }
                let acc = $('#tnx_account').val();
                $.post("sales-transaction", {
                    s_h_otp: $('#p_h_otp').val(),
                    s_h_paid: $('#s_h_paid').val(),
                    tnx_account: acc
                }, function(res) {
                    console.log(res);
                    if(res === true){
                        window.location.href = url;
                    }
                }).fail(function(err) {
                    console.log(err.responseJSON.message);
                });
            });

            $(document).on('input', '#s_h_other, #s_h_dis, #s_h_paid', function() {
                validateIntInput.call(this);
                if (!isInteger($(this).val())) {
                    return;
                }
                updateCalculations();
                saveActiveRowData();
            });

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

            function isInteger(value) {
                return /^\d+$/.test(value);
            }

            $(document).on('input', '.item_rate, .item_discount, .item_qty', function() {
                validateIntInput.call(this);
                if (!isInteger($(this).val())) {
                    return;
                }
            });
        });
    </script>