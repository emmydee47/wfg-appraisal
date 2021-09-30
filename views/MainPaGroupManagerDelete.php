<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaGroupManagerDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_group_manager: currentTable } });
var currentForm, currentPageID;
var fmain_pa_group_managerdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_group_managerdelete = new ew.Form("fmain_pa_group_managerdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fmain_pa_group_managerdelete;
    loadjs.done("fmain_pa_group_managerdelete");
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
<form name="fmain_pa_group_managerdelete" id="fmain_pa_group_managerdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_group_manager">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_main_pa_group_manager_id" class="main_pa_group_manager_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->business_unit->Visible) { // business_unit ?>
        <th class="<?= $Page->business_unit->headerCellClass() ?>"><span id="elh_main_pa_group_manager_business_unit" class="main_pa_group_manager_business_unit"><?= $Page->business_unit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
        <th class="<?= $Page->group_id->headerCellClass() ?>"><span id="elh_main_pa_group_manager_group_id" class="main_pa_group_manager_group_id"><?= $Page->group_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->line_manager->Visible) { // line_manager ?>
        <th class="<?= $Page->line_manager->headerCellClass() ?>"><span id="elh_main_pa_group_manager_line_manager" class="main_pa_group_manager_line_manager"><?= $Page->line_manager->caption() ?></span></th>
<?php } ?>
<?php if ($Page->level->Visible) { // level ?>
        <th class="<?= $Page->level->headerCellClass() ?>"><span id="elh_main_pa_group_manager_level" class="main_pa_group_manager_level"><?= $Page->level->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_date->Visible) { // created_date ?>
        <th class="<?= $Page->created_date->headerCellClass() ?>"><span id="elh_main_pa_group_manager_created_date" class="main_pa_group_manager_created_date"><?= $Page->created_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_date->Visible) { // updated_date ?>
        <th class="<?= $Page->updated_date->headerCellClass() ?>"><span id="elh_main_pa_group_manager_updated_date" class="main_pa_group_manager_updated_date"><?= $Page->updated_date->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_main_pa_group_manager_id" class="el_main_pa_group_manager_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->business_unit->Visible) { // business_unit ?>
        <td<?= $Page->business_unit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_group_manager_business_unit" class="el_main_pa_group_manager_business_unit">
<span<?= $Page->business_unit->viewAttributes() ?>>
<?= $Page->business_unit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
        <td<?= $Page->group_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_group_manager_group_id" class="el_main_pa_group_manager_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->line_manager->Visible) { // line_manager ?>
        <td<?= $Page->line_manager->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_group_manager_line_manager" class="el_main_pa_group_manager_line_manager">
<span<?= $Page->line_manager->viewAttributes() ?>>
<?= $Page->line_manager->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->level->Visible) { // level ?>
        <td<?= $Page->level->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_group_manager_level" class="el_main_pa_group_manager_level">
<span<?= $Page->level->viewAttributes() ?>>
<?= $Page->level->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_date->Visible) { // created_date ?>
        <td<?= $Page->created_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_group_manager_created_date" class="el_main_pa_group_manager_created_date">
<span<?= $Page->created_date->viewAttributes() ?>>
<?= $Page->created_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->updated_date->Visible) { // updated_date ?>
        <td<?= $Page->updated_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_group_manager_updated_date" class="el_main_pa_group_manager_updated_date">
<span<?= $Page->updated_date->viewAttributes() ?>>
<?= $Page->updated_date->getViewValue() ?></span>
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
