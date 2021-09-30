<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaInitializationAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_initialization: currentTable } });
var currentForm, currentPageID;
var fmain_pa_initializationadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_initializationadd = new ew.Form("fmain_pa_initializationadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fmain_pa_initializationadd;

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_initializationadd.addFields([
        ["business_unit", [fields.business_unit.visible && fields.business_unit.required ? ew.Validators.required(fields.business_unit.caption) : null], fields.business_unit.isInvalid],
        ["group_id", [fields.group_id.visible && fields.group_id.required ? ew.Validators.required(fields.group_id.caption) : null], fields.group_id.isInvalid],
        ["appraisal_mode", [fields.appraisal_mode.visible && fields.appraisal_mode.required ? ew.Validators.required(fields.appraisal_mode.caption) : null], fields.appraisal_mode.isInvalid],
        ["appraisal_period", [fields.appraisal_period.visible && fields.appraisal_period.required ? ew.Validators.required(fields.appraisal_period.caption) : null], fields.appraisal_period.isInvalid],
        ["from_year", [fields.from_year.visible && fields.from_year.required ? ew.Validators.required(fields.from_year.caption) : null], fields.from_year.isInvalid],
        ["to_year", [fields.to_year.visible && fields.to_year.required ? ew.Validators.required(fields.to_year.caption) : null], fields.to_year.isInvalid],
        ["employees_due_date", [fields.employees_due_date.visible && fields.employees_due_date.required ? ew.Validators.required(fields.employees_due_date.caption) : null, ew.Validators.datetime(fields.employees_due_date.clientFormatPattern)], fields.employees_due_date.isInvalid],
        ["managers_due_date", [fields.managers_due_date.visible && fields.managers_due_date.required ? ew.Validators.required(fields.managers_due_date.caption) : null, ew.Validators.datetime(fields.managers_due_date.clientFormatPattern)], fields.managers_due_date.isInvalid],
        ["initialize_status", [fields.initialize_status.visible && fields.initialize_status.required ? ew.Validators.required(fields.initialize_status.caption) : null], fields.initialize_status.isInvalid],
        ["appraisal_ratings", [fields.appraisal_ratings.visible && fields.appraisal_ratings.required ? ew.Validators.required(fields.appraisal_ratings.caption) : null], fields.appraisal_ratings.isInvalid],
        ["isactive", [fields.isactive.visible && fields.isactive.required ? ew.Validators.required(fields.isactive.caption) : null], fields.isactive.isInvalid],
        ["createdby", [fields.createdby.visible && fields.createdby.required ? ew.Validators.required(fields.createdby.caption) : null], fields.createdby.isInvalid],
        ["modifiedby", [fields.modifiedby.visible && fields.modifiedby.required ? ew.Validators.required(fields.modifiedby.caption) : null], fields.modifiedby.isInvalid],
        ["createddate", [fields.createddate.visible && fields.createddate.required ? ew.Validators.required(fields.createddate.caption) : null], fields.createddate.isInvalid],
        ["modifieddate", [fields.modifieddate.visible && fields.modifieddate.required ? ew.Validators.required(fields.modifieddate.caption) : null], fields.modifieddate.isInvalid]
    ]);

    // Form_CustomValidate
    fmain_pa_initializationadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_initializationadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_initializationadd.lists.business_unit = <?= $Page->business_unit->toClientList($Page) ?>;
    fmain_pa_initializationadd.lists.group_id = <?= $Page->group_id->toClientList($Page) ?>;
    fmain_pa_initializationadd.lists.appraisal_mode = <?= $Page->appraisal_mode->toClientList($Page) ?>;
    fmain_pa_initializationadd.lists.appraisal_period = <?= $Page->appraisal_period->toClientList($Page) ?>;
    fmain_pa_initializationadd.lists.from_year = <?= $Page->from_year->toClientList($Page) ?>;
    fmain_pa_initializationadd.lists.to_year = <?= $Page->to_year->toClientList($Page) ?>;
    fmain_pa_initializationadd.lists.initialize_status = <?= $Page->initialize_status->toClientList($Page) ?>;
    fmain_pa_initializationadd.lists.appraisal_ratings = <?= $Page->appraisal_ratings->toClientList($Page) ?>;
    fmain_pa_initializationadd.lists.isactive = <?= $Page->isactive->toClientList($Page) ?>;
    loadjs.done("fmain_pa_initializationadd");
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
<form name="fmain_pa_initializationadd" id="fmain_pa_initializationadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_initialization">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->business_unit->Visible) { // business_unit ?>
    <div id="r_business_unit"<?= $Page->business_unit->rowAttributes() ?>>
        <label id="elh_main_pa_initialization_business_unit" for="x_business_unit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->business_unit->caption() ?><?= $Page->business_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->business_unit->cellAttributes() ?>>
<span id="el_main_pa_initialization_business_unit">
<?php $Page->business_unit->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_business_unit"
        name="x_business_unit"
        class="form-control ew-select<?= $Page->business_unit->isInvalidClass() ?>"
        data-select2-id="fmain_pa_initializationadd_x_business_unit"
        data-table="main_pa_initialization"
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
loadjs.ready("fmain_pa_initializationadd", function() {
    var options = { name: "x_business_unit", selectId: "fmain_pa_initializationadd_x_business_unit" };
    if (fmain_pa_initializationadd.lists.business_unit.lookupOptions.length) {
        options.data = { id: "x_business_unit", form: "fmain_pa_initializationadd" };
    } else {
        options.ajax = { id: "x_business_unit", form: "fmain_pa_initializationadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_initialization.fields.business_unit.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
    <div id="r_group_id"<?= $Page->group_id->rowAttributes() ?>>
        <label id="elh_main_pa_initialization_group_id" for="x_group_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->group_id->caption() ?><?= $Page->group_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->group_id->cellAttributes() ?>>
<span id="el_main_pa_initialization_group_id">
    <select
        id="x_group_id"
        name="x_group_id"
        class="form-control ew-select<?= $Page->group_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_initializationadd_x_group_id"
        data-table="main_pa_initialization"
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
loadjs.ready("fmain_pa_initializationadd", function() {
    var options = { name: "x_group_id", selectId: "fmain_pa_initializationadd_x_group_id" };
    if (fmain_pa_initializationadd.lists.group_id.lookupOptions.length) {
        options.data = { id: "x_group_id", form: "fmain_pa_initializationadd" };
    } else {
        options.ajax = { id: "x_group_id", form: "fmain_pa_initializationadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_initialization.fields.group_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->appraisal_mode->Visible) { // appraisal_mode ?>
    <div id="r_appraisal_mode"<?= $Page->appraisal_mode->rowAttributes() ?>>
        <label id="elh_main_pa_initialization_appraisal_mode" class="<?= $Page->LeftColumnClass ?>"><?= $Page->appraisal_mode->caption() ?><?= $Page->appraisal_mode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->appraisal_mode->cellAttributes() ?>>
<span id="el_main_pa_initialization_appraisal_mode">
<template id="tp_x_appraisal_mode">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="main_pa_initialization" data-field="x_appraisal_mode" name="x_appraisal_mode" id="x_appraisal_mode"<?= $Page->appraisal_mode->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_appraisal_mode" class="ew-item-list"></div>
<selection-list hidden
    id="x_appraisal_mode"
    name="x_appraisal_mode"
    value="<?= HtmlEncode($Page->appraisal_mode->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_appraisal_mode"
    data-bs-target="dsl_x_appraisal_mode"
    data-repeatcolumn="5"
    class="form-control<?= $Page->appraisal_mode->isInvalidClass() ?>"
    data-table="main_pa_initialization"
    data-field="x_appraisal_mode"
    data-value-separator="<?= $Page->appraisal_mode->displayValueSeparatorAttribute() ?>"
    <?= $Page->appraisal_mode->editAttributes() ?>></selection-list>
<?= $Page->appraisal_mode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->appraisal_mode->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->appraisal_period->Visible) { // appraisal_period ?>
    <div id="r_appraisal_period"<?= $Page->appraisal_period->rowAttributes() ?>>
        <label id="elh_main_pa_initialization_appraisal_period" for="x_appraisal_period" class="<?= $Page->LeftColumnClass ?>"><?= $Page->appraisal_period->caption() ?><?= $Page->appraisal_period->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->appraisal_period->cellAttributes() ?>>
<span id="el_main_pa_initialization_appraisal_period">
    <select
        id="x_appraisal_period"
        name="x_appraisal_period"
        class="form-select ew-select<?= $Page->appraisal_period->isInvalidClass() ?>"
        data-select2-id="fmain_pa_initializationadd_x_appraisal_period"
        data-table="main_pa_initialization"
        data-field="x_appraisal_period"
        data-value-separator="<?= $Page->appraisal_period->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->appraisal_period->getPlaceHolder()) ?>"
        <?= $Page->appraisal_period->editAttributes() ?>>
        <?= $Page->appraisal_period->selectOptionListHtml("x_appraisal_period") ?>
    </select>
    <?= $Page->appraisal_period->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->appraisal_period->getErrorMessage() ?></div>
<script>
loadjs.ready("fmain_pa_initializationadd", function() {
    var options = { name: "x_appraisal_period", selectId: "fmain_pa_initializationadd_x_appraisal_period" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_initializationadd.lists.appraisal_period.lookupOptions.length) {
        options.data = { id: "x_appraisal_period", form: "fmain_pa_initializationadd" };
    } else {
        options.ajax = { id: "x_appraisal_period", form: "fmain_pa_initializationadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_initialization.fields.appraisal_period.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->from_year->Visible) { // from_year ?>
    <div id="r_from_year"<?= $Page->from_year->rowAttributes() ?>>
        <label id="elh_main_pa_initialization_from_year" for="x_from_year" class="<?= $Page->LeftColumnClass ?>"><?= $Page->from_year->caption() ?><?= $Page->from_year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->from_year->cellAttributes() ?>>
<span id="el_main_pa_initialization_from_year">
    <select
        id="x_from_year"
        name="x_from_year"
        class="form-select ew-select<?= $Page->from_year->isInvalidClass() ?>"
        data-select2-id="fmain_pa_initializationadd_x_from_year"
        data-table="main_pa_initialization"
        data-field="x_from_year"
        data-value-separator="<?= $Page->from_year->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->from_year->getPlaceHolder()) ?>"
        <?= $Page->from_year->editAttributes() ?>>
        <?= $Page->from_year->selectOptionListHtml("x_from_year") ?>
    </select>
    <?= $Page->from_year->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->from_year->getErrorMessage() ?></div>
<script>
loadjs.ready("fmain_pa_initializationadd", function() {
    var options = { name: "x_from_year", selectId: "fmain_pa_initializationadd_x_from_year" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_initializationadd.lists.from_year.lookupOptions.length) {
        options.data = { id: "x_from_year", form: "fmain_pa_initializationadd" };
    } else {
        options.ajax = { id: "x_from_year", form: "fmain_pa_initializationadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_initialization.fields.from_year.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->to_year->Visible) { // to_year ?>
    <div id="r_to_year"<?= $Page->to_year->rowAttributes() ?>>
        <label id="elh_main_pa_initialization_to_year" for="x_to_year" class="<?= $Page->LeftColumnClass ?>"><?= $Page->to_year->caption() ?><?= $Page->to_year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->to_year->cellAttributes() ?>>
<span id="el_main_pa_initialization_to_year">
    <select
        id="x_to_year"
        name="x_to_year"
        class="form-select ew-select<?= $Page->to_year->isInvalidClass() ?>"
        data-select2-id="fmain_pa_initializationadd_x_to_year"
        data-table="main_pa_initialization"
        data-field="x_to_year"
        data-value-separator="<?= $Page->to_year->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->to_year->getPlaceHolder()) ?>"
        <?= $Page->to_year->editAttributes() ?>>
        <?= $Page->to_year->selectOptionListHtml("x_to_year") ?>
    </select>
    <?= $Page->to_year->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->to_year->getErrorMessage() ?></div>
<script>
loadjs.ready("fmain_pa_initializationadd", function() {
    var options = { name: "x_to_year", selectId: "fmain_pa_initializationadd_x_to_year" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_initializationadd.lists.to_year.lookupOptions.length) {
        options.data = { id: "x_to_year", form: "fmain_pa_initializationadd" };
    } else {
        options.ajax = { id: "x_to_year", form: "fmain_pa_initializationadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_initialization.fields.to_year.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employees_due_date->Visible) { // employees_due_date ?>
    <div id="r_employees_due_date"<?= $Page->employees_due_date->rowAttributes() ?>>
        <label id="elh_main_pa_initialization_employees_due_date" for="x_employees_due_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employees_due_date->caption() ?><?= $Page->employees_due_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->employees_due_date->cellAttributes() ?>>
<span id="el_main_pa_initialization_employees_due_date">
<input type="<?= $Page->employees_due_date->getInputTextType() ?>" name="x_employees_due_date" id="x_employees_due_date" data-table="main_pa_initialization" data-field="x_employees_due_date" value="<?= $Page->employees_due_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->employees_due_date->getPlaceHolder()) ?>"<?= $Page->employees_due_date->editAttributes() ?> aria-describedby="x_employees_due_date_help">
<?= $Page->employees_due_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employees_due_date->getErrorMessage() ?></div>
<?php if (!$Page->employees_due_date->ReadOnly && !$Page->employees_due_date->Disabled && !isset($Page->employees_due_date->EditAttrs["readonly"]) && !isset($Page->employees_due_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmain_pa_initializationadd", "datetimepicker"], function () {
    let options = {
        localization: {
            locale: ew.LANGUAGE_ID
        },
        display: {
            inputFormat: "<?= DateFormat(0) ?>",
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fmain_pa_initializationadd", "x_employees_due_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->managers_due_date->Visible) { // managers_due_date ?>
    <div id="r_managers_due_date"<?= $Page->managers_due_date->rowAttributes() ?>>
        <label id="elh_main_pa_initialization_managers_due_date" for="x_managers_due_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->managers_due_date->caption() ?><?= $Page->managers_due_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->managers_due_date->cellAttributes() ?>>
<span id="el_main_pa_initialization_managers_due_date">
<input type="<?= $Page->managers_due_date->getInputTextType() ?>" name="x_managers_due_date" id="x_managers_due_date" data-table="main_pa_initialization" data-field="x_managers_due_date" value="<?= $Page->managers_due_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->managers_due_date->getPlaceHolder()) ?>"<?= $Page->managers_due_date->editAttributes() ?> aria-describedby="x_managers_due_date_help">
<?= $Page->managers_due_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->managers_due_date->getErrorMessage() ?></div>
<?php if (!$Page->managers_due_date->ReadOnly && !$Page->managers_due_date->Disabled && !isset($Page->managers_due_date->EditAttrs["readonly"]) && !isset($Page->managers_due_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmain_pa_initializationadd", "datetimepicker"], function () {
    let options = {
        localization: {
            locale: ew.LANGUAGE_ID
        },
        display: {
            inputFormat: "<?= DateFormat(0) ?>",
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fmain_pa_initializationadd", "x_managers_due_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->initialize_status->Visible) { // initialize_status ?>
    <div id="r_initialize_status"<?= $Page->initialize_status->rowAttributes() ?>>
        <label id="elh_main_pa_initialization_initialize_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->initialize_status->caption() ?><?= $Page->initialize_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->initialize_status->cellAttributes() ?>>
<span id="el_main_pa_initialization_initialize_status">
<template id="tp_x_initialize_status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="main_pa_initialization" data-field="x_initialize_status" name="x_initialize_status" id="x_initialize_status"<?= $Page->initialize_status->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_initialize_status" class="ew-item-list"></div>
<selection-list hidden
    id="x_initialize_status"
    name="x_initialize_status"
    value="<?= HtmlEncode($Page->initialize_status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_initialize_status"
    data-bs-target="dsl_x_initialize_status"
    data-repeatcolumn="5"
    class="form-control<?= $Page->initialize_status->isInvalidClass() ?>"
    data-table="main_pa_initialization"
    data-field="x_initialize_status"
    data-value-separator="<?= $Page->initialize_status->displayValueSeparatorAttribute() ?>"
    <?= $Page->initialize_status->editAttributes() ?>></selection-list>
<?= $Page->initialize_status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->initialize_status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->appraisal_ratings->Visible) { // appraisal_ratings ?>
    <div id="r_appraisal_ratings"<?= $Page->appraisal_ratings->rowAttributes() ?>>
        <label id="elh_main_pa_initialization_appraisal_ratings" class="<?= $Page->LeftColumnClass ?>"><?= $Page->appraisal_ratings->caption() ?><?= $Page->appraisal_ratings->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->appraisal_ratings->cellAttributes() ?>>
<span id="el_main_pa_initialization_appraisal_ratings">
<?php
$onchange = $Page->appraisal_ratings->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->appraisal_ratings->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Page->appraisal_ratings->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_appraisal_ratings" class="ew-auto-suggest">
    <input type="<?= $Page->appraisal_ratings->getInputTextType() ?>" class="form-control" name="sv_x_appraisal_ratings" id="sv_x_appraisal_ratings" value="<?= RemoveHtml($Page->appraisal_ratings->EditValue) ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->appraisal_ratings->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->appraisal_ratings->getPlaceHolder()) ?>"<?= $Page->appraisal_ratings->editAttributes() ?> aria-describedby="x_appraisal_ratings_help">
</span>
<selection-list hidden class="form-control" data-table="main_pa_initialization" data-field="x_appraisal_ratings" data-input="sv_x_appraisal_ratings" data-value-separator="<?= $Page->appraisal_ratings->displayValueSeparatorAttribute() ?>" name="x_appraisal_ratings" id="x_appraisal_ratings" value="<?= HtmlEncode($Page->appraisal_ratings->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<?= $Page->appraisal_ratings->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->appraisal_ratings->getErrorMessage() ?></div>
<script>
loadjs.ready("fmain_pa_initializationadd", function() {
    fmain_pa_initializationadd.createAutoSuggest(Object.assign({"id":"x_appraisal_ratings","forceSelect":false}, ew.vars.tables.main_pa_initialization.fields.appraisal_ratings.autoSuggestOptions));
});
</script>
<?= $Page->appraisal_ratings->Lookup->getParamTag($Page, "p_x_appraisal_ratings") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->isactive->Visible) { // isactive ?>
    <div id="r_isactive"<?= $Page->isactive->rowAttributes() ?>>
        <label id="elh_main_pa_initialization_isactive" class="<?= $Page->LeftColumnClass ?>"><?= $Page->isactive->caption() ?><?= $Page->isactive->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->isactive->cellAttributes() ?>>
<span id="el_main_pa_initialization_isactive">
<template id="tp_x_isactive">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="main_pa_initialization" data-field="x_isactive" name="x_isactive" id="x_isactive"<?= $Page->isactive->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_isactive" class="ew-item-list"></div>
<selection-list hidden
    id="x_isactive"
    name="x_isactive"
    value="<?= HtmlEncode($Page->isactive->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_isactive"
    data-bs-target="dsl_x_isactive"
    data-repeatcolumn="5"
    class="form-control<?= $Page->isactive->isInvalidClass() ?>"
    data-table="main_pa_initialization"
    data-field="x_isactive"
    data-value-separator="<?= $Page->isactive->displayValueSeparatorAttribute() ?>"
    <?= $Page->isactive->editAttributes() ?>></selection-list>
<?= $Page->isactive->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->isactive->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("main_group_pa_questions", explode(",", $Page->getCurrentDetailTable())) && $main_group_pa_questions->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("main_group_pa_questions", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "MainGroupPaQuestionsGrid.php" ?>
<?php } ?>
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
    ew.addEventHandlers("main_pa_initialization");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
