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
$t_parameter_edit = new t_parameter_edit();

// Run the page
$t_parameter_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_parameter_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_parameteredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_parameteredit = currentForm = new ew.Form("ft_parameteredit", "edit");

	// Validate form
	ft_parameteredit.validate = function() {
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
			<?php if ($t_parameter_edit->Parameter->Required) { ?>
				elm = this.getElements("x" + infix + "_Parameter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_parameter_edit->Parameter->caption(), $t_parameter_edit->Parameter->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_parameter_edit->Nilai->Required) { ?>
				elm = this.getElements("x" + infix + "_Nilai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_parameter_edit->Nilai->caption(), $t_parameter_edit->Nilai->RequiredErrorMessage)) ?>");
			<?php } ?>

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
	ft_parameteredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_parameteredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_parameteredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_parameter_edit->showPageHeader(); ?>
<?php
$t_parameter_edit->showMessage();
?>
<form name="ft_parameteredit" id="ft_parameteredit" class="<?php echo $t_parameter_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_parameter">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_parameter_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_parameter_edit->Parameter->Visible) { // Parameter ?>
	<div id="r_Parameter" class="form-group row">
		<label id="elh_t_parameter_Parameter" for="x_Parameter" class="<?php echo $t_parameter_edit->LeftColumnClass ?>"><?php echo $t_parameter_edit->Parameter->caption() ?><?php echo $t_parameter_edit->Parameter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_parameter_edit->RightColumnClass ?>"><div <?php echo $t_parameter_edit->Parameter->cellAttributes() ?>>
<span id="el_t_parameter_Parameter">
<textarea data-table="t_parameter" data-field="x_Parameter" name="x_Parameter" id="x_Parameter" cols="20" rows="1" placeholder="<?php echo HtmlEncode($t_parameter_edit->Parameter->getPlaceHolder()) ?>"<?php echo $t_parameter_edit->Parameter->editAttributes() ?>><?php echo $t_parameter_edit->Parameter->EditValue ?></textarea>
</span>
<?php echo $t_parameter_edit->Parameter->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_parameter_edit->Nilai->Visible) { // Nilai ?>
	<div id="r_Nilai" class="form-group row">
		<label id="elh_t_parameter_Nilai" for="x_Nilai" class="<?php echo $t_parameter_edit->LeftColumnClass ?>"><?php echo $t_parameter_edit->Nilai->caption() ?><?php echo $t_parameter_edit->Nilai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_parameter_edit->RightColumnClass ?>"><div <?php echo $t_parameter_edit->Nilai->cellAttributes() ?>>
<span id="el_t_parameter_Nilai">
<textarea data-table="t_parameter" data-field="x_Nilai" name="x_Nilai" id="x_Nilai" cols="30" rows="1" placeholder="<?php echo HtmlEncode($t_parameter_edit->Nilai->getPlaceHolder()) ?>"<?php echo $t_parameter_edit->Nilai->editAttributes() ?>><?php echo $t_parameter_edit->Nilai->EditValue ?></textarea>
</span>
<?php echo $t_parameter_edit->Nilai->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="t_parameter" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($t_parameter_edit->id->CurrentValue) ?>">
<?php if (!$t_parameter_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_parameter_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_parameter_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_parameter_edit->showPageFooter();
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
$t_parameter_edit->terminate();
?>