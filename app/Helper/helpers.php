<?php 
use Illuminate\Support\Facades\DB;

function rupiah($angka){	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	echo $hasil_rupiah;
}
