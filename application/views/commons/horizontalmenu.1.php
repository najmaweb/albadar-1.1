<!-- left, vertical navbar -->
<div class="col-md-2 bootstrap-admin-col-left">
    <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
        <li class="<?php echo ($feedData==='about')?'active':'';?>">
            <a href="/about"><i class="glyphicon glyphicon-chevron-right"></i> About</a>
        </li>
        <li class="<?php echo ($feedData==='dashboard')?'active':'';?>">
            <a href="/dashboard"><i class="glyphicon glyphicon-chevron-right"></i> Dashboard</a>
        </li>
        <li class="<?php echo ($feedData==='guru')?'active':'';?>">
            <a href="/teachers"><i class="glyphicon glyphicon-chevron-right"></i> Guru</a>
        </li>
        <li class="<?php echo ($feedData==='kelas')?'active':'';?>">
            <a href="/grades"><i class="glyphicon glyphicon-chevron-right"></i> Kelas</a>
        </li>
        <li class="<?php echo ($feedData==='Sppgroups')?'active':'';?>">
            <a href="/Sppgroups"><i class="glyphicon glyphicon-chevron-right"></i> Grup SPP</a>
        </li>
        <li class="<?php echo ($feedData==='siswa')?'active':'';?>">
            <a href="/students"><i class="glyphicon glyphicon-chevron-down"></i> Siswa</a>
            <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                <li><a href="about.html"><i class="glyphicon glyphicon-chevron-right"></i> Kelas 1</a></li>
                <li><a href="about.html"><i class="glyphicon glyphicon-chevron-right"></i> Kelas 2</a></li>
                <li><a href="about.html"><i class="glyphicon glyphicon-chevron-right"></i> Kelas 3</a></li>
            </ul>
        </li>
        <li class="<?php echo ($feedData==='fees')?'active':'';?>">
            <a href="/fees"><i class="glyphicon glyphicon-chevron-right"></i> Biaya Pendidikan</a>
        </li>
        <li class="<?php echo ($feedData==='cashier')?'active':'';?>">
            <a href="/cashier"><i class="glyphicon glyphicon-chevron-right"></i> Pembayaran</a>
        </li>
    </ul>
</div>
