<?php
global $section;
$map = $section['map'];
if($map):
?>
<div id="the-map" data-lat="<?php echo $map['lat'] ?>" data-lng="<?php echo $map['lng'] ?>"></div>
<?php endif ?>