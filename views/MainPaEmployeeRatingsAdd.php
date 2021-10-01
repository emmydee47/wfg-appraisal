<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaEmployeeRatingsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_employee_ratings: currentTable } });
var currentForm, currentPageID;
var fmain_pa_employee_ratingsadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_employee_ratingsadd = new ew.Form("fmain_pa_employee_ratingsadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fmain_pa_employee_ratingsadd;

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_employee_ratingsadd.addFields([
        ["appraisal_id", [fields.appraisal_id.visible && fields.appraisal_id.required ? ew.Validators.required(fields.appraisal_id.caption) : null], fields.appraisal_id.isInvalid],
        ["employee_id", [fields.employee_id.visible && fields.employee_id.required ? ew.Validators.required(fields.employee_id.caption) : null], fields.employee_id.isInvalid],
        ["consolidated_rating", [fields.consolidated_rating.visible && fields.consolidated_rating.required ? ew.Validators.required(fields.consolidated_rating.caption) : null, ew.Validators.float], fields.consolidated_rating.isInvalid],
        ["appraisal_status", [fields.appraisal_status.visible && fields.appraisal_status.required ? ew.Validators.required(fields.appraisal_status.caption) : null], fields.appraisal_status.isInvalid],
        ["createdby", [fields.createdby.visible && fields.createdby.required ? ew.Validators.required(fields.createdby.caption) : null], fields.createdby.isInvalid],
        ["modifiedby", [fields.modifiedby.visible && fields.modifiedby.required ? ew.Validators.required(fields.modifiedby.caption) : null], fields.modifiedby.isInvalid],
        ["createddate", [fields.createddate.visible && fields.createddate.required ? ew.Validators.required(fields.createddate.caption) : null], fields.createddate.isInvalid],
        ["modifieddate", [fields.modifieddate.visible && fields.modifieddate.required ? ew.Validators.required(fields.modifieddate.caption) : null], fields.modifieddate.isInvalid],
        ["isactive", [fields.isactive.visible && fields.isactive.required ? ew.Validators.required(fields.isactive.caption) : null], fields.isactive.isInvalid],
        ["group_id", [fields.group_id.visible && fields.group_id.required ? ew.Validators.required(fields.group_id.caption) : null, ew.Validators.integer], fields.group_id.isInvalid]
    ]);

    // Form_CustomValidate
    fmain_pa_employee_ratingsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_employee_ratingsadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_employee_ratingsadd.lists.appraisal_id = <?= $Page->appraisal_id->toClientList($Page) ?>;
    fmain_pa_employee_ratingsadd.lists.employee_id = <?= $Page->employee_id->toClientList($Page) ?>;
    fmain_pa_employee_ratingsadd.lists.appraisal_status = <?= $Page->appraisal_status->toClientList($Page) ?>;
    fmain_pa_employee_ratingsadd.lists.isactive = <?= $Page->isactive->toClientList($Page) ?>;
    loadjs.done("fmain_pa_employee_ratingsadd");
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
<form name="fmain_pa_employee_ratingsadd" id="fmain_pa_employee_ratingsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_employee_ratings">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->appraisal_id->Visible) { // appraisal_id ?>
    <div id="r_appraisal_id"<?= $Page->appraisal_id->rowAttributes() ?>>
        <label id="elh_main_pa_employee_ratings_appraisal_id" for="x_appraisal_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->appraisal_id->caption() ?><?= $Page->appraisal_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->appraisal_id->cellAttributes() ?>>
<span id="el_main_pa_employee_ratings_appraisal_id">
    <select
        id="x_appraisal_id"
        name="x_appraisal_id"
        class="form-control ew-select<?= $Page->appraisal_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_employee_ratingsadd_x_appraisal_id"
        data-table="main_pa_employee_ratings"
        data-field="x_appraisal_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->appraisal_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->appraisal_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->appraisal_id->getPlaceHolder()) ?>"
        <?= $Page->appraisal_id->editAttributes() ?>>
        <?= $Page->appraisal_id->selectOptionListHtml("x_appraisal_id") ?>
    </select>
    <?= $Page->appraisal_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->appraisal_id->getErrorMessage() ?></div>
<?= $Page->appraisal_id->Lookup->getParamTag($Page, "p_x_appraisal_id") ?>
<script>
loadjs.ready("fmain_pa_employee_ratingsadd", function() {
    var options = { name: "x_appraisal_id", selectId: "fmain_pa_employee_ratingsadd_x_appraisal_id" };
    if (fmain_pa_employee_ratingsadd.lists.appraisal_id.lookupOptions.length) {
        options.data = { id: "x_appraisal_id", form: "fmain_pa_employee_ratingsadd" };
    } else {
        options.ajax = { id: "x_appraisal_id", form: "fmain_pa_employee_ratingsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_employee_ratings.fields.appraisal_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
    <div id="r_employee_id"<?= $Page->employee_id->rowAttributes() ?>>
        <label id="elh_main_pa_employee_ratings_employee_id" for="x_employee_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_id->caption() ?><?= $Page->employee_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->employee_id->cellAttributes() ?>>
<span id="el_main_pa_employee_ratings_employee_id">
    <select
        id="x_employee_id"
        name="x_employee_id"
        class="form-control ew-select<?= $Page->employee_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_employee_ratingsadd_x_employee_id"
        data-table="main_pa_employee_ratings"
        data-field="x_employee_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->employee_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->employee_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->employee_id->getPlaceHolder()) ?>"
        <?= $Page->employee_id->editAttributes() ?>>
        <?= $Page->employee_id->selectOptionListHtml("x_employee_id") ?>
    </select>
    <?= $Page->employee_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->employee_id->getErrorMessage() ?></div>
<?= $Page->employee_id->Lookup->getParamTag($Page, "p_x_employee_id") ?>
<script>
loadjs.ready("fmain_pa_employee_ratingsadd", function() {
    var options = { name: "x_employee_id", selectId: "fmain_pa_employee_ratingsadd_x_employee_id" };
    if (fmain_pa_employee_ratingsadd.lists.employee_id.lookupOptions.length) {
        options.data = { id: "x_employee_id", form: "fmain_pa_employee_ratingsadd" };
    } else {
        options.ajax = { id: "x_employee_id", form: "fmain_pa_employee_ratingsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_employee_ratings.fields.employee_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->consolidated_rating->Visible) { // consolidated_rating ?>
    <div id="r_consolidated_rating"<?= $Page->consolidated_rating->rowAttributes() ?>>
        <label id="elh_main_pa_employee_ratings_consolidated_rating" for="x_consolidated_rating" class="<?= $Page->LeftColumnClass ?>"><?= $Page->consolidated_rating->caption() ?><?= $Page->consolidated_rating->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->consolidated_rating->cellAttributes() ?>>
<span id="el_main_pa_employee_ratings_consolidated_rating">
<input type="<?= $Page->consolidated_rating->getInputTextType() ?>" name="x_consolidated_rating" id="x_consolidated_rating" data-table="main_pa_employee_ratings" data-field="x_consolidated_rating" value="<?= $Page->consolidated_rating->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->consolidated_rating->getPlaceHolder()) ?>"<?= $Page->consolidated_rating->editAttributes() ?> aria-describedby="x_consolidated_rating_help">
<?= $Page->consolidated_rating->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->consolidated_rating->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->appraisal_status->Visible) { // appraisal_status ?>
    <div id="r_appraisal_status"<?= $Page->appraisal_status->rowAttributes() ?>>
        <label id="elh_main_pa_employee_ratings_appraisal_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->appraisal_status->caption() ?><?= $Page->appraisal_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->appraisal_status->cellAttributes() ?>>
<span id="el_main_pa_employee_ratings_appraisal_status">
<template id="tp_x_appraisal_status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="main_pa_employee_ratings" data-field="x_appraisal_status" name="x_appraisal_status" id="x_appraisal_status"<?= $Page->appraisal_status->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_appraisal_status" class="ew-item-list"></div>
<selection-list hidden
    id="x_appraisal_status"
    name="x_appraisal_status"
    value="<?= HtmlEncode($Page->appraisal_status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_appraisal_status"
    data-bs-target="dsl_x_appraisal_status"
    data-repeatcolumn="5"
    class="form-control<?= $Page->appraisal_status->isInvalidClass() ?>"
    data-table="main_pa_employee_ratings"
    data-field="x_appraisal_status"
    data-value-separator="<?= $Page->appraisal_status->displayValueSeparatorAttribute() ?>"
    <?= $Page->appraisal_status->editAttributes() ?>></selection-list>
<?= $Page->appraisal_status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->appraisal_status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->isactive->Visible) { // isactive ?>
    <div id="r_isactive"<?= $Page->isactive->rowAttributes() ?>>
        <label id="elh_main_pa_employee_ratings_isactive" class="<?= $Page->LeftColumnClass ?>"><?= $Page->isactive->caption() ?><?= $Page->isactive->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->isactive->cellAttributes() ?>>
<span id="el_main_pa_employee_ratings_isactive">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->isactive->isInvalidClass() ?>" data-table="main_pa_employee_ratings" data-field="x_isactive" name="x_isactive[]" id="x_isactive_410470" value="1"<?= ConvertToBool($Page->isactive->CurrentValue) ? " checked" : "" ?><?= $Page->isactive->editAttributes() ?> aria-describedby="x_isactive_help">
    <div class="invalid-feedback"><?= $Page->isactive->getErrorMessage() ?></div>
</div>
<?= $Page->isactive->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
    <div id="r_group_id"<?= $Page->group_id->rowAttributes() ?>>
        <label id="elh_main_pa_employee_ratings_group_id" for="x_group_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->group_id->caption() ?><?= $Page->group_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->group_id->cellAttributes() ?>>
<span id="el_main_pa_employee_ratings_group_id">
<input type="<?= $Page->group_id->getInputTextType() ?>" name="x_group_id" id="x_group_id" data-table="main_pa_employee_ratings" data-field="x_group_id" value="<?= $Page->group_id->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->group_id->getPlaceHolder()) ?>"<?= $Page->group_id->editAttributes() ?> aria-describedby="x_group_id_help">
<?= $Page->group_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->group_id->getErrorMessage() ?></div>
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
    ew.addEventHandlers("main_pa_employee_ratings");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
