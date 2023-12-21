<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-danger btn-label rounded-pill">
                        <i class="ri-refresh-line label-icon align-middle rounded-pill me-2"></i>
                        Reset Password
                    </button>
                </div>
                <div class="card-body">
                    <form id="reset-password">
                        <div class="mb-3 card p-2 ">
                            <div class="row g-3">
                                <div class="col-lg-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="oldpfloatingInput"
                                            placeholder="Old Password" name="old_password">
                                        <label for="oldpfloatingInput">Old Password <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <p class="mt-1 ps-1"> <span id="username_result"></span></p>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control new_password " id="newpfloatingInput"
                                            placeholder="New Password" name="new_password">
                                        <label for="newpfloatingInput">New Password <span
                                                class="text-danger">*</span></label>
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control confirm_password"
                                            id="cnewpfloatingInput" placeholder="Confirm New Password"
                                            name="confirm_password">
                                        <label for="cnewpfloatingInput">Confirm New Password <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <p class="mt-1 ps-1"> <span id="res"></span></p>
                                </div>
                                <div class="col-lg-4  offset-lg-8 text-lg-end">
                                    <button  class="btn btn-success btn-label" type="submit">
                                        <i class=" ri-check-line label-icon align-middle me-2"></i>
                                        Save Password
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->