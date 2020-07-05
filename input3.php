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
$input3 = new input3();

// Run the page
$input3->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php
$jumlahPengimpor = "";
//$jumlahStorage   = "";
$jumlahDepo      = "";
//$jumlahTipe      = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$jumlahPengimpor = $_POST["jumlahPengimpor"]; // jumlah distrbusi
	//$jumlahStorage   = $_POST["jumlahStorage"];
	$jumlahDepo      = $_POST["jumlahDepo"]; // jumlah kapal
	//$jumlahTipe      = $_POST["jumlahTipe"];
	//$pengimpor       = $_POST["pengimpor"];
	//$storage         = $_POST["storage"];
	//$depo            = $_POST["depo"];
	//$tipe            = $_POST["tipe"];
}
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
									<form method="POST" action="input4.php">
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
											<input type="text" name="generasi" class="form-control form-control-user" id="jumlahDepo" placeholder="" value="<?php echo ExecuteScalar('select Generasi from t_operator'); ?>">
										</div>
										<div class="form-group row">Populasi
											<input type="text" name="populasi" class="form-control form-control-user" id="jumlahDepo" placeholder="" value="<?php echo ExecuteScalar('select Populasi from t_operator'); ?>">
										</div>
										<div class="form-group row">Prob. Seleksi
											<input type="text" name="seleksi" class="form-control form-control-user" id="jumlahPengimpor" placeholder="" value="<?php echo ExecuteScalar('select Seleksi from t_operator'); ?>">
										</div>
										<div class="form-group row">Prob. CO
											<input type="text" name="co" class="form-control form-control-user" id="jumlahPengimpor" placeholder="" value="<?php echo ExecuteScalar('select CO from t_operator'); ?>">
										</div>
										<div class="form-group row">Prob. Mutasi
											<input type="text" name="mutasi" class="form-control form-control-user" id="jumlahPengimpor" placeholder="" value="<?php echo ExecuteScalar('select Mutasi from t_operator'); ?>">
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
			
			<?php if ($jumlahPengimpor > 0 or $jumlahDepo > 0) { ?>
			
			<!-- proses ketiga -->
			<div class="col-sm-12">
				<div class="card mb-3">
					<div class="card-body">
					
						<div class="row">
							
							<!-- tabel 1           -->
							<!-- baris = pengimpor -->
							<!-- kolom = depo      -->
							<?php if ($jumlahPengimpor > 0) { ?>

								<!-- kolom i1, i2, in -->
								<!-- kolom pertama -->
								<div class="col-sm-1">
									<div class="p-2">
										<div class="form-group row">
											<input type="text" name="t1_A1" value="" class="form-control form-control-user" size="2" readonly>
										</div>
										<?php for ($i = 1; $i <= $jumlahPengimpor; $i++) { ?>
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
								<?php for ($d = 1; $d <= $jumlahDepo; $d++) { ?>
								<?php $row = 1; ?>
								<div class="col-sm-1">
									<div class="p-2">
										<div class="form-group row">
											<input type="text" name="t1_<?php echo chr(65+$d).$row++; ?>" value="k<?php echo $d; ?>" class="form-control form-control-user" size="2" readonly>
										</div>
										<?php for ($i = 1; $i <= $jumlahPengimpor; $i++) { ?>
										<div class="form-group row">
											<input type="text" name="t1_<?php echo chr(65+$d).$row++; ?>" value="" class="form-control form-control-user" size="2">
										</div>
										<?php } ?>
										<div class="form-group row">
											<input type="text" name="t1_<?php echo chr(65+$d).$row++; ?>" class="form-control form-control-user" size="2" readonly>
										</div>
									</div>
								</div>
								<?php } ?>
								
								<!-- kolom terakhir -->
								<div class="col-sm-1">
									<div class="p-2">
										<div class="form-group row">
											<?php $row = 1; ?>
											<input type="text" name="t1_<?php echo chr(65+$d).$row++; ?>" value="" class="form-control form-control-user" size="2" readonly>
										</div>
										<?php for ($i = 1; $i <= $jumlahPengimpor; $i++) { ?>
										<div class="form-group row">
											<input type="text" name="t1_<?php echo chr(65+$d).$row++; ?>" class="form-control form-control-user" size="2" readonly>
										</div>
										<?php } ?>
										<div class="form-group row">
											<input type="text" name="t1_<?php echo chr(65+$d).$row++; ?>" value="" class="form-control form-control-user" size="2" readonly>
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
									<input type="checkbox" name="rawdata" value="show" checked>&nbsp;<label> Show Raw Data </label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<div class="p-2">
									<!-- <button class="btn btn-primary" type="submit" name="proses2">Proses</button> -->
									<!-- <a href="#" class="btn btn-primary btn-icon-split" onClick="history.go(-1); return false;"> -->
									<a href="input.php" class="btn btn-primary btn-icon-split">
										<span class="icon text-white-50">
											<i class="fas fa-arrow-left"></i>
										</span>
										<span class="text">Back</span>
									</a>
									<input type="submit" class="btn btn-primary" type="submit" name="proses3" value="Inisialisasi">
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
$input3->terminate();
?>