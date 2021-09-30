<?php

namespace PHPMaker2022\wfg_appraisal;

// Table
$appraisal_ratings = Container("appraisal_ratings");
?>
<?php if ($appraisal_ratings->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_appraisal_ratingsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($appraisal_ratings->id->Visible) { // id ?>
        <tr id="r_id"<?= $appraisal_ratings->id->rowAttributes() ?>>
            <td class="<?= $appraisal_ratings->TableLeftColumnClass ?>"><?= $appraisal_ratings->id->caption() ?></td>
            <td<?= $appraisal_ratings->id->cellAttributes() ?>>
<span id="el_appraisal_ratings_id">
<span<?= $appraisal_ratings->id->viewAttributes() ?>>
<?= $appraisal_ratings->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($appraisal_ratings->rating->Visible) { // rating ?>
        <tr id="r_rating"<?= $appraisal_ratings->rating->rowAttributes() ?>>
            <td class="<?= $appraisal_ratings->TableLeftColumnClass ?>"><?= $appraisal_ratings->rating->caption() ?></td>
            <td<?= $appraisal_ratings->rating->cellAttributes() ?>>
<span id="el_appraisal_ratings_rating">
<span<?= $appraisal_ratings->rating->viewAttributes() ?>>
<?= $appraisal_ratings->rating->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($appraisal_ratings->created_at->Visible) { // created_at ?>
        <tr id="r_created_at"<?= $appraisal_ratings->created_at->rowAttributes() ?>>
            <td class="<?= $appraisal_ratings->TableLeftColumnClass ?>"><?= $appraisal_ratings->created_at->caption() ?></td>
            <td<?= $appraisal_ratings->created_at->cellAttributes() ?>>
<span id="el_appraisal_ratings_created_at">
<span<?= $appraisal_ratings->created_at->viewAttributes() ?>>
<?= $appraisal_ratings->created_at->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($appraisal_ratings->updated_at->Visible) { // updated_at ?>
        <tr id="r_updated_at"<?= $appraisal_ratings->updated_at->rowAttributes() ?>>
            <td class="<?= $appraisal_ratings->TableLeftColumnClass ?>"><?= $appraisal_ratings->updated_at->caption() ?></td>
            <td<?= $appraisal_ratings->updated_at->cellAttributes() ?>>
<span id="el_appraisal_ratings_updated_at">
<span<?= $appraisal_ratings->updated_at->viewAttributes() ?>>
<?= $appraisal_ratings->updated_at->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
