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
$t_operator_edit = new t_operator_edit();

// Run the page
$t_operator_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_operator_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_operatoredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_operatoredit = currentForm = new ew.Form("ft_operatoredit", "edit");

	// Validate form
	ft_operatoredit.validate = function() {
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
			<?php if ($t_operator_edit->Generasi->Required) { ?>
				elm = this.getElements("x" + infix + "_Generasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_operator_edit->Generasi->caption(), $t_operator_edit->Generasi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Generasi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_operator_edit->Generasi->errorMessage()) ?>");
			<?php if ($t_operator_edit->Populasi->Required) { ?>
				elm = this.getElements("x" + infix + "_Populasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_operator_edit->Populasi->caption(), $t_operator_edit->Populasi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Populasi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_operator_edit->Populasi->errorMessage()) ?>");
			<?php if ($t_operator_edit->Seleksi->Required) { ?>
				elm = this.getElements("x" + infix + "_Seleksi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_operator_edit->Seleksi->caption(), $t_operator_edit->Seleksi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Seleksi");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_operator_edit->Seleksi->errorMessage()) ?>");
			<?php if ($t_operator_edit->CO->Required) { ?>
				elm = this.getElements("x" + infix + "_CO");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_operator_edit->CO->caption(), $t_operator_edit->CO->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CO");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_operator_edit->CO->errorMessage()) ?>");
			<?php if ($t_operator_edit->Mutasi->Required) { ?>
				elm = this.getElements("x" + infix + "_Mutasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_operator_edit->Mutasi->caption(), $t_operator_edit->Mutasi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Mutasi");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_operator_edit->Mutasi->errorMessage()) ?>");

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
	ft_operatoredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_operatoredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_operatoredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_operator_edit->showPageHeader(); ?>
<?php
$t_operator_edit->showMessage();
?>
<form name="ft_operatoredit" id="ft_operatoredit" class="<?php echo $t_operator_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_operator">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_operator_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_operator_edit->Generasi->Visible) { // Generasi ?>
	<div id="r_Generasi" class="form-group row">
		<label id="elh_t_operator_Generasi" for="x_Generasi" class="<?php echo $t_operator_edit->LeftColumnClass ?>"><?php echo $t_operator_edit->Generasi->caption() ?><?php echo $t_operator_edit->Generasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_operator_edit->RightColumnClass ?>"><div <?php echo $t_operator_edit->Generasi->cellAttributes() ?>>
<span id="el_t_operator_Generasi">
<input type="text" data-table="t_operator" data-field="x_Generasi" name="x_Generasi" id="x_Generasi" size="5" maxlength="4" placeholder="<?php echo HtmlEncode($t_operator_edit->Generasi->getPlaceHolder()) ?>" value="<?php echo $t_operator_edit->Generasi->EditValue ?>"<?php echo $t_operator_edit->Generasi->editAttributes() ?>>
</span>
<?php echo $t_operator_edit->Generasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_operator_edit->Populasi->Visible) { // Populasi ?>
	<div id="r_Populasi" class="form-group row">
		<label id="elh_t_operator_Populasi" for="x_Populasi" class="<?php echo $t_operator_edit->LeftColumnClass ?>"><?php echo $t_operator_edit->Populasi->caption() ?><?php echo $t_operator_edit->Populasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_operator_edit->RightColumnClass ?>"><div <?php echo $t_operator_edit->Populasi->cellAttributes() ?>>
<span id="el_t_operator_Populasi">
<input type="text" data-table="t_operator" data-field="x_Populasi" name="x_Populasi" id="x_Populasi" size="5" maxlength="4" placeholder="<?php echo HtmlEncode($t_operator_edit->Populasi->getPlaceHolder()) ?>" value="<?php echo $t_operator_edit->Populasi->EditValue ?>"<?php echo $t_operator_edit->Populasi->editAttributes() ?>>
</span>
<?php echo $t_operator_edit->Populasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_operator_edit->Seleksi->Visible) { // Seleksi ?>
	<div id="r_Seleksi" class="form-group row">
		<label id="elh_t_operator_Seleksi" for="x_Seleksi" class="<?php echo $t_operator_edit->LeftColumnClass ?>"><?php echo $t_operator_edit->Seleksi->caption() ?><?php echo $t_operator_edit->Seleksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_operator_edit->RightColumnClass ?>"><div <?php echo $t_operator_edit->Seleksi->cellAttributes() ?>>
<span id="el_t_operator_Seleksi">
<input type="text" data-table="t_operator" data-field="x_Seleksi" name="x_Seleksi" id="x_Seleksi" size="5" maxlength="4" placeholder="<?php echo HtmlEncode($t_operator_edit->Seleksi->getPlaceHolder()) ?>" value="<?php echo $t_operator_edit->Seleksi->EditValue ?>"<?php echo $t_operator_edit->Seleksi->editAttributes() ?>>
</span>
<?php echo $t_operator_edit->Seleksi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_operator_edit->CO->Visible) { // CO ?>
	<div id="r_CO" class="form-group row">
		<label id="elh_t_operator_CO" for="x_CO" class="<?php echo $t_operator_edit->LeftColumnClass ?>"><?php echo $t_operator_edit->CO->caption() ?><?php echo $t_operator_edit->CO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_operator_edit->RightColumnClass ?>"><div <?php echo $t_operator_edit->CO->cellAttributes() ?>>
<span id="el_t_operator_CO">
<input type="text" data-table="t_operator" data-field="x_CO" name="x_CO" id="x_CO" size="5" maxlength="4" placeholder="<?php echo HtmlEncode($t_operator_edit->CO->getPlaceHolder()) ?>" value="<?php echo $t_operator_edit->CO->EditValue ?>"<?php echo $t_operator_edit->CO->editAttributes() ?>>
</span>
<?php echo $t_operator_edit->CO->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_operator_edit->Mutasi->Visible) { // Mutasi ?>
	<div id="r_Mutasi" class="form-group row">
		<label id="elh_t_operator_Mutasi" for="x_Mutasi" class="<?php echo $t_operator_edit->LeftColumnClass ?>"><?php echo $t_operator_edit->Mutasi->caption() ?><?php echo $t_operator_edit->Mutasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_operator_edit->RightColumnClass ?>"><div <?php echo $t_operator_edit->Mutasi->cellAttributes() ?>>
<span id="el_t_operator_Mutasi">
<input type="text" data-table="t_operator" data-field="x_Mutasi" name="x_Mutasi" id="x_Mutasi" size="5" maxlength="4" placeholder="<?php echo HtmlEncode($t_operator_edit->Mutasi->getPlaceHolder()) ?>" value="<?php echo $t_operator_edit->Mutasi->EditValue ?>"<?php echo $t_operator_edit->Mutasi->editAttributes() ?>>
</span>
<?php echo $t_operator_edit->Mutasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="t_operator" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($t_operator_edit->id->CurrentValue) ?>">
<?php if (!$t_operator_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_operator_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_operator_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_operator_edit->showPageFooter();
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
$t_operator_edit->terminate();
?>