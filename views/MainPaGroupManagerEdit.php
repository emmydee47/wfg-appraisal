<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaGroupManagerEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_group_manager: currentTable } });
var currentForm, currentPageID;
var fmain_pa_group_manageredit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_group_manageredit = new ew.Form("fmain_pa_group_manageredit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fmain_pa_group_manageredit;

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_group_manageredit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["business_unit", [fields.business_unit.visible && fields.business_unit.required ? ew.Validators.required(fields.business_unit.caption) : null], fields.business_unit.isInvalid],
        ["group_id", [fields.group_id.visible && fields.group_id.required ? ew.Validators.required(fields.group_id.caption) : null], fields.group_id.isInvalid],
        ["line_manager", [fields.line_manager.visible && fields.line_manager.required ? ew.Validators.required(fields.line_manager.caption) : null], fields.line_manager.isInvalid],
        ["level", [fields.level.visible && fields.level.required ? ew.Validators.required(fields.level.caption) : null], fields.level.isInvalid],
        ["created_date", [fields.created_date.visible && fields.created_date.required ? ew.Validators.required(fields.created_date.caption) : null], fields.created_date.isInvalid],
        ["updated_date", [fields.updated_date.visible && fields.updated_date.required ? ew.Validators.required(fields.updated_date.caption) : null], fields.updated_date.isInvalid]
    ]);

    // Form_CustomValidate
    fmain_pa_group_manageredit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_group_manageredit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_group_manageredit.lists.business_unit = <?= $Page->business_unit->toClientList($Page) ?>;
    fmain_pa_group_manageredit.lists.group_id = <?= $Page->group_id->toClientList($Page) ?>;
    fmain_pa_group_manageredit.lists.line_manager = <?= $Page->line_manager->toClientList($Page) ?>;
    fmain_pa_group_manageredit.lists.level = <?= $Page->level->toClientList($Page) ?>;
    loadjs.done("fmain_pa_group_manageredit");
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
<form name="fmain_pa_group_manageredit" id="fmain_pa_group_manageredit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_group_manager">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_main_pa_group_manager_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_main_pa_group_manager_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_pa_group_manager" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->business_unit->Visible) { // business_unit ?>
    <div id="r_business_unit"<?= $Page->business_unit->rowAttributes() ?>>
        <label id="elh_main_pa_group_manager_business_unit" for="x_business_unit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->business_unit->caption() ?><?= $Page->business_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->business_unit->cellAttributes() ?>>
<span id="el_main_pa_group_manager_business_unit">
    <select
        id="x_business_unit"
        name="x_business_unit"
        class="form-control ew-select<?= $Page->business_unit->isInvalidClass() ?>"
        data-select2-id="fmain_pa_group_manageredit_x_business_unit"
        data-table="main_pa_group_manager"
        data-field="x_business_unit"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->business_unit->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->business_unit->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->business_unit->getPlaceHolder()) ?>"
        <?= $Page->business_unit->editAttributes() ?>>
        <?= $Page->business_unit->selectOptionListHtml("x_business_unit") ?>
    </select>
    <?= $Page->business_unit->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->business_unit->getErrorMessage() ?></div>
<?= $Page->business_unit->Lookup->getParamTag($Page, "p_x_business_unit") ?>
<script>
loadjs.ready("fmain_pa_group_manageredit", function() {
    var options = { name: "x_business_unit", selectId: "fmain_pa_group_manageredit_x_business_unit" };
    if (fmain_pa_group_manageredit.lists.business_unit.lookupOptions.length) {
        options.data = { id: "x_business_unit", form: "fmain_pa_group_manageredit" };
    } else {
        options.ajax = { id: "x_business_unit", form: "fmain_pa_group_manageredit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_group_manager.fields.business_unit.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
    <div id="r_group_id"<?= $Page->group_id->rowAttributes() ?>>
        <label id="elh_main_pa_group_manager_group_id" for="x_group_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->group_id->caption() ?><?= $Page->group_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->group_id->cellAttributes() ?>>
<span id="el_main_pa_group_manager_group_id">
    <select
        id="x_group_id"
        name="x_group_id"
        class="form-control ew-select<?= $Page->group_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_group_manageredit_x_group_id"
        data-table="main_pa_group_manager"
        data-field="x_group_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->group_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->group_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->group_id->getPlaceHolder()) ?>"
        <?= $Page->group_id->editAttributes() ?>>
        <?= $Page->group_id->selectOptionListHtml("x_group_id") ?>
    </select>
    <?= $Page->group_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->group_id->getErrorMessage() ?></div>
<?= $Page->group_id->Lookup->getParamTag($Page, "p_x_group_id") ?>
<script>
loadjs.ready("fmain_pa_group_manageredit", function() {
    var options = { name: "x_group_id", selectId: "fmain_pa_group_manageredit_x_group_id" };
    if (fmain_pa_group_manageredit.lists.group_id.lookupOptions.length) {
        options.data = { id: "x_group_id", form: "fmain_pa_group_manageredit" };
    } else {
        options.ajax = { id: "x_group_id", form: "fmain_pa_group_manageredit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_group_manager.fields.group_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->line_manager->Visible) { // line_manager ?>
    <div id="r_line_manager"<?= $Page->line_manager->rowAttributes() ?>>
        <label id="elh_main_pa_group_manager_line_manager" for="x_line_manager" class="<?= $Page->LeftColumnClass ?>"><?= $Page->line_manager->caption() ?><?= $Page->line_manager->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->line_manager->cellAttributes() ?>>
<span id="el_main_pa_group_manager_line_manager">
    <select
        id="x_line_manager"
        name="x_line_manager"
        class="form-control ew-select<?= $Page->line_manager->isInvalidClass() ?>"
        data-select2-id="fmain_pa_group_manageredit_x_line_manager"
        data-table="main_pa_group_manager"
        data-field="x_line_manager"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->line_manager->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->line_manager->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->line_manager->getPlaceHolder()) ?>"
        <?= $Page->line_manager->editAttributes() ?>>
        <?= $Page->line_manager->selectOptionListHtml("x_line_manager") ?>
    </select>
    <?= $Page->line_manager->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->line_manager->getErrorMessage() ?></div>
<?= $Page->line_manager->Lookup->getParamTag($Page, "p_x_line_manager") ?>
<script>
loadjs.ready("fmain_pa_group_manageredit", function() {
    var options = { name: "x_line_manager", selectId: "fmain_pa_group_manageredit_x_line_manager" };
    if (fmain_pa_group_manageredit.lists.line_manager.lookupOptions.length) {
        options.data = { id: "x_line_manager", form: "fmain_pa_group_manageredit" };
    } else {
        options.ajax = { id: "x_line_manager", form: "fmain_pa_group_manageredit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_group_manager.fields.line_manager.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->level->Visible) { // level ?>
    <div id="r_level"<?= $Page->level->rowAttributes() ?>>
        <label id="elh_main_pa_group_manager_level" for="x_level" class="<?= $Page->LeftColumnClass ?>"><?= $Page->level->caption() ?><?= $Page->level->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->level->cellAttributes() ?>>
<span id="el_main_pa_group_manager_level">
    <select
        id="x_level"
        name="x_level"
        class="form-select ew-select<?= $Page->level->isInvalidClass() ?>"
        data-select2-id="fmain_pa_group_manageredit_x_level"
        data-table="main_pa_group_manager"
        data-field="x_level"
        data-value-separator="<?= $Page->level->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->level->getPlaceHolder()) ?>"
        <?= $Page->level->editAttributes() ?>>
        <?= $Page->level->selectOptionListHtml("x_level") ?>
    </select>
    <?= $Page->level->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->level->getErrorMessage() ?></div>
<script>
loadjs.ready("fmain_pa_group_manageredit", function() {
    var options = { name: "x_level", selectId: "fmain_pa_group_manageredit_x_level" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_group_manageredit.lists.level.lookupOptions.length) {
        options.data = { id: "x_level", form: "fmain_pa_group_manageredit" };
    } else {
        options.ajax = { id: "x_level", form: "fmain_pa_group_manageredit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_group_manager.fields.level.selectOptions);
    ew.createSelect(options);
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
    ew.addEventHandlers("main_pa_group_manager");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
