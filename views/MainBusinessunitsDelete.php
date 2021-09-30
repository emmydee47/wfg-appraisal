<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainBusinessunitsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_businessunits: currentTable } });
var currentForm, currentPageID;
var fmain_businessunitsdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_businessunitsdelete = new ew.Form("fmain_businessunitsdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fmain_businessunitsdelete;
    loadjs.done("fmain_businessunitsdelete");
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
<form name="fmain_businessunitsdelete" id="fmain_businessunitsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_businessunits">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_main_businessunits_id" class="main_businessunits_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->unitname->Visible) { // unitname ?>
        <th class="<?= $Page->unitname->headerCellClass() ?>"><span id="elh_main_businessunits_unitname" class="main_businessunits_unitname"><?= $Page->unitname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->unitcode->Visible) { // unitcode ?>
        <th class="<?= $Page->unitcode->headerCellClass() ?>"><span id="elh_main_businessunits_unitcode" class="main_businessunits_unitcode"><?= $Page->unitcode->caption() ?></span></th>
<?php } ?>
<?php if ($Page->unithead->Visible) { // unithead ?>
        <th class="<?= $Page->unithead->headerCellClass() ?>"><span id="elh_main_businessunits_unithead" class="main_businessunits_unithead"><?= $Page->unithead->caption() ?></span></th>
<?php } ?>
<?php if ($Page->createdby->Visible) { // createdby ?>
        <th class="<?= $Page->createdby->headerCellClass() ?>"><span id="elh_main_businessunits_createdby" class="main_businessunits_createdby"><?= $Page->createdby->caption() ?></span></th>
<?php } ?>
<?php if ($Page->modifiedby->Visible) { // modifiedby ?>
        <th class="<?= $Page->modifiedby->headerCellClass() ?>"><span id="elh_main_businessunits_modifiedby" class="main_businessunits_modifiedby"><?= $Page->modifiedby->caption() ?></span></th>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <th class="<?= $Page->createddate->headerCellClass() ?>"><span id="elh_main_businessunits_createddate" class="main_businessunits_createddate"><?= $Page->createddate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <th class="<?= $Page->modifieddate->headerCellClass() ?>"><span id="elh_main_businessunits_modifieddate" class="main_businessunits_modifieddate"><?= $Page->modifieddate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->isactive->Visible) { // isactive ?>
        <th class="<?= $Page->isactive->headerCellClass() ?>"><span id="elh_main_businessunits_isactive" class="main_businessunits_isactive"><?= $Page->isactive->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_main_businessunits_id" class="el_main_businessunits_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->unitname->Visible) { // unitname ?>
        <td<?= $Page->unitname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_businessunits_unitname" class="el_main_businessunits_unitname">
<span<?= $Page->unitname->viewAttributes() ?>>
<?= $Page->unitname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->unitcode->Visible) { // unitcode ?>
        <td<?= $Page->unitcode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_businessunits_unitcode" class="el_main_businessunits_unitcode">
<span<?= $Page->unitcode->viewAttributes() ?>>
<?= $Page->unitcode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->unithead->Visible) { // unithead ?>
        <td<?= $Page->unithead->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_businessunits_unithead" class="el_main_businessunits_unithead">
<span<?= $Page->unithead->viewAttributes() ?>>
<?= $Page->unithead->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->createdby->Visible) { // createdby ?>
        <td<?= $Page->createdby->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_businessunits_createdby" class="el_main_businessunits_createdby">
<span<?= $Page->createdby->viewAttributes() ?>>
<?= $Page->createdby->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->modifiedby->Visible) { // modifiedby ?>
        <td<?= $Page->modifiedby->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_businessunits_modifiedby" class="el_main_businessunits_modifiedby">
<span<?= $Page->modifiedby->viewAttributes() ?>>
<?= $Page->modifiedby->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <td<?= $Page->createddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_businessunits_createddate" class="el_main_businessunits_createddate">
<span<?= $Page->createddate->viewAttributes() ?>>
<?= $Page->createddate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <td<?= $Page->modifieddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_businessunits_modifieddate" class="el_main_businessunits_modifieddate">
<span<?= $Page->modifieddate->viewAttributes() ?>>
<?= $Page->modifieddate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->isactive->Visible) { // isactive ?>
        <td<?= $Page->isactive->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_businessunits_isactive" class="el_main_businessunits_isactive">
<span<?= $Page->isactive->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_isactive_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->isactive->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->isactive->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_isactive_<?= $Page->RowCount ?>"></label>
</div></span>
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
