<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaQuestionsAddopt = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_questions: currentTable } });
var currentForm, currentPageID;
var fmain_pa_questionsaddopt;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_questionsaddopt = new ew.Form("fmain_pa_questionsaddopt", "addopt");
    currentPageID = ew.PAGE_ID = "addopt";
    currentForm = fmain_pa_questionsaddopt;

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_questionsaddopt.addFields([
        ["group", [fields.group.visible && fields.group.required ? ew.Validators.required(fields.group.caption) : null], fields.group.isInvalid],
        ["question", [fields.question.visible && fields.question.required ? ew.Validators.required(fields.question.caption) : null], fields.question.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
        ["created_by", [fields.created_by.visible && fields.created_by.required ? ew.Validators.required(fields.created_by.caption) : null], fields.created_by.isInvalid],
        ["modified_by", [fields.modified_by.visible && fields.modified_by.required ? ew.Validators.required(fields.modified_by.caption) : null], fields.modified_by.isInvalid],
        ["created_date", [fields.created_date.visible && fields.created_date.required ? ew.Validators.required(fields.created_date.caption) : null], fields.created_date.isInvalid],
        ["modified_date", [fields.modified_date.visible && fields.modified_date.required ? ew.Validators.required(fields.modified_date.caption) : null], fields.modified_date.isInvalid]
    ]);

    // Form_CustomValidate
    fmain_pa_questionsaddopt.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_questionsaddopt.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_questionsaddopt.lists.group = <?= $Page->group->toClientList($Page) ?>;
    fmain_pa_questionsaddopt.lists.created_by = <?= $Page->created_by->toClientList($Page) ?>;
    loadjs.done("fmain_pa_questionsaddopt");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<form name="fmain_pa_questionsaddopt" id="fmain_pa_questionsaddopt" class="ew-form" action="<?= HtmlEncode(GetUrl(Config("API_URL"))) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="<?= Config("API_ACTION_NAME") ?>" id="<?= Config("API_ACTION_NAME") ?>" value="<?= Config("API_ADD_ACTION") ?>">
<input type="hidden" name="<?= Config("API_OBJECT_NAME") ?>" id="<?= Config("API_OBJECT_NAME") ?>" value="main_pa_questions">
<input type="hidden" name="addopt" id="addopt" value="1">
<?php if ($Page->group->Visible) { // group ?>
    <div<?= $Page->group->rowAttributes() ?>>
        <label class="col-sm-2 col-form-label ew-label" for="x_group"><?= $Page->group->caption() ?><?= $Page->group->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="col-sm-10"><div<?= $Page->group->cellAttributes() ?>>
    <select
        id="x_group"
        name="x_group"
        class="form-control ew-select<?= $Page->group->isInvalidClass() ?>"
        data-select2-id="fmain_pa_questionsaddopt_x_group"
        data-table="main_pa_questions"
        data-field="x_group"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->group->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->group->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->group->getPlaceHolder()) ?>"
        <?= $Page->group->editAttributes() ?>>
        <?= $Page->group->selectOptionListHtml("x_group") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->group->getErrorMessage() ?></div>
<?= $Page->group->Lookup->getParamTag($Page, "p_x_group") ?>
<script>
loadjs.ready("fmain_pa_questionsaddopt", function() {
    var options = { name: "x_group", selectId: "fmain_pa_questionsaddopt_x_group" };
    if (fmain_pa_questionsaddopt.lists.group.lookupOptions.length) {
        options.data = { id: "x_group", form: "fmain_pa_questionsaddopt" };
    } else {
        options.ajax = { id: "x_group", form: "fmain_pa_questionsaddopt", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_questions.fields.group.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->question->Visible) { // question ?>
    <div<?= $Page->question->rowAttributes() ?>>
        <label class="col-sm-2 col-form-label ew-label" for="x_question"><?= $Page->question->caption() ?><?= $Page->question->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="col-sm-10"><div<?= $Page->question->cellAttributes() ?>>
<textarea data-table="main_pa_questions" data-field="x_question" name="x_question" id="x_question" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->question->getPlaceHolder()) ?>"<?= $Page->question->editAttributes() ?>><?= $Page->question->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->question->getErrorMessage() ?></div>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div<?= $Page->description->rowAttributes() ?>>
        <label class="col-sm-2 col-form-label ew-label" for="x_description"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="col-sm-10"><div<?= $Page->description->cellAttributes() ?>>
<textarea data-table="main_pa_questions" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?>><?= $Page->description->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <input type="hidden" data-table="main_pa_questions" data-field="x_created_by" data-hidden="1" name="x_created_by" id="x_created_by" value="<?= HtmlEncode($Page->created_by->CurrentValue) ?>">
<?php } ?>
<?php if ($Page->modified_by->Visible) { // modified_by ?>
    <input type="hidden" data-table="main_pa_questions" data-field="x_modified_by" data-hidden="1" name="x_modified_by" id="x_modified_by" value="<?= HtmlEncode($Page->modified_by->CurrentValue) ?>">
<?php } ?>
<?php if ($Page->created_date->Visible) { // created_date ?>
    <input type="hidden" data-table="main_pa_questions" data-field="x_created_date" data-hidden="1" name="x_created_date" id="x_created_date" value="<?= HtmlEncode($Page->created_date->CurrentValue) ?>">
<?php } ?>
<?php if ($Page->modified_date->Visible) { // modified_date ?>
    <input type="hidden" data-table="main_pa_questions" data-field="x_modified_date" data-hidden="1" name="x_modified_date" id="x_modified_date" value="<?= HtmlEncode($Page->modified_date->CurrentValue) ?>">
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("main_pa_questions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
