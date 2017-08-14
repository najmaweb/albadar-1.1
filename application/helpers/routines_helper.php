<?php
$clear_tables = "delete from spp;delete from bimbel;delete from dupsb;alter table spp auto_increment=1;alter table bimbel auto_increment=1;alter table pembayaranbuku auto_increment=1;"; 
$clear_tables = "delete from spp;";
$clear_tables.= "delete from bimbel;"; 
$clear_tables.= "delete from dupsb"; 
$clear_tables.= "alter table spp auto_increment=1;"; 
$clear_tables.= "alter table bimbel auto_increment=1;"; 
$clear_tables.= "alter table pembayaranbuku auto_increment=1;"; 
