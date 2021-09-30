<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaAppraisalhistoryDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_appraisalhistory: currentTable } });
var currentForm, currentPageID;
var fmain_pa_appraisalhistorydelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_appraisalhistorydelete = new ew.Form("fmain_pa_appraisalhistorydelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fmain_pa_appraisalhistorydelete;
    loadjs.done("fmain_pa_appraisalhistorydelete");
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
<form name="fmain_pa_appraisalhistorydelete" id="fmain_pa_appraisalhistorydelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_appraisalhistory">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_main_pa_appraisalhistory_id" class="main_pa_appraisalhistory_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
        <th class="<?= $Page->employee_id->headerCellClass() ?>"><span id="elh_main_pa_appraisalhistory_employee_id" class="main_pa_appraisalhistory_employee_id"><?= $Page->employee_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pa_initialization_id->Visible) { // pa_initialization_id ?>
        <th class="<?= $Page->pa_initialization_id->headerCellClass() ?>"><span id="elh_main_pa_appraisalhistory_pa_initialization_id" class="main_pa_appraisalhistory_pa_initialization_id"><?= $Page->pa_initialization_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->createdby->Visible) { // createdby ?>
        <th class="<?= $Page->createdby->headerCellClass() ?>"><span id="elh_main_pa_appraisalhistory_createdby" class="main_pa_appraisalhistory_createdby"><?= $Page->createdby->caption() ?></span></th>
<?php } ?>
<?php if ($Page->modifiedby->Visible) { // modifiedby ?>
        <th class="<?= $Page->modifiedby->headerCellClass() ?>"><span id="elh_main_pa_appraisalhistory_modifiedby" class="main_pa_appraisalhistory_modifiedby"><?= $Page->modifiedby->caption() ?></span></th>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <th class="<?= $Page->createddate->headerCellClass() ?>"><span id="elh_main_pa_appraisalhistory_createddate" class="main_pa_appraisalhistory_createddate"><?= $Page->createddate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <th class="<?= $Page->modifieddate->headerCellClass() ?>"><span id="elh_main_pa_appraisalhistory_modifieddate" class="main_pa_appraisalhistory_modifieddate"><?= $Page->modifieddate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->isactive->Visible) { // isactive ?>
        <th class="<?= $Page->isactive->headerCellClass() ?>"><span id="elh_main_pa_appraisalhistory_isactive" class="main_pa_appraisalhistory_isactive"><?= $Page->isactive->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_main_pa_appraisalhistory_id" class="el_main_pa_appraisalhistory_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
        <td<?= $Page->employee_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_appraisalhistory_employee_id" class="el_main_pa_appraisalhistory_employee_id">
<span<?= $Page->employee_id->viewAttributes() ?>>
<?= $Page->employee_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pa_initialization_id->Visible) { // pa_initialization_id ?>
        <td<?= $Page->pa_initialization_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_appraisalhistory_pa_initialization_id" class="el_main_pa_appraisalhistory_pa_initialization_id">
<span<?= $Page->pa_initialization_id->viewAttributes() ?>>
<?= $Page->pa_initialization_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->createdby->Visible) { // createdby ?>
        <td<?= $Page->createdby->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_appraisalhistory_createdby" class="el_main_pa_appraisalhistory_createdby">
<span<?= $Page->createdby->viewAttributes() ?>>
<?= $Page->createdby->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->modifiedby->Visible) { // modifiedby ?>
        <td<?= $Page->modifiedby->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_appraisalhistory_modifiedby" class="el_main_pa_appraisalhistory_modifiedby">
<span<?= $Page->modifiedby->viewAttributes() ?>>
<?= $Page->modifiedby->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <td<?= $Page->createddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_appraisalhistory_createddate" class="el_main_pa_appraisalhistory_createddate">
<span<?= $Page->createddate->viewAttributes() ?>>
<?= $Page->createddate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <td<?= $Page->modifieddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_appraisalhistory_modifieddate" class="el_main_pa_appraisalhistory_modifieddate">
<span<?= $Page->modifieddate->viewAttributes() ?>>
<?= $Page->modifieddate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->isactive->Visible) { // isactive ?>
        <td<?= $Page->isactive->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_appraisalhistory_isactive" class="el_main_pa_appraisalhistory_isactive">
<span<?= $Page->isactive->viewAttributes() ?>>
<?= $Page->isactive->getViewValue() ?></span>
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
