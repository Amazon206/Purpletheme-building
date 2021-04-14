<?php
global $section;
$html_item_id = $section['html_item_id'];
?>
<div class="wysiwyg-section" <?php if(trim($html_item_id)):?>id="<?php echo $html_item_id ?>"<?php endif ?>>
    <div class="container-fluid">
       <?php echo $section['content']; ?>
    </div>
</div>

