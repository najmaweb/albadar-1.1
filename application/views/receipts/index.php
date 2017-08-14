<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title;?></title>
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
                                    <div class="text-muted bootstrap-admin-box-title"><?php echo $title;?></div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table table-striped table-bordered" id="tblreceipt">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Tahun</th>
                                                <th>No. Kwitansi</th>
                                                
                                                <th width="15%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($objs as $obj){?>
                                            <tr class="odd objX">
                                                <td class="centeraligned"><?php echo $obj->name?></td>
                                                <td class="rightaligned" title="<?php echo $obj->year;?>"><?php echo $obj->year;?></td>
                                                <td class="rightaligned" title="<?php echo $obj->receiptno;?>"><?php echo $obj->receiptno;?></td>
                                                <td class="center">
                                                <div class="btn-group">
                                                    <button class="btn">Action</button>
                                                    <button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="../receipts/previewkwitansi/<?php echo $obj->id;?>">View</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="../receipts/kwitansi/<?php echo $obj->id;?>">Reprint</a></li>
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
            $('#tblreceipt').dataTable( {
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
                    },
                "aaSorting":[[2,'desc']],
            } );
        </script>
    </body>
</html>
