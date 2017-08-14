<!DOCTYPE html>
<html>
    <head>
        <title>Master Pelajar</title>
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
                            <div class="panel panel-default">
                                <div class="head panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Daftar Siswa</div>
                                    <button class="xright btn btn-sm btn-default" id="addstudent">
                                        <i class="glyphicon glyphicon-plus"></i> Penambahan
                                    </button>
                                    <button class="xright btn btn-sm btn-default" id="importstudent">
                                        <i class="glyphicon glyphicon-plus"></i> Import
                                    </button>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table table-striped table-bordered" id="tblstudent">
                                        <thead>
                                            <tr>
                                                <th width="15%">NIS</th>
                                                <th>Nama</th>
                                                <th width="5%">Kelas</th>
                                                <th width="25%">SPP</th>
                                                <th width="15%">Keterangan</th>
                                                <th width="15%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($objs as $obj){?>
                                            <tr class="odd gradeX">
                                                <?php 
                                                    $info = "DU/PSB: " . $obj->dupsb;
                                                    $info.= "\nBuku: " . $obj->bookpayment;
                                                    $info.= "\nBimbel: " . $obj->bimbel;
                                                ?>
                                                <td title='<?php echo $info;?>'><?php echo $obj->nis;?></td>
                                                <td title='<?php echo $info;?>'><?php echo $obj->name;?></td>
                                                <td title='<?php echo $info;?>'><?php echo $obj->grade;?></td>
                                                <td title='<?php echo $info;?>' class="center"><?php echo $obj->sppgroup . '(' . $obj->sppamount . ')';?></td>
                                                <td title='<?php echo $info;?>' class="center"><?php echo $obj->description;?></td>
                                                <td class="center">
                                                <div class="btn-group">
                                                    <button class="btn">Action</button>
                                                    <button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="../students/edit/<?php echo $obj->id;?>">Edit</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="../students/remove/<?php echo $obj->id;?>">Hapus</a></li>
                                                    </ul>
                                                </div>
                                                </td>
                                            </tr>
                                            <?php }?>
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
        <script type="text/javascript">
            $('#tblstudent').dataTable( {
                "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                "sPaginationType": "bootstrap",
                "iDisplayLength": 5,
                "oLanguage": {
                    //"sLengthMenu": "_MENU_ records per page"
                    "sLengthMenu": 'Display <select>'+
                        '<option value="5">5</option>'+
                        '<option value="10">10</option>'+
                        '<option value="20">20</option>'+
                        '<option value="30">30</option>'+
                        '<option value="40">40</option>'+
                        '<option value="50">50</option>'+
                        '<option value="-1">All</option>'+
                        '</select> records'
                    }
            } );
            $("#addstudent").click(function(){
                window.location.href = "/students/add";
            });
            $("#importstudent").click(function(){
                window.location.href = "/students/import";
            });
        </script>
    </body>
</html>
