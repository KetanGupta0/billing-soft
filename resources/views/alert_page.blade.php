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
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <table class="table table-bordered dt-responsive nowrap align-middle w-100" id="example">
                            <!-- table data here -->
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Item Name</th>
                                    <th>Rate</th>
                                    <th>Stock</th>
                                    <th>Mfd.</th>
                                    <th>Exp.</th>
                                    <th>Status</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="stockList"></tbody>
                        </table>
                    </div>
                </div><!-- End card-body -->
            </div><!-- End card -->
        </div><!-- End container-fluid -->
    </div><!-- End Page-content -->
</div><!-- End main-content -->
@include('common.footer');
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function loadList() {
            $.get("{{url('fetch-alert-items')}}", function(res) {
                $('#stockList').html(``);
                if (res.length > 0) {
                    $.each(res, function(key, val) {
                        var startDate = new Date();
                        var endDate = new Date(val.item_exp_date);
                        var timeDifference = endDate.getTime() - startDate.getTime();
                        var remainingDays = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));
                        let status = `<div class="text-success">In ${remainingDays} Days</div>`;
                        if (remainingDays <= 0) {
                            status = `<div class="text-danger">Expired</div>`;
                        }

                        // Format dates as DD-MM-YYYY
                        var formattedStartDate = startDate.toLocaleDateString('en-GB').replace(/\//g, '-');
                        var formattedEndDate = endDate.toLocaleDateString('en-GB').replace(/\//g, '-');

                        $('#stockList').append(`
                        <tr>
                            <td>${key+1}</td>
                            <td>${val.item_name}</td>
                            <td>${val.item_purchase_rate}/${val.item_base_unit}</td>
                            <td>${val.item_stock_whole} ${val.item_base_unit}, ${val.item_stock_retail} ${val.item_sub_unit}</td>
                            <td>${formattedStartDate}</td>
                            <td>${formattedEndDate}</td>
                            <td>${status}</td>
                            <td>
                                <button type="button" data="${val.item_id}" class="removeBtn btn btn-danger btn-label rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteRecordModal"><i class="ri-delete-bin-line label-icon align-middle rounded-pill me-2"></i>Remove</button>
                            </td>
                        </tr>
                        `);
                    });
                }
            }).fail(function(err) {
                console.error("Error fetching data:", err);
                Swal.fire({
                    title: 'Error!',
                    icon: 'error',
                    text: err.responseJSON.message,
                });
            });
        }
        loadList();

        $(document).on('click','.removeBtn',function(){
            let id = $(this).attr('data');
            $('#delete-record').attr('data',id);
        });

        $(document).on('click','#delete-record',function(){
            let id = $(this).attr('data');
            $('#deleteRecordModal').modal('hide');
            alert(id);
        });
    });
</script>