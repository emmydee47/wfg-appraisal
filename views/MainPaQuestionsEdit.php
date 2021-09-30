<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaQuestionsEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_questions: currentTable } });
var currentForm, currentPageID;
var fmain_pa_questionsedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_questionsedit = new ew.Form("fmain_pa_questionsedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fmain_pa_questionsedit;

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_questionsedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["group", [fields.group.visible && fields.group.required ? ew.Validators.required(fields.group.caption) : null], fields.group.isInvalid],
        ["question", [fields.question.visible && fields.question.required ? ew.Validators.required(fields.question.caption) : null], fields.question.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
        ["created_by", [fields.created_by.visible && fields.created_by.required ? ew.Validators.required(fields.created_by.caption) : null], fields.created_by.isInvalid],
        ["modified_by", [fields.modified_by.visible && fields.modified_by.required ? ew.Validators.required(fields.modified_by.caption) : null], fields.modified_by.isInvalid],
        ["created_date", [fields.created_date.visible && fields.created_date.required ? ew.Validators.required(fields.created_date.caption) : null], fields.created_date.isInvalid],
        ["modified_date", [fields.modified_date.visible && fields.modified_date.required ? ew.Validators.required(fields.modified_date.caption) : null], fields.modified_date.isInvalid]
    ]);

    // Form_CustomValidate
    fmain_pa_questionsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_questionsedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_questionsedit.lists.group = <?= $Page->group->toClientList($Page) ?>;
    fmain_pa_questionsedit.lists.created_by = <?= $Page->created_by->toClientList($Page) ?>;
    loadjs.done("fmain_pa_questionsedit");
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
<form name="fmain_pa_questionsedit" id="fmain_pa_questionsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_questions">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_main_pa_questions_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_main_pa_questions_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_pa_questions" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->group->Visible) { // group ?>
    <div id="r_group"<?= $Page->group->rowAttributes() ?>>
        <label id="elh_main_pa_questions_group" for="x_group" class="<?= $Page->LeftColumnClass ?>"><?= $Page->group->caption() ?><?= $Page->group->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->group->cellAttributes() ?>>
<span id="el_main_pa_questions_group">
    <select
        id="x_group"
        name="x_group"
        class="form-control ew-select<?= $Page->group->isInvalidClass() ?>"
        data-select2-id="fmain_pa_questionsedit_x_group"
        data-table="main_pa_questions"
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
loadjs.ready("fmain_pa_questionsedit", function() {
    var options = { name: "x_group", selectId: "fmain_pa_questionsedit_x_group" };
    if (fmain_pa_questionsedit.lists.group.lookupOptions.length) {
        options.data = { id: "x_group", form: "fmain_pa_questionsedit" };
    } else {
        options.ajax = { id: "x_group", form: "fmain_pa_questionsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_questions.fields.group.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->question->Visible) { // question ?>
    <div id="r_question"<?= $Page->question->rowAttributes() ?>>
        <label id="elh_main_pa_questions_question" for="x_question" class="<?= $Page->LeftColumnClass ?>"><?= $Page->question->caption() ?><?= $Page->question->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->question->cellAttributes() ?>>
<span id="el_main_pa_questions_question">
<textarea data-table="main_pa_questions" data-field="x_question" name="x_question" id="x_question" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->question->getPlaceHolder()) ?>"<?= $Page->question->editAttributes() ?> aria-describedby="x_question_help"><?= $Page->question->EditValue ?></textarea>
<?= $Page->question->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->question->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_main_pa_questions_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_main_pa_questions_description">
<textarea data-table="main_pa_questions" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("main_group_pa_questions", explode(",", $Page->getCurrentDetailTable())) && $main_group_pa_questions->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("main_group_pa_questions", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "MainGroupPaQuestionsGrid.php" ?>
<?php } ?>
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
    ew.addEventHandlers("main_pa_questions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
