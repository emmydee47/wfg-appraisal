<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaRatingsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_ratings: currentTable } });
var currentForm, currentPageID;
var fmain_pa_ratingsadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_ratingsadd = new ew.Form("fmain_pa_ratingsadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fmain_pa_ratingsadd;

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_ratingsadd.addFields([
        ["rating_type", [fields.rating_type.visible && fields.rating_type.required ? ew.Validators.required(fields.rating_type.caption) : null], fields.rating_type.isInvalid],
        ["rating_value", [fields.rating_value.visible && fields.rating_value.required ? ew.Validators.required(fields.rating_value.caption) : null, ew.Validators.integer], fields.rating_value.isInvalid],
        ["rating_text", [fields.rating_text.visible && fields.rating_text.required ? ew.Validators.required(fields.rating_text.caption) : null], fields.rating_text.isInvalid],
        ["rating_description", [fields.rating_description.visible && fields.rating_description.required ? ew.Validators.required(fields.rating_description.caption) : null], fields.rating_description.isInvalid],
        ["createdby", [fields.createdby.visible && fields.createdby.required ? ew.Validators.required(fields.createdby.caption) : null], fields.createdby.isInvalid],
        ["modifiedby", [fields.modifiedby.visible && fields.modifiedby.required ? ew.Validators.required(fields.modifiedby.caption) : null], fields.modifiedby.isInvalid],
        ["createddate", [fields.createddate.visible && fields.createddate.required ? ew.Validators.required(fields.createddate.caption) : null], fields.createddate.isInvalid],
        ["modifieddate", [fields.modifieddate.visible && fields.modifieddate.required ? ew.Validators.required(fields.modifieddate.caption) : null], fields.modifieddate.isInvalid]
    ]);

    // Form_CustomValidate
    fmain_pa_ratingsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_ratingsadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_ratingsadd.lists.rating_type = <?= $Page->rating_type->toClientList($Page) ?>;
    loadjs.done("fmain_pa_ratingsadd");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fmain_pa_ratingsadd" id="fmain_pa_ratingsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_ratings">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "appraisal_ratings") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="appraisal_ratings">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->rating_type->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->rating_type->Visible) { // rating_type ?>
    <div id="r_rating_type"<?= $Page->rating_type->rowAttributes() ?>>
        <label id="elh_main_pa_ratings_rating_type" for="x_rating_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rating_type->caption() ?><?= $Page->rating_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rating_type->cellAttributes() ?>>
<?php if ($Page->rating_type->getSessionValue() != "") { ?>
<span id="el_main_pa_ratings_rating_type">
<span<?= $Page->rating_type->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->rating_type->getDisplayValue($Page->rating_type->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x_rating_type" name="x_rating_type" value="<?= HtmlEncode($Page->rating_type->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_main_pa_ratings_rating_type">
    <select
        id="x_rating_type"
        name="x_rating_type"
        class="form-select ew-select<?= $Page->rating_type->isInvalidClass() ?>"
        data-select2-id="fmain_pa_ratingsadd_x_rating_type"
        data-table="main_pa_ratings"
        data-field="x_rating_type"
        data-value-separator="<?= $Page->rating_type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->rating_type->getPlaceHolder()) ?>"
        <?= $Page->rating_type->editAttributes() ?>>
        <?= $Page->rating_type->selectOptionListHtml("x_rating_type") ?>
    </select>
    <?= $Page->rating_type->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->rating_type->getErrorMessage() ?></div>
<?= $Page->rating_type->Lookup->getParamTag($Page, "p_x_rating_type") ?>
<script>
loadjs.ready("fmain_pa_ratingsadd", function() {
    var options = { name: "x_rating_type", selectId: "fmain_pa_ratingsadd_x_rating_type" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_ratingsadd.lists.rating_type.lookupOptions.length) {
        options.data = { id: "x_rating_type", form: "fmain_pa_ratingsadd" };
    } else {
        options.ajax = { id: "x_rating_type", form: "fmain_pa_ratingsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_ratings.fields.rating_type.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rating_value->Visible) { // rating_value ?>
    <div id="r_rating_value"<?= $Page->rating_value->rowAttributes() ?>>
        <label id="elh_main_pa_ratings_rating_value" for="x_rating_value" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rating_value->caption() ?><?= $Page->rating_value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rating_value->cellAttributes() ?>>
<span id="el_main_pa_ratings_rating_value">
<input type="<?= $Page->rating_value->getInputTextType() ?>" name="x_rating_value" id="x_rating_value" data-table="main_pa_ratings" data-field="x_rating_value" value="<?= $Page->rating_value->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->rating_value->getPlaceHolder()) ?>"<?= $Page->rating_value->editAttributes() ?> aria-describedby="x_rating_value_help">
<?= $Page->rating_value->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rating_value->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rating_text->Visible) { // rating_text ?>
    <div id="r_rating_text"<?= $Page->rating_text->rowAttributes() ?>>
        <label id="elh_main_pa_ratings_rating_text" for="x_rating_text" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rating_text->caption() ?><?= $Page->rating_text->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rating_text->cellAttributes() ?>>
<span id="el_main_pa_ratings_rating_text">
<textarea data-table="main_pa_ratings" data-field="x_rating_text" name="x_rating_text" id="x_rating_text" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->rating_text->getPlaceHolder()) ?>"<?= $Page->rating_text->editAttributes() ?> aria-describedby="x_rating_text_help"><?= $Page->rating_text->EditValue ?></textarea>
<?= $Page->rating_text->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rating_text->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rating_description->Visible) { // rating_description ?>
    <div id="r_rating_description"<?= $Page->rating_description->rowAttributes() ?>>
        <label id="elh_main_pa_ratings_rating_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rating_description->caption() ?><?= $Page->rating_description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rating_description->cellAttributes() ?>>
<span id="el_main_pa_ratings_rating_description">
<?php $Page->rating_description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="main_pa_ratings" data-field="x_rating_description" name="x_rating_description" id="x_rating_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->rating_description->getPlaceHolder()) ?>"<?= $Page->rating_description->editAttributes() ?> aria-describedby="x_rating_description_help"><?= $Page->rating_description->EditValue ?></textarea>
<?= $Page->rating_description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rating_description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fmain_pa_ratingsadd", "editor"], function() {
	ew.createEditor("fmain_pa_ratingsadd", "x_rating_description", 35, 4, <?= $Page->rating_description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("main_pa_ratings");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
