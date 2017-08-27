<!DOCTYPE html>
<html>
    <head>
        <title>Tentang Aplikasi AlBadar</title>
        <?php $this->load->view("commons/headcontent");?>
        <!-- Custom styles -->
        <?php $this->load->view("commons/aboutcss");?>
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
                            <div class="page-header bootstrap-admin-content-title">
                                <h1>Tentang Aplikasi AlBadar</h1>
                                <a href="https://github.com/najmaweb/albadar-1.1" class="action btn">
                                    Go to GitHub &raquo;
                                </a>
                                <a href="https://github.com/najmaweb/albadar-1.1/archive/master.zip" class="action">
                                    <button class="btn btn-success">Download (.zip)</button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Details</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <ul>
                                        <li>Sebuah Aplikasi Billing untuk Sekolah</a></li>
                                        <li>Berbasis Web Server Klien</li>
                                        <li>Multi user dan multi klien</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Source</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <ul>
                                        <li>
                                            <a href="https://github.com/najmaweb/albadar-1.1" target="_blank">Github Repository</a>
                                        </li>
                                        <li>
                                            <a href="https://github.com/najmaweb/albadar-1.1/archive/master.zip">Download (.zip package)</a>
                                        </li>
                                        <li>
                                            License: MIT (see below)
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">License</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <p>Al Badar</p>
                                    <p>Copyright © 2017 - najma.web.id &lt;puji [at] najma [dot] web [dot] id &gt;</p>
                                    <p>Sistem Billing Sekolah</p>
                                    <p>The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.</p>
                                    <p>THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row row-urls">
                        <div class="col-md-6">
                            <a href="http://pujie.github.io/" target="_blank">Github page</a>
                        </div>
                        <div class="col-md-6">
                            <a href="http://www.najma.web.id" target="_blank">najma.web.id</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        <?php $this->load->view("commons/footer");?>
        <script type="text/javascript" src="/assets/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/assets/js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap-admin-theme-change-size.js"></script>
    </body>
</html>
