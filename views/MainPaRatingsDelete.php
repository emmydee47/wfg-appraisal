<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaRatingsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_ratings: currentTable } });
var currentForm, currentPageID;
var fmain_pa_ratingsdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_ratingsdelete = new ew.Form("fmain_pa_ratingsdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fmain_pa_ratingsdelete;
    loadjs.done("fmain_pa_ratingsdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fmain_pa_ratingsdelete" id="fmain_pa_ratingsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_ratings">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_main_pa_ratings_id" class="main_pa_ratings_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rating_type->Visible) { // rating_type ?>
        <th class="<?= $Page->rating_type->headerCellClass() ?>"><span id="elh_main_pa_ratings_rating_type" class="main_pa_ratings_rating_type"><?= $Page->rating_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rating_value->Visible) { // rating_value ?>
        <th class="<?= $Page->rating_value->headerCellClass() ?>"><span id="elh_main_pa_ratings_rating_value" class="main_pa_ratings_rating_value"><?= $Page->rating_value->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rating_text->Visible) { // rating_text ?>
        <th class="<?= $Page->rating_text->headerCellClass() ?>"><span id="elh_main_pa_ratings_rating_text" class="main_pa_ratings_rating_text"><?= $Page->rating_text->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rating_description->Visible) { // rating_description ?>
        <th class="<?= $Page->rating_description->headerCellClass() ?>"><span id="elh_main_pa_ratings_rating_description" class="main_pa_ratings_rating_description"><?= $Page->rating_description->caption() ?></span></th>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <th class="<?= $Page->createddate->headerCellClass() ?>"><span id="elh_main_pa_ratings_createddate" class="main_pa_ratings_createddate"><?= $Page->createddate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <th class="<?= $Page->modifieddate->headerCellClass() ?>"><span id="elh_main_pa_ratings_modifieddate" class="main_pa_ratings_modifieddate"><?= $Page->modifieddate->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_id" class="el_main_pa_ratings_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rating_type->Visible) { // rating_type ?>
        <td<?= $Page->rating_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_type" class="el_main_pa_ratings_rating_type">
<span<?= $Page->rating_type->viewAttributes() ?>>
<?= $Page->rating_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rating_value->Visible) { // rating_value ?>
        <td<?= $Page->rating_value->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_value" class="el_main_pa_ratings_rating_value">
<span<?= $Page->rating_value->viewAttributes() ?>>
<?= $Page->rating_value->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rating_text->Visible) { // rating_text ?>
        <td<?= $Page->rating_text->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_text" class="el_main_pa_ratings_rating_text">
<span<?= $Page->rating_text->viewAttributes() ?>>
<?= $Page->rating_text->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rating_description->Visible) { // rating_description ?>
        <td<?= $Page->rating_description->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_rating_description" class="el_main_pa_ratings_rating_description">
<span<?= $Page->rating_description->viewAttributes() ?>>
<?= $Page->rating_description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
        <td<?= $Page->createddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_createddate" class="el_main_pa_ratings_createddate">
<span<?= $Page->createddate->viewAttributes() ?>>
<?= $Page->createddate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
        <td<?= $Page->modifieddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_pa_ratings_modifieddate" class="el_main_pa_ratings_modifieddate">
<span<?= $Page->modifieddate->viewAttributes() ?>>
<?= $Page->modifieddate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
