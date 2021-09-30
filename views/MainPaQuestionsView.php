<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaQuestionsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_questions: currentTable } });
var currentForm, currentPageID;
var fmain_pa_questionsview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_questionsview = new ew.Form("fmain_pa_questionsview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fmain_pa_questionsview;
    loadjs.done("fmain_pa_questionsview");
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
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fmain_pa_questionsview" id="fmain_pa_questionsview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_questions">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_questions_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_main_pa_questions_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->group->Visible) { // group ?>
    <tr id="r_group"<?= $Page->group->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_questions_group"><?= $Page->group->caption() ?></span></td>
        <td data-name="group"<?= $Page->group->cellAttributes() ?>>
<span id="el_main_pa_questions_group">
<span<?= $Page->group->viewAttributes() ?>>
<?= $Page->group->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->question->Visible) { // question ?>
    <tr id="r_question"<?= $Page->question->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_questions_question"><?= $Page->question->caption() ?></span></td>
        <td data-name="question"<?= $Page->question->cellAttributes() ?>>
<span id="el_main_pa_questions_question">
<span<?= $Page->question->viewAttributes() ?>>
<?= $Page->question->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description"<?= $Page->description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_questions_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el_main_pa_questions_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <tr id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_questions_created_by"><?= $Page->created_by->caption() ?></span></td>
        <td data-name="created_by"<?= $Page->created_by->cellAttributes() ?>>
<span id="el_main_pa_questions_created_by">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modified_by->Visible) { // modified_by ?>
    <tr id="r_modified_by"<?= $Page->modified_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_questions_modified_by"><?= $Page->modified_by->caption() ?></span></td>
        <td data-name="modified_by"<?= $Page->modified_by->cellAttributes() ?>>
<span id="el_main_pa_questions_modified_by">
<span<?= $Page->modified_by->viewAttributes() ?>>
<?= $Page->modified_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_date->Visible) { // created_date ?>
    <tr id="r_created_date"<?= $Page->created_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_questions_created_date"><?= $Page->created_date->caption() ?></span></td>
        <td data-name="created_date"<?= $Page->created_date->cellAttributes() ?>>
<span id="el_main_pa_questions_created_date">
<span<?= $Page->created_date->viewAttributes() ?>>
<?= $Page->created_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modified_date->Visible) { // modified_date ?>
    <tr id="r_modified_date"<?= $Page->modified_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_questions_modified_date"><?= $Page->modified_date->caption() ?></span></td>
        <td data-name="modified_date"<?= $Page->modified_date->cellAttributes() ?>>
<span id="el_main_pa_questions_modified_date">
<span<?= $Page->modified_date->viewAttributes() ?>>
<?= $Page->modified_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("main_group_pa_questions", explode(",", $Page->getCurrentDetailTable())) && $main_group_pa_questions->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("main_group_pa_questions", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "MainGroupPaQuestionsGrid.php" ?>
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
