<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaScoreAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_score: currentTable } });
var currentForm, currentPageID;
var fmain_pa_scoreadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_scoreadd = new ew.Form("fmain_pa_scoreadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fmain_pa_scoreadd;

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_scoreadd.addFields([
        ["appraisal", [fields.appraisal.visible && fields.appraisal.required ? ew.Validators.required(fields.appraisal.caption) : null], fields.appraisal.isInvalid],
        ["employee", [fields.employee.visible && fields.employee.required ? ew.Validators.required(fields.employee.caption) : null], fields.employee.isInvalid],
        ["employee_response", [fields.employee_response.visible && fields.employee_response.required ? ew.Validators.required(fields.employee_response.caption) : null], fields.employee_response.isInvalid],
        ["line_manager_one", [fields.line_manager_one.visible && fields.line_manager_one.required ? ew.Validators.required(fields.line_manager_one.caption) : null], fields.line_manager_one.isInvalid],
        ["line_manager_one_response", [fields.line_manager_one_response.visible && fields.line_manager_one_response.required ? ew.Validators.required(fields.line_manager_one_response.caption) : null], fields.line_manager_one_response.isInvalid],
        ["line_manager_two", [fields.line_manager_two.visible && fields.line_manager_two.required ? ew.Validators.required(fields.line_manager_two.caption) : null], fields.line_manager_two.isInvalid],
        ["line_manager_two_response", [fields.line_manager_two_response.visible && fields.line_manager_two_response.required ? ew.Validators.required(fields.line_manager_two_response.caption) : null], fields.line_manager_two_response.isInvalid],
        ["consolidate_score", [fields.consolidate_score.visible && fields.consolidate_score.required ? ew.Validators.required(fields.consolidate_score.caption) : null], fields.consolidate_score.isInvalid],
        ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null], fields.created_at.isInvalid],
        ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null], fields.updated_at.isInvalid]
    ]);

    // Form_CustomValidate
    fmain_pa_scoreadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_scoreadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_scoreadd.lists.appraisal = <?= $Page->appraisal->toClientList($Page) ?>;
    fmain_pa_scoreadd.lists.employee = <?= $Page->employee->toClientList($Page) ?>;
    fmain_pa_scoreadd.lists.line_manager_one = <?= $Page->line_manager_one->toClientList($Page) ?>;
    fmain_pa_scoreadd.lists.line_manager_two = <?= $Page->line_manager_two->toClientList($Page) ?>;
    loadjs.done("fmain_pa_scoreadd");
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
<form name="fmain_pa_scoreadd" id="fmain_pa_scoreadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_score">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->appraisal->Visible) { // appraisal ?>
    <div id="r_appraisal"<?= $Page->appraisal->rowAttributes() ?>>
        <label id="elh_main_pa_score_appraisal" for="x_appraisal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->appraisal->caption() ?><?= $Page->appraisal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->appraisal->cellAttributes() ?>>
<span id="el_main_pa_score_appraisal">
    <select
        id="x_appraisal"
        name="x_appraisal"
        class="form-control ew-select<?= $Page->appraisal->isInvalidClass() ?>"
        data-select2-id="fmain_pa_scoreadd_x_appraisal"
        data-table="main_pa_score"
        data-field="x_appraisal"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->appraisal->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->appraisal->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->appraisal->getPlaceHolder()) ?>"
        <?= $Page->appraisal->editAttributes() ?>>
        <?= $Page->appraisal->selectOptionListHtml("x_appraisal") ?>
    </select>
    <?= $Page->appraisal->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->appraisal->getErrorMessage() ?></div>
<?= $Page->appraisal->Lookup->getParamTag($Page, "p_x_appraisal") ?>
<script>
loadjs.ready("fmain_pa_scoreadd", function() {
    var options = { name: "x_appraisal", selectId: "fmain_pa_scoreadd_x_appraisal" };
    if (fmain_pa_scoreadd.lists.appraisal.lookupOptions.length) {
        options.data = { id: "x_appraisal", form: "fmain_pa_scoreadd" };
    } else {
        options.ajax = { id: "x_appraisal", form: "fmain_pa_scoreadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_score.fields.appraisal.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee->Visible) { // employee ?>
    <div id="r_employee"<?= $Page->employee->rowAttributes() ?>>
        <label id="elh_main_pa_score_employee" for="x_employee" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee->caption() ?><?= $Page->employee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->employee->cellAttributes() ?>>
<span id="el_main_pa_score_employee">
    <select
        id="x_employee"
        name="x_employee"
        class="form-control ew-select<?= $Page->employee->isInvalidClass() ?>"
        data-select2-id="fmain_pa_scoreadd_x_employee"
        data-table="main_pa_score"
        data-field="x_employee"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->employee->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->employee->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->employee->getPlaceHolder()) ?>"
        <?= $Page->employee->editAttributes() ?>>
        <?= $Page->employee->selectOptionListHtml("x_employee") ?>
    </select>
    <?= $Page->employee->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->employee->getErrorMessage() ?></div>
<?= $Page->employee->Lookup->getParamTag($Page, "p_x_employee") ?>
<script>
loadjs.ready("fmain_pa_scoreadd", function() {
    var options = { name: "x_employee", selectId: "fmain_pa_scoreadd_x_employee" };
    if (fmain_pa_scoreadd.lists.employee.lookupOptions.length) {
        options.data = { id: "x_employee", form: "fmain_pa_scoreadd" };
    } else {
        options.ajax = { id: "x_employee", form: "fmain_pa_scoreadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_score.fields.employee.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_response->Visible) { // employee_response ?>
    <div id="r_employee_response"<?= $Page->employee_response->rowAttributes() ?>>
        <label id="elh_main_pa_score_employee_response" for="x_employee_response" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_response->caption() ?><?= $Page->employee_response->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->employee_response->cellAttributes() ?>>
<span id="el_main_pa_score_employee_response">
<textarea data-table="main_pa_score" data-field="x_employee_response" name="x_employee_response" id="x_employee_response" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->employee_response->getPlaceHolder()) ?>"<?= $Page->employee_response->editAttributes() ?> aria-describedby="x_employee_response_help"><?= $Page->employee_response->EditValue ?></textarea>
<?= $Page->employee_response->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_response->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->line_manager_one->Visible) { // line_manager_one ?>
    <div id="r_line_manager_one"<?= $Page->line_manager_one->rowAttributes() ?>>
        <label id="elh_main_pa_score_line_manager_one" for="x_line_manager_one" class="<?= $Page->LeftColumnClass ?>"><?= $Page->line_manager_one->caption() ?><?= $Page->line_manager_one->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->line_manager_one->cellAttributes() ?>>
<span id="el_main_pa_score_line_manager_one">
    <select
        id="x_line_manager_one"
        name="x_line_manager_one"
        class="form-select ew-select<?= $Page->line_manager_one->isInvalidClass() ?>"
        data-select2-id="fmain_pa_scoreadd_x_line_manager_one"
        data-table="main_pa_score"
        data-field="x_line_manager_one"
        data-value-separator="<?= $Page->line_manager_one->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->line_manager_one->getPlaceHolder()) ?>"
        <?= $Page->line_manager_one->editAttributes() ?>>
        <?= $Page->line_manager_one->selectOptionListHtml("x_line_manager_one") ?>
    </select>
    <?= $Page->line_manager_one->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->line_manager_one->getErrorMessage() ?></div>
<?= $Page->line_manager_one->Lookup->getParamTag($Page, "p_x_line_manager_one") ?>
<script>
loadjs.ready("fmain_pa_scoreadd", function() {
    var options = { name: "x_line_manager_one", selectId: "fmain_pa_scoreadd_x_line_manager_one" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_scoreadd.lists.line_manager_one.lookupOptions.length) {
        options.data = { id: "x_line_manager_one", form: "fmain_pa_scoreadd" };
    } else {
        options.ajax = { id: "x_line_manager_one", form: "fmain_pa_scoreadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_score.fields.line_manager_one.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->line_manager_one_response->Visible) { // line_manager_one_response ?>
    <div id="r_line_manager_one_response"<?= $Page->line_manager_one_response->rowAttributes() ?>>
        <label id="elh_main_pa_score_line_manager_one_response" for="x_line_manager_one_response" class="<?= $Page->LeftColumnClass ?>"><?= $Page->line_manager_one_response->caption() ?><?= $Page->line_manager_one_response->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->line_manager_one_response->cellAttributes() ?>>
<span id="el_main_pa_score_line_manager_one_response">
<textarea data-table="main_pa_score" data-field="x_line_manager_one_response" name="x_line_manager_one_response" id="x_line_manager_one_response" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->line_manager_one_response->getPlaceHolder()) ?>"<?= $Page->line_manager_one_response->editAttributes() ?> aria-describedby="x_line_manager_one_response_help"><?= $Page->line_manager_one_response->EditValue ?></textarea>
<?= $Page->line_manager_one_response->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->line_manager_one_response->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->line_manager_two->Visible) { // line_manager_two ?>
    <div id="r_line_manager_two"<?= $Page->line_manager_two->rowAttributes() ?>>
        <label id="elh_main_pa_score_line_manager_two" for="x_line_manager_two" class="<?= $Page->LeftColumnClass ?>"><?= $Page->line_manager_two->caption() ?><?= $Page->line_manager_two->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->line_manager_two->cellAttributes() ?>>
<span id="el_main_pa_score_line_manager_two">
    <select
        id="x_line_manager_two"
        name="x_line_manager_two"
        class="form-select ew-select<?= $Page->line_manager_two->isInvalidClass() ?>"
        data-select2-id="fmain_pa_scoreadd_x_line_manager_two"
        data-table="main_pa_score"
        data-field="x_line_manager_two"
        data-value-separator="<?= $Page->line_manager_two->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->line_manager_two->getPlaceHolder()) ?>"
        <?= $Page->line_manager_two->editAttributes() ?>>
        <?= $Page->line_manager_two->selectOptionListHtml("x_line_manager_two") ?>
    </select>
    <?= $Page->line_manager_two->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->line_manager_two->getErrorMessage() ?></div>
<?= $Page->line_manager_two->Lookup->getParamTag($Page, "p_x_line_manager_two") ?>
<script>
loadjs.ready("fmain_pa_scoreadd", function() {
    var options = { name: "x_line_manager_two", selectId: "fmain_pa_scoreadd_x_line_manager_two" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_scoreadd.lists.line_manager_two.lookupOptions.length) {
        options.data = { id: "x_line_manager_two", form: "fmain_pa_scoreadd" };
    } else {
        options.ajax = { id: "x_line_manager_two", form: "fmain_pa_scoreadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_score.fields.line_manager_two.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->line_manager_two_response->Visible) { // line_manager_two_response ?>
    <div id="r_line_manager_two_response"<?= $Page->line_manager_two_response->rowAttributes() ?>>
        <label id="elh_main_pa_score_line_manager_two_response" for="x_line_manager_two_response" class="<?= $Page->LeftColumnClass ?>"><?= $Page->line_manager_two_response->caption() ?><?= $Page->line_manager_two_response->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->line_manager_two_response->cellAttributes() ?>>
<span id="el_main_pa_score_line_manager_two_response">
<textarea data-table="main_pa_score" data-field="x_line_manager_two_response" name="x_line_manager_two_response" id="x_line_manager_two_response" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->line_manager_two_response->getPlaceHolder()) ?>"<?= $Page->line_manager_two_response->editAttributes() ?> aria-describedby="x_line_manager_two_response_help"><?= $Page->line_manager_two_response->EditValue ?></textarea>
<?= $Page->line_manager_two_response->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->line_manager_two_response->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->consolidate_score->Visible) { // consolidate_score ?>
    <div id="r_consolidate_score"<?= $Page->consolidate_score->rowAttributes() ?>>
        <label id="elh_main_pa_score_consolidate_score" for="x_consolidate_score" class="<?= $Page->LeftColumnClass ?>"><?= $Page->consolidate_score->caption() ?><?= $Page->consolidate_score->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->consolidate_score->cellAttributes() ?>>
<span id="el_main_pa_score_consolidate_score">
<textarea data-table="main_pa_score" data-field="x_consolidate_score" name="x_consolidate_score" id="x_consolidate_score" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->consolidate_score->getPlaceHolder()) ?>"<?= $Page->consolidate_score->editAttributes() ?> aria-describedby="x_consolidate_score_help"><?= $Page->consolidate_score->EditValue ?></textarea>
<?= $Page->consolidate_score->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->consolidate_score->getErrorMessage() ?></div>
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
    ew.addEventHandlers("main_pa_score");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
