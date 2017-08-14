<html>
    <head>
        <link rel="stylesheet" media="screen" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="/assets/css/bootstrap-theme.min.css">
        <script type="text/javascript" src="/assets/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
        <title><?php echo $formtitle;?></title>
        <style>
            h1,h2,h3,h4{
                text-align: center;
            }
            .commonreport{
                width: 100%;
            }
            .commonreport thead tr th{
                border: 1px solid black;
                text-align:center;
            }
            .commonreport tbody tr td{
                padding: 10px;
                border-bottom: solid 1px black;

            }
            .number{
                text-align: right;
                padding: 10px;
            }
            .commonreport tfoot tr td{
                padding: 10px;
                border-bottom: solid 1px black;
                font-weight: bold;
            }
            .commonreport tbody tr.subheader th{
                border-bottom: 3px solid black;
                text-align: left;
                font-size: 20px;
                font-style: italic;
                padding: 5 0 5 10;
            }
            .commonreport .centered{
                text-align: center;
            }
         </style>
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-sm-1">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Kelas <span class="caret"></span></button>
                    <ul class="dropdown-menu" id="dropdowngrade">
                        <?php foreach($grades as $grade){?>
                            <li val="<?php echo $grade;?>"><a><?php echo $grade;?></a></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-1">
                <input type="text" class="form-control" id="textgrade"/>
            </div>
            <div class="col-sm-1">
                <button class="btn" id="btnFilter"><i class="glyphicon glyphicon-filter"></i> Filter
                </button>
            </div>
            <div class="col-sm-1">
                    <button class="btn"><i class="glyphicon glyphicon-print"></i> Cetak</button>
            </div>
            <div class="col-sm-9"></div>
        </div>
        <h1><?php echo $formtitle;?></h1>
        <h3>
            Tahun <?php echo $pyear;?>
            
        </h3>
        <h4>YPAI Elhaq, Jl Raya Banjarsari Kec. Buduran, Kab. Sidoarjo</h4>
        <table class="commonreport" width="100%">
            <thead>
                <tr><th width="3%">No</th><th class="left" width="15%">Nama</th>
                <?php foreach($periodmonths as $month){?>
                <th width="5%"><?php echo substr($month,0,3);?></th>
                <?php }?>
                </tr>
            </thead>
            <tbody>
                <?php $c = 1;?>
                <?php foreach($objs as $obj){?>
                <tr>
                    <td class="number"><?php echo $c;?></td>
                    <td class="left"><?php echo '(' . $obj->nis . ')' . $obj->name;?></td>
                    <td class="number"><?php echo $obj->jun;?></td>
                    <td class="number"><?php echo $obj->jul;?></td>
                    <td class="number"><?php echo $obj->ags;?></td>
                    <td class="number"><?php echo $obj->sep;?></td>
                    <td class="number"><?php echo $obj->okt;?></td>
                    <td class="number"><?php echo $obj->nop;?></td>
                    <td class="number"><?php echo $obj->des;?></td>
                    <td class="number"><?php echo $obj->jan;?></td>
                    <td class="number"><?php echo $obj->feb;?></td>
                    <td class="number"><?php echo $obj->mar;?></td>
                    <td class="number"><?php echo $obj->apr;?></td>
                    <td class="number"><?php echo $obj->mei;?></td>
                </tr>
                <?php $c = $c + 1;?>
                <?php }?>

            </tbody>
            <tfoot>
                <tr><td colspan=3>Total</td><td colspan=2 class="number"><?php echo "Rp." . number_format(0);?></td><td></td></tr>
            </tfoot>
        </table>
        </div>
        <script>
            (function($){
                urisegments = location.pathname.split("/");
                grade = urisegments[3];
                $("#textgrade").val(grade);
                $("#dropdowngrade li a").click(function(){
                    that = $(this);
                    $("#textgrade").val(that.html());
                });
                $("#btnFilter").click(function(){
                    window.location.href = "/reports/filterrekapbimbelperkelas/"+$("#textgrade").val()+"/2014";
                });
            }(jQuery))
        </script>
    </body>
</html>