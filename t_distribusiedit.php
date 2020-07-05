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
$t_distribusi_edit = new t_distribusi_edit();

// Run the page
$t_distribusi_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_distribusi_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_distribusiedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ft_distribusiedit = currentForm = new ew.Form("ft_distribusiedit", "edit");

	// Validate form
	ft_distribusiedit.validate = function() {
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
			<?php if ($t_distribusi_edit->source_id->Required) { ?>
				elm = this.getElements("x" + infix + "_source_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_edit->source_id->caption(), $t_distribusi_edit->source_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_distribusi_edit->destination_id->Required) { ?>
				elm = this.getElements("x" + infix + "_destination_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_edit->destination_id->caption(), $t_distribusi_edit->destination_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_distribusi_edit->Jarak->Required) { ?>
				elm = this.getElements("x" + infix + "_Jarak");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_edit->Jarak->caption(), $t_distribusi_edit->Jarak->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Jarak");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_distribusi_edit->Jarak->errorMessage()) ?>");
			<?php if ($t_distribusi_edit->Rate_O->Required) { ?>
				elm = this.getElements("x" + infix + "_Rate_O");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_edit->Rate_O->caption(), $t_distribusi_edit->Rate_O->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rate_O");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_distribusi_edit->Rate_O->errorMessage()) ?>");
			<?php if ($t_distribusi_edit->Rate_D->Required) { ?>
				elm = this.getElements("x" + infix + "_Rate_D");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_edit->Rate_D->caption(), $t_distribusi_edit->Rate_D->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rate_D");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_distribusi_edit->Rate_D->errorMessage()) ?>");
			<?php if ($t_distribusi_edit->Demand->Required) { ?>
				elm = this.getElements("x" + infix + "_Demand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_edit->Demand->caption(), $t_distribusi_edit->Demand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Demand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_distribusi_edit->Demand->errorMessage()) ?>");

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
	ft_distribusiedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_distribusiedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_distribusiedit.lists["x_source_id"] = <?php echo $t_distribusi_edit->source_id->Lookup->toClientList($t_distribusi_edit) ?>;
	ft_distribusiedit.lists["x_source_id"].options = <?php echo JsonEncode($t_distribusi_edit->source_id->lookupOptions()) ?>;
	ft_distribusiedit.lists["x_destination_id"] = <?php echo $t_distribusi_edit->destination_id->Lookup->toClientList($t_distribusi_edit) ?>;
	ft_distribusiedit.lists["x_destination_id"].options = <?php echo JsonEncode($t_distribusi_edit->destination_id->lookupOptions()) ?>;
	loadjs.done("ft_distribusiedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_distribusi_edit->showPageHeader(); ?>
<?php
$t_distribusi_edit->showMessage();
?>
<form name="ft_distribusiedit" id="ft_distribusiedit" class="<?php echo $t_distribusi_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_distribusi">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_distribusi_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_distribusi_edit->source_id->Visible) { // source_id ?>
	<div id="r_source_id" class="form-group row">
		<label id="elh_t_distribusi_source_id" for="x_source_id" class="<?php echo $t_distribusi_edit->LeftColumnClass ?>"><?php echo $t_distribusi_edit->source_id->caption() ?><?php echo $t_distribusi_edit->source_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_distribusi_edit->RightColumnClass ?>"><div <?php echo $t_distribusi_edit->source_id->cellAttributes() ?>>
<span id="el_t_distribusi_source_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_distribusi" data-field="x_source_id" data-value-separator="<?php echo $t_distribusi_edit->source_id->displayValueSeparatorAttribute() ?>" id="x_source_id" name="x_source_id"<?php echo $t_distribusi_edit->source_id->editAttributes() ?>>
			<?php echo $t_distribusi_edit->source_id->selectOptionListHtml("x_source_id") ?>
		</select>
</div>
<?php echo $t_distribusi_edit->source_id->Lookup->getParamTag($t_distribusi_edit, "p_x_source_id") ?>
</span>
<?php echo $t_distribusi_edit->source_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_distribusi_edit->destination_id->Visible) { // destination_id ?>
	<div id="r_destination_id" class="form-group row">
		<label id="elh_t_distribusi_destination_id" for="x_destination_id" class="<?php echo $t_distribusi_edit->LeftColumnClass ?>"><?php echo $t_distribusi_edit->destination_id->caption() ?><?php echo $t_distribusi_edit->destination_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_distribusi_edit->RightColumnClass ?>"><div <?php echo $t_distribusi_edit->destination_id->cellAttributes() ?>>
<span id="el_t_distribusi_destination_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_distribusi" data-field="x_destination_id" data-value-separator="<?php echo $t_distribusi_edit->destination_id->displayValueSeparatorAttribute() ?>" id="x_destination_id" name="x_destination_id"<?php echo $t_distribusi_edit->destination_id->editAttributes() ?>>
			<?php echo $t_distribusi_edit->destination_id->selectOptionListHtml("x_destination_id") ?>
		</select>
</div>
<?php echo $t_distribusi_edit->destination_id->Lookup->getParamTag($t_distribusi_edit, "p_x_destination_id") ?>
</span>
<?php echo $t_distribusi_edit->destination_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_distribusi_edit->Jarak->Visible) { // Jarak ?>
	<div id="r_Jarak" class="form-group row">
		<label id="elh_t_distribusi_Jarak" for="x_Jarak" class="<?php echo $t_distribusi_edit->LeftColumnClass ?>"><?php echo $t_distribusi_edit->Jarak->caption() ?><?php echo $t_distribusi_edit->Jarak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_distribusi_edit->RightColumnClass ?>"><div <?php echo $t_distribusi_edit->Jarak->cellAttributes() ?>>
<span id="el_t_distribusi_Jarak">
<input type="text" data-table="t_distribusi" data-field="x_Jarak" name="x_Jarak" id="x_Jarak" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_edit->Jarak->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_edit->Jarak->EditValue ?>"<?php echo $t_distribusi_edit->Jarak->editAttributes() ?>>
</span>
<?php echo $t_distribusi_edit->Jarak->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_distribusi_edit->Rate_O->Visible) { // Rate_O ?>
	<div id="r_Rate_O" class="form-group row">
		<label id="elh_t_distribusi_Rate_O" for="x_Rate_O" class="<?php echo $t_distribusi_edit->LeftColumnClass ?>"><?php echo $t_distribusi_edit->Rate_O->caption() ?><?php echo $t_distribusi_edit->Rate_O->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_distribusi_edit->RightColumnClass ?>"><div <?php echo $t_distribusi_edit->Rate_O->cellAttributes() ?>>
<span id="el_t_distribusi_Rate_O">
<input type="text" data-table="t_distribusi" data-field="x_Rate_O" name="x_Rate_O" id="x_Rate_O" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_edit->Rate_O->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_edit->Rate_O->EditValue ?>"<?php echo $t_distribusi_edit->Rate_O->editAttributes() ?>>
</span>
<?php echo $t_distribusi_edit->Rate_O->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_distribusi_edit->Rate_D->Visible) { // Rate_D ?>
	<div id="r_Rate_D" class="form-group row">
		<label id="elh_t_distribusi_Rate_D" for="x_Rate_D" class="<?php echo $t_distribusi_edit->LeftColumnClass ?>"><?php echo $t_distribusi_edit->Rate_D->caption() ?><?php echo $t_distribusi_edit->Rate_D->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_distribusi_edit->RightColumnClass ?>"><div <?php echo $t_distribusi_edit->Rate_D->cellAttributes() ?>>
<span id="el_t_distribusi_Rate_D">
<input type="text" data-table="t_distribusi" data-field="x_Rate_D" name="x_Rate_D" id="x_Rate_D" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_edit->Rate_D->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_edit->Rate_D->EditValue ?>"<?php echo $t_distribusi_edit->Rate_D->editAttributes() ?>>
</span>
<?php echo $t_distribusi_edit->Rate_D->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_distribusi_edit->Demand->Visible) { // Demand ?>
	<div id="r_Demand" class="form-group row">
		<label id="elh_t_distribusi_Demand" for="x_Demand" class="<?php echo $t_distribusi_edit->LeftColumnClass ?>"><?php echo $t_distribusi_edit->Demand->caption() ?><?php echo $t_distribusi_edit->Demand->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_distribusi_edit->RightColumnClass ?>"><div <?php echo $t_distribusi_edit->Demand->cellAttributes() ?>>
<span id="el_t_distribusi_Demand">
<input type="text" data-table="t_distribusi" data-field="x_Demand" name="x_Demand" id="x_Demand" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_edit->Demand->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_edit->Demand->EditValue ?>"<?php echo $t_distribusi_edit->Demand->editAttributes() ?>>
</span>
<?php echo $t_distribusi_edit->Demand->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="t_distribusi" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($t_distribusi_edit->id->CurrentValue) ?>">
<?php if (!$t_distribusi_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_distribusi_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_distribusi_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_distribusi_edit->showPageFooter();
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
$t_distribusi_edit->terminate();
?>