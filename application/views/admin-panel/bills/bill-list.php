<?php $this->load->view('admin-panel/partials/header')    ?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <div class="theme-setting-wrapper">
            <div id="settings-trigger"><i class="ti-settings"></i></div>
            <div id="theme-settings" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <p class="settings-heading">SIDEBAR SKINS</p>
                <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                    <div class="img-ss rounded-circle bg-light border me-3"></div>Light
                </div>
                <div class="sidebar-bg-options" id="sidebar-dark-theme">
                    <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
                </div>
                <p class="settings-heading mt-2">HEADER SKINS</p>
                <div class="color-tiles mx-0 px-4">
                    <div class="tiles success"></div>
                    <div class="tiles warning"></div>
                    <div class="tiles danger"></div>
                    <div class="tiles info"></div>
                    <div class="tiles dark"></div>
                    <div class="tiles default"></div>
                </div>
            </div>
        </div>
        <?php $this->load->view('admin-panel/partials/sidebar')    ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <?php if ($this->session->flashdata('success') != "") { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success! </strong><?= $this->session->flashdata('success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('error') != "") { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Success!</strong>
                                <?= $this->session->flashdata('error')  ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-lg-9"></div>
                                <div class="col-lg-3">
                                    <button type="button" class="btn btn-inverse-primary btn-fw mt-3 add-bill-btn">
                                        Add Bill
                                    </button>
                                </div>
                            </div>
                            <div class="modal fade" id="add-bill-modal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Bill</h5>
                                            <button type="button" class="close close-modal-x-button"
                                                data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="patient_name">Patient Name</label>
                                                <input type="text" class="form-control" name="patient_name"
                                                    id="patient_name" value="<?= set_value('patient_name') ?>"
                                                    placeholder="Patient Name">
                                                <?= form_error('patient_name') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="net_total">Net Total</label>
                                                <input type="number" class="form-control" name="net_total"
                                                    id="net_total" value="<?= set_value('net_total') ?>"
                                                    placeholder="Net total">
                                                <?= form_error('net_total') ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-add-bill-btn"
                                                data-dismiss="modal" area-label="Close">Close</button>
                                            <button type="button"
                                                class="btn btn-primary save-add-bill-btn">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="edit-bill-modal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Bill</h5>
                                            <button type="button" class="close close-modal-x-edit-button"
                                                data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" class="bill-id">
                                            <div class="form-group">
                                                <label for="patient_name">Patient Name</label>
                                                <input type="text" class="form-control" name="patient_name"
                                                    id="edit_patient_name" value="<?= set_value('patient_name') ?>"
                                                    placeholder="Patient Name">
                                                <?= form_error('patient_name') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="net_total">Net Total</label>
                                                <input type="number" class="form-control" name="net_total"
                                                    id="edit_net_total" value="<?= set_value('net_total') ?>"
                                                    placeholder="Net total">
                                                <?= form_error('net_total') ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-edit-bill-btn"
                                                data-dismiss="modal" area-label="Close">Close</button>
                                            <button type="button"
                                                class="btn btn-primary update-edit-bill-btn">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-title text-center mb-3">Bill Records</h2>
                            <div class="card-body">
                                <form method="get" action="<?= base_url('bill-list-show') ?>">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" name="search_text" id="search_text"
                                                placeholder="Search here" class="form-control"
                                                aria-describedby="passwordHelpInline">
                                        </div>
                                        <div class="col-auto">
                                            <input type="submit" class="btn btn-inverse-success btn-fw"
                                                id="bills-list-search-btn" value="Search" style="padding: 9px;">
                                        </div>
                                        <div class="col-auto">
                                            <a href="<?= base_url('bill-list-page') ?>"
                                                class="btn btn-inverse-info btn-fw" style="padding: 9px;">Reset</a>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive mt-4">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Patient Name</th>
                                                <th>Net Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="listRecords">

                                        </tbody>
                                    </table>
                                </div>

                                <div class="bill-paginationn">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('admin-panel/partials/footer'); ?>