<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaInitializationDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_initialization: currentTable } });
var currentForm, currentPageID;
var fmain_pa_initializationdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_initializationdelete = new ew.Form("fmain_pa_initializationdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fmain_pa_initializationdelete;
    loadjs.done("fmain_pa_initializationdelete");
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
<form name="fmain_pa_initializationdelete" id="fmain_pa_initializationdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_initialization">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_main_pa_initialization_id" class="main_pa_initialization_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->business_unit->Visible) { // business_unit ?>
        <th class="<?= $Page->business_unit->headerCellClass() ?>"><span id="elh_main_pa_initialization_business_unit" class="main_pa_initialization_business_unit"><?= $Page->business_unit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
        <th class="<?= $Page->group_id->headerCellClass() ?>"><span id="elh_main_pa_initialization_group_id" class="main_pa_initialization_group_id"><?= $Page->group_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->appraisal_mode->Visible) { // appraisal_mode ?>
        <th class="<?= $Page->appraisal_mode->headerCellClass() ?>"><span id="elh_main_pa_initialization_appraisal_mode" class="main_pa_initialization_appraisal_mode"><?= $Page->appraisal_mode->caption() ?></span></th>
<?php } ?>
<?php if ($Page->appraisal_period->Visible) { // appraisal_period ?>
        <th class="<?= $Page->appraisal_period->headerCellClass() ?>"><span id="elh_main_pa_initialization_appraisal_period" class="main_pa_initialization_appraisal_period"><?= $Page->appraisal_period->caption() ?></span></th>
<?php } ?>
<?php if ($Page->from_year->Visible) { // from_year ?>
        <th class="<?= $Page->from_year->headerCellClass() ?>"><span id="elh_main_pa_initialization_from_year" class="main_pa_initialization_from_year"><?= $Page->from_year->caption() ?></span></th>
<?php } ?>
<?php if ($Page->to_year->Visible) { // to_year ?>
        <th class="<?= $Page->to_year->headerCellClass() ?>"><span id="elh_main_pa_initialization_to_year" class="main_pa_initialization_to_year"><?= $Page->to_year->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employees_due_date->Visible) { // employees_due_date ?>
        <th class="<?= $Page->employees_due_date->headerCellClass() ?>"><span id="elh_main_pa_initialization_employees_due_date" class="main_pa_initialization_employees_due_date"><?= $Page->employees_due_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->managers_due_date->Visible) { // managers_due_date ?>
        <th class="<?= $Page->managers_due_date->headerCellClass() ?>"><span id="elh_main_pa_initialization_managers_due_date" class="main_pa_initialization_managers_due_date"><?= $Page->managers_due_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->initialize_status->Visible) { // initialize_status ?>
        <th class="<?= $Page->initialize_status->headerCellClass() ?>"><span id="elh_main_pa_initialization_initialize_status" class="main_pa_initialization_initialize_status"><?= $Page->initialize_status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->appraisal_ratings->Visible) { // appraisal_ratings ?>
        <th class="<?= $Page->appraisal_ratings->headerCellClass() ?>"><span id="elh_main_pa_initialization_appraisal_ratings" class="main_pa_initialization_appraisal_ratings"><?= $Page->appraisal_ratings->caption() ?></span></th>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <th class="<?= $Page->createddate->headerCellClass() ?>"><span id="elh_main_pa_initialization_createddate" class="main_pa_initialization_createddate"><?= $Page->createddate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <th class="<?= $Page->modifieddate->headerCellClass() ?>"><span id="elh_main_pa_initialization_modifieddate" class="main_pa_initialization_modifieddate"><?= $Page->modifieddate->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_id" class="el_main_pa_initialization_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->business_unit->Visible) { // business_unit ?>
        <td<?= $Page->business_unit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_business_unit" class="el_main_pa_initialization_business_unit">
<span<?= $Page->business_unit->viewAttributes() ?>>
<?= $Page->business_unit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
        <td<?= $Page->group_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_group_id" class="el_main_pa_initialization_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->appraisal_mode->Visible) { // appraisal_mode ?>
        <td<?= $Page->appraisal_mode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_appraisal_mode" class="el_main_pa_initialization_appraisal_mode">
<span<?= $Page->appraisal_mode->viewAttributes() ?>>
<?= $Page->appraisal_mode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->appraisal_period->Visible) { // appraisal_period ?>
        <td<?= $Page->appraisal_period->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_appraisal_period" class="el_main_pa_initialization_appraisal_period">
<span<?= $Page->appraisal_period->viewAttributes() ?>>
<?= $Page->appraisal_period->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->from_year->Visible) { // from_year ?>
        <td<?= $Page->from_year->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_from_year" class="el_main_pa_initialization_from_year">
<span<?= $Page->from_year->viewAttributes() ?>>
<?= $Page->from_year->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->to_year->Visible) { // to_year ?>
        <td<?= $Page->to_year->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_to_year" class="el_main_pa_initialization_to_year">
<span<?= $Page->to_year->viewAttributes() ?>>
<?= $Page->to_year->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employees_due_date->Visible) { // employees_due_date ?>
        <td<?= $Page->employees_due_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_employees_due_date" class="el_main_pa_initialization_employees_due_date">
<span<?= $Page->employees_due_date->viewAttributes() ?>>
<?= $Page->employees_due_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->managers_due_date->Visible) { // managers_due_date ?>
        <td<?= $Page->managers_due_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_managers_due_date" class="el_main_pa_initialization_managers_due_date">
<span<?= $Page->managers_due_date->viewAttributes() ?>>
<?= $Page->managers_due_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->initialize_status->Visible) { // initialize_status ?>
        <td<?= $Page->initialize_status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_initialize_status" class="el_main_pa_initialization_initialize_status">
<span<?= $Page->initialize_status->viewAttributes() ?>>
<?= $Page->initialize_status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->appraisal_ratings->Visible) { // appraisal_ratings ?>
        <td<?= $Page->appraisal_ratings->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_appraisal_ratings" class="el_main_pa_initialization_appraisal_ratings">
<span<?= $Page->appraisal_ratings->viewAttributes() ?>>
<?= $Page->appraisal_ratings->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <td<?= $Page->createddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_createddate" class="el_main_pa_initialization_createddate">
<span<?= $Page->createddate->viewAttributes() ?>>
<?= $Page->createddate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <td<?= $Page->modifieddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_modifieddate" class="el_main_pa_initialization_modifieddate">
<span<?= $Page->modifieddate->viewAttributes() ?>>
<?= $Page->modifieddate->getViewValue() ?></span>
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
