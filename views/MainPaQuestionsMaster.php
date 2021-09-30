<?php

namespace PHPMaker2022\wfg_appraisal;

// Table
$main_pa_questions = Container("main_pa_questions");
?>
<?php if ($main_pa_questions->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_main_pa_questionsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($main_pa_questions->id->Visible) { // id ?>
        <tr id="r_id"<?= $main_pa_questions->id->rowAttributes() ?>>
            <td class="<?= $main_pa_questions->TableLeftColumnClass ?>"><?= $main_pa_questions->id->caption() ?></td>
            <td<?= $main_pa_questions->id->cellAttributes() ?>>
<span id="el_main_pa_questions_id">
<span<?= $main_pa_questions->id->viewAttributes() ?>>
<?= $main_pa_questions->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_questions->group->Visible) { // group ?>
        <tr id="r_group"<?= $main_pa_questions->group->rowAttributes() ?>>
            <td class="<?= $main_pa_questions->TableLeftColumnClass ?>"><?= $main_pa_questions->group->caption() ?></td>
            <td<?= $main_pa_questions->group->cellAttributes() ?>>
<span id="el_main_pa_questions_group">
<span<?= $main_pa_questions->group->viewAttributes() ?>>
<?= $main_pa_questions->group->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_questions->question->Visible) { // question ?>
        <tr id="r_question"<?= $main_pa_questions->question->rowAttributes() ?>>
            <td class="<?= $main_pa_questions->TableLeftColumnClass ?>"><?= $main_pa_questions->question->caption() ?></td>
            <td<?= $main_pa_questions->question->cellAttributes() ?>>
<span id="el_main_pa_questions_question">
<span<?= $main_pa_questions->question->viewAttributes() ?>>
<?= $main_pa_questions->question->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_questions->description->Visible) { // description ?>
        <tr id="r_description"<?= $main_pa_questions->description->rowAttributes() ?>>
            <td class="<?= $main_pa_questions->TableLeftColumnClass ?>"><?= $main_pa_questions->description->caption() ?></td>
            <td<?= $main_pa_questions->description->cellAttributes() ?>>
<span id="el_main_pa_questions_description">
<span<?= $main_pa_questions->description->viewAttributes() ?>>
<?= $main_pa_questions->description->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_questions->created_date->Visible) { // created_date ?>
        <tr id="r_created_date"<?= $main_pa_questions->created_date->rowAttributes() ?>>
            <td class="<?= $main_pa_questions->TableLeftColumnClass ?>"><?= $main_pa_questions->created_date->caption() ?></td>
            <td<?= $main_pa_questions->created_date->cellAttributes() ?>>
<span id="el_main_pa_questions_created_date">
<span<?= $main_pa_questions->created_date->viewAttributes() ?>>
<?= $main_pa_questions->created_date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($main_pa_questions->modified_date->Visible) { // modified_date ?>
        <tr id="r_modified_date"<?= $main_pa_questions->modified_date->rowAttributes() ?>>
            <td class="<?= $main_pa_questions->TableLeftColumnClass ?>"><?= $main_pa_questions->modified_date->caption() ?></td>
            <td<?= $main_pa_questions->modified_date->cellAttributes() ?>>
<span id="el_main_pa_questions_modified_date">
<span<?= $main_pa_questions->modified_date->viewAttributes() ?>>
<?= $main_pa_questions->modified_date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
