<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaScoreList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_score: currentTable } });
var currentForm, currentPageID;
var fmain_pa_scorelist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_scorelist = new ew.Form("fmain_pa_scorelist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fmain_pa_scorelist;
    fmain_pa_scorelist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_scorelist.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["appraisal", [fields.appraisal.visible && fields.appraisal.required ? ew.Validators.required(fields.appraisal.caption) : null], fields.appraisal.isInvalid],
        ["employee", [fields.employee.visible && fields.employee.required ? ew.Validators.required(fields.employee.caption) : null], fields.employee.isInvalid],
        ["line_manager_one", [fields.line_manager_one.visible && fields.line_manager_one.required ? ew.Validators.required(fields.line_manager_one.caption) : null], fields.line_manager_one.isInvalid],
        ["line_manager_two", [fields.line_manager_two.visible && fields.line_manager_two.required ? ew.Validators.required(fields.line_manager_two.caption) : null], fields.line_manager_two.isInvalid],
        ["consolidate_score", [fields.consolidate_score.visible && fields.consolidate_score.required ? ew.Validators.required(fields.consolidate_score.caption) : null], fields.consolidate_score.isInvalid],
        ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null], fields.created_at.isInvalid],
        ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null], fields.updated_at.isInvalid]
    ]);

    // Check empty row
    fmain_pa_scorelist.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["appraisal",false],["employee",false],["line_manager_one",false],["line_manager_two",false],["consolidate_score",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fmain_pa_scorelist.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_scorelist.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_scorelist.lists.appraisal = <?= $Page->appraisal->toClientList($Page) ?>;
    fmain_pa_scorelist.lists.employee = <?= $Page->employee->toClientList($Page) ?>;
    fmain_pa_scorelist.lists.line_manager_one = <?= $Page->line_manager_one->toClientList($Page) ?>;
    fmain_pa_scorelist.lists.line_manager_two = <?= $Page->line_manager_two->toClientList($Page) ?>;
    loadjs.done("fmain_pa_scorelist");
});
var fmain_pa_scoresrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fmain_pa_scoresrch = new ew.Form("fmain_pa_scoresrch", "list");
    currentSearchForm = fmain_pa_scoresrch;

    // Dynamic selection lists

    // Filters
    fmain_pa_scoresrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fmain_pa_scoresrch");
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
<form name="fmain_pa_scoresrch" id="fmain_pa_scoresrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fmain_pa_scoresrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="main_pa_score">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fmain_pa_scoresrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fmain_pa_scoresrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fmain_pa_scoresrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fmain_pa_scoresrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> main_pa_score">
<form name="fmain_pa_scorelist" id="fmain_pa_scorelist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_score">
<div id="gmp_main_pa_score" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_main_pa_scorelist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_main_pa_score_id" class="main_pa_score_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->appraisal->Visible) { // appraisal ?>
        <th data-name="appraisal" class="<?= $Page->appraisal->headerCellClass() ?>"><div id="elh_main_pa_score_appraisal" class="main_pa_score_appraisal"><?= $Page->renderFieldHeader($Page->appraisal) ?></div></th>
<?php } ?>
<?php if ($Page->employee->Visible) { // employee ?>
        <th data-name="employee" class="<?= $Page->employee->headerCellClass() ?>"><div id="elh_main_pa_score_employee" class="main_pa_score_employee"><?= $Page->renderFieldHeader($Page->employee) ?></div></th>
<?php } ?>
<?php if ($Page->line_manager_one->Visible) { // line_manager_one ?>
        <th data-name="line_manager_one" class="<?= $Page->line_manager_one->headerCellClass() ?>"><div id="elh_main_pa_score_line_manager_one" class="main_pa_score_line_manager_one"><?= $Page->renderFieldHeader($Page->line_manager_one) ?></div></th>
<?php } ?>
<?php if ($Page->line_manager_two->Visible) { // line_manager_two ?>
        <th data-name="line_manager_two" class="<?= $Page->line_manager_two->headerCellClass() ?>"><div id="elh_main_pa_score_line_manager_two" class="main_pa_score_line_manager_two"><?= $Page->renderFieldHeader($Page->line_manager_two) ?></div></th>
<?php } ?>
<?php if ($Page->consolidate_score->Visible) { // consolidate_score ?>
        <th data-name="consolidate_score" class="<?= $Page->consolidate_score->headerCellClass() ?>"><div id="elh_main_pa_score_consolidate_score" class="main_pa_score_consolidate_score"><?= $Page->renderFieldHeader($Page->consolidate_score) ?></div></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th data-name="created_at" class="<?= $Page->created_at->headerCellClass() ?>"><div id="elh_main_pa_score_created_at" class="main_pa_score_created_at"><?= $Page->renderFieldHeader($Page->created_at) ?></div></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th data-name="updated_at" class="<?= $Page->updated_at->headerCellClass() ?>"><div id="elh_main_pa_score_updated_at" class="main_pa_score_updated_at"><?= $Page->renderFieldHeader($Page->updated_at) ?></div></th>
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

        // Set up row attributes
        $Page->RowAttrs->merge([
            "data-rowindex" => $Page->RowCount,
            "id" => "r" . $Page->RowCount . "_main_pa_score",
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
<span id="el<?= $Page->RowCount ?>_main_pa_score_id" class="el_main_pa_score_id"></span>
<input type="hidden" data-table="main_pa_score" data-field="x_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_id" id="o<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_score_id" class="el_main_pa_score_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->appraisal->Visible) { // appraisal ?>
        <td data-name="appraisal"<?= $Page->appraisal->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_score_appraisal" class="el_main_pa_score_appraisal">
    <select
        id="x<?= $Page->RowIndex ?>_appraisal"
        name="x<?= $Page->RowIndex ?>_appraisal"
        class="form-control ew-select<?= $Page->appraisal->isInvalidClass() ?>"
        data-select2-id="fmain_pa_scorelist_x<?= $Page->RowIndex ?>_appraisal"
        data-table="main_pa_score"
        data-field="x_appraisal"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->appraisal->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->appraisal->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->appraisal->getPlaceHolder()) ?>"
        <?= $Page->appraisal->editAttributes() ?>>
        <?= $Page->appraisal->selectOptionListHtml("x{$Page->RowIndex}_appraisal") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->appraisal->getErrorMessage() ?></div>
<?= $Page->appraisal->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_appraisal") ?>
<script>
loadjs.ready("fmain_pa_scorelist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_appraisal", selectId: "fmain_pa_scorelist_x<?= $Page->RowIndex ?>_appraisal" };
    if (fmain_pa_scorelist.lists.appraisal.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_appraisal", form: "fmain_pa_scorelist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_appraisal", form: "fmain_pa_scorelist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_score.fields.appraisal.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_pa_score" data-field="x_appraisal" data-hidden="1" name="o<?= $Page->RowIndex ?>_appraisal" id="o<?= $Page->RowIndex ?>_appraisal" value="<?= HtmlEncode($Page->appraisal->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_score_appraisal" class="el_main_pa_score_appraisal">
<span<?= $Page->appraisal->viewAttributes() ?>>
<?= $Page->appraisal->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->employee->Visible) { // employee ?>
        <td data-name="employee"<?= $Page->employee->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_score_employee" class="el_main_pa_score_employee">
    <select
        id="x<?= $Page->RowIndex ?>_employee"
        name="x<?= $Page->RowIndex ?>_employee"
        class="form-control ew-select<?= $Page->employee->isInvalidClass() ?>"
        data-select2-id="fmain_pa_scorelist_x<?= $Page->RowIndex ?>_employee"
        data-table="main_pa_score"
        data-field="x_employee"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->employee->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->employee->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->employee->getPlaceHolder()) ?>"
        <?= $Page->employee->editAttributes() ?>>
        <?= $Page->employee->selectOptionListHtml("x{$Page->RowIndex}_employee") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->employee->getErrorMessage() ?></div>
<?= $Page->employee->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_employee") ?>
<script>
loadjs.ready("fmain_pa_scorelist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_employee", selectId: "fmain_pa_scorelist_x<?= $Page->RowIndex ?>_employee" };
    if (fmain_pa_scorelist.lists.employee.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_employee", form: "fmain_pa_scorelist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_employee", form: "fmain_pa_scorelist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_score.fields.employee.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_pa_score" data-field="x_employee" data-hidden="1" name="o<?= $Page->RowIndex ?>_employee" id="o<?= $Page->RowIndex ?>_employee" value="<?= HtmlEncode($Page->employee->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_score_employee" class="el_main_pa_score_employee">
<span<?= $Page->employee->viewAttributes() ?>>
<?= $Page->employee->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->line_manager_one->Visible) { // line_manager_one ?>
        <td data-name="line_manager_one"<?= $Page->line_manager_one->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_score_line_manager_one" class="el_main_pa_score_line_manager_one">
    <select
        id="x<?= $Page->RowIndex ?>_line_manager_one"
        name="x<?= $Page->RowIndex ?>_line_manager_one"
        class="form-select ew-select<?= $Page->line_manager_one->isInvalidClass() ?>"
        data-select2-id="fmain_pa_scorelist_x<?= $Page->RowIndex ?>_line_manager_one"
        data-table="main_pa_score"
        data-field="x_line_manager_one"
        data-value-separator="<?= $Page->line_manager_one->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->line_manager_one->getPlaceHolder()) ?>"
        <?= $Page->line_manager_one->editAttributes() ?>>
        <?= $Page->line_manager_one->selectOptionListHtml("x{$Page->RowIndex}_line_manager_one") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->line_manager_one->getErrorMessage() ?></div>
<?= $Page->line_manager_one->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_line_manager_one") ?>
<script>
loadjs.ready("fmain_pa_scorelist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_line_manager_one", selectId: "fmain_pa_scorelist_x<?= $Page->RowIndex ?>_line_manager_one" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_scorelist.lists.line_manager_one.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_line_manager_one", form: "fmain_pa_scorelist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_line_manager_one", form: "fmain_pa_scorelist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_score.fields.line_manager_one.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="main_pa_score" data-field="x_line_manager_one" data-hidden="1" name="o<?= $Page->RowIndex ?>_line_manager_one" id="o<?= $Page->RowIndex ?>_line_manager_one" value="<?= HtmlEncode($Page->line_manager_one->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_score_line_manager_one" class="el_main_pa_score_line_manager_one">
<span<?= $Page->line_manager_one->viewAttributes() ?>>
<?= $Page->line_manager_one->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->line_manager_two->Visible) { // line_manager_two ?>
        <td data-name="line_manager_two"<?= $Page->line_manager_two->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_score_line_manager_two" class="el_main_pa_score_line_manager_two">
    <select
        id="x<?= $Page->RowIndex ?>_line_manager_two"
        name="x<?= $Page->RowIndex ?>_line_manager_two"
        class="form-select ew-select<?= $Page->line_manager_two->isInvalidClass() ?>"
        data-select2-id="fmain_pa_scorelist_x<?= $Page->RowIndex ?>_line_manager_two"
        data-table="main_pa_score"
        data-field="x_line_manager_two"
        data-value-separator="<?= $Page->line_manager_two->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->line_manager_two->getPlaceHolder()) ?>"
        <?= $Page->line_manager_two->editAttributes() ?>>
        <?= $Page->line_manager_two->selectOptionListHtml("x{$Page->RowIndex}_line_manager_two") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->line_manager_two->getErrorMessage() ?></div>
<?= $Page->line_manager_two->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_line_manager_two") ?>
<script>
loadjs.ready("fmain_pa_scorelist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_line_manager_two", selectId: "fmain_pa_scorelist_x<?= $Page->RowIndex ?>_line_manager_two" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_scorelist.lists.line_manager_two.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_line_manager_two", form: "fmain_pa_scorelist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_line_manager_two", form: "fmain_pa_scorelist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_score.fields.line_manager_two.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="main_pa_score" data-field="x_line_manager_two" data-hidden="1" name="o<?= $Page->RowIndex ?>_line_manager_two" id="o<?= $Page->RowIndex ?>_line_manager_two" value="<?= HtmlEncode($Page->line_manager_two->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_score_line_manager_two" class="el_main_pa_score_line_manager_two">
<span<?= $Page->line_manager_two->viewAttributes() ?>>
<?= $Page->line_manager_two->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->consolidate_score->Visible) { // consolidate_score ?>
        <td data-name="consolidate_score"<?= $Page->consolidate_score->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_score_consolidate_score" class="el_main_pa_score_consolidate_score">
<textarea data-table="main_pa_score" data-field="x_consolidate_score" name="x<?= $Page->RowIndex ?>_consolidate_score" id="x<?= $Page->RowIndex ?>_consolidate_score" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->consolidate_score->getPlaceHolder()) ?>"<?= $Page->consolidate_score->editAttributes() ?>><?= $Page->consolidate_score->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->consolidate_score->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="main_pa_score" data-field="x_consolidate_score" data-hidden="1" name="o<?= $Page->RowIndex ?>_consolidate_score" id="o<?= $Page->RowIndex ?>_consolidate_score" value="<?= HtmlEncode($Page->consolidate_score->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_score_consolidate_score" class="el_main_pa_score_consolidate_score">
<span<?= $Page->consolidate_score->viewAttributes() ?>>
<?= $Page->consolidate_score->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->created_at->Visible) { // created_at ?>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="main_pa_score" data-field="x_created_at" data-hidden="1" name="o<?= $Page->RowIndex ?>_created_at" id="o<?= $Page->RowIndex ?>_created_at" value="<?= HtmlEncode($Page->created_at->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_score_created_at" class="el_main_pa_score_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="main_pa_score" data-field="x_updated_at" data-hidden="1" name="o<?= $Page->RowIndex ?>_updated_at" id="o<?= $Page->RowIndex ?>_updated_at" value="<?= HtmlEncode($Page->updated_at->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_score_updated_at" class="el_main_pa_score_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
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
loadjs.ready(["fmain_pa_scorelist","load"], () => fmain_pa_scorelist.updateLists(<?= $Page->RowIndex ?>));
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
    $Page->RowAttrs->merge(["data-rowindex" => $Page->RowIndex, "id" => "r0_main_pa_score", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_main_pa_score_id" class="el_main_pa_score_id"></span>
<input type="hidden" data-table="main_pa_score" data-field="x_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_id" id="o<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->appraisal->Visible) { // appraisal ?>
        <td data-name="appraisal">
<span id="el$rowindex$_main_pa_score_appraisal" class="el_main_pa_score_appraisal">
    <select
        id="x<?= $Page->RowIndex ?>_appraisal"
        name="x<?= $Page->RowIndex ?>_appraisal"
        class="form-control ew-select<?= $Page->appraisal->isInvalidClass() ?>"
        data-select2-id="fmain_pa_scorelist_x<?= $Page->RowIndex ?>_appraisal"
        data-table="main_pa_score"
        data-field="x_appraisal"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->appraisal->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->appraisal->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->appraisal->getPlaceHolder()) ?>"
        <?= $Page->appraisal->editAttributes() ?>>
        <?= $Page->appraisal->selectOptionListHtml("x{$Page->RowIndex}_appraisal") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->appraisal->getErrorMessage() ?></div>
<?= $Page->appraisal->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_appraisal") ?>
<script>
loadjs.ready("fmain_pa_scorelist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_appraisal", selectId: "fmain_pa_scorelist_x<?= $Page->RowIndex ?>_appraisal" };
    if (fmain_pa_scorelist.lists.appraisal.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_appraisal", form: "fmain_pa_scorelist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_appraisal", form: "fmain_pa_scorelist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_score.fields.appraisal.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_pa_score" data-field="x_appraisal" data-hidden="1" name="o<?= $Page->RowIndex ?>_appraisal" id="o<?= $Page->RowIndex ?>_appraisal" value="<?= HtmlEncode($Page->appraisal->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->employee->Visible) { // employee ?>
        <td data-name="employee">
<span id="el$rowindex$_main_pa_score_employee" class="el_main_pa_score_employee">
    <select
        id="x<?= $Page->RowIndex ?>_employee"
        name="x<?= $Page->RowIndex ?>_employee"
        class="form-control ew-select<?= $Page->employee->isInvalidClass() ?>"
        data-select2-id="fmain_pa_scorelist_x<?= $Page->RowIndex ?>_employee"
        data-table="main_pa_score"
        data-field="x_employee"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->employee->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->employee->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->employee->getPlaceHolder()) ?>"
        <?= $Page->employee->editAttributes() ?>>
        <?= $Page->employee->selectOptionListHtml("x{$Page->RowIndex}_employee") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->employee->getErrorMessage() ?></div>
<?= $Page->employee->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_employee") ?>
<script>
loadjs.ready("fmain_pa_scorelist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_employee", selectId: "fmain_pa_scorelist_x<?= $Page->RowIndex ?>_employee" };
    if (fmain_pa_scorelist.lists.employee.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_employee", form: "fmain_pa_scorelist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_employee", form: "fmain_pa_scorelist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_score.fields.employee.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_pa_score" data-field="x_employee" data-hidden="1" name="o<?= $Page->RowIndex ?>_employee" id="o<?= $Page->RowIndex ?>_employee" value="<?= HtmlEncode($Page->employee->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->line_manager_one->Visible) { // line_manager_one ?>
        <td data-name="line_manager_one">
<span id="el$rowindex$_main_pa_score_line_manager_one" class="el_main_pa_score_line_manager_one">
    <select
        id="x<?= $Page->RowIndex ?>_line_manager_one"
        name="x<?= $Page->RowIndex ?>_line_manager_one"
        class="form-select ew-select<?= $Page->line_manager_one->isInvalidClass() ?>"
        data-select2-id="fmain_pa_scorelist_x<?= $Page->RowIndex ?>_line_manager_one"
        data-table="main_pa_score"
        data-field="x_line_manager_one"
        data-value-separator="<?= $Page->line_manager_one->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->line_manager_one->getPlaceHolder()) ?>"
        <?= $Page->line_manager_one->editAttributes() ?>>
        <?= $Page->line_manager_one->selectOptionListHtml("x{$Page->RowIndex}_line_manager_one") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->line_manager_one->getErrorMessage() ?></div>
<?= $Page->line_manager_one->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_line_manager_one") ?>
<script>
loadjs.ready("fmain_pa_scorelist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_line_manager_one", selectId: "fmain_pa_scorelist_x<?= $Page->RowIndex ?>_line_manager_one" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_scorelist.lists.line_manager_one.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_line_manager_one", form: "fmain_pa_scorelist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_line_manager_one", form: "fmain_pa_scorelist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_score.fields.line_manager_one.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="main_pa_score" data-field="x_line_manager_one" data-hidden="1" name="o<?= $Page->RowIndex ?>_line_manager_one" id="o<?= $Page->RowIndex ?>_line_manager_one" value="<?= HtmlEncode($Page->line_manager_one->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->line_manager_two->Visible) { // line_manager_two ?>
        <td data-name="line_manager_two">
<span id="el$rowindex$_main_pa_score_line_manager_two" class="el_main_pa_score_line_manager_two">
    <select
        id="x<?= $Page->RowIndex ?>_line_manager_two"
        name="x<?= $Page->RowIndex ?>_line_manager_two"
        class="form-select ew-select<?= $Page->line_manager_two->isInvalidClass() ?>"
        data-select2-id="fmain_pa_scorelist_x<?= $Page->RowIndex ?>_line_manager_two"
        data-table="main_pa_score"
        data-field="x_line_manager_two"
        data-value-separator="<?= $Page->line_manager_two->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->line_manager_two->getPlaceHolder()) ?>"
        <?= $Page->line_manager_two->editAttributes() ?>>
        <?= $Page->line_manager_two->selectOptionListHtml("x{$Page->RowIndex}_line_manager_two") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->line_manager_two->getErrorMessage() ?></div>
<?= $Page->line_manager_two->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_line_manager_two") ?>
<script>
loadjs.ready("fmain_pa_scorelist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_line_manager_two", selectId: "fmain_pa_scorelist_x<?= $Page->RowIndex ?>_line_manager_two" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_scorelist.lists.line_manager_two.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_line_manager_two", form: "fmain_pa_scorelist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_line_manager_two", form: "fmain_pa_scorelist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_score.fields.line_manager_two.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="main_pa_score" data-field="x_line_manager_two" data-hidden="1" name="o<?= $Page->RowIndex ?>_line_manager_two" id="o<?= $Page->RowIndex ?>_line_manager_two" value="<?= HtmlEncode($Page->line_manager_two->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->consolidate_score->Visible) { // consolidate_score ?>
        <td data-name="consolidate_score">
<span id="el$rowindex$_main_pa_score_consolidate_score" class="el_main_pa_score_consolidate_score">
<textarea data-table="main_pa_score" data-field="x_consolidate_score" name="x<?= $Page->RowIndex ?>_consolidate_score" id="x<?= $Page->RowIndex ?>_consolidate_score" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->consolidate_score->getPlaceHolder()) ?>"<?= $Page->consolidate_score->editAttributes() ?>><?= $Page->consolidate_score->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->consolidate_score->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="main_pa_score" data-field="x_consolidate_score" data-hidden="1" name="o<?= $Page->RowIndex ?>_consolidate_score" id="o<?= $Page->RowIndex ?>_consolidate_score" value="<?= HtmlEncode($Page->consolidate_score->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->created_at->Visible) { // created_at ?>
        <td data-name="created_at">
<input type="hidden" data-table="main_pa_score" data-field="x_created_at" data-hidden="1" name="o<?= $Page->RowIndex ?>_created_at" id="o<?= $Page->RowIndex ?>_created_at" value="<?= HtmlEncode($Page->created_at->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td data-name="updated_at">
<input type="hidden" data-table="main_pa_score" data-field="x_updated_at" data-hidden="1" name="o<?= $Page->RowIndex ?>_updated_at" id="o<?= $Page->RowIndex ?>_updated_at" value="<?= HtmlEncode($Page->updated_at->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowIndex);
?>
<script>
loadjs.ready(["fmain_pa_scorelist","load"], () => fmain_pa_scorelist.updateLists(<?= $Page->RowIndex ?>, true));
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
    ew.addEventHandlers("main_pa_score");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
