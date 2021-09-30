<?php

namespace PHPMaker2022\wfg_appraisal;

// Table
$main_pa_initialization = Container("main_pa_initialization");
?>
<?php if ($main_pa_initialization->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_main_pa_initializationmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($main_pa_initialization->id->Visible) { // id ?>
        <tr id="r_id"<?= $main_pa_initialization->id->rowAttributes() ?>>
            <td class="<?= $main_pa_initialization->TableLeftColumnClass ?>"><?= $main_pa_initialization->id->caption() ?></td>
            <td<?= $main_pa_initialization->id->cellAttributes() ?>>
<span id="el_main_pa_initialization_id">
<span<?= $main_pa_initialization->id->viewAttributes() ?>>
<?= $main_pa_initialization->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_initialization->business_unit->Visible) { // business_unit ?>
        <tr id="r_business_unit"<?= $main_pa_initialization->business_unit->rowAttributes() ?>>
            <td class="<?= $main_pa_initialization->TableLeftColumnClass ?>"><?= $main_pa_initialization->business_unit->caption() ?></td>
            <td<?= $main_pa_initialization->business_unit->cellAttributes() ?>>
<span id="el_main_pa_initialization_business_unit">
<span<?= $main_pa_initialization->business_unit->viewAttributes() ?>>
<?= $main_pa_initialization->business_unit->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_initialization->group_id->Visible) { // group_id ?>
        <tr id="r_group_id"<?= $main_pa_initialization->group_id->rowAttributes() ?>>
            <td class="<?= $main_pa_initialization->TableLeftColumnClass ?>"><?= $main_pa_initialization->group_id->caption() ?></td>
            <td<?= $main_pa_initialization->group_id->cellAttributes() ?>>
<span id="el_main_pa_initialization_group_id">
<span<?= $main_pa_initialization->group_id->viewAttributes() ?>>
<?= $main_pa_initialization->group_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_initialization->appraisal_mode->Visible) { // appraisal_mode ?>
        <tr id="r_appraisal_mode"<?= $main_pa_initialization->appraisal_mode->rowAttributes() ?>>
            <td class="<?= $main_pa_initialization->TableLeftColumnClass ?>"><?= $main_pa_initialization->appraisal_mode->caption() ?></td>
            <td<?= $main_pa_initialization->appraisal_mode->cellAttributes() ?>>
<span id="el_main_pa_initialization_appraisal_mode">
<span<?= $main_pa_initialization->appraisal_mode->viewAttributes() ?>>
<?= $main_pa_initialization->appraisal_mode->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_initialization->appraisal_period->Visible) { // appraisal_period ?>
        <tr id="r_appraisal_period"<?= $main_pa_initialization->appraisal_period->rowAttributes() ?>>
            <td class="<?= $main_pa_initialization->TableLeftColumnClass ?>"><?= $main_pa_initialization->appraisal_period->caption() ?></td>
            <td<?= $main_pa_initialization->appraisal_period->cellAttributes() ?>>
<span id="el_main_pa_initialization_appraisal_period">
<span<?= $main_pa_initialization->appraisal_period->viewAttributes() ?>>
<?= $main_pa_initialization->appraisal_period->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_initialization->from_year->Visible) { // from_year ?>
        <tr id="r_from_year"<?= $main_pa_initialization->from_year->rowAttributes() ?>>
            <td class="<?= $main_pa_initialization->TableLeftColumnClass ?>"><?= $main_pa_initialization->from_year->caption() ?></td>
            <td<?= $main_pa_initialization->from_year->cellAttributes() ?>>
<span id="el_main_pa_initialization_from_year">
<span<?= $main_pa_initialization->from_year->viewAttributes() ?>>
<?= $main_pa_initialization->from_year->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_initialization->to_year->Visible) { // to_year ?>
        <tr id="r_to_year"<?= $main_pa_initialization->to_year->rowAttributes() ?>>
            <td class="<?= $main_pa_initialization->TableLeftColumnClass ?>"><?= $main_pa_initialization->to_year->caption() ?></td>
            <td<?= $main_pa_initialization->to_year->cellAttributes() ?>>
<span id="el_main_pa_initialization_to_year">
<span<?= $main_pa_initialization->to_year->viewAttributes() ?>>
<?= $main_pa_initialization->to_year->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_initialization->employees_due_date->Visible) { // employees_due_date ?>
        <tr id="r_employees_due_date"<?= $main_pa_initialization->employees_due_date->rowAttributes() ?>>
            <td class="<?= $main_pa_initialization->TableLeftColumnClass ?>"><?= $main_pa_initialization->employees_due_date->caption() ?></td>
            <td<?= $main_pa_initialization->employees_due_date->cellAttributes() ?>>
<span id="el_main_pa_initialization_employees_due_date">
<span<?= $main_pa_initialization->employees_due_date->viewAttributes() ?>>
<?= $main_pa_initialization->employees_due_date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_initialization->managers_due_date->Visible) { // managers_due_date ?>
        <tr id="r_managers_due_date"<?= $main_pa_initialization->managers_due_date->rowAttributes() ?>>
            <td class="<?= $main_pa_initialization->TableLeftColumnClass ?>"><?= $main_pa_initialization->managers_due_date->caption() ?></td>
            <td<?= $main_pa_initialization->managers_due_date->cellAttributes() ?>>
<span id="el_main_pa_initialization_managers_due_date">
<span<?= $main_pa_initialization->managers_due_date->viewAttributes() ?>>
<?= $main_pa_initialization->managers_due_date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_initialization->initialize_status->Visible) { // initialize_status ?>
        <tr id="r_initialize_status"<?= $main_pa_initialization->initialize_status->rowAttributes() ?>>
            <td class="<?= $main_pa_initialization->TableLeftColumnClass ?>"><?= $main_pa_initialization->initialize_status->caption() ?></td>
            <td<?= $main_pa_initialization->initialize_status->cellAttributes() ?>>
<span id="el_main_pa_initialization_initialize_status">
<span<?= $main_pa_initialization->initialize_status->viewAttributes() ?>>
<?= $main_pa_initialization->initialize_status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_initialization->appraisal_ratings->Visible) { // appraisal_ratings ?>
        <tr id="r_appraisal_ratings"<?= $main_pa_initialization->appraisal_ratings->rowAttributes() ?>>
            <td class="<?= $main_pa_initialization->TableLeftColumnClass ?>"><?= $main_pa_initialization->appraisal_ratings->caption() ?></td>
            <td<?= $main_pa_initialization->appraisal_ratings->cellAttributes() ?>>
<span id="el_main_pa_initialization_appraisal_ratings">
<span<?= $main_pa_initialization->appraisal_ratings->viewAttributes() ?>>
<?= $main_pa_initialization->appraisal_ratings->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_initialization->createddate->Visible) { // createddate ?>
        <tr id="r_createddate"<?= $main_pa_initialization->createddate->rowAttributes() ?>>
            <td class="<?= $main_pa_initialization->TableLeftColumnClass ?>"><?= $main_pa_initialization->createddate->caption() ?></td>
            <td<?= $main_pa_initialization->createddate->cellAttributes() ?>>
<span id="el_main_pa_initialization_createddate">
<span<?= $main_pa_initialization->createddate->viewAttributes() ?>>
<?= $main_pa_initialization->createddate->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_initialization->modifieddate->Visible) { // modifieddate ?>
        <tr id="r_modifieddate"<?= $main_pa_initialization->modifieddate->rowAttributes() ?>>
            <td class="<?= $main_pa_initialization->TableLeftColumnClass ?>"><?= $main_pa_initialization->modifieddate->caption() ?></td>
            <td<?= $main_pa_initialization->modifieddate->cellAttributes() ?>>
<span id="el_main_pa_initialization_modifieddate">
<span<?= $main_pa_initialization->modifieddate->viewAttributes() ?>>
<?= $main_pa_initialization->modifieddate->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
