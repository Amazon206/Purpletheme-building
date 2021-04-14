<?php
global $section;

$background = $section['background'];
$title = $section['title'];
$text = $section['text'];
$button_label = $section['button_label'];
$button_url = $section['button_url'];
$max_content_width = $section['max_content_width'];

if ($background) {
    ?>
    <div class="section-hero">
        <img src="<?php echo $background['url'] ?>" alt="" />
        <div class="section-hero-floating">
            <div class="container-fluid">
                <div class="section-hero-content-top" <?php if(trim($max_content_width)):?>style="max-width:<?php echo $max_content_width ?>rem;"<?php endif ?>>
                    <h1 class="animated fadeInUp" data-delay="100"><?php echo $title ?></h1>
                    <p  class="animated fadeInUp" data-delay="200"><?php echo $text ?></p>
                </div>
                <?php if(trim($button_label)):?>
                <p class="text-center animated fadeInUp"  data-delay="300">
                    <a href="<?php echo $button_url ?>" class="the-button">
                        <?php echo $button_label ?>
                    </a>
                </p>
                <?php endif ?>
            </div>
        </div>
    </div>
    <?php
}