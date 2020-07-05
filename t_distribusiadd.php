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
$t_distribusi_add = new t_distribusi_add();

// Run the page
$t_distribusi_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_distribusi_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_distribusiadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ft_distribusiadd = currentForm = new ew.Form("ft_distribusiadd", "add");

	// Validate form
	ft_distribusiadd.validate = function() {
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
			<?php if ($t_distribusi_add->source_id->Required) { ?>
				elm = this.getElements("x" + infix + "_source_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_add->source_id->caption(), $t_distribusi_add->source_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_distribusi_add->destination_id->Required) { ?>
				elm = this.getElements("x" + infix + "_destination_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_add->destination_id->caption(), $t_distribusi_add->destination_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_distribusi_add->Jarak->Required) { ?>
				elm = this.getElements("x" + infix + "_Jarak");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_add->Jarak->caption(), $t_distribusi_add->Jarak->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Jarak");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_distribusi_add->Jarak->errorMessage()) ?>");
			<?php if ($t_distribusi_add->Rate_O->Required) { ?>
				elm = this.getElements("x" + infix + "_Rate_O");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_add->Rate_O->caption(), $t_distribusi_add->Rate_O->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rate_O");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_distribusi_add->Rate_O->errorMessage()) ?>");
			<?php if ($t_distribusi_add->Rate_D->Required) { ?>
				elm = this.getElements("x" + infix + "_Rate_D");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_add->Rate_D->caption(), $t_distribusi_add->Rate_D->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rate_D");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_distribusi_add->Rate_D->errorMessage()) ?>");
			<?php if ($t_distribusi_add->Demand->Required) { ?>
				elm = this.getElements("x" + infix + "_Demand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_add->Demand->caption(), $t_distribusi_add->Demand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Demand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_distribusi_add->Demand->errorMessage()) ?>");

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
	ft_distribusiadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_distribusiadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_distribusiadd.lists["x_source_id"] = <?php echo $t_distribusi_add->source_id->Lookup->toClientList($t_distribusi_add) ?>;
	ft_distribusiadd.lists["x_source_id"].options = <?php echo JsonEncode($t_distribusi_add->source_id->lookupOptions()) ?>;
	ft_distribusiadd.lists["x_destination_id"] = <?php echo $t_distribusi_add->destination_id->Lookup->toClientList($t_distribusi_add) ?>;
	ft_distribusiadd.lists["x_destination_id"].options = <?php echo JsonEncode($t_distribusi_add->destination_id->lookupOptions()) ?>;
	loadjs.done("ft_distribusiadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_distribusi_add->showPageHeader(); ?>
<?php
$t_distribusi_add->showMessage();
?>
<form name="ft_distribusiadd" id="ft_distribusiadd" class="<?php echo $t_distribusi_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_distribusi">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_distribusi_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($t_distribusi_add->source_id->Visible) { // source_id ?>
	<div id="r_source_id" class="form-group row">
		<label id="elh_t_distribusi_source_id" for="x_source_id" class="<?php echo $t_distribusi_add->LeftColumnClass ?>"><?php echo $t_distribusi_add->source_id->caption() ?><?php echo $t_distribusi_add->source_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_distribusi_add->RightColumnClass ?>"><div <?php echo $t_distribusi_add->source_id->cellAttributes() ?>>
<span id="el_t_distribusi_source_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_distribusi" data-field="x_source_id" data-value-separator="<?php echo $t_distribusi_add->source_id->displayValueSeparatorAttribute() ?>" id="x_source_id" name="x_source_id"<?php echo $t_distribusi_add->source_id->editAttributes() ?>>
			<?php echo $t_distribusi_add->source_id->selectOptionListHtml("x_source_id") ?>
		</select>
</div>
<?php echo $t_distribusi_add->source_id->Lookup->getParamTag($t_distribusi_add, "p_x_source_id") ?>
</span>
<?php echo $t_distribusi_add->source_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_distribusi_add->destination_id->Visible) { // destination_id ?>
	<div id="r_destination_id" class="form-group row">
		<label id="elh_t_distribusi_destination_id" for="x_destination_id" class="<?php echo $t_distribusi_add->LeftColumnClass ?>"><?php echo $t_distribusi_add->destination_id->caption() ?><?php echo $t_distribusi_add->destination_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_distribusi_add->RightColumnClass ?>"><div <?php echo $t_distribusi_add->destination_id->cellAttributes() ?>>
<span id="el_t_distribusi_destination_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_distribusi" data-field="x_destination_id" data-value-separator="<?php echo $t_distribusi_add->destination_id->displayValueSeparatorAttribute() ?>" id="x_destination_id" name="x_destination_id"<?php echo $t_distribusi_add->destination_id->editAttributes() ?>>
			<?php echo $t_distribusi_add->destination_id->selectOptionListHtml("x_destination_id") ?>
		</select>
</div>
<?php echo $t_distribusi_add->destination_id->Lookup->getParamTag($t_distribusi_add, "p_x_destination_id") ?>
</span>
<?php echo $t_distribusi_add->destination_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_distribusi_add->Jarak->Visible) { // Jarak ?>
	<div id="r_Jarak" class="form-group row">
		<label id="elh_t_distribusi_Jarak" for="x_Jarak" class="<?php echo $t_distribusi_add->LeftColumnClass ?>"><?php echo $t_distribusi_add->Jarak->caption() ?><?php echo $t_distribusi_add->Jarak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_distribusi_add->RightColumnClass ?>"><div <?php echo $t_distribusi_add->Jarak->cellAttributes() ?>>
<span id="el_t_distribusi_Jarak">
<input type="text" data-table="t_distribusi" data-field="x_Jarak" name="x_Jarak" id="x_Jarak" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_add->Jarak->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_add->Jarak->EditValue ?>"<?php echo $t_distribusi_add->Jarak->editAttributes() ?>>
</span>
<?php echo $t_distribusi_add->Jarak->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_distribusi_add->Rate_O->Visible) { // Rate_O ?>
	<div id="r_Rate_O" class="form-group row">
		<label id="elh_t_distribusi_Rate_O" for="x_Rate_O" class="<?php echo $t_distribusi_add->LeftColumnClass ?>"><?php echo $t_distribusi_add->Rate_O->caption() ?><?php echo $t_distribusi_add->Rate_O->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_distribusi_add->RightColumnClass ?>"><div <?php echo $t_distribusi_add->Rate_O->cellAttributes() ?>>
<span id="el_t_distribusi_Rate_O">
<input type="text" data-table="t_distribusi" data-field="x_Rate_O" name="x_Rate_O" id="x_Rate_O" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_add->Rate_O->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_add->Rate_O->EditValue ?>"<?php echo $t_distribusi_add->Rate_O->editAttributes() ?>>
</span>
<?php echo $t_distribusi_add->Rate_O->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_distribusi_add->Rate_D->Visible) { // Rate_D ?>
	<div id="r_Rate_D" class="form-group row">
		<label id="elh_t_distribusi_Rate_D" for="x_Rate_D" class="<?php echo $t_distribusi_add->LeftColumnClass ?>"><?php echo $t_distribusi_add->Rate_D->caption() ?><?php echo $t_distribusi_add->Rate_D->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_distribusi_add->RightColumnClass ?>"><div <?php echo $t_distribusi_add->Rate_D->cellAttributes() ?>>
<span id="el_t_distribusi_Rate_D">
<input type="text" data-table="t_distribusi" data-field="x_Rate_D" name="x_Rate_D" id="x_Rate_D" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_add->Rate_D->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_add->Rate_D->EditValue ?>"<?php echo $t_distribusi_add->Rate_D->editAttributes() ?>>
</span>
<?php echo $t_distribusi_add->Rate_D->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_distribusi_add->Demand->Visible) { // Demand ?>
	<div id="r_Demand" class="form-group row">
		<label id="elh_t_distribusi_Demand" for="x_Demand" class="<?php echo $t_distribusi_add->LeftColumnClass ?>"><?php echo $t_distribusi_add->Demand->caption() ?><?php echo $t_distribusi_add->Demand->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_distribusi_add->RightColumnClass ?>"><div <?php echo $t_distribusi_add->Demand->cellAttributes() ?>>
<span id="el_t_distribusi_Demand">
<input type="text" data-table="t_distribusi" data-field="x_Demand" name="x_Demand" id="x_Demand" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_add->Demand->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_add->Demand->EditValue ?>"<?php echo $t_distribusi_add->Demand->editAttributes() ?>>
</span>
<?php echo $t_distribusi_add->Demand->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_distribusi_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_distribusi_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_distribusi_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_distribusi_add->showPageFooter();
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
$t_distribusi_add->terminate();
?>