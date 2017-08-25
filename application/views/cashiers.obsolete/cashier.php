<!DOCTYPE html>
<html>
    <head>
        <title>Pembayaran</title>
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
                                    <div class="text-muted bootstrap-admin-box-title">Entri Pembayaran</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal">
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label" for="focusedInput">Nama Siswa</label>
                                                <div class="col-lg-8" id="the-basics">
                                                    <input class="form-control typeahead" id="focusedInput" type="text" value="" placeholder="Nama Siswa">
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label class="col-lg-4 control-label" for="selectError">Cara Pembayaran</label>
                                                <div class="col-lg-8">
                                                    <select id="selectError" class="form-control">
                                                        <option>Tunai</option>
                                                        <option>Dari Tabungan</option>
                                                        <option>Transfer</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group has-warning">
                                                <label class="col-lg-4 control-label" for="inputError">Jumlah</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="inputWarning" class="form-control" value=45>
                                                </div>
                                            </div>
                                            <div class="form-group has-error">
                                                <label class="col-lg-4 control-label" for="inputError">Keperluan</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="inputError" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label class="col-lg-4 control-label" for="inputError">Dibayarkan</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="inputSuccess" class="form-control" value="98">
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label class="col-lg-4 control-label" for="inputError">Jumlah Kembalian</label>
                                                <div class="col-lg-8">
                                                    <input type="text" id="inputSuccess" class="form-control" value="98">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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

    </body>
</html>
