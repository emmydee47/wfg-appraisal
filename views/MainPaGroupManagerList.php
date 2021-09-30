<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaGroupManagerList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_group_manager: currentTable } });
var currentForm, currentPageID;
var fmain_pa_group_managerlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_group_managerlist = new ew.Form("fmain_pa_group_managerlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fmain_pa_group_managerlist;
    fmain_pa_group_managerlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fmain_pa_group_managerlist");
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> main_pa_group_manager">
<form name="fmain_pa_group_managerlist" id="fmain_pa_group_managerlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_group_manager">
<div id="gmp_main_pa_group_manager" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_main_pa_group_managerlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_main_pa_group_manager_id" class="main_pa_group_manager_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->business_unit->Visible) { // business_unit ?>
        <th data-name="business_unit" class="<?= $Page->business_unit->headerCellClass() ?>"><div id="elh_main_pa_group_manager_business_unit" class="main_pa_group_manager_business_unit"><?= $Page->renderFieldHeader($Page->business_unit) ?></div></th>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
        <th data-name="group_id" class="<?= $Page->group_id->headerCellClass() ?>"><div id="elh_main_pa_group_manager_group_id" class="main_pa_group_manager_group_id"><?= $Page->renderFieldHeader($Page->group_id) ?></div></th>
<?php } ?>
<?php if ($Page->line_manager->Visible) { // line_manager ?>
        <th data-name="line_manager" class="<?= $Page->line_manager->headerCellClass() ?>"><div id="elh_main_pa_group_manager_line_manager" class="main_pa_group_manager_line_manager"><?= $Page->renderFieldHeader($Page->line_manager) ?></div></th>
<?php } ?>
<?php if ($Page->level->Visible) { // level ?>
        <th data-name="level" class="<?= $Page->level->headerCellClass() ?>"><div id="elh_main_pa_group_manager_level" class="main_pa_group_manager_level"><?= $Page->renderFieldHeader($Page->level) ?></div></th>
<?php } ?>
<?php if ($Page->created_date->Visible) { // created_date ?>
        <th data-name="created_date" class="<?= $Page->created_date->headerCellClass() ?>"><div id="elh_main_pa_group_manager_created_date" class="main_pa_group_manager_created_date"><?= $Page->renderFieldHeader($Page->created_date) ?></div></th>
<?php } ?>
<?php if ($Page->updated_date->Visible) { // updated_date ?>
        <th data-name="updated_date" class="<?= $Page->updated_date->headerCellClass() ?>"><div id="elh_main_pa_group_manager_updated_date" class="main_pa_group_manager_updated_date"><?= $Page->renderFieldHeader($Page->updated_date) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_main_pa_group_manager",
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
<span id="el<?= $Page->RowCount ?>_main_pa_group_manager_id" class="el_main_pa_group_manager_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->business_unit->Visible) { // business_unit ?>
        <td data-name="business_unit"<?= $Page->business_unit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_group_manager_business_unit" class="el_main_pa_group_manager_business_unit">
<span<?= $Page->business_unit->viewAttributes() ?>>
<?= $Page->business_unit->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->group_id->Visible) { // group_id ?>
        <td data-name="group_id"<?= $Page->group_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_group_manager_group_id" class="el_main_pa_group_manager_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->line_manager->Visible) { // line_manager ?>
        <td data-name="line_manager"<?= $Page->line_manager->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_group_manager_line_manager" class="el_main_pa_group_manager_line_manager">
<span<?= $Page->line_manager->viewAttributes() ?>>
<?= $Page->line_manager->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->level->Visible) { // level ?>
        <td data-name="level"<?= $Page->level->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_group_manager_level" class="el_main_pa_group_manager_level">
<span<?= $Page->level->viewAttributes() ?>>
<?= $Page->level->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_date->Visible) { // created_date ?>
        <td data-name="created_date"<?= $Page->created_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_group_manager_created_date" class="el_main_pa_group_manager_created_date">
<span<?= $Page->created_date->viewAttributes() ?>>
<?= $Page->created_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->updated_date->Visible) { // updated_date ?>
        <td data-name="updated_date"<?= $Page->updated_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_group_manager_updated_date" class="el_main_pa_group_manager_updated_date">
<span<?= $Page->updated_date->viewAttributes() ?>>
<?= $Page->updated_date->getViewValue() ?></span>
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
    ew.addEventHandlers("main_pa_group_manager");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
