<html>
    <head>
        <title>Laporan Transaksi Harian</title>
        <link rel="stylesheet" href="/assets/css/najma.reports.css" />
    </head>
    <body>
        <div class="topnavcenter"><a href="/reports"><img src="/assets/images/home16.png" /></a></div>
        <h1>Laporan Transaksi Harian</h1>
        <h3>Tanggal <?php echo date("d")." ".$humanmonth[removezero(date("m"))]." ".date("Y");?></h3>
        <table class="commonreport">
            <thead>
                <tr><th>No</th><th>Jam</th><th>Uraian</th><th>Petugas</th><th>Jumlah</th></tr>
            </thead>
            <tbody>
                <?php 
                    $tot = 0;
                    $c = 0;
                ?>
                <?php foreach($dailyreports as $report){?>
                <?php 
                    $tot+=$report->amount;
                    $c+=1;
                ?>
                <tr>
                    <td class="number"><?php echo $c;?></td>
                    <td class="center"><?php echo $report->jam;?></td>
                    <td><?php echo $report->uraian;?></td><td><?php echo humanize($report->createuser);?></td>
                    <td class="number"><?php echo "Rp." . number_format($report->amount);?>
                </td>
                </tr>
                <?php }?>
            </tbody>
            <tfoot>
                <tr><td>Total</td><td colspan=4 class="number"><?php echo "Rp." . number_format($tot);?></td></tr>
            </tfoot>
        </table>
    </body>
</html>