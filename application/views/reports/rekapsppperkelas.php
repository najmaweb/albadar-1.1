<html>
    <head>
        <title><?php echo $formtitle;?></title>
        <link rel="stylesheet" href="/assets/css/report/rekapsppperkelas.css" />
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
                <?php 
                    $c = 1;
                    $lastgrade = "";$grade = "";
                    foreach($montharray as $month){
                        $submonth = "sub".$month;
                        $$submonth = "";
                    }
                ?>
                <?php foreach($objs as $obj){?>
                <?php 
                    
                    if(($grade != $obj->grade)){
                        $lastgrade = $grade;
                        if($grade !==""){
                ?>
                <tr>
                    <td colspan=2>Total </td>
                    <?php
                    foreach($montharray as $month){
                        $submonth = "sub".$month;
                        ?>
                        <td class="number"><?php echo number_format($$submonth);?></td>
                        <?php
                    }
                    ?>
                </tr>
                <?php 
                            foreach($montharray as $month){
                                $submonth = "sub".$month;
                                $$submonth = "";
                            }
                        }
                        $grade = $obj->grade;
                ?>
                <tr>
                    <td colspan="14" class="grouphead">
                    Kelas <?php echo $grade;?>
                    </td>
                </tr>
                <?php
                    }
                ?>
                <tr>
                    <td class="number"><?php echo $c;?></td>
                    <td class="left"><?php echo '(' . $obj->nis . ')' . $obj->name;?></td>
                    <?php
                    foreach($montharray as $month){
                        ?>
                        <td class="number"><?php echo number_format($obj->$month);?></td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
                    foreach($montharray as $month){
                        $submonth = "sub".$month;
                        $$submonth += $obj->$month;
                    }
                ?>
                <?php $c = $c + 1;?>
                <?php }?>
            </tbody>
            <tfoot>
                <tr>
                <td colspan=3>Total</td>
                <td colspan=2 class="number"><?php echo "Rp." . number_format($spptotal+$bimbeltotal);?></td>
                <td></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>