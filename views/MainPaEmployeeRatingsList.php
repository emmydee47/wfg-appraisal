<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaEmployeeRatingsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_employee_ratings: currentTable } });
var currentForm, currentPageID;
var fmain_pa_employee_ratingslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_employee_ratingslist = new ew.Form("fmain_pa_employee_ratingslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fmain_pa_employee_ratingslist;
    fmain_pa_employee_ratingslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fmain_pa_employee_ratingslist");
});
var fmain_pa_employee_ratingssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fmain_pa_employee_ratingssrch = new ew.Form("fmain_pa_employee_ratingssrch", "list");
    currentSearchForm = fmain_pa_employee_ratingssrch;

    // Dynamic selection lists

    // Filters
    fmain_pa_employee_ratingssrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fmain_pa_employee_ratingssrch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Client script
    // Write your table-specific client script here, no need to add script tags.
    $('.btn-notify-l1').click(function(){
       var employee = $(this).data('employee');
       var appraisal = $(this).data('appraisal');
       sendToLineManager(appraisal, employee, 1);
    });
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
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> main_pa_employee_ratings">
<form name="fmain_pa_employee_ratingslist" id="fmain_pa_employee_ratingslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_employee_ratings">
<div id="gmp_main_pa_employee_ratings" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_main_pa_employee_ratingslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_main_pa_employee_ratings_id" class="main_pa_employee_ratings_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->appraisal_id->Visible) { // appraisal_id ?>
        <th data-name="appraisal_id" class="<?= $Page->appraisal_id->headerCellClass() ?>"><div id="elh_main_pa_employee_ratings_appraisal_id" class="main_pa_employee_ratings_appraisal_id"><?= $Page->renderFieldHeader($Page->appraisal_id) ?></div></th>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
        <th data-name="employee_id" class="<?= $Page->employee_id->headerCellClass() ?>"><div id="elh_main_pa_employee_ratings_employee_id" class="main_pa_employee_ratings_employee_id"><?= $Page->renderFieldHeader($Page->employee_id) ?></div></th>
<?php } ?>
<?php if ($Page->consolidated_rating->Visible) { // consolidated_rating ?>
        <th data-name="consolidated_rating" class="<?= $Page->consolidated_rating->headerCellClass() ?>"><div id="elh_main_pa_employee_ratings_consolidated_rating" class="main_pa_employee_ratings_consolidated_rating"><?= $Page->renderFieldHeader($Page->consolidated_rating) ?></div></th>
<?php } ?>
<?php if ($Page->appraisal_status->Visible) { // appraisal_status ?>
        <th data-name="appraisal_status" class="<?= $Page->appraisal_status->headerCellClass() ?>"><div id="elh_main_pa_employee_ratings_appraisal_status" class="main_pa_employee_ratings_appraisal_status"><?= $Page->renderFieldHeader($Page->appraisal_status) ?></div></th>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <th data-name="createddate" class="<?= $Page->createddate->headerCellClass() ?>"><div id="elh_main_pa_employee_ratings_createddate" class="main_pa_employee_ratings_createddate"><?= $Page->renderFieldHeader($Page->createddate) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_main_pa_employee_ratings",
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
<span id="el<?= $Page->RowCount ?>_main_pa_employee_ratings_id" class="el_main_pa_employee_ratings_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->appraisal_id->Visible) { // appraisal_id ?>
        <td data-name="appraisal_id"<?= $Page->appraisal_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_employee_ratings_appraisal_id" class="el_main_pa_employee_ratings_appraisal_id">
<span<?= $Page->appraisal_id->viewAttributes() ?>>
<?= $Page->appraisal_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->employee_id->Visible) { // employee_id ?>
        <td data-name="employee_id"<?= $Page->employee_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_employee_ratings_employee_id" class="el_main_pa_employee_ratings_employee_id">
<span<?= $Page->employee_id->viewAttributes() ?>>
<?= $Page->employee_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->consolidated_rating->Visible) { // consolidated_rating ?>
        <td data-name="consolidated_rating"<?= $Page->consolidated_rating->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_employee_ratings_consolidated_rating" class="el_main_pa_employee_ratings_consolidated_rating">
<span<?= $Page->consolidated_rating->viewAttributes() ?>>
<?= $Page->consolidated_rating->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->appraisal_status->Visible) { // appraisal_status ?>
        <td data-name="appraisal_status"<?= $Page->appraisal_status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_employee_ratings_appraisal_status" class="el_main_pa_employee_ratings_appraisal_status">
<span<?= $Page->appraisal_status->viewAttributes() ?>>
<?= $Page->appraisal_status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->createddate->Visible) { // createddate ?>
        <td data-name="createddate"<?= $Page->createddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_employee_ratings_createddate" class="el_main_pa_employee_ratings_createddate">
<span<?= $Page->createddate->viewAttributes() ?>>
<?= $Page->createddate->getViewValue() ?></span>
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
    ew.addEventHandlers("main_pa_employee_ratings");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
