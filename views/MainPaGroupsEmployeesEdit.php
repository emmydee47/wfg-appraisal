<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaGroupsEmployeesEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_groups_employees: currentTable } });
var currentForm, currentPageID;
var fmain_pa_groups_employeesedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_groups_employeesedit = new ew.Form("fmain_pa_groups_employeesedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fmain_pa_groups_employeesedit;

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_groups_employeesedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["group_id", [fields.group_id.visible && fields.group_id.required ? ew.Validators.required(fields.group_id.caption) : null], fields.group_id.isInvalid],
        ["employee_id", [fields.employee_id.visible && fields.employee_id.required ? ew.Validators.required(fields.employee_id.caption) : null], fields.employee_id.isInvalid],
        ["createdby", [fields.createdby.visible && fields.createdby.required ? ew.Validators.required(fields.createdby.caption) : null], fields.createdby.isInvalid],
        ["modifiedby", [fields.modifiedby.visible && fields.modifiedby.required ? ew.Validators.required(fields.modifiedby.caption) : null], fields.modifiedby.isInvalid],
        ["createddate", [fields.createddate.visible && fields.createddate.required ? ew.Validators.required(fields.createddate.caption) : null], fields.createddate.isInvalid],
        ["modifieddate", [fields.modifieddate.visible && fields.modifieddate.required ? ew.Validators.required(fields.modifieddate.caption) : null], fields.modifieddate.isInvalid]
    ]);

    // Form_CustomValidate
    fmain_pa_groups_employeesedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_groups_employeesedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_groups_employeesedit.lists.group_id = <?= $Page->group_id->toClientList($Page) ?>;
    fmain_pa_groups_employeesedit.lists.employee_id = <?= $Page->employee_id->toClientList($Page) ?>;
    loadjs.done("fmain_pa_groups_employeesedit");
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
<form name="fmain_pa_groups_employeesedit" id="fmain_pa_groups_employeesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_groups_employees">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "main_pa_groups") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="main_pa_groups">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->group_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_main_pa_groups_employees_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_main_pa_groups_employees_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
    <div id="r_group_id"<?= $Page->group_id->rowAttributes() ?>>
        <label id="elh_main_pa_groups_employees_group_id" for="x_group_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->group_id->caption() ?><?= $Page->group_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->group_id->cellAttributes() ?>>
<?php if ($Page->group_id->getSessionValue() != "") { ?>
<span id="el_main_pa_groups_employees_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->group_id->getDisplayValue($Page->group_id->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x_group_id" name="x_group_id" value="<?= HtmlEncode($Page->group_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_main_pa_groups_employees_group_id">
    <select
        id="x_group_id"
        name="x_group_id"
        class="form-control ew-select<?= $Page->group_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groups_employeesedit_x_group_id"
        data-table="main_pa_groups_employees"
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
loadjs.ready("fmain_pa_groups_employeesedit", function() {
    var options = { name: "x_group_id", selectId: "fmain_pa_groups_employeesedit_x_group_id" };
    if (fmain_pa_groups_employeesedit.lists.group_id.lookupOptions.length) {
        options.data = { id: "x_group_id", form: "fmain_pa_groups_employeesedit" };
    } else {
        options.ajax = { id: "x_group_id", form: "fmain_pa_groups_employeesedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups_employees.fields.group_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
    <div id="r_employee_id"<?= $Page->employee_id->rowAttributes() ?>>
        <label id="elh_main_pa_groups_employees_employee_id" for="x_employee_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_id->caption() ?><?= $Page->employee_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->employee_id->cellAttributes() ?>>
<span id="el_main_pa_groups_employees_employee_id">
    <select
        id="x_employee_id"
        name="x_employee_id"
        class="form-control ew-select<?= $Page->employee_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groups_employeesedit_x_employee_id"
        data-table="main_pa_groups_employees"
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
loadjs.ready("fmain_pa_groups_employeesedit", function() {
    var options = { name: "x_employee_id", selectId: "fmain_pa_groups_employeesedit_x_employee_id" };
    if (fmain_pa_groups_employeesedit.lists.employee_id.lookupOptions.length) {
        options.data = { id: "x_employee_id", form: "fmain_pa_groups_employeesedit" };
    } else {
        options.ajax = { id: "x_employee_id", form: "fmain_pa_groups_employeesedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups_employees.fields.employee_id.modalLookupOptions);
    ew.createModalLookup(options);
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
    ew.addEventHandlers("main_pa_groups_employees");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
