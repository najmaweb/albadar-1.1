<!-- left, vertical navbar -->
<div class="col-md-2 bootstrap-admin-col-left">
    <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
        <li class="<?php echo ($feedData==='about')?'active':'';?>">
            <a href="/about"><i class="glyphicon glyphicon-chevron-right"></i> About</a>
        </li>
        <li class="<?php echo ($feedData==='kelas')?'active':'';?>">
            <a href="/grades"><i class="glyphicon glyphicon-chevron-right"></i> Kelas</a>
        </li>
        <li class="<?php echo ($feedData==='sppgroup')?'active':'';?>">
            <a href="/Sppgroups"><i class="glyphicon glyphicon-chevron-right"></i> Grup SPP</a>
        </li>
        <li class="<?php echo ($feedData==='bimbelgroup')?'active':'';?>">
            <a href="/Bimbelgroups"><i class="glyphicon glyphicon-chevron-right"></i> Grup Bimbel</a>
        </li>
        <li class="<?php echo ($feedData==='dupsbgroup')?'active':'';?>">
            <a href="/Dupsbgroups"><i class="glyphicon glyphicon-chevron-right"></i> Grup DU/PSB</a>
        </li>
        <li class="<?php echo ($feedData==='bookpaymentgroup')?'active':'';?>">
            <a href="/Bookpaymentgroups"><i class="glyphicon glyphicon-chevron-right"></i> Grup Pemb. Buku</a>
        </li>
        <li class="<?php echo ($feedData==='siswa')?'active':'';?>">
            <a href="/students"><i class="glyphicon glyphicon-chevron-right"></i> Siswa</a>
        </li>
        <li class="<?php echo ($feedData==='cashier')?'active':'';?>">
            <a href="/cashier"><i class="glyphicon glyphicon-chevron-right"></i> Pembayaran</a>
        </li>
        <li class="<?php echo ($feedData==='report')?'active':'';?>">
            <a href="/reports/index"><i class="glyphicon glyphicon-chevron-right"></i> Laporan</a>
        </li>
        <li class="<?php echo ($feedData==='settings')?'active':'';?>">
            <a href="/settings"><i class="glyphicon glyphicon-chevron-right"></i> Setting</a>
        </li>
        <?php if($role==="1"){?>
        <li class="<?php echo ($feedData==='user')?'active':'';?>">
            <a href="/users"><i class="glyphicon glyphicon-chevron-right"></i> User</a>
        </li>
        <?php }?>
    </ul>
</div>
