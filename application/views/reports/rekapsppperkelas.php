<html>
    <head>
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
        <h1><?php echo $formtitle;?></h1>
        <h3>Tahun <?php echo $pyear;?></h3>
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
                    <td class="number"><?php echo $obj->jun;?></td>
                </tr>
                <?php $c = $c + 1;?>
                <?php }?>

            </tbody>
            <tfoot>
                <tr><td colspan=3>Total</td><td colspan=2 class="number"><?php echo "Rp." . number_format($spptotal+$bimbeltotal);?></td><td></td></tr>
            </tfoot>
        </table>
    </body>
</html>