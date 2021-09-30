<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaGroupsEmployeesList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_groups_employees: currentTable } });
var currentForm, currentPageID;
var fmain_pa_groups_employeeslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_groups_employeeslist = new ew.Form("fmain_pa_groups_employeeslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fmain_pa_groups_employeeslist;
    fmain_pa_groups_employeeslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_groups_employeeslist.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["group_id", [fields.group_id.visible && fields.group_id.required ? ew.Validators.required(fields.group_id.caption) : null], fields.group_id.isInvalid],
        ["employee_id", [fields.employee_id.visible && fields.employee_id.required ? ew.Validators.required(fields.employee_id.caption) : null], fields.employee_id.isInvalid],
        ["createddate", [fields.createddate.visible && fields.createddate.required ? ew.Validators.required(fields.createddate.caption) : null], fields.createddate.isInvalid],
        ["modifieddate", [fields.modifieddate.visible && fields.modifieddate.required ? ew.Validators.required(fields.modifieddate.caption) : null], fields.modifieddate.isInvalid]
    ]);

    // Check empty row
    fmain_pa_groups_employeeslist.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["group_id",false],["employee_id",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fmain_pa_groups_employeeslist.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_groups_employeeslist.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_groups_employeeslist.lists.group_id = <?= $Page->group_id->toClientList($Page) ?>;
    fmain_pa_groups_employeeslist.lists.employee_id = <?= $Page->employee_id->toClientList($Page) ?>;
    loadjs.done("fmain_pa_groups_employeeslist");
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
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "main_pa_groups") {
    if ($Page->MasterRecordExists) {
        include_once "views/MainPaGroupsMaster.php";
    }
}
?>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> main_pa_groups_employees">
<form name="fmain_pa_groups_employeeslist" id="fmain_pa_groups_employeeslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_groups_employees">
<?php if ($Page->getCurrentMasterTable() == "main_pa_groups" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="main_pa_groups">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->group_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_main_pa_groups_employees" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_main_pa_groups_employeeslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_main_pa_groups_employees_id" class="main_pa_groups_employees_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
        <th data-name="group_id" class="<?= $Page->group_id->headerCellClass() ?>"><div id="elh_main_pa_groups_employees_group_id" class="main_pa_groups_employees_group_id"><?= $Page->renderFieldHeader($Page->group_id) ?></div></th>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
        <th data-name="employee_id" class="<?= $Page->employee_id->headerCellClass() ?>"><div id="elh_main_pa_groups_employees_employee_id" class="main_pa_groups_employees_employee_id"><?= $Page->renderFieldHeader($Page->employee_id) ?></div></th>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <th data-name="createddate" class="<?= $Page->createddate->headerCellClass() ?>"><div id="elh_main_pa_groups_employees_createddate" class="main_pa_groups_employees_createddate"><?= $Page->renderFieldHeader($Page->createddate) ?></div></th>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <th data-name="modifieddate" class="<?= $Page->modifieddate->headerCellClass() ?>"><div id="elh_main_pa_groups_employees_modifieddate" class="main_pa_groups_employees_modifieddate"><?= $Page->renderFieldHeader($Page->modifieddate) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_main_pa_groups_employees",
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
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_id" class="el_main_pa_groups_employees_id"></span>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_id" id="o<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_id" class="el_main_pa_groups_employees_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_id" data-hidden="1" name="x<?= $Page->RowIndex ?>_id" id="x<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_id" class="el_main_pa_groups_employees_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="main_pa_groups_employees" data-field="x_id" data-hidden="1" name="x<?= $Page->RowIndex ?>_id" id="x<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Page->group_id->Visible) { // group_id ?>
        <td data-name="group_id"<?= $Page->group_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Page->group_id->getSessionValue() != "") { ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_group_id" class="el_main_pa_groups_employees_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->group_id->getDisplayValue($Page->group_id->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_group_id" name="x<?= $Page->RowIndex ?>_group_id" value="<?= HtmlEncode($Page->group_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_group_id" class="el_main_pa_groups_employees_group_id">
    <select
        id="x<?= $Page->RowIndex ?>_group_id"
        name="x<?= $Page->RowIndex ?>_group_id"
        class="form-control ew-select<?= $Page->group_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groups_employeeslist_x<?= $Page->RowIndex ?>_group_id"
        data-table="main_pa_groups_employees"
        data-field="x_group_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->group_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->group_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->group_id->getPlaceHolder()) ?>"
        <?= $Page->group_id->editAttributes() ?>>
        <?= $Page->group_id->selectOptionListHtml("x{$Page->RowIndex}_group_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->group_id->getErrorMessage() ?></div>
<?= $Page->group_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_group_id") ?>
<script>
loadjs.ready("fmain_pa_groups_employeeslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_group_id", selectId: "fmain_pa_groups_employeeslist_x<?= $Page->RowIndex ?>_group_id" };
    if (fmain_pa_groups_employeeslist.lists.group_id.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_group_id", form: "fmain_pa_groups_employeeslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_group_id", form: "fmain_pa_groups_employeeslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups_employees.fields.group_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_group_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_group_id" id="o<?= $Page->RowIndex ?>_group_id" value="<?= HtmlEncode($Page->group_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Page->group_id->getSessionValue() != "") { ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_group_id" class="el_main_pa_groups_employees_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->group_id->getDisplayValue($Page->group_id->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_group_id" name="x<?= $Page->RowIndex ?>_group_id" value="<?= HtmlEncode($Page->group_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_group_id" class="el_main_pa_groups_employees_group_id">
    <select
        id="x<?= $Page->RowIndex ?>_group_id"
        name="x<?= $Page->RowIndex ?>_group_id"
        class="form-control ew-select<?= $Page->group_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groups_employeeslist_x<?= $Page->RowIndex ?>_group_id"
        data-table="main_pa_groups_employees"
        data-field="x_group_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->group_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->group_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->group_id->getPlaceHolder()) ?>"
        <?= $Page->group_id->editAttributes() ?>>
        <?= $Page->group_id->selectOptionListHtml("x{$Page->RowIndex}_group_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->group_id->getErrorMessage() ?></div>
<?= $Page->group_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_group_id") ?>
<script>
loadjs.ready("fmain_pa_groups_employeeslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_group_id", selectId: "fmain_pa_groups_employeeslist_x<?= $Page->RowIndex ?>_group_id" };
    if (fmain_pa_groups_employeeslist.lists.group_id.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_group_id", form: "fmain_pa_groups_employeeslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_group_id", form: "fmain_pa_groups_employeeslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups_employees.fields.group_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_group_id" class="el_main_pa_groups_employees_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->employee_id->Visible) { // employee_id ?>
        <td data-name="employee_id"<?= $Page->employee_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_employee_id" class="el_main_pa_groups_employees_employee_id">
    <select
        id="x<?= $Page->RowIndex ?>_employee_id"
        name="x<?= $Page->RowIndex ?>_employee_id"
        class="form-control ew-select<?= $Page->employee_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groups_employeeslist_x<?= $Page->RowIndex ?>_employee_id"
        data-table="main_pa_groups_employees"
        data-field="x_employee_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->employee_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->employee_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->employee_id->getPlaceHolder()) ?>"
        <?= $Page->employee_id->editAttributes() ?>>
        <?= $Page->employee_id->selectOptionListHtml("x{$Page->RowIndex}_employee_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->employee_id->getErrorMessage() ?></div>
<?= $Page->employee_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_employee_id") ?>
<script>
loadjs.ready("fmain_pa_groups_employeeslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_employee_id", selectId: "fmain_pa_groups_employeeslist_x<?= $Page->RowIndex ?>_employee_id" };
    if (fmain_pa_groups_employeeslist.lists.employee_id.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_employee_id", form: "fmain_pa_groups_employeeslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_employee_id", form: "fmain_pa_groups_employeeslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups_employees.fields.employee_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_employee_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_employee_id" id="o<?= $Page->RowIndex ?>_employee_id" value="<?= HtmlEncode($Page->employee_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_employee_id" class="el_main_pa_groups_employees_employee_id">
    <select
        id="x<?= $Page->RowIndex ?>_employee_id"
        name="x<?= $Page->RowIndex ?>_employee_id"
        class="form-control ew-select<?= $Page->employee_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groups_employeeslist_x<?= $Page->RowIndex ?>_employee_id"
        data-table="main_pa_groups_employees"
        data-field="x_employee_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->employee_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->employee_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->employee_id->getPlaceHolder()) ?>"
        <?= $Page->employee_id->editAttributes() ?>>
        <?= $Page->employee_id->selectOptionListHtml("x{$Page->RowIndex}_employee_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->employee_id->getErrorMessage() ?></div>
<?= $Page->employee_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_employee_id") ?>
<script>
loadjs.ready("fmain_pa_groups_employeeslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_employee_id", selectId: "fmain_pa_groups_employeeslist_x<?= $Page->RowIndex ?>_employee_id" };
    if (fmain_pa_groups_employeeslist.lists.employee_id.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_employee_id", form: "fmain_pa_groups_employeeslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_employee_id", form: "fmain_pa_groups_employeeslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups_employees.fields.employee_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_employee_id" class="el_main_pa_groups_employees_employee_id">
<span<?= $Page->employee_id->viewAttributes() ?>>
<?= $Page->employee_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->createddate->Visible) { // createddate ?>
        <td data-name="createddate"<?= $Page->createddate->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_createddate" data-hidden="1" name="o<?= $Page->RowIndex ?>_createddate" id="o<?= $Page->RowIndex ?>_createddate" value="<?= HtmlEncode($Page->createddate->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_createddate" class="el_main_pa_groups_employees_createddate">
<span<?= $Page->createddate->viewAttributes() ?>>
<?= $Page->createddate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <td data-name="modifieddate"<?= $Page->modifieddate->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_modifieddate" data-hidden="1" name="o<?= $Page->RowIndex ?>_modifieddate" id="o<?= $Page->RowIndex ?>_modifieddate" value="<?= HtmlEncode($Page->modifieddate->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_groups_employees_modifieddate" class="el_main_pa_groups_employees_modifieddate">
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
loadjs.ready(["fmain_pa_groups_employeeslist","load"], () => fmain_pa_groups_employeeslist.updateLists(<?= $Page->RowIndex ?>));
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
    $Page->RowAttrs->merge(["data-rowindex" => $Page->RowIndex, "id" => "r0_main_pa_groups_employees", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_main_pa_groups_employees_id" class="el_main_pa_groups_employees_id"></span>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_id" id="o<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->group_id->Visible) { // group_id ?>
        <td data-name="group_id">
<?php if ($Page->group_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_main_pa_groups_employees_group_id" class="el_main_pa_groups_employees_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->group_id->getDisplayValue($Page->group_id->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_group_id" name="x<?= $Page->RowIndex ?>_group_id" value="<?= HtmlEncode($Page->group_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_main_pa_groups_employees_group_id" class="el_main_pa_groups_employees_group_id">
    <select
        id="x<?= $Page->RowIndex ?>_group_id"
        name="x<?= $Page->RowIndex ?>_group_id"
        class="form-control ew-select<?= $Page->group_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groups_employeeslist_x<?= $Page->RowIndex ?>_group_id"
        data-table="main_pa_groups_employees"
        data-field="x_group_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->group_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->group_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->group_id->getPlaceHolder()) ?>"
        <?= $Page->group_id->editAttributes() ?>>
        <?= $Page->group_id->selectOptionListHtml("x{$Page->RowIndex}_group_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->group_id->getErrorMessage() ?></div>
<?= $Page->group_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_group_id") ?>
<script>
loadjs.ready("fmain_pa_groups_employeeslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_group_id", selectId: "fmain_pa_groups_employeeslist_x<?= $Page->RowIndex ?>_group_id" };
    if (fmain_pa_groups_employeeslist.lists.group_id.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_group_id", form: "fmain_pa_groups_employeeslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_group_id", form: "fmain_pa_groups_employeeslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups_employees.fields.group_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_group_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_group_id" id="o<?= $Page->RowIndex ?>_group_id" value="<?= HtmlEncode($Page->group_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->employee_id->Visible) { // employee_id ?>
        <td data-name="employee_id">
<span id="el$rowindex$_main_pa_groups_employees_employee_id" class="el_main_pa_groups_employees_employee_id">
    <select
        id="x<?= $Page->RowIndex ?>_employee_id"
        name="x<?= $Page->RowIndex ?>_employee_id"
        class="form-control ew-select<?= $Page->employee_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groups_employeeslist_x<?= $Page->RowIndex ?>_employee_id"
        data-table="main_pa_groups_employees"
        data-field="x_employee_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->employee_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->employee_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->employee_id->getPlaceHolder()) ?>"
        <?= $Page->employee_id->editAttributes() ?>>
        <?= $Page->employee_id->selectOptionListHtml("x{$Page->RowIndex}_employee_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->employee_id->getErrorMessage() ?></div>
<?= $Page->employee_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_employee_id") ?>
<script>
loadjs.ready("fmain_pa_groups_employeeslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_employee_id", selectId: "fmain_pa_groups_employeeslist_x<?= $Page->RowIndex ?>_employee_id" };
    if (fmain_pa_groups_employeeslist.lists.employee_id.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_employee_id", form: "fmain_pa_groups_employeeslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_employee_id", form: "fmain_pa_groups_employeeslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups_employees.fields.employee_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_employee_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_employee_id" id="o<?= $Page->RowIndex ?>_employee_id" value="<?= HtmlEncode($Page->employee_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->createddate->Visible) { // createddate ?>
        <td data-name="createddate">
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_createddate" data-hidden="1" name="o<?= $Page->RowIndex ?>_createddate" id="o<?= $Page->RowIndex ?>_createddate" value="<?= HtmlEncode($Page->createddate->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <td data-name="modifieddate">
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_modifieddate" data-hidden="1" name="o<?= $Page->RowIndex ?>_modifieddate" id="o<?= $Page->RowIndex ?>_modifieddate" value="<?= HtmlEncode($Page->modifieddate->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowIndex);
?>
<script>
loadjs.ready(["fmain_pa_groups_employeeslist","load"], () => fmain_pa_groups_employeeslist.updateLists(<?= $Page->RowIndex ?>, true));
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
    ew.addEventHandlers("main_pa_groups_employees");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>