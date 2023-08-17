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
                                    <a href="<?= base_url('add-bill') ?>"
                                        class="btn btn-inverse-primary btn-fw mt-4 mb-3 ms-5">Add
                                        Bill</a>
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