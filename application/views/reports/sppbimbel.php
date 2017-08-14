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
                <tr><th width="5%">No</th><th class="centered" width="15%">Tanggal</th><th>Uraian</th><th width="10%">Nama Petugas</th><th width="25%">Jumlah</th></tr>
            </thead>
            <tbody>
                <tr class="subheader"><th colspan=5>SPP</th></tr>
                <?php $c = 1;?>
                <?php foreach($spp as $obj){?>
                <tr><td class="number"><?php echo $c;?></td><td class="centered"><?php echo $obj->createdate;?></td><td><?php echo $obj->subj;?></td><td><?php echo $obj->createuser;?></td><td class="number"><?php echo "Rp." . number_format($obj->spp);?></td></tr>
                <?php $c = $c + 1;?>
                <?php }?>
                <tr class="subtotal"><th colspan=3>Total SPP</th><th colspan=2 class="number"><?php echo number_format($spptotal);?></th></tr>
                <tr class="subheader"><th colspan=5>Bimbel</th></tr>
                <?php $c = 1;?>
                <?php foreach($bimbel as $obj){?>
                <tr><td class="number"><?php echo $c;?></td><td class="centered"><?php echo $obj->createdate;?></td><td><?php echo $obj->subj;?></td><td><?php echo $obj->createuser;?></td><td class="number"><?php echo "Rp." . number_format($obj->spp);?></td></tr>
                <?php $c = $c + 1;?>
                <?php }?>
                <tr class="subtotal"><th colspan=3>Total Bimbel</th><th colspan=2 class="number"><?php echo number_format($bimbeltotal);?></th></tr>
            </tbody>
            <tfoot>
                <tr><td colspan=3>Total</td><td colspan=2 class="number"><?php echo "Rp." . number_format($spptotal+$bimbeltotal);?></td><td></td></tr>
            </tfoot>
        </table>
    </body>
</html>