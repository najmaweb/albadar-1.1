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
                    <form action="/Dashboard/filter" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Filter 
                                    </div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label" for="sname">Bulan</label>
                                            <div class="col-lg-6" id="the-basics">
                                                <?php echo form_dropdown("month",$months,$month);?>
                                            </div>
                                            <div class="col-lg-3" id="the-basics">
                                                <input type="submit" name="filter" value="Filter">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Statistics</div>
                                    <div class="pull-right"><span class="badgex">Persentase SPP Yang sudah terbayar</span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $sppkls1a;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $sppkls1a;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">SPP Kelas 1 A</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $sppkls1b;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $sppkls1b;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">Spp Kelas 1 B</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $sppkls1c;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $sppkls1c;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">Spp Kelas 1 C</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $sppkls2a;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $sppkls2a;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">Spp Kelas 2 A</span></div>
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
                                    <div class="pull-right"><span class="badgex">Persentase SPP Yang sudah terbayar</span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $sppkls2b;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $sppkls2b;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">SPP Kelas 2 B</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $sppkls2c;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $sppkls2c;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">Spp Kelas 2 C</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $sppkls3a;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $sppkls3a;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">Spp Kelas 3 A</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $sppkls3b;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $sppkls3b;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">Spp Kelas 3 B</span></div>
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
                                    <div class="pull-right"><span class="badgex">Persentase SPP Yang sudah terbayar</span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $sppkls3c;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $sppkls3c;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">SPP Kelas 3 C</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $sppkls4a;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $sppkls4a;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">Spp Kelas 4 A</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $sppkls4b;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $sppkls4b;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">Spp Kelas 4 B</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $sppkls4c;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $sppkls4c;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">Spp Kelas 4 C</span></div>
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
                                    <div class="pull-right"><span class="badgex">Persentase SPP Yang sudah terbayar</span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $sppkls5a;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $sppkls5a;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">SPP Kelas 5 A</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $sppkls5b;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $sppkls5b;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">Spp Kelas 5 B</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $sppkls6a;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $sppkls6a;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">Spp Kelas 6 A</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $sppkls6b;?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $sppkls6b;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">Spp Kelas 6 B</span></div>
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