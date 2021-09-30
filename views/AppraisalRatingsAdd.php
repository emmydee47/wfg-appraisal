<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$AppraisalRatingsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { appraisal_ratings: currentTable } });
var currentForm, currentPageID;
var fappraisal_ratingsadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fappraisal_ratingsadd = new ew.Form("fappraisal_ratingsadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fappraisal_ratingsadd;

    // Add fields
    var fields = currentTable.fields;
    fappraisal_ratingsadd.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.integer], fields.id.isInvalid],
        ["rating", [fields.rating.visible && fields.rating.required ? ew.Validators.required(fields.rating.caption) : null], fields.rating.isInvalid],
        ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null], fields.created_at.isInvalid],
        ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null], fields.updated_at.isInvalid]
    ]);

    // Form_CustomValidate
    fappraisal_ratingsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fappraisal_ratingsadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fappraisal_ratingsadd");
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
<form name="fappraisal_ratingsadd" id="fappraisal_ratingsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="appraisal_ratings">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_appraisal_ratings_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_appraisal_ratings_id">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="appraisal_ratings" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rating->Visible) { // rating ?>
    <div id="r_rating"<?= $Page->rating->rowAttributes() ?>>
        <label id="elh_appraisal_ratings_rating" for="x_rating" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rating->caption() ?><?= $Page->rating->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rating->cellAttributes() ?>>
<span id="el_appraisal_ratings_rating">
<input type="<?= $Page->rating->getInputTextType() ?>" name="x_rating" id="x_rating" data-table="appraisal_ratings" data-field="x_rating" value="<?= $Page->rating->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->rating->getPlaceHolder()) ?>"<?= $Page->rating->editAttributes() ?> aria-describedby="x_rating_help">
<?= $Page->rating->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rating->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("appraisal_ratings");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
