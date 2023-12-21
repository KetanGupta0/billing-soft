@section('title','Add New Shop');
@include('common.header');
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h3>Add New Shop</h3>
                    <form>
                        <div class="mb-3">
                            <label for="sName" class="form-label">Shop Name</label>
                            <input type="text" class="form-control" id="nsName"  />
                        </div>
                        <div class="mb-3">
                            <label for="sAddress" class="form-label">Shop Address</label>
                            <textarea class="form-control" id="nsAddress"
                                rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="sgst" class="form-label">G.S.T No.</label>
                            <input type="text" class="form-control" id="nsgst"  />
                        </div>
                        <div class="mb-3">
                            <label for="spno" class="form-label">Primary Mob. no.</label>
                            <input type="text" class="form-control" id="nspno"  />
                        </div>
                        <div class="mb-3">
                            <label for="sano" class="form-label">Alternate Mob. No.</label>
                            <input type="text" class="form-control" id="nsano" />
                        </div>
                        <div class="mb-3">
                            <label for="semail" class="form-label">Email ID</label>
                            <input type="email" class="form-control" id="nsemail"  />
                        </div>
                        <div class="mb-3">
                            <label for="expiry" class="form-label">Expiry Alert Time (in Days)</label>
                            <input type="text" class="form-control" id="nexpiry"  />
                        </div>
                        <div class="mb-3">
                            <label for="slogo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="nslogo" />
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save settings <i
                                    class="ri-add-circle-line align-middle ms-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <table id="invoice-item-table" class="table table-bordered dt-responsive nowrap align-middle" style="width:100%">
                        <thead class="bg-light">
                            <tr>
                                <th>S.N</th>
                                <th data-ordering="false">Units</th>
                                <th data-ordering="false">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id ="row_id_1">
                                <td>1</td>
                                <td>
                                    <input type="text" onKeyUp="multiply()" name="u_name[]" id="u_name1" class="form-control" value="Tin" />
                                    <input type="hidden" name="mydemotools[]" value="1111111111111111111111111111111111111"/></td>
                                </td>
                                <td class="d-flex gap-1">
                                    <div class="add">
                                        <button type="button" class="btn btn-success btn-label rounded-pill"
                                        name="add_row" id="add_row"><i
                                                class="ri-add-circle-line label-icon align-middle rounded-pill me-2"></i>
                                            Add</button>
                                    </div>
                                    <div class="remove">
                                        <button type="button" class="btn btn-danger btn-label rounded-pill remove_row"
                                        name="remove_row" id="1"><i
                                                class="label-icon align-middle rounded-pill me-2">-</i>
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

    <script>
    $(document).ready(function(){
        var count = 1;
        
        $(document).on('click', '#add_row', function(){
          count++;
          $('#total_item').val(count);
          
         var html_code = '';
          html_code += '<tr id="row_id_'+count+'">';
          html_code += '<td nowrap><span id="sr_no">'+count+'</span></td>';
          html_code += '<td><input type="text"  onKeyUp="multiply()" name="u_name[]" id="u_name'+count+'" class="cal form-control" /></td>';
          html_code += '<input type="hidden" name="mydemotools[]" id="mydemotools'+count+'" data-srno="'+count+'"  value="1111111111111111111111111111111111111"/><td nowrap><button type="button" name="add_row" id="add_row" class="btn btn-success btn-label rounded-pill"><i class="ri-add-circle-line label-icon align-middle rounded-pill me-2" aria-hidden="true"></i>Add</button> <button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-label rounded-pill remove_row"><i class="label-icon align-middle rounded-pill me-2" aria-hidden="true">-</i>Remove</button></td>';
          html_code += '</tr>';
          $('#invoice-item-table').append(html_code);
        });
        
        
         $(document).on('click', '.remove_row', function(){
          var row_id = $(this).attr("id");
          $('#row_id_'+row_id).remove();
          count--;
          $('#total_item').val(count);
        });
      });
    </script>

    @include('common.footer');