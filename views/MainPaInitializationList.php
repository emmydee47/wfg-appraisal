<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaInitializationList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_initialization: currentTable } });
var currentForm, currentPageID;
var fmain_pa_initializationlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_initializationlist = new ew.Form("fmain_pa_initializationlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fmain_pa_initializationlist;
    fmain_pa_initializationlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fmain_pa_initializationlist");
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
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> main_pa_initialization">
<form name="fmain_pa_initializationlist" id="fmain_pa_initializationlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_initialization">
<div id="gmp_main_pa_initialization" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_main_pa_initializationlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_main_pa_initialization_id" class="main_pa_initialization_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->business_unit->Visible) { // business_unit ?>
        <th data-name="business_unit" class="<?= $Page->business_unit->headerCellClass() ?>"><div id="elh_main_pa_initialization_business_unit" class="main_pa_initialization_business_unit"><?= $Page->renderFieldHeader($Page->business_unit) ?></div></th>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
        <th data-name="group_id" class="<?= $Page->group_id->headerCellClass() ?>"><div id="elh_main_pa_initialization_group_id" class="main_pa_initialization_group_id"><?= $Page->renderFieldHeader($Page->group_id) ?></div></th>
<?php } ?>
<?php if ($Page->appraisal_mode->Visible) { // appraisal_mode ?>
        <th data-name="appraisal_mode" class="<?= $Page->appraisal_mode->headerCellClass() ?>"><div id="elh_main_pa_initialization_appraisal_mode" class="main_pa_initialization_appraisal_mode"><?= $Page->renderFieldHeader($Page->appraisal_mode) ?></div></th>
<?php } ?>
<?php if ($Page->appraisal_period->Visible) { // appraisal_period ?>
        <th data-name="appraisal_period" class="<?= $Page->appraisal_period->headerCellClass() ?>"><div id="elh_main_pa_initialization_appraisal_period" class="main_pa_initialization_appraisal_period"><?= $Page->renderFieldHeader($Page->appraisal_period) ?></div></th>
<?php } ?>
<?php if ($Page->from_year->Visible) { // from_year ?>
        <th data-name="from_year" class="<?= $Page->from_year->headerCellClass() ?>"><div id="elh_main_pa_initialization_from_year" class="main_pa_initialization_from_year"><?= $Page->renderFieldHeader($Page->from_year) ?></div></th>
<?php } ?>
<?php if ($Page->to_year->Visible) { // to_year ?>
        <th data-name="to_year" class="<?= $Page->to_year->headerCellClass() ?>"><div id="elh_main_pa_initialization_to_year" class="main_pa_initialization_to_year"><?= $Page->renderFieldHeader($Page->to_year) ?></div></th>
<?php } ?>
<?php if ($Page->employees_due_date->Visible) { // employees_due_date ?>
        <th data-name="employees_due_date" class="<?= $Page->employees_due_date->headerCellClass() ?>"><div id="elh_main_pa_initialization_employees_due_date" class="main_pa_initialization_employees_due_date"><?= $Page->renderFieldHeader($Page->employees_due_date) ?></div></th>
<?php } ?>
<?php if ($Page->managers_due_date->Visible) { // managers_due_date ?>
        <th data-name="managers_due_date" class="<?= $Page->managers_due_date->headerCellClass() ?>"><div id="elh_main_pa_initialization_managers_due_date" class="main_pa_initialization_managers_due_date"><?= $Page->renderFieldHeader($Page->managers_due_date) ?></div></th>
<?php } ?>
<?php if ($Page->initialize_status->Visible) { // initialize_status ?>
        <th data-name="initialize_status" class="<?= $Page->initialize_status->headerCellClass() ?>"><div id="elh_main_pa_initialization_initialize_status" class="main_pa_initialization_initialize_status"><?= $Page->renderFieldHeader($Page->initialize_status) ?></div></th>
<?php } ?>
<?php if ($Page->appraisal_ratings->Visible) { // appraisal_ratings ?>
        <th data-name="appraisal_ratings" class="<?= $Page->appraisal_ratings->headerCellClass() ?>"><div id="elh_main_pa_initialization_appraisal_ratings" class="main_pa_initialization_appraisal_ratings"><?= $Page->renderFieldHeader($Page->appraisal_ratings) ?></div></th>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <th data-name="createddate" class="<?= $Page->createddate->headerCellClass() ?>"><div id="elh_main_pa_initialization_createddate" class="main_pa_initialization_createddate"><?= $Page->renderFieldHeader($Page->createddate) ?></div></th>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <th data-name="modifieddate" class="<?= $Page->modifieddate->headerCellClass() ?>"><div id="elh_main_pa_initialization_modifieddate" class="main_pa_initialization_modifieddate"><?= $Page->renderFieldHeader($Page->modifieddate) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif ($Page->isGridAdd() && !$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row attributes
        $Page->RowAttrs->merge([
            "data-rowindex" => $Page->RowCount,
            "id" => "r" . $Page->RowCount . "_main_pa_initialization",
            "data-rowtype" => $Page->RowType,
            "class" => ($Page->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Page->isAdd() && $Page->RowType == ROWTYPE_ADD || $Page->isEdit() && $Page->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Page->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_id" class="el_main_pa_initialization_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->business_unit->Visible) { // business_unit ?>
        <td data-name="business_unit"<?= $Page->business_unit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_business_unit" class="el_main_pa_initialization_business_unit">
<span<?= $Page->business_unit->viewAttributes() ?>>
<?= $Page->business_unit->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->group_id->Visible) { // group_id ?>
        <td data-name="group_id"<?= $Page->group_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_group_id" class="el_main_pa_initialization_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->appraisal_mode->Visible) { // appraisal_mode ?>
        <td data-name="appraisal_mode"<?= $Page->appraisal_mode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_appraisal_mode" class="el_main_pa_initialization_appraisal_mode">
<span<?= $Page->appraisal_mode->viewAttributes() ?>>
<?= $Page->appraisal_mode->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->appraisal_period->Visible) { // appraisal_period ?>
        <td data-name="appraisal_period"<?= $Page->appraisal_period->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_appraisal_period" class="el_main_pa_initialization_appraisal_period">
<span<?= $Page->appraisal_period->viewAttributes() ?>>
<?= $Page->appraisal_period->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->from_year->Visible) { // from_year ?>
        <td data-name="from_year"<?= $Page->from_year->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_from_year" class="el_main_pa_initialization_from_year">
<span<?= $Page->from_year->viewAttributes() ?>>
<?= $Page->from_year->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->to_year->Visible) { // to_year ?>
        <td data-name="to_year"<?= $Page->to_year->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_to_year" class="el_main_pa_initialization_to_year">
<span<?= $Page->to_year->viewAttributes() ?>>
<?= $Page->to_year->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->employees_due_date->Visible) { // employees_due_date ?>
        <td data-name="employees_due_date"<?= $Page->employees_due_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_employees_due_date" class="el_main_pa_initialization_employees_due_date">
<span<?= $Page->employees_due_date->viewAttributes() ?>>
<?= $Page->employees_due_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->managers_due_date->Visible) { // managers_due_date ?>
        <td data-name="managers_due_date"<?= $Page->managers_due_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_managers_due_date" class="el_main_pa_initialization_managers_due_date">
<span<?= $Page->managers_due_date->viewAttributes() ?>>
<?= $Page->managers_due_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->initialize_status->Visible) { // initialize_status ?>
        <td data-name="initialize_status"<?= $Page->initialize_status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_initialize_status" class="el_main_pa_initialization_initialize_status">
<span<?= $Page->initialize_status->viewAttributes() ?>>
<?= $Page->initialize_status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->appraisal_ratings->Visible) { // appraisal_ratings ?>
        <td data-name="appraisal_ratings"<?= $Page->appraisal_ratings->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_appraisal_ratings" class="el_main_pa_initialization_appraisal_ratings">
<span<?= $Page->appraisal_ratings->viewAttributes() ?>>
<?= $Page->appraisal_ratings->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->createddate->Visible) { // createddate ?>
        <td data-name="createddate"<?= $Page->createddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_createddate" class="el_main_pa_initialization_createddate">
<span<?= $Page->createddate->viewAttributes() ?>>
<?= $Page->createddate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <td data-name="modifieddate"<?= $Page->modifieddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_initialization_modifieddate" class="el_main_pa_initialization_modifieddate">
<span<?= $Page->modifieddate->viewAttributes() ?>>
<?= $Page->modifieddate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("main_pa_initialization");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
