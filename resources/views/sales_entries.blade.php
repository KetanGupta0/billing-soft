@include('common.header');
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="{{url('print-report-sales')}}" method="post" id="filter-form">
                            @csrf
                            <div class="row border-bottom p-3 d-flex align-items-center">
                                <div class="col-lg-7">
                                    <h2 class="m-0">Sales Report</h2>
                                </div>
                                <div class="col-lg-5">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="hidden" name="type" value="1">
                                                <input type="date" class="form-control" id="from_date" placeholder="From Date" name="from_date" onfocus="this.showPicker()">
                                                <label for="from_date">From Date</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="to_date" placeholder="To Date" name="to_date" onfocus="this.showPicker()">
                                                <label for="to_date">To Date</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div>
                                                <div class="btn btn-secondary btn-label rounded-pill" id="clear_filter">
                                                    <i class="ri-format-clear label-icon align-middle rounded-pill me-2"></i>Clear
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div>
                                                <button type="submit" class="btn btn-success btn-label rounded-pill" id="statement_print">
                                                    <i class="ri-printer-fill label-icon align-middle rounded-pill me-2"></i>Print
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-body">
                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th data-ordering="false">Date</th>
                                        <th data-ordering="false">Bill No.</th>
                                        <th data-ordering="false">Party Name</th>
                                        <th data-ordering="false">Total Amt.</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="salesEntryList">
                                    <tr>
                                        <td>01</td>
                                        <td>06-03-2023</td>
                                        <td>2142</td>
                                        <td>Avinash Kumar</td>
                                        <td>555</td>
                                        <td>
                                            <div class="edit">
                                                <a href="{{url('/edit-sale')}}" class="btn btn-success btn-label rounded-pill"><i class="ri-pencil-line label-icon align-middle rounded-pill me-2"></i>
                                                    Edit</a>
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
                    <!-- end col -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form class="tablelist-form" autocomplete="off">
                            <div class="modal-body">
                                <div class="mb-3" id="modal-id" style="display: none;">
                                    <label for="id-field" class="form-label">ID</label>
                                    <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                                </div>

                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Customer Name</label>
                                    <input type="text" id="customername-field" class="form-control" placeholder="Enter Name" required />
                                    <div class="invalid-feedback">Please enter a customer name.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="email-field" class="form-label">Email</label>
                                    <input type="email" id="email-field" class="form-control" placeholder="Enter Email" required />
                                    <div class="invalid-feedback">Please enter an email.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="phone-field" class="form-label">Phone</label>
                                    <input type="text" id="phone-field" class="form-control" placeholder="Enter Phone no." required />
                                    <div class="invalid-feedback">Please enter a phone.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="date-field" class="form-label">Joining Date</label>
                                    <input type="text" id="date-field" class="form-control" placeholder="Select Date" required />
                                    <div class="invalid-feedback">Please select a date.</div>
                                </div>

                                <div>
                                    <label for="status-field" class="form-label">Status</label>
                                    <select class="form-control" data-trigger name="status-field" id="status-field" required>
                                        <option value="">Status</option>
                                        <option value="Active">Active</option>
                                        <option value="Block">Block</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add-btn">Add Customer</button>
                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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
            // console.clear();
            populateSalesEntryList();

            function populateSalesEntryList() {
                $.post("{{url('fetch-sales-entries')}}", {}, function(res) {
                    $('#example').DataTable().destroy();
                    $('#salesEntryList').html(``);
                    $.each(res, function(key, value) {
                        $('#salesEntryList').append(`
                            <tr>
                                <td>${key+1}</td>
                                <td>${value.s_h_bill_date}</td>
                                <td>${value.s_h_bill_no}</td>
                                <td>${value.c_name}</td>
                                <td>${value.s_h_total}</td>
                                <td>
                                    <div class="edit">
                                        <a href="{{url('/edit-sale-${value.s_h_id}')}}" class="btn btn-success btn-label rounded-pill"><i class="ri-pencil-line label-icon align-middle rounded-pill me-2"></i>
                                            Edit</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="remove">
                                        <button type="button" class="btn btn-danger btn-label rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteRecordModal"><i class="ri-delete-bin-line label-icon align-middle rounded-pill me-2"></i>
                                            Remove</button>
                                    </div>
                                </td>
                            </tr>
                        `);
                    });
                    $('#example').DataTable();
                }).fail(function(err) {
                    console.log(err);
                });
            }

            $(document).on('click', '#clear_filter', function() {
                $('#filter-form')[0].reset();
                let from_date = $('#from_date').val();
                let to_date = $('#to_date').val();
                $.post('print-report-sales', {
                    type: 2,
                    from_date: from_date,
                    to_date: to_date
                }, function(res) {
                    loadUpdatedList(res);
                }).fail(function(err) {
                    console.log(err.responseJSON.message);
                });
            });

            function loadUpdatedList(data) {
                console.log(data);
                $('#example').DataTable().destroy();
                $('#salesEntryList').html(``);
                $.each(data, function(key, value) {
                    $('#salesEntryList').append(`
                            <tr>
                                <td>${key+1}</td>
                                <td>${value.s_h_bill_date}</td>
                                <td>${value.s_h_bill_no}</td>
                                <td>${value.c_name}</td>
                                <td>${value.s_h_total}</td>
                                <td>
                                    <div class="edit">
                                        <a href="{{url('/edit-sale-${value.s_h_id}')}}" class="btn btn-success btn-label rounded-pill"><i class="ri-pencil-line label-icon align-middle rounded-pill me-2"></i>
                                            Edit</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="remove">
                                        <button type="button" class="btn btn-danger btn-label rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteRecordModal"><i class="ri-delete-bin-line label-icon align-middle rounded-pill me-2"></i>
                                            Remove</button>
                                    </div>
                                </td>
                            </tr>
                        `);
                });
                $('#example').DataTable();
            }

            $(document).on('input', '#from_date, #to_date', function() {
                let from_date = $('#from_date').val();
                let to_date = $('#to_date').val();
                $.post('print-report-sales', {
                    type: 2,
                    from_date: from_date,
                    to_date: to_date
                }, function(res) {
                    loadUpdatedList(res);
                }).fail(function(err) {
                    console.log(err.responseJSON.message);
                });
            });

            function isValidDate(dateString) {
                const datePart = dateString.split('GMT')[0].trim();
                return !isNaN(new Date(datePart));
            }
        });
    </script>