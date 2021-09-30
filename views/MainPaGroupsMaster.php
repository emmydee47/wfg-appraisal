<?php

namespace PHPMaker2022\wfg_appraisal;

// Table
$main_pa_groups = Container("main_pa_groups");
?>
<?php if ($main_pa_groups->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_main_pa_groupsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($main_pa_groups->id->Visible) { // id ?>
        <tr id="r_id"<?= $main_pa_groups->id->rowAttributes() ?>>
            <td class="<?= $main_pa_groups->TableLeftColumnClass ?>"><?= $main_pa_groups->id->caption() ?></td>
            <td<?= $main_pa_groups->id->cellAttributes() ?>>
<span id="el_main_pa_groups_id">
<span<?= $main_pa_groups->id->viewAttributes() ?>>
<?= $main_pa_groups->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_groups->business_unit->Visible) { // business_unit ?>
        <tr id="r_business_unit"<?= $main_pa_groups->business_unit->rowAttributes() ?>>
            <td class="<?= $main_pa_groups->TableLeftColumnClass ?>"><?= $main_pa_groups->business_unit->caption() ?></td>
            <td<?= $main_pa_groups->business_unit->cellAttributes() ?>>
<span id="el_main_pa_groups_business_unit">
<span<?= $main_pa_groups->business_unit->viewAttributes() ?>>
<?= $main_pa_groups->business_unit->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_groups->group_name->Visible) { // group_name ?>
        <tr id="r_group_name"<?= $main_pa_groups->group_name->rowAttributes() ?>>
            <td class="<?= $main_pa_groups->TableLeftColumnClass ?>"><?= $main_pa_groups->group_name->caption() ?></td>
            <td<?= $main_pa_groups->group_name->cellAttributes() ?>>
<span id="el_main_pa_groups_group_name">
<span<?= $main_pa_groups->group_name->viewAttributes() ?>>
<?= $main_pa_groups->group_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_groups->createddate->Visible) { // createddate ?>
        <tr id="r_createddate"<?= $main_pa_groups->createddate->rowAttributes() ?>>
            <td class="<?= $main_pa_groups->TableLeftColumnClass ?>"><?= $main_pa_groups->createddate->caption() ?></td>
            <td<?= $main_pa_groups->createddate->cellAttributes() ?>>
<span id="el_main_pa_groups_createddate">
<span<?= $main_pa_groups->createddate->viewAttributes() ?>>
<?= $main_pa_groups->createddate->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_groups->modifieddate->Visible) { // modifieddate ?>
        <tr id="r_modifieddate"<?= $main_pa_groups->modifieddate->rowAttributes() ?>>
            <td class="<?= $main_pa_groups->TableLeftColumnClass ?>"><?= $main_pa_groups->modifieddate->caption() ?></td>
            <td<?= $main_pa_groups->modifieddate->cellAttributes() ?>>
<span id="el_main_pa_groups_modifieddate">
<span<?= $main_pa_groups->modifieddate->viewAttributes() ?>>
<?= $main_pa_groups->modifieddate->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
