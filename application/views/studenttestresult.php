<!DOCTYPE html>
<html>
    <head>
        <title>Hasil Evaluasi Belajar Siswa</title>
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
            <?php $this->load->view("commons/horizontalmenu");?>
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1>Ahmad (Kelas 2A / Semester II 2017)</h1>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Entri Hasil Evaluasi</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal">
                                        <fieldset>
                                            <legend>Mata Pelajaran</legend>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">Bahasa Indonesia</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" id="focusedInput" type="text" value="87">
                                                </div>
                                            </div>
                                            <div class="form-group has-warning">
                                                <label class="col-lg-2 control-label" for="inputError">Matematika</label>
                                                <div class="col-lg-10">
                                                    <input type="text" id="inputWarning" class="form-control" value=45>
                                                    <span class="help-block">Nilai Dibawah Rata-rata</span>
                                                </div>
                                            </div>
                                            <div class="form-group has-error">
                                                <label class="col-lg-2 control-label" for="inputError">Olah Raga</label>
                                                <div class="col-lg-10">
                                                    <input type="text" id="inputError" class="form-control" value="">
                                                    <span class="help-block">Nilai tidak boleh kosong</span>
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label class="col-lg-2 control-label" for="inputError">IPS</label>
                                                <div class="col-lg-10">
                                                    <input type="text" id="inputSuccess" class="form-control" value="98">
                                                    <span class="help-block">Nilai di atas rata-rata</span>
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label class="col-lg-2 control-label" for="selectError">Peringkat Kelas</label>
                                                <div class="col-lg-10">
                                                    <select id="selectError" class="form-control">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                    <span class="help-block">Woohoo!</span>
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

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Entri Keterangan Siswa</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal">
                                        <fieldset>
                                            <legend>Keterangan Siswa</legend>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="typeahead">Absen tanpa ijin </label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control col-md-6" value='1'>
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
        <div class="navbar navbar-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <footer role="contentinfo">
                            <p class="left">Bootstrap 3.x Admin Theme</p>
                            <p class="right">&copy; 2013 <a href="http://www.meritoo.pl" target="_blank">Meritoo.pl</a></p>
                        </footer>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view("commons/assets");?>
        <script type="text/javascript">
            $(function() {
                $('.datepicker').datepicker();
                $('.uniform_on').uniform();
                $('.chzn-select').chosen();
                $('.selectize-select').selectize();
                $('.textarea-wysihtml5').wysihtml5({
                    stylesheets: [
                        '/assets/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/stylesheets/bootstrap-wysihtml5/wysiwyg-color.css'
                    ]
                });

                $('#rootwizard').bootstrapWizard({
                    'nextSelector': '.next',
                    'previousSelector': '.previous',
                    onNext: function(tab, navigation, index) {
                        var $total = navigation.find('li').length;
                        var $current = index + 1;
                        var $percent = ($current / $total) * 100;
                        $('#rootwizard').find('.progress-bar').css('width', $percent + '%');
                        // If it's the last tab then hide the last button and show the finish instead
                        if ($current >= $total) {
                            $('#rootwizard').find('.pager .next').hide();
                            $('#rootwizard').find('.pager .finish').show();
                            $('#rootwizard').find('.pager .finish').removeClass('disabled');
                        } else {
                            $('#rootwizard').find('.pager .next').show();
                            $('#rootwizard').find('.pager .finish').hide();
                        }
                    },
                    onPrevious: function(tab, navigation, index) {
                        var $total = navigation.find('li').length;
                        var $current = index + 1;
                        var $percent = ($current / $total) * 100;
                        $('#rootwizard').find('.progress-bar').css('width', $percent + '%');
                        // If it's the last tab then hide the last button and show the finish instead
                        if ($current >= $total) {
                            $('#rootwizard').find('.pager .next').hide();
                            $('#rootwizard').find('.pager .finish').show();
                            $('#rootwizard').find('.pager .finish').removeClass('disabled');
                        } else {
                            $('#rootwizard').find('.pager .next').show();
                            $('#rootwizard').find('.pager .finish').hide();
                        }
                    },
                    onTabShow: function(tab, navigation, index) {
                        var $total = navigation.find('li').length;
                        var $current = index + 1;
                        var $percent = ($current / $total) * 100;
                        $('#rootwizard').find('.bar').css({width: $percent + '%'});
                    }
                });
                $('#rootwizard .finish').click(function() {
                    alert('Finished!, Starting over!');
                    $('#rootwizard').find('a[href*=\'tab1\']').trigger('click');
                });
            });
        </script>
    </body>
</html>
