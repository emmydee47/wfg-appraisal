<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaQuestionsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_questions: currentTable } });
var currentForm, currentPageID;
var fmain_pa_questionslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_questionslist = new ew.Form("fmain_pa_questionslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fmain_pa_questionslist;
    fmain_pa_questionslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_questionslist.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["group", [fields.group.visible && fields.group.required ? ew.Validators.required(fields.group.caption) : null], fields.group.isInvalid],
        ["question", [fields.question.visible && fields.question.required ? ew.Validators.required(fields.question.caption) : null], fields.question.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
        ["created_date", [fields.created_date.visible && fields.created_date.required ? ew.Validators.required(fields.created_date.caption) : null], fields.created_date.isInvalid],
        ["modified_date", [fields.modified_date.visible && fields.modified_date.required ? ew.Validators.required(fields.modified_date.caption) : null], fields.modified_date.isInvalid]
    ]);

    // Check empty row
    fmain_pa_questionslist.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["group",false],["question",false],["description",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fmain_pa_questionslist.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_questionslist.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_questionslist.lists.group = <?= $Page->group->toClientList($Page) ?>;
    loadjs.done("fmain_pa_questionslist");
});
var fmain_pa_questionssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fmain_pa_questionssrch = new ew.Form("fmain_pa_questionssrch", "list");
    currentSearchForm = fmain_pa_questionssrch;

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_questionssrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["group", [], fields.group.isInvalid],
        ["question", [], fields.question.isInvalid],
        ["description", [], fields.description.isInvalid],
        ["created_date", [], fields.created_date.isInvalid],
        ["modified_date", [], fields.modified_date.isInvalid]
    ]);

    // Validate form
    fmain_pa_questionssrch.validate = function () {
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
    fmain_pa_questionssrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_questionssrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_questionssrch.lists.group = <?= $Page->group->toClientList($Page) ?>;

    // Filters
    fmain_pa_questionssrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fmain_pa_questionssrch");
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
<form name="fmain_pa_questionssrch" id="fmain_pa_questionssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fmain_pa_questionssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="main_pa_questions">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->group->Visible) { // group ?>
<?php
if (!$Page->group->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_group" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->group->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_group" class="ew-search-caption ew-label"><?= $Page->group->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_group" id="z_group" value="=">
</div>
        </div>
        <div id="el_main_pa_questions_group" class="ew-search-field">
    <select
        id="x_group"
        name="x_group"
        class="form-control ew-select<?= $Page->group->isInvalidClass() ?>"
        data-select2-id="fmain_pa_questionssrch_x_group"
        data-table="main_pa_questions"
        data-field="x_group"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->group->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->group->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->group->getPlaceHolder()) ?>"
        <?= $Page->group->editAttributes() ?>>
        <?= $Page->group->selectOptionListHtml("x_group") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->group->getErrorMessage(false) ?></div>
<?= $Page->group->Lookup->getParamTag($Page, "p_x_group") ?>
<script>
loadjs.ready("fmain_pa_questionssrch", function() {
    var options = { name: "x_group", selectId: "fmain_pa_questionssrch_x_group" };
    if (fmain_pa_questionssrch.lists.group.lookupOptions.length) {
        options.data = { id: "x_group", form: "fmain_pa_questionssrch" };
    } else {
        options.ajax = { id: "x_group", form: "fmain_pa_questionssrch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_questions.fields.group.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->question->Visible) { // question ?>
<?php
if (!$Page->question->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_question" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->question->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_question" class="ew-search-caption ew-label"><?= $Page->question->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_question" id="z_question" value="LIKE">
</div>
        </div>
        <div id="el_main_pa_questions_question" class="ew-search-field">
<input type="<?= $Page->question->getInputTextType() ?>" name="x_question" id="x_question" data-table="main_pa_questions" data-field="x_question" value="<?= $Page->question->EditValue ?>" size="35" placeholder="<?= HtmlEncode($Page->question->getPlaceHolder()) ?>"<?= $Page->question->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->question->getErrorMessage(false) ?></div>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
<?php
if (!$Page->description->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_description" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->description->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_description" class="ew-search-caption ew-label"><?= $Page->description->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_description" id="z_description" value="LIKE">
</div>
        </div>
        <div id="el_main_pa_questions_description" class="ew-search-field">
<input type="<?= $Page->description->getInputTextType() ?>" name="x_description" id="x_description" data-table="main_pa_questions" data-field="x_description" value="<?= $Page->description->EditValue ?>" size="35" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage(false) ?></div>
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fmain_pa_questionssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fmain_pa_questionssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fmain_pa_questionssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fmain_pa_questionssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> main_pa_questions">
<form name="fmain_pa_questionslist" id="fmain_pa_questionslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_questions">
<div id="gmp_main_pa_questions" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_main_pa_questionslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_main_pa_questions_id" class="main_pa_questions_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->group->Visible) { // group ?>
        <th data-name="group" class="<?= $Page->group->headerCellClass() ?>"><div id="elh_main_pa_questions_group" class="main_pa_questions_group"><?= $Page->renderFieldHeader($Page->group) ?></div></th>
<?php } ?>
<?php if ($Page->question->Visible) { // question ?>
        <th data-name="question" class="<?= $Page->question->headerCellClass() ?>"><div id="elh_main_pa_questions_question" class="main_pa_questions_question"><?= $Page->renderFieldHeader($Page->question) ?></div></th>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <th data-name="description" class="<?= $Page->description->headerCellClass() ?>"><div id="elh_main_pa_questions_description" class="main_pa_questions_description"><?= $Page->renderFieldHeader($Page->description) ?></div></th>
<?php } ?>
<?php if ($Page->created_date->Visible) { // created_date ?>
        <th data-name="created_date" class="<?= $Page->created_date->headerCellClass() ?>"><div id="elh_main_pa_questions_created_date" class="main_pa_questions_created_date"><?= $Page->renderFieldHeader($Page->created_date) ?></div></th>
<?php } ?>
<?php if ($Page->modified_date->Visible) { // modified_date ?>
        <th data-name="modified_date" class="<?= $Page->modified_date->headerCellClass() ?>"><div id="elh_main_pa_questions_modified_date" class="main_pa_questions_modified_date"><?= $Page->renderFieldHeader($Page->modified_date) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_main_pa_questions",
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
<span id="el<?= $Page->RowCount ?>_main_pa_questions_id" class="el_main_pa_questions_id"></span>
<input type="hidden" data-table="main_pa_questions" data-field="x_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_id" id="o<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_questions_id" class="el_main_pa_questions_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->group->Visible) { // group ?>
        <td data-name="group"<?= $Page->group->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_questions_group" class="el_main_pa_questions_group">
    <select
        id="x<?= $Page->RowIndex ?>_group"
        name="x<?= $Page->RowIndex ?>_group"
        class="form-control ew-select<?= $Page->group->isInvalidClass() ?>"
        data-select2-id="fmain_pa_questionslist_x<?= $Page->RowIndex ?>_group"
        data-table="main_pa_questions"
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
loadjs.ready("fmain_pa_questionslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_group", selectId: "fmain_pa_questionslist_x<?= $Page->RowIndex ?>_group" };
    if (fmain_pa_questionslist.lists.group.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_group", form: "fmain_pa_questionslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_group", form: "fmain_pa_questionslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_questions.fields.group.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_pa_questions" data-field="x_group" data-hidden="1" name="o<?= $Page->RowIndex ?>_group" id="o<?= $Page->RowIndex ?>_group" value="<?= HtmlEncode($Page->group->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_questions_group" class="el_main_pa_questions_group">
<span<?= $Page->group->viewAttributes() ?>>
<?= $Page->group->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->question->Visible) { // question ?>
        <td data-name="question"<?= $Page->question->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_questions_question" class="el_main_pa_questions_question">
<textarea data-table="main_pa_questions" data-field="x_question" name="x<?= $Page->RowIndex ?>_question" id="x<?= $Page->RowIndex ?>_question" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->question->getPlaceHolder()) ?>"<?= $Page->question->editAttributes() ?>><?= $Page->question->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->question->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="main_pa_questions" data-field="x_question" data-hidden="1" name="o<?= $Page->RowIndex ?>_question" id="o<?= $Page->RowIndex ?>_question" value="<?= HtmlEncode($Page->question->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_questions_question" class="el_main_pa_questions_question">
<span<?= $Page->question->viewAttributes() ?>>
<?= $Page->question->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->description->Visible) { // description ?>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_questions_description" class="el_main_pa_questions_description">
<textarea data-table="main_pa_questions" data-field="x_description" name="x<?= $Page->RowIndex ?>_description" id="x<?= $Page->RowIndex ?>_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?>><?= $Page->description->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="main_pa_questions" data-field="x_description" data-hidden="1" name="o<?= $Page->RowIndex ?>_description" id="o<?= $Page->RowIndex ?>_description" value="<?= HtmlEncode($Page->description->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_questions_description" class="el_main_pa_questions_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->created_date->Visible) { // created_date ?>
        <td data-name="created_date"<?= $Page->created_date->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="main_pa_questions" data-field="x_created_date" data-hidden="1" name="o<?= $Page->RowIndex ?>_created_date" id="o<?= $Page->RowIndex ?>_created_date" value="<?= HtmlEncode($Page->created_date->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_questions_created_date" class="el_main_pa_questions_created_date">
<span<?= $Page->created_date->viewAttributes() ?>>
<?= $Page->created_date->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->modified_date->Visible) { // modified_date ?>
        <td data-name="modified_date"<?= $Page->modified_date->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="main_pa_questions" data-field="x_modified_date" data-hidden="1" name="o<?= $Page->RowIndex ?>_modified_date" id="o<?= $Page->RowIndex ?>_modified_date" value="<?= HtmlEncode($Page->modified_date->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_main_pa_questions_modified_date" class="el_main_pa_questions_modified_date">
<span<?= $Page->modified_date->viewAttributes() ?>>
<?= $Page->modified_date->getViewValue() ?></span>
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
loadjs.ready(["fmain_pa_questionslist","load"], () => fmain_pa_questionslist.updateLists(<?= $Page->RowIndex ?>));
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
    $Page->RowAttrs->merge(["data-rowindex" => $Page->RowIndex, "id" => "r0_main_pa_questions", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_main_pa_questions_id" class="el_main_pa_questions_id"></span>
<input type="hidden" data-table="main_pa_questions" data-field="x_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_id" id="o<?= $Page->RowIndex ?>_id" value="<?= HtmlEncode($Page->id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->group->Visible) { // group ?>
        <td data-name="group">
<span id="el$rowindex$_main_pa_questions_group" class="el_main_pa_questions_group">
    <select
        id="x<?= $Page->RowIndex ?>_group"
        name="x<?= $Page->RowIndex ?>_group"
        class="form-control ew-select<?= $Page->group->isInvalidClass() ?>"
        data-select2-id="fmain_pa_questionslist_x<?= $Page->RowIndex ?>_group"
        data-table="main_pa_questions"
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
loadjs.ready("fmain_pa_questionslist", function() {
    var options = { name: "x<?= $Page->RowIndex ?>_group", selectId: "fmain_pa_questionslist_x<?= $Page->RowIndex ?>_group" };
    if (fmain_pa_questionslist.lists.group.lookupOptions.length) {
        options.data = { id: "x<?= $Page->RowIndex ?>_group", form: "fmain_pa_questionslist" };
    } else {
        options.ajax = { id: "x<?= $Page->RowIndex ?>_group", form: "fmain_pa_questionslist", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_questions.fields.group.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="main_pa_questions" data-field="x_group" data-hidden="1" name="o<?= $Page->RowIndex ?>_group" id="o<?= $Page->RowIndex ?>_group" value="<?= HtmlEncode($Page->group->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->question->Visible) { // question ?>
        <td data-name="question">
<span id="el$rowindex$_main_pa_questions_question" class="el_main_pa_questions_question">
<textarea data-table="main_pa_questions" data-field="x_question" name="x<?= $Page->RowIndex ?>_question" id="x<?= $Page->RowIndex ?>_question" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->question->getPlaceHolder()) ?>"<?= $Page->question->editAttributes() ?>><?= $Page->question->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->question->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="main_pa_questions" data-field="x_question" data-hidden="1" name="o<?= $Page->RowIndex ?>_question" id="o<?= $Page->RowIndex ?>_question" value="<?= HtmlEncode($Page->question->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->description->Visible) { // description ?>
        <td data-name="description">
<span id="el$rowindex$_main_pa_questions_description" class="el_main_pa_questions_description">
<textarea data-table="main_pa_questions" data-field="x_description" name="x<?= $Page->RowIndex ?>_description" id="x<?= $Page->RowIndex ?>_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?>><?= $Page->description->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="main_pa_questions" data-field="x_description" data-hidden="1" name="o<?= $Page->RowIndex ?>_description" id="o<?= $Page->RowIndex ?>_description" value="<?= HtmlEncode($Page->description->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->created_date->Visible) { // created_date ?>
        <td data-name="created_date">
<input type="hidden" data-table="main_pa_questions" data-field="x_created_date" data-hidden="1" name="o<?= $Page->RowIndex ?>_created_date" id="o<?= $Page->RowIndex ?>_created_date" value="<?= HtmlEncode($Page->created_date->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->modified_date->Visible) { // modified_date ?>
        <td data-name="modified_date">
<input type="hidden" data-table="main_pa_questions" data-field="x_modified_date" data-hidden="1" name="o<?= $Page->RowIndex ?>_modified_date" id="o<?= $Page->RowIndex ?>_modified_date" value="<?= HtmlEncode($Page->modified_date->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowIndex);
?>
<script>
loadjs.ready(["fmain_pa_questionslist","load"], () => fmain_pa_questionslist.updateLists(<?= $Page->RowIndex ?>, true));
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
    ew.addEventHandlers("main_pa_questions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
