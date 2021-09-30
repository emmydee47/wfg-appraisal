<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaGroupsEmployeesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_groups_employees: currentTable } });
var currentForm, currentPageID;
var fmain_pa_groups_employeesdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_groups_employeesdelete = new ew.Form("fmain_pa_groups_employeesdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fmain_pa_groups_employeesdelete;
    loadjs.done("fmain_pa_groups_employeesdelete");
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
<form name="fmain_pa_groups_employeesdelete" id="fmain_pa_groups_employeesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_groups_employees">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_main_pa_groups_employees_id" class="main_pa_groups_employees_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
        <th class="<?= $Page->group_id->headerCellClass() ?>"><span id="elh_main_pa_groups_employees_group_id" class="main_pa_groups_employees_group_id"><?= $Page->group_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
        <th class="<?= $Page->employee_id->headerCellClass() ?>"><span id="elh_main_pa_groups_employees_employee_id" class="main_pa_groups_employees_employee_id"><?= $Page->employee_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <th class="<?= $Page->createddate->headerCellClass() ?>"><span id="elh_main_pa_groups_employees_createddate" class="main_pa_groups_employees_createddate"><?= $Page->createddate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <th class="<?= $Page->modifieddate->headerCellClass() ?>"><span id="elh_main_pa_groups_employees_modifieddate" class="main_pa_groups_employees_modifieddate"><?= $Page->modifieddate->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_id" class="el_main_pa_groups_employees_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
        <td<?= $Page->group_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_group_id" class="el_main_pa_groups_employees_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
        <td<?= $Page->employee_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_employee_id" class="el_main_pa_groups_employees_employee_id">
<span<?= $Page->employee_id->viewAttributes() ?>>
<?= $Page->employee_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <td<?= $Page->createddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_createddate" class="el_main_pa_groups_employees_createddate">
<span<?= $Page->createddate->viewAttributes() ?>>
<?= $Page->createddate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <td<?= $Page->modifieddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_modifieddate" class="el_main_pa_groups_employees_modifieddate">
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
