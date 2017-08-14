<!DOCTYPE html>
<html>
    <head>
        <title>Edit Siswa</title>
        <?php
        $this->load->view("commons/headcontent");
        ?>
        <link rel="stylesheet" href="/assets/js/autocomplete/styles.css" />
    </head>
    <body class="bootstrap-admin-with-small-navbar">
        <!-- small navbar -->
        <?php $this->load->view("commons/topmenu");?>
        <!-- main / large navbar -->
        <?php $this->load->view("commons/level2menu");?>
        <div class="container">
            <!-- left, vertical navbar & content -->
            <div class="row">
            <?php $this->load->view("commons/horizontalmenu");?>
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Edit Siswa</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal" action="/students/update" method="POST">
                                        <fieldset>
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="<?php echo $obj->id;?>" />
                                                <label class="col-lg-4 control-label" for="focusedInput">Nama Siswa</label>
                                                <div class="col-lg-8" id="the-basics">
                                                    <input class="form-control typeahead" id="classname" name="name" type="text" value="<?php echo $obj->name;?>" placeholder="Nama Siswa">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label" for="focusedInput">NIS</label>
                                                <div class="col-lg-8" id="the-basics">
                                                    <input class="form-control typeahead" id="classname" name="nis" type="text" value="<?php echo $obj->nis;?>" placeholder="Jumlah">
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label class="col-lg-4 control-label" for="selectError">Kelas</label>
                                                <div class="col-lg-8">
                                                    <?php echo form_dropdown("grade_id",$grades,$obj->grade_id,"class='form-control'");?>
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label class="col-lg-4 control-label" for="selectError">Grup SPP</label>
                                                <div class="col-lg-8">
                                                    <?php echo form_dropdown("sppgroup_id",$sppgroups,$obj->sppgroup_id,"class='form-control'");?>
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label class="col-lg-4 control-label" for="selectError">Grup DU/PSB</label>
                                                <div class="col-lg-8">
                                                    <?php echo form_dropdown("dupsbgroup_id",$dupsbgroups,$obj->dupsbgroup_id,"class='form-control'");?>
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label class="col-lg-4 control-label" for="selectError">Grup Buku</label>
                                                <div class="col-lg-8">
                                                    <?php echo form_dropdown("bookpaymentgroup_id",$bookpaymentgroups,$obj->bookpaymentgroup_id,"class='form-control'");?>
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label class="col-lg-4 control-label" for="selectError">Grup Bimbel</label>
                                                <div class="col-lg-8">
                                                    <?php echo form_dropdown("bimbelgroup_id",$bimbelgroups,$obj->bimbelgroup_id,"class='form-control'");?>
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label class="col-lg-4 control-label" for="selectError">Inisialisasi Bulan</label>
                                                <div class="col-lg-2">
                                                    <?php echo form_dropdown("initmonth",$months,$obj->initmonth,"class='form-control'");?>
                                                </div>
                                                <label class="col-lg-6">Untuk menghitung awal bulan apabila ada tunggakan</label>
                                            </div>
                                            <div class="form-group has-success">
                                                <label class="col-lg-4 control-label" for="selectError">Inisialisasi Tahun</label>
                                                <div class="col-lg-2">
                                                    <?php echo form_dropdown("inityear",$years,$obj->inityear,"class='form-control'");?>
                                                </div>
                                                <label class="col-lg-6">Untuk menghitung awal tahun apabila ada tunggakan</label>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label" for="focusedInput">Keterangan</label>
                                                <div class="col-lg-8" id="the-basics">
                                                    <input class="form-control typeahead" id="classname" name="description" type="text" value="<?php echo $obj->description;?>" placeholder="Keterangan">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="btnsave">Simpan Perubahan</button>
                                            <button type="reset" class="btn btn-default" id="btncancel">Batalkan</button>
                                        </fieldset>
                                    </form>
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
        <script type="text/javascript" src="/assets/js/autocomplete/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="/assets/js/autocomplete/jquery.autocomplete.js"></script>
        <script type="text/javascript">
            $("#btncancel").click(function(){
                window.location.href = "/students"
            });
        </script>
    </body>
</html>
