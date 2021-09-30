<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaEmployeeRatingsSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_employee_ratings: currentTable } });
var currentForm, currentPageID;
var fmain_pa_employee_ratingssearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fmain_pa_employee_ratingssearch = new ew.Form("fmain_pa_employee_ratingssearch", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = fmain_pa_employee_ratingssearch;
    <?php } else { ?>
    currentForm = fmain_pa_employee_ratingssearch;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_employee_ratingssearch.addFields([
        ["appraisal_id", [], fields.appraisal_id.isInvalid],
        ["employee_id", [], fields.employee_id.isInvalid],
        ["consolidated_rating", [ew.Validators.float], fields.consolidated_rating.isInvalid],
        ["y_consolidated_rating", [ew.Validators.between], false],
        ["appraisal_status", [], fields.appraisal_status.isInvalid],
        ["createddate", [ew.Validators.datetime(fields.createddate.clientFormatPattern)], fields.createddate.isInvalid],
        ["y_createddate", [ew.Validators.between], false],
        ["modifieddate", [ew.Validators.datetime(fields.modifieddate.clientFormatPattern)], fields.modifieddate.isInvalid],
        ["y_modifieddate", [ew.Validators.between], false],
        ["isactive", [], fields.isactive.isInvalid],
        ["group_id", [ew.Validators.integer], fields.group_id.isInvalid]
    ]);

    // Validate form
    fmain_pa_employee_ratingssearch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj),
            rowIndex = "";
        $fobj.data("rowindex", rowIndex);

        // Validate fields
        if (!this.validateFields(rowIndex))
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    fmain_pa_employee_ratingssearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_employee_ratingssearch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_employee_ratingssearch.lists.appraisal_id = <?= $Page->appraisal_id->toClientList($Page) ?>;
    fmain_pa_employee_ratingssearch.lists.employee_id = <?= $Page->employee_id->toClientList($Page) ?>;
    fmain_pa_employee_ratingssearch.lists.appraisal_status = <?= $Page->appraisal_status->toClientList($Page) ?>;
    fmain_pa_employee_ratingssearch.lists.isactive = <?= $Page->isactive->toClientList($Page) ?>;
    loadjs.done("fmain_pa_employee_ratingssearch");
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
<form name="fmain_pa_employee_ratingssearch" id="fmain_pa_employee_ratingssearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_employee_ratings">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->appraisal_id->Visible) { // appraisal_id ?>
    <div id="r_appraisal_id"<?= $Page->appraisal_id->rowAttributes() ?>>
        <label for="x_appraisal_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_main_pa_employee_ratings_appraisal_id"><?= $Page->appraisal_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_appraisal_id" id="z_appraisal_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->appraisal_id->cellAttributes() ?>>
            <span id="el_main_pa_employee_ratings_appraisal_id" class="ew-search-field ew-search-field-single">
    <select
        id="x_appraisal_id"
        name="x_appraisal_id"
        class="form-control ew-select<?= $Page->appraisal_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_employee_ratingssearch_x_appraisal_id"
        data-table="main_pa_employee_ratings"
        data-field="x_appraisal_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->appraisal_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->appraisal_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->appraisal_id->getPlaceHolder()) ?>"
        <?= $Page->appraisal_id->editAttributes() ?>>
        <?= $Page->appraisal_id->selectOptionListHtml("x_appraisal_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->appraisal_id->getErrorMessage(false) ?></div>
<?= $Page->appraisal_id->Lookup->getParamTag($Page, "p_x_appraisal_id") ?>
<script>
loadjs.ready("fmain_pa_employee_ratingssearch", function() {
    var options = { name: "x_appraisal_id", selectId: "fmain_pa_employee_ratingssearch_x_appraisal_id" };
    if (fmain_pa_employee_ratingssearch.lists.appraisal_id.lookupOptions.length) {
        options.data = { id: "x_appraisal_id", form: "fmain_pa_employee_ratingssearch" };
    } else {
        options.ajax = { id: "x_appraisal_id", form: "fmain_pa_employee_ratingssearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_employee_ratings.fields.appraisal_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
    <div id="r_employee_id"<?= $Page->employee_id->rowAttributes() ?>>
        <label for="x_employee_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_main_pa_employee_ratings_employee_id"><?= $Page->employee_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_employee_id" id="z_employee_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->employee_id->cellAttributes() ?>>
            <span id="el_main_pa_employee_ratings_employee_id" class="ew-search-field ew-search-field-single">
    <select
        id="x_employee_id"
        name="x_employee_id"
        class="form-control ew-select<?= $Page->employee_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_employee_ratingssearch_x_employee_id"
        data-table="main_pa_employee_ratings"
        data-field="x_employee_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->employee_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->employee_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->employee_id->getPlaceHolder()) ?>"
        <?= $Page->employee_id->editAttributes() ?>>
        <?= $Page->employee_id->selectOptionListHtml("x_employee_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->employee_id->getErrorMessage(false) ?></div>
<?= $Page->employee_id->Lookup->getParamTag($Page, "p_x_employee_id") ?>
<script>
loadjs.ready("fmain_pa_employee_ratingssearch", function() {
    var options = { name: "x_employee_id", selectId: "fmain_pa_employee_ratingssearch_x_employee_id" };
    if (fmain_pa_employee_ratingssearch.lists.employee_id.lookupOptions.length) {
        options.data = { id: "x_employee_id", form: "fmain_pa_employee_ratingssearch" };
    } else {
        options.ajax = { id: "x_employee_id", form: "fmain_pa_employee_ratingssearch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_employee_ratings.fields.employee_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->consolidated_rating->Visible) { // consolidated_rating ?>
    <div id="r_consolidated_rating"<?= $Page->consolidated_rating->rowAttributes() ?>>
        <label for="x_consolidated_rating" class="<?= $Page->LeftColumnClass ?>"><span id="elh_main_pa_employee_ratings_consolidated_rating"><?= $Page->consolidated_rating->caption() ?></span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->consolidated_rating->cellAttributes() ?>>
                <span class="ew-search-operator">
<select name="z_consolidated_rating" id="z_consolidated_rating" class="form-select" onchange="ew.searchOperatorChanged(this);">
<option value="="<?= $Page->consolidated_rating->AdvancedSearch->SearchOperator == "=" ? " selected" : "" ?>><?= $Language->phrase("EQUAL") ?></option>
<option value="&lt;&gt;"<?= $Page->consolidated_rating->AdvancedSearch->SearchOperator == "<>" ? " selected" : "" ?>><?= $Language->phrase("<>") ?></option>
<option value="&lt;"<?= $Page->consolidated_rating->AdvancedSearch->SearchOperator == "<" ? " selected" : "" ?>><?= $Language->phrase("<") ?></option>
<option value="&lt;="<?= $Page->consolidated_rating->AdvancedSearch->SearchOperator == "<=" ? " selected" : "" ?>><?= $Language->phrase("<=") ?></option>
<option value="&gt;"<?= $Page->consolidated_rating->AdvancedSearch->SearchOperator == ">" ? " selected" : "" ?>><?= $Language->phrase(">") ?></option>
<option value="&gt;="<?= $Page->consolidated_rating->AdvancedSearch->SearchOperator == ">=" ? " selected" : "" ?>><?= $Language->phrase(">=") ?></option>
<option value="IS NULL"<?= $Page->consolidated_rating->AdvancedSearch->SearchOperator == "IS NULL" ? " selected" : "" ?>><?= $Language->phrase("IS NULL") ?></option>
<option value="IS NOT NULL"<?= $Page->consolidated_rating->AdvancedSearch->SearchOperator == "IS NOT NULL" ? " selected" : "" ?>><?= $Language->phrase("IS NOT NULL") ?></option>
<option value="BETWEEN"<?= $Page->consolidated_rating->AdvancedSearch->SearchOperator == "BETWEEN" ? " selected" : "" ?>><?= $Language->phrase("BETWEEN") ?></option>
</select>
</span>
            <span id="el_main_pa_employee_ratings_consolidated_rating" class="ew-search-field">
<input type="<?= $Page->consolidated_rating->getInputTextType() ?>" name="x_consolidated_rating" id="x_consolidated_rating" data-table="main_pa_employee_ratings" data-field="x_consolidated_rating" value="<?= $Page->consolidated_rating->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->consolidated_rating->getPlaceHolder()) ?>"<?= $Page->consolidated_rating->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->consolidated_rating->getErrorMessage(false) ?></div>
</span>
                <span class="ew-search-and d-none"><label><?= $Language->phrase("AND") ?></label></span>
                <span id="el2_main_pa_employee_ratings_consolidated_rating" class="ew-search-field2 d-none">
<input type="<?= $Page->consolidated_rating->getInputTextType() ?>" name="y_consolidated_rating" id="y_consolidated_rating" data-table="main_pa_employee_ratings" data-field="x_consolidated_rating" value="<?= $Page->consolidated_rating->EditValue2 ?>" size="30" placeholder="<?= HtmlEncode($Page->consolidated_rating->getPlaceHolder()) ?>"<?= $Page->consolidated_rating->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->consolidated_rating->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->appraisal_status->Visible) { // appraisal_status ?>
    <div id="r_appraisal_status"<?= $Page->appraisal_status->rowAttributes() ?>>
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_main_pa_employee_ratings_appraisal_status"><?= $Page->appraisal_status->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_appraisal_status" id="z_appraisal_status" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->appraisal_status->cellAttributes() ?>>
            <span id="el_main_pa_employee_ratings_appraisal_status" class="ew-search-field ew-search-field-single">
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
    value="<?= HtmlEncode($Page->appraisal_status->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_appraisal_status"
    data-bs-target="dsl_x_appraisal_status"
    data-repeatcolumn="5"
    class="form-control<?= $Page->appraisal_status->isInvalidClass() ?>"
    data-table="main_pa_employee_ratings"
    data-field="x_appraisal_status"
    data-value-separator="<?= $Page->appraisal_status->displayValueSeparatorAttribute() ?>"
    <?= $Page->appraisal_status->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Page->appraisal_status->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
    <div id="r_createddate"<?= $Page->createddate->rowAttributes() ?>>
        <label for="x_createddate" class="<?= $Page->LeftColumnClass ?>"><span id="elh_main_pa_employee_ratings_createddate"><?= $Page->createddate->caption() ?></span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->createddate->cellAttributes() ?>>
                <span class="ew-search-operator">
<select name="z_createddate" id="z_createddate" class="form-select" onchange="ew.searchOperatorChanged(this);">
<option value="="<?= $Page->createddate->AdvancedSearch->SearchOperator == "=" ? " selected" : "" ?>><?= $Language->phrase("EQUAL") ?></option>
<option value="&lt;&gt;"<?= $Page->createddate->AdvancedSearch->SearchOperator == "<>" ? " selected" : "" ?>><?= $Language->phrase("<>") ?></option>
<option value="&lt;"<?= $Page->createddate->AdvancedSearch->SearchOperator == "<" ? " selected" : "" ?>><?= $Language->phrase("<") ?></option>
<option value="&lt;="<?= $Page->createddate->AdvancedSearch->SearchOperator == "<=" ? " selected" : "" ?>><?= $Language->phrase("<=") ?></option>
<option value="&gt;"<?= $Page->createddate->AdvancedSearch->SearchOperator == ">" ? " selected" : "" ?>><?= $Language->phrase(">") ?></option>
<option value="&gt;="<?= $Page->createddate->AdvancedSearch->SearchOperator == ">=" ? " selected" : "" ?>><?= $Language->phrase(">=") ?></option>
<option value="IS NULL"<?= $Page->createddate->AdvancedSearch->SearchOperator == "IS NULL" ? " selected" : "" ?>><?= $Language->phrase("IS NULL") ?></option>
<option value="IS NOT NULL"<?= $Page->createddate->AdvancedSearch->SearchOperator == "IS NOT NULL" ? " selected" : "" ?>><?= $Language->phrase("IS NOT NULL") ?></option>
<option value="BETWEEN"<?= $Page->createddate->AdvancedSearch->SearchOperator == "BETWEEN" ? " selected" : "" ?>><?= $Language->phrase("BETWEEN") ?></option>
</select>
</span>
            <span id="el_main_pa_employee_ratings_createddate" class="ew-search-field">
<input type="<?= $Page->createddate->getInputTextType() ?>" name="x_createddate" id="x_createddate" data-table="main_pa_employee_ratings" data-field="x_createddate" value="<?= $Page->createddate->EditValue ?>" placeholder="<?= HtmlEncode($Page->createddate->getPlaceHolder()) ?>"<?= $Page->createddate->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->createddate->getErrorMessage(false) ?></div>
<?php if (!$Page->createddate->ReadOnly && !$Page->createddate->Disabled && !isset($Page->createddate->EditAttrs["readonly"]) && !isset($Page->createddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmain_pa_employee_ratingssearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmain_pa_employee_ratingssearch", "x_createddate", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
                <span class="ew-search-and d-none"><label><?= $Language->phrase("AND") ?></label></span>
                <span id="el2_main_pa_employee_ratings_createddate" class="ew-search-field2 d-none">
<input type="<?= $Page->createddate->getInputTextType() ?>" name="y_createddate" id="y_createddate" data-table="main_pa_employee_ratings" data-field="x_createddate" value="<?= $Page->createddate->EditValue2 ?>" placeholder="<?= HtmlEncode($Page->createddate->getPlaceHolder()) ?>"<?= $Page->createddate->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->createddate->getErrorMessage(false) ?></div>
<?php if (!$Page->createddate->ReadOnly && !$Page->createddate->Disabled && !isset($Page->createddate->EditAttrs["readonly"]) && !isset($Page->createddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmain_pa_employee_ratingssearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmain_pa_employee_ratingssearch", "y_createddate", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
    <div id="r_modifieddate"<?= $Page->modifieddate->rowAttributes() ?>>
        <label for="x_modifieddate" class="<?= $Page->LeftColumnClass ?>"><span id="elh_main_pa_employee_ratings_modifieddate"><?= $Page->modifieddate->caption() ?></span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->modifieddate->cellAttributes() ?>>
                <span class="ew-search-operator">
<select name="z_modifieddate" id="z_modifieddate" class="form-select" onchange="ew.searchOperatorChanged(this);">
<option value="="<?= $Page->modifieddate->AdvancedSearch->SearchOperator == "=" ? " selected" : "" ?>><?= $Language->phrase("EQUAL") ?></option>
<option value="&lt;&gt;"<?= $Page->modifieddate->AdvancedSearch->SearchOperator == "<>" ? " selected" : "" ?>><?= $Language->phrase("<>") ?></option>
<option value="&lt;"<?= $Page->modifieddate->AdvancedSearch->SearchOperator == "<" ? " selected" : "" ?>><?= $Language->phrase("<") ?></option>
<option value="&lt;="<?= $Page->modifieddate->AdvancedSearch->SearchOperator == "<=" ? " selected" : "" ?>><?= $Language->phrase("<=") ?></option>
<option value="&gt;"<?= $Page->modifieddate->AdvancedSearch->SearchOperator == ">" ? " selected" : "" ?>><?= $Language->phrase(">") ?></option>
<option value="&gt;="<?= $Page->modifieddate->AdvancedSearch->SearchOperator == ">=" ? " selected" : "" ?>><?= $Language->phrase(">=") ?></option>
<option value="IS NULL"<?= $Page->modifieddate->AdvancedSearch->SearchOperator == "IS NULL" ? " selected" : "" ?>><?= $Language->phrase("IS NULL") ?></option>
<option value="IS NOT NULL"<?= $Page->modifieddate->AdvancedSearch->SearchOperator == "IS NOT NULL" ? " selected" : "" ?>><?= $Language->phrase("IS NOT NULL") ?></option>
<option value="BETWEEN"<?= $Page->modifieddate->AdvancedSearch->SearchOperator == "BETWEEN" ? " selected" : "" ?>><?= $Language->phrase("BETWEEN") ?></option>
</select>
</span>
            <span id="el_main_pa_employee_ratings_modifieddate" class="ew-search-field">
<input type="<?= $Page->modifieddate->getInputTextType() ?>" name="x_modifieddate" id="x_modifieddate" data-table="main_pa_employee_ratings" data-field="x_modifieddate" value="<?= $Page->modifieddate->EditValue ?>" placeholder="<?= HtmlEncode($Page->modifieddate->getPlaceHolder()) ?>"<?= $Page->modifieddate->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->modifieddate->getErrorMessage(false) ?></div>
<?php if (!$Page->modifieddate->ReadOnly && !$Page->modifieddate->Disabled && !isset($Page->modifieddate->EditAttrs["readonly"]) && !isset($Page->modifieddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmain_pa_employee_ratingssearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmain_pa_employee_ratingssearch", "x_modifieddate", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
                <span class="ew-search-and d-none"><label><?= $Language->phrase("AND") ?></label></span>
                <span id="el2_main_pa_employee_ratings_modifieddate" class="ew-search-field2 d-none">
<input type="<?= $Page->modifieddate->getInputTextType() ?>" name="y_modifieddate" id="y_modifieddate" data-table="main_pa_employee_ratings" data-field="x_modifieddate" value="<?= $Page->modifieddate->EditValue2 ?>" placeholder="<?= HtmlEncode($Page->modifieddate->getPlaceHolder()) ?>"<?= $Page->modifieddate->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->modifieddate->getErrorMessage(false) ?></div>
<?php if (!$Page->modifieddate->ReadOnly && !$Page->modifieddate->Disabled && !isset($Page->modifieddate->EditAttrs["readonly"]) && !isset($Page->modifieddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmain_pa_employee_ratingssearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmain_pa_employee_ratingssearch", "y_modifieddate", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->isactive->Visible) { // isactive ?>
    <div id="r_isactive"<?= $Page->isactive->rowAttributes() ?>>
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_main_pa_employee_ratings_isactive"><?= $Page->isactive->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_isactive" id="z_isactive" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->isactive->cellAttributes() ?>>
            <span id="el_main_pa_employee_ratings_isactive" class="ew-search-field ew-search-field-single">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->isactive->isInvalidClass() ?>" data-table="main_pa_employee_ratings" data-field="x_isactive" name="x_isactive[]" id="x_isactive_370260" value="1"<?= ConvertToBool($Page->isactive->AdvancedSearch->SearchValue) ? " checked" : "" ?><?= $Page->isactive->editAttributes() ?>>
    <div class="invalid-feedback"><?= $Page->isactive->getErrorMessage(false) ?></div>
</div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
    <div id="r_group_id"<?= $Page->group_id->rowAttributes() ?>>
        <label for="x_group_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_main_pa_employee_ratings_group_id"><?= $Page->group_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_group_id" id="z_group_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->group_id->cellAttributes() ?>>
            <span id="el_main_pa_employee_ratings_group_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->group_id->getInputTextType() ?>" name="x_group_id" id="x_group_id" data-table="main_pa_employee_ratings" data-field="x_group_id" value="<?= $Page->group_id->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->group_id->getPlaceHolder()) ?>"<?= $Page->group_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->group_id->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
        <button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("Search") ?></button>
        <button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" data-ew-action="reload"><?= $Language->phrase("Reset") ?></button>
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
