<!DOCTYPE html>
<html>
    <head>
        <title>Edit Kelas</title>
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
                                    <div class="text-muted bootstrap-admin-box-title">Edit Kelas</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal" action="/grades/update" method="POST">
                                        <fieldset>
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="<?php echo $obj->id;?>" />
                                                <label class="col-lg-4 control-label" for="focusedInput">Nama Kelas</label>
                                                <div class="col-lg-8" id="the-basics">
                                                    <input class="form-control typeahead" id="classname" name="name" type="text" value="<?php echo $obj->name;?>" placeholder="Nama Kelas">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label" for="sppgroup_id">Default SPP</label>
                                                <div class="col-lg-8" id="the-basics">
                                                    <?php echo form_dropdown("sppgroup_id",$sppdefault,$obj->sppgroup_id);?>&nbsp;(Akan mengganti nilai default spp seluruh siswa dalam kelas)
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label" for="bimbelgroup_id">Default Bimbel</label>
                                                <div class="col-lg-8" id="the-basics">
                                                    <?php echo form_dropdown("bimbelgroup_id",$bimbeldefault,$obj->bimbelgroup_id);?>&nbsp;(Akan mengganti nilai default bimbel seluruh siswa dalam kelas)
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label" for="bimbelgroup_id">Default DU/PSB</label>
                                                <div class="col-lg-8" id="the-basics">
                                                    <?php echo form_dropdown("dupsbgroup_id",$dupsbdefault,$obj->dupsbgroup_id);?>&nbsp;(Akan mengganti nilai default DU/PSB seluruh siswa dalam kelas)
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label" for="bookpaymentgroup_id">Default Pemb. Buku</label>
                                                <div class="col-lg-8" id="the-basics">
                                                    <?php echo form_dropdown("bookpaymentgroup_id",$bookpaymentdefault,$obj->bookpaymentgroup_id);?>&nbsp;(Akan mengganti nilai default Pemb. Buku seluruh siswa dalam kelas)
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label" for="focusedInput">Keterangan</label>
                                                <div class="col-lg-8" id="the-basics">
                                                    <input class="form-control typeahead" id="classname" name="description" type="text" value="<?php echo $obj->description;?>" placeholder="Nama Kelas">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="btnsave">Simpan Perubahan</button>
                                            <button type="reset" class="btn btn-default">Batalkan</button>
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
                var bts = [{"value":"170001-Ahmad Trianto (5c)","data":1},{"value":"170002-Irfan Hakim (5b)","data":2},{"value":"170003-Irwan Maulana (4d)","data":3}];

                $('#focusedInput').autocomplete({
                    lookup: bts,
                    onSelect: function(suggestion) {
                        $('#client_id').val(suggestion.data);
                        console.log('suggestion',suggestion);
                        //$('#selction-bts').html('You selected: ' + suggestion.value + ', ' + suggestion.data);
                    },
                    onHint: function (hint) {
                        console.log('hint',hint);
                        //$('#autocomplete-bts-x').val(hint);
                    },
                    onInvalidateSelection: function() {
                        //$('#selction-bts').html('You selected: none');
                    }
                });
        </script>
        <script>
            (function($){
                $("#cashpay").change(function(){
                    $("#returnmoney").val($(this).val());
                });
            }(jQuery))
        </script>
    </body>
</html>
