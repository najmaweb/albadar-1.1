<html>
<head>
    <link rel="stylesheet" media="screen" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="/assets/css/bootstrap-theme.min.css">
    <script type="text/javascript" src="/assets/js/jquery-2.0.3.min.js"></script>
    <link rel="stylesheet" href="/assets/css/kwitansi.css" />
</head>
<body>
    <div class="container">
        <div id="buttons" class="row">
        <button class="btn btn-default" id="btngotocashier"><i class="glyphicon glyphicon-home"></i> Home</button>
        <button class="btn btn-default" id="btnprint"><i class="glyphicon glyphicon-print"></i> Cetak</button>
        </div>
        <table id="rpt" width=100%>
            <thead>
                <tr><td width="16%"></td><td width="16%"></td><td width="16%"></td><td width="16%"></td><td width="16%"></td><td width="16%"></td></tr>
                <tr>
                <td class="image" colspan=2>
                <?php $showlogo = false;?>
                <?php if($showlogo){?>
                <img src="/assets/images/logo100x500.png">
                <?php }?>
                </td>
                <td colspan=2 >KWITANSI</td>
                <td id="nokwitansi" colspan=2 ></td>
                </tr>
                <tr id="identity">
                    <td></td><td></td>
                    <td colspan=2 style="font-size:10px;">YPS El Haq, RT 06 RW 01 Banjarsari Buduran Sidoarjo (031) 801 2710</td>
                    <td></td><td></td>
                </tr>
            </thead>
            <tbody>
                <tr><td class="line" colspan=6></td</tr>
                <tr><td>Telah terima dari</td><td>: <?php echo substr($_SESSION["studentname"],0,15);?> - <?php echo $_SESSION["grade"];?></td><td id="terbilang" rowspan="2" colspan="4"><?php echo humanize(terbilang((string) $_SESSION["total"])) . " Rupiah";?></td></tr>
                <tr><td>Sejumlah Uang</td><td>: <?php echo "Rp. " .  number_format($_SESSION["topaid"]);?></td></tr>
                <tr><td class="line" colspan=6></td</tr>

                <tr><td class="centeraligned bold">No</td><td colspan=3 class="centeraligned  bold">Keterangan</td><td colspan=2 class="centeraligned bold">Jumlah</td></tr>

                <tr><td class="line" colspan=6></td</tr>
                <?php $counter = 1;?>
                <?php if($_SESSION["withspp"]){?>
                <tr>
                    <td class="centeraligned number"><?php echo $counter;?></td>
                    <td colspan=3><?php echo $_SESSION["spptext"];?></td><td colspan=2 class="rightaligned number"><?php echo  "Rp. " . number_format($_SESSION["spp"]);?></td>
                </tr>
                <?php 
                $counter++;
                }?>
                <?php if($_SESSION["withbimbel"]){?>
                <tr><td class="centeraligned number"><?php echo $counter;?></td><td colspan=3><?php echo $_SESSION["bimbeltext"]; ?></td><td colspan=2 class="rightaligned number"><?php echo  "Rp. " . number_format($_SESSION["bimbel"]);?></td></tr>
                <?php 
                $counter++;
                }?>
                <?php if($_SESSION["book"]){?>
                <tr><td class="centeraligned number"><?php echo $counter;?></td><td colspan=3>Buku</td><td colspan=2 class="rightaligned number"><?php echo  "Rp. " . number_format($_SESSION["book"]);?></td></tr>
                <?php 
                $counter++;
                }?>
                <?php if($_SESSION["psb"]){?>
                <tr><td class="centeraligned number"><?php echo $counter;?></td><td colspan=3>PSB</td>
                <td colspan=2 class="rightaligned number"><?php echo  "Rp. " . number_format($_SESSION["psb"]);?></td>
                </tr>
                <?php }?>
                <tr><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td></tr>
                <tr><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td></tr>
                <tr><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td></tr>
                <tr><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td><td colspan=2>&nbsp;</td></tr>
                <tr><td class="line" colspan=6></td</tr>
                <tr>
                    <td>Total Tagihan</td>
                    <td class="rightaligned number"><?php echo  "Rp. " . number_format($_SESSION["totaltagihan"]);?></td>
                    <td>
                    <?php 
                    $SHOWDETAIL = FALSE;
                    if($SHOWDETAIL){
                        echo " = " .  number_format($_SESSION["sppremain"]) . "+" . number_format($_SESSION["bimbelremain"]) . "+" . number_format($_SESSION["dupsbremain"]) . "+" . number_format($_SESSION["bookpaymentremain"]) ;
                    }
                    ?>
                    </td>
                    <td></td>
                    <td>TOTAL</td>
                    <td class="rightaligned number"><?php echo  "Rp. " . number_format($_SESSION["total"]);?></td>
                </tr>
                <tr><td>Yang dibayar</td>
                    <td class="rightaligned number"><?php echo  "Rp. " . number_format($_SESSION["total"]);?></td>
                    <td colspan=2>&nbsp;</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr><td colspan=2 class="line"></td><td colspan=3></td></tr>
                <tr>
                    <td><span title="">Sisa Tagihan SPP</span></td>
                    <td class="rightaligned number"><?php echo  "Rp. " . ($_SESSION["sppremain"]);?></td>
                    <td colspan=2>&nbsp;</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Sisa Tagihan Bimbel</td>
                    <td class="rightaligned number"><?php echo  "Rp. " . number_format($_SESSION["bimbelremain"]);?></td>
                    <td colspan=2>&nbsp;</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Sisa Tagihan DU/PSB</td>
                    <td class="rightaligned number"><?php echo  "Rp. " . number_format($_SESSION["dupsbremain"]);?></td>
                    <td colspan=2>&nbsp;</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Sisa Tagihan Buku</td>
                    <td class="rightaligned number"><?php echo  "Rp. " . number_format($_SESSION["bookpaymentremain"]-$_SESSION["book"]);?></td>
                    <td colspan=2>&nbsp;</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr><td colspan=2 class="line"></td><td colspan=3></td></tr>
                <tr>
                    <td>Total Sisa Tagihan</td>
                    <td class="rightaligned number">
                        <?php echo  "Rp. " . number_format($_SESSION["sppremain"]+$_SESSION["bimbelremain"]+$_SESSION["dupsbremain"]+$_SESSION["bookpaymentremain"]);?>
                    </td>
                    <td colspan=2></td>
                    <td></td>
                    <td></td>
                </tr>
                
                <tr>
                <td>&nbsp;</td><td class="rightaligned number"></td>
                <td colspan=2>&nbsp;</td><td class="centeraligned">Banjarsari, <?php echo date("d") . "-" . $_SESSION["periodmonths"][removezero(date("m"))] . "-" . date("Y");?></td>
                <td></td>
                </tr>
                <tr><td><b>Catatan:</b></td><td class="rightaligned number"></td><td colspan=2>&nbsp;</td><td>&nbsp;</td><td></td>
                </tr>
                <tr><td colspan=2>* Disimpan sebagai bukti pembayaran yang sah</td><td colspan=2>&nbsp;</td><td class="centeraligned"></td><td></td></tr>
                <tr><td>&nbsp;</td><td class="rightaligned number"></td><td colspan=2>&nbsp;</td><td class="centeraligned"><?php echo $_SESSION["username"];?></td><td></td></tr>
            </tbody>
        </table>
        <script type="text/javascript" src="/assets/js/simulatorpreviewkwitansi.js"></script>
    </div>
</body>
</html>