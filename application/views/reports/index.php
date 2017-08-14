<!DOCTYPE html>
<html>
    <head>
        <title>Laporan-laporan</title>
        <?php $this->load->view("commons/headcontent");;?>
    </head>
    <body class="bootstrap-admin-with-small-navbar">
        <!-- small navbar -->
        <?php $this->load->view("commons/topmenu");?>
        <!-- main / large navbar -->
        <?php $this->load->view("commons/level2menu");?>
        <div class="container">
            <!-- left, vertical navbar & content -->
            <div class="row">
                <!-- left, vertical navbar -->
                <?php $this->load->view("commons/horizontalmenu");?>
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1><?php echo $formtitle;?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title"><?php echo $formtitle;?></div>
                                </div>
                                <div class="bootstrap-admin-panel-content text-muted" style="padding: 60px 0; text-align: center">
                                    <div class="col-lg-3">
                                    <a href="/reports/dailytransactions" class="btn">Rekap Transaksi Harian</a>
                                    </div>
                                    <div class="col-lg-3">
                                    <a href="/reports/transactionperuser/<?php echo date('m');?>/<?php echo date('Y');?>/all" class="btn">
                                        Rekap Per Petugas
                                    </a>
                                    </div>
                                    <div class="col-lg-3">
                                    <a href="/reports/dailyrekapperuser" class="btn">Rekap Harian Per Petugas</a>
                                    </div>
                                    <div class="col-lg-3">
                                    <a href="/reports/rekapdu" class="btn">Rekap DU</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="bootstrap-admin-panel-content text-muted" style="padding: 60px 0; text-align: center">
                                    <div class="col-lg-3">
                                    <a href="/reports/rekapsppperkelas" class="btn">Rekap SPP Per Kelas</a>
                                    </div>
                                    <div class="col-lg-3">
                                    <a href="/reports/filterrekapbimbelperkelas" class="btn">Rekap Bimbel Per Kelas</a>
                                    </div>
                                    <div class="col-lg-3">
                                    <a href="/reports/rekapbuku" class="btn">Rekap Buku</a>
                                    </div>
                                    <div class="col-lg-3">
                                    <a href="/reports/tertanggung" class="btn">Rekap Tertanggung</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        <?php $this->load->view("commons/footer");?>
        <script type="text/javascript" src="/assets/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/assets/js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap-admin-theme-change-size.js"></script>
    </body>
</html>