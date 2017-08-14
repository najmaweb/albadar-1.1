<!DOCTYPE html>
<html>
    <head>
        <title>Penambahan User</title>
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
                                    <div class="text-muted bootstrap-admin-box-title">Entri User Baru</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal" action="/users/save" method="POST">
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label" for="focusedInput">Nama User</label>
                                                <div class="col-lg-8" id="the-basics">
                                                    <input class="form-control typeahead" id="nname" name="nname" type="text" value="" placeholder="Nama User">
                                                </div>
                                            </div>
                                            <div class="form-group has-warning">
                                                <label class="col-lg-4 control-label" for="inputError">Email</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="email" name="email" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label class="col-lg-4 control-label" for="selectError">Nama Depan</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="fname" name="fname" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label class="col-lg-4 control-label" for="selectError">Nama Tengah</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="mname" name="mname" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label" for="focusedInput">Nama Akhir</label>
                                                <div class="col-lg-8" id="the-basics">
                                                    <input type="text" id="lname" name="lname" class="form-control" value="">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
                window.location.href = "/users"
            });
        </script>
    </body>
</html>
