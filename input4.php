<?php
namespace PHPMaker2020\project1;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$input4 = new input4();

// Run the page
$input4->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php

$recordPertama = 1;
$q = "select Nilai from t_parameter where Parameter = 'Metode Perhitungan'";
$metodePerhitungan = ExecuteScalar($q); //echo $metodePerhitungan;
$q = "select Seleksi from t_operator";
$probSeleksi = ExecuteScalar($q); //echo $probSeleksi;
$q = "select CO from t_operator";
$probCO = ExecuteScalar($q); //echo $probSeleksi;
$q = "select Mutasi from t_operator";
$probMutasi = ExecuteScalar($q); //echo $probSeleksi;

// hapus isi tabel t_proses
$q = "delete from t_proses";
Execute($q);

$jumlahPengimpor = "";
$jumlahDepo      = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$jumlahPengimpor  = $_POST["jumlahPengimpor"];
	$jumlahDepo       = $_POST["jumlahDepo"];
	$jumlahKapal      = $jumlahDepo;
	$jumlahDistribusi = $jumlahPengimpor;
	$generasi         = $_POST["generasi"];
	$populasi         = $_POST["populasi"];
	$seleksi          = $_POST["seleksi"];
	$co               = $_POST["co"];
	$mutasi           = $_POST["mutasi"];
}

for ($i = 0; $i < intval($populasi); $i++) {
	for ($j = 0; $j < (intval($jumlahKapal) * intval($jumlahDistribusi)); $j++) {
		$fTampung[$i][$j] = number_format(rand(0, 100)/100, 2);
	}
}

// begin for $loop
for ($loop = 1; $loop <= $generasi; $loop++) {

if (isset($_POST["rawdata"]) and $_POST["rawdata"] == 'show') {

echo "<b>Var Cost</b>"."<br>";
$rvarcost = ExecuteRows("select VarCost from v_hasil");
foreach ($rvarcost as $rs) {
	echo $rs["VarCost"].", ";
}
echo "<br><br>";

echo "<b>TCH</b>"."<br>";
$rtch = ExecuteRows("select TCH from v_hasil");
foreach ($rtch as $rs) {
	echo $rs["TCH"].", ";
}
echo "<br><br>";

echo "<b>Payload</b>"."<br>";
$rpayload = ExecuteRows("select Payload from v_hasil");
foreach ($rpayload as $rs) {
	echo $rs["Payload"].", ";
}
echo "<br><br>";

echo "<b>Sea-Time (jam)</b>"."<br>";
$rsea_time = ExecuteRows("select sea_time from v_hasil");
foreach ($rsea_time as $rs) {
	echo $rs["sea_time"].", ";
}
echo "<br><br>";

echo "<b>Port-Time (jam)</b>"."<br>";
$rport_time = ExecuteRows("select port_time from v_hasil");
foreach ($rport_time as $rs) {
	echo $rs["port_time"].", ";
}
echo "<br><br>";

echo "<b>Roundtrip Days</b>"."<br>";
$rroundtrip_days = ExecuteRows("select roundtrip_days from v_hasil");
foreach ($rroundtrip_days as $rs) {
	echo $rs["roundtrip_days"].", ";
}
echo "<br><br>";

echo "<b>Freq Max by Trip</b>"."<br>";
$rfreqmaxbytrip = ExecuteRows("select freqmaxbytrip from v_hasil");
foreach ($rfreqmaxbytrip as $rs) {
	echo $rs["freqmaxbytrip"].", ";
}
echo "<br><br>";

echo "<b>Freq Max by Cargo</b>"."<br>";
$rfreqmaxbycargo = ExecuteRows("select freqmaxbycargo from v_hasil");
foreach ($rfreqmaxbycargo as $rs) {
	echo $rs["freqmaxbycargo"].", ";
}
echo "<br><br>";

echo "<b>Kromosom</b>"."<br>";
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		echo $fTampung[$k][$l].", ";
	}
	echo "<br>";
}
echo "<br>";

echo "<b>FAA</b><br>";
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		echo ($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]).", ";
		$faa[$k][$l] = ($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]);
	}
	echo "<br>";
}
echo "<br>"; //echo "<br>faa<pre>"; print_r($faa); echo "</pre><br><br>";

echo "<b>Cargo Terangkut</b><br>";
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		echo (($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0])*$rpayload[$l][0]).", ";
		$cargoterangkut[$k][$l] = (($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0])*$rpayload[$l][0]);
	}
	echo "<br>";
}
echo "<br>";

echo "<b>Jumlah Kapal</b><br>";
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		echo ceil(($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) / $rfreqmaxbytrip[$l][0]).", ";
		$jumlahkapal[$k][$l] = ceil(($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) / $rfreqmaxbytrip[$l][0]);
	}
	echo "<br>";
}
echo "<br>";

echo "<b>FC</b><br>";
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		echo (ceil(($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) / $rfreqmaxbytrip[$l][0]) * $rtch[$l][0] * 365).", ";
		$fc[$k][$l] = (ceil(($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) / $rfreqmaxbytrip[$l][0]) * $rtch[$l][0] * 365);
	}
	echo "<br>";
}
echo "<br>";

echo "<b>VC</b><br>";
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		echo
		($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) *
		$rroundtrip_days[$l][0] *
		$rvarcost[$l][0]
		.", ";
		$varcost[$k][$l] =
		($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) *
		$rroundtrip_days[$l][0] *
		$rvarcost[$l][0];
	}
	echo "<br>";
}
echo "<br>";

echo "<b>Total Cost</b><br>";
for ($k = 0;$k < $i; $k++) {
	$tc = 0;
	for ($l = 0;$l < $j; $l++) {
		/*echo
		(round(($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) / $rfreqmaxbytrip[$l][0]) * $rtch[$l][0] * 365)
		+
		(($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) *
		$rroundtrip_days[$l][0] *
		$rvarcost[$l][0])
		.", ";*/
		$tc = $tc + (ceil(($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) / $rfreqmaxbytrip[$l][0]) * $rtch[$l][0] * 365)
		+
		(($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) *
		$rroundtrip_days[$l][0] *
		$rvarcost[$l][0]);
	}
	echo $tc.", ";
	$total_tc[$k] = $tc;
	echo "<br>";
}
echo "<br>";

$cf = 0;
echo "<b>Total Cargo</b><br>";
for ($k = 0;$k < $i; $k++) {
	$cf = 0;
	for ($l = 0;$l < $j; $l++) {
		$cf = $cf + (($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0])*$rpayload[$l][0]);
		if ($l % $jumlahKapal == ($jumlahKapal - 1)) {
			//echo $cf.", ";
			//$cf = 0;
		}
	}
	echo $cf.", ";
	$total_cf[$k] = $cf;
	echo "<br>";
}
echo "<br>";

echo "<b>Nilai Fitness</b><br>";
$total_fitness = 0;
for ($k = 0;$k < $i; $k++) {
	//for ($l = 0;$l < $j; $l++) {
		echo (100000000 / ($total_tc[$k] + $total_cf[$k])).", ";
		$fitness[$k] = (100000000 / ($total_tc[$k] + $total_cf[$k]));
		$total_fitness += $fitness[$k];
	//}
	echo "<br>";
}
echo "<br>";

echo "<b>Individu Optimum (".($metodePerhitungan == 'max' ? 'Max' : 'Min')."(Fitness))</b><br>";
echo " ".($metodePerhitungan == 'max' ? max($fitness) : min($fitness))."<br><br>";
//print_r($fitness);
$index_key = array_keys($fitness, ($metodePerhitungan == 'max' ? max($fitness) : min($fitness)));
echo "<b>Populasi ke</b><br>".($index_key[0]+1)."<br><br>";
//var_dump($index_key);

// buang 3 terendah, direplace dengan individu optimum
echo "<b>Hasil Seleksi</b><br>";
for ($terendah = 0; $terendah < 3; $terendah++) {
	// ambil index key array
	$minimum = array_keys($fitness, min($fitness));

	// buang array fitness dan kromosom berdasarkan index key
	unset($fitness[$minimum[0]]);
	unset($fTampung[$minimum[0]]);

	// replace dengan individu momentum
	$fitness[$minimum[0]] = $fitness[$index_key[0]];
	$fTampung[$minimum[0]] = $fTampung[$index_key[0]];
}
for ($k = 0;$k < $i; $k++) {
		//for ($l = 0;$l < $j; $l++) {
			echo $fitness[$k].", ";
		//}
		echo "<br>";
	}
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		echo $fTampung[$k][$l].", ";
	}
	echo "<br>";
}
echo "<br>";

// crossover
$kSel = $fTampung;
$aSatu = array();
$aDua  = array();
echo "<b>Hasil Crossover</b><br>";
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		if ($l <= 4 and $k % 2 == 0) {
			$aSatu[$l] = $fTampung[$k][$l];
		}
		if ($l <= 4 and $k % 2 == 1) {
			$aDua[$l] = $fTampung[$k][$l];
		}
	}
	if ($k % 2 == 0) {
		//echo "<pre>"; echo "aSatu"; print_r($aSatu); echo "</pre><br>";
	}
	if ($k % 2 == 1) {
		//echo "<pre>"; echo "aDua"; print_r($aDua); echo "</pre><br>";
		for ($x = 0; $x < count($aSatu); $x++) {
			$kSel[$k][$x] = $aSatu[$x];
			$kSel[$k-1][$x] = $aDua[$x];
		}
		$aSatu = array();
		$aDua  = array();
	}
}
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		echo $kSel[$k][$l].", ";
	}
	echo "<br>";
}
echo "<br>";

//mutasi
$kMutasi = $kSel;
$arMutasi = array();
$jumlahMutasi = $jumlahKapal * $jumlahDistribusi * $populasi; //echo $jumlahMutasi;
for ($m = 0;$m < $jumlahMutasi; $m++) {
	$arMutasi[$m] = $m;
}
//echo "<pre>";
shuffle($arMutasi);
//print_r($arMutasi);
//echo "</pre>";

echo "<b>Mutasi Point</b><br>";
for ($n = 0;$n < ($jumlahMutasi * $mutasi); $n++) {
	$posisi = $arMutasi[$n];
	echo $posisi.", ";
	$posisiPop = intval($posisi/($jumlahKapal * $jumlahDistribusi));
	$posisiGen = $posisi % ($jumlahKapal * $jumlahDistribusi);
	$kMutasi[$posisiPop][$posisiGen] = $kMutasi[$posisiPop][$posisiGen] + 0.01;
	if ($kMutasi[$posisiPop][$posisiGen] == 1) {
		$kMutasi[$posisiPop][$posisiGen] = 0.01;
	}
}
echo "<br><br>";

echo "<b>Hasil Mutasi</b><br>";
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		echo $kMutasi[$k][$l].", ";
	}
	echo "<br>";
}
echo "<br>";

$fTampung = $kMutasi;

}




else { // ---------------------------------------------------------------------------




//echo "<b>Var Cost</b>"."<br>";
$rvarcost = ExecuteRows("select VarCost from v_hasil");
foreach ($rvarcost as $rs) {
	//echo $rs["VarCost"].", ";
}
//echo "<br><br>";

//echo "<b>TCH</b>"."<br>";
$rtch = ExecuteRows("select TCH from v_hasil");
foreach ($rtch as $rs) {
	//echo $rs["TCH"].", ";
}
//echo "<br><br>";

//echo "<b>Payload</b>"."<br>";
$rpayload = ExecuteRows("select Payload from v_hasil");
foreach ($rpayload as $rs) {
	//echo $rs["Payload"].", ";
}
//echo "<br><br>";

//echo "<b>Sea-Time (jam)</b>"."<br>";
$rsea_time = ExecuteRows("select sea_time from v_hasil");
foreach ($rsea_time as $rs) {
	//echo $rs["sea_time"].", ";
}
//echo "<br><br>";

//echo "<b>Port-Time (jam)</b>"."<br>";
$rport_time = ExecuteRows("select port_time from v_hasil");
foreach ($rport_time as $rs) {
	//echo $rs["port_time"].", ";
}
//echo "<br><br>";

//echo "<b>Roundtrip Days</b>"."<br>";
$rroundtrip_days = ExecuteRows("select roundtrip_days from v_hasil");
foreach ($rroundtrip_days as $rs) {
	//echo $rs["roundtrip_days"].", ";
}
//echo "<br><br>";

//echo "<b>Freq Max by Trip</b>"."<br>";
$rfreqmaxbytrip = ExecuteRows("select freqmaxbytrip from v_hasil");
foreach ($rfreqmaxbytrip as $rs) {
	//echo $rs["freqmaxbytrip"].", ";
}
//echo "<br><br>";

//echo "<b>Freq Max by Cargo</b>"."<br>";
$rfreqmaxbycargo = ExecuteRows("select freqmaxbycargo from v_hasil");
foreach ($rfreqmaxbycargo as $rs) {
	//echo $rs["freqmaxbycargo"].", ";
}
//echo "<br><br>";

//echo "<b>Kromosom</b>"."<br>";
	/*for ($i = 0; $i < intval($populasi); $i++) {
		for ($j = 0; $j < (intval($jumlahKapal) * intval($jumlahDistribusi)); $j++) {
			$fTampung[$i][$j] = number_format(rand(0, 100)/100, 2);
		}
	}*/

	for ($k = 0;$k < $i; $k++) {
		for ($l = 0;$l < $j; $l++) {
			//echo $fTampung[$k][$l].", ";
		}
		//echo "<br>";
	}
//echo "<br>";

//echo "<b>FAA</b><br>";
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		//echo ($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]).", ";
		$faa[$k][$l] = ($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]);
	}
	//echo "<br>";
}
//echo "<br>"; //echo "<br>faa<pre>"; print_r($faa); echo "</pre><br><br>";

//echo "<b>Cargo Terangkut</b><br>";
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		//echo (($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0])*$rpayload[$l][0]).", ";
		$cargoterangkut[$k][$l] = (($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0])*$rpayload[$l][0]);
	}
	//echo "<br>";
}
//echo "<br>";

//echo "<b>Jumlah Kapal</b><br>";
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		//echo ceil(($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) / $rfreqmaxbytrip[$l][0]).", ";
		$jumlahkapal[$k][$l] = ceil(($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) / $rfreqmaxbytrip[$l][0]);
	}
	//echo "<br>";
}
//echo "<br>";

//echo "<b>FC</b><br>";
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		//echo (ceil(($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) / $rfreqmaxbytrip[$l][0]) * $rtch[$l][0] * 365).", ";
		$fc[$k][$l] = (ceil(($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) / $rfreqmaxbytrip[$l][0]) * $rtch[$l][0] * 365);
	}
	//echo "<br>";
}
//echo "<br>";

//echo "<b>VC</b><br>";
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		/*echo
		($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) *
		$rroundtrip_days[$l][0] *
		$rvarcost[$l][0]
		.", ";*/
		$varcost[$k][$l] =
		($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) *
		$rroundtrip_days[$l][0] *
		$rvarcost[$l][0];
	}
	//echo "<br>";
}
//echo "<br>";

//echo "<b>Total Cost</b><br>";
for ($k = 0;$k < $i; $k++) {
	$tc = 0;
	for ($l = 0;$l < $j; $l++) {
		/*echo
		(round(($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) / $rfreqmaxbytrip[$l][0]) * $rtch[$l][0] * 365)
		+
		(($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) *
		$rroundtrip_days[$l][0] *
		$rvarcost[$l][0])
		.", ";*/
		$tc = $tc + (ceil(($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) / $rfreqmaxbytrip[$l][0]) * $rtch[$l][0] * 365)
		+
		(($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0]) *
		$rroundtrip_days[$l][0] *
		$rvarcost[$l][0]);
		
	}
	//echo $tc.", ";
	$total_tc[$k] = $tc;
	//echo "<br>";
}
//echo "<br>";

$cf = 0;
//echo "<b>Total Cargo</b><br>";
for ($k = 0;$k < $i; $k++) {
	$cf = 0;
	for ($l = 0;$l < $j; $l++) {
		$cf = $cf + (($fTampung[$k][$l]*$rfreqmaxbytrip[$l][0])*$rpayload[$l][0]);
		if ($l % $jumlahKapal == ($jumlahKapal - 1)) {
			//echo $cf.", ";
			//$cf = 0;
		}
	}
	//echo $cf.", ";
	$total_cf[$k] = $cf;
	//echo "<br>";
}
//echo "<br>";

//echo "<b>Nilai Fitness</b><br>";
$total_fitness = 0;
for ($k = 0;$k < $i; $k++) {
	//for ($l = 0;$l < $j; $l++) {
		//echo (1000000 / ($total_tc[$k] + $total_cf[$k])).", ";
		$fitness[$k] = (1000000 / ($total_tc[$k] + $total_cf[$k]));
		$total_fitness += $fitness[$k];
	//}
	//echo "<br>";
}
//echo "<br>";

//echo "<b>Individu Optimum</b><br>";
//echo max($fitness)."<br><br>";
//print_r($fitness);
//$index_key = array_keys($fitness, max($fitness));
$index_key = array_keys($fitness, ($metodePerhitungan == 'max' ? max($fitness) : min($fitness)));
//var_dump($index_key);
//echo $index_key[0]."<br>";
//var_dump($index_key);

// buang 3 terendah, direplace dengan individu optimum
//echo "<b>Hasil Seleksi</b><br>";
for ($terendah = 0; $terendah < 3; $terendah++) {
	// ambil index key array
	$minimum = array_keys($fitness, min($fitness));

	// buang array fitness dan kromosom berdasarkan index key
	unset($fitness[$minimum[0]]);
	unset($fTampung[$minimum[0]]);

	// replace dengan individu momentum
	$fitness[$minimum[0]] = $fitness[$index_key[0]];
	$fTampung[$minimum[0]] = $fTampung[$index_key[0]];
}

// crossover
$kSel = $fTampung;
$aSatu = array();
$aDua  = array();
//echo "<b>Hasil Crossover</b><br>";
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		if ($l <= 4 and $k % 2 == 0) {
			$aSatu[$l] = $fTampung[$k][$l];
		}
		if ($l <= 4 and $k % 2 == 1) {
			$aDua[$l] = $fTampung[$k][$l];
		}
	}
	if ($k % 2 == 0) {
		//echo "<pre>"; echo "aSatu"; print_r($aSatu); echo "</pre><br>";
	}
	if ($k % 2 == 1) {
		//echo "<pre>"; echo "aDua"; print_r($aDua); echo "</pre><br>";
		for ($x = 0; $x < count($aSatu); $x++) {
			$kSel[$k][$x] = $aSatu[$x];
			$kSel[$k-1][$x] = $aDua[$x];
		}
		$aSatu = array();
		$aDua  = array();
	}
}
//echo "<br>";
/*for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		echo $kSel[$k][$l].", ";
	}
	echo "<br>";
}
echo "<br>";*/

//mutasi
$kMutasi = $kSel;
$arMutasi = array();
$jumlahMutasi = $jumlahKapal * $jumlahDistribusi * $populasi; //echo $jumlahMutasi;
for ($m = 0;$m < $jumlahMutasi; $m++) {
	$arMutasi[$m] = $m;
}
//echo "<pre>";
shuffle($arMutasi);
//print_r($arMutasi);
//echo "</pre>";

//echo "<b>Mutasi Point</b><br>";
for ($n = 0;$n < ($jumlahMutasi * $mutasi); $n++) {
	$posisi = $arMutasi[$n];
	//echo $posisi.", ";
	$posisiPop = intval($posisi/($jumlahKapal * $jumlahDistribusi));
	$posisiGen = $posisi % ($jumlahKapal * $jumlahDistribusi);
	$kMutasi[$posisiPop][$posisiGen] = $kMutasi[$posisiPop][$posisiGen] + 0.01;
	if ($kMutasi[$posisiPop][$posisiGen] == 1) {
		$kMutasi[$posisiPop][$posisiGen] = 0.01;
	}
}
//echo "<br><br>";

//echo "<b>Hasil Mutasi</b><br>";
for ($k = 0;$k < $i; $k++) {
	for ($l = 0;$l < $j; $l++) {
		//echo $kMutasi[$k][$l].", ";
	}
	//echo "<br>";
}
//echo "<br>";

$fTampung = $kMutasi;

}
// end if rawdata

// simpan ke tabel, dengan cara seleksi
$q = "insert into
	t_proses
	(TotalCost, TotalCargo, Fitness, Kromosom, Generasi)
	values
	(";
	if ($recordPertama == 1) {
		$recordPertama = 2;
		$total_tcAcuan = $total_tc[$index_key[0]];
		$total_cfAcuan = $total_cf[$index_key[0]];
		$fitnessAcuan  = ($metodePerhitungan == 'max' ? max($fitness) : min($fitness));
		$kromosomAcuan = serialize($fTampung[$index_key[0]]);
	}
	else {
		if ($metodePerhitungan == 'max') {
			if ($fitness[$index_key[0]] > $fitnessAcuan) {
				$total_tcAcuan = $total_tc[$index_key[0]];
				$total_cfAcuan = $total_cf[$index_key[0]];
				$fitnessAcuan  = ($metodePerhitungan == 'max' ? max($fitness) : min($fitness));
				$kromosomAcuan = serialize($fTampung[$index_key[0]]);
			}
			else {
			}
		}
		else {
			if ($fitness[$index_key[0]] > $fitnessAcuan) {
			}
			else {
				$total_tcAcuan = $total_tc[$index_key[0]];
				$total_cfAcuan = $total_cf[$index_key[0]];
				$fitnessAcuan  = ($metodePerhitungan == 'max' ? max($fitness) : min($fitness));
				$kromosomAcuan = serialize($fTampung[$index_key[0]]);
			}
		}
	}
	$q = $q . $total_tcAcuan.", ".$total_cfAcuan.", ".$fitnessAcuan.", '".$kromosomAcuan."', ".$loop.")";

Execute($q); //echo $q;
}
// end for $loop

?>

		  <div class="row">

			<div class="col-sm-4">
				<!-- Jumlah Titik Jaringan (Himpunan Jaringan) -->
				<div class="card mb-3">
					<div class="card-header">
						Kromosom GA
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-4">
								<div class="p-2">
									<form method="POST" action="input5.php">
									<input type="hidden" name="token" value="<?php echo CurrentPage()->Token ?>">
									<div class="form-group row">Jumlah Kapal
										<input type="text" name="jumlahDepo" value="<?php echo $jumlahDepo; ?>" class="form-control form-control-user" id="jumlahDepo" placeholder="" value="<?php echo ExecuteScalar('select count(id) from t_kapal0'); ?>" readonly>
									</div>
									<div class="form-group row">Jumlah Distribusi
										<input type="text" name="jumlahPengimpor" value="<?php echo $jumlahPengimpor; ?>" class="form-control form-control-user" id="jumlahPengimpor" placeholder="" value="<?php echo ExecuteScalar('select count(id) from t_distribusi'); ?>" readonly>
									</div>
									<!-- <div class="form-group row">Jumlah Storage
										<input type="text" name="jumlahStorage" value="<?php echo $jumlahStorage; ?>" class="form-control form-control-user" id="jumlahStorage" placeholder="" readonly>
									</div>
									<div class="form-group row">Jumlah Tipe Tanker
										<input type="text" name="jumlahTipe" value="<?php echo $jumlahTipe; ?>" class="form-control form-control-user" id="jumlahTipeTanker" placeholder="" readonly>
									</div> -->
									<hr>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-4">
				<!-- Jumlah Titik Jaringan (Himpunan Jaringan) -->
				<div class="card mb-3">
					<div class="card-header">
						Operator GA
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-4">
								<div class="p-2">
										<div class="form-group row">Generasi
											<input type="text" name="generasi" class="form-control form-control-user" id="jumlahDepo" placeholder="" value="<?php echo $generasi; ?>" readonly>
										</div>
										<div class="form-group row">Populasi
											<input type="text" name="populasi" class="form-control form-control-user" id="jumlahDepo" placeholder="" value="<?php echo $populasi; ?>" readonly>
										</div>
										<div class="form-group row">Prob. Seleksi
											<input type="text" name="seleksi" class="form-control form-control-user" id="jumlahPengimpor" placeholder="" value="<?php echo $seleksi; ?>" readonly>
										</div>
										<div class="form-group row">Prob. CO
											<input type="text" name="co" class="form-control form-control-user" id="jumlahPengimpor" placeholder="" value="<?php echo $co; ?>" readonly>
										</div>
										<div class="form-group row">Prob. Mutasi
											<input type="text" name="mutas" class="form-control form-control-user" id="jumlahPengimpor" placeholder="" value="<?php echo $mutasi; ?>" readonly>
										</div>
										<!-- <div class="form-group row">Jumlah Tipe Tanker
											<input type="text" name="jumlahTipe" class="form-control form-control-user" id="jumlahTipeTanker" placeholder="">
										</div> -->
										<hr>
										<!-- <input type="submit" class="btn btn-primary" type="submit" name="proses1" value="Proses"> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<?php if ($jumlahKapal > 0 or $jumlahDistribusi > 0) { ?>
			
			<!-- proses ketiga -->
			<div class="col-sm-12">
				<div class="card mb-3">
					<div class="card-header">
						Individu Optimum
					</div>
					<div class="card-body">
					
						<div class="row">
							
							<!-- tabel 1           -->
							<!-- baris = pengimpor -->
							<!-- kolom = depo      -->
							<?php if ($jumlahDistribusi > 0) { ?>

								<!-- kolom i1, i2, in -->
								<!-- kolom pertama -->
								<div class="col-sm-1">
									<div class="p-2">
										<div class="form-group row">
											<input type="text" name="t1_A1" value="" class="form-control form-control-user" size="2" readonly>
										</div>
										<?php for ($i = 1; $i <= $jumlahDistribusi; $i++) { ?>
										<div class="form-group row">
											<input type="text" name="t1_A<?php echo $i+1; ?>" value="d<?php echo $i; ?>" class="form-control form-control-user" size="2" readonly>
										</div>
										<?php } ?>
										<div class="form-group row">
											<input type="text" name="t1_A<?php echo $i+1; ?>" value="" class="form-control form-control-user" size="2" readonly>
										</div>
									</div>
								</div>
								
								<!-- kolom d1, d2, dn -->
								<!-- kolom kedua, kolom_n-1 -->
								<?php for ($d = 1; $d <= $jumlahKapal; $d++) { ?>
								<?php $row = 1; ?>
								<div class="col-sm-1">
									<div class="p-2">
										<div class="form-group row">
											<input type="text" name="t1_<?php echo chr(65+$d).$row++; ?>" value="k<?php echo $d; ?>" class="form-control form-control-user" size="2" readonly>
										</div>
										<?php for ($i = 1; $i <= $jumlahDistribusi; $i++) { ?>
										<div class="form-group row">
											<input type="text" name="t1_<?php echo chr(65+$d).$row++; ?>" value="<?php echo $fTampung[$index_key[0]][(($jumlahKapal * $i)-$jumlahKapal)+($d-1)]; ?>" class="form-control form-control-user" size="2">
										</div>
										<?php } ?>
										<div class="form-group row">
											<input type="text" name="t1_<?php echo chr(65+$d).$row++; ?>" value="<?php echo $rpayload[$d][0]?>" class="form-control form-control-user" size="2" readonly>
										</div>
									</div>
								</div>
								<?php } ?>
								
								<!-- kolom terakhir -->
								<div class="col-sm-1">
									<div class="p-2">
										<div class="form-group row">
											<?php $row = 1; ?>
											<input type="text" name="t1_<?php echo chr(65+$d).$row++; ?>" value="" class="form-control form-control-user" size="10" readonly>
										</div>
										<?php $q = "select Nilai from t_parameter where Parameter = 'Demand'"; $demand = ExecuteScalar($q); ?>
										<?php for ($i = 1; $i <= $jumlahDistribusi; $i++) { ?>
										<div class="form-group row">
											<input type="text" name="t1_<?php echo chr(65+$d).$row++; ?>" value="<?php echo number_format($demand); ?>" class="form-control form-control-user" size="10" readonly>
										</div>
										<?php } ?>
										<div class="form-group row">
											<input type="text" name="t1_<?php echo chr(65+$d).$row++; ?>" value="" class="form-control form-control-user" size="10" readonly>
										</div>
									</div>
								</div>
								
							<?php } ?>
							<!-- end of tabel 1    -->
							
						</div>
					</div>
				</div>
			</div>
			<!-- end of proses ketiga -->
			
			<div class="col-sm-12">
				<div class="card mb-3">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-3">
								<div class="p-2">
									<!-- <button class="btn btn-primary" type="submit" name="proses2">Proses</button> -->
									<a href="input.php" class="btn btn-primary btn-icon-split">
										<span class="icon text-white-50">
											<i class="fas fa-arrow-left"></i>
										</span>
										<span class="text">Back</span>
									</a>
									<a href="Report1smry.php" class="btn btn-primary btn-icon-split">
										<span class="text">Grafik</span>
									</a>
									<!-- <input type="submit" class="btn btn-primary" type="submit" name="proses3" value="Hitung Fitness"> -->
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php }?>
			
		  </div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$input4->terminate();
?>