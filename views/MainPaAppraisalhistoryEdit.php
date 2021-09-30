<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaAppraisalhistoryEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_appraisalhistory: currentTable } });
var currentForm, currentPageID;
var fmain_pa_appraisalhistoryedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_appraisalhistoryedit = new ew.Form("fmain_pa_appraisalhistoryedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fmain_pa_appraisalhistoryedit;

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_appraisalhistoryedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["employee_id", [fields.employee_id.visible && fields.employee_id.required ? ew.Validators.required(fields.employee_id.caption) : null], fields.employee_id.isInvalid],
        ["pa_initialization_id", [fields.pa_initialization_id.visible && fields.pa_initialization_id.required ? ew.Validators.required(fields.pa_initialization_id.caption) : null], fields.pa_initialization_id.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
        ["createdby", [fields.createdby.visible && fields.createdby.required ? ew.Validators.required(fields.createdby.caption) : null], fields.createdby.isInvalid],
        ["modifiedby", [fields.modifiedby.visible && fields.modifiedby.required ? ew.Validators.required(fields.modifiedby.caption) : null], fields.modifiedby.isInvalid],
        ["createddate", [fields.createddate.visible && fields.createddate.required ? ew.Validators.required(fields.createddate.caption) : null], fields.createddate.isInvalid],
        ["modifieddate", [fields.modifieddate.visible && fields.modifieddate.required ? ew.Validators.required(fields.modifieddate.caption) : null], fields.modifieddate.isInvalid],
        ["isactive", [fields.isactive.visible && fields.isactive.required ? ew.Validators.required(fields.isactive.caption) : null, ew.Validators.integer], fields.isactive.isInvalid]
    ]);

    // Form_CustomValidate
    fmain_pa_appraisalhistoryedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_appraisalhistoryedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_appraisalhistoryedit.lists.employee_id = <?= $Page->employee_id->toClientList($Page) ?>;
    fmain_pa_appraisalhistoryedit.lists.pa_initialization_id = <?= $Page->pa_initialization_id->toClientList($Page) ?>;
    fmain_pa_appraisalhistoryedit.lists.createdby = <?= $Page->createdby->toClientList($Page) ?>;
    fmain_pa_appraisalhistoryedit.lists.modifiedby = <?= $Page->modifiedby->toClientList($Page) ?>;
    loadjs.done("fmain_pa_appraisalhistoryedit");
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
<form name="fmain_pa_appraisalhistoryedit" id="fmain_pa_appraisalhistoryedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_appraisalhistory">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_main_pa_appraisalhistory_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_main_pa_appraisalhistory_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_pa_appraisalhistory" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
    <div id="r_employee_id"<?= $Page->employee_id->rowAttributes() ?>>
        <label id="elh_main_pa_appraisalhistory_employee_id" for="x_employee_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_id->caption() ?><?= $Page->employee_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->employee_id->cellAttributes() ?>>
<span id="el_main_pa_appraisalhistory_employee_id">
    <select
        id="x_employee_id"
        name="x_employee_id"
        class="form-control ew-select<?= $Page->employee_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_appraisalhistoryedit_x_employee_id"
        data-table="main_pa_appraisalhistory"
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
loadjs.ready("fmain_pa_appraisalhistoryedit", function() {
    var options = { name: "x_employee_id", selectId: "fmain_pa_appraisalhistoryedit_x_employee_id" };
    if (fmain_pa_appraisalhistoryedit.lists.employee_id.lookupOptions.length) {
        options.data = { id: "x_employee_id", form: "fmain_pa_appraisalhistoryedit" };
    } else {
        options.ajax = { id: "x_employee_id", form: "fmain_pa_appraisalhistoryedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_appraisalhistory.fields.employee_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pa_initialization_id->Visible) { // pa_initialization_id ?>
    <div id="r_pa_initialization_id"<?= $Page->pa_initialization_id->rowAttributes() ?>>
        <label id="elh_main_pa_appraisalhistory_pa_initialization_id" for="x_pa_initialization_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pa_initialization_id->caption() ?><?= $Page->pa_initialization_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pa_initialization_id->cellAttributes() ?>>
<span id="el_main_pa_appraisalhistory_pa_initialization_id">
    <select
        id="x_pa_initialization_id"
        name="x_pa_initialization_id"
        class="form-control ew-select<?= $Page->pa_initialization_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_appraisalhistoryedit_x_pa_initialization_id"
        data-table="main_pa_appraisalhistory"
        data-field="x_pa_initialization_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->pa_initialization_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->pa_initialization_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->pa_initialization_id->getPlaceHolder()) ?>"
        <?= $Page->pa_initialization_id->editAttributes() ?>>
        <?= $Page->pa_initialization_id->selectOptionListHtml("x_pa_initialization_id") ?>
    </select>
    <?= $Page->pa_initialization_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->pa_initialization_id->getErrorMessage() ?></div>
<?= $Page->pa_initialization_id->Lookup->getParamTag($Page, "p_x_pa_initialization_id") ?>
<script>
loadjs.ready("fmain_pa_appraisalhistoryedit", function() {
    var options = { name: "x_pa_initialization_id", selectId: "fmain_pa_appraisalhistoryedit_x_pa_initialization_id" };
    if (fmain_pa_appraisalhistoryedit.lists.pa_initialization_id.lookupOptions.length) {
        options.data = { id: "x_pa_initialization_id", form: "fmain_pa_appraisalhistoryedit" };
    } else {
        options.ajax = { id: "x_pa_initialization_id", form: "fmain_pa_appraisalhistoryedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_appraisalhistory.fields.pa_initialization_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_main_pa_appraisalhistory_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_main_pa_appraisalhistory_description">
<textarea data-table="main_pa_appraisalhistory" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->isactive->Visible) { // isactive ?>
    <div id="r_isactive"<?= $Page->isactive->rowAttributes() ?>>
        <label id="elh_main_pa_appraisalhistory_isactive" for="x_isactive" class="<?= $Page->LeftColumnClass ?>"><?= $Page->isactive->caption() ?><?= $Page->isactive->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->isactive->cellAttributes() ?>>
<span id="el_main_pa_appraisalhistory_isactive">
<input type="<?= $Page->isactive->getInputTextType() ?>" name="x_isactive" id="x_isactive" data-table="main_pa_appraisalhistory" data-field="x_isactive" value="<?= $Page->isactive->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->isactive->getPlaceHolder()) ?>"<?= $Page->isactive->editAttributes() ?> aria-describedby="x_isactive_help">
<?= $Page->isactive->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->isactive->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
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
    ew.addEventHandlers("main_pa_appraisalhistory");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
