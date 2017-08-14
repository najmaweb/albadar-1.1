<!DOCTYPE html>
<html>
    <head>
        <title>Biaya Pendidikan</title>
        <?php
        $this->load->view("commons/headcontent");
        ?>
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
                                    <div class="text-muted bootstrap-admin-box-title">Basic Table</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>SPP</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>0001</td>
                                                <td>Ahmad Izzudin Qossam</td>
                                                <td>60000</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li class='btn_edit pointer'><a>Edit</a></li>
                                                            <li class="divider"></li>
                                                            <li class='btn_report pointer'><a>View</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>0002</td>
                                                <td>Hamzah Muhammad</td>
                                                <td>60000</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li class='btn_edit pointer'><a>Edit</a></li>
                                                            <li class="divider"></li>
                                                            <li class='btn_report pointer'><a>View</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>0003</td>
                                                <td>Ibrahim Sholeh</td>
                                                <td>75000</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li class='btn_edit pointer'><a>Edit</a></li>
                                                            <li class="divider"></li>
                                                            <li class='btn_report pointer'><a>View</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- footer -->
        <?php $this->load->view("commons/footer");?>
        <?php $this->load->view("commons/assets");?>
        <script type="text/javascript" src="/assets/vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="/assets/js/DT_bootstrap.js"></script>
    </body>
</html>
