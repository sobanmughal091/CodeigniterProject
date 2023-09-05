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
            <input type="hidden" class="page_name" value="<?= $page_name ?>">
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
                                    <button type="button"
                                        class="btn btn-inverse-primary btn-fw mt-3 add-consultancy-btn">
                                        Add Consultancy
                                    </button>
                                </div>
                            </div>
                            <div class="modal fade" id="add-consultancy-modal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Consultancy</h5>
                                            <button type="button" class="close close-modal-x-button"
                                                data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="patient_firstname">Patient Firstname</label>
                                                <input type="text" class="form-control" name="patient_firstname"
                                                    id="patient_firstname" value="<?= set_value('patient_firstname') ?>"
                                                    placeholder="Patient Firstname">
                                                <?= form_error('patient_firstname') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="patient_lastname">Patient Lastname</label>
                                                <input type="text" class="form-control" name="patient_lastname"
                                                    id="patient_lastname" value="<?= set_value('patient_lastname') ?>"
                                                    placeholder="Patient Lastname">
                                                <?= form_error('patient_lastname') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="patient_mobile">Patient Mobile</label>
                                                <input type="number" class="form-control" name="patient_mobile"
                                                    id="patient_mobile" value="<?= set_value('patient_mobile') ?>"
                                                    placeholder="Patient Mobile">
                                                <?= form_error('patient_mobile') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="consultant_name">Consultant Name</label>
                                                <input type="text" class="form-control" name="consultant_name"
                                                    id="consultant_name" value="<?= set_value('consultant_name') ?>"
                                                    placeholder="Consultant Name">
                                                <?= form_error('consultant_name') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="consultant_mobile">Consultant Mobile</label>
                                                <input type="number" class="form-control" name="consultant_mobile"
                                                    id="consultant_mobile" value="<?= set_value('consultant_mobile') ?>"
                                                    placeholder="Consultant Mobile">
                                                <?= form_error('consultant_mobile') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="con_time_start">Start Time</label>
                                                <input type="datetime-local" class="form-control" name="con_time_start"
                                                    id="con_time_start" value="<?= set_value('con_time_start') ?>"
                                                    placeholder="Start Time">
                                                <?= form_error('con_time_start') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="con_time_end">End Time</label>
                                                <input type="datetime-local" class="form-control" name="con_time_end"
                                                    id="con_time_end" value="<?= set_value('con_time_end') ?>"
                                                    placeholder="End Time">
                                                <?= form_error('con_time_end') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="consultancy_fee">Consultation Fee</label>
                                                <input type="number" class="form-control" name="consultancy_fee"
                                                    id="consultancy_fee" value="<?= set_value('consultancy_fee') ?>"
                                                    placeholder="Consultation Fee">
                                                <?= form_error('consultancy_fee') ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-add-consultancy-btn"
                                                data-dismiss="modal" area-label="Close">Close</button>
                                            <button type="button"
                                                class="btn btn-primary save-add-consultancy-btn">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="edit-consultancy-modal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Consultancy</h5>
                                            <button type="button" class="close close-modal-x-edit-button"
                                                data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="patient_firstname">Patient Firstname</label>
                                                <input type="text" class="form-control" name="patient_firstname"
                                                    id="edit_patient_firstname"
                                                    value="<?= set_value('patient_firstname') ?>"
                                                    placeholder="Patient Firstname">
                                                <?= form_error('patient_firstname') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="patient_lastname">Patient Lastname</label>
                                                <input type="text" class="form-control" name="patient_lastname"
                                                    id="edit_patient_lastname"
                                                    value="<?= set_value('patient_lastname') ?>"
                                                    placeholder="Patient Lastname">
                                                <?= form_error('patient_lastname') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="patient_mobile">Patient Mobile</label>
                                                <input type="number" class="form-control" name="patient_mobile"
                                                    id="edit_patient_mobile" value="<?= set_value('patient_mobile') ?>"
                                                    placeholder="Patient Mobile">
                                                <?= form_error('patient_mobile') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="consultant_name">Consultant Name</label>
                                                <input type="text" class="form-control" name="consultant_name"
                                                    id="edit_consultant_name"
                                                    value="<?= set_value('consultant_name') ?>"
                                                    placeholder="Consultant Name">
                                                <?= form_error('consultant_name') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="consultant_mobile">Consultant Mobile</label>
                                                <input type="number" class="form-control" name="consultant_mobile"
                                                    id="edit_consultant_mobile"
                                                    value="<?= set_value('consultant_mobile') ?>"
                                                    placeholder="Consultant Mobile">
                                                <?= form_error('consultant_mobile') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="con_time_start">Start Time</label>
                                                <input type="datetime-local" class="form-control" name="con_time_start"
                                                    id="edit_con_time_start" value="<?= set_value('con_time_start') ?>"
                                                    placeholder="Start Time">
                                                <?= form_error('con_time_start') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="con_time_end">End Time</label>
                                                <input type="datetime-local" class="form-control" name="con_time_end"
                                                    id="edit_con_time_end" value="<?= set_value('con_time_end') ?>"
                                                    placeholder="End Time">
                                                <?= form_error('con_time_end') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="consultancy_fee">Consultation Fee</label>
                                                <input type="number" class="form-control" name="consultancy_fee"
                                                    id="edit_consultancy_fee"
                                                    value="<?= set_value('consultancy_fee') ?>"
                                                    placeholder="Consultation Fee">
                                                <?= form_error('consultancy_fee') ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-edit-consultancy-btn"
                                                data-dismiss="modal" area-label="Close">Close</button>
                                            <button type="button"
                                                class="btn btn-primary update-edit-consultancy-btn">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-title text-center mb-3">Consultancy Records</h2>
                            <div class="card-body">
                                <form method="get" action="<?= base_url('consultancy-list-show') ?>">
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
                                            <a href="<?= base_url('consultancy-list-page') ?>"
                                                class="btn btn-inverse-info btn-fw" style="padding: 9px;">Reset</a>
                                        </div>
                                    </div>
                                </form>

                                <div class="table-responsive mt-4">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Patient Firstname</th>
                                                <th>Patient Lastname</th>
                                                <th>Patient Mobile</th>
                                                <th>Consultant Name</th>
                                                <th>Consultant Mobile</th>
                                                <th>Start Time</th>
                                                <th>End time</th>
                                                <th>Consultation Fee</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="listRecords">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center">
                                    <a href="javascript:void(0)" class="btn btn-success mt-3"
                                        id="load_more_consultancies" total_pages="0" current_page="1"
                                        style="display: none;">Load More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('admin-panel/partials/footer'); ?>