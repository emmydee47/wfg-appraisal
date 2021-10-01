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
var fmain_pa_group_managersrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fmain_pa_group_managersrch = new ew.Form("fmain_pa_group_managersrch", "list");
    currentSearchForm = fmain_pa_group_managersrch;

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_group_managersrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["business_unit", [], fields.business_unit.isInvalid],
        ["group_id", [], fields.group_id.isInvalid],
        ["line_manager", [], fields.line_manager.isInvalid],
        ["level", [], fields.level.isInvalid],
        ["created_date", [], fields.created_date.isInvalid],
        ["updated_date", [], fields.updated_date.isInvalid]
    ]);

    // Validate form
    fmain_pa_group_managersrch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj),
            rowIndex = "";
        $fobj.data("rowindex", rowIndex);

        // Validate fields
        if (!this.validateFields(rowIndex))
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    fmain_pa_group_managersrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_group_managersrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_group_managersrch.lists.business_unit = <?= $Page->business_unit->toClientList($Page) ?>;
    fmain_pa_group_managersrch.lists.group_id = <?= $Page->group_id->toClientList($Page) ?>;
    fmain_pa_group_managersrch.lists.line_manager = <?= $Page->line_manager->toClientList($Page) ?>;

    // Filters
    fmain_pa_group_managersrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fmain_pa_group_managersrch");
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
<form name="fmain_pa_group_managersrch" id="fmain_pa_group_managersrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fmain_pa_group_managersrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="main_pa_group_manager">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->business_unit->Visible) { // business_unit ?>
<?php
if (!$Page->business_unit->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_business_unit" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->business_unit->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_business_unit" class="ew-search-caption ew-label"><?= $Page->business_unit->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_business_unit" id="z_business_unit" value="=">
</div>
        </div>
        <div id="el_main_pa_group_manager_business_unit" class="ew-search-field">
    <select
        id="x_business_unit"
        name="x_business_unit"
        class="form-control ew-select<?= $Page->business_unit->isInvalidClass() ?>"
        data-select2-id="fmain_pa_group_managersrch_x_business_unit"
        data-table="main_pa_group_manager"
        data-field="x_business_unit"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->business_unit->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->business_unit->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->business_unit->getPlaceHolder()) ?>"
        <?= $Page->business_unit->editAttributes() ?>>
        <?= $Page->business_unit->selectOptionListHtml("x_business_unit") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->business_unit->getErrorMessage(false) ?></div>
<?= $Page->business_unit->Lookup->getParamTag($Page, "p_x_business_unit") ?>
<script>
loadjs.ready("fmain_pa_group_managersrch", function() {
    var options = { name: "x_business_unit", selectId: "fmain_pa_group_managersrch_x_business_unit" };
    if (fmain_pa_group_managersrch.lists.business_unit.lookupOptions.length) {
        options.data = { id: "x_business_unit", form: "fmain_pa_group_managersrch" };
    } else {
        options.ajax = { id: "x_business_unit", form: "fmain_pa_group_managersrch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_group_manager.fields.business_unit.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
<?php
if (!$Page->group_id->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_group_id" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->group_id->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_group_id" class="ew-search-caption ew-label"><?= $Page->group_id->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_group_id" id="z_group_id" value="=">
</div>
        </div>
        <div id="el_main_pa_group_manager_group_id" class="ew-search-field">
    <select
        id="x_group_id"
        name="x_group_id"
        class="form-control ew-select<?= $Page->group_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_group_managersrch_x_group_id"
        data-table="main_pa_group_manager"
        data-field="x_group_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->group_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->group_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->group_id->getPlaceHolder()) ?>"
        <?= $Page->group_id->editAttributes() ?>>
        <?= $Page->group_id->selectOptionListHtml("x_group_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->group_id->getErrorMessage(false) ?></div>
<?= $Page->group_id->Lookup->getParamTag($Page, "p_x_group_id") ?>
<script>
loadjs.ready("fmain_pa_group_managersrch", function() {
    var options = { name: "x_group_id", selectId: "fmain_pa_group_managersrch_x_group_id" };
    if (fmain_pa_group_managersrch.lists.group_id.lookupOptions.length) {
        options.data = { id: "x_group_id", form: "fmain_pa_group_managersrch" };
    } else {
        options.ajax = { id: "x_group_id", form: "fmain_pa_group_managersrch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_group_manager.fields.group_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->line_manager->Visible) { // line_manager ?>
<?php
if (!$Page->line_manager->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_line_manager" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->line_manager->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_line_manager" class="ew-search-caption ew-label"><?= $Page->line_manager->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_line_manager" id="z_line_manager" value="=">
</div>
        </div>
        <div id="el_main_pa_group_manager_line_manager" class="ew-search-field">
    <select
        id="x_line_manager"
        name="x_line_manager"
        class="form-control ew-select<?= $Page->line_manager->isInvalidClass() ?>"
        data-select2-id="fmain_pa_group_managersrch_x_line_manager"
        data-table="main_pa_group_manager"
        data-field="x_line_manager"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->line_manager->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->line_manager->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->line_manager->getPlaceHolder()) ?>"
        <?= $Page->line_manager->editAttributes() ?>>
        <?= $Page->line_manager->selectOptionListHtml("x_line_manager") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->line_manager->getErrorMessage(false) ?></div>
<?= $Page->line_manager->Lookup->getParamTag($Page, "p_x_line_manager") ?>
<script>
loadjs.ready("fmain_pa_group_managersrch", function() {
    var options = { name: "x_line_manager", selectId: "fmain_pa_group_managersrch_x_line_manager" };
    if (fmain_pa_group_managersrch.lists.line_manager.lookupOptions.length) {
        options.data = { id: "x_line_manager", form: "fmain_pa_group_managersrch" };
    } else {
        options.ajax = { id: "x_line_manager", form: "fmain_pa_group_managersrch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_group_manager.fields.line_manager.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
</div><!-- /.row -->
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fmain_pa_group_managersrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fmain_pa_group_managersrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fmain_pa_group_managersrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fmain_pa_group_managersrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
