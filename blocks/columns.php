<?php

global $section;
$columns = $section['columns'];
if(!empty($columns)):
?>
<div class="columns-section">
    <div class="container-fluid">
        <div class="row row-spaced">
            <?php foreach($columns as $col):?>
            <div class="<?php echo $col['size'] ?>">
                <?php echo $col['content'] ?>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php endif;