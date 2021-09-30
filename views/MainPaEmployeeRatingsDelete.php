<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaEmployeeRatingsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_employee_ratings: currentTable } });
var currentForm, currentPageID;
var fmain_pa_employee_ratingsdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_employee_ratingsdelete = new ew.Form("fmain_pa_employee_ratingsdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fmain_pa_employee_ratingsdelete;
    loadjs.done("fmain_pa_employee_ratingsdelete");
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
<form name="fmain_pa_employee_ratingsdelete" id="fmain_pa_employee_ratingsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_employee_ratings">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_main_pa_employee_ratings_id" class="main_pa_employee_ratings_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->appraisal_id->Visible) { // appraisal_id ?>
        <th class="<?= $Page->appraisal_id->headerCellClass() ?>"><span id="elh_main_pa_employee_ratings_appraisal_id" class="main_pa_employee_ratings_appraisal_id"><?= $Page->appraisal_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
        <th class="<?= $Page->employee_id->headerCellClass() ?>"><span id="elh_main_pa_employee_ratings_employee_id" class="main_pa_employee_ratings_employee_id"><?= $Page->employee_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->consolidated_rating->Visible) { // consolidated_rating ?>
        <th class="<?= $Page->consolidated_rating->headerCellClass() ?>"><span id="elh_main_pa_employee_ratings_consolidated_rating" class="main_pa_employee_ratings_consolidated_rating"><?= $Page->consolidated_rating->caption() ?></span></th>
<?php } ?>
<?php if ($Page->appraisal_status->Visible) { // appraisal_status ?>
        <th class="<?= $Page->appraisal_status->headerCellClass() ?>"><span id="elh_main_pa_employee_ratings_appraisal_status" class="main_pa_employee_ratings_appraisal_status"><?= $Page->appraisal_status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <th class="<?= $Page->createddate->headerCellClass() ?>"><span id="elh_main_pa_employee_ratings_createddate" class="main_pa_employee_ratings_createddate"><?= $Page->createddate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
        <th class="<?= $Page->group_id->headerCellClass() ?>"><span id="elh_main_pa_employee_ratings_group_id" class="main_pa_employee_ratings_group_id"><?= $Page->group_id->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_main_pa_employee_ratings_id" class="el_main_pa_employee_ratings_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->appraisal_id->Visible) { // appraisal_id ?>
        <td<?= $Page->appraisal_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_employee_ratings_appraisal_id" class="el_main_pa_employee_ratings_appraisal_id">
<span<?= $Page->appraisal_id->viewAttributes() ?>>
<?= $Page->appraisal_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
        <td<?= $Page->employee_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_employee_ratings_employee_id" class="el_main_pa_employee_ratings_employee_id">
<span<?= $Page->employee_id->viewAttributes() ?>>
<?= $Page->employee_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->consolidated_rating->Visible) { // consolidated_rating ?>
        <td<?= $Page->consolidated_rating->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_employee_ratings_consolidated_rating" class="el_main_pa_employee_ratings_consolidated_rating">
<span<?= $Page->consolidated_rating->viewAttributes() ?>>
<?= $Page->consolidated_rating->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->appraisal_status->Visible) { // appraisal_status ?>
        <td<?= $Page->appraisal_status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_employee_ratings_appraisal_status" class="el_main_pa_employee_ratings_appraisal_status">
<span<?= $Page->appraisal_status->viewAttributes() ?>>
<?= $Page->appraisal_status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <td<?= $Page->createddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_employee_ratings_createddate" class="el_main_pa_employee_ratings_createddate">
<span<?= $Page->createddate->viewAttributes() ?>>
<?= $Page->createddate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
        <td<?= $Page->group_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_employee_ratings_group_id" class="el_main_pa_employee_ratings_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
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
