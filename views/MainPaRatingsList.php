<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaRatingsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_ratings: currentTable } });
var currentForm, currentPageID;
var fmain_pa_ratingslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_ratingslist = new ew.Form("fmain_pa_ratingslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fmain_pa_ratingslist;
    fmain_pa_ratingslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_ratingslist.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["rating_type", [fields.rating_type.visible && fields.rating_type.required ? ew.Validators.required(fields.rating_type.caption) : null], fields.rating_type.isInvalid],
        ["rating_value", [fields.rating_value.visible && fields.rating_value.required ? ew.Validators.required(fields.rating_value.caption) : null, ew.Validators.integer], fields.rating_value.isInvalid],
        ["rating_text", [fields.rating_text.visible && fields.rating_text.required ? ew.Validators.required(fields.rating_text.caption) : null], fields.rating_text.isInvalid],
        ["rating_description", [fields.rating_description.visible && fields.rating_description.required ? ew.Validators.required(fields.rating_description.caption) : null], fields.rating_description.isInvalid],
        ["createddate", [fields.createddate.visible && fields.createddate.required ? ew.Validators.required(fields.createddate.caption) : null], fields.createddate.isInvalid],
        ["modifieddate", [fields.modifieddate.visible && fields.modifieddate.required ? ew.Validators.required(fields.modifieddate.caption) : null], fields.modifieddate.isInvalid]
    ]);

    // Check empty row
    fmain_pa_ratingslist.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["rating_type",false],["rating_value",false],["rating_text",false],["rating_description",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fmain_pa_ratingslist.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_ratingslist.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_ratingslist.lists.rating_type = <?= $Page->rating_type->toClientList($Page) ?>;
    loadjs.done("fmain_pa_ratingslist");
});
var fmain_pa_ratingssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fmain_pa_ratingssrch = new ew.Form("fmain_pa_ratingssrch", "list");
    currentSearchForm = fmain_pa_ratingssrch;

    // Dynamic selection lists

    // Filters
    fmain_pa_ratingssrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fmain_pa_ratingssrch");
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
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "appraisal_ratings") {
    if ($Page->MasterRecordExists) {
        include_once "views/AppraisalRatingsMaster.php";
    }
}
?>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
<form name="fmain_pa_ratingssrch" id="fmain_pa_ratingssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fmain_pa_ratingssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="main_pa_ratings">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fmain_pa_ratingssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fmain_pa_ratingssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fmain_pa_ratingssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fmain_pa_ratingssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> main_pa_ratings">
<form name="fmain_pa_ratingslist" id="fmain_pa_ratingslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_ratings">
<?php if ($Page->getCurrentMasterTable() == "appraisal_ratings" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="appraisal_ratings">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->rating_type->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_main_pa_ratings" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_main_pa_ratingslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_main_pa_ratings_id" class="main_pa_ratings_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->rating_type->Visible) { // rating_type ?>
        <th data-name="rating_type" class="<?= $Page->rating_type->headerCellClass() ?>"><div id="elh_main_pa_ratings_rating_type" class="main_pa_ratings_rating_type"><?= $Page->renderFieldHeader($Page->rating_type) ?></div></th>
<?php } ?>
<?php if ($Page->rating_value->Visible) { // rating_value ?>
        <th data-name="rating_value" class="<?= $Page->rating_value->headerCellClass() ?>"><div id="elh_main_pa_ratings_rating_value" class="main_pa_ratings_rating_value"><?= $Page->renderFieldHeader($Page->rating_value) ?></div></th>
<?php } ?>
<?php if ($Page->rating_text->Visible) { // rating_text ?>
        <th data-name="rating_text" class="<?= $Page->rating_text->headerCellClass() ?>"><div id="elh_main_pa_ratings_rating_text" class="main_pa_ratings_rating_text"><?= $Page->renderFieldHeader($Page->rating_text) ?></div></th>
<?php } ?>
<?php if ($Page->rating_description->Visible) { // rating_description ?>
        <th data-name="rating_description" class="<?= $Page->rating_description->headerCellClass() ?>"><div id="elh_main_pa_ratings_rating_description" class="main_pa_ratings_rating_description"><?= $Page->renderFieldHeader($Page->rating_description) ?></div></th>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <th data-name="createddate" class="<?= $Page->createddate->headerCellClass() ?>"><div id="elh_main_pa_ratings_createddate" class="main_pa_ratings_createddate"><?= $Page->renderFieldHeader($Page->createddate) ?></div></th>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <th data-name="modifieddate" class="<?= $Page->modifieddate->headerCellClass() ?>"><div id="elh_main_pa_ratings_modifieddate" class="main_pa_ratings_modifieddate"><?= $Page->renderFieldHeader($Page->modifieddate) ?></div></th>
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

// Restore number of post back records
if ($CurrentForm && ($Page->isConfirm() || $Page->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Page->FormKeyCountName) && ($Page->isGridAdd() || $Page->isGridEdit() || $Page->isConfirm())) {
        $Page->KeyCount = $CurrentForm->getValue($Page->FormKeyCountName);
        $Page->StopRecord = $Page->StartRecord + $Page->KeyCount - 1;
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
        if ($Page->isAdd() || $Page->isGridAdd() || $Page->isGridEdit() || $Page->isConfirm()) {
            $Page->RowIndex++;
            $CurrentForm->Index = $Page->RowIndex;
            if ($CurrentForm->hasValue($Page->FormActionName) && ($Page->isConfirm() || $Page->EventCancelled)) {
                $Page->RowAction = strval($CurrentForm->getValue($Page->FormActionName));
            } elseif ($Page->isGridAdd()) {
                $Page->RowAction = "insert";
            } else {
                $Page->RowAction = "";
            }
        }

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
        if ($Page->isGridAdd()) { // Grid add
            $Page->RowType = ROWTYPE_ADD; // Render add
        }
        if ($Page->isGridAdd() && $Page->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
            $Page->restoreCurrentRowFormValues($Page->RowIndex); // Restore form values
        }
        if ($Page->isGridEdit()) { // Grid edit
            if ($Page->EventCancelled) {
                $Page->restoreCurrentRowFormValues($Page->RowIndex); // Restore form values
            }
            if ($Page->RowAction == "insert") {
                $Page->RowType = ROWTYPE_ADD; // Render add
            } else {
                $Page->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Page->isGridEdit() && ($Page->RowType == ROWTYPE_EDIT || $Page->RowType == ROWTYPE_ADD) && $Page->EventCancelled) { // Update failed
            $Page->restoreCurrentRowFormValues($Page->RowIndex); // Restore form values
        }
        if ($Page->RowType == ROWTYPE_EDIT) { // Edit row
            $Page->EditRowCount++;
        }

        // Set up row attributes
        $Page->RowAttrs->merge([
            "data-rowindex" => $Page->RowCount,
            "id" => "r" . $Page->RowCount . "_main_pa_ratings",
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

        // Skip delete row / empty row for confirm page
        if (
            $Page->RowAction != "delete" &&
            $Page->RowAction != "insertdelete" &&
            !($Page->RowAction == "insert" && $Page->isConfirm() && $Page->emptyRow())
        ) {
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_id" class="el_main_pa_ratings_id"></span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_id" id="o<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_id" class="el_main_pa_ratings_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_id" data-hidden="1" name="x<?= $Page->RowIndex ?>_id" id="x<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_id" class="el_main_pa_ratings_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="main_pa_ratings" data-field="x_id" data-hidden="1" name="x<?= $Page->RowIndex ?>_id" id="x<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Page->rating_type->Visible) { // rating_type ?>
        <td data-name="rating_type"<?= $Page->rating_type->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Page->rating_type->getSessionValue() != "") { ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_type" class="el_main_pa_ratings_rating_type">
<span<?= $Page->rating_type->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->rating_type->getDisplayValue($Page->rating_type->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_rating_type" name="x<?= $Page->RowIndex ?>_rating_type" value="<?= HtmlEncode($Page->rating_type->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_type" class="el_main_pa_ratings_rating_type">
    <select
        id="x<?= $Page->RowIndex ?>_rating_type"
        name="x<?= $Page->RowIndex ?>_rating_type"
        class="form-select ew-select<?= $Page->rating_type->isInvalidClass() ?>"
        data-select2-id="fmain_pa_ratingslist_x<?= $Page->RowIndex ?>_rating_type"
        data-table="main_pa_ratings"
        data-field="x_rating_type"
        data-value-separator="<?= $Page->rating_type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->rating_type->getPlaceHolder()) ?>"
        <?= $Page->rating_type->editAttributes() ?>>
        <?= $Page->rating_type->selectOptionListHtml("x{$Page->RowIndex}_rating_type") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->rating_type->getErrorMessage() ?></div>
<?= $Page->rating_type->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_rating_type") ?>
<script>
loadjs.ready("fmain_pa_ratingslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_rating_type", selectId: "fmain_pa_ratingslist_x<?= $Page->RowIndex ?>_rating_type" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_ratingslist.lists.rating_type.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_rating_type", form: "fmain_pa_ratingslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_rating_type", form: "fmain_pa_ratingslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_ratings.fields.rating_type.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_type" data-hidden="1" name="o<?= $Page->RowIndex ?>_rating_type" id="o<?= $Page->RowIndex ?>_rating_type" value="<?= HtmlEncode($Page->rating_type->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Page->rating_type->getSessionValue() != "") { ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_type" class="el_main_pa_ratings_rating_type">
<span<?= $Page->rating_type->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->rating_type->getDisplayValue($Page->rating_type->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_rating_type" name="x<?= $Page->RowIndex ?>_rating_type" value="<?= HtmlEncode($Page->rating_type->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_type" class="el_main_pa_ratings_rating_type">
    <select
        id="x<?= $Page->RowIndex ?>_rating_type"
        name="x<?= $Page->RowIndex ?>_rating_type"
        class="form-select ew-select<?= $Page->rating_type->isInvalidClass() ?>"
        data-select2-id="fmain_pa_ratingslist_x<?= $Page->RowIndex ?>_rating_type"
        data-table="main_pa_ratings"
        data-field="x_rating_type"
        data-value-separator="<?= $Page->rating_type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->rating_type->getPlaceHolder()) ?>"
        <?= $Page->rating_type->editAttributes() ?>>
        <?= $Page->rating_type->selectOptionListHtml("x{$Page->RowIndex}_rating_type") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->rating_type->getErrorMessage() ?></div>
<?= $Page->rating_type->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_rating_type") ?>
<script>
loadjs.ready("fmain_pa_ratingslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_rating_type", selectId: "fmain_pa_ratingslist_x<?= $Page->RowIndex ?>_rating_type" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_ratingslist.lists.rating_type.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_rating_type", form: "fmain_pa_ratingslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_rating_type", form: "fmain_pa_ratingslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_ratings.fields.rating_type.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_type" class="el_main_pa_ratings_rating_type">
<span<?= $Page->rating_type->viewAttributes() ?>>
<?= $Page->rating_type->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->rating_value->Visible) { // rating_value ?>
        <td data-name="rating_value"<?= $Page->rating_value->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_value" class="el_main_pa_ratings_rating_value">
<input type="<?= $Page->rating_value->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_rating_value" id="x<?= $Page->RowIndex ?>_rating_value" data-table="main_pa_ratings" data-field="x_rating_value" value="<?= $Page->rating_value->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->rating_value->getPlaceHolder()) ?>"<?= $Page->rating_value->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->rating_value->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_value" data-hidden="1" name="o<?= $Page->RowIndex ?>_rating_value" id="o<?= $Page->RowIndex ?>_rating_value" value="<?= HtmlEncode($Page->rating_value->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_value" class="el_main_pa_ratings_rating_value">
<input type="<?= $Page->rating_value->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_rating_value" id="x<?= $Page->RowIndex ?>_rating_value" data-table="main_pa_ratings" data-field="x_rating_value" value="<?= $Page->rating_value->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->rating_value->getPlaceHolder()) ?>"<?= $Page->rating_value->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->rating_value->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_value" class="el_main_pa_ratings_rating_value">
<span<?= $Page->rating_value->viewAttributes() ?>>
<?= $Page->rating_value->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->rating_text->Visible) { // rating_text ?>
        <td data-name="rating_text"<?= $Page->rating_text->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_text" class="el_main_pa_ratings_rating_text">
<textarea data-table="main_pa_ratings" data-field="x_rating_text" name="x<?= $Page->RowIndex ?>_rating_text" id="x<?= $Page->RowIndex ?>_rating_text" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->rating_text->getPlaceHolder()) ?>"<?= $Page->rating_text->editAttributes() ?>><?= $Page->rating_text->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->rating_text->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_text" data-hidden="1" name="o<?= $Page->RowIndex ?>_rating_text" id="o<?= $Page->RowIndex ?>_rating_text" value="<?= HtmlEncode($Page->rating_text->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_text" class="el_main_pa_ratings_rating_text">
<textarea data-table="main_pa_ratings" data-field="x_rating_text" name="x<?= $Page->RowIndex ?>_rating_text" id="x<?= $Page->RowIndex ?>_rating_text" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->rating_text->getPlaceHolder()) ?>"<?= $Page->rating_text->editAttributes() ?>><?= $Page->rating_text->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->rating_text->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_text" class="el_main_pa_ratings_rating_text">
<span<?= $Page->rating_text->viewAttributes() ?>>
<?= $Page->rating_text->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->rating_description->Visible) { // rating_description ?>
        <td data-name="rating_description"<?= $Page->rating_description->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_description" class="el_main_pa_ratings_rating_description">
<?php $Page->rating_description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="main_pa_ratings" data-field="x_rating_description" name="x<?= $Page->RowIndex ?>_rating_description" id="x<?= $Page->RowIndex ?>_rating_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->rating_description->getPlaceHolder()) ?>"<?= $Page->rating_description->editAttributes() ?>><?= $Page->rating_description->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->rating_description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fmain_pa_ratingslist", "editor"], function() {
	ew.createEditor("fmain_pa_ratingslist", "x<?= $Page->RowIndex ?>_rating_description", 35, 4, <?= $Page->rating_description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_description" data-hidden="1" name="o<?= $Page->RowIndex ?>_rating_description" id="o<?= $Page->RowIndex ?>_rating_description" value="<?= HtmlEncode($Page->rating_description->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_description" class="el_main_pa_ratings_rating_description">
<?php $Page->rating_description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="main_pa_ratings" data-field="x_rating_description" name="x<?= $Page->RowIndex ?>_rating_description" id="x<?= $Page->RowIndex ?>_rating_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->rating_description->getPlaceHolder()) ?>"<?= $Page->rating_description->editAttributes() ?>><?= $Page->rating_description->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->rating_description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fmain_pa_ratingslist", "editor"], function() {
	ew.createEditor("fmain_pa_ratingslist", "x<?= $Page->RowIndex ?>_rating_description", 35, 4, <?= $Page->rating_description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_description" class="el_main_pa_ratings_rating_description">
<span<?= $Page->rating_description->viewAttributes() ?>>
<?= $Page->rating_description->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->createddate->Visible) { // createddate ?>
        <td data-name="createddate"<?= $Page->createddate->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_createddate" data-hidden="1" name="o<?= $Page->RowIndex ?>_createddate" id="o<?= $Page->RowIndex ?>_createddate" value="<?= HtmlEncode($Page->createddate->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_createddate" class="el_main_pa_ratings_createddate">
<span<?= $Page->createddate->viewAttributes() ?>>
<?= $Page->createddate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <td data-name="modifieddate"<?= $Page->modifieddate->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_modifieddate" data-hidden="1" name="o<?= $Page->RowIndex ?>_modifieddate" id="o<?= $Page->RowIndex ?>_modifieddate" value="<?= HtmlEncode($Page->modifieddate->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_modifieddate" class="el_main_pa_ratings_modifieddate">
<span<?= $Page->modifieddate->viewAttributes() ?>>
<?= $Page->modifieddate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php if ($Page->RowType == ROWTYPE_ADD || $Page->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fmain_pa_ratingslist","load"], () => fmain_pa_ratingslist.updateLists(<?= $Page->RowIndex ?>));
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (!$Page->isGridAdd())
        if (!$Page->Recordset->EOF) {
            $Page->Recordset->moveNext();
        }
}
?>
<?php
if ($Page->isGridAdd() || $Page->isGridEdit()) {
    $Page->RowIndex = '$rowindex$';
    $Page->loadRowValues();

    // Set row properties
    $Page->resetAttributes();
    $Page->RowAttrs->merge(["data-rowindex" => $Page->RowIndex, "id" => "r0_main_pa_ratings", "data-rowtype" => ROWTYPE_ADD]);
    $Page->RowAttrs->appendClass("ew-template");

    // Reset previous form error if any
    $Page->resetFormError();

    // Render row
    $Page->RowType = ROWTYPE_ADD;
    $Page->renderRow();

    // Render list options
    $Page->renderListOptions();
    $Page->StartRowCount = 0;
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowIndex);
?>
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id">
<span id="el$rowindex$_main_pa_ratings_id" class="el_main_pa_ratings_id"></span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_id" id="o<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->rating_type->Visible) { // rating_type ?>
        <td data-name="rating_type">
<?php if ($Page->rating_type->getSessionValue() != "") { ?>
<span id="el$rowindex$_main_pa_ratings_rating_type" class="el_main_pa_ratings_rating_type">
<span<?= $Page->rating_type->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->rating_type->getDisplayValue($Page->rating_type->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_rating_type" name="x<?= $Page->RowIndex ?>_rating_type" value="<?= HtmlEncode($Page->rating_type->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_main_pa_ratings_rating_type" class="el_main_pa_ratings_rating_type">
    <select
        id="x<?= $Page->RowIndex ?>_rating_type"
        name="x<?= $Page->RowIndex ?>_rating_type"
        class="form-select ew-select<?= $Page->rating_type->isInvalidClass() ?>"
        data-select2-id="fmain_pa_ratingslist_x<?= $Page->RowIndex ?>_rating_type"
        data-table="main_pa_ratings"
        data-field="x_rating_type"
        data-value-separator="<?= $Page->rating_type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->rating_type->getPlaceHolder()) ?>"
        <?= $Page->rating_type->editAttributes() ?>>
        <?= $Page->rating_type->selectOptionListHtml("x{$Page->RowIndex}_rating_type") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->rating_type->getErrorMessage() ?></div>
<?= $Page->rating_type->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_rating_type") ?>
<script>
loadjs.ready("fmain_pa_ratingslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_rating_type", selectId: "fmain_pa_ratingslist_x<?= $Page->RowIndex ?>_rating_type" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_ratingslist.lists.rating_type.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_rating_type", form: "fmain_pa_ratingslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_rating_type", form: "fmain_pa_ratingslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_ratings.fields.rating_type.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_type" data-hidden="1" name="o<?= $Page->RowIndex ?>_rating_type" id="o<?= $Page->RowIndex ?>_rating_type" value="<?= HtmlEncode($Page->rating_type->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->rating_value->Visible) { // rating_value ?>
        <td data-name="rating_value">
<span id="el$rowindex$_main_pa_ratings_rating_value" class="el_main_pa_ratings_rating_value">
<input type="<?= $Page->rating_value->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_rating_value" id="x<?= $Page->RowIndex ?>_rating_value" data-table="main_pa_ratings" data-field="x_rating_value" value="<?= $Page->rating_value->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->rating_value->getPlaceHolder()) ?>"<?= $Page->rating_value->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->rating_value->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_value" data-hidden="1" name="o<?= $Page->RowIndex ?>_rating_value" id="o<?= $Page->RowIndex ?>_rating_value" value="<?= HtmlEncode($Page->rating_value->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->rating_text->Visible) { // rating_text ?>
        <td data-name="rating_text">
<span id="el$rowindex$_main_pa_ratings_rating_text" class="el_main_pa_ratings_rating_text">
<textarea data-table="main_pa_ratings" data-field="x_rating_text" name="x<?= $Page->RowIndex ?>_rating_text" id="x<?= $Page->RowIndex ?>_rating_text" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->rating_text->getPlaceHolder()) ?>"<?= $Page->rating_text->editAttributes() ?>><?= $Page->rating_text->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->rating_text->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_text" data-hidden="1" name="o<?= $Page->RowIndex ?>_rating_text" id="o<?= $Page->RowIndex ?>_rating_text" value="<?= HtmlEncode($Page->rating_text->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->rating_description->Visible) { // rating_description ?>
        <td data-name="rating_description">
<span id="el$rowindex$_main_pa_ratings_rating_description" class="el_main_pa_ratings_rating_description">
<?php $Page->rating_description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="main_pa_ratings" data-field="x_rating_description" name="x<?= $Page->RowIndex ?>_rating_description" id="x<?= $Page->RowIndex ?>_rating_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->rating_description->getPlaceHolder()) ?>"<?= $Page->rating_description->editAttributes() ?>><?= $Page->rating_description->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->rating_description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fmain_pa_ratingslist", "editor"], function() {
	ew.createEditor("fmain_pa_ratingslist", "x<?= $Page->RowIndex ?>_rating_description", 35, 4, <?= $Page->rating_description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_description" data-hidden="1" name="o<?= $Page->RowIndex ?>_rating_description" id="o<?= $Page->RowIndex ?>_rating_description" value="<?= HtmlEncode($Page->rating_description->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->createddate->Visible) { // createddate ?>
        <td data-name="createddate">
<input type="hidden" data-table="main_pa_ratings" data-field="x_createddate" data-hidden="1" name="o<?= $Page->RowIndex ?>_createddate" id="o<?= $Page->RowIndex ?>_createddate" value="<?= HtmlEncode($Page->createddate->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <td data-name="modifieddate">
<input type="hidden" data-table="main_pa_ratings" data-field="x_modifieddate" data-hidden="1" name="o<?= $Page->RowIndex ?>_modifieddate" id="o<?= $Page->RowIndex ?>_modifieddate" value="<?= HtmlEncode($Page->modifieddate->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowIndex);
?>
<script>
loadjs.ready(["fmain_pa_ratingslist","load"], () => fmain_pa_ratingslist.updateLists(<?= $Page->RowIndex ?>, true));
</script>
    </tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Page->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<?= $Page->MultiSelectKey ?>
<?php } ?>
<?php if ($Page->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<?= $Page->MultiSelectKey ?>
<?php } ?>
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
    ew.addEventHandlers("main_pa_ratings");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
