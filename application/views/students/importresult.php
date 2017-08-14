<!DOCTYPE html>
<html>
    <head>
        <title>Import dari file CSV</title>
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
                        <form action="/students/savefromcsv" method="POST">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="head panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Excel Import</div>
                                    <button class="xright btn btn-sm btn-default" id="btnsavedata" name="btnsavedata" type="submit">
                                        <i class="glyphicon glyphicon-save"></i> Simpan
                                    </button>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table table-striped table-bordered" id="tProcess">
                                        <thead>
                                            <tr>
                                                <th>Tahun</th>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Kode Kelas</th>
                                                <th>Kode SPP</th>
                                                <th>Kode Bimbel</th>
                                                <th>Kode DU/PSB</th>
                                                <th>Kode Pemb. Buku</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($results as $obj){?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $obj["year"];?><input type="hidden" name="year[]" value="<?php echo  $obj["year"];?>"></td>
                                                <td><?php echo $obj["nis"];?><input type="hidden" name="nis[]" value="<?php echo  $obj["nis"];?>"></td>
                                                <td><?php echo $obj["name"];?><input type="hidden" name="name[]" value="<?php echo  $obj["name"];?>"></td>
                                                <td><?php echo $obj["grade_id"];?><input type="hidden" name="grade_id[]" value="<?php echo  $obj["grade_id"];?>"></td>
                                                <td><?php echo $obj["sppgroup_id"];?><input type="hidden" name="sppgroup_id[]" value="<?php echo  $obj["sppgroup_id"];?>"></td>
                                                <td><?php echo $obj["bimbelgroup_id"];?><input type="hidden" name="bimbelgroup_id[]" value="<?php echo  $obj["bimbelgroup_id"];?>"></td>
                                                <td><?php echo $obj["dupsbgroup_id"];?><input type="hidden" name="dupsbgroup_id[]" value="<?php echo  $obj["dupsbgroup_id"];?>"></td>
                                                <td><?php echo $obj["bookpaymentgroup_id"];?><input type="hidden" name="bookpaymentgroup_id[]" value="<?php echo  $obj["bookpaymentgroup_id"];?>"></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </form>
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

