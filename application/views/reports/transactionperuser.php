<html>
    <head>
        <title>Laporan Rekap Transaksi Per Petugas</title>
        <link rel="stylesheet" href="/assets/css/najma.reports.css" />
    </head>
    <body>
        <div class="topnavcenter"><a href="/reports"><img src="/assets/images/home16.png" /></a></div>
        <h1>Laporan Rekap Transaksi Per Petugas</h1>
        <h3>
        <form action="/reports/filtertransactionperuser" method="post">
        <span class="filter">Petugas</label>
        <?php echo form_dropdown("user",$users,$user);?>
        <span class="filter">Bulan</label>
        <?php echo form_dropdown("month",$humanmonth,$month);?>
        <?php echo form_dropdown("year",$years,$year);?>
        <button id="filter" name="filter">Filter</button>
        </form>
        </h3>
        <table class="commonreport">
            <thead>
                <tr><th>No</th><th>Tanggal</th><th>Petugas</th><th>Jumlah</th></tr>
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
                    <td class="center"><?php echo $report->dt;?></td>
                    <td><?php echo humanize($report->createuser);?></td>
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