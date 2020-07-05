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
$input = new input();

// Run the page
$input->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
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
									<form action="input3.php" method="POST">
										<input type="hidden" name="token" value="<?php echo CurrentPage()->Token ?>">
										<div class="form-group row">Jumlah Kapal<input type="text" name="jumlahDepo" class="form-control form-control-user" id="jumlahDepo" placeholder="" value="<?php echo ExecuteScalar('select count(id) from t_kapal0'); ?>" readonly>
										</div>
										<!-- <div class="form-group row">Jumlah Distribusi
											<input type="text" name="jumlahStorage" class="form-control form-control-user" id="jumlahStorage" placeholder="" value="<?php echo ExecuteScalar('select count(id) from t_distribusi'); ?>">
										</div> -->
										<div class="form-group row">Jumlah Distribusi
											<input type="text" name="jumlahPengimpor" class="form-control form-control-user" id="jumlahPengimpor" placeholder="" value="<?php echo ExecuteScalar('select count(id) from t_distribusi'); ?>" readonly>
										</div>
										<!-- <div class="form-group row">Jumlah Tipe Tanker
											<input type="text" name="jumlahTipe" class="form-control form-control-user" id="jumlahTipeTanker" placeholder="">
										</div> -->
										<hr>
										<input type="submit" class="btn btn-primary" type="submit" name="proses1" value="Proses">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		  </div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$input->terminate();
?>