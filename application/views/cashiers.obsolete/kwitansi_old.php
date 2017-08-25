<html>
<head>
    <link rel="stylesheet" href="/assets/css/kwitansi.css" />
</head>
<body>
<table id="rpt" width=100%>
    <thead>
        <tr><td width="16%"></td><td width="16%"></td><td width="16%"></td><td width="16%"></td><td width="16%"></td><td width="16%"></td></tr>
        <tr><td class="image" colspan=2><img src="/assets/images/logo100x500.png"></td><td colspan=2 >KWITANSI</td><td id="nokwitansi" colspan=2 >No. EL/06/17/0001</td></tr>
    </thead>
    <tbody>
        <tr><td class="line" colspan=6></td</tr>
        <tr><td>Telah terima dari</td><td>: <?php echo substr($studentname,0,17);?> - <?php echo $grade;?></td><td id="terbilang" rowspan="2" colspan="4"><?php echo humanize(terbilang((string) $total)) . " Rupiah";?></td></tr>
        <tr><td>Sejumlah Uang</td><td>: <?php echo number_format($topaid);?></td></tr>
        <tr><td class="line" colspan=6></td</tr>

        <tr><td class="centeraligned bold">No</td><td colspan=3 class="centeraligned  bold">Keterangan</td><td colspan=2 class="centeraligned bold">Jumlah</td></tr>

        <tr><td class="line" colspan=6></td</tr>
        <tr><td class="centeraligned number">1</td><td colspan=3>SPP</td><td colspan=2 class="rightaligned number"><?php echo number_format($spp);?></td></tr>
        <tr><td class="centeraligned number">2</td><td colspan=3>DU / PSB</td><td colspan=2 class="rightaligned number"><?php echo number_format($psb);?></td></tr>
        <tr><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td></tr>
        <tr><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td></tr>
        <tr><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td></tr>
        <tr><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td></tr>
        <tr><td class="line" colspan=6></td</tr>
        <tr><td>Total Tagihan</td><td><?php echo number_format($totaltagihan);?></td><td colspan=2>&nbsp;</td><td>TOTAL</td><td class="rightaligned number"><?php echo number_format($psb+$spp);?></td></tr>
        <tr><td>Yang sudah dibayar</td><td><?php echo number_format($dupsbpaid);?></td><td colspan=2>&nbsp;</td><td></td><td></td></tr>
        <tr><td>Sisa Tagihan</td><td><?php echo number_format($dupsbremain);?></td><td colspan=2>&nbsp;</td><td></td><td></td></tr>
        <tr><td>Status</td><td>Belum Lunas</td><td colspan=2>&nbsp;</td><td></td><td></td></tr>
    </tbody>
</table>
<script type="text/javascript" src="/assets/js/kwitansi.js"></script>
</body>
</html>