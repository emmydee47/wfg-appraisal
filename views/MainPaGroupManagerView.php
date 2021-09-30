<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaGroupManagerView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_group_manager: currentTable } });
var currentForm, currentPageID;
var fmain_pa_group_managerview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_group_managerview = new ew.Form("fmain_pa_group_managerview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fmain_pa_group_managerview;
    loadjs.done("fmain_pa_group_managerview");
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
<form name="fmain_pa_group_managerview" id="fmain_pa_group_managerview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_group_manager">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_group_manager_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_main_pa_group_manager_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->business_unit->Visible) { // business_unit ?>
    <tr id="r_business_unit"<?= $Page->business_unit->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_group_manager_business_unit"><?= $Page->business_unit->caption() ?></span></td>
        <td data-name="business_unit"<?= $Page->business_unit->cellAttributes() ?>>
<span id="el_main_pa_group_manager_business_unit">
<span<?= $Page->business_unit->viewAttributes() ?>>
<?= $Page->business_unit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
    <tr id="r_group_id"<?= $Page->group_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_group_manager_group_id"><?= $Page->group_id->caption() ?></span></td>
        <td data-name="group_id"<?= $Page->group_id->cellAttributes() ?>>
<span id="el_main_pa_group_manager_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->line_manager->Visible) { // line_manager ?>
    <tr id="r_line_manager"<?= $Page->line_manager->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_group_manager_line_manager"><?= $Page->line_manager->caption() ?></span></td>
        <td data-name="line_manager"<?= $Page->line_manager->cellAttributes() ?>>
<span id="el_main_pa_group_manager_line_manager">
<span<?= $Page->line_manager->viewAttributes() ?>>
<?= $Page->line_manager->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->level->Visible) { // level ?>
    <tr id="r_level"<?= $Page->level->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_group_manager_level"><?= $Page->level->caption() ?></span></td>
        <td data-name="level"<?= $Page->level->cellAttributes() ?>>
<span id="el_main_pa_group_manager_level">
<span<?= $Page->level->viewAttributes() ?>>
<?= $Page->level->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_date->Visible) { // created_date ?>
    <tr id="r_created_date"<?= $Page->created_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_group_manager_created_date"><?= $Page->created_date->caption() ?></span></td>
        <td data-name="created_date"<?= $Page->created_date->cellAttributes() ?>>
<span id="el_main_pa_group_manager_created_date">
<span<?= $Page->created_date->viewAttributes() ?>>
<?= $Page->created_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_date->Visible) { // updated_date ?>
    <tr id="r_updated_date"<?= $Page->updated_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_group_manager_updated_date"><?= $Page->updated_date->caption() ?></span></td>
        <td data-name="updated_date"<?= $Page->updated_date->cellAttributes() ?>>
<span id="el_main_pa_group_manager_updated_date">
<span<?= $Page->updated_date->viewAttributes() ?>>
<?= $Page->updated_date->getViewValue() ?></span>
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
