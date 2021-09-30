<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaEmployeeResponseAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_employee_response: currentTable } });
var currentForm, currentPageID;
var fmain_pa_employee_responseadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_employee_responseadd = new ew.Form("fmain_pa_employee_responseadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fmain_pa_employee_responseadd;

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_employee_responseadd.addFields([
        ["appraisal", [fields.appraisal.visible && fields.appraisal.required ? ew.Validators.required(fields.appraisal.caption) : null], fields.appraisal.isInvalid],
        ["employee", [fields.employee.visible && fields.employee.required ? ew.Validators.required(fields.employee.caption) : null], fields.employee.isInvalid],
        ["question", [fields.question.visible && fields.question.required ? ew.Validators.required(fields.question.caption) : null], fields.question.isInvalid],
        ["_response", [fields._response.visible && fields._response.required ? ew.Validators.required(fields._response.caption) : null], fields._response.isInvalid]
    ]);

    // Form_CustomValidate
    fmain_pa_employee_responseadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_employee_responseadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_employee_responseadd.lists.appraisal = <?= $Page->appraisal->toClientList($Page) ?>;
    fmain_pa_employee_responseadd.lists.employee = <?= $Page->employee->toClientList($Page) ?>;
    fmain_pa_employee_responseadd.lists.question = <?= $Page->question->toClientList($Page) ?>;
    loadjs.done("fmain_pa_employee_responseadd");
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
<form name="fmain_pa_employee_responseadd" id="fmain_pa_employee_responseadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_employee_response">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->appraisal->Visible) { // appraisal ?>
    <div id="r_appraisal"<?= $Page->appraisal->rowAttributes() ?>>
        <label id="elh_main_pa_employee_response_appraisal" for="x_appraisal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->appraisal->caption() ?><?= $Page->appraisal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->appraisal->cellAttributes() ?>>
<span id="el_main_pa_employee_response_appraisal">
    <select
        id="x_appraisal"
        name="x_appraisal"
        class="form-control ew-select<?= $Page->appraisal->isInvalidClass() ?>"
        data-select2-id="fmain_pa_employee_responseadd_x_appraisal"
        data-table="main_pa_employee_response"
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
loadjs.ready("fmain_pa_employee_responseadd", function() {
    var options = { name: "x_appraisal", selectId: "fmain_pa_employee_responseadd_x_appraisal" };
    if (fmain_pa_employee_responseadd.lists.appraisal.lookupOptions.length) {
        options.data = { id: "x_appraisal", form: "fmain_pa_employee_responseadd" };
    } else {
        options.ajax = { id: "x_appraisal", form: "fmain_pa_employee_responseadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_employee_response.fields.appraisal.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee->Visible) { // employee ?>
    <div id="r_employee"<?= $Page->employee->rowAttributes() ?>>
        <label id="elh_main_pa_employee_response_employee" for="x_employee" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee->caption() ?><?= $Page->employee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->employee->cellAttributes() ?>>
<span id="el_main_pa_employee_response_employee">
    <select
        id="x_employee"
        name="x_employee"
        class="form-control ew-select<?= $Page->employee->isInvalidClass() ?>"
        data-select2-id="fmain_pa_employee_responseadd_x_employee"
        data-table="main_pa_employee_response"
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
loadjs.ready("fmain_pa_employee_responseadd", function() {
    var options = { name: "x_employee", selectId: "fmain_pa_employee_responseadd_x_employee" };
    if (fmain_pa_employee_responseadd.lists.employee.lookupOptions.length) {
        options.data = { id: "x_employee", form: "fmain_pa_employee_responseadd" };
    } else {
        options.ajax = { id: "x_employee", form: "fmain_pa_employee_responseadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_employee_response.fields.employee.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->question->Visible) { // question ?>
    <div id="r_question"<?= $Page->question->rowAttributes() ?>>
        <label id="elh_main_pa_employee_response_question" for="x_question" class="<?= $Page->LeftColumnClass ?>"><?= $Page->question->caption() ?><?= $Page->question->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->question->cellAttributes() ?>>
<span id="el_main_pa_employee_response_question">
    <select
        id="x_question"
        name="x_question"
        class="form-control ew-select<?= $Page->question->isInvalidClass() ?>"
        data-select2-id="fmain_pa_employee_responseadd_x_question"
        data-table="main_pa_employee_response"
        data-field="x_question"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->question->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->question->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->question->getPlaceHolder()) ?>"
        <?= $Page->question->editAttributes() ?>>
        <?= $Page->question->selectOptionListHtml("x_question") ?>
    </select>
    <?= $Page->question->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->question->getErrorMessage() ?></div>
<?= $Page->question->Lookup->getParamTag($Page, "p_x_question") ?>
<script>
loadjs.ready("fmain_pa_employee_responseadd", function() {
    var options = { name: "x_question", selectId: "fmain_pa_employee_responseadd_x_question" };
    if (fmain_pa_employee_responseadd.lists.question.lookupOptions.length) {
        options.data = { id: "x_question", form: "fmain_pa_employee_responseadd" };
    } else {
        options.ajax = { id: "x_question", form: "fmain_pa_employee_responseadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_employee_response.fields.question.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_response->Visible) { // response ?>
    <div id="r__response"<?= $Page->_response->rowAttributes() ?>>
        <label id="elh_main_pa_employee_response__response" for="x__response" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_response->caption() ?><?= $Page->_response->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_response->cellAttributes() ?>>
<span id="el_main_pa_employee_response__response">
<textarea data-table="main_pa_employee_response" data-field="x__response" name="x__response" id="x__response" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->_response->getPlaceHolder()) ?>"<?= $Page->_response->editAttributes() ?> aria-describedby="x__response_help"><?= $Page->_response->EditValue ?></textarea>
<?= $Page->_response->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_response->getErrorMessage() ?></div>
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
    ew.addEventHandlers("main_pa_employee_response");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
