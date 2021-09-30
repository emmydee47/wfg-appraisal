<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainBusinessunitsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_businessunits: currentTable } });
var currentForm, currentPageID;
var fmain_businessunitsview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_businessunitsview = new ew.Form("fmain_businessunitsview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fmain_businessunitsview;
    loadjs.done("fmain_businessunitsview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fmain_businessunitsview" id="fmain_businessunitsview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_businessunits">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_businessunits_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_main_businessunits_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->unitname->Visible) { // unitname ?>
    <tr id="r_unitname"<?= $Page->unitname->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_businessunits_unitname"><?= $Page->unitname->caption() ?></span></td>
        <td data-name="unitname"<?= $Page->unitname->cellAttributes() ?>>
<span id="el_main_businessunits_unitname">
<span<?= $Page->unitname->viewAttributes() ?>>
<?= $Page->unitname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->unitcode->Visible) { // unitcode ?>
    <tr id="r_unitcode"<?= $Page->unitcode->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_businessunits_unitcode"><?= $Page->unitcode->caption() ?></span></td>
        <td data-name="unitcode"<?= $Page->unitcode->cellAttributes() ?>>
<span id="el_main_businessunits_unitcode">
<span<?= $Page->unitcode->viewAttributes() ?>>
<?= $Page->unitcode->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description"<?= $Page->description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_businessunits_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el_main_businessunits_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->unithead->Visible) { // unithead ?>
    <tr id="r_unithead"<?= $Page->unithead->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_businessunits_unithead"><?= $Page->unithead->caption() ?></span></td>
        <td data-name="unithead"<?= $Page->unithead->cellAttributes() ?>>
<span id="el_main_businessunits_unithead">
<span<?= $Page->unithead->viewAttributes() ?>>
<?= $Page->unithead->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->createdby->Visible) { // createdby ?>
    <tr id="r_createdby"<?= $Page->createdby->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_businessunits_createdby"><?= $Page->createdby->caption() ?></span></td>
        <td data-name="createdby"<?= $Page->createdby->cellAttributes() ?>>
<span id="el_main_businessunits_createdby">
<span<?= $Page->createdby->viewAttributes() ?>>
<?= $Page->createdby->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modifiedby->Visible) { // modifiedby ?>
    <tr id="r_modifiedby"<?= $Page->modifiedby->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_businessunits_modifiedby"><?= $Page->modifiedby->caption() ?></span></td>
        <td data-name="modifiedby"<?= $Page->modifiedby->cellAttributes() ?>>
<span id="el_main_businessunits_modifiedby">
<span<?= $Page->modifiedby->viewAttributes() ?>>
<?= $Page->modifiedby->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
    <tr id="r_createddate"<?= $Page->createddate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_businessunits_createddate"><?= $Page->createddate->caption() ?></span></td>
        <td data-name="createddate"<?= $Page->createddate->cellAttributes() ?>>
<span id="el_main_businessunits_createddate">
<span<?= $Page->createddate->viewAttributes() ?>>
<?= $Page->createddate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
    <tr id="r_modifieddate"<?= $Page->modifieddate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_businessunits_modifieddate"><?= $Page->modifieddate->caption() ?></span></td>
        <td data-name="modifieddate"<?= $Page->modifieddate->cellAttributes() ?>>
<span id="el_main_businessunits_modifieddate">
<span<?= $Page->modifieddate->viewAttributes() ?>>
<?= $Page->modifieddate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->isactive->Visible) { // isactive ?>
    <tr id="r_isactive"<?= $Page->isactive->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_businessunits_isactive"><?= $Page->isactive->caption() ?></span></td>
        <td data-name="isactive"<?= $Page->isactive->cellAttributes() ?>>
<span id="el_main_businessunits_isactive">
<span<?= $Page->isactive->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_isactive_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->isactive->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->isactive->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_isactive_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
