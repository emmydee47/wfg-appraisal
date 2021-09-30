<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainGroupPaQuestionsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_group_pa_questions: currentTable } });
var currentForm, currentPageID;
var fmain_group_pa_questionsdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_group_pa_questionsdelete = new ew.Form("fmain_group_pa_questionsdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fmain_group_pa_questionsdelete;
    loadjs.done("fmain_group_pa_questionsdelete");
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
<form name="fmain_group_pa_questionsdelete" id="fmain_group_pa_questionsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_group_pa_questions">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_main_group_pa_questions_id" class="main_group_pa_questions_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->appraisal_id->Visible) { // appraisal_id ?>
        <th class="<?= $Page->appraisal_id->headerCellClass() ?>"><span id="elh_main_group_pa_questions_appraisal_id" class="main_group_pa_questions_appraisal_id"><?= $Page->appraisal_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->business_unit->Visible) { // business_unit ?>
        <th class="<?= $Page->business_unit->headerCellClass() ?>"><span id="elh_main_group_pa_questions_business_unit" class="main_group_pa_questions_business_unit"><?= $Page->business_unit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->group->Visible) { // group ?>
        <th class="<?= $Page->group->headerCellClass() ?>"><span id="elh_main_group_pa_questions_group" class="main_group_pa_questions_group"><?= $Page->group->caption() ?></span></th>
<?php } ?>
<?php if ($Page->question->Visible) { // question ?>
        <th class="<?= $Page->question->headerCellClass() ?>"><span id="elh_main_group_pa_questions_question" class="main_group_pa_questions_question"><?= $Page->question->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_id" class="el_main_group_pa_questions_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->appraisal_id->Visible) { // appraisal_id ?>
        <td<?= $Page->appraisal_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_appraisal_id" class="el_main_group_pa_questions_appraisal_id">
<span<?= $Page->appraisal_id->viewAttributes() ?>>
<?= $Page->appraisal_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->business_unit->Visible) { // business_unit ?>
        <td<?= $Page->business_unit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_business_unit" class="el_main_group_pa_questions_business_unit">
<span<?= $Page->business_unit->viewAttributes() ?>>
<?= $Page->business_unit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->group->Visible) { // group ?>
        <td<?= $Page->group->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_group" class="el_main_group_pa_questions_group">
<span<?= $Page->group->viewAttributes() ?>>
<?= $Page->group->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->question->Visible) { // question ?>
        <td<?= $Page->question->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_question" class="el_main_group_pa_questions_question">
<span<?= $Page->question->viewAttributes() ?>>
<?= $Page->question->getViewValue() ?></span>
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
