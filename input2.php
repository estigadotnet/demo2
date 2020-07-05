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
$input2 = new input2();

// Run the page
$input2->run();

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
	$jumlahPengimpor = $_POST["jumlahPengimpor"];
	//$jumlahStorage   = $_POST["jumlahStorage"];
	$jumlahDepo      = $_POST["jumlahDepo"];
	//$jumlahTipe      = $_POST["jumlahTipe"];
}
?>

		  <div class="row">

			<div class="col-sm-12">
				<!-- Jumlah Titik Jaringan (Himpunan Jaringan) -->
				<div class="card mb-3">
					<div class="card-header">
						Jumlah Titik Jaringan (Himpunan Jaringan)
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-2">
								<div class="p-2">
									<form method="POST" action="input3.php">
									<div class="form-group row">
										Jumlah Kapal
										<input type="text" name="jumlahDepo" value="<?php echo $jumlahDepo; ?>" class="form-control form-control-user" id="jumlahDepo" placeholder="Jumlah Depo" value="<?php echo ExecuteScalar('select count(id) from t_kapal0'); ?>" readonly>
									</div>
									<!-- <div class="form-group row">
										Jumlah Storage
										<input type="text" name="jumlahStorage" value="<?php echo $jumlahStorage; ?>" class="form-control form-control-user" id="jumlahStorage" placeholder="Jumlah Storage" readonly>
									</div> -->
									<div class="form-group row">
										Jumlah Distribusi
										<input type="text" name="jumlahPengimpor" value="<?php echo $jumlahPengimpor; ?>" class="form-control form-control-user" id="jumlahPengimpor" placeholder="Jumlah Pengimpor" value="<?php echo ExecuteScalar('select count(id) from t_distribusi'); ?>" readonly>
									</div>
									<!-- <div class="form-group row">
										Jumlah Tipe Tanker
										<input type="text" name="jumlahTipe" value="<?php echo $jumlahTipe; ?>" class="form-control form-control-user" id="jumlahTipeTanker" placeholder="Jumlah Tipe Tanker" readonly>
									</div> -->
									<hr>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<?php if ($jumlahPengimpor > 0 or $jumlahDepo > 0) { ?>
			
			<div class="col-sm-12">
				<div class="card mb-3">
					<div class="card-body">
					
						<!-- <form method="POST" action="input3.php"> -->
						
						<div class="row">
							
							<!-- pengimpor -->
							<?php
							if ($jumlahPengimpor > 0) {
							?>
								<div class="col-sm-2">
									<div class="p-2">
										<div class="form-group row">
										Distribusi
										</div>
										<?php
										for ($i = 1; $i <= $jumlahPengimpor; $i++) {
										?>
										<div class="form-group row">
											<input type="text" name="pengimpor[]" class="form-control form-control-user" size="2">
										</div>
										<?php
										}
										?>
									</div>
								</div>
							<?php
							}
							?>
							<!-- end of pengimpor -->
							
							<!-- depo -->
							<?php
							if ($jumlahDepo > 0) {
							?>
								<div class="col-sm-2">
									<div class="p-2">
										<div class="form-group row">
										Kapal
										</div>
										<?php
										for ($i = 1; $i <= $jumlahDepo; $i++) {
										?>
										<div class="form-group row">
											<input type="text" name="depo[]" class="form-control form-control-user" size="2">
										</div>
										<?php
										}
										?>
									</div>
								</div>
							<?php
							}
							?>
							<!-- end of depo -->
							
						</div>
						
						<div class="row">
							<div class="col-sm-3">
								<div class="p-2">
									<!-- <button class="btn btn-primary" type="submit" name="proses2">Proses</button> -->
									<a href="#" class="btn btn-primary btn-icon-split" onClick="history.go(-1); return false;">
										<span class="icon text-white-50">
											<i class="fas fa-arrow-left"></i>
										</span>
										<span class="text">Back</span>
									</a>
									<input type="submit" class="btn btn-primary" type="submit" name="proses2" value="Proses">
								</div>
							</div>
						</div>
						
						</form>
					</div>
				</div>
			  
			</div>
			<?php }?>
			
		  </div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$input2->terminate();
?>