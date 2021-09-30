<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainPaGroupsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_pa_groups: currentTable } });
var currentForm, currentPageID;
var fmain_pa_groupsadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_pa_groupsadd = new ew.Form("fmain_pa_groupsadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fmain_pa_groupsadd;

    // Add fields
    var fields = currentTable.fields;
    fmain_pa_groupsadd.addFields([
        ["business_unit", [fields.business_unit.visible && fields.business_unit.required ? ew.Validators.required(fields.business_unit.caption) : null], fields.business_unit.isInvalid],
        ["group_name", [fields.group_name.visible && fields.group_name.required ? ew.Validators.required(fields.group_name.caption) : null], fields.group_name.isInvalid],
        ["createdby", [fields.createdby.visible && fields.createdby.required ? ew.Validators.required(fields.createdby.caption) : null], fields.createdby.isInvalid],
        ["modifiedby", [fields.modifiedby.visible && fields.modifiedby.required ? ew.Validators.required(fields.modifiedby.caption) : null], fields.modifiedby.isInvalid],
        ["createddate", [fields.createddate.visible && fields.createddate.required ? ew.Validators.required(fields.createddate.caption) : null], fields.createddate.isInvalid],
        ["modifieddate", [fields.modifieddate.visible && fields.modifieddate.required ? ew.Validators.required(fields.modifieddate.caption) : null], fields.modifieddate.isInvalid]
    ]);

    // Form_CustomValidate
    fmain_pa_groupsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_pa_groupsadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_pa_groupsadd.lists.business_unit = <?= $Page->business_unit->toClientList($Page) ?>;
    fmain_pa_groupsadd.lists.createdby = <?= $Page->createdby->toClientList($Page) ?>;
    fmain_pa_groupsadd.lists.modifiedby = <?= $Page->modifiedby->toClientList($Page) ?>;
    loadjs.done("fmain_pa_groupsadd");
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
<form name="fmain_pa_groupsadd" id="fmain_pa_groupsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_pa_groups">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->business_unit->Visible) { // business_unit ?>
    <div id="r_business_unit"<?= $Page->business_unit->rowAttributes() ?>>
        <label id="elh_main_pa_groups_business_unit" for="x_business_unit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->business_unit->caption() ?><?= $Page->business_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->business_unit->cellAttributes() ?>>
<span id="el_main_pa_groups_business_unit">
    <select
        id="x_business_unit"
        name="x_business_unit"
        class="form-control ew-select<?= $Page->business_unit->isInvalidClass() ?>"
        data-select2-id="fmain_pa_groupsadd_x_business_unit"
        data-table="main_pa_groups"
        data-field="x_business_unit"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->business_unit->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->business_unit->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->business_unit->getPlaceHolder()) ?>"
        <?= $Page->business_unit->editAttributes() ?>>
        <?= $Page->business_unit->selectOptionListHtml("x_business_unit") ?>
    </select>
    <?= $Page->business_unit->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->business_unit->getErrorMessage() ?></div>
<?= $Page->business_unit->Lookup->getParamTag($Page, "p_x_business_unit") ?>
<script>
loadjs.ready("fmain_pa_groupsadd", function() {
    var options = { name: "x_business_unit", selectId: "fmain_pa_groupsadd_x_business_unit" };
    if (fmain_pa_groupsadd.lists.business_unit.lookupOptions.length) {
        options.data = { id: "x_business_unit", form: "fmain_pa_groupsadd" };
    } else {
        options.ajax = { id: "x_business_unit", form: "fmain_pa_groupsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.main_pa_groups.fields.business_unit.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->group_name->Visible) { // group_name ?>
    <div id="r_group_name"<?= $Page->group_name->rowAttributes() ?>>
        <label id="elh_main_pa_groups_group_name" for="x_group_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->group_name->caption() ?><?= $Page->group_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->group_name->cellAttributes() ?>>
<span id="el_main_pa_groups_group_name">
<input type="<?= $Page->group_name->getInputTextType() ?>" name="x_group_name" id="x_group_name" data-table="main_pa_groups" data-field="x_group_name" value="<?= $Page->group_name->EditValue ?>" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->group_name->getPlaceHolder()) ?>"<?= $Page->group_name->editAttributes() ?> aria-describedby="x_group_name_help">
<?= $Page->group_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->group_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("main_pa_groups_employees", explode(",", $Page->getCurrentDetailTable())) && $main_pa_groups_employees->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("main_pa_groups_employees", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "MainPaGroupsEmployeesGrid.php" ?>
<?php } ?>
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
    ew.addEventHandlers("main_pa_groups");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
