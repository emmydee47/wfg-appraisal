<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaInitializationView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_initialization: currentTable } });
var currentForm, currentPageID;
var fmain_pa_initializationview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_initializationview = new ew.Form("fmain_pa_initializationview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fmain_pa_initializationview;
    loadjs.done("fmain_pa_initializationview");
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
<form name="fmain_pa_initializationview" id="fmain_pa_initializationview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_initialization">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_initialization_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_main_pa_initialization_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->business_unit->Visible) { // business_unit ?>
    <tr id="r_business_unit"<?= $Page->business_unit->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_initialization_business_unit"><?= $Page->business_unit->caption() ?></span></td>
        <td data-name="business_unit"<?= $Page->business_unit->cellAttributes() ?>>
<span id="el_main_pa_initialization_business_unit">
<span<?= $Page->business_unit->viewAttributes() ?>>
<?= $Page->business_unit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
    <tr id="r_group_id"<?= $Page->group_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_initialization_group_id"><?= $Page->group_id->caption() ?></span></td>
        <td data-name="group_id"<?= $Page->group_id->cellAttributes() ?>>
<span id="el_main_pa_initialization_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->appraisal_mode->Visible) { // appraisal_mode ?>
    <tr id="r_appraisal_mode"<?= $Page->appraisal_mode->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_initialization_appraisal_mode"><?= $Page->appraisal_mode->caption() ?></span></td>
        <td data-name="appraisal_mode"<?= $Page->appraisal_mode->cellAttributes() ?>>
<span id="el_main_pa_initialization_appraisal_mode">
<span<?= $Page->appraisal_mode->viewAttributes() ?>>
<?= $Page->appraisal_mode->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->appraisal_period->Visible) { // appraisal_period ?>
    <tr id="r_appraisal_period"<?= $Page->appraisal_period->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_initialization_appraisal_period"><?= $Page->appraisal_period->caption() ?></span></td>
        <td data-name="appraisal_period"<?= $Page->appraisal_period->cellAttributes() ?>>
<span id="el_main_pa_initialization_appraisal_period">
<span<?= $Page->appraisal_period->viewAttributes() ?>>
<?= $Page->appraisal_period->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->from_year->Visible) { // from_year ?>
    <tr id="r_from_year"<?= $Page->from_year->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_initialization_from_year"><?= $Page->from_year->caption() ?></span></td>
        <td data-name="from_year"<?= $Page->from_year->cellAttributes() ?>>
<span id="el_main_pa_initialization_from_year">
<span<?= $Page->from_year->viewAttributes() ?>>
<?= $Page->from_year->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->to_year->Visible) { // to_year ?>
    <tr id="r_to_year"<?= $Page->to_year->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_initialization_to_year"><?= $Page->to_year->caption() ?></span></td>
        <td data-name="to_year"<?= $Page->to_year->cellAttributes() ?>>
<span id="el_main_pa_initialization_to_year">
<span<?= $Page->to_year->viewAttributes() ?>>
<?= $Page->to_year->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employees_due_date->Visible) { // employees_due_date ?>
    <tr id="r_employees_due_date"<?= $Page->employees_due_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_initialization_employees_due_date"><?= $Page->employees_due_date->caption() ?></span></td>
        <td data-name="employees_due_date"<?= $Page->employees_due_date->cellAttributes() ?>>
<span id="el_main_pa_initialization_employees_due_date">
<span<?= $Page->employees_due_date->viewAttributes() ?>>
<?= $Page->employees_due_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->managers_due_date->Visible) { // managers_due_date ?>
    <tr id="r_managers_due_date"<?= $Page->managers_due_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_initialization_managers_due_date"><?= $Page->managers_due_date->caption() ?></span></td>
        <td data-name="managers_due_date"<?= $Page->managers_due_date->cellAttributes() ?>>
<span id="el_main_pa_initialization_managers_due_date">
<span<?= $Page->managers_due_date->viewAttributes() ?>>
<?= $Page->managers_due_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->initialize_status->Visible) { // initialize_status ?>
    <tr id="r_initialize_status"<?= $Page->initialize_status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_initialization_initialize_status"><?= $Page->initialize_status->caption() ?></span></td>
        <td data-name="initialize_status"<?= $Page->initialize_status->cellAttributes() ?>>
<span id="el_main_pa_initialization_initialize_status">
<span<?= $Page->initialize_status->viewAttributes() ?>>
<?= $Page->initialize_status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->appraisal_ratings->Visible) { // appraisal_ratings ?>
    <tr id="r_appraisal_ratings"<?= $Page->appraisal_ratings->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_initialization_appraisal_ratings"><?= $Page->appraisal_ratings->caption() ?></span></td>
        <td data-name="appraisal_ratings"<?= $Page->appraisal_ratings->cellAttributes() ?>>
<span id="el_main_pa_initialization_appraisal_ratings">
<span<?= $Page->appraisal_ratings->viewAttributes() ?>>
<?= $Page->appraisal_ratings->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->isactive->Visible) { // isactive ?>
    <tr id="r_isactive"<?= $Page->isactive->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_initialization_isactive"><?= $Page->isactive->caption() ?></span></td>
        <td data-name="isactive"<?= $Page->isactive->cellAttributes() ?>>
<span id="el_main_pa_initialization_isactive">
<span<?= $Page->isactive->viewAttributes() ?>>
<?= $Page->isactive->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->createdby->Visible) { // createdby ?>
    <tr id="r_createdby"<?= $Page->createdby->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_initialization_createdby"><?= $Page->createdby->caption() ?></span></td>
        <td data-name="createdby"<?= $Page->createdby->cellAttributes() ?>>
<span id="el_main_pa_initialization_createdby">
<span<?= $Page->createdby->viewAttributes() ?>>
<?= $Page->createdby->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modifiedby->Visible) { // modifiedby ?>
    <tr id="r_modifiedby"<?= $Page->modifiedby->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_initialization_modifiedby"><?= $Page->modifiedby->caption() ?></span></td>
        <td data-name="modifiedby"<?= $Page->modifiedby->cellAttributes() ?>>
<span id="el_main_pa_initialization_modifiedby">
<span<?= $Page->modifiedby->viewAttributes() ?>>
<?= $Page->modifiedby->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
    <tr id="r_createddate"<?= $Page->createddate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_initialization_createddate"><?= $Page->createddate->caption() ?></span></td>
        <td data-name="createddate"<?= $Page->createddate->cellAttributes() ?>>
<span id="el_main_pa_initialization_createddate">
<span<?= $Page->createddate->viewAttributes() ?>>
<?= $Page->createddate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
    <tr id="r_modifieddate"<?= $Page->modifieddate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_initialization_modifieddate"><?= $Page->modifieddate->caption() ?></span></td>
        <td data-name="modifieddate"<?= $Page->modifieddate->cellAttributes() ?>>
<span id="el_main_pa_initialization_modifieddate">
<span<?= $Page->modifieddate->viewAttributes() ?>>
<?= $Page->modifieddate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("main_group_pa_questions", explode(",", $Page->getCurrentDetailTable())) && $main_group_pa_questions->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("main_group_pa_questions", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "MainGroupPaQuestionsGrid.php" ?>
<?php } ?>
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
