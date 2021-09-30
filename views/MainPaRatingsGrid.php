<?php

namespace PHPMaker2022\wfg_appraisal;

// Set up and run Grid object
$Grid = Container("MainPaRatingsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fmain_pa_ratingsgrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_ratingsgrid = new ew.Form("fmain_pa_ratingsgrid", "grid");
    fmain_pa_ratingsgrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { main_pa_ratings: currentTable } });
    var fields = currentTable.fields;
    fmain_pa_ratingsgrid.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["rating_type", [fields.rating_type.visible && fields.rating_type.required ? ew.Validators.required(fields.rating_type.caption) : null], fields.rating_type.isInvalid],
        ["rating_value", [fields.rating_value.visible && fields.rating_value.required ? ew.Validators.required(fields.rating_value.caption) : null, ew.Validators.integer], fields.rating_value.isInvalid],
        ["rating_text", [fields.rating_text.visible && fields.rating_text.required ? ew.Validators.required(fields.rating_text.caption) : null], fields.rating_text.isInvalid],
        ["rating_description", [fields.rating_description.visible && fields.rating_description.required ? ew.Validators.required(fields.rating_description.caption) : null], fields.rating_description.isInvalid],
        ["createddate", [fields.createddate.visible && fields.createddate.required ? ew.Validators.required(fields.createddate.caption) : null], fields.createddate.isInvalid],
        ["modifieddate", [fields.modifieddate.visible && fields.modifieddate.required ? ew.Validators.required(fields.modifieddate.caption) : null], fields.modifieddate.isInvalid]
    ]);

    // Check empty row
    fmain_pa_ratingsgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["rating_type",false],["rating_value",false],["rating_text",false],["rating_description",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fmain_pa_ratingsgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_ratingsgrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_ratingsgrid.lists.rating_type = <?= $Grid->rating_type->toClientList($Grid) ?>;
    loadjs.done("fmain_pa_ratingsgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> main_pa_ratings">
<div id="fmain_pa_ratingsgrid" class="ew-form ew-list-form">
<div id="gmp_main_pa_ratings" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_main_pa_ratingsgrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_main_pa_ratings_id" class="main_pa_ratings_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->rating_type->Visible) { // rating_type ?>
        <th data-name="rating_type" class="<?= $Grid->rating_type->headerCellClass() ?>"><div id="elh_main_pa_ratings_rating_type" class="main_pa_ratings_rating_type"><?= $Grid->renderFieldHeader($Grid->rating_type) ?></div></th>
<?php } ?>
<?php if ($Grid->rating_value->Visible) { // rating_value ?>
        <th data-name="rating_value" class="<?= $Grid->rating_value->headerCellClass() ?>"><div id="elh_main_pa_ratings_rating_value" class="main_pa_ratings_rating_value"><?= $Grid->renderFieldHeader($Grid->rating_value) ?></div></th>
<?php } ?>
<?php if ($Grid->rating_text->Visible) { // rating_text ?>
        <th data-name="rating_text" class="<?= $Grid->rating_text->headerCellClass() ?>"><div id="elh_main_pa_ratings_rating_text" class="main_pa_ratings_rating_text"><?= $Grid->renderFieldHeader($Grid->rating_text) ?></div></th>
<?php } ?>
<?php if ($Grid->rating_description->Visible) { // rating_description ?>
        <th data-name="rating_description" class="<?= $Grid->rating_description->headerCellClass() ?>"><div id="elh_main_pa_ratings_rating_description" class="main_pa_ratings_rating_description"><?= $Grid->renderFieldHeader($Grid->rating_description) ?></div></th>
<?php } ?>
<?php if ($Grid->createddate->Visible) { // createddate ?>
        <th data-name="createddate" class="<?= $Grid->createddate->headerCellClass() ?>"><div id="elh_main_pa_ratings_createddate" class="main_pa_ratings_createddate"><?= $Grid->renderFieldHeader($Grid->createddate) ?></div></th>
<?php } ?>
<?php if ($Grid->modifieddate->Visible) { // modifieddate ?>
        <th data-name="modifieddate" class="<?= $Grid->modifieddate->headerCellClass() ?>"><div id="elh_main_pa_ratings_modifieddate" class="main_pa_ratings_modifieddate"><?= $Grid->renderFieldHeader($Grid->modifieddate) ?></div></th>
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
            "id" => "r" . $Grid->RowCount . "_main_pa_ratings",
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
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_id" class="el_main_pa_ratings_id"></span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_id" class="el_main_pa_ratings_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_id" class="el_main_pa_ratings_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_id" data-hidden="1" name="fmain_pa_ratingsgrid$x<?= $Grid->RowIndex ?>_id" id="fmain_pa_ratingsgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="main_pa_ratings" data-field="x_id" data-hidden="1" name="fmain_pa_ratingsgrid$o<?= $Grid->RowIndex ?>_id" id="fmain_pa_ratingsgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="main_pa_ratings" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->rating_type->Visible) { // rating_type ?>
        <td data-name="rating_type"<?= $Grid->rating_type->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->rating_type->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_rating_type" class="el_main_pa_ratings_rating_type">
<span<?= $Grid->rating_type->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->rating_type->getDisplayValue($Grid->rating_type->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_rating_type" name="x<?= $Grid->RowIndex ?>_rating_type" value="<?= HtmlEncode($Grid->rating_type->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_rating_type" class="el_main_pa_ratings_rating_type">
    <select
        id="x<?= $Grid->RowIndex ?>_rating_type"
        name="x<?= $Grid->RowIndex ?>_rating_type"
        class="form-select ew-select<?= $Grid->rating_type->isInvalidClass() ?>"
        data-select2-id="fmain_pa_ratingsgrid_x<?= $Grid->RowIndex ?>_rating_type"
        data-table="main_pa_ratings"
        data-field="x_rating_type"
        data-value-separator="<?= $Grid->rating_type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->rating_type->getPlaceHolder()) ?>"
        <?= $Grid->rating_type->editAttributes() ?>>
        <?= $Grid->rating_type->selectOptionListHtml("x{$Grid->RowIndex}_rating_type") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->rating_type->getErrorMessage() ?></div>
<?= $Grid->rating_type->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_rating_type") ?>
<script>
loadjs.ready("fmain_pa_ratingsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_rating_type", selectId: "fmain_pa_ratingsgrid_x<?= $Grid->RowIndex ?>_rating_type" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_ratingsgrid.lists.rating_type.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_rating_type", form: "fmain_pa_ratingsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_rating_type", form: "fmain_pa_ratingsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_ratings.fields.rating_type.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_type" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rating_type" id="o<?= $Grid->RowIndex ?>_rating_type" value="<?= HtmlEncode($Grid->rating_type->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->rating_type->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_rating_type" class="el_main_pa_ratings_rating_type">
<span<?= $Grid->rating_type->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->rating_type->getDisplayValue($Grid->rating_type->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_rating_type" name="x<?= $Grid->RowIndex ?>_rating_type" value="<?= HtmlEncode($Grid->rating_type->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_rating_type" class="el_main_pa_ratings_rating_type">
    <select
        id="x<?= $Grid->RowIndex ?>_rating_type"
        name="x<?= $Grid->RowIndex ?>_rating_type"
        class="form-select ew-select<?= $Grid->rating_type->isInvalidClass() ?>"
        data-select2-id="fmain_pa_ratingsgrid_x<?= $Grid->RowIndex ?>_rating_type"
        data-table="main_pa_ratings"
        data-field="x_rating_type"
        data-value-separator="<?= $Grid->rating_type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->rating_type->getPlaceHolder()) ?>"
        <?= $Grid->rating_type->editAttributes() ?>>
        <?= $Grid->rating_type->selectOptionListHtml("x{$Grid->RowIndex}_rating_type") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->rating_type->getErrorMessage() ?></div>
<?= $Grid->rating_type->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_rating_type") ?>
<script>
loadjs.ready("fmain_pa_ratingsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_rating_type", selectId: "fmain_pa_ratingsgrid_x<?= $Grid->RowIndex ?>_rating_type" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_ratingsgrid.lists.rating_type.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_rating_type", form: "fmain_pa_ratingsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_rating_type", form: "fmain_pa_ratingsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_ratings.fields.rating_type.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_rating_type" class="el_main_pa_ratings_rating_type">
<span<?= $Grid->rating_type->viewAttributes() ?>>
<?= $Grid->rating_type->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_type" data-hidden="1" name="fmain_pa_ratingsgrid$x<?= $Grid->RowIndex ?>_rating_type" id="fmain_pa_ratingsgrid$x<?= $Grid->RowIndex ?>_rating_type" value="<?= HtmlEncode($Grid->rating_type->FormValue) ?>">
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_type" data-hidden="1" name="fmain_pa_ratingsgrid$o<?= $Grid->RowIndex ?>_rating_type" id="fmain_pa_ratingsgrid$o<?= $Grid->RowIndex ?>_rating_type" value="<?= HtmlEncode($Grid->rating_type->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rating_value->Visible) { // rating_value ?>
        <td data-name="rating_value"<?= $Grid->rating_value->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_rating_value" class="el_main_pa_ratings_rating_value">
<input type="<?= $Grid->rating_value->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_rating_value" id="x<?= $Grid->RowIndex ?>_rating_value" data-table="main_pa_ratings" data-field="x_rating_value" value="<?= $Grid->rating_value->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->rating_value->getPlaceHolder()) ?>"<?= $Grid->rating_value->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rating_value->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_value" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rating_value" id="o<?= $Grid->RowIndex ?>_rating_value" value="<?= HtmlEncode($Grid->rating_value->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_rating_value" class="el_main_pa_ratings_rating_value">
<input type="<?= $Grid->rating_value->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_rating_value" id="x<?= $Grid->RowIndex ?>_rating_value" data-table="main_pa_ratings" data-field="x_rating_value" value="<?= $Grid->rating_value->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->rating_value->getPlaceHolder()) ?>"<?= $Grid->rating_value->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rating_value->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_rating_value" class="el_main_pa_ratings_rating_value">
<span<?= $Grid->rating_value->viewAttributes() ?>>
<?= $Grid->rating_value->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_value" data-hidden="1" name="fmain_pa_ratingsgrid$x<?= $Grid->RowIndex ?>_rating_value" id="fmain_pa_ratingsgrid$x<?= $Grid->RowIndex ?>_rating_value" value="<?= HtmlEncode($Grid->rating_value->FormValue) ?>">
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_value" data-hidden="1" name="fmain_pa_ratingsgrid$o<?= $Grid->RowIndex ?>_rating_value" id="fmain_pa_ratingsgrid$o<?= $Grid->RowIndex ?>_rating_value" value="<?= HtmlEncode($Grid->rating_value->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rating_text->Visible) { // rating_text ?>
        <td data-name="rating_text"<?= $Grid->rating_text->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_rating_text" class="el_main_pa_ratings_rating_text">
<textarea data-table="main_pa_ratings" data-field="x_rating_text" name="x<?= $Grid->RowIndex ?>_rating_text" id="x<?= $Grid->RowIndex ?>_rating_text" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->rating_text->getPlaceHolder()) ?>"<?= $Grid->rating_text->editAttributes() ?>><?= $Grid->rating_text->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->rating_text->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_text" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rating_text" id="o<?= $Grid->RowIndex ?>_rating_text" value="<?= HtmlEncode($Grid->rating_text->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_rating_text" class="el_main_pa_ratings_rating_text">
<textarea data-table="main_pa_ratings" data-field="x_rating_text" name="x<?= $Grid->RowIndex ?>_rating_text" id="x<?= $Grid->RowIndex ?>_rating_text" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->rating_text->getPlaceHolder()) ?>"<?= $Grid->rating_text->editAttributes() ?>><?= $Grid->rating_text->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->rating_text->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_rating_text" class="el_main_pa_ratings_rating_text">
<span<?= $Grid->rating_text->viewAttributes() ?>>
<?= $Grid->rating_text->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_text" data-hidden="1" name="fmain_pa_ratingsgrid$x<?= $Grid->RowIndex ?>_rating_text" id="fmain_pa_ratingsgrid$x<?= $Grid->RowIndex ?>_rating_text" value="<?= HtmlEncode($Grid->rating_text->FormValue) ?>">
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_text" data-hidden="1" name="fmain_pa_ratingsgrid$o<?= $Grid->RowIndex ?>_rating_text" id="fmain_pa_ratingsgrid$o<?= $Grid->RowIndex ?>_rating_text" value="<?= HtmlEncode($Grid->rating_text->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->rating_description->Visible) { // rating_description ?>
        <td data-name="rating_description"<?= $Grid->rating_description->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_rating_description" class="el_main_pa_ratings_rating_description">
<?php $Grid->rating_description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="main_pa_ratings" data-field="x_rating_description" name="x<?= $Grid->RowIndex ?>_rating_description" id="x<?= $Grid->RowIndex ?>_rating_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->rating_description->getPlaceHolder()) ?>"<?= $Grid->rating_description->editAttributes() ?>><?= $Grid->rating_description->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->rating_description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fmain_pa_ratingsgrid", "editor"], function() {
	ew.createEditor("fmain_pa_ratingsgrid", "x<?= $Grid->RowIndex ?>_rating_description", 35, 4, <?= $Grid->rating_description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_description" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rating_description" id="o<?= $Grid->RowIndex ?>_rating_description" value="<?= HtmlEncode($Grid->rating_description->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_rating_description" class="el_main_pa_ratings_rating_description">
<?php $Grid->rating_description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="main_pa_ratings" data-field="x_rating_description" name="x<?= $Grid->RowIndex ?>_rating_description" id="x<?= $Grid->RowIndex ?>_rating_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->rating_description->getPlaceHolder()) ?>"<?= $Grid->rating_description->editAttributes() ?>><?= $Grid->rating_description->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->rating_description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fmain_pa_ratingsgrid", "editor"], function() {
	ew.createEditor("fmain_pa_ratingsgrid", "x<?= $Grid->RowIndex ?>_rating_description", 35, 4, <?= $Grid->rating_description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_rating_description" class="el_main_pa_ratings_rating_description">
<span<?= $Grid->rating_description->viewAttributes() ?>>
<?= $Grid->rating_description->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_description" data-hidden="1" name="fmain_pa_ratingsgrid$x<?= $Grid->RowIndex ?>_rating_description" id="fmain_pa_ratingsgrid$x<?= $Grid->RowIndex ?>_rating_description" value="<?= HtmlEncode($Grid->rating_description->FormValue) ?>">
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_description" data-hidden="1" name="fmain_pa_ratingsgrid$o<?= $Grid->RowIndex ?>_rating_description" id="fmain_pa_ratingsgrid$o<?= $Grid->RowIndex ?>_rating_description" value="<?= HtmlEncode($Grid->rating_description->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->createddate->Visible) { // createddate ?>
        <td data-name="createddate"<?= $Grid->createddate->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_createddate" data-hidden="1" name="o<?= $Grid->RowIndex ?>_createddate" id="o<?= $Grid->RowIndex ?>_createddate" value="<?= HtmlEncode($Grid->createddate->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_createddate" class="el_main_pa_ratings_createddate">
<span<?= $Grid->createddate->viewAttributes() ?>>
<?= $Grid->createddate->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_createddate" data-hidden="1" name="fmain_pa_ratingsgrid$x<?= $Grid->RowIndex ?>_createddate" id="fmain_pa_ratingsgrid$x<?= $Grid->RowIndex ?>_createddate" value="<?= HtmlEncode($Grid->createddate->FormValue) ?>">
<input type="hidden" data-table="main_pa_ratings" data-field="x_createddate" data-hidden="1" name="fmain_pa_ratingsgrid$o<?= $Grid->RowIndex ?>_createddate" id="fmain_pa_ratingsgrid$o<?= $Grid->RowIndex ?>_createddate" value="<?= HtmlEncode($Grid->createddate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->modifieddate->Visible) { // modifieddate ?>
        <td data-name="modifieddate"<?= $Grid->modifieddate->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_modifieddate" data-hidden="1" name="o<?= $Grid->RowIndex ?>_modifieddate" id="o<?= $Grid->RowIndex ?>_modifieddate" value="<?= HtmlEncode($Grid->modifieddate->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_main_pa_ratings_modifieddate" class="el_main_pa_ratings_modifieddate">
<span<?= $Grid->modifieddate->viewAttributes() ?>>
<?= $Grid->modifieddate->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_modifieddate" data-hidden="1" name="fmain_pa_ratingsgrid$x<?= $Grid->RowIndex ?>_modifieddate" id="fmain_pa_ratingsgrid$x<?= $Grid->RowIndex ?>_modifieddate" value="<?= HtmlEncode($Grid->modifieddate->FormValue) ?>">
<input type="hidden" data-table="main_pa_ratings" data-field="x_modifieddate" data-hidden="1" name="fmain_pa_ratingsgrid$o<?= $Grid->RowIndex ?>_modifieddate" id="fmain_pa_ratingsgrid$o<?= $Grid->RowIndex ?>_modifieddate" value="<?= HtmlEncode($Grid->modifieddate->OldValue) ?>">
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
loadjs.ready(["fmain_pa_ratingsgrid","load"], () => fmain_pa_ratingsgrid.updateLists(<?= $Grid->RowIndex ?>));
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
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_main_pa_ratings", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_main_pa_ratings_id" class="el_main_pa_ratings_id"></span>
<?php } else { ?>
<span id="el$rowindex$_main_pa_ratings_id" class="el_main_pa_ratings_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rating_type->Visible) { // rating_type ?>
        <td data-name="rating_type">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->rating_type->getSessionValue() != "") { ?>
<span id="el$rowindex$_main_pa_ratings_rating_type" class="el_main_pa_ratings_rating_type">
<span<?= $Grid->rating_type->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->rating_type->getDisplayValue($Grid->rating_type->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_rating_type" name="x<?= $Grid->RowIndex ?>_rating_type" value="<?= HtmlEncode($Grid->rating_type->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_main_pa_ratings_rating_type" class="el_main_pa_ratings_rating_type">
    <select
        id="x<?= $Grid->RowIndex ?>_rating_type"
        name="x<?= $Grid->RowIndex ?>_rating_type"
        class="form-select ew-select<?= $Grid->rating_type->isInvalidClass() ?>"
        data-select2-id="fmain_pa_ratingsgrid_x<?= $Grid->RowIndex ?>_rating_type"
        data-table="main_pa_ratings"
        data-field="x_rating_type"
        data-value-separator="<?= $Grid->rating_type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->rating_type->getPlaceHolder()) ?>"
        <?= $Grid->rating_type->editAttributes() ?>>
        <?= $Grid->rating_type->selectOptionListHtml("x{$Grid->RowIndex}_rating_type") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->rating_type->getErrorMessage() ?></div>
<?= $Grid->rating_type->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_rating_type") ?>
<script>
loadjs.ready("fmain_pa_ratingsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_rating_type", selectId: "fmain_pa_ratingsgrid_x<?= $Grid->RowIndex ?>_rating_type" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_pa_ratingsgrid.lists.rating_type.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_rating_type", form: "fmain_pa_ratingsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_rating_type", form: "fmain_pa_ratingsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_pa_ratings.fields.rating_type.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_main_pa_ratings_rating_type" class="el_main_pa_ratings_rating_type">
<span<?= $Grid->rating_type->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->rating_type->getDisplayValue($Grid->rating_type->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_type" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rating_type" id="x<?= $Grid->RowIndex ?>_rating_type" value="<?= HtmlEncode($Grid->rating_type->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_type" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rating_type" id="o<?= $Grid->RowIndex ?>_rating_type" value="<?= HtmlEncode($Grid->rating_type->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rating_value->Visible) { // rating_value ?>
        <td data-name="rating_value">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_main_pa_ratings_rating_value" class="el_main_pa_ratings_rating_value">
<input type="<?= $Grid->rating_value->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_rating_value" id="x<?= $Grid->RowIndex ?>_rating_value" data-table="main_pa_ratings" data-field="x_rating_value" value="<?= $Grid->rating_value->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->rating_value->getPlaceHolder()) ?>"<?= $Grid->rating_value->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->rating_value->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_main_pa_ratings_rating_value" class="el_main_pa_ratings_rating_value">
<span<?= $Grid->rating_value->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rating_value->getDisplayValue($Grid->rating_value->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_value" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rating_value" id="x<?= $Grid->RowIndex ?>_rating_value" value="<?= HtmlEncode($Grid->rating_value->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_value" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rating_value" id="o<?= $Grid->RowIndex ?>_rating_value" value="<?= HtmlEncode($Grid->rating_value->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rating_text->Visible) { // rating_text ?>
        <td data-name="rating_text">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_main_pa_ratings_rating_text" class="el_main_pa_ratings_rating_text">
<textarea data-table="main_pa_ratings" data-field="x_rating_text" name="x<?= $Grid->RowIndex ?>_rating_text" id="x<?= $Grid->RowIndex ?>_rating_text" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->rating_text->getPlaceHolder()) ?>"<?= $Grid->rating_text->editAttributes() ?>><?= $Grid->rating_text->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->rating_text->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_main_pa_ratings_rating_text" class="el_main_pa_ratings_rating_text">
<span<?= $Grid->rating_text->viewAttributes() ?>>
<?= $Grid->rating_text->ViewValue ?></span>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_text" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rating_text" id="x<?= $Grid->RowIndex ?>_rating_text" value="<?= HtmlEncode($Grid->rating_text->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_text" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rating_text" id="o<?= $Grid->RowIndex ?>_rating_text" value="<?= HtmlEncode($Grid->rating_text->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->rating_description->Visible) { // rating_description ?>
        <td data-name="rating_description">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_main_pa_ratings_rating_description" class="el_main_pa_ratings_rating_description">
<?php $Grid->rating_description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="main_pa_ratings" data-field="x_rating_description" name="x<?= $Grid->RowIndex ?>_rating_description" id="x<?= $Grid->RowIndex ?>_rating_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->rating_description->getPlaceHolder()) ?>"<?= $Grid->rating_description->editAttributes() ?>><?= $Grid->rating_description->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->rating_description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fmain_pa_ratingsgrid", "editor"], function() {
	ew.createEditor("fmain_pa_ratingsgrid", "x<?= $Grid->RowIndex ?>_rating_description", 35, 4, <?= $Grid->rating_description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_main_pa_ratings_rating_description" class="el_main_pa_ratings_rating_description">
<span<?= $Grid->rating_description->viewAttributes() ?>>
<?= $Grid->rating_description->ViewValue ?></span>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_description" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rating_description" id="x<?= $Grid->RowIndex ?>_rating_description" value="<?= HtmlEncode($Grid->rating_description->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_rating_description" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rating_description" id="o<?= $Grid->RowIndex ?>_rating_description" value="<?= HtmlEncode($Grid->rating_description->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->createddate->Visible) { // createddate ?>
        <td data-name="createddate">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_main_pa_ratings_createddate" class="el_main_pa_ratings_createddate">
<span<?= $Grid->createddate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->createddate->getDisplayValue($Grid->createddate->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_createddate" data-hidden="1" name="x<?= $Grid->RowIndex ?>_createddate" id="x<?= $Grid->RowIndex ?>_createddate" value="<?= HtmlEncode($Grid->createddate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_createddate" data-hidden="1" name="o<?= $Grid->RowIndex ?>_createddate" id="o<?= $Grid->RowIndex ?>_createddate" value="<?= HtmlEncode($Grid->createddate->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->modifieddate->Visible) { // modifieddate ?>
        <td data-name="modifieddate">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_main_pa_ratings_modifieddate" class="el_main_pa_ratings_modifieddate">
<span<?= $Grid->modifieddate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->modifieddate->getDisplayValue($Grid->modifieddate->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_pa_ratings" data-field="x_modifieddate" data-hidden="1" name="x<?= $Grid->RowIndex ?>_modifieddate" id="x<?= $Grid->RowIndex ?>_modifieddate" value="<?= HtmlEncode($Grid->modifieddate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="main_pa_ratings" data-field="x_modifieddate" data-hidden="1" name="o<?= $Grid->RowIndex ?>_modifieddate" id="o<?= $Grid->RowIndex ?>_modifieddate" value="<?= HtmlEncode($Grid->modifieddate->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fmain_pa_ratingsgrid","load"], () => fmain_pa_ratingsgrid.updateLists(<?= $Grid->RowIndex ?>, true));
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
<input type="hidden" name="detailpage" value="fmain_pa_ratingsgrid">
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
    ew.addEventHandlers("main_pa_ratings");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
