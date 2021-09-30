<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$MainUsersDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { main_users: currentTable } });
var currentForm, currentPageID;
var fmain_usersdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmain_usersdelete = new ew.Form("fmain_usersdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fmain_usersdelete;
    loadjs.done("fmain_usersdelete");
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
<form name="fmain_usersdelete" id="fmain_usersdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="main_users">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_main_users_id" class="main_users_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->userstatus->Visible) { // userstatus ?>
        <th class="<?= $Page->userstatus->headerCellClass() ?>"><span id="elh_main_users_userstatus" class="main_users_userstatus"><?= $Page->userstatus->caption() ?></span></th>
<?php } ?>
<?php if ($Page->firstname->Visible) { // firstname ?>
        <th class="<?= $Page->firstname->headerCellClass() ?>"><span id="elh_main_users_firstname" class="main_users_firstname"><?= $Page->firstname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lastname->Visible) { // lastname ?>
        <th class="<?= $Page->lastname->headerCellClass() ?>"><span id="elh_main_users_lastname" class="main_users_lastname"><?= $Page->lastname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->emailaddress->Visible) { // emailaddress ?>
        <th class="<?= $Page->emailaddress->headerCellClass() ?>"><span id="elh_main_users_emailaddress" class="main_users_emailaddress"><?= $Page->emailaddress->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contactnumber->Visible) { // contactnumber ?>
        <th class="<?= $Page->contactnumber->headerCellClass() ?>"><span id="elh_main_users_contactnumber" class="main_users_contactnumber"><?= $Page->contactnumber->caption() ?></span></th>
<?php } ?>
<?php if ($Page->staff_ID->Visible) { // staff_ID ?>
        <th class="<?= $Page->staff_ID->headerCellClass() ?>"><span id="elh_main_users_staff_ID" class="main_users_staff_ID"><?= $Page->staff_ID->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_main_users_id" class="el_main_users_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->userstatus->Visible) { // userstatus ?>
        <td<?= $Page->userstatus->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_users_userstatus" class="el_main_users_userstatus">
<span<?= $Page->userstatus->viewAttributes() ?>>
<?= $Page->userstatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->firstname->Visible) { // firstname ?>
        <td<?= $Page->firstname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_users_firstname" class="el_main_users_firstname">
<span<?= $Page->firstname->viewAttributes() ?>>
<?= $Page->firstname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lastname->Visible) { // lastname ?>
        <td<?= $Page->lastname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_users_lastname" class="el_main_users_lastname">
<span<?= $Page->lastname->viewAttributes() ?>>
<?= $Page->lastname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->emailaddress->Visible) { // emailaddress ?>
        <td<?= $Page->emailaddress->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_users_emailaddress" class="el_main_users_emailaddress">
<span<?= $Page->emailaddress->viewAttributes() ?>>
<?= $Page->emailaddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contactnumber->Visible) { // contactnumber ?>
        <td<?= $Page->contactnumber->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_users_contactnumber" class="el_main_users_contactnumber">
<span<?= $Page->contactnumber->viewAttributes() ?>>
<?= $Page->contactnumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->staff_ID->Visible) { // staff_ID ?>
        <td<?= $Page->staff_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_main_users_staff_ID" class="el_main_users_staff_ID">
<span<?= $Page->staff_ID->viewAttributes() ?>>
<?= $Page->staff_ID->getViewValue() ?></span>
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
