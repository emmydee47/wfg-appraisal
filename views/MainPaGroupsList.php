<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaGroupsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_groups: currentTable } });
var currentForm, currentPageID;
var fmain_pa_groupslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_groupslist = new ew.Form("fmain_pa_groupslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fmain_pa_groupslist;
    fmain_pa_groupslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_groupslist.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["business_unit", [fields.business_unit.visible && fields.business_unit.required ? ew.Validators.required(fields.business_unit.caption) : null], fields.business_unit.isInvalid],
        ["group_name", [fields.group_name.visible && fields.group_name.required ? ew.Validators.required(fields.group_name.caption) : null], fields.group_name.isInvalid],
        ["createddate", [fields.createddate.visible && fields.createddate.required ? ew.Validators.required(fields.createddate.caption) : null], fields.createddate.isInvalid],
        ["modifieddate", [fields.modifieddate.visible && fields.modifieddate.required ? ew.Validators.required(fields.modifieddate.caption) : null], fields.modifieddate.isInvalid]
    ]);

    // Form_CustomValidate
    fmain_pa_groupslist.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_groupslist.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_groupslist.lists.business_unit = <?= $Page->business_unit->toClientList($Page) ?>;
    loadjs.done("fmain_pa_groupslist");
});
var fmain_pa_groupssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fmain_pa_groupssrch = new ew.Form("fmain_pa_groupssrch", "list");
    currentSearchForm = fmain_pa_groupssrch;

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_groupssrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["business_unit", [], fields.business_unit.isInvalid],
        ["group_name", [], fields.group_name.isInvalid],
        ["createddate", [], fields.createddate.isInvalid],
        ["modifieddate", [], fields.modifieddate.isInvalid]
    ]);

    // Validate form
    fmain_pa_groupssrch.validate = function () {
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
    fmain_pa_groupssrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_groupssrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_groupssrch.lists.business_unit = <?= $Page->business_unit->toClientList($Page) ?>;

    // Filters
    fmain_pa_groupssrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fmain_pa_groupssrch");
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
<form name="fmain_pa_groupssrch" id="fmain_pa_groupssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fmain_pa_groupssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="main_pa_groups">
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
        <div id="el_main_pa_groups_business_unit" class="ew-search-field">
    <select
        id="x_business_unit"
        name="x_business_unit"
        class="form-control ew-select<?= $Page->business_unit->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groupssrch_x_business_unit"
        data-table="main_pa_groups"
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
loadjs.ready("fmain_pa_groupssrch", function() {
    var options = { name: "x_business_unit", selectId: "fmain_pa_groupssrch_x_business_unit" };
    if (fmain_pa_groupssrch.lists.business_unit.lookupOptions.length) {
        options.data = { id: "x_business_unit", form: "fmain_pa_groupssrch" };
    } else {
        options.ajax = { id: "x_business_unit", form: "fmain_pa_groupssrch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups.fields.business_unit.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->group_name->Visible) { // group_name ?>
<?php
if (!$Page->group_name->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_group_name" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->group_name->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_group_name" class="ew-search-caption ew-label"><?= $Page->group_name->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_group_name" id="z_group_name" value="LIKE">
</div>
        </div>
        <div id="el_main_pa_groups_group_name" class="ew-search-field">
<input type="<?= $Page->group_name->getInputTextType() ?>" name="x_group_name" id="x_group_name" data-table="main_pa_groups" data-field="x_group_name" value="<?= $Page->group_name->EditValue ?>" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->group_name->getPlaceHolder()) ?>"<?= $Page->group_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->group_name->getErrorMessage(false) ?></div>
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fmain_pa_groupssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fmain_pa_groupssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fmain_pa_groupssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fmain_pa_groupssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> main_pa_groups">
<form name="fmain_pa_groupslist" id="fmain_pa_groupslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_groups">
<div id="gmp_main_pa_groups" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_main_pa_groupslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_main_pa_groups_id" class="main_pa_groups_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->business_unit->Visible) { // business_unit ?>
        <th data-name="business_unit" class="<?= $Page->business_unit->headerCellClass() ?>"><div id="elh_main_pa_groups_business_unit" class="main_pa_groups_business_unit"><?= $Page->renderFieldHeader($Page->business_unit) ?></div></th>
<?php } ?>
<?php if ($Page->group_name->Visible) { // group_name ?>
        <th data-name="group_name" class="<?= $Page->group_name->headerCellClass() ?>"><div id="elh_main_pa_groups_group_name" class="main_pa_groups_group_name"><?= $Page->renderFieldHeader($Page->group_name) ?></div></th>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <th data-name="createddate" class="<?= $Page->createddate->headerCellClass() ?>"><div id="elh_main_pa_groups_createddate" class="main_pa_groups_createddate"><?= $Page->renderFieldHeader($Page->createddate) ?></div></th>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <th data-name="modifieddate" class="<?= $Page->modifieddate->headerCellClass() ?>"><div id="elh_main_pa_groups_modifieddate" class="main_pa_groups_modifieddate"><?= $Page->renderFieldHeader($Page->modifieddate) ?></div></th>
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
$Page->EditRowCount = 0;
if ($Page->isEdit()) {
    $Page->RowIndex = 1;
}
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
        if ($Page->isEdit()) {
            if ($Page->checkInlineEditKey() && $Page->EditRowCount == 0) { // Inline edit
                $Page->RowType = ROWTYPE_EDIT; // Render edit
            }
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
        if ($Page->isEdit() && $Page->RowType == ROWTYPE_EDIT && $Page->EventCancelled) { // Update failed
            $CurrentForm->Index = 1;
            $Page->restoreFormValues(); // Restore form values
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
            "id" => "r" . $Page->RowCount . "_main_pa_groups",
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
<span id="el<?= $Page->RowCount ?>_main_pa_groups_id" class="el_main_pa_groups_id"></span>
<input type="hidden" data-table="main_pa_groups" data-field="x_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_id" id="o<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_id" class="el_main_pa_groups_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_pa_groups" data-field="x_id" data-hidden="1" name="x<?= $Page->RowIndex ?>_id" id="x<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_id" class="el_main_pa_groups_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="main_pa_groups" data-field="x_id" data-hidden="1" name="x<?= $Page->RowIndex ?>_id" id="x<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Page->business_unit->Visible) { // business_unit ?>
        <td data-name="business_unit"<?= $Page->business_unit->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_business_unit" class="el_main_pa_groups_business_unit">
    <select
        id="x<?= $Page->RowIndex ?>_business_unit"
        name="x<?= $Page->RowIndex ?>_business_unit"
        class="form-control ew-select<?= $Page->business_unit->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groupslist_x<?= $Page->RowIndex ?>_business_unit"
        data-table="main_pa_groups"
        data-field="x_business_unit"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->business_unit->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->business_unit->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->business_unit->getPlaceHolder()) ?>"
        <?= $Page->business_unit->editAttributes() ?>>
        <?= $Page->business_unit->selectOptionListHtml("x{$Page->RowIndex}_business_unit") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->business_unit->getErrorMessage() ?></div>
<?= $Page->business_unit->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_business_unit") ?>
<script>
loadjs.ready("fmain_pa_groupslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_business_unit", selectId: "fmain_pa_groupslist_x<?= $Page->RowIndex ?>_business_unit" };
    if (fmain_pa_groupslist.lists.business_unit.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_business_unit", form: "fmain_pa_groupslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_business_unit", form: "fmain_pa_groupslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups.fields.business_unit.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_pa_groups" data-field="x_business_unit" data-hidden="1" name="o<?= $Page->RowIndex ?>_business_unit" id="o<?= $Page->RowIndex ?>_business_unit" value="<?= HtmlEncode($Page->business_unit->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_business_unit" class="el_main_pa_groups_business_unit">
    <select
        id="x<?= $Page->RowIndex ?>_business_unit"
        name="x<?= $Page->RowIndex ?>_business_unit"
        class="form-control ew-select<?= $Page->business_unit->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groupslist_x<?= $Page->RowIndex ?>_business_unit"
        data-table="main_pa_groups"
        data-field="x_business_unit"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->business_unit->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->business_unit->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->business_unit->getPlaceHolder()) ?>"
        <?= $Page->business_unit->editAttributes() ?>>
        <?= $Page->business_unit->selectOptionListHtml("x{$Page->RowIndex}_business_unit") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->business_unit->getErrorMessage() ?></div>
<?= $Page->business_unit->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_business_unit") ?>
<script>
loadjs.ready("fmain_pa_groupslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_business_unit", selectId: "fmain_pa_groupslist_x<?= $Page->RowIndex ?>_business_unit" };
    if (fmain_pa_groupslist.lists.business_unit.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_business_unit", form: "fmain_pa_groupslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_business_unit", form: "fmain_pa_groupslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups.fields.business_unit.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_business_unit" class="el_main_pa_groups_business_unit">
<span<?= $Page->business_unit->viewAttributes() ?>>
<?= $Page->business_unit->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->group_name->Visible) { // group_name ?>
        <td data-name="group_name"<?= $Page->group_name->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_group_name" class="el_main_pa_groups_group_name">
<input type="<?= $Page->group_name->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_group_name" id="x<?= $Page->RowIndex ?>_group_name" data-table="main_pa_groups" data-field="x_group_name" value="<?= $Page->group_name->EditValue ?>" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->group_name->getPlaceHolder()) ?>"<?= $Page->group_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->group_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="main_pa_groups" data-field="x_group_name" data-hidden="1" name="o<?= $Page->RowIndex ?>_group_name" id="o<?= $Page->RowIndex ?>_group_name" value="<?= HtmlEncode($Page->group_name->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_group_name" class="el_main_pa_groups_group_name">
<input type="<?= $Page->group_name->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_group_name" id="x<?= $Page->RowIndex ?>_group_name" data-table="main_pa_groups" data-field="x_group_name" value="<?= $Page->group_name->EditValue ?>" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->group_name->getPlaceHolder()) ?>"<?= $Page->group_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->group_name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_group_name" class="el_main_pa_groups_group_name">
<span<?= $Page->group_name->viewAttributes() ?>>
<?= $Page->group_name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->createddate->Visible) { // createddate ?>
        <td data-name="createddate"<?= $Page->createddate->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="main_pa_groups" data-field="x_createddate" data-hidden="1" name="o<?= $Page->RowIndex ?>_createddate" id="o<?= $Page->RowIndex ?>_createddate" value="<?= HtmlEncode($Page->createddate->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_createddate" class="el_main_pa_groups_createddate">
<span<?= $Page->createddate->viewAttributes() ?>>
<?= $Page->createddate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <td data-name="modifieddate"<?= $Page->modifieddate->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="main_pa_groups" data-field="x_modifieddate" data-hidden="1" name="o<?= $Page->RowIndex ?>_modifieddate" id="o<?= $Page->RowIndex ?>_modifieddate" value="<?= HtmlEncode($Page->modifieddate->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_modifieddate" class="el_main_pa_groups_modifieddate">
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
loadjs.ready(["fmain_pa_groupslist","load"], () => fmain_pa_groupslist.updateLists(<?= $Page->RowIndex ?>));
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
    $Page->RowAttrs->merge(["data-rowindex" => $Page->RowIndex, "id" => "r0_main_pa_groups", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_main_pa_groups_id" class="el_main_pa_groups_id"></span>
<input type="hidden" data-table="main_pa_groups" data-field="x_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_id" id="o<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->business_unit->Visible) { // business_unit ?>
        <td data-name="business_unit">
<span id="el$rowindex$_main_pa_groups_business_unit" class="el_main_pa_groups_business_unit">
    <select
        id="x<?= $Page->RowIndex ?>_business_unit"
        name="x<?= $Page->RowIndex ?>_business_unit"
        class="form-control ew-select<?= $Page->business_unit->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groupslist_x<?= $Page->RowIndex ?>_business_unit"
        data-table="main_pa_groups"
        data-field="x_business_unit"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->business_unit->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->business_unit->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->business_unit->getPlaceHolder()) ?>"
        <?= $Page->business_unit->editAttributes() ?>>
        <?= $Page->business_unit->selectOptionListHtml("x{$Page->RowIndex}_business_unit") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->business_unit->getErrorMessage() ?></div>
<?= $Page->business_unit->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_business_unit") ?>
<script>
loadjs.ready("fmain_pa_groupslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_business_unit", selectId: "fmain_pa_groupslist_x<?= $Page->RowIndex ?>_business_unit" };
    if (fmain_pa_groupslist.lists.business_unit.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_business_unit", form: "fmain_pa_groupslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_business_unit", form: "fmain_pa_groupslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups.fields.business_unit.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_pa_groups" data-field="x_business_unit" data-hidden="1" name="o<?= $Page->RowIndex ?>_business_unit" id="o<?= $Page->RowIndex ?>_business_unit" value="<?= HtmlEncode($Page->business_unit->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->group_name->Visible) { // group_name ?>
        <td data-name="group_name">
<span id="el$rowindex$_main_pa_groups_group_name" class="el_main_pa_groups_group_name">
<input type="<?= $Page->group_name->getInputTextType() ?>" name="x<?= $Page->RowIndex ?>_group_name" id="x<?= $Page->RowIndex ?>_group_name" data-table="main_pa_groups" data-field="x_group_name" value="<?= $Page->group_name->EditValue ?>" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->group_name->getPlaceHolder()) ?>"<?= $Page->group_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->group_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="main_pa_groups" data-field="x_group_name" data-hidden="1" name="o<?= $Page->RowIndex ?>_group_name" id="o<?= $Page->RowIndex ?>_group_name" value="<?= HtmlEncode($Page->group_name->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->createddate->Visible) { // createddate ?>
        <td data-name="createddate">
<input type="hidden" data-table="main_pa_groups" data-field="x_createddate" data-hidden="1" name="o<?= $Page->RowIndex ?>_createddate" id="o<?= $Page->RowIndex ?>_createddate" value="<?= HtmlEncode($Page->createddate->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <td data-name="modifieddate">
<input type="hidden" data-table="main_pa_groups" data-field="x_modifieddate" data-hidden="1" name="o<?= $Page->RowIndex ?>_modifieddate" id="o<?= $Page->RowIndex ?>_modifieddate" value="<?= HtmlEncode($Page->modifieddate->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowIndex);
?>
<script>
loadjs.ready(["fmain_pa_groupslist","load"], () => fmain_pa_groupslist.updateLists(<?= $Page->RowIndex ?>, true));
</script>
    </tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Page->isEdit()) { ?>
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
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
    ew.addEventHandlers("main_pa_groups");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
