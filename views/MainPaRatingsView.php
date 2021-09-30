<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaRatingsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_ratings: currentTable } });
var currentForm, currentPageID;
var fmain_pa_ratingsview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_ratingsview = new ew.Form("fmain_pa_ratingsview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fmain_pa_ratingsview;
    loadjs.done("fmain_pa_ratingsview");
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
<form name="fmain_pa_ratingsview" id="fmain_pa_ratingsview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_ratings">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_ratings_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_main_pa_ratings_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rating_type->Visible) { // rating_type ?>
    <tr id="r_rating_type"<?= $Page->rating_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_ratings_rating_type"><?= $Page->rating_type->caption() ?></span></td>
        <td data-name="rating_type"<?= $Page->rating_type->cellAttributes() ?>>
<span id="el_main_pa_ratings_rating_type">
<span<?= $Page->rating_type->viewAttributes() ?>>
<?= $Page->rating_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rating_value->Visible) { // rating_value ?>
    <tr id="r_rating_value"<?= $Page->rating_value->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_ratings_rating_value"><?= $Page->rating_value->caption() ?></span></td>
        <td data-name="rating_value"<?= $Page->rating_value->cellAttributes() ?>>
<span id="el_main_pa_ratings_rating_value">
<span<?= $Page->rating_value->viewAttributes() ?>>
<?= $Page->rating_value->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rating_text->Visible) { // rating_text ?>
    <tr id="r_rating_text"<?= $Page->rating_text->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_ratings_rating_text"><?= $Page->rating_text->caption() ?></span></td>
        <td data-name="rating_text"<?= $Page->rating_text->cellAttributes() ?>>
<span id="el_main_pa_ratings_rating_text">
<span<?= $Page->rating_text->viewAttributes() ?>>
<?= $Page->rating_text->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rating_description->Visible) { // rating_description ?>
    <tr id="r_rating_description"<?= $Page->rating_description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_ratings_rating_description"><?= $Page->rating_description->caption() ?></span></td>
        <td data-name="rating_description"<?= $Page->rating_description->cellAttributes() ?>>
<span id="el_main_pa_ratings_rating_description">
<span<?= $Page->rating_description->viewAttributes() ?>>
<?= $Page->rating_description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->createdby->Visible) { // createdby ?>
    <tr id="r_createdby"<?= $Page->createdby->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_ratings_createdby"><?= $Page->createdby->caption() ?></span></td>
        <td data-name="createdby"<?= $Page->createdby->cellAttributes() ?>>
<span id="el_main_pa_ratings_createdby">
<span<?= $Page->createdby->viewAttributes() ?>>
<?= $Page->createdby->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modifiedby->Visible) { // modifiedby ?>
    <tr id="r_modifiedby"<?= $Page->modifiedby->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_ratings_modifiedby"><?= $Page->modifiedby->caption() ?></span></td>
        <td data-name="modifiedby"<?= $Page->modifiedby->cellAttributes() ?>>
<span id="el_main_pa_ratings_modifiedby">
<span<?= $Page->modifiedby->viewAttributes() ?>>
<?= $Page->modifiedby->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
    <tr id="r_createddate"<?= $Page->createddate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_ratings_createddate"><?= $Page->createddate->caption() ?></span></td>
        <td data-name="createddate"<?= $Page->createddate->cellAttributes() ?>>
<span id="el_main_pa_ratings_createddate">
<span<?= $Page->createddate->viewAttributes() ?>>
<?= $Page->createddate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
    <tr id="r_modifieddate"<?= $Page->modifieddate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_pa_ratings_modifieddate"><?= $Page->modifieddate->caption() ?></span></td>
        <td data-name="modifieddate"<?= $Page->modifieddate->cellAttributes() ?>>
<span id="el_main_pa_ratings_modifieddate">
<span<?= $Page->modifieddate->viewAttributes() ?>>
<?= $Page->modifieddate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
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
