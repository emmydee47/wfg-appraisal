<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainUsersEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_users: currentTable } });
var currentForm, currentPageID;
var fmain_usersedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_usersedit = new ew.Form("fmain_usersedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fmain_usersedit;

    // Add fields
    var fields = currentTable.fields;
    fmain_usersedit.addFields([
        ["emprole", [fields.emprole.visible && fields.emprole.required ? ew.Validators.required(fields.emprole.caption) : null], fields.emprole.isInvalid],
        ["firstname", [fields.firstname.visible && fields.firstname.required ? ew.Validators.required(fields.firstname.caption) : null], fields.firstname.isInvalid],
        ["lastname", [fields.lastname.visible && fields.lastname.required ? ew.Validators.required(fields.lastname.caption) : null], fields.lastname.isInvalid],
        ["emailaddress", [fields.emailaddress.visible && fields.emailaddress.required ? ew.Validators.required(fields.emailaddress.caption) : null], fields.emailaddress.isInvalid],
        ["contactnumber", [fields.contactnumber.visible && fields.contactnumber.required ? ew.Validators.required(fields.contactnumber.caption) : null], fields.contactnumber.isInvalid],
        ["backgroundchk_status", [fields.backgroundchk_status.visible && fields.backgroundchk_status.required ? ew.Validators.required(fields.backgroundchk_status.caption) : null], fields.backgroundchk_status.isInvalid],
        ["emppassword", [fields.emppassword.visible && fields.emppassword.required ? ew.Validators.required(fields.emppassword.caption) : null], fields.emppassword.isInvalid],
        ["profileimg", [fields.profileimg.visible && fields.profileimg.required ? ew.Validators.fileRequired(fields.profileimg.caption) : null], fields.profileimg.isInvalid]
    ]);

    // Form_CustomValidate
    fmain_usersedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmain_usersedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fmain_usersedit.lists.emprole = <?= $Page->emprole->toClientList($Page) ?>;
    fmain_usersedit.lists.backgroundchk_status = <?= $Page->backgroundchk_status->toClientList($Page) ?>;
    loadjs.done("fmain_usersedit");
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
<form name="fmain_usersedit" id="fmain_usersedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_users">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->emprole->Visible) { // emprole ?>
    <div id="r_emprole"<?= $Page->emprole->rowAttributes() ?>>
        <label id="elh_main_users_emprole" for="x_emprole" class="<?= $Page->LeftColumnClass ?>"><?= $Page->emprole->caption() ?><?= $Page->emprole->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->emprole->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_main_users_emprole">
<span class="form-control-plaintext"><?= $Page->emprole->getDisplayValue($Page->emprole->EditValue) ?></span>
</span>
<?php } else { ?>
<span id="el_main_users_emprole">
    <select
        id="x_emprole"
        name="x_emprole"
        class="form-select ew-select<?= $Page->emprole->isInvalidClass() ?>"
        data-select2-id="fmain_usersedit_x_emprole"
        data-table="main_users"
        data-field="x_emprole"
        data-value-separator="<?= $Page->emprole->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->emprole->getPlaceHolder()) ?>"
        <?= $Page->emprole->editAttributes() ?>>
        <?= $Page->emprole->selectOptionListHtml("x_emprole") ?>
    </select>
    <?= $Page->emprole->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->emprole->getErrorMessage() ?></div>
<?= $Page->emprole->Lookup->getParamTag($Page, "p_x_emprole") ?>
<script>
loadjs.ready("fmain_usersedit", function() {
    var options = { name: "x_emprole", selectId: "fmain_usersedit_x_emprole" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fmain_usersedit.lists.emprole.lookupOptions.length) {
        options.data = { id: "x_emprole", form: "fmain_usersedit" };
    } else {
        options.ajax = { id: "x_emprole", form: "fmain_usersedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.main_users.fields.emprole.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->firstname->Visible) { // firstname ?>
    <div id="r_firstname"<?= $Page->firstname->rowAttributes() ?>>
        <label id="elh_main_users_firstname" for="x_firstname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->firstname->caption() ?><?= $Page->firstname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->firstname->cellAttributes() ?>>
<span id="el_main_users_firstname">
<input type="<?= $Page->firstname->getInputTextType() ?>" name="x_firstname" id="x_firstname" data-table="main_users" data-field="x_firstname" value="<?= $Page->firstname->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->firstname->getPlaceHolder()) ?>"<?= $Page->firstname->editAttributes() ?> aria-describedby="x_firstname_help">
<?= $Page->firstname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->firstname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lastname->Visible) { // lastname ?>
    <div id="r_lastname"<?= $Page->lastname->rowAttributes() ?>>
        <label id="elh_main_users_lastname" for="x_lastname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lastname->caption() ?><?= $Page->lastname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lastname->cellAttributes() ?>>
<span id="el_main_users_lastname">
<input type="<?= $Page->lastname->getInputTextType() ?>" name="x_lastname" id="x_lastname" data-table="main_users" data-field="x_lastname" value="<?= $Page->lastname->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->lastname->getPlaceHolder()) ?>"<?= $Page->lastname->editAttributes() ?> aria-describedby="x_lastname_help">
<?= $Page->lastname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lastname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->emailaddress->Visible) { // emailaddress ?>
    <div id="r_emailaddress"<?= $Page->emailaddress->rowAttributes() ?>>
        <label id="elh_main_users_emailaddress" for="x_emailaddress" class="<?= $Page->LeftColumnClass ?>"><?= $Page->emailaddress->caption() ?><?= $Page->emailaddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->emailaddress->cellAttributes() ?>>
<span id="el_main_users_emailaddress">
<input type="<?= $Page->emailaddress->getInputTextType() ?>" name="x_emailaddress" id="x_emailaddress" data-table="main_users" data-field="x_emailaddress" value="<?= $Page->emailaddress->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->emailaddress->getPlaceHolder()) ?>"<?= $Page->emailaddress->editAttributes() ?> aria-describedby="x_emailaddress_help">
<?= $Page->emailaddress->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->emailaddress->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contactnumber->Visible) { // contactnumber ?>
    <div id="r_contactnumber"<?= $Page->contactnumber->rowAttributes() ?>>
        <label id="elh_main_users_contactnumber" for="x_contactnumber" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contactnumber->caption() ?><?= $Page->contactnumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contactnumber->cellAttributes() ?>>
<span id="el_main_users_contactnumber">
<input type="<?= $Page->contactnumber->getInputTextType() ?>" name="x_contactnumber" id="x_contactnumber" data-table="main_users" data-field="x_contactnumber" value="<?= $Page->contactnumber->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->contactnumber->getPlaceHolder()) ?>"<?= $Page->contactnumber->editAttributes() ?> aria-describedby="x_contactnumber_help">
<?= $Page->contactnumber->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contactnumber->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->backgroundchk_status->Visible) { // backgroundchk_status ?>
    <div id="r_backgroundchk_status"<?= $Page->backgroundchk_status->rowAttributes() ?>>
        <label id="elh_main_users_backgroundchk_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->backgroundchk_status->caption() ?><?= $Page->backgroundchk_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->backgroundchk_status->cellAttributes() ?>>
<span id="el_main_users_backgroundchk_status">
<template id="tp_x_backgroundchk_status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="main_users" data-field="x_backgroundchk_status" name="x_backgroundchk_status" id="x_backgroundchk_status"<?= $Page->backgroundchk_status->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_backgroundchk_status" class="ew-item-list"></div>
<selection-list hidden
    id="x_backgroundchk_status"
    name="x_backgroundchk_status"
    value="<?= HtmlEncode($Page->backgroundchk_status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_backgroundchk_status"
    data-bs-target="dsl_x_backgroundchk_status"
    data-repeatcolumn="5"
    class="form-control<?= $Page->backgroundchk_status->isInvalidClass() ?>"
    data-table="main_users"
    data-field="x_backgroundchk_status"
    data-value-separator="<?= $Page->backgroundchk_status->displayValueSeparatorAttribute() ?>"
    <?= $Page->backgroundchk_status->editAttributes() ?>></selection-list>
<?= $Page->backgroundchk_status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->backgroundchk_status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->emppassword->Visible) { // emppassword ?>
    <div id="r_emppassword"<?= $Page->emppassword->rowAttributes() ?>>
        <label id="elh_main_users_emppassword" for="x_emppassword" class="<?= $Page->LeftColumnClass ?>"><?= $Page->emppassword->caption() ?><?= $Page->emppassword->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->emppassword->cellAttributes() ?>>
<span id="el_main_users_emppassword">
<input type="<?= $Page->emppassword->getInputTextType() ?>" name="x_emppassword" id="x_emppassword" data-table="main_users" data-field="x_emppassword" value="<?= $Page->emppassword->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->emppassword->getPlaceHolder()) ?>"<?= $Page->emppassword->editAttributes() ?> aria-describedby="x_emppassword_help">
<?= $Page->emppassword->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->emppassword->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->profileimg->Visible) { // profileimg ?>
    <div id="r_profileimg"<?= $Page->profileimg->rowAttributes() ?>>
        <label id="elh_main_users_profileimg" class="<?= $Page->LeftColumnClass ?>"><?= $Page->profileimg->caption() ?><?= $Page->profileimg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->profileimg->cellAttributes() ?>>
<span id="el_main_users_profileimg">
<div id="fd_x_profileimg" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->profileimg->title() ?>" data-table="main_users" data-field="x_profileimg" name="x_profileimg" id="x_profileimg" lang="<?= CurrentLanguageID() ?>"<?= $Page->profileimg->editAttributes() ?> aria-describedby="x_profileimg_help"<?= ($Page->profileimg->ReadOnly || $Page->profileimg->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->profileimg->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->profileimg->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_profileimg" id= "fn_x_profileimg" value="<?= $Page->profileimg->Upload->FileName ?>">
<input type="hidden" name="fa_x_profileimg" id= "fa_x_profileimg" value="<?= (Post("fa_x_profileimg") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_profileimg" id= "fs_x_profileimg" value="255">
<input type="hidden" name="fx_x_profileimg" id= "fx_x_profileimg" value="<?= $Page->profileimg->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_profileimg" id= "fm_x_profileimg" value="<?= $Page->profileimg->UploadMaxFileSize ?>">
<table id="ft_x_profileimg" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="main_users" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("main_users");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
