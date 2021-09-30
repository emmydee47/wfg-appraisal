<?php

namespace PHPMaker2022\wfg_appraisal;

// Set up and run Grid object
$Grid = Container("MainGroupPaQuestionsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fmain_group_pa_questionsgrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_group_pa_questionsgrid = new ew.Form("fmain_group_pa_questionsgrid", "grid");
    fmain_group_pa_questionsgrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { main_group_pa_questions: currentTable } });
    var fields = currentTable.fields;
    fmain_group_pa_questionsgrid.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["appraisal_id", [fields.appraisal_id.visible && fields.appraisal_id.required ? ew.Validators.required(fields.appraisal_id.caption) : null], fields.appraisal_id.isInvalid],
        ["business_unit", [fields.business_unit.visible && fields.business_unit.required ? ew.Validators.required(fields.business_unit.caption) : null], fields.business_unit.isInvalid],
        ["group", [fields.group.visible && fields.group.required ? ew.Validators.required(fields.group.caption) : null], fields.group.isInvalid],
        ["question", [fields.question.visible && fields.question.required ? ew.Validators.required(fields.question.caption) : null], fields.question.isInvalid]
    ]);

    // Check empty row
    fmain_group_pa_questionsgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["appraisal_id",false],["business_unit",false],["group",false],["question",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fmain_group_pa_questionsgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_group_pa_questionsgrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_group_pa_questionsgrid.lists.appraisal_id = <?= $Grid->appraisal_id->toClientList($Grid) ?>;
    fmain_group_pa_questionsgrid.lists.business_unit = <?= $Grid->business_unit->toClientList($Grid) ?>;
    fmain_group_pa_questionsgrid.lists.group = <?= $Grid->group->toClientList($Grid) ?>;
    fmain_group_pa_questionsgrid.lists.question = <?= $Grid->question->toClientList($Grid) ?>;
    loadjs.done("fmain_group_pa_questionsgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> main_group_pa_questions">
<div id="fmain_group_pa_questionsgrid" class="ew-form ew-list-form">
<div id="gmp_main_group_pa_questions" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_main_group_pa_questionsgrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_main_group_pa_questions_id" class="main_group_pa_questions_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->appraisal_id->Visible) { // appraisal_id ?>
        <th data-name="appraisal_id" class="<?= $Grid->appraisal_id->headerCellClass() ?>"><div id="elh_main_group_pa_questions_appraisal_id" class="main_group_pa_questions_appraisal_id"><?= $Grid->renderFieldHeader($Grid->appraisal_id) ?></div></th>
<?php } ?>
<?php if ($Grid->business_unit->Visible) { // business_unit ?>
        <th data-name="business_unit" class="<?= $Grid->business_unit->headerCellClass() ?>"><div id="elh_main_group_pa_questions_business_unit" class="main_group_pa_questions_business_unit"><?= $Grid->renderFieldHeader($Grid->business_unit) ?></div></th>
<?php } ?>
<?php if ($Grid->group->Visible) { // group ?>
        <th data-name="group" class="<?= $Grid->group->headerCellClass() ?>"><div id="elh_main_group_pa_questions_group" class="main_group_pa_questions_group"><?= $Grid->renderFieldHeader($Grid->group) ?></div></th>
<?php } ?>
<?php if ($Grid->question->Visible) { // question ?>
        <th data-name="question" class="<?= $Grid->question->headerCellClass() ?>"><div id="elh_main_group_pa_questions_question" class="main_group_pa_questions_question"><?= $Grid->renderFieldHeader($Grid->question) ?></div></th>
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
            "id" => "r" . $Grid->RowCount . "_main_group_pa_questions",
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
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_id" class="el_main_group_pa_questions_id"></span>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_id" class="el_main_group_pa_questions_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_id" class="el_main_group_pa_questions_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_id" data-hidden="1" name="fmain_group_pa_questionsgrid$x<?= $Grid->RowIndex ?>_id" id="fmain_group_pa_questionsgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="main_group_pa_questions" data-field="x_id" data-hidden="1" name="fmain_group_pa_questionsgrid$o<?= $Grid->RowIndex ?>_id" id="fmain_group_pa_questionsgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="main_group_pa_questions" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->appraisal_id->Visible) { // appraisal_id ?>
        <td data-name="appraisal_id"<?= $Grid->appraisal_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->appraisal_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_appraisal_id" class="el_main_group_pa_questions_appraisal_id">
<span<?= $Grid->appraisal_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->appraisal_id->getDisplayValue($Grid->appraisal_id->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_appraisal_id" name="x<?= $Grid->RowIndex ?>_appraisal_id" value="<?= HtmlEncode($Grid->appraisal_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_appraisal_id" class="el_main_group_pa_questions_appraisal_id">
    <select
        id="x<?= $Grid->RowIndex ?>_appraisal_id"
        name="x<?= $Grid->RowIndex ?>_appraisal_id"
        class="form-control ew-select<?= $Grid->appraisal_id->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_appraisal_id"
        data-table="main_group_pa_questions"
        data-field="x_appraisal_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->appraisal_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->appraisal_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->appraisal_id->getPlaceHolder()) ?>"
        <?= $Grid->appraisal_id->editAttributes() ?>>
        <?= $Grid->appraisal_id->selectOptionListHtml("x{$Grid->RowIndex}_appraisal_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->appraisal_id->getErrorMessage() ?></div>
<?= $Grid->appraisal_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_appraisal_id") ?>
<script>
loadjs.ready("fmain_group_pa_questionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_appraisal_id", selectId: "fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_appraisal_id" };
    if (fmain_group_pa_questionsgrid.lists.appraisal_id.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_appraisal_id", form: "fmain_group_pa_questionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_appraisal_id", form: "fmain_group_pa_questionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.appraisal_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_appraisal_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_appraisal_id" id="o<?= $Grid->RowIndex ?>_appraisal_id" value="<?= HtmlEncode($Grid->appraisal_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->appraisal_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_appraisal_id" class="el_main_group_pa_questions_appraisal_id">
<span<?= $Grid->appraisal_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->appraisal_id->getDisplayValue($Grid->appraisal_id->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_appraisal_id" name="x<?= $Grid->RowIndex ?>_appraisal_id" value="<?= HtmlEncode($Grid->appraisal_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_appraisal_id" class="el_main_group_pa_questions_appraisal_id">
    <select
        id="x<?= $Grid->RowIndex ?>_appraisal_id"
        name="x<?= $Grid->RowIndex ?>_appraisal_id"
        class="form-control ew-select<?= $Grid->appraisal_id->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_appraisal_id"
        data-table="main_group_pa_questions"
        data-field="x_appraisal_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->appraisal_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->appraisal_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->appraisal_id->getPlaceHolder()) ?>"
        <?= $Grid->appraisal_id->editAttributes() ?>>
        <?= $Grid->appraisal_id->selectOptionListHtml("x{$Grid->RowIndex}_appraisal_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->appraisal_id->getErrorMessage() ?></div>
<?= $Grid->appraisal_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_appraisal_id") ?>
<script>
loadjs.ready("fmain_group_pa_questionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_appraisal_id", selectId: "fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_appraisal_id" };
    if (fmain_group_pa_questionsgrid.lists.appraisal_id.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_appraisal_id", form: "fmain_group_pa_questionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_appraisal_id", form: "fmain_group_pa_questionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.appraisal_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_appraisal_id" class="el_main_group_pa_questions_appraisal_id">
<span<?= $Grid->appraisal_id->viewAttributes() ?>>
<?= $Grid->appraisal_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_appraisal_id" data-hidden="1" name="fmain_group_pa_questionsgrid$x<?= $Grid->RowIndex ?>_appraisal_id" id="fmain_group_pa_questionsgrid$x<?= $Grid->RowIndex ?>_appraisal_id" value="<?= HtmlEncode($Grid->appraisal_id->FormValue) ?>">
<input type="hidden" data-table="main_group_pa_questions" data-field="x_appraisal_id" data-hidden="1" name="fmain_group_pa_questionsgrid$o<?= $Grid->RowIndex ?>_appraisal_id" id="fmain_group_pa_questionsgrid$o<?= $Grid->RowIndex ?>_appraisal_id" value="<?= HtmlEncode($Grid->appraisal_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->business_unit->Visible) { // business_unit ?>
        <td data-name="business_unit"<?= $Grid->business_unit->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_business_unit" class="el_main_group_pa_questions_business_unit">
<?php $Grid->business_unit->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x<?= $Grid->RowIndex ?>_business_unit"
        name="x<?= $Grid->RowIndex ?>_business_unit"
        class="form-control ew-select<?= $Grid->business_unit->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_business_unit"
        data-table="main_group_pa_questions"
        data-field="x_business_unit"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->business_unit->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->business_unit->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->business_unit->getPlaceHolder()) ?>"
        <?= $Grid->business_unit->editAttributes() ?>>
        <?= $Grid->business_unit->selectOptionListHtml("x{$Grid->RowIndex}_business_unit") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->business_unit->getErrorMessage() ?></div>
<?= $Grid->business_unit->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_business_unit") ?>
<script>
loadjs.ready("fmain_group_pa_questionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_business_unit", selectId: "fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_business_unit" };
    if (fmain_group_pa_questionsgrid.lists.business_unit.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_business_unit", form: "fmain_group_pa_questionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_business_unit", form: "fmain_group_pa_questionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.business_unit.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_business_unit" data-hidden="1" name="o<?= $Grid->RowIndex ?>_business_unit" id="o<?= $Grid->RowIndex ?>_business_unit" value="<?= HtmlEncode($Grid->business_unit->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_business_unit" class="el_main_group_pa_questions_business_unit">
<?php $Grid->business_unit->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x<?= $Grid->RowIndex ?>_business_unit"
        name="x<?= $Grid->RowIndex ?>_business_unit"
        class="form-control ew-select<?= $Grid->business_unit->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_business_unit"
        data-table="main_group_pa_questions"
        data-field="x_business_unit"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->business_unit->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->business_unit->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->business_unit->getPlaceHolder()) ?>"
        <?= $Grid->business_unit->editAttributes() ?>>
        <?= $Grid->business_unit->selectOptionListHtml("x{$Grid->RowIndex}_business_unit") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->business_unit->getErrorMessage() ?></div>
<?= $Grid->business_unit->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_business_unit") ?>
<script>
loadjs.ready("fmain_group_pa_questionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_business_unit", selectId: "fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_business_unit" };
    if (fmain_group_pa_questionsgrid.lists.business_unit.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_business_unit", form: "fmain_group_pa_questionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_business_unit", form: "fmain_group_pa_questionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.business_unit.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_business_unit" class="el_main_group_pa_questions_business_unit">
<span<?= $Grid->business_unit->viewAttributes() ?>>
<?= $Grid->business_unit->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_business_unit" data-hidden="1" name="fmain_group_pa_questionsgrid$x<?= $Grid->RowIndex ?>_business_unit" id="fmain_group_pa_questionsgrid$x<?= $Grid->RowIndex ?>_business_unit" value="<?= HtmlEncode($Grid->business_unit->FormValue) ?>">
<input type="hidden" data-table="main_group_pa_questions" data-field="x_business_unit" data-hidden="1" name="fmain_group_pa_questionsgrid$o<?= $Grid->RowIndex ?>_business_unit" id="fmain_group_pa_questionsgrid$o<?= $Grid->RowIndex ?>_business_unit" value="<?= HtmlEncode($Grid->business_unit->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->group->Visible) { // group ?>
        <td data-name="group"<?= $Grid->group->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_group" class="el_main_group_pa_questions_group">
    <select
        id="x<?= $Grid->RowIndex ?>_group"
        name="x<?= $Grid->RowIndex ?>_group"
        class="form-control ew-select<?= $Grid->group->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_group"
        data-table="main_group_pa_questions"
        data-field="x_group"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->group->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->group->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->group->getPlaceHolder()) ?>"
        <?= $Grid->group->editAttributes() ?>>
        <?= $Grid->group->selectOptionListHtml("x{$Grid->RowIndex}_group") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->group->getErrorMessage() ?></div>
<?= $Grid->group->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_group") ?>
<script>
loadjs.ready("fmain_group_pa_questionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_group", selectId: "fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_group" };
    if (fmain_group_pa_questionsgrid.lists.group.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_group", form: "fmain_group_pa_questionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_group", form: "fmain_group_pa_questionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.group.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_group" data-hidden="1" name="o<?= $Grid->RowIndex ?>_group" id="o<?= $Grid->RowIndex ?>_group" value="<?= HtmlEncode($Grid->group->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_group" class="el_main_group_pa_questions_group">
    <select
        id="x<?= $Grid->RowIndex ?>_group"
        name="x<?= $Grid->RowIndex ?>_group"
        class="form-control ew-select<?= $Grid->group->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_group"
        data-table="main_group_pa_questions"
        data-field="x_group"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->group->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->group->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->group->getPlaceHolder()) ?>"
        <?= $Grid->group->editAttributes() ?>>
        <?= $Grid->group->selectOptionListHtml("x{$Grid->RowIndex}_group") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->group->getErrorMessage() ?></div>
<?= $Grid->group->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_group") ?>
<script>
loadjs.ready("fmain_group_pa_questionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_group", selectId: "fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_group" };
    if (fmain_group_pa_questionsgrid.lists.group.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_group", form: "fmain_group_pa_questionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_group", form: "fmain_group_pa_questionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.group.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_group" class="el_main_group_pa_questions_group">
<span<?= $Grid->group->viewAttributes() ?>>
<?= $Grid->group->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_group" data-hidden="1" name="fmain_group_pa_questionsgrid$x<?= $Grid->RowIndex ?>_group" id="fmain_group_pa_questionsgrid$x<?= $Grid->RowIndex ?>_group" value="<?= HtmlEncode($Grid->group->FormValue) ?>">
<input type="hidden" data-table="main_group_pa_questions" data-field="x_group" data-hidden="1" name="fmain_group_pa_questionsgrid$o<?= $Grid->RowIndex ?>_group" id="fmain_group_pa_questionsgrid$o<?= $Grid->RowIndex ?>_group" value="<?= HtmlEncode($Grid->group->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->question->Visible) { // question ?>
        <td data-name="question"<?= $Grid->question->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->question->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_question" class="el_main_group_pa_questions_question">
<span<?= $Grid->question->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->question->getDisplayValue($Grid->question->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_question" name="x<?= $Grid->RowIndex ?>_question" value="<?= HtmlEncode($Grid->question->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_question" class="el_main_group_pa_questions_question">
<div class="input-group flex-nowrap">
    <select
        id="x<?= $Grid->RowIndex ?>_question"
        name="x<?= $Grid->RowIndex ?>_question"
        class="form-control ew-select<?= $Grid->question->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_question"
        data-table="main_group_pa_questions"
        data-field="x_question"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->question->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->question->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->question->getPlaceHolder()) ?>"
        <?= $Grid->question->editAttributes() ?>>
        <?= $Grid->question->selectOptionListHtml("x{$Grid->RowIndex}_question") ?>
    </select>
    <?php if (AllowAdd(CurrentProjectID() . "main_pa_questions") && !$Grid->question->ReadOnly) { ?>
    <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Grid->RowIndex ?>_question" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Grid->question->caption() ?>" data-title="<?= $Grid->question->caption() ?>" data-ew-action="add-option" data-el="x<?= $Grid->RowIndex ?>_question" data-url="<?= GetUrl("mainpaquestionsaddopt") ?>"><i class="fas fa-plus ew-icon"></i></button>
    <?php } ?>
</div>
<div class="invalid-feedback"><?= $Grid->question->getErrorMessage() ?></div>
<?= $Grid->question->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_question") ?>
<script>
loadjs.ready("fmain_group_pa_questionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_question", selectId: "fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_question" };
    if (fmain_group_pa_questionsgrid.lists.question.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_question", form: "fmain_group_pa_questionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_question", form: "fmain_group_pa_questionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.question.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_question" data-hidden="1" name="o<?= $Grid->RowIndex ?>_question" id="o<?= $Grid->RowIndex ?>_question" value="<?= HtmlEncode($Grid->question->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->question->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_question" class="el_main_group_pa_questions_question">
<span<?= $Grid->question->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->question->getDisplayValue($Grid->question->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_question" name="x<?= $Grid->RowIndex ?>_question" value="<?= HtmlEncode($Grid->question->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_question" class="el_main_group_pa_questions_question">
<div class="input-group flex-nowrap">
    <select
        id="x<?= $Grid->RowIndex ?>_question"
        name="x<?= $Grid->RowIndex ?>_question"
        class="form-control ew-select<?= $Grid->question->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_question"
        data-table="main_group_pa_questions"
        data-field="x_question"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->question->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->question->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->question->getPlaceHolder()) ?>"
        <?= $Grid->question->editAttributes() ?>>
        <?= $Grid->question->selectOptionListHtml("x{$Grid->RowIndex}_question") ?>
    </select>
    <?php if (AllowAdd(CurrentProjectID() . "main_pa_questions") && !$Grid->question->ReadOnly) { ?>
    <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Grid->RowIndex ?>_question" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Grid->question->caption() ?>" data-title="<?= $Grid->question->caption() ?>" data-ew-action="add-option" data-el="x<?= $Grid->RowIndex ?>_question" data-url="<?= GetUrl("mainpaquestionsaddopt") ?>"><i class="fas fa-plus ew-icon"></i></button>
    <?php } ?>
</div>
<div class="invalid-feedback"><?= $Grid->question->getErrorMessage() ?></div>
<?= $Grid->question->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_question") ?>
<script>
loadjs.ready("fmain_group_pa_questionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_question", selectId: "fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_question" };
    if (fmain_group_pa_questionsgrid.lists.question.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_question", form: "fmain_group_pa_questionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_question", form: "fmain_group_pa_questionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.question.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_group_pa_questions_question" class="el_main_group_pa_questions_question">
<span<?= $Grid->question->viewAttributes() ?>>
<?= $Grid->question->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_question" data-hidden="1" name="fmain_group_pa_questionsgrid$x<?= $Grid->RowIndex ?>_question" id="fmain_group_pa_questionsgrid$x<?= $Grid->RowIndex ?>_question" value="<?= HtmlEncode($Grid->question->FormValue) ?>">
<input type="hidden" data-table="main_group_pa_questions" data-field="x_question" data-hidden="1" name="fmain_group_pa_questionsgrid$o<?= $Grid->RowIndex ?>_question" id="fmain_group_pa_questionsgrid$o<?= $Grid->RowIndex ?>_question" value="<?= HtmlEncode($Grid->question->OldValue) ?>">
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
loadjs.ready(["fmain_group_pa_questionsgrid","load"], () => fmain_group_pa_questionsgrid.updateLists(<?= $Grid->RowIndex ?>));
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
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_main_group_pa_questions", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_main_group_pa_questions_id" class="el_main_group_pa_questions_id"></span>
<?php } else { ?>
<span id="el$rowindex$_main_group_pa_questions_id" class="el_main_group_pa_questions_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->appraisal_id->Visible) { // appraisal_id ?>
        <td data-name="appraisal_id">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->appraisal_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_main_group_pa_questions_appraisal_id" class="el_main_group_pa_questions_appraisal_id">
<span<?= $Grid->appraisal_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->appraisal_id->getDisplayValue($Grid->appraisal_id->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_appraisal_id" name="x<?= $Grid->RowIndex ?>_appraisal_id" value="<?= HtmlEncode($Grid->appraisal_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_main_group_pa_questions_appraisal_id" class="el_main_group_pa_questions_appraisal_id">
    <select
        id="x<?= $Grid->RowIndex ?>_appraisal_id"
        name="x<?= $Grid->RowIndex ?>_appraisal_id"
        class="form-control ew-select<?= $Grid->appraisal_id->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_appraisal_id"
        data-table="main_group_pa_questions"
        data-field="x_appraisal_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->appraisal_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->appraisal_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->appraisal_id->getPlaceHolder()) ?>"
        <?= $Grid->appraisal_id->editAttributes() ?>>
        <?= $Grid->appraisal_id->selectOptionListHtml("x{$Grid->RowIndex}_appraisal_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->appraisal_id->getErrorMessage() ?></div>
<?= $Grid->appraisal_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_appraisal_id") ?>
<script>
loadjs.ready("fmain_group_pa_questionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_appraisal_id", selectId: "fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_appraisal_id" };
    if (fmain_group_pa_questionsgrid.lists.appraisal_id.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_appraisal_id", form: "fmain_group_pa_questionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_appraisal_id", form: "fmain_group_pa_questionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.appraisal_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_main_group_pa_questions_appraisal_id" class="el_main_group_pa_questions_appraisal_id">
<span<?= $Grid->appraisal_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->appraisal_id->getDisplayValue($Grid->appraisal_id->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_appraisal_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_appraisal_id" id="x<?= $Grid->RowIndex ?>_appraisal_id" value="<?= HtmlEncode($Grid->appraisal_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_appraisal_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_appraisal_id" id="o<?= $Grid->RowIndex ?>_appraisal_id" value="<?= HtmlEncode($Grid->appraisal_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->business_unit->Visible) { // business_unit ?>
        <td data-name="business_unit">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_main_group_pa_questions_business_unit" class="el_main_group_pa_questions_business_unit">
<?php $Grid->business_unit->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x<?= $Grid->RowIndex ?>_business_unit"
        name="x<?= $Grid->RowIndex ?>_business_unit"
        class="form-control ew-select<?= $Grid->business_unit->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_business_unit"
        data-table="main_group_pa_questions"
        data-field="x_business_unit"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->business_unit->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->business_unit->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->business_unit->getPlaceHolder()) ?>"
        <?= $Grid->business_unit->editAttributes() ?>>
        <?= $Grid->business_unit->selectOptionListHtml("x{$Grid->RowIndex}_business_unit") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->business_unit->getErrorMessage() ?></div>
<?= $Grid->business_unit->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_business_unit") ?>
<script>
loadjs.ready("fmain_group_pa_questionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_business_unit", selectId: "fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_business_unit" };
    if (fmain_group_pa_questionsgrid.lists.business_unit.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_business_unit", form: "fmain_group_pa_questionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_business_unit", form: "fmain_group_pa_questionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.business_unit.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_main_group_pa_questions_business_unit" class="el_main_group_pa_questions_business_unit">
<span<?= $Grid->business_unit->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->business_unit->getDisplayValue($Grid->business_unit->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_business_unit" data-hidden="1" name="x<?= $Grid->RowIndex ?>_business_unit" id="x<?= $Grid->RowIndex ?>_business_unit" value="<?= HtmlEncode($Grid->business_unit->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_business_unit" data-hidden="1" name="o<?= $Grid->RowIndex ?>_business_unit" id="o<?= $Grid->RowIndex ?>_business_unit" value="<?= HtmlEncode($Grid->business_unit->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->group->Visible) { // group ?>
        <td data-name="group">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_main_group_pa_questions_group" class="el_main_group_pa_questions_group">
    <select
        id="x<?= $Grid->RowIndex ?>_group"
        name="x<?= $Grid->RowIndex ?>_group"
        class="form-control ew-select<?= $Grid->group->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_group"
        data-table="main_group_pa_questions"
        data-field="x_group"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->group->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->group->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->group->getPlaceHolder()) ?>"
        <?= $Grid->group->editAttributes() ?>>
        <?= $Grid->group->selectOptionListHtml("x{$Grid->RowIndex}_group") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->group->getErrorMessage() ?></div>
<?= $Grid->group->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_group") ?>
<script>
loadjs.ready("fmain_group_pa_questionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_group", selectId: "fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_group" };
    if (fmain_group_pa_questionsgrid.lists.group.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_group", form: "fmain_group_pa_questionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_group", form: "fmain_group_pa_questionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.group.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_main_group_pa_questions_group" class="el_main_group_pa_questions_group">
<span<?= $Grid->group->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->group->getDisplayValue($Grid->group->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_group" data-hidden="1" name="x<?= $Grid->RowIndex ?>_group" id="x<?= $Grid->RowIndex ?>_group" value="<?= HtmlEncode($Grid->group->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_group" data-hidden="1" name="o<?= $Grid->RowIndex ?>_group" id="o<?= $Grid->RowIndex ?>_group" value="<?= HtmlEncode($Grid->group->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->question->Visible) { // question ?>
        <td data-name="question">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->question->getSessionValue() != "") { ?>
<span id="el$rowindex$_main_group_pa_questions_question" class="el_main_group_pa_questions_question">
<span<?= $Grid->question->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->question->getDisplayValue($Grid->question->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_question" name="x<?= $Grid->RowIndex ?>_question" value="<?= HtmlEncode($Grid->question->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_main_group_pa_questions_question" class="el_main_group_pa_questions_question">
<div class="input-group flex-nowrap">
    <select
        id="x<?= $Grid->RowIndex ?>_question"
        name="x<?= $Grid->RowIndex ?>_question"
        class="form-control ew-select<?= $Grid->question->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_question"
        data-table="main_group_pa_questions"
        data-field="x_question"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->question->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->question->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->question->getPlaceHolder()) ?>"
        <?= $Grid->question->editAttributes() ?>>
        <?= $Grid->question->selectOptionListHtml("x{$Grid->RowIndex}_question") ?>
    </select>
    <?php if (AllowAdd(CurrentProjectID() . "main_pa_questions") && !$Grid->question->ReadOnly) { ?>
    <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Grid->RowIndex ?>_question" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Grid->question->caption() ?>" data-title="<?= $Grid->question->caption() ?>" data-ew-action="add-option" data-el="x<?= $Grid->RowIndex ?>_question" data-url="<?= GetUrl("mainpaquestionsaddopt") ?>"><i class="fas fa-plus ew-icon"></i></button>
    <?php } ?>
</div>
<div class="invalid-feedback"><?= $Grid->question->getErrorMessage() ?></div>
<?= $Grid->question->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_question") ?>
<script>
loadjs.ready("fmain_group_pa_questionsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_question", selectId: "fmain_group_pa_questionsgrid_x<?= $Grid->RowIndex ?>_question" };
    if (fmain_group_pa_questionsgrid.lists.question.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_question", form: "fmain_group_pa_questionsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_question", form: "fmain_group_pa_questionsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.question.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_main_group_pa_questions_question" class="el_main_group_pa_questions_question">
<span<?= $Grid->question->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->question->getDisplayValue($Grid->question->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_question" data-hidden="1" name="x<?= $Grid->RowIndex ?>_question" id="x<?= $Grid->RowIndex ?>_question" value="<?= HtmlEncode($Grid->question->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_question" data-hidden="1" name="o<?= $Grid->RowIndex ?>_question" id="o<?= $Grid->RowIndex ?>_question" value="<?= HtmlEncode($Grid->question->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fmain_group_pa_questionsgrid","load"], () => fmain_group_pa_questionsgrid.updateLists(<?= $Grid->RowIndex ?>, true));
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
<input type="hidden" name="detailpage" value="fmain_group_pa_questionsgrid">
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
    ew.addEventHandlers("main_group_pa_questions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Startup script
    // Write your table-specific startup script here, no need to add script tags.
    let searchParams = new URLSearchParams(window.location.search);
    if(searchParams.has('action')){
    	let param = searchParams.get('action');
    	//if(param==="gridadd"){
    		$("body").find("[data-name='appraisal_id']").hide();
    		$("body").find("[data-name='business_unit']").hide();
    		$("body").find("[data-name='group']").hide();
    	//}
    }
});
</script>
<?php } ?>
