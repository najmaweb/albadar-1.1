<html>
    <head>
        <title><?php echo $formtitle;?></title>
        <link rel="stylesheet" href="/assets/css/najma.reports.css" />
    </head>
    <body>
        <div class="topnavcenter"><a href="/reports"><img src="/assets/images/home16.png" /></a></div>
        <h1><?php echo $formtitle;?></h1>
        <h3>Tanggal <?php echo date("d")." ".$humanmonth[removezero(date("m"))]." ".date("Y");?></h3>
        <table class="commonreport">
            <thead>
                <tr><th>No</th><th>Siswa</th><th>SPP</th><th>DU</th><th>Buku</th><th>Bimbel</th></tr>
            </thead>
            <tbody>
            <?php 
                $c = 1;
                $totbook = 0;
                $totspp = 0; 
                $totbimbel = 0; 
                $totdupsb = 0;
                $subbook = 0;
                $subspp = 0; 
                $subbimbel = 0; 
                $subdupsb = 0;
                $grade = "";
            ?>
                <?php foreach($students as $student){?>
                <?php
                if($grade!==$student->grade){
                ?>
                <?php if($grade!==""){?>
                <tr><th class="number"></th><th>Sub Total</th>
                    <th class="number"><?php echo "Rp." . number_format($subspp);?></th>
                    <th class="number"><?php echo "Rp." . number_format($subdupsb);?></th>
                    <th class="number"><?php echo "Rp." . number_format($subbook);?></th>
                    <th class="number"><?php echo "Rp." . number_format($subbimbel);?></th>
                </tr>
                <?php 
                }
                $grade = $student->grade;
                ?>
                <tr><td colspan=5><?php echo $student->grade;?></td></tr>
                <?php
                $subspp = 0;$subdupsb = 0;$subbook = 0;$subbimbel = 0;
                }
                ?>
                <tr><td class="number"><?php echo $c;?></td><td><?php echo $student->nis;?> - <?php echo $student->name;?></td>
                    <td class="number"><?php echo "Rp." . number_format($student->spp);?></td>
                    <td class="number"><?php echo "Rp." . number_format($student->dupsb);?></td>
                    <td class="number"><?php echo "Rp." . number_format($student->book);?></td>
                    <td class="number"><?php echo "Rp." . number_format($student->bimbel);?></td>
                </tr>
                <?php
                $subdupsb+=$student->dupsb;$subbook+=$student->book;$subbimbel+=$student->bimbel;$subspp+=$student->spp;
                $totdupsb+=$student->dupsb;$totbook+=$student->book;$totbimbel+=$student->bimbel;$totspp+=$student->spp;
                ?>
                <?php $c++;?>
                <?}?>
            </tbody>
            <tfoot>
                <tr>
                <th colspan=2>Total</th>
                <th class="number"><?php echo "Rp." . number_format($totspp);?></th>
                <th class="number"><?php echo "Rp." . number_format($tothupsb);?></th>
                <th class="number"><?php echo "Rp." . number_format($totbook);?></th>
                <th class="number"><?php echo "Rp." . number_format($totbimbel);?></th></tr>
            </tfoot>
        </table>
    </body>
</html>