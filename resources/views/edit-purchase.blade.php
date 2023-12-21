@section('title', 'Edit Purchase');
@include('common.header');
<style>
    .nav-pills .nav-link {
        border: 1px solid var(--vz-vertical-menu-item-active-color)
    }

    .listtable,
    .listtablebarcode {
        display: none
    }

    .listtable {
        top: 158px;
    }

    .listtablebarcode {
        top: 202px;
    }
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-primary mb-3" role="tablist">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active me-2" data-bs-toggle="tab" href="#billing-details" role="tab">Billing
                                Details</a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-bs-toggle="tab" href="#item-details" role="tab">Item
                                Details</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="billing-details" role="tabpanel">
                            <div class="mb-3 card p-2 ">
                                <p>Party Details</p>
                                <form action="#">
                                    <div class="row g-3">
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="namefloatingInput" placeholder="Name">
                                                <label for="namefloatingInput">Name <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="mobfloatingInput" placeholder="Mob. No.">
                                                <label for="mobfloatingInput">Mob. No. <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="altmobfloatingInput" placeholder="Alt. Mob. No.">
                                                <label for="altmobfloatingInput">Alt. Mob. No. <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="gstfloatingInput" placeholder="G.S.T No.">
                                                <label for="gstfloatingInput">G.S.T No. <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" placeholder="Select State">
                                                    <option value="Bihar">Bihar</option>
                                                    <option value="Utter Pradesh">Utter Pradesh</option>
                                                    <option value="Assam">Assam</option>
                                                    <option value="Punjab">Punjab</option>
                                                </select>
                                                <label for="floatingSelect">Select State</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="addressfloatingInput" placeholder="Address">
                                                <label for="addressfloatingInput">Address <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="partyfloatingInput" placeholder="Party Description">
                                                <label for="partyfloatingInput">Party Description <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="mb-3 card p-2 ">
                                <p>Billing Details</p>
                                <form action="#">
                                    <div class="row g-3">
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="billnofloatingInput" placeholder="Bill No.">
                                                <label for="billnofloatingInput">Bill No. <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="billdatefloatingInput" placeholder="Bill Date">
                                                <label for="billdatefloatingInput">Bill Date <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="vehfloatingInput" placeholder="Vehicle No.">
                                                <label for="vehfloatingInput">Vehicle No. <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="delfloatingInput" placeholder="Delivery Date">
                                                <label for="delfloatingInput">Delivery Date <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="otherchargefloatingInput" placeholder="Other Charge">
                                                <label for="otherchargefloatingInput">Other Charge <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="preduesfloatingInput" placeholder="Pre Dues" disabled />
                                                <label for="preduesfloatingInput">Pre Dues</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="invfloatingInput" placeholder="Inv. Total" disabled />
                                                <label for="invfloatingInput">Inv. Total <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="discountfloatingInput" placeholder="Discount" />
                                                <label for="discountfloatingInput">Discount <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="gtfloatingInput" placeholder="Grand Total" disabled />
                                                <label for="gtfloatingInput">Grand Total <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="pamtfloatingInput" placeholder="Paid Amt." />
                                                <label for="pamtfloatingInput">Paid Amt. <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="damtfloatingInput" placeholder="Dues Amt." disabled />
                                                <label for="damtfloatingInput">Dues Amt. <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="billdescfloatingInput" placeholder="Bill Desc." />
                                                <label for="billdescfloatingInput">Bill Desc. <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="item-details" role="tabpanel">
                            <div class="text-end">
                                <div class="row g-3 d-flex justify-content-md-end">
                                    <div class="col-lg-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="barcodefloating" placeholder="Bar Code">
                                            <label for="barcodefloating">Bar Code <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="#">
                                <div class="mb-3 card p-2 ">
                                    <p>Item Details</p>
                                    <div class="row g-3">
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="barcodefloatingInput" placeholder="Bar Code">
                                                <label for="barcodefloatingInput">Bar Code <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="hsnfloatingInput" placeholder="HSN/SAC ">
                                                <label for="hsnfloatingInput">HSN/SAC <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="itemnamefloatingInput" placeholder="Item Name">
                                                <label for="itemnamefloatingInput">Item Name <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="itemnamelfloatingInput" placeholder="Item Name (Local Language)">
                                                <label for="itemnamelfloatingInput">Item Name (Local Language) <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="itemdescfloatingInput" placeholder="Item Description">
                                                <label for="itemdescfloatingInput">Item Description <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 card p-2 ">
                                    <p>Pricing & Stock</p>
                                    <div class="row g-3">
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="purqufloatingInput" placeholder="Purchased Qty.">
                                                <label for="purqufloatingInput">Purchased Qty. <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <select class="form-select" id="baseunfloatingSelect" placeholder="Base unit">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                                <label for="baseunfloatingSelect">Base unit</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="conratfloatingInput" placeholder="Conversion Rate">
                                                <label for="conratfloatingInput">Conversion Rate <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <select class="form-select" id="SubunitfloatingSelect" placeholder="Sub-unit">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                                <label for="SubunitfloatingSelect">Sub-unit</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="purratfloatingInput" placeholder="Purchase Rate">
                                                <label for="purratfloatingInput">Purchase Rate <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <select class="form-select" id="taxtyppfloatingSelect" placeholder="Tax Type (Purchase)">
                                                    <option value="With G.S.T">With G.S.T</option>
                                                    <option value="Without G.S.T">Without G.S.T</option>
                                                </select>
                                                <label for="taxtyppfloatingSelect">Tax Type (Purchase) </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="srwfloatingInput" placeholder="Sales Rate (Whole.)">
                                                <label for="srwfloatingInput">Sales Rate (Whole.) <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="srrfloatingInput" placeholder="Sales Rate (Retail.)">
                                                <label for="srrfloatingInput">Sales Rate (Retail.) <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <select class="form-select" id="taxtypsfloatingSelect" placeholder="Tax Type (Sale)">
                                                    <option value="With G.S.T">With G.S.T</option>
                                                    <option value="Without G.S.T">Without G.S.T</option>
                                                </select>
                                                <label for="taxtypsfloatingSelect">Tax Type (Sale) </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <select class="form-select" id="gstslabfloatingSelect" placeholder="G.S.T Slab">
                                                    <option value="With G.S.T">With G.S.T</option>
                                                    <option value="Without G.S.T">Without G.S.T</option>
                                                </select>
                                                <label for="gstslabfloatingSelect">G.S.T Slab </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="ittotalfloatingInput" placeholder="Item Total" disabled />
                                                <label for="ittotalfloatingInput">Item Total <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="msqfloatingInput" placeholder="Min. Stock Qty." />
                                                <label for="msqfloatingInput">Min. Stock Qty. <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 card p-2 ">
                                    <p>Other Details</p>
                                    <div class="row g-3">
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="mfgdatfloatingInput" placeholder="Mfg. Date" />
                                                <label for="mfgdatfloatingInput">Mfg. Date <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="expdfloatingInput" placeholder="Exp. Date" />
                                                <label for="expdfloatingInput">Exp. Date <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="exptimfloatingInput" placeholder="Exp. Alert Time" />
                                                <label for="exptimfloatingInput">Exp. Alert Time <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="ilocfloatingInput" placeholder="Item Location" />
                                                <label for="ilocfloatingInput">Item Location <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <button type="button" class="btn btn-primary rounded-pill">Save &
                                                New</button>
                                            <button type="button" class="btn btn-danger rounded-pill">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="px-4 listtable w-100 position-absolute">
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
                                <tbody>
                                    <tr>
                                        <td>Raju Kumar</td>
                                        <td>DaudNagar</td>
                                        <td>9478478748</td>
                                        <td><span class="text-danger">784.55</span></td>
                                    </tr>
                                    <tr>
                                        <td>Raju Kumar</td>
                                        <td>DaudNagar</td>
                                        <td>9478478748</td>
                                        <td><span class="text-danger">784.55</span></td>
                                    </tr>
                                    <tr>
                                        <td>Raju Kumar</td>
                                        <td>DaudNagar</td>
                                        <td>9478478748</td>
                                        <td><span class="text-danger">784.55</span></td>
                                    </tr>
                                    <tr>
                                        <td>Raju Kumar</td>
                                        <td>DaudNagar</td>
                                        <td>9478478748</td>
                                        <td><span class="text-danger">784.55</span></td>
                                    </tr>
                                    <tr>
                                        <td>Raju Kumar</td>
                                        <td>DaudNagar</td>
                                        <td>9478478748</td>
                                        <td><span class="text-danger">784.55</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="px-4 listtablebarcode w-100 position-absolute">
                    <div class="card border shadow">
                        <div>
                            <table class="table table-nowrap table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Bar Code</th>
                                        <th scope="col">HSN/SAC</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Item Name(Reg.Lang)</th>
                                        <th scope="col">Item Location</th>
                                        <th scope="col">Item Desc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>125</td>
                                        <td>120</td>
                                        <td>Surf</td>
                                        <td>Saraf</td>
                                        <td>Patna</td>
                                        <td>Kabhi bhi</td>
                                    </tr>
                                    <tr>
                                        <td>125</td>
                                        <td>120</td>
                                        <td>Surf</td>
                                        <td>Saraf</td>
                                        <td>Patna</td>
                                        <td>Kabhi bhi</td>
                                    </tr>
                                    <tr>
                                        <td>125</td>
                                        <td>120</td>
                                        <td>Surf</td>
                                        <td>Saraf</td>
                                        <td>Patna</td>
                                        <td>Kabhi bhi</td>
                                    </tr>
                                    <tr>
                                        <td>125</td>
                                        <td>120</td>
                                        <td>Surf</td>
                                        <td>Saraf</td>
                                        <td>Patna</td>
                                        <td>Kabhi bhi</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border shadow">
                <div class="card-body">
                    <div class="card">
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">S.N</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Qty.</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Apple</td>
                                    <td>100 Peti</td>
                                    <td>100.00</td>
                                    <td>0.00</td>
                                    <td>
                                        <div class="edit">
                                            <button type="button" class="btn btn-success btn-label rounded-pill"><i class="ri-pencil-line label-icon align-middle rounded-pill me-2"></i>
                                                Edit</button>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="remove">
                                            <button type="button" class="btn btn-danger btn-label rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteRecordModal"><i class="ri-delete-bin-line label-icon align-middle rounded-pill me-2"></i>
                                                Remove</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Soap</td>
                                    <td>20 Box</td>
                                    <td>100.00</td>
                                    <td>0.00</td>
                                    <td>
                                        <div class="edit">
                                            <button type="button" class="btn btn-success btn-label rounded-pill"><i class="ri-pencil-line label-icon align-middle rounded-pill me-2"></i>
                                                Edit</button>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="remove">
                                            <button type="button" class="btn btn-danger btn-label rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteRecordModal"><i class="ri-delete-bin-line label-icon align-middle rounded-pill me-2"></i>
                                                Remove</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <!-- Modal -->
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
        <!--end modal -->

        <script>
            $('#namefloatingInput').focus(function() {
                $('.listtable ').show();
            })
            $('#namefloatingInput').focusout(function() {
                $('.listtable ').hide();
            })

            $('#barcodefloatingInput').focus(function() {
                $('.listtablebarcode ').show();
            })
            $('#barcodefloatingInput').focusout(function() {
                $('.listtablebarcode ').hide();
            })
        </script>
        @include('common.footer');