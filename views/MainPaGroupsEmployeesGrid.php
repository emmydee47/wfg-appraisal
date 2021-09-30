<?php

namespace PHPMaker2022\wfg_appraisal;

// Set up and run Grid object
$Grid = Container("MainPaGroupsEmployeesGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fmain_pa_groups_employeesgrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_groups_employeesgrid = new ew.Form("fmain_pa_groups_employeesgrid", "grid");
    fmain_pa_groups_employeesgrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { main_pa_groups_employees: currentTable } });
    var fields = currentTable.fields;
    fmain_pa_groups_employeesgrid.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["group_id", [fields.group_id.visible && fields.group_id.required ? ew.Validators.required(fields.group_id.caption) : null], fields.group_id.isInvalid],
        ["employee_id", [fields.employee_id.visible && fields.employee_id.required ? ew.Validators.required(fields.employee_id.caption) : null], fields.employee_id.isInvalid],
        ["createddate", [fields.createddate.visible && fields.createddate.required ? ew.Validators.required(fields.createddate.caption) : null], fields.createddate.isInvalid],
        ["modifieddate", [fields.modifieddate.visible && fields.modifieddate.required ? ew.Validators.required(fields.modifieddate.caption) : null], fields.modifieddate.isInvalid]
    ]);

    // Check empty row
    fmain_pa_groups_employeesgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["group_id",false],["employee_id",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fmain_pa_groups_employeesgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_groups_employeesgrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_groups_employeesgrid.lists.group_id = <?= $Grid->group_id->toClientList($Grid) ?>;
    fmain_pa_groups_employeesgrid.lists.employee_id = <?= $Grid->employee_id->toClientList($Grid) ?>;
    loadjs.done("fmain_pa_groups_employeesgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> main_pa_groups_employees">
<div id="fmain_pa_groups_employeesgrid" class="ew-form ew-list-form">
<div id="gmp_main_pa_groups_employees" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_main_pa_groups_employeesgrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_main_pa_groups_employees_id" class="main_pa_groups_employees_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->group_id->Visible) { // group_id ?>
        <th data-name="group_id" class="<?= $Grid->group_id->headerCellClass() ?>"><div id="elh_main_pa_groups_employees_group_id" class="main_pa_groups_employees_group_id"><?= $Grid->renderFieldHeader($Grid->group_id) ?></div></th>
<?php } ?>
<?php if ($Grid->employee_id->Visible) { // employee_id ?>
        <th data-name="employee_id" class="<?= $Grid->employee_id->headerCellClass() ?>"><div id="elh_main_pa_groups_employees_employee_id" class="main_pa_groups_employees_employee_id"><?= $Grid->renderFieldHeader($Grid->employee_id) ?></div></th>
<?php } ?>
<?php if ($Grid->createddate->Visible) { // createddate ?>
        <th data-name="createddate" class="<?= $Grid->createddate->headerCellClass() ?>"><div id="elh_main_pa_groups_employees_createddate" class="main_pa_groups_employees_createddate"><?= $Grid->renderFieldHeader($Grid->createddate) ?></div></th>
<?php } ?>
<?php if ($Grid->modifieddate->Visible) { // modifieddate ?>
        <th data-name="modifieddate" class="<?= $Grid->modifieddate->headerCellClass() ?>"><div id="elh_main_pa_groups_employees_modifieddate" class="main_pa_groups_employees_modifieddate"><?= $Grid->renderFieldHeader($Grid->modifieddate) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
$Grid->StartRecord = 1;
$Grid->StopRecord = $Grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Grid->isConfirm() || $Grid->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Grid->FormKeyCountName) && ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm())) {
        $Grid->KeyCount = $CurrentForm->getValue($Grid->FormKeyCountName);
        $Grid->StopRecord = $Grid->StartRecord + $Grid->KeyCount - 1;
    }
}
$Grid->RecordCount = $Grid->StartRecord - 1;
if ($Grid->Recordset && !$Grid->Recordset->EOF) {
    // Nothing to do
} elseif ($Grid->isGridAdd() && !$Grid->AllowAddDeleteRow && $Grid->StopRecord == 0) {
    $Grid->StopRecord = $Grid->GridAddRowCount;
}

// Initialize aggregate
$Grid->RowType = ROWTYPE_AGGREGATEINIT;
$Grid->resetAttributes();
$Grid->renderRow();
while ($Grid->RecordCount < $Grid->StopRecord) {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->RowCount++;
        if ($Grid->isAdd() || $Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm()) {
            $Grid->RowIndex++;
            $CurrentForm->Index = $Grid->RowIndex;
            if ($CurrentForm->hasValue($Grid->FormActionName) && ($Grid->isConfirm() || $Grid->EventCancelled)) {
                $Grid->RowAction = strval($CurrentForm->getValue($Grid->FormActionName));
            } elseif ($Grid->isGridAdd()) {
                $Grid->RowAction = "insert";
            } else {
                $Grid->RowAction = "";
            }
        }

        // Set up key count
        $Grid->KeyCount = $Grid->RowIndex;

        // Init row class and style
        $Grid->resetAttributes();
        $Grid->CssClass = "";
        if ($Grid->isGridAdd()) {
            if ($Grid->CurrentMode == "copy") {
                $Grid->loadRowValues($Grid->Recordset); // Load row values
                $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
            } else {
                $Grid->loadRowValues(); // Load default values
                $Grid->OldKey = "";
            }
        } else {
            $Grid->loadRowValues($Grid->Recordset); // Load row values
            $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
        }
        $Grid->setKey($Grid->OldKey);
        $Grid->RowType = ROWTYPE_VIEW; // Render view
        if ($Grid->isGridAdd()) { // Grid add
            $Grid->RowType = ROWTYPE_ADD; // Render add
        }
        if ($Grid->isGridAdd() && $Grid->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->isGridEdit()) { // Grid edit
            if ($Grid->EventCancelled) {
                $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
            }
            if ($Grid->RowAction == "insert") {
                $Grid->RowType = ROWTYPE_ADD; // Render add
            } else {
                $Grid->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Grid->isGridEdit() && ($Grid->RowType == ROWTYPE_EDIT || $Grid->RowType == ROWTYPE_ADD) && $Grid->EventCancelled) { // Update failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->RowType == ROWTYPE_EDIT) { // Edit row
            $Grid->EditRowCount++;
        }
        if ($Grid->isConfirm()) { // Confirm row
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }

        // Set up row attributes
        $Grid->RowAttrs->merge([
            "data-rowindex" => $Grid->RowCount,
            "id" => "r" . $Grid->RowCount . "_main_pa_groups_employees",
            "data-rowtype" => $Grid->RowType,
            "class" => ($Grid->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Grid->isAdd() && $Grid->RowType == ROWTYPE_ADD || $Grid->isEdit() && $Grid->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Grid->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();

        // Skip delete row / empty row for confirm page
        if (
            $Page->RowAction != "delete" &&
            $Page->RowAction != "insertdelete" &&
            !($Page->RowAction == "insert" && $Page->isConfirm() && $Page->emptyRow())
        ) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->id->Visible) { // id ?>
        <td data-name="id"<?= $Grid->id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_groups_employees_id" class="el_main_pa_groups_employees_id"></span>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_groups_employees_id" class="el_main_pa_groups_employees_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_groups_employees_id" class="el_main_pa_groups_employees_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_id" data-hidden="1" name="fmain_pa_groups_employeesgrid$x<?= $Grid->RowIndex ?>_id" id="fmain_pa_groups_employeesgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_id" data-hidden="1" name="fmain_pa_groups_employeesgrid$o<?= $Grid->RowIndex ?>_id" id="fmain_pa_groups_employeesgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="main_pa_groups_employees" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->group_id->Visible) { // group_id ?>
        <td data-name="group_id"<?= $Grid->group_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->group_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_groups_employees_group_id" class="el_main_pa_groups_employees_group_id">
<span<?= $Grid->group_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->group_id->getDisplayValue($Grid->group_id->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_group_id" name="x<?= $Grid->RowIndex ?>_group_id" value="<?= HtmlEncode($Grid->group_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_groups_employees_group_id" class="el_main_pa_groups_employees_group_id">
    <select
        id="x<?= $Grid->RowIndex ?>_group_id"
        name="x<?= $Grid->RowIndex ?>_group_id"
        class="form-control ew-select<?= $Grid->group_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groups_employeesgrid_x<?= $Grid->RowIndex ?>_group_id"
        data-table="main_pa_groups_employees"
        data-field="x_group_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->group_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->group_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->group_id->getPlaceHolder()) ?>"
        <?= $Grid->group_id->editAttributes() ?>>
        <?= $Grid->group_id->selectOptionListHtml("x{$Grid->RowIndex}_group_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->group_id->getErrorMessage() ?></div>
<?= $Grid->group_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_group_id") ?>
<script>
loadjs.ready("fmain_pa_groups_employeesgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_group_id", selectId: "fmain_pa_groups_employeesgrid_x<?= $Grid->RowIndex ?>_group_id" };
    if (fmain_pa_groups_employeesgrid.lists.group_id.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_group_id", form: "fmain_pa_groups_employeesgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_group_id", form: "fmain_pa_groups_employeesgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups_employees.fields.group_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_group_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_group_id" id="o<?= $Grid->RowIndex ?>_group_id" value="<?= HtmlEncode($Grid->group_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->group_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_groups_employees_group_id" class="el_main_pa_groups_employees_group_id">
<span<?= $Grid->group_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->group_id->getDisplayValue($Grid->group_id->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_group_id" name="x<?= $Grid->RowIndex ?>_group_id" value="<?= HtmlEncode($Grid->group_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_groups_employees_group_id" class="el_main_pa_groups_employees_group_id">
    <select
        id="x<?= $Grid->RowIndex ?>_group_id"
        name="x<?= $Grid->RowIndex ?>_group_id"
        class="form-control ew-select<?= $Grid->group_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groups_employeesgrid_x<?= $Grid->RowIndex ?>_group_id"
        data-table="main_pa_groups_employees"
        data-field="x_group_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->group_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->group_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->group_id->getPlaceHolder()) ?>"
        <?= $Grid->group_id->editAttributes() ?>>
        <?= $Grid->group_id->selectOptionListHtml("x{$Grid->RowIndex}_group_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->group_id->getErrorMessage() ?></div>
<?= $Grid->group_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_group_id") ?>
<script>
loadjs.ready("fmain_pa_groups_employeesgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_group_id", selectId: "fmain_pa_groups_employeesgrid_x<?= $Grid->RowIndex ?>_group_id" };
    if (fmain_pa_groups_employeesgrid.lists.group_id.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_group_id", form: "fmain_pa_groups_employeesgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_group_id", form: "fmain_pa_groups_employeesgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups_employees.fields.group_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_groups_employees_group_id" class="el_main_pa_groups_employees_group_id">
<span<?= $Grid->group_id->viewAttributes() ?>>
<?= $Grid->group_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_group_id" data-hidden="1" name="fmain_pa_groups_employeesgrid$x<?= $Grid->RowIndex ?>_group_id" id="fmain_pa_groups_employeesgrid$x<?= $Grid->RowIndex ?>_group_id" value="<?= HtmlEncode($Grid->group_id->FormValue) ?>">
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_group_id" data-hidden="1" name="fmain_pa_groups_employeesgrid$o<?= $Grid->RowIndex ?>_group_id" id="fmain_pa_groups_employeesgrid$o<?= $Grid->RowIndex ?>_group_id" value="<?= HtmlEncode($Grid->group_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->employee_id->Visible) { // employee_id ?>
        <td data-name="employee_id"<?= $Grid->employee_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_groups_employees_employee_id" class="el_main_pa_groups_employees_employee_id">
    <select
        id="x<?= $Grid->RowIndex ?>_employee_id"
        name="x<?= $Grid->RowIndex ?>_employee_id"
        class="form-control ew-select<?= $Grid->employee_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groups_employeesgrid_x<?= $Grid->RowIndex ?>_employee_id"
        data-table="main_pa_groups_employees"
        data-field="x_employee_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->employee_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->employee_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->employee_id->getPlaceHolder()) ?>"
        <?= $Grid->employee_id->editAttributes() ?>>
        <?= $Grid->employee_id->selectOptionListHtml("x{$Grid->RowIndex}_employee_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->employee_id->getErrorMessage() ?></div>
<?= $Grid->employee_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_employee_id") ?>
<script>
loadjs.ready("fmain_pa_groups_employeesgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_employee_id", selectId: "fmain_pa_groups_employeesgrid_x<?= $Grid->RowIndex ?>_employee_id" };
    if (fmain_pa_groups_employeesgrid.lists.employee_id.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_employee_id", form: "fmain_pa_groups_employeesgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_employee_id", form: "fmain_pa_groups_employeesgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups_employees.fields.employee_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_employee_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_employee_id" id="o<?= $Grid->RowIndex ?>_employee_id" value="<?= HtmlEncode($Grid->employee_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_groups_employees_employee_id" class="el_main_pa_groups_employees_employee_id">
    <select
        id="x<?= $Grid->RowIndex ?>_employee_id"
        name="x<?= $Grid->RowIndex ?>_employee_id"
        class="form-control ew-select<?= $Grid->employee_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groups_employeesgrid_x<?= $Grid->RowIndex ?>_employee_id"
        data-table="main_pa_groups_employees"
        data-field="x_employee_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->employee_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->employee_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->employee_id->getPlaceHolder()) ?>"
        <?= $Grid->employee_id->editAttributes() ?>>
        <?= $Grid->employee_id->selectOptionListHtml("x{$Grid->RowIndex}_employee_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->employee_id->getErrorMessage() ?></div>
<?= $Grid->employee_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_employee_id") ?>
<script>
loadjs.ready("fmain_pa_groups_employeesgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_employee_id", selectId: "fmain_pa_groups_employeesgrid_x<?= $Grid->RowIndex ?>_employee_id" };
    if (fmain_pa_groups_employeesgrid.lists.employee_id.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_employee_id", form: "fmain_pa_groups_employeesgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_employee_id", form: "fmain_pa_groups_employeesgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups_employees.fields.employee_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_groups_employees_employee_id" class="el_main_pa_groups_employees_employee_id">
<span<?= $Grid->employee_id->viewAttributes() ?>>
<?= $Grid->employee_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_employee_id" data-hidden="1" name="fmain_pa_groups_employeesgrid$x<?= $Grid->RowIndex ?>_employee_id" id="fmain_pa_groups_employeesgrid$x<?= $Grid->RowIndex ?>_employee_id" value="<?= HtmlEncode($Grid->employee_id->FormValue) ?>">
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_employee_id" data-hidden="1" name="fmain_pa_groups_employeesgrid$o<?= $Grid->RowIndex ?>_employee_id" id="fmain_pa_groups_employeesgrid$o<?= $Grid->RowIndex ?>_employee_id" value="<?= HtmlEncode($Grid->employee_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->createddate->Visible) { // createddate ?>
        <td data-name="createddate"<?= $Grid->createddate->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_createddate" data-hidden="1" name="o<?= $Grid->RowIndex ?>_createddate" id="o<?= $Grid->RowIndex ?>_createddate" value="<?= HtmlEncode($Grid->createddate->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_groups_employees_createddate" class="el_main_pa_groups_employees_createddate">
<span<?= $Grid->createddate->viewAttributes() ?>>
<?= $Grid->createddate->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_createddate" data-hidden="1" name="fmain_pa_groups_employeesgrid$x<?= $Grid->RowIndex ?>_createddate" id="fmain_pa_groups_employeesgrid$x<?= $Grid->RowIndex ?>_createddate" value="<?= HtmlEncode($Grid->createddate->FormValue) ?>">
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_createddate" data-hidden="1" name="fmain_pa_groups_employeesgrid$o<?= $Grid->RowIndex ?>_createddate" id="fmain_pa_groups_employeesgrid$o<?= $Grid->RowIndex ?>_createddate" value="<?= HtmlEncode($Grid->createddate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->modifieddate->Visible) { // modifieddate ?>
        <td data-name="modifieddate"<?= $Grid->modifieddate->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_modifieddate" data-hidden="1" name="o<?= $Grid->RowIndex ?>_modifieddate" id="o<?= $Grid->RowIndex ?>_modifieddate" value="<?= HtmlEncode($Grid->modifieddate->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_groups_employees_modifieddate" class="el_main_pa_groups_employees_modifieddate">
<span<?= $Grid->modifieddate->viewAttributes() ?>>
<?= $Grid->modifieddate->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_modifieddate" data-hidden="1" name="fmain_pa_groups_employeesgrid$x<?= $Grid->RowIndex ?>_modifieddate" id="fmain_pa_groups_employeesgrid$x<?= $Grid->RowIndex ?>_modifieddate" value="<?= HtmlEncode($Grid->modifieddate->FormValue) ?>">
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_modifieddate" data-hidden="1" name="fmain_pa_groups_employeesgrid$o<?= $Grid->RowIndex ?>_modifieddate" id="fmain_pa_groups_employeesgrid$o<?= $Grid->RowIndex ?>_modifieddate" value="<?= HtmlEncode($Grid->modifieddate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fmain_pa_groups_employeesgrid","load"], () => fmain_pa_groups_employeesgrid.updateLists(<?= $Grid->RowIndex ?>));
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy")
        if (!$Grid->Recordset->EOF) {
            $Grid->Recordset->moveNext();
        }
}
?>
<?php
if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy" || $Grid->CurrentMode == "edit") {
    $Grid->RowIndex = '$rowindex$';
    $Grid->loadRowValues();

    // Set row properties
    $Grid->resetAttributes();
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_main_pa_groups_employees", "data-rowtype" => ROWTYPE_ADD]);
    $Grid->RowAttrs->appendClass("ew-template");

    // Reset previous form error if any
    $Grid->resetFormError();

    // Render row
    $Grid->RowType = ROWTYPE_ADD;
    $Grid->renderRow();

    // Render list options
    $Grid->renderListOptions();
    $Grid->StartRowCount = 0;
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowIndex);
?>
    <?php if ($Grid->id->Visible) { // id ?>
        <td data-name="id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_main_pa_groups_employees_id" class="el_main_pa_groups_employees_id"></span>
<?php } else { ?>
<span id="el$rowindex$_main_pa_groups_employees_id" class="el_main_pa_groups_employees_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->group_id->Visible) { // group_id ?>
        <td data-name="group_id">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->group_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_main_pa_groups_employees_group_id" class="el_main_pa_groups_employees_group_id">
<span<?= $Grid->group_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->group_id->getDisplayValue($Grid->group_id->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_group_id" name="x<?= $Grid->RowIndex ?>_group_id" value="<?= HtmlEncode($Grid->group_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_main_pa_groups_employees_group_id" class="el_main_pa_groups_employees_group_id">
    <select
        id="x<?= $Grid->RowIndex ?>_group_id"
        name="x<?= $Grid->RowIndex ?>_group_id"
        class="form-control ew-select<?= $Grid->group_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groups_employeesgrid_x<?= $Grid->RowIndex ?>_group_id"
        data-table="main_pa_groups_employees"
        data-field="x_group_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->group_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->group_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->group_id->getPlaceHolder()) ?>"
        <?= $Grid->group_id->editAttributes() ?>>
        <?= $Grid->group_id->selectOptionListHtml("x{$Grid->RowIndex}_group_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->group_id->getErrorMessage() ?></div>
<?= $Grid->group_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_group_id") ?>
<script>
loadjs.ready("fmain_pa_groups_employeesgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_group_id", selectId: "fmain_pa_groups_employeesgrid_x<?= $Grid->RowIndex ?>_group_id" };
    if (fmain_pa_groups_employeesgrid.lists.group_id.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_group_id", form: "fmain_pa_groups_employeesgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_group_id", form: "fmain_pa_groups_employeesgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups_employees.fields.group_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_main_pa_groups_employees_group_id" class="el_main_pa_groups_employees_group_id">
<span<?= $Grid->group_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->group_id->getDisplayValue($Grid->group_id->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_group_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_group_id" id="x<?= $Grid->RowIndex ?>_group_id" value="<?= HtmlEncode($Grid->group_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_group_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_group_id" id="o<?= $Grid->RowIndex ?>_group_id" value="<?= HtmlEncode($Grid->group_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->employee_id->Visible) { // employee_id ?>
        <td data-name="employee_id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_main_pa_groups_employees_employee_id" class="el_main_pa_groups_employees_employee_id">
    <select
        id="x<?= $Grid->RowIndex ?>_employee_id"
        name="x<?= $Grid->RowIndex ?>_employee_id"
        class="form-control ew-select<?= $Grid->employee_id->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groups_employeesgrid_x<?= $Grid->RowIndex ?>_employee_id"
        data-table="main_pa_groups_employees"
        data-field="x_employee_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->employee_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->employee_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->employee_id->getPlaceHolder()) ?>"
        <?= $Grid->employee_id->editAttributes() ?>>
        <?= $Grid->employee_id->selectOptionListHtml("x{$Grid->RowIndex}_employee_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->employee_id->getErrorMessage() ?></div>
<?= $Grid->employee_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_employee_id") ?>
<script>
loadjs.ready("fmain_pa_groups_employeesgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_employee_id", selectId: "fmain_pa_groups_employeesgrid_x<?= $Grid->RowIndex ?>_employee_id" };
    if (fmain_pa_groups_employeesgrid.lists.employee_id.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_employee_id", form: "fmain_pa_groups_employeesgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_employee_id", form: "fmain_pa_groups_employeesgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups_employees.fields.employee_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_main_pa_groups_employees_employee_id" class="el_main_pa_groups_employees_employee_id">
<span<?= $Grid->employee_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->employee_id->getDisplayValue($Grid->employee_id->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_employee_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_employee_id" id="x<?= $Grid->RowIndex ?>_employee_id" value="<?= HtmlEncode($Grid->employee_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_employee_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_employee_id" id="o<?= $Grid->RowIndex ?>_employee_id" value="<?= HtmlEncode($Grid->employee_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->createddate->Visible) { // createddate ?>
        <td data-name="createddate">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_main_pa_groups_employees_createddate" class="el_main_pa_groups_employees_createddate">
<span<?= $Grid->createddate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->createddate->getDisplayValue($Grid->createddate->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_createddate" data-hidden="1" name="x<?= $Grid->RowIndex ?>_createddate" id="x<?= $Grid->RowIndex ?>_createddate" value="<?= HtmlEncode($Grid->createddate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_createddate" data-hidden="1" name="o<?= $Grid->RowIndex ?>_createddate" id="o<?= $Grid->RowIndex ?>_createddate" value="<?= HtmlEncode($Grid->createddate->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->modifieddate->Visible) { // modifieddate ?>
        <td data-name="modifieddate">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_main_pa_groups_employees_modifieddate" class="el_main_pa_groups_employees_modifieddate">
<span<?= $Grid->modifieddate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->modifieddate->getDisplayValue($Grid->modifieddate->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_modifieddate" data-hidden="1" name="x<?= $Grid->RowIndex ?>_modifieddate" id="x<?= $Grid->RowIndex ?>_modifieddate" value="<?= HtmlEncode($Grid->modifieddate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_pa_groups_employees" data-field="x_modifieddate" data-hidden="1" name="o<?= $Grid->RowIndex ?>_modifieddate" id="o<?= $Grid->RowIndex ?>_modifieddate" value="<?= HtmlEncode($Grid->modifieddate->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fmain_pa_groups_employeesgrid","load"], () => fmain_pa_groups_employeesgrid.updateLists(<?= $Grid->RowIndex ?>, true));
</script>
    </tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fmain_pa_groups_employeesgrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php if (!$Grid->isExport()) { ?>
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
