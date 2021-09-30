<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainGroupPaQuestionsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_group_pa_questions: currentTable } });
var currentForm, currentPageID;
var fmain_group_pa_questionsadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_group_pa_questionsadd = new ew.Form("fmain_group_pa_questionsadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fmain_group_pa_questionsadd;

    // Add fields
    var fields = currentTable.fields;
    fmain_group_pa_questionsadd.addFields([
        ["appraisal_id", [fields.appraisal_id.visible && fields.appraisal_id.required ? ew.Validators.required(fields.appraisal_id.caption) : null], fields.appraisal_id.isInvalid],
        ["business_unit", [fields.business_unit.visible && fields.business_unit.required ? ew.Validators.required(fields.business_unit.caption) : null], fields.business_unit.isInvalid],
        ["group", [fields.group.visible && fields.group.required ? ew.Validators.required(fields.group.caption) : null], fields.group.isInvalid],
        ["question", [fields.question.visible && fields.question.required ? ew.Validators.required(fields.question.caption) : null], fields.question.isInvalid]
    ]);

    // Form_CustomValidate
    fmain_group_pa_questionsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_group_pa_questionsadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_group_pa_questionsadd.lists.appraisal_id = <?= $Page->appraisal_id->toClientList($Page) ?>;
    fmain_group_pa_questionsadd.lists.business_unit = <?= $Page->business_unit->toClientList($Page) ?>;
    fmain_group_pa_questionsadd.lists.group = <?= $Page->group->toClientList($Page) ?>;
    fmain_group_pa_questionsadd.lists.question = <?= $Page->question->toClientList($Page) ?>;
    loadjs.done("fmain_group_pa_questionsadd");
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
<form name="fmain_group_pa_questionsadd" id="fmain_group_pa_questionsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_group_pa_questions">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "main_pa_initialization") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="main_pa_initialization">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->appraisal_id->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "main_pa_questions") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="main_pa_questions">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->question->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->appraisal_id->Visible) { // appraisal_id ?>
    <div id="r_appraisal_id"<?= $Page->appraisal_id->rowAttributes() ?>>
        <label id="elh_main_group_pa_questions_appraisal_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->appraisal_id->caption() ?><?= $Page->appraisal_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->appraisal_id->cellAttributes() ?>>
<?php if ($Page->appraisal_id->getSessionValue() != "") { ?>
<span id="el_main_group_pa_questions_appraisal_id">
<span<?= $Page->appraisal_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->appraisal_id->getDisplayValue($Page->appraisal_id->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x_appraisal_id" name="x_appraisal_id" value="<?= HtmlEncode($Page->appraisal_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_main_group_pa_questions_appraisal_id">
    <select
        id="x_appraisal_id"
        name="x_appraisal_id"
        class="form-control ew-select<?= $Page->appraisal_id->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionsadd_x_appraisal_id"
        data-table="main_group_pa_questions"
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
loadjs.ready("fmain_group_pa_questionsadd", function() {
    var options = { name: "x_appraisal_id", selectId: "fmain_group_pa_questionsadd_x_appraisal_id" };
    if (fmain_group_pa_questionsadd.lists.appraisal_id.lookupOptions.length) {
        options.data = { id: "x_appraisal_id", form: "fmain_group_pa_questionsadd" };
    } else {
        options.ajax = { id: "x_appraisal_id", form: "fmain_group_pa_questionsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.appraisal_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->business_unit->Visible) { // business_unit ?>
    <div id="r_business_unit"<?= $Page->business_unit->rowAttributes() ?>>
        <label id="elh_main_group_pa_questions_business_unit" for="x_business_unit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->business_unit->caption() ?><?= $Page->business_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->business_unit->cellAttributes() ?>>
<span id="el_main_group_pa_questions_business_unit">
<?php $Page->business_unit->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_business_unit"
        name="x_business_unit"
        class="form-control ew-select<?= $Page->business_unit->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionsadd_x_business_unit"
        data-table="main_group_pa_questions"
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
loadjs.ready("fmain_group_pa_questionsadd", function() {
    var options = { name: "x_business_unit", selectId: "fmain_group_pa_questionsadd_x_business_unit" };
    if (fmain_group_pa_questionsadd.lists.business_unit.lookupOptions.length) {
        options.data = { id: "x_business_unit", form: "fmain_group_pa_questionsadd" };
    } else {
        options.ajax = { id: "x_business_unit", form: "fmain_group_pa_questionsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.business_unit.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->group->Visible) { // group ?>
    <div id="r_group"<?= $Page->group->rowAttributes() ?>>
        <label id="elh_main_group_pa_questions_group" for="x_group" class="<?= $Page->LeftColumnClass ?>"><?= $Page->group->caption() ?><?= $Page->group->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->group->cellAttributes() ?>>
<span id="el_main_group_pa_questions_group">
    <select
        id="x_group"
        name="x_group"
        class="form-control ew-select<?= $Page->group->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionsadd_x_group"
        data-table="main_group_pa_questions"
        data-field="x_group"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->group->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->group->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->group->getPlaceHolder()) ?>"
        <?= $Page->group->editAttributes() ?>>
        <?= $Page->group->selectOptionListHtml("x_group") ?>
    </select>
    <?= $Page->group->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->group->getErrorMessage() ?></div>
<?= $Page->group->Lookup->getParamTag($Page, "p_x_group") ?>
<script>
loadjs.ready("fmain_group_pa_questionsadd", function() {
    var options = { name: "x_group", selectId: "fmain_group_pa_questionsadd_x_group" };
    if (fmain_group_pa_questionsadd.lists.group.lookupOptions.length) {
        options.data = { id: "x_group", form: "fmain_group_pa_questionsadd" };
    } else {
        options.ajax = { id: "x_group", form: "fmain_group_pa_questionsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.group.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->question->Visible) { // question ?>
    <div id="r_question"<?= $Page->question->rowAttributes() ?>>
        <label id="elh_main_group_pa_questions_question" for="x_question" class="<?= $Page->LeftColumnClass ?>"><?= $Page->question->caption() ?><?= $Page->question->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->question->cellAttributes() ?>>
<?php if ($Page->question->getSessionValue() != "") { ?>
<span id="el_main_group_pa_questions_question">
<span<?= $Page->question->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->question->getDisplayValue($Page->question->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x_question" name="x_question" value="<?= HtmlEncode($Page->question->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_main_group_pa_questions_question">
<div class="input-group flex-nowrap">
    <select
        id="x_question"
        name="x_question"
        class="form-control ew-select<?= $Page->question->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionsadd_x_question"
        data-table="main_group_pa_questions"
        data-field="x_question"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->question->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->question->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->question->getPlaceHolder()) ?>"
        <?= $Page->question->editAttributes() ?>>
        <?= $Page->question->selectOptionListHtml("x_question") ?>
    </select>
    <?php if (AllowAdd(CurrentProjectID() . "main_pa_questions") && !$Page->question->ReadOnly) { ?>
    <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_question" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Page->question->caption() ?>" data-title="<?= $Page->question->caption() ?>" data-ew-action="add-option" data-el="x_question" data-url="<?= GetUrl("mainpaquestionsaddopt") ?>"><i class="fas fa-plus ew-icon"></i></button>
    <?php } ?>
</div>
<?= $Page->question->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->question->getErrorMessage() ?></div>
<?= $Page->question->Lookup->getParamTag($Page, "p_x_question") ?>
<script>
loadjs.ready("fmain_group_pa_questionsadd", function() {
    var options = { name: "x_question", selectId: "fmain_group_pa_questionsadd_x_question" };
    if (fmain_group_pa_questionsadd.lists.question.lookupOptions.length) {
        options.data = { id: "x_question", form: "fmain_group_pa_questionsadd" };
    } else {
        options.ajax = { id: "x_question", form: "fmain_group_pa_questionsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.question.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
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
    ew.addEventHandlers("main_group_pa_questions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
