<html>
    <head>
        <title><?php echo $formtitle;?></title>
        <link rel="stylesheet" href="/assets/css/najma.reports.css" />
    </head>
    <body>
        <h1><?php echo $formtitle;?></h1>
        <h3>Tahun ajaran <?php echo date("Y")?>/<?php echo date("Y")+1?></h3>
        <table class="commonreport">
            <thead>
                <tr><th>No</th><th>NIS</th><th>Nama</th><th>Jumlah Terbayar</th><th>Kekurangan</th></tr>
            </thead>
            <tbody>
            <?php 
                $c = 1;
                $tot = 0;$sisa = 0;
                $lastgrade = "";
                $gradetot = 0;
                $gradetot = 0;
                $gradesisa = 0;
            ?>
            <?php foreach($rekapdu as $rkd){?>
                <?php 
                    $grade = $rkd->grade;
                    if(($grade != $lastgrade)){
                ?>
                <?php if(($lastgrade!="")){?>
                <tr class="subtotal">
                    <td colspan="3">Total DU/PSB Kelas <?php echo $lastgrade;?></td>
                    <td class="number"><?php echo "Rp." . number_format($gradetot);?></td>
                    <td class="number"><?php echo "Rp." . number_format($gradesisa);?></td>
                </tr>
                <?php }?>
                <tr class="subhead1"><td colspan="5"><?php echo "Kelas " . $grade;?></td></tr>
                <?php
                        $gradetot = $rkd->tot;
                        $gradesisa = $rkd->sisa;
                    }else{
                        $gradetot+=$rkd->tot;
                        $gradesisa+=$rkd->sisa;
                    }
                ?>
                <tr>
                    <td class="number"><?php echo $c;?></td>
                    <td class="number"><?php echo $rkd->nis;?></td>
                    <td><?php echo $rkd->name;?></td>
                    <td class="number"><?php echo "Rp." . number_format($rkd->tot);?></td>
                    <td class="number"><?php echo "Rp." . number_format($rkd->sisa);?></td>
                </tr>
                <?php
                    $lastgrade = $grade;
                    $tot+= $rkd->tot; 
                    $sisa+= $rkd->sisa;
                    $c++;
                ?>
                <?php }?>
                <tr class="subtotal">
                <td colspan="3">Total DU/PSB Kelas <?php echo $lastgrade;?></td>
                <td class="number"><?php echo "Rp." . number_format($gradetot);?></td>
                <td class="number"><?php echo "Rp." . number_format($gradesisa);?></td>
                </tr>            
            </tbody>
            <tfoot>
                <tr>
                <td>Total</td>
                <td></td>
                <td></td>
                <td class="number"><?php echo "Rp." . number_format($tot);?></td>
                <td class="number"><?php echo "Rp." . number_format($sisa);?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>