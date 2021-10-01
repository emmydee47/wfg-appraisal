<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainBusinessunitsEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_businessunits: currentTable } });
var currentForm, currentPageID;
var fmain_businessunitsedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_businessunitsedit = new ew.Form("fmain_businessunitsedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fmain_businessunitsedit;

    // Add fields
    var fields = currentTable.fields;
    fmain_businessunitsedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["unitname", [fields.unitname.visible && fields.unitname.required ? ew.Validators.required(fields.unitname.caption) : null], fields.unitname.isInvalid],
        ["unitcode", [fields.unitcode.visible && fields.unitcode.required ? ew.Validators.required(fields.unitcode.caption) : null], fields.unitcode.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
        ["unithead", [fields.unithead.visible && fields.unithead.required ? ew.Validators.required(fields.unithead.caption) : null], fields.unithead.isInvalid],
        ["createdby", [fields.createdby.visible && fields.createdby.required ? ew.Validators.required(fields.createdby.caption) : null], fields.createdby.isInvalid],
        ["modifiedby", [fields.modifiedby.visible && fields.modifiedby.required ? ew.Validators.required(fields.modifiedby.caption) : null], fields.modifiedby.isInvalid],
        ["createddate", [fields.createddate.visible && fields.createddate.required ? ew.Validators.required(fields.createddate.caption) : null], fields.createddate.isInvalid],
        ["modifieddate", [fields.modifieddate.visible && fields.modifieddate.required ? ew.Validators.required(fields.modifieddate.caption) : null], fields.modifieddate.isInvalid],
        ["isactive", [fields.isactive.visible && fields.isactive.required ? ew.Validators.required(fields.isactive.caption) : null], fields.isactive.isInvalid]
    ]);

    // Form_CustomValidate
    fmain_businessunitsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_businessunitsedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_businessunitsedit.lists.unithead = <?= $Page->unithead->toClientList($Page) ?>;
    fmain_businessunitsedit.lists.createdby = <?= $Page->createdby->toClientList($Page) ?>;
    fmain_businessunitsedit.lists.modifiedby = <?= $Page->modifiedby->toClientList($Page) ?>;
    fmain_businessunitsedit.lists.isactive = <?= $Page->isactive->toClientList($Page) ?>;
    loadjs.done("fmain_businessunitsedit");
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
<form name="fmain_businessunitsedit" id="fmain_businessunitsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_businessunits">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_main_businessunits_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_main_businessunits_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="main_businessunits" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->unitname->Visible) { // unitname ?>
    <div id="r_unitname"<?= $Page->unitname->rowAttributes() ?>>
        <label id="elh_main_businessunits_unitname" for="x_unitname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->unitname->caption() ?><?= $Page->unitname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->unitname->cellAttributes() ?>>
<span id="el_main_businessunits_unitname">
<input type="<?= $Page->unitname->getInputTextType() ?>" name="x_unitname" id="x_unitname" data-table="main_businessunits" data-field="x_unitname" value="<?= $Page->unitname->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->unitname->getPlaceHolder()) ?>"<?= $Page->unitname->editAttributes() ?> aria-describedby="x_unitname_help">
<?= $Page->unitname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->unitname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->unitcode->Visible) { // unitcode ?>
    <div id="r_unitcode"<?= $Page->unitcode->rowAttributes() ?>>
        <label id="elh_main_businessunits_unitcode" for="x_unitcode" class="<?= $Page->LeftColumnClass ?>"><?= $Page->unitcode->caption() ?><?= $Page->unitcode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->unitcode->cellAttributes() ?>>
<span id="el_main_businessunits_unitcode">
<input type="<?= $Page->unitcode->getInputTextType() ?>" name="x_unitcode" id="x_unitcode" data-table="main_businessunits" data-field="x_unitcode" value="<?= $Page->unitcode->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->unitcode->getPlaceHolder()) ?>"<?= $Page->unitcode->editAttributes() ?> aria-describedby="x_unitcode_help">
<?= $Page->unitcode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->unitcode->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_main_businessunits_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_main_businessunits_description">
<textarea data-table="main_businessunits" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->unithead->Visible) { // unithead ?>
    <div id="r_unithead"<?= $Page->unithead->rowAttributes() ?>>
        <label id="elh_main_businessunits_unithead" for="x_unithead" class="<?= $Page->LeftColumnClass ?>"><?= $Page->unithead->caption() ?><?= $Page->unithead->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->unithead->cellAttributes() ?>>
<span id="el_main_businessunits_unithead">
    <select
        id="x_unithead"
        name="x_unithead"
        class="form-control ew-select<?= $Page->unithead->isInvalidClass() ?>"
        data-select2-id="fmain_businessunitsedit_x_unithead"
        data-table="main_businessunits"
        data-field="x_unithead"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->unithead->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->unithead->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->unithead->getPlaceHolder()) ?>"
        <?= $Page->unithead->editAttributes() ?>>
        <?= $Page->unithead->selectOptionListHtml("x_unithead") ?>
    </select>
    <?= $Page->unithead->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->unithead->getErrorMessage() ?></div>
<?= $Page->unithead->Lookup->getParamTag($Page, "p_x_unithead") ?>
<script>
loadjs.ready("fmain_businessunitsedit", function() {
    var options = { name: "x_unithead", selectId: "fmain_businessunitsedit_x_unithead" };
    if (fmain_businessunitsedit.lists.unithead.lookupOptions.length) {
        options.data = { id: "x_unithead", form: "fmain_businessunitsedit" };
    } else {
        options.ajax = { id: "x_unithead", form: "fmain_businessunitsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_businessunits.fields.unithead.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->isactive->Visible) { // isactive ?>
    <div id="r_isactive"<?= $Page->isactive->rowAttributes() ?>>
        <label id="elh_main_businessunits_isactive" class="<?= $Page->LeftColumnClass ?>"><?= $Page->isactive->caption() ?><?= $Page->isactive->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->isactive->cellAttributes() ?>>
<span id="el_main_businessunits_isactive">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->isactive->isInvalidClass() ?>" data-table="main_businessunits" data-field="x_isactive" name="x_isactive[]" id="x_isactive_885242" value="1"<?= ConvertToBool($Page->isactive->CurrentValue) ? " checked" : "" ?><?= $Page->isactive->editAttributes() ?> aria-describedby="x_isactive_help">
    <div class="invalid-feedback"><?= $Page->isactive->getErrorMessage() ?></div>
</div>
<?= $Page->isactive->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
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
    ew.addEventHandlers("main_businessunits");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
