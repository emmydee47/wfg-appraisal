<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainGroupPaQuestionsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_group_pa_questions: currentTable } });
var currentForm, currentPageID;
var fmain_group_pa_questionslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_group_pa_questionslist = new ew.Form("fmain_group_pa_questionslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fmain_group_pa_questionslist;
    fmain_group_pa_questionslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Add fields
    var fields = currentTable.fields;
    fmain_group_pa_questionslist.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["appraisal_id", [fields.appraisal_id.visible && fields.appraisal_id.required ? ew.Validators.required(fields.appraisal_id.caption) : null], fields.appraisal_id.isInvalid],
        ["business_unit", [fields.business_unit.visible && fields.business_unit.required ? ew.Validators.required(fields.business_unit.caption) : null], fields.business_unit.isInvalid],
        ["group", [fields.group.visible && fields.group.required ? ew.Validators.required(fields.group.caption) : null], fields.group.isInvalid],
        ["question", [fields.question.visible && fields.question.required ? ew.Validators.required(fields.question.caption) : null], fields.question.isInvalid]
    ]);

    // Check empty row
    fmain_group_pa_questionslist.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["appraisal_id",false],["business_unit",false],["group",false],["question",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fmain_group_pa_questionslist.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_group_pa_questionslist.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_group_pa_questionslist.lists.appraisal_id = <?= $Page->appraisal_id->toClientList($Page) ?>;
    fmain_group_pa_questionslist.lists.business_unit = <?= $Page->business_unit->toClientList($Page) ?>;
    fmain_group_pa_questionslist.lists.group = <?= $Page->group->toClientList($Page) ?>;
    fmain_group_pa_questionslist.lists.question = <?= $Page->question->toClientList($Page) ?>;
    loadjs.done("fmain_group_pa_questionslist");
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
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "main_pa_initialization") {
    if ($Page->MasterRecordExists) {
        include_once "views/MainPaInitializationMaster.php";
    }
}
?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "main_pa_questions") {
    if ($Page->MasterRecordExists) {
        include_once "views/MainPaQuestionsMaster.php";
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> main_group_pa_questions">
<form name="fmain_group_pa_questionslist" id="fmain_group_pa_questionslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_group_pa_questions">
<?php if ($Page->getCurrentMasterTable() == "main_pa_initialization" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="main_pa_initialization">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->appraisal_id->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "main_pa_questions" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="main_pa_questions">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->question->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_main_group_pa_questions" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_main_group_pa_questionslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_main_group_pa_questions_id" class="main_group_pa_questions_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->appraisal_id->Visible) { // appraisal_id ?>
        <th data-name="appraisal_id" class="<?= $Page->appraisal_id->headerCellClass() ?>"><div id="elh_main_group_pa_questions_appraisal_id" class="main_group_pa_questions_appraisal_id"><?= $Page->renderFieldHeader($Page->appraisal_id) ?></div></th>
<?php } ?>
<?php if ($Page->business_unit->Visible) { // business_unit ?>
        <th data-name="business_unit" class="<?= $Page->business_unit->headerCellClass() ?>"><div id="elh_main_group_pa_questions_business_unit" class="main_group_pa_questions_business_unit"><?= $Page->renderFieldHeader($Page->business_unit) ?></div></th>
<?php } ?>
<?php if ($Page->group->Visible) { // group ?>
        <th data-name="group" class="<?= $Page->group->headerCellClass() ?>"><div id="elh_main_group_pa_questions_group" class="main_group_pa_questions_group"><?= $Page->renderFieldHeader($Page->group) ?></div></th>
<?php } ?>
<?php if ($Page->question->Visible) { // question ?>
        <th data-name="question" class="<?= $Page->question->headerCellClass() ?>"><div id="elh_main_group_pa_questions_question" class="main_group_pa_questions_question"><?= $Page->renderFieldHeader($Page->question) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_main_group_pa_questions",
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
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_id" class="el_main_group_pa_questions_id"></span>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_id" id="o<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_id" class="el_main_group_pa_questions_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->appraisal_id->Visible) { // appraisal_id ?>
        <td data-name="appraisal_id"<?= $Page->appraisal_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Page->appraisal_id->getSessionValue() != "") { ?>
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_appraisal_id" class="el_main_group_pa_questions_appraisal_id">
<span<?= $Page->appraisal_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->appraisal_id->getDisplayValue($Page->appraisal_id->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_appraisal_id" name="x<?= $Page->RowIndex ?>_appraisal_id" value="<?= HtmlEncode($Page->appraisal_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_appraisal_id" class="el_main_group_pa_questions_appraisal_id">
    <select
        id="x<?= $Page->RowIndex ?>_appraisal_id"
        name="x<?= $Page->RowIndex ?>_appraisal_id"
        class="form-control ew-select<?= $Page->appraisal_id->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionslist_x<?= $Page->RowIndex ?>_appraisal_id"
        data-table="main_group_pa_questions"
        data-field="x_appraisal_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->appraisal_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->appraisal_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->appraisal_id->getPlaceHolder()) ?>"
        <?= $Page->appraisal_id->editAttributes() ?>>
        <?= $Page->appraisal_id->selectOptionListHtml("x{$Page->RowIndex}_appraisal_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->appraisal_id->getErrorMessage() ?></div>
<?= $Page->appraisal_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_appraisal_id") ?>
<script>
loadjs.ready("fmain_group_pa_questionslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_appraisal_id", selectId: "fmain_group_pa_questionslist_x<?= $Page->RowIndex ?>_appraisal_id" };
    if (fmain_group_pa_questionslist.lists.appraisal_id.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_appraisal_id", form: "fmain_group_pa_questionslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_appraisal_id", form: "fmain_group_pa_questionslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.appraisal_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_appraisal_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_appraisal_id" id="o<?= $Page->RowIndex ?>_appraisal_id" value="<?= HtmlEncode($Page->appraisal_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_appraisal_id" class="el_main_group_pa_questions_appraisal_id">
<span<?= $Page->appraisal_id->viewAttributes() ?>>
<?= $Page->appraisal_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->business_unit->Visible) { // business_unit ?>
        <td data-name="business_unit"<?= $Page->business_unit->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_business_unit" class="el_main_group_pa_questions_business_unit">
<?php $Page->business_unit->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x<?= $Page->RowIndex ?>_business_unit"
        name="x<?= $Page->RowIndex ?>_business_unit"
        class="form-control ew-select<?= $Page->business_unit->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionslist_x<?= $Page->RowIndex ?>_business_unit"
        data-table="main_group_pa_questions"
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
loadjs.ready("fmain_group_pa_questionslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_business_unit", selectId: "fmain_group_pa_questionslist_x<?= $Page->RowIndex ?>_business_unit" };
    if (fmain_group_pa_questionslist.lists.business_unit.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_business_unit", form: "fmain_group_pa_questionslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_business_unit", form: "fmain_group_pa_questionslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.business_unit.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_business_unit" data-hidden="1" name="o<?= $Page->RowIndex ?>_business_unit" id="o<?= $Page->RowIndex ?>_business_unit" value="<?= HtmlEncode($Page->business_unit->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_business_unit" class="el_main_group_pa_questions_business_unit">
<span<?= $Page->business_unit->viewAttributes() ?>>
<?= $Page->business_unit->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->group->Visible) { // group ?>
        <td data-name="group"<?= $Page->group->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_group" class="el_main_group_pa_questions_group">
    <select
        id="x<?= $Page->RowIndex ?>_group"
        name="x<?= $Page->RowIndex ?>_group"
        class="form-control ew-select<?= $Page->group->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionslist_x<?= $Page->RowIndex ?>_group"
        data-table="main_group_pa_questions"
        data-field="x_group"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->group->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->group->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->group->getPlaceHolder()) ?>"
        <?= $Page->group->editAttributes() ?>>
        <?= $Page->group->selectOptionListHtml("x{$Page->RowIndex}_group") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->group->getErrorMessage() ?></div>
<?= $Page->group->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_group") ?>
<script>
loadjs.ready("fmain_group_pa_questionslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_group", selectId: "fmain_group_pa_questionslist_x<?= $Page->RowIndex ?>_group" };
    if (fmain_group_pa_questionslist.lists.group.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_group", form: "fmain_group_pa_questionslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_group", form: "fmain_group_pa_questionslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.group.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_group" data-hidden="1" name="o<?= $Page->RowIndex ?>_group" id="o<?= $Page->RowIndex ?>_group" value="<?= HtmlEncode($Page->group->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_group" class="el_main_group_pa_questions_group">
<span<?= $Page->group->viewAttributes() ?>>
<?= $Page->group->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->question->Visible) { // question ?>
        <td data-name="question"<?= $Page->question->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Page->question->getSessionValue() != "") { ?>
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_question" class="el_main_group_pa_questions_question">
<span<?= $Page->question->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->question->getDisplayValue($Page->question->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_question" name="x<?= $Page->RowIndex ?>_question" value="<?= HtmlEncode($Page->question->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_question" class="el_main_group_pa_questions_question">
<div class="input-group flex-nowrap">
    <select
        id="x<?= $Page->RowIndex ?>_question"
        name="x<?= $Page->RowIndex ?>_question"
        class="form-control ew-select<?= $Page->question->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionslist_x<?= $Page->RowIndex ?>_question"
        data-table="main_group_pa_questions"
        data-field="x_question"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->question->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->question->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->question->getPlaceHolder()) ?>"
        <?= $Page->question->editAttributes() ?>>
        <?= $Page->question->selectOptionListHtml("x{$Page->RowIndex}_question") ?>
    </select>
    <?php if (AllowAdd(CurrentProjectID() . "main_pa_questions") && !$Page->question->ReadOnly) { ?>
    <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Page->RowIndex ?>_question" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Page->question->caption() ?>" data-title="<?= $Page->question->caption() ?>" data-ew-action="add-option" data-el="x<?= $Page->RowIndex ?>_question" data-url="<?= GetUrl("mainpaquestionsaddopt") ?>"><i class="fas fa-plus ew-icon"></i></button>
    <?php } ?>
</div>
<div class="invalid-feedback"><?= $Page->question->getErrorMessage() ?></div>
<?= $Page->question->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_question") ?>
<script>
loadjs.ready("fmain_group_pa_questionslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_question", selectId: "fmain_group_pa_questionslist_x<?= $Page->RowIndex ?>_question" };
    if (fmain_group_pa_questionslist.lists.question.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_question", form: "fmain_group_pa_questionslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_question", form: "fmain_group_pa_questionslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.question.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_question" data-hidden="1" name="o<?= $Page->RowIndex ?>_question" id="o<?= $Page->RowIndex ?>_question" value="<?= HtmlEncode($Page->question->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_group_pa_questions_question" class="el_main_group_pa_questions_question">
<span<?= $Page->question->viewAttributes() ?>>
<?= $Page->question->getViewValue() ?></span>
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
loadjs.ready(["fmain_group_pa_questionslist","load"], () => fmain_group_pa_questionslist.updateLists(<?= $Page->RowIndex ?>));
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
    $Page->RowAttrs->merge(["data-rowindex" => $Page->RowIndex, "id" => "r0_main_group_pa_questions", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_main_group_pa_questions_id" class="el_main_group_pa_questions_id"></span>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_id" id="o<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->appraisal_id->Visible) { // appraisal_id ?>
        <td data-name="appraisal_id">
<?php if ($Page->appraisal_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_main_group_pa_questions_appraisal_id" class="el_main_group_pa_questions_appraisal_id">
<span<?= $Page->appraisal_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->appraisal_id->getDisplayValue($Page->appraisal_id->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_appraisal_id" name="x<?= $Page->RowIndex ?>_appraisal_id" value="<?= HtmlEncode($Page->appraisal_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_main_group_pa_questions_appraisal_id" class="el_main_group_pa_questions_appraisal_id">
    <select
        id="x<?= $Page->RowIndex ?>_appraisal_id"
        name="x<?= $Page->RowIndex ?>_appraisal_id"
        class="form-control ew-select<?= $Page->appraisal_id->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionslist_x<?= $Page->RowIndex ?>_appraisal_id"
        data-table="main_group_pa_questions"
        data-field="x_appraisal_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->appraisal_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->appraisal_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->appraisal_id->getPlaceHolder()) ?>"
        <?= $Page->appraisal_id->editAttributes() ?>>
        <?= $Page->appraisal_id->selectOptionListHtml("x{$Page->RowIndex}_appraisal_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->appraisal_id->getErrorMessage() ?></div>
<?= $Page->appraisal_id->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_appraisal_id") ?>
<script>
loadjs.ready("fmain_group_pa_questionslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_appraisal_id", selectId: "fmain_group_pa_questionslist_x<?= $Page->RowIndex ?>_appraisal_id" };
    if (fmain_group_pa_questionslist.lists.appraisal_id.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_appraisal_id", form: "fmain_group_pa_questionslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_appraisal_id", form: "fmain_group_pa_questionslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.appraisal_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_appraisal_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_appraisal_id" id="o<?= $Page->RowIndex ?>_appraisal_id" value="<?= HtmlEncode($Page->appraisal_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->business_unit->Visible) { // business_unit ?>
        <td data-name="business_unit">
<span id="el$rowindex$_main_group_pa_questions_business_unit" class="el_main_group_pa_questions_business_unit">
<?php $Page->business_unit->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x<?= $Page->RowIndex ?>_business_unit"
        name="x<?= $Page->RowIndex ?>_business_unit"
        class="form-control ew-select<?= $Page->business_unit->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionslist_x<?= $Page->RowIndex ?>_business_unit"
        data-table="main_group_pa_questions"
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
loadjs.ready("fmain_group_pa_questionslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_business_unit", selectId: "fmain_group_pa_questionslist_x<?= $Page->RowIndex ?>_business_unit" };
    if (fmain_group_pa_questionslist.lists.business_unit.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_business_unit", form: "fmain_group_pa_questionslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_business_unit", form: "fmain_group_pa_questionslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.business_unit.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_business_unit" data-hidden="1" name="o<?= $Page->RowIndex ?>_business_unit" id="o<?= $Page->RowIndex ?>_business_unit" value="<?= HtmlEncode($Page->business_unit->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->group->Visible) { // group ?>
        <td data-name="group">
<span id="el$rowindex$_main_group_pa_questions_group" class="el_main_group_pa_questions_group">
    <select
        id="x<?= $Page->RowIndex ?>_group"
        name="x<?= $Page->RowIndex ?>_group"
        class="form-control ew-select<?= $Page->group->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionslist_x<?= $Page->RowIndex ?>_group"
        data-table="main_group_pa_questions"
        data-field="x_group"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->group->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->group->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->group->getPlaceHolder()) ?>"
        <?= $Page->group->editAttributes() ?>>
        <?= $Page->group->selectOptionListHtml("x{$Page->RowIndex}_group") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->group->getErrorMessage() ?></div>
<?= $Page->group->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_group") ?>
<script>
loadjs.ready("fmain_group_pa_questionslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_group", selectId: "fmain_group_pa_questionslist_x<?= $Page->RowIndex ?>_group" };
    if (fmain_group_pa_questionslist.lists.group.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_group", form: "fmain_group_pa_questionslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_group", form: "fmain_group_pa_questionslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.group.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_group" data-hidden="1" name="o<?= $Page->RowIndex ?>_group" id="o<?= $Page->RowIndex ?>_group" value="<?= HtmlEncode($Page->group->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->question->Visible) { // question ?>
        <td data-name="question">
<?php if ($Page->question->getSessionValue() != "") { ?>
<span id="el$rowindex$_main_group_pa_questions_question" class="el_main_group_pa_questions_question">
<span<?= $Page->question->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->question->getDisplayValue($Page->question->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Page->RowIndex ?>_question" name="x<?= $Page->RowIndex ?>_question" value="<?= HtmlEncode($Page->question->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_main_group_pa_questions_question" class="el_main_group_pa_questions_question">
<div class="input-group flex-nowrap">
    <select
        id="x<?= $Page->RowIndex ?>_question"
        name="x<?= $Page->RowIndex ?>_question"
        class="form-control ew-select<?= $Page->question->isInvalidClass() ?>"
        data-select2-id="fmain_group_pa_questionslist_x<?= $Page->RowIndex ?>_question"
        data-table="main_group_pa_questions"
        data-field="x_question"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->question->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->question->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->question->getPlaceHolder()) ?>"
        <?= $Page->question->editAttributes() ?>>
        <?= $Page->question->selectOptionListHtml("x{$Page->RowIndex}_question") ?>
    </select>
    <?php if (AllowAdd(CurrentProjectID() . "main_pa_questions") && !$Page->question->ReadOnly) { ?>
    <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?= $Page->RowIndex ?>_question" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Page->question->caption() ?>" data-title="<?= $Page->question->caption() ?>" data-ew-action="add-option" data-el="x<?= $Page->RowIndex ?>_question" data-url="<?= GetUrl("mainpaquestionsaddopt") ?>"><i class="fas fa-plus ew-icon"></i></button>
    <?php } ?>
</div>
<div class="invalid-feedback"><?= $Page->question->getErrorMessage() ?></div>
<?= $Page->question->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_question") ?>
<script>
loadjs.ready("fmain_group_pa_questionslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_question", selectId: "fmain_group_pa_questionslist_x<?= $Page->RowIndex ?>_question" };
    if (fmain_group_pa_questionslist.lists.question.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_question", form: "fmain_group_pa_questionslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_question", form: "fmain_group_pa_questionslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_group_pa_questions.fields.question.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="main_group_pa_questions" data-field="x_question" data-hidden="1" name="o<?= $Page->RowIndex ?>_question" id="o<?= $Page->RowIndex ?>_question" value="<?= HtmlEncode($Page->question->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowIndex);
?>
<script>
loadjs.ready(["fmain_group_pa_questionslist","load"], () => fmain_group_pa_questionslist.updateLists(<?= $Page->RowIndex ?>, true));
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
