<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard Al Badar</title>
        <!-- Vendors -->
        <link rel="stylesheet" media="screen" href="/assets/vendors/easypiechart/jquery.easy-pie-chart.css">
        <link rel="stylesheet" media="screen" href="/assets/vendors/easypiechart/jquery.easy-pie-chart_custom.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="js/html5shiv.js"></script>
           <script type="text/javascript" src="js/respond.min.js"></script>
        <![endif]-->

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
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Statistics</div>
                                    <div class="pull-right"><span class="badgex">Persentase DU/PSB Yang sudah terbayar</span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $dupsbkls1a;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $dupsbkls1a;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">DU/PSB Kelas 1 A</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $dupsbkls1b;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $dupsbkls1b;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">DU/PSB Kelas 1 B</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $dupsbkls1c;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $dupsbkls1c;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">DU/PSB Kelas 1 C</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $dupsbkls2a;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $dupsbkls2a;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">DU/PSB Kelas 2 A</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Statistics</div>
                                    <div class="pull-right"><span class="badgex">Persentase DU/PSB Yang sudah terbayar</span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $dupsbkls2b;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $dupsbkls2b;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">DU/PSB Kelas 2 B</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $dupsbkls2c;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $dupsbkls2c;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">DU/PSB Kelas 2 C</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $dupsbkls3a;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $dupsbkls3a;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">DU/PSB Kelas 3 A</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $dupsbkls3b;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $dupsbkls3b;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">DU/PSB Kelas 3 B</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Statistics</div>
                                    <div class="pull-right"><span class="badgex">Persentase DU/PSB Yang sudah terbayar</span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $dupsbkls3c;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $dupsbkls3c;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">DU/PSB Kelas 3 C</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $dupsbkls4a;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $dupsbkls4a;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">DU/PSB Kelas 4 A</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $dupsbkls4b;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $dupsbkls4b;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">DU/PSB Kelas 4 B</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $dupsbkls4c;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $dupsbkls4c;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">DU/PSB Kelas 4 C</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Statistics</div>
                                    <div class="pull-right"><span class="badgex">Persentase DU/PSB Yang sudah terbayar</span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $dupsbkls5a;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $dupsbkls5a;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">DU/PSB Kelas 5 A</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $dupsbkls5b;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $dupsbkls5b;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">DU/PSB Kelas 5 B</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $dupsbkls6a;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $dupsbkls6a;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">DU/PSB Kelas 6 A</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $dupsbkls6b;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $dupsbkls6b;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">DU/PSB Kelas 6 B</span></div>
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
        <?php $this->load->view("commons/assets");?>
       

        <script type="text/javascript">
            $(function() {
                // Easy pie charts
                $('.easyPieChart').easyPieChart({animate: 1000});
            });
        </script>
    </body>
</html>