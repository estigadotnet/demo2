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
$t_kapal_add = new t_kapal_add();

// Run the page
$t_kapal_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_kapal_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_kapaladd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_kapaladd = currentForm = new ew.Form("ft_kapaladd", "add");

	// Validate form
	ft_kapaladd.validate = function() {
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
			<?php if ($t_kapal_add->Payload->Required) { ?>
				elm = this.getElements("x" + infix + "_Payload");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_add->Payload->caption(), $t_kapal_add->Payload->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Payload");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_add->Payload->errorMessage()) ?>");
			<?php if ($t_kapal_add->DischRate->Required) { ?>
				elm = this.getElements("x" + infix + "_DischRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_add->DischRate->caption(), $t_kapal_add->DischRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DischRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_add->DischRate->errorMessage()) ?>");
			<?php if ($t_kapal_add->TCH->Required) { ?>
				elm = this.getElements("x" + infix + "_TCH");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_add->TCH->caption(), $t_kapal_add->TCH->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TCH");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_add->TCH->errorMessage()) ?>");
			<?php if ($t_kapal_add->VarCost->Required) { ?>
				elm = this.getElements("x" + infix + "_VarCost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_add->VarCost->caption(), $t_kapal_add->VarCost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VarCost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_add->VarCost->errorMessage()) ?>");
			<?php if ($t_kapal_add->VsLaden->Required) { ?>
				elm = this.getElements("x" + infix + "_VsLaden");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_add->VsLaden->caption(), $t_kapal_add->VsLaden->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VsLaden");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_add->VsLaden->errorMessage()) ?>");
			<?php if ($t_kapal_add->VsBallast->Required) { ?>
				elm = this.getElements("x" + infix + "_VsBallast");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_add->VsBallast->caption(), $t_kapal_add->VsBallast->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VsBallast");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_add->VsBallast->errorMessage()) ?>");
			<?php if ($t_kapal_add->ComDay->Required) { ?>
				elm = this.getElements("x" + infix + "_ComDay");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_add->ComDay->caption(), $t_kapal_add->ComDay->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ComDay");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_add->ComDay->errorMessage()) ?>");

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
	ft_kapaladd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_kapaladd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_kapaladd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_kapal_add->showPageHeader(); ?>
<?php
$t_kapal_add->showMessage();
?>
<form name="ft_kapaladd" id="ft_kapaladd" class="<?php echo $t_kapal_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_kapal">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_kapal_add->IsModal ?>">
<?php if ($t_kapal->getCurrentMasterTable() == "t_kapal0") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_kapal0">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($t_kapal_add->kapal_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($t_kapal_add->Payload->Visible) { // Payload ?>
	<div id="r_Payload" class="form-group row">
		<label id="elh_t_kapal_Payload" for="x_Payload" class="<?php echo $t_kapal_add->LeftColumnClass ?>"><?php echo $t_kapal_add->Payload->caption() ?><?php echo $t_kapal_add->Payload->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kapal_add->RightColumnClass ?>"><div <?php echo $t_kapal_add->Payload->cellAttributes() ?>>
<span id="el_t_kapal_Payload">
<input type="text" data-table="t_kapal" data-field="x_Payload" name="x_Payload" id="x_Payload" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_add->Payload->getPlaceHolder()) ?>" value="<?php echo $t_kapal_add->Payload->EditValue ?>"<?php echo $t_kapal_add->Payload->editAttributes() ?>>
</span>
<?php echo $t_kapal_add->Payload->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kapal_add->DischRate->Visible) { // DischRate ?>
	<div id="r_DischRate" class="form-group row">
		<label id="elh_t_kapal_DischRate" for="x_DischRate" class="<?php echo $t_kapal_add->LeftColumnClass ?>"><?php echo $t_kapal_add->DischRate->caption() ?><?php echo $t_kapal_add->DischRate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kapal_add->RightColumnClass ?>"><div <?php echo $t_kapal_add->DischRate->cellAttributes() ?>>
<span id="el_t_kapal_DischRate">
<input type="text" data-table="t_kapal" data-field="x_DischRate" name="x_DischRate" id="x_DischRate" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_add->DischRate->getPlaceHolder()) ?>" value="<?php echo $t_kapal_add->DischRate->EditValue ?>"<?php echo $t_kapal_add->DischRate->editAttributes() ?>>
</span>
<?php echo $t_kapal_add->DischRate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kapal_add->TCH->Visible) { // TCH ?>
	<div id="r_TCH" class="form-group row">
		<label id="elh_t_kapal_TCH" for="x_TCH" class="<?php echo $t_kapal_add->LeftColumnClass ?>"><?php echo $t_kapal_add->TCH->caption() ?><?php echo $t_kapal_add->TCH->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kapal_add->RightColumnClass ?>"><div <?php echo $t_kapal_add->TCH->cellAttributes() ?>>
<span id="el_t_kapal_TCH">
<input type="text" data-table="t_kapal" data-field="x_TCH" name="x_TCH" id="x_TCH" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_add->TCH->getPlaceHolder()) ?>" value="<?php echo $t_kapal_add->TCH->EditValue ?>"<?php echo $t_kapal_add->TCH->editAttributes() ?>>
</span>
<?php echo $t_kapal_add->TCH->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kapal_add->VarCost->Visible) { // VarCost ?>
	<div id="r_VarCost" class="form-group row">
		<label id="elh_t_kapal_VarCost" for="x_VarCost" class="<?php echo $t_kapal_add->LeftColumnClass ?>"><?php echo $t_kapal_add->VarCost->caption() ?><?php echo $t_kapal_add->VarCost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kapal_add->RightColumnClass ?>"><div <?php echo $t_kapal_add->VarCost->cellAttributes() ?>>
<span id="el_t_kapal_VarCost">
<input type="text" data-table="t_kapal" data-field="x_VarCost" name="x_VarCost" id="x_VarCost" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_add->VarCost->getPlaceHolder()) ?>" value="<?php echo $t_kapal_add->VarCost->EditValue ?>"<?php echo $t_kapal_add->VarCost->editAttributes() ?>>
</span>
<?php echo $t_kapal_add->VarCost->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kapal_add->VsLaden->Visible) { // VsLaden ?>
	<div id="r_VsLaden" class="form-group row">
		<label id="elh_t_kapal_VsLaden" for="x_VsLaden" class="<?php echo $t_kapal_add->LeftColumnClass ?>"><?php echo $t_kapal_add->VsLaden->caption() ?><?php echo $t_kapal_add->VsLaden->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kapal_add->RightColumnClass ?>"><div <?php echo $t_kapal_add->VsLaden->cellAttributes() ?>>
<span id="el_t_kapal_VsLaden">
<input type="text" data-table="t_kapal" data-field="x_VsLaden" name="x_VsLaden" id="x_VsLaden" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_add->VsLaden->getPlaceHolder()) ?>" value="<?php echo $t_kapal_add->VsLaden->EditValue ?>"<?php echo $t_kapal_add->VsLaden->editAttributes() ?>>
</span>
<?php echo $t_kapal_add->VsLaden->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kapal_add->VsBallast->Visible) { // VsBallast ?>
	<div id="r_VsBallast" class="form-group row">
		<label id="elh_t_kapal_VsBallast" for="x_VsBallast" class="<?php echo $t_kapal_add->LeftColumnClass ?>"><?php echo $t_kapal_add->VsBallast->caption() ?><?php echo $t_kapal_add->VsBallast->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kapal_add->RightColumnClass ?>"><div <?php echo $t_kapal_add->VsBallast->cellAttributes() ?>>
<span id="el_t_kapal_VsBallast">
<input type="text" data-table="t_kapal" data-field="x_VsBallast" name="x_VsBallast" id="x_VsBallast" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_add->VsBallast->getPlaceHolder()) ?>" value="<?php echo $t_kapal_add->VsBallast->EditValue ?>"<?php echo $t_kapal_add->VsBallast->editAttributes() ?>>
</span>
<?php echo $t_kapal_add->VsBallast->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_kapal_add->ComDay->Visible) { // ComDay ?>
	<div id="r_ComDay" class="form-group row">
		<label id="elh_t_kapal_ComDay" for="x_ComDay" class="<?php echo $t_kapal_add->LeftColumnClass ?>"><?php echo $t_kapal_add->ComDay->caption() ?><?php echo $t_kapal_add->ComDay->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_kapal_add->RightColumnClass ?>"><div <?php echo $t_kapal_add->ComDay->cellAttributes() ?>>
<span id="el_t_kapal_ComDay">
<input type="text" data-table="t_kapal" data-field="x_ComDay" name="x_ComDay" id="x_ComDay" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_add->ComDay->getPlaceHolder()) ?>" value="<?php echo $t_kapal_add->ComDay->EditValue ?>"<?php echo $t_kapal_add->ComDay->editAttributes() ?>>
</span>
<?php echo $t_kapal_add->ComDay->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<?php if (strval($t_kapal_add->kapal_id->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_kapal_id" id="x_kapal_id" value="<?php echo HtmlEncode(strval($t_kapal_add->kapal_id->getSessionValue())) ?>">
	<?php } ?>
<?php if (!$t_kapal_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_kapal_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_kapal_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_kapal_add->showPageFooter();
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
$t_kapal_add->terminate();
?>