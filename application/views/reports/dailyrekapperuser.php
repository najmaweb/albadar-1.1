<html>
    <head>
        <title>Rekap Harian Per Petugas</title>
        <link rel="stylesheet" href="/assets/css/najma.reports.css" />

        <link rel="stylesheet" href="/assets/vendors/jquery-ui-1.12.1.custom/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="/assets/vendors/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
        <script src="/assets/vendors/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
        <script>

        $( function() {
            $( "#datepicker" ).datepicker({ dateFormat: 'dd/mm/yy'});
        } );
        </script>


    </head>
    <body>
        <div class="topnavcenter"><a href="/reports"><img src="/assets/images/home16.png" /></a></div>
        <h1>Laporan Rekap Transaksi Per Petugas</h1>
        <h3>
        <form action="/reports/filterdailyrekapperuser" method="post">
        <span class="filter">Petugas</label>
        <?php echo form_dropdown("user",$users,$user);?>
        <input type='text' id='datepicker' name='date' value='<?php echo $humandate?>'>
        <button id="filter" name="filter">Filter</button>
        </form>
        </h3>
        <table class="commonreport">
            <thead>
                <tr><th>No</th><th>Petugas</th><th>SPP</th><th>Bimbel</th><th>DU/PSB</th><th>Buku</th></tr>
            </thead>
            <tbody>
                <?php 
                    $spp = 0;$bimbel = 0;$dupsb=0;$bookpayment = 0;
                    $c = 0;
                ?>
                <?php foreach($dailyreports as $report){?>
                <?php 
                    $c+=1;
                    $spp+=$report->spp;$bimbel+=$report->bimbel;$dupsb+=$report->dupsb;$bookpayment+=$report->bookpayment;
                ?>
                <tr>
                    <td class="number"><?php echo $c;?></td>
                    <td class="center">
                        <?php echo $report->nname;?>
                    </td>
                    <td class="number">
                        <?php echo "Rp." . number_format($report->spp);?>
                    </td>
                    <td class="number">
                        <?php echo "Rp." . number_format($report->bimbel);?>
                    </td>
                    <td class="number"><?php echo "Rp." . number_format($report->dupsb);?></td>
                    <td class="number">
                        <?php echo "Rp." . number_format($report->bookpayment);?>
                    </td>
                </tr>
                <?php }?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan=2>Total</td>
                    <td class="number"><?php echo "Rp." . number_format($spp);?></td>
                    <td class="number"><?php echo "Rp." . number_format($bimbel);?></td>
                    <td class="number"><?php echo "Rp." . number_format($dupsb);?></td>
                    <td class="number"><?php echo "Rp." . number_format($bookpayment);?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>