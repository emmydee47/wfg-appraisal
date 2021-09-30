<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainUsersView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_users: currentTable } });
var currentForm, currentPageID;
var fmain_usersview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_usersview = new ew.Form("fmain_usersview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fmain_usersview;
    loadjs.done("fmain_usersview");
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
<form name="fmain_usersview" id="fmain_usersview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_users">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_main_users_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->emprole->Visible) { // emprole ?>
    <tr id="r_emprole"<?= $Page->emprole->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_emprole"><?= $Page->emprole->caption() ?></span></td>
        <td data-name="emprole"<?= $Page->emprole->cellAttributes() ?>>
<span id="el_main_users_emprole">
<span<?= $Page->emprole->viewAttributes() ?>>
<?= $Page->emprole->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->userstatus->Visible) { // userstatus ?>
    <tr id="r_userstatus"<?= $Page->userstatus->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_userstatus"><?= $Page->userstatus->caption() ?></span></td>
        <td data-name="userstatus"<?= $Page->userstatus->cellAttributes() ?>>
<span id="el_main_users_userstatus">
<span<?= $Page->userstatus->viewAttributes() ?>>
<?= $Page->userstatus->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->firstname->Visible) { // firstname ?>
    <tr id="r_firstname"<?= $Page->firstname->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_firstname"><?= $Page->firstname->caption() ?></span></td>
        <td data-name="firstname"<?= $Page->firstname->cellAttributes() ?>>
<span id="el_main_users_firstname">
<span<?= $Page->firstname->viewAttributes() ?>>
<?= $Page->firstname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lastname->Visible) { // lastname ?>
    <tr id="r_lastname"<?= $Page->lastname->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_lastname"><?= $Page->lastname->caption() ?></span></td>
        <td data-name="lastname"<?= $Page->lastname->cellAttributes() ?>>
<span id="el_main_users_lastname">
<span<?= $Page->lastname->viewAttributes() ?>>
<?= $Page->lastname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->userfullname->Visible) { // userfullname ?>
    <tr id="r_userfullname"<?= $Page->userfullname->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_userfullname"><?= $Page->userfullname->caption() ?></span></td>
        <td data-name="userfullname"<?= $Page->userfullname->cellAttributes() ?>>
<span id="el_main_users_userfullname">
<span<?= $Page->userfullname->viewAttributes() ?>>
<?= $Page->userfullname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->emailaddress->Visible) { // emailaddress ?>
    <tr id="r_emailaddress"<?= $Page->emailaddress->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_emailaddress"><?= $Page->emailaddress->caption() ?></span></td>
        <td data-name="emailaddress"<?= $Page->emailaddress->cellAttributes() ?>>
<span id="el_main_users_emailaddress">
<span<?= $Page->emailaddress->viewAttributes() ?>>
<?= $Page->emailaddress->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contactnumber->Visible) { // contactnumber ?>
    <tr id="r_contactnumber"<?= $Page->contactnumber->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_contactnumber"><?= $Page->contactnumber->caption() ?></span></td>
        <td data-name="contactnumber"<?= $Page->contactnumber->cellAttributes() ?>>
<span id="el_main_users_contactnumber">
<span<?= $Page->contactnumber->viewAttributes() ?>>
<?= $Page->contactnumber->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->empipaddress->Visible) { // empipaddress ?>
    <tr id="r_empipaddress"<?= $Page->empipaddress->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_empipaddress"><?= $Page->empipaddress->caption() ?></span></td>
        <td data-name="empipaddress"<?= $Page->empipaddress->cellAttributes() ?>>
<span id="el_main_users_empipaddress">
<span<?= $Page->empipaddress->viewAttributes() ?>>
<?= $Page->empipaddress->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->backgroundchk_status->Visible) { // backgroundchk_status ?>
    <tr id="r_backgroundchk_status"<?= $Page->backgroundchk_status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_backgroundchk_status"><?= $Page->backgroundchk_status->caption() ?></span></td>
        <td data-name="backgroundchk_status"<?= $Page->backgroundchk_status->cellAttributes() ?>>
<span id="el_main_users_backgroundchk_status">
<span<?= $Page->backgroundchk_status->viewAttributes() ?>>
<?= $Page->backgroundchk_status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->emptemplock->Visible) { // emptemplock ?>
    <tr id="r_emptemplock"<?= $Page->emptemplock->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_emptemplock"><?= $Page->emptemplock->caption() ?></span></td>
        <td data-name="emptemplock"<?= $Page->emptemplock->cellAttributes() ?>>
<span id="el_main_users_emptemplock">
<span<?= $Page->emptemplock->viewAttributes() ?>>
<?= $Page->emptemplock->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->empreasonlocked->Visible) { // empreasonlocked ?>
    <tr id="r_empreasonlocked"<?= $Page->empreasonlocked->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_empreasonlocked"><?= $Page->empreasonlocked->caption() ?></span></td>
        <td data-name="empreasonlocked"<?= $Page->empreasonlocked->cellAttributes() ?>>
<span id="el_main_users_empreasonlocked">
<span<?= $Page->empreasonlocked->viewAttributes() ?>>
<?= $Page->empreasonlocked->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->emplockeddate->Visible) { // emplockeddate ?>
    <tr id="r_emplockeddate"<?= $Page->emplockeddate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_emplockeddate"><?= $Page->emplockeddate->caption() ?></span></td>
        <td data-name="emplockeddate"<?= $Page->emplockeddate->cellAttributes() ?>>
<span id="el_main_users_emplockeddate">
<span<?= $Page->emplockeddate->viewAttributes() ?>>
<?= $Page->emplockeddate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->emppassword->Visible) { // emppassword ?>
    <tr id="r_emppassword"<?= $Page->emppassword->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_emppassword"><?= $Page->emppassword->caption() ?></span></td>
        <td data-name="emppassword"<?= $Page->emppassword->cellAttributes() ?>>
<span id="el_main_users_emppassword">
<span<?= $Page->emppassword->viewAttributes() ?>>
<?= $Page->emppassword->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->createdby->Visible) { // createdby ?>
    <tr id="r_createdby"<?= $Page->createdby->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_createdby"><?= $Page->createdby->caption() ?></span></td>
        <td data-name="createdby"<?= $Page->createdby->cellAttributes() ?>>
<span id="el_main_users_createdby">
<span<?= $Page->createdby->viewAttributes() ?>>
<?= $Page->createdby->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modifiedby->Visible) { // modifiedby ?>
    <tr id="r_modifiedby"<?= $Page->modifiedby->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_modifiedby"><?= $Page->modifiedby->caption() ?></span></td>
        <td data-name="modifiedby"<?= $Page->modifiedby->cellAttributes() ?>>
<span id="el_main_users_modifiedby">
<span<?= $Page->modifiedby->viewAttributes() ?>>
<?= $Page->modifiedby->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->createddate->Visible) { // createddate ?>
    <tr id="r_createddate"<?= $Page->createddate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_createddate"><?= $Page->createddate->caption() ?></span></td>
        <td data-name="createddate"<?= $Page->createddate->cellAttributes() ?>>
<span id="el_main_users_createddate">
<span<?= $Page->createddate->viewAttributes() ?>>
<?= $Page->createddate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modifieddate->Visible) { // modifieddate ?>
    <tr id="r_modifieddate"<?= $Page->modifieddate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_modifieddate"><?= $Page->modifieddate->caption() ?></span></td>
        <td data-name="modifieddate"<?= $Page->modifieddate->cellAttributes() ?>>
<span id="el_main_users_modifieddate">
<span<?= $Page->modifieddate->viewAttributes() ?>>
<?= $Page->modifieddate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->isactive->Visible) { // isactive ?>
    <tr id="r_isactive"<?= $Page->isactive->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_isactive"><?= $Page->isactive->caption() ?></span></td>
        <td data-name="isactive"<?= $Page->isactive->cellAttributes() ?>>
<span id="el_main_users_isactive">
<span<?= $Page->isactive->viewAttributes() ?>>
<?= $Page->isactive->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->staff_ID->Visible) { // staff_ID ?>
    <tr id="r_staff_ID"<?= $Page->staff_ID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_staff_ID"><?= $Page->staff_ID->caption() ?></span></td>
        <td data-name="staff_ID"<?= $Page->staff_ID->cellAttributes() ?>>
<span id="el_main_users_staff_ID">
<span<?= $Page->staff_ID->viewAttributes() ?>>
<?= $Page->staff_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->modeofentry->Visible) { // modeofentry ?>
    <tr id="r_modeofentry"<?= $Page->modeofentry->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_modeofentry"><?= $Page->modeofentry->caption() ?></span></td>
        <td data-name="modeofentry"<?= $Page->modeofentry->cellAttributes() ?>>
<span id="el_main_users_modeofentry">
<span<?= $Page->modeofentry->viewAttributes() ?>>
<?= $Page->modeofentry->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->other_modeofentry->Visible) { // other_modeofentry ?>
    <tr id="r_other_modeofentry"<?= $Page->other_modeofentry->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_other_modeofentry"><?= $Page->other_modeofentry->caption() ?></span></td>
        <td data-name="other_modeofentry"<?= $Page->other_modeofentry->cellAttributes() ?>>
<span id="el_main_users_other_modeofentry">
<span<?= $Page->other_modeofentry->viewAttributes() ?>>
<?= $Page->other_modeofentry->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->entrycomments->Visible) { // entrycomments ?>
    <tr id="r_entrycomments"<?= $Page->entrycomments->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_entrycomments"><?= $Page->entrycomments->caption() ?></span></td>
        <td data-name="entrycomments"<?= $Page->entrycomments->cellAttributes() ?>>
<span id="el_main_users_entrycomments">
<span<?= $Page->entrycomments->viewAttributes() ?>>
<?= $Page->entrycomments->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->selecteddate->Visible) { // selecteddate ?>
    <tr id="r_selecteddate"<?= $Page->selecteddate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_selecteddate"><?= $Page->selecteddate->caption() ?></span></td>
        <td data-name="selecteddate"<?= $Page->selecteddate->cellAttributes() ?>>
<span id="el_main_users_selecteddate">
<span<?= $Page->selecteddate->viewAttributes() ?>>
<?= $Page->selecteddate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->company_id->Visible) { // company_id ?>
    <tr id="r_company_id"<?= $Page->company_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_company_id"><?= $Page->company_id->caption() ?></span></td>
        <td data-name="company_id"<?= $Page->company_id->cellAttributes() ?>>
<span id="el_main_users_company_id">
<span<?= $Page->company_id->viewAttributes() ?>>
<?= $Page->company_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->profileimg->Visible) { // profileimg ?>
    <tr id="r_profileimg"<?= $Page->profileimg->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_profileimg"><?= $Page->profileimg->caption() ?></span></td>
        <td data-name="profileimg"<?= $Page->profileimg->cellAttributes() ?>>
<span id="el_main_users_profileimg">
<span>
<?= GetFileViewTag($Page->profileimg, $Page->profileimg->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jobtitle_id->Visible) { // jobtitle_id ?>
    <tr id="r_jobtitle_id"<?= $Page->jobtitle_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_jobtitle_id"><?= $Page->jobtitle_id->caption() ?></span></td>
        <td data-name="jobtitle_id"<?= $Page->jobtitle_id->cellAttributes() ?>>
<span id="el_main_users_jobtitle_id">
<span<?= $Page->jobtitle_id->viewAttributes() ?>>
<?= $Page->jobtitle_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tourflag->Visible) { // tourflag ?>
    <tr id="r_tourflag"<?= $Page->tourflag->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_tourflag"><?= $Page->tourflag->caption() ?></span></td>
        <td data-name="tourflag"<?= $Page->tourflag->cellAttributes() ?>>
<span id="el_main_users_tourflag">
<span<?= $Page->tourflag->viewAttributes() ?>>
<?= $Page->tourflag->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->themes->Visible) { // themes ?>
    <tr id="r_themes"<?= $Page->themes->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_themes"><?= $Page->themes->caption() ?></span></td>
        <td data-name="themes"<?= $Page->themes->cellAttributes() ?>>
<span id="el_main_users_themes">
<span<?= $Page->themes->viewAttributes() ?>>
<?= $Page->themes->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->is_admin->Visible) { // is_admin ?>
    <tr id="r_is_admin"<?= $Page->is_admin->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_is_admin"><?= $Page->is_admin->caption() ?></span></td>
        <td data-name="is_admin"<?= $Page->is_admin->cellAttributes() ?>>
<span id="el_main_users_is_admin">
<span<?= $Page->is_admin->viewAttributes() ?>>
<?= $Page->is_admin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->role_id->Visible) { // role_id ?>
    <tr id="r_role_id"<?= $Page->role_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_main_users_role_id"><?= $Page->role_id->caption() ?></span></td>
        <td data-name="role_id"<?= $Page->role_id->cellAttributes() ?>>
<span id="el_main_users_role_id">
<span<?= $Page->role_id->viewAttributes() ?>>
<?= $Page->role_id->getViewValue() ?></span>
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
