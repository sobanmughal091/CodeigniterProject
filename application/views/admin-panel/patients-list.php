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
                                    <strong>Success!</strong>
                                    <?= $this->session->flashdata('success')  ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('error') != "") { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong>
                                    <?= $this->session->flashdata('error')  ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-lg-10"></div>
                                <div class="col-lg-2">
                                    <a href="<?= base_url('add-patient') ?>" class="btn btn-inverse-primary btn-fw mt-3 mb-3">Add
                                        Patient</a>
                                </div>
                            </div>
                            <?php if (!empty($patients)) { ?>
                                <div class="card-body">
                                    <h2 class="card-title text-center mb-4">Patient Records</h2>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>#</th>
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>ID Card</th>
                                                    <th>Mobile</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($patients as $patient) { ?>
                                                    <tr class="text-center">
                                                        <td><?= $patient->id ?></td>
                                                        <td><?= $patient->first_name . ' ' . $patient->last_name ?></td>
                                                        <td><?= $patient->email ?></td>
                                                        <td><?= $patient->id_card ?></td>
                                                        <td><?= $patient->mobile ?></td>
                                                        <td>
                                                            <a href="<?= base_url('edit-patient/') . $patient->id ?>" class="btn btn-inverse-warning btn-fw">Edit</a>
                                                            <a href="<?= base_url('delete/') . $patient->id ?>" class="btn btn-inverse-danger btn-fw">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?= $this->pagination->create_links(); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->

            <!-- partial -->

            <?php $this->load->view('admin-panel/partials/footer'); ?>