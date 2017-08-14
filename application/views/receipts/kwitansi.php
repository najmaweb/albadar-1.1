<html>
<head>
    <script type="text/javascript" src="/assets/js/jquery-2.0.3.min.js"></script>
    <link rel="stylesheet" href="/assets/css/kwitansi.css" />
</head>
<body>
<table id="rpt" width=100%>
    <thead>
        <tr>
            <td class="image" colspan=2>
                <?php $showlogo = false;?>
                <?php if($showlogo){?>
                <img src="/assets/images/logo100x500.png">
                <?php }?>
            </td>
            <td colspan=2 style="font-size:16px;">KWITANSI</td>
            <td id="nokwitansi" colspan=2  style="font-size:16px;"><?php echo $kwitansi;?></td>
        </tr>
        <tr id="identity">
            <td></td>
            <td colspan=4 style="font-size:12px;">YPS El Haq, RT 06 RW 01 Banjarsari Buduran Sidoarjo (031) 801 2710</td>
            <td></td>
        </tr>
        
    </thead>
    <tbody>
        <tr><td class="line" colspan=6></td</tr>
        <tr>
            <td>Telah terima dari</td>
            <td>: <?php echo substr($studentname,0,15);?> - <?php echo $grade;?></td>
            <td id="terbilang" rowspan="2" colspan="4"><?php echo humanize(terbilang((string) $total)) . " Rupiah";?></td>
        </tr>
        <tr><td>Sejumlah Uang</td><td>: <?php echo "Rp. " . number_format($topaid);?></td></tr>
        <tr><td class="line" colspan=6></td</tr>

        <tr><td class="centeraligned bold">No</td><td colspan=3 class="centeraligned  bold">Keterangan</td>
        <td colspan=2 class="centeraligned bold">Jumlah</td>
        </tr>

        <tr><td class="line" colspan=6></td</tr>
        <?php $counter = 1;?>
        <?php if($spp){?>
        <tr><td class="centeraligned number"><?php echo $counter;?></td>
            <td colspan=3>SPP <?php echo $monthsarray[$sppfrstmonth] . " " . $sppfrstyear?> - <?php echo $monthsarray[$sppnextmonth] . " " . $sppnextyear;?> (<?php echo $sppmonthcount?> bulan)</td>
            <td colspan=2 class="rightaligned number"><?php echo  "Rp. " . number_format($spp);?></td>
        </tr>
        <?php 
        $counter++;
        }?>
        <?php if($bimbel){?>
        <tr><td class="centeraligned number"><?php echo $counter;?></td>
            <td colspan=3>Bimbel <?php echo $monthsarray[$bimbelfrstmonth] . " " . $bimbelfrstyear?> - <?php echo $monthsarray[$bimbelnextmonth] . " " . $bimbelnextyear;?> (<?php echo $bimbelmonthcount?> bulan)</td>
            <td colspan=2 class="rightaligned number"><?php echo  "Rp. " . number_format($bimbel);?></td>
        </tr>
        <?php 
        $counter++;
        }?>
        <?php if($book){?>
        <tr><td class="centeraligned number"><?php echo $counter;?></td>
            <td colspan=3>Buku</td>
            <td colspan=2 class="rightaligned number"><?php echo  "Rp. " . number_format($book);?></td>
        </tr>
        <?php 
        $counter++;
        }?>
        <?php if($psb){?>
        <tr><td class="centeraligned number"><?php echo $counter;?></td><td colspan=3>PSB</td><td colspan=2 class="rightaligned number"><?php echo  "Rp. " . number_format($psb);?></td></tr>
        <?php }?>
        <tr><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td></tr>
        <tr><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td></tr>
        <tr><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td></tr>
        <tr><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td></tr>
        <tr><td class="line" colspan=6></td</tr>
                <tr>
                    <td>Total Tagihan</td><td class="rightaligned number"><?php echo  "Rp. " . number_format($totaltagihan);?></td>
                    <td colspan=2>&nbsp;</td><td>TOTAL</td>
                    <td class="rightaligned number"><?php echo  "Rp. " . number_format($total);?></td>
                </tr>
                <tr><td>Yang dibayar</td>
                    <td class="rightaligned number"><?php echo  "Rp. " . number_format($total);?></td>
                    <td colspan=2>&nbsp;</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr><td colspan=2 class="line"></td><td colspan=3></td></tr>
                <tr>
                    <td>Sisa Tagihan SPP</td>
                    <td class="rightaligned number"><?php echo  "Rp. " . ($sppremain);?></td>
                    <td colspan=2>&nbsp;</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Sisa Tagihan Bimbel</td>
                    <td class="rightaligned number"><?php echo  "Rp. " . number_format($bimbelremain);?></td>
                    <td colspan=2>&nbsp;</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Sisa Tagihan DU/PSB</td>
                    <td class="rightaligned number"><?php echo  "Rp. " . number_format($dupsbremain);?></td>
                    <td colspan=2>&nbsp;</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Sisa Tagihan Buku</td>
                    <td class="rightaligned number"><?php echo  "Rp. " . number_format($bookpaymentremain-$book);?></td>
                    <td colspan=2>&nbsp;</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr><td colspan=2 class="line"></td><td colspan=3></td></tr>
                <tr>
                    <td>Total Sisa Tagihan</td>
                    <td class="rightaligned number">
                        <?php echo  "Rp. " . number_format($sppremain+$bimbelremain+$dupsbremain+$bookpaymentremain);?>
                    </td>
                    <td colspan=2></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                <td>&nbsp;</td><td class="rightaligned number"></td><td>&nbsp;</td><td colspan=2 class="centeraligned">Banjarsari, <?php echo date("d") . "-" . $periodmonths[removezero(date("m"))] . "-" . date("Y");?></td><td></td>
                </tr>
                <tr><td><b>Catatan:</b></td><td class="rightaligned number"></td><td colspan=2>&nbsp;</td><td>&nbsp;</td><td></td></tr>
                <tr><td colspan=3>* Disimpan sebagai bukti pembayaran yang sah</td><td>&nbsp;</td><td class="centeraligned"></td><td></td></tr>
                <tr><td>&nbsp;</td><td class="rightaligned number"></td><td>&nbsp;</td><td colspan=2 class="centeraligned"><?php echo humanize($_SESSION["username"]);?></td><td></td></tr>
    </tbody>
</table>
<script type="text/javascript" src="/assets/js/kwitansi.js"></script>
</body>
</html>