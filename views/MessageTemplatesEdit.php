<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MessageTemplatesEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { message_templates: currentTable } });
var currentForm, currentPageID;
var fmessage_templatesedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmessage_templatesedit = new ew.Form("fmessage_templatesedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fmessage_templatesedit;

    // Add fields
    var fields = currentTable.fields;
    fmessage_templatesedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["recepient_group", [fields.recepient_group.visible && fields.recepient_group.required ? ew.Validators.required(fields.recepient_group.caption) : null], fields.recepient_group.isInvalid],
        ["_title", [fields._title.visible && fields._title.required ? ew.Validators.required(fields._title.caption) : null], fields._title.isInvalid],
        ["_content", [fields._content.visible && fields._content.required ? ew.Validators.required(fields._content.caption) : null], fields._content.isInvalid],
        ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null], fields.created_at.isInvalid],
        ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null], fields.updated_at.isInvalid],
        ["created_by", [fields.created_by.visible && fields.created_by.required ? ew.Validators.required(fields.created_by.caption) : null], fields.created_by.isInvalid]
    ]);

    // Form_CustomValidate
    fmessage_templatesedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmessage_templatesedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmessage_templatesedit.lists.recepient_group = <?= $Page->recepient_group->toClientList($Page) ?>;
    fmessage_templatesedit.lists.created_by = <?= $Page->created_by->toClientList($Page) ?>;
    loadjs.done("fmessage_templatesedit");
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
<form name="fmessage_templatesedit" id="fmessage_templatesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="message_templates">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_message_templates_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_message_templates_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="message_templates" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->recepient_group->Visible) { // recepient_group ?>
    <div id="r_recepient_group"<?= $Page->recepient_group->rowAttributes() ?>>
        <label id="elh_message_templates_recepient_group" for="x_recepient_group" class="<?= $Page->LeftColumnClass ?>"><?= $Page->recepient_group->caption() ?><?= $Page->recepient_group->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->recepient_group->cellAttributes() ?>>
<span id="el_message_templates_recepient_group">
    <select
        id="x_recepient_group"
        name="x_recepient_group"
        class="form-select ew-select<?= $Page->recepient_group->isInvalidClass() ?>"
        data-select2-id="fmessage_templatesedit_x_recepient_group"
        data-table="message_templates"
        data-field="x_recepient_group"
        data-value-separator="<?= $Page->recepient_group->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->recepient_group->getPlaceHolder()) ?>"
        <?= $Page->recepient_group->editAttributes() ?>>
        <?= $Page->recepient_group->selectOptionListHtml("x_recepient_group") ?>
    </select>
    <?= $Page->recepient_group->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->recepient_group->getErrorMessage() ?></div>
<script>
loadjs.ready("fmessage_templatesedit", function() {
    var options = { name: "x_recepient_group", selectId: "fmessage_templatesedit_x_recepient_group" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmessage_templatesedit.lists.recepient_group.lookupOptions.length) {
        options.data = { id: "x_recepient_group", form: "fmessage_templatesedit" };
    } else {
        options.ajax = { id: "x_recepient_group", form: "fmessage_templatesedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.message_templates.fields.recepient_group.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
    <div id="r__title"<?= $Page->_title->rowAttributes() ?>>
        <label id="elh_message_templates__title" for="x__title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_title->caption() ?><?= $Page->_title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_title->cellAttributes() ?>>
<span id="el_message_templates__title">
<input type="<?= $Page->_title->getInputTextType() ?>" name="x__title" id="x__title" data-table="message_templates" data-field="x__title" value="<?= $Page->_title->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->_title->getPlaceHolder()) ?>"<?= $Page->_title->editAttributes() ?> aria-describedby="x__title_help">
<?= $Page->_title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_content->Visible) { // content ?>
    <div id="r__content"<?= $Page->_content->rowAttributes() ?>>
        <label id="elh_message_templates__content" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_content->caption() ?><?= $Page->_content->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_content->cellAttributes() ?>>
<span id="el_message_templates__content">
<?php $Page->_content->EditAttrs->appendClass("editor"); ?>
<textarea data-table="message_templates" data-field="x__content" name="x__content" id="x__content" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->_content->getPlaceHolder()) ?>"<?= $Page->_content->editAttributes() ?> aria-describedby="x__content_help"><?= $Page->_content->EditValue ?></textarea>
<?= $Page->_content->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_content->getErrorMessage() ?></div>
<script>
loadjs.ready(["fmessage_templatesedit", "editor"], function() {
	ew.createEditor("fmessage_templatesedit", "x__content", 35, 4, <?= $Page->_content->ReadOnly || false ? "true" : "false" ?>);
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
    ew.addEventHandlers("message_templates");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
