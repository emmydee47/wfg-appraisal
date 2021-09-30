<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainBusinessunitsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_businessunits: currentTable } });
var currentForm, currentPageID;
var fmain_businessunitslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_businessunitslist = new ew.Form("fmain_businessunitslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fmain_businessunitslist;
    fmain_businessunitslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fmain_businessunitslist");
});
var fmain_businessunitssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fmain_businessunitssrch = new ew.Form("fmain_businessunitssrch", "list");
    currentSearchForm = fmain_businessunitssrch;

    // Dynamic selection lists

    // Filters
    fmain_businessunitssrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fmain_businessunitssrch");
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
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
<form name="fmain_businessunitssrch" id="fmain_businessunitssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fmain_businessunitssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="main_businessunits">
<div class="ew-extended-search container-fluid">
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fmain_businessunitssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fmain_businessunitssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fmain_businessunitssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fmain_businessunitssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> main_businessunits">
<form name="fmain_businessunitslist" id="fmain_businessunitslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_businessunits">
<div id="gmp_main_businessunits" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_main_businessunitslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_main_businessunits_id" class="main_businessunits_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->unitname->Visible) { // unitname ?>
        <th data-name="unitname" class="<?= $Page->unitname->headerCellClass() ?>"><div id="elh_main_businessunits_unitname" class="main_businessunits_unitname"><?= $Page->renderFieldHeader($Page->unitname) ?></div></th>
<?php } ?>
<?php if ($Page->unitcode->Visible) { // unitcode ?>
        <th data-name="unitcode" class="<?= $Page->unitcode->headerCellClass() ?>"><div id="elh_main_businessunits_unitcode" class="main_businessunits_unitcode"><?= $Page->renderFieldHeader($Page->unitcode) ?></div></th>
<?php } ?>
<?php if ($Page->unithead->Visible) { // unithead ?>
        <th data-name="unithead" class="<?= $Page->unithead->headerCellClass() ?>"><div id="elh_main_businessunits_unithead" class="main_businessunits_unithead"><?= $Page->renderFieldHeader($Page->unithead) ?></div></th>
<?php } ?>
<?php if ($Page->createdby->Visible) { // createdby ?>
        <th data-name="createdby" class="<?= $Page->createdby->headerCellClass() ?>"><div id="elh_main_businessunits_createdby" class="main_businessunits_createdby"><?= $Page->renderFieldHeader($Page->createdby) ?></div></th>
<?php } ?>
<?php if ($Page->modifiedby->Visible) { // modifiedby ?>
        <th data-name="modifiedby" class="<?= $Page->modifiedby->headerCellClass() ?>"><div id="elh_main_businessunits_modifiedby" class="main_businessunits_modifiedby"><?= $Page->renderFieldHeader($Page->modifiedby) ?></div></th>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <th data-name="createddate" class="<?= $Page->createddate->headerCellClass() ?>"><div id="elh_main_businessunits_createddate" class="main_businessunits_createddate"><?= $Page->renderFieldHeader($Page->createddate) ?></div></th>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <th data-name="modifieddate" class="<?= $Page->modifieddate->headerCellClass() ?>"><div id="elh_main_businessunits_modifieddate" class="main_businessunits_modifieddate"><?= $Page->renderFieldHeader($Page->modifieddate) ?></div></th>
<?php } ?>
<?php if ($Page->isactive->Visible) { // isactive ?>
        <th data-name="isactive" class="<?= $Page->isactive->headerCellClass() ?>"><div id="elh_main_businessunits_isactive" class="main_businessunits_isactive"><?= $Page->renderFieldHeader($Page->isactive) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_main_businessunits",
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
<span id="el<?= $Page->RowCount ?>_main_businessunits_id" class="el_main_businessunits_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->unitname->Visible) { // unitname ?>
        <td data-name="unitname"<?= $Page->unitname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_businessunits_unitname" class="el_main_businessunits_unitname">
<span<?= $Page->unitname->viewAttributes() ?>>
<?= $Page->unitname->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->unitcode->Visible) { // unitcode ?>
        <td data-name="unitcode"<?= $Page->unitcode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_businessunits_unitcode" class="el_main_businessunits_unitcode">
<span<?= $Page->unitcode->viewAttributes() ?>>
<?= $Page->unitcode->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->unithead->Visible) { // unithead ?>
        <td data-name="unithead"<?= $Page->unithead->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_businessunits_unithead" class="el_main_businessunits_unithead">
<span<?= $Page->unithead->viewAttributes() ?>>
<?= $Page->unithead->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->createdby->Visible) { // createdby ?>
        <td data-name="createdby"<?= $Page->createdby->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_businessunits_createdby" class="el_main_businessunits_createdby">
<span<?= $Page->createdby->viewAttributes() ?>>
<?= $Page->createdby->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->modifiedby->Visible) { // modifiedby ?>
        <td data-name="modifiedby"<?= $Page->modifiedby->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_businessunits_modifiedby" class="el_main_businessunits_modifiedby">
<span<?= $Page->modifiedby->viewAttributes() ?>>
<?= $Page->modifiedby->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->createddate->Visible) { // createddate ?>
        <td data-name="createddate"<?= $Page->createddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_businessunits_createddate" class="el_main_businessunits_createddate">
<span<?= $Page->createddate->viewAttributes() ?>>
<?= $Page->createddate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <td data-name="modifieddate"<?= $Page->modifieddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_businessunits_modifieddate" class="el_main_businessunits_modifieddate">
<span<?= $Page->modifieddate->viewAttributes() ?>>
<?= $Page->modifieddate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->isactive->Visible) { // isactive ?>
        <td data-name="isactive"<?= $Page->isactive->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_businessunits_isactive" class="el_main_businessunits_isactive">
<span<?= $Page->isactive->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_isactive_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->isactive->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->isactive->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_isactive_<?= $Page->RowCount ?>"></label>
</div></span>
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
    ew.addEventHandlers("main_businessunits");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
