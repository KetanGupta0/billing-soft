@include('common.header');
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <form method="post" action="{{ url('save-settings') }}">
                @csrf
                <div class="row">

                    <div class="col-md-6">
                        @foreach ($settings as $settings)
                            <div class="mb-3">
                                <label for="shop_name" class="form-label">Shop Name</label>
                                <input type="text" class="form-control" id="shop_name"
                                    value="{{ $settings->a_name ?? '' }}" placeholder="BABA ENTERPRISES" name="a_name"
                                    required />
                                <span style="color: red" id="shop_name_error" class="error-message"></span>
                            </div>

                            <div class="mb-3">
                                <label for="sAddress" class="form-label">Shop Address</label>
                                <textarea class="form-control" id="address" name="a_add" rows="3"
                                    placeholder="TIWARIDIH, BADEM, AURANGABAD, BIHAR 824301">{{ $settings->a_add ?? '' }}</textarea>
                                <span style="color: red" id="address_error" class="error-message"></span>
                            </div>

                            <div class="mb-3">
                                <label for="sgst" class="form-label">G.S.T No.</label>
                                <input type="text" class="form-control" id="gst_no"
                                    value="{{ $settings->a_gst ?? '' }}" placeholder="JCTPK5432CXXXXX" name="a_gst" />
                                <span style="color: red" id="gst_no_error" class="error-message"></span>
                            </div>

                            <div class="mb-3">
                                <label for="spno" class="form-label">Primary Mob. no.</label>
                                <input type="text" class="form-control" id="pri_number"
                                    value="{{ $settings->a_fmob ?? '' }}" placeholder="7368857460" name="a_fmob"
                                    required />
                                <span style="color: red" id="pri_number_error" class="error-message"></span>
                            </div>

                            <div class="mb-3">
                                <label for="sano" class="form-label">Alternate Mob. No.</label>
                                <input type="text" class="form-control" id="alter_number"
                                    value="{{ $settings->a_smob ?? '' }}" placeholder="9430507653" name="a_smob" />
                                <span style="color: red" id="alter_number_error" class="error-message"></span>
                            </div>

                            <div class="mb-3">
                                <label for="semail" class="form-label">Email ID</label>
                                <input type="email" class="form-control" id="email"
                                    value="{{ $settings->a_email ?? '' }}" name="a_email"
                                    placeholder="webformerinfotech@gmail.com" />
                                <span style="color: red" id="email_error" class="error-message"></span>
                            </div>

                            <div class="mb-3">
                                <label for="expiry" class="form-label">Expiry Alert Time (in Days)</label>
                                <input type="text" class="form-control" id="expiry_alert"
                                    value="{{ $settings->a_alert ?? '' }}" placeholder="20" name="a_alert" />
                                <span style="color: red" id="expiry_alert_error" class="error-message"></span>
                            </div>


                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Save settings <i
                                        class="ri-add-circle-line align-middle ms-1"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        @php $count = $units->count(); @endphp
                        <input type="hidden" id="count" value="{{ $count }}">


                        <table id="invoice-item-table" class="table table-bordered dt-responsive nowrap align-middle"
                            style="width:100%">
                            <thead class="bg-light">
                                <tr>
                                    <th>S.N</th>
                                    <th data-ordering="false">Units</th>
                                    <th data-ordering="false">Action</th>
                                </tr>
                            </thead>
                            <tbody id="data">
                                @if ($count > 0)
                                    @php $i = 0;  @endphp
                                    @foreach ($units as $unit)
                                    @php $i++ @endphp
                                        <tr id="row_id_{{ $i }}">
                                            <td>{{ $i }}</td>

                                            <td>
                                                <input type="text" name="units[]" class="form-control"
                                                    value="{{ $unit->u_name ?? '' }}" />
                                            </td>
                                            <td class="d-flex gap-1">
                                                <div class="remove">
                                                    <button type="button"
                                                        class="btn btn-danger btn-label rounded-pill remove_row"
                                                        id="{{ $i }}"><i
                                                            class="label-icon align-middle rounded-pill me-2">-</i>
                                                        Remove</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                        <div class="add">
                            <button type="button" class="btn btn-success btn-label rounded-pill" id="add_row"><i
                                    class="ri-add-circle-line label-icon align-middle rounded-pill me-2"></i>
                                Add</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('common.footer');

    <script>
        $(document).ready(function() {
            var count = parseFloat($('#count').val()) + parseFloat(1);
            $(document).on('click', '#add_row', function() {
                count++;
                var html = `<tr id="row_id_${count}">
                                    <td>${count}</td>

                                    <td>
                                        <input type="text" name="units[]" class="form-control" />
                                    </td>
                                    <td class="d-flex gap-1">
                                        <div class="remove">
                                            <button type="button"
                                                class="btn btn-danger btn-label rounded-pill remove_row"
                                                id="${count}"><i
                                                    class="label-icon align-middle rounded-pill me-2">-</i>
                                                Remove</button>
                                        </div>
                                    </td>
                                </tr>`;
                $('#data').append(html);
                arrange();
            });

            $(document).on('click', '.remove_row', function() {
                var id = $(this).attr('id');
                $('#row_id_' + id).remove();
                arrange();
            });

            function arrange() {
                let i = 1;
                $("#data tr").each(function() {
                    $(this).find("td:first").text(i);
                    i++;
                });
            }

        });
    </script>
