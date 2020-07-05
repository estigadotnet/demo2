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
$t_kapal_edit = new t_kapal_edit();

// Run the page
$t_kapal_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_kapal_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_kapaledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_kapaledit = currentForm = new ew.Form("ft_kapaledit", "edit");

	// Validate form
	ft_kapaledit.validate = function() {
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
			<?php if ($t_kapal_edit->Payload->Required) { ?>
				elm = this.getElements("x" + infix + "_Payload");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_edit->Payload->caption(), $t_kapal_edit->Payload->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Payload");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_edit->Payload->errorMessage()) ?>");
			<?php if ($t_kapal_edit->DischRate->Required) { ?>
				elm = this.getElements("x" + infix + "_DischRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_edit->DischRate->caption(), $t_kapal_edit->DischRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DischRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_edit->DischRate->errorMessage()) ?>");
			<?php if ($t_kapal_edit->TCH->Required) { ?>
				elm = this.getElements("x" + infix + "_TCH");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_edit->TCH->caption(), $t_kapal_edit->TCH->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TCH");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_edit->TCH->errorMessage()) ?>");
			<?php if ($t_kapal_edit->VarCost->Required) { ?>
				elm = this.getElements("x" + infix + "_VarCost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_edit->VarCost->caption(), $t_kapal_edit->VarCost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VarCost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_edit->VarCost->errorMessage()) ?>");
			<?php if ($t_kapal_edit->VsLaden->Required) { ?>
				elm = this.getElements("x" + infix + "_VsLaden");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_edit->VsLaden->caption(), $t_kapal_edit->VsLaden->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VsLaden");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_edit->VsLaden->errorMessage()) ?>");
			<?php if ($t_kapal_edit->VsBallast->Required) { ?>
				elm = this.getElements("x" + infix + "_VsBallast");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_edit->VsBallast->caption(), $t_kapal_edit->VsBallast->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VsBallast");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_edit->VsBallast->errorMessage()) ?>");
			<?php if ($t_kapal_edit->ComDay->Required) { ?>
				elm = this.getElements("x" + infix + "_ComDay");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_edit->ComDay->caption(), $t_kapal_edit->ComDay->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ComDay");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_edit->ComDay->errorMessage()) ?>");

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
	ft_kapaledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_kapaledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_kapaledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_kapal_edit->showPageHeader(); ?>
<?php
$t_kapal_edit->showMessage();
?>
<form name="ft_kapaledit" id="ft_kapaledit" class="<?php echo $t_kapal_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_kapal">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_kapal_edit->IsModal ?>">
<?php if ($t_kapal->getCurrentMasterTable() == "t_kapal0") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_kapal0">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($t_kapal_edit->kapal_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_kapal_edit->Payload->Visible) { // Payload ?>
	<div id="r_Payload" class="form-group row">
		<label id="elh_t_kapal_Payload" for="x_Payload" class="<?php echo $t_kapal_edit->LeftColumnClass ?>"><?php echo $t_kapal_edit->Payload->caption() ?><?php echo $t_kapal_edit->Payload->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kapal_edit->RightColumnClass ?>"><div <?php echo $t_kapal_edit->Payload->cellAttributes() ?>>
<span id="el_t_kapal_Payload">
<input type="text" data-table="t_kapal" data-field="x_Payload" name="x_Payload" id="x_Payload" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_edit->Payload->getPlaceHolder()) ?>" value="<?php echo $t_kapal_edit->Payload->EditValue ?>"<?php echo $t_kapal_edit->Payload->editAttributes() ?>>
</span>
<?php echo $t_kapal_edit->Payload->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kapal_edit->DischRate->Visible) { // DischRate ?>
	<div id="r_DischRate" class="form-group row">
		<label id="elh_t_kapal_DischRate" for="x_DischRate" class="<?php echo $t_kapal_edit->LeftColumnClass ?>"><?php echo $t_kapal_edit->DischRate->caption() ?><?php echo $t_kapal_edit->DischRate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kapal_edit->RightColumnClass ?>"><div <?php echo $t_kapal_edit->DischRate->cellAttributes() ?>>
<span id="el_t_kapal_DischRate">
<input type="text" data-table="t_kapal" data-field="x_DischRate" name="x_DischRate" id="x_DischRate" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_edit->DischRate->getPlaceHolder()) ?>" value="<?php echo $t_kapal_edit->DischRate->EditValue ?>"<?php echo $t_kapal_edit->DischRate->editAttributes() ?>>
</span>
<?php echo $t_kapal_edit->DischRate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kapal_edit->TCH->Visible) { // TCH ?>
	<div id="r_TCH" class="form-group row">
		<label id="elh_t_kapal_TCH" for="x_TCH" class="<?php echo $t_kapal_edit->LeftColumnClass ?>"><?php echo $t_kapal_edit->TCH->caption() ?><?php echo $t_kapal_edit->TCH->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kapal_edit->RightColumnClass ?>"><div <?php echo $t_kapal_edit->TCH->cellAttributes() ?>>
<span id="el_t_kapal_TCH">
<input type="text" data-table="t_kapal" data-field="x_TCH" name="x_TCH" id="x_TCH" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_edit->TCH->getPlaceHolder()) ?>" value="<?php echo $t_kapal_edit->TCH->EditValue ?>"<?php echo $t_kapal_edit->TCH->editAttributes() ?>>
</span>
<?php echo $t_kapal_edit->TCH->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kapal_edit->VarCost->Visible) { // VarCost ?>
	<div id="r_VarCost" class="form-group row">
		<label id="elh_t_kapal_VarCost" for="x_VarCost" class="<?php echo $t_kapal_edit->LeftColumnClass ?>"><?php echo $t_kapal_edit->VarCost->caption() ?><?php echo $t_kapal_edit->VarCost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kapal_edit->RightColumnClass ?>"><div <?php echo $t_kapal_edit->VarCost->cellAttributes() ?>>
<span id="el_t_kapal_VarCost">
<input type="text" data-table="t_kapal" data-field="x_VarCost" name="x_VarCost" id="x_VarCost" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_edit->VarCost->getPlaceHolder()) ?>" value="<?php echo $t_kapal_edit->VarCost->EditValue ?>"<?php echo $t_kapal_edit->VarCost->editAttributes() ?>>
</span>
<?php echo $t_kapal_edit->VarCost->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kapal_edit->VsLaden->Visible) { // VsLaden ?>
	<div id="r_VsLaden" class="form-group row">
		<label id="elh_t_kapal_VsLaden" for="x_VsLaden" class="<?php echo $t_kapal_edit->LeftColumnClass ?>"><?php echo $t_kapal_edit->VsLaden->caption() ?><?php echo $t_kapal_edit->VsLaden->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kapal_edit->RightColumnClass ?>"><div <?php echo $t_kapal_edit->VsLaden->cellAttributes() ?>>
<span id="el_t_kapal_VsLaden">
<input type="text" data-table="t_kapal" data-field="x_VsLaden" name="x_VsLaden" id="x_VsLaden" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_edit->VsLaden->getPlaceHolder()) ?>" value="<?php echo $t_kapal_edit->VsLaden->EditValue ?>"<?php echo $t_kapal_edit->VsLaden->editAttributes() ?>>
</span>
<?php echo $t_kapal_edit->VsLaden->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kapal_edit->VsBallast->Visible) { // VsBallast ?>
	<div id="r_VsBallast" class="form-group row">
		<label id="elh_t_kapal_VsBallast" for="x_VsBallast" class="<?php echo $t_kapal_edit->LeftColumnClass ?>"><?php echo $t_kapal_edit->VsBallast->caption() ?><?php echo $t_kapal_edit->VsBallast->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kapal_edit->RightColumnClass ?>"><div <?php echo $t_kapal_edit->VsBallast->cellAttributes() ?>>
<span id="el_t_kapal_VsBallast">
<input type="text" data-table="t_kapal" data-field="x_VsBallast" name="x_VsBallast" id="x_VsBallast" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_edit->VsBallast->getPlaceHolder()) ?>" value="<?php echo $t_kapal_edit->VsBallast->EditValue ?>"<?php echo $t_kapal_edit->VsBallast->editAttributes() ?>>
</span>
<?php echo $t_kapal_edit->VsBallast->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kapal_edit->ComDay->Visible) { // ComDay ?>
	<div id="r_ComDay" class="form-group row">
		<label id="elh_t_kapal_ComDay" for="x_ComDay" class="<?php echo $t_kapal_edit->LeftColumnClass ?>"><?php echo $t_kapal_edit->ComDay->caption() ?><?php echo $t_kapal_edit->ComDay->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kapal_edit->RightColumnClass ?>"><div <?php echo $t_kapal_edit->ComDay->cellAttributes() ?>>
<span id="el_t_kapal_ComDay">
<input type="text" data-table="t_kapal" data-field="x_ComDay" name="x_ComDay" id="x_ComDay" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_edit->ComDay->getPlaceHolder()) ?>" value="<?php echo $t_kapal_edit->ComDay->EditValue ?>"<?php echo $t_kapal_edit->ComDay->editAttributes() ?>>
</span>
<?php echo $t_kapal_edit->ComDay->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="t_kapal" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($t_kapal_edit->id->CurrentValue) ?>">
<?php if (!$t_kapal_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_kapal_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_kapal_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_kapal_edit->showPageFooter();
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
$t_kapal_edit->terminate();
?>