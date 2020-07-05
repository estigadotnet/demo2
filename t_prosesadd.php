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
$t_proses_add = new t_proses_add();

// Run the page
$t_proses_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_proses_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_prosesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_prosesadd = currentForm = new ew.Form("ft_prosesadd", "add");

	// Validate form
	ft_prosesadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($t_proses_add->TotalCost->Required) { ?>
				elm = this.getElements("x" + infix + "_TotalCost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_proses_add->TotalCost->caption(), $t_proses_add->TotalCost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TotalCost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_proses_add->TotalCost->errorMessage()) ?>");
			<?php if ($t_proses_add->TotalCargo->Required) { ?>
				elm = this.getElements("x" + infix + "_TotalCargo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_proses_add->TotalCargo->caption(), $t_proses_add->TotalCargo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TotalCargo");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_proses_add->TotalCargo->errorMessage()) ?>");
			<?php if ($t_proses_add->Fitness->Required) { ?>
				elm = this.getElements("x" + infix + "_Fitness");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_proses_add->Fitness->caption(), $t_proses_add->Fitness->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Fitness");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_proses_add->Fitness->errorMessage()) ?>");
			<?php if ($t_proses_add->Kromosom->Required) { ?>
				elm = this.getElements("x" + infix + "_Kromosom");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_proses_add->Kromosom->caption(), $t_proses_add->Kromosom->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_proses_add->Generasi->Required) { ?>
				elm = this.getElements("x" + infix + "_Generasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_proses_add->Generasi->caption(), $t_proses_add->Generasi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Generasi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_proses_add->Generasi->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	ft_prosesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_prosesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_prosesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_proses_add->showPageHeader(); ?>
<?php
$t_proses_add->showMessage();
?>
<form name="ft_prosesadd" id="ft_prosesadd" class="<?php echo $t_proses_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_proses">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_proses_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($t_proses_add->TotalCost->Visible) { // TotalCost ?>
	<div id="r_TotalCost" class="form-group row">
		<label id="elh_t_proses_TotalCost" for="x_TotalCost" class="<?php echo $t_proses_add->LeftColumnClass ?>"><?php echo $t_proses_add->TotalCost->caption() ?><?php echo $t_proses_add->TotalCost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_proses_add->RightColumnClass ?>"><div <?php echo $t_proses_add->TotalCost->cellAttributes() ?>>
<span id="el_t_proses_TotalCost">
<input type="text" data-table="t_proses" data-field="x_TotalCost" name="x_TotalCost" id="x_TotalCost" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_proses_add->TotalCost->getPlaceHolder()) ?>" value="<?php echo $t_proses_add->TotalCost->EditValue ?>"<?php echo $t_proses_add->TotalCost->editAttributes() ?>>
</span>
<?php echo $t_proses_add->TotalCost->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_proses_add->TotalCargo->Visible) { // TotalCargo ?>
	<div id="r_TotalCargo" class="form-group row">
		<label id="elh_t_proses_TotalCargo" for="x_TotalCargo" class="<?php echo $t_proses_add->LeftColumnClass ?>"><?php echo $t_proses_add->TotalCargo->caption() ?><?php echo $t_proses_add->TotalCargo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_proses_add->RightColumnClass ?>"><div <?php echo $t_proses_add->TotalCargo->cellAttributes() ?>>
<span id="el_t_proses_TotalCargo">
<input type="text" data-table="t_proses" data-field="x_TotalCargo" name="x_TotalCargo" id="x_TotalCargo" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_proses_add->TotalCargo->getPlaceHolder()) ?>" value="<?php echo $t_proses_add->TotalCargo->EditValue ?>"<?php echo $t_proses_add->TotalCargo->editAttributes() ?>>
</span>
<?php echo $t_proses_add->TotalCargo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_proses_add->Fitness->Visible) { // Fitness ?>
	<div id="r_Fitness" class="form-group row">
		<label id="elh_t_proses_Fitness" for="x_Fitness" class="<?php echo $t_proses_add->LeftColumnClass ?>"><?php echo $t_proses_add->Fitness->caption() ?><?php echo $t_proses_add->Fitness->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_proses_add->RightColumnClass ?>"><div <?php echo $t_proses_add->Fitness->cellAttributes() ?>>
<span id="el_t_proses_Fitness">
<input type="text" data-table="t_proses" data-field="x_Fitness" name="x_Fitness" id="x_Fitness" size="30" maxlength="7" placeholder="<?php echo HtmlEncode($t_proses_add->Fitness->getPlaceHolder()) ?>" value="<?php echo $t_proses_add->Fitness->EditValue ?>"<?php echo $t_proses_add->Fitness->editAttributes() ?>>
</span>
<?php echo $t_proses_add->Fitness->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_proses_add->Kromosom->Visible) { // Kromosom ?>
	<div id="r_Kromosom" class="form-group row">
		<label id="elh_t_proses_Kromosom" for="x_Kromosom" class="<?php echo $t_proses_add->LeftColumnClass ?>"><?php echo $t_proses_add->Kromosom->caption() ?><?php echo $t_proses_add->Kromosom->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_proses_add->RightColumnClass ?>"><div <?php echo $t_proses_add->Kromosom->cellAttributes() ?>>
<span id="el_t_proses_Kromosom">
<textarea data-table="t_proses" data-field="x_Kromosom" name="x_Kromosom" id="x_Kromosom" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_proses_add->Kromosom->getPlaceHolder()) ?>"<?php echo $t_proses_add->Kromosom->editAttributes() ?>><?php echo $t_proses_add->Kromosom->EditValue ?></textarea>
</span>
<?php echo $t_proses_add->Kromosom->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_proses_add->Generasi->Visible) { // Generasi ?>
	<div id="r_Generasi" class="form-group row">
		<label id="elh_t_proses_Generasi" for="x_Generasi" class="<?php echo $t_proses_add->LeftColumnClass ?>"><?php echo $t_proses_add->Generasi->caption() ?><?php echo $t_proses_add->Generasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_proses_add->RightColumnClass ?>"><div <?php echo $t_proses_add->Generasi->cellAttributes() ?>>
<span id="el_t_proses_Generasi">
<input type="text" data-table="t_proses" data-field="x_Generasi" name="x_Generasi" id="x_Generasi" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($t_proses_add->Generasi->getPlaceHolder()) ?>" value="<?php echo $t_proses_add->Generasi->EditValue ?>"<?php echo $t_proses_add->Generasi->editAttributes() ?>>
</span>
<?php echo $t_proses_add->Generasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_proses_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_proses_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_proses_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_proses_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_proses_add->terminate();
?>