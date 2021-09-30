<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MessageTemplatesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { message_templates: currentTable } });
var currentForm, currentPageID;
var fmessage_templatesdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmessage_templatesdelete = new ew.Form("fmessage_templatesdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fmessage_templatesdelete;
    loadjs.done("fmessage_templatesdelete");
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
<form name="fmessage_templatesdelete" id="fmessage_templatesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="message_templates">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_message_templates_id" class="message_templates_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->recepient_group->Visible) { // recepient_group ?>
        <th class="<?= $Page->recepient_group->headerCellClass() ?>"><span id="elh_message_templates_recepient_group" class="message_templates_recepient_group"><?= $Page->recepient_group->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
        <th class="<?= $Page->_title->headerCellClass() ?>"><span id="elh_message_templates__title" class="message_templates__title"><?= $Page->_title->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_message_templates_created_at" class="message_templates_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_message_templates_updated_at" class="message_templates_updated_at"><?= $Page->updated_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th class="<?= $Page->created_by->headerCellClass() ?>"><span id="elh_message_templates_created_by" class="message_templates_created_by"><?= $Page->created_by->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_message_templates_id" class="el_message_templates_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->recepient_group->Visible) { // recepient_group ?>
        <td<?= $Page->recepient_group->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_message_templates_recepient_group" class="el_message_templates_recepient_group">
<span<?= $Page->recepient_group->viewAttributes() ?>>
<?= $Page->recepient_group->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
        <td<?= $Page->_title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_message_templates__title" class="el_message_templates__title">
<span<?= $Page->_title->viewAttributes() ?>>
<?= $Page->_title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <td<?= $Page->created_at->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_message_templates_created_at" class="el_message_templates_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td<?= $Page->updated_at->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_message_templates_updated_at" class="el_message_templates_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <td<?= $Page->created_by->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_message_templates_created_by" class="el_message_templates_created_by">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
