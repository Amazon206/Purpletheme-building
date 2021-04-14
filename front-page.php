<?php
get_header();
the_post();

$hero_picture = get_field('hero_picture');
$hero_title = get_field('hero_title');
$hero_text = get_field('hero_text');

get_template_part('partials/lottie-script');
?>

<div id="page-hero">
    <div class="container-fluid">
        <div class="row row-spaced">
            <div class="col-sm-6 align-middle">
                <div>
                    <h1>
                        <?php echo $hero_title ?>
                    </h1>
                    <p>
                        <?php echo $hero_text ?>
                    </p>
                    <p>
                        <a id="hiw-link" href="#how-it-works">
                            See How It Works
                            <img src="<?php echo get_url() ?>/images/see-how-it-works.png" alt="" />
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-sm-6 align-middle">
                <div>
                    <div id="lottie"></div>    
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$s2_text = get_field('s2_text');

if (trim($s2_text)) {
    ?>

    <div id="section-2-content">
        <div class="container-fluid">
            <div id="s2-box">
                <?php echo $s2_text ?>
            </div>
        </div>
    </div>
    <?php
}

$hiw_title = get_field('hiw_title');
$how_it_works = get_field('how_it_works');


if (!empty($how_it_works)) {
    ?>
<a id="how-it-works"></a>
    <div id="section-3-home">
        <div class="container-fluid">
            <h2>
                <?php echo $hiw_title ?>
            </h2>
            <div class="row row-spaced">
                <?php
                foreach ($how_it_works as $key => $single_how_it_works) {
                    $icon = $single_how_it_works['icon'];
                    $sign_after = $single_how_it_works['sign_after'];
                    $text = $single_how_it_works['text'];
                    ?>
                    <div class="col-sm-3">
                        <div class="one-s3">
                            <p class="one-s3-icon">
                                <?php if ($icon): ?>
                                    <img src="<?php echo $icon['url'] ?>" alt="" class="img-fluid" />
                                <?php endif ?>
                            </p>
                            <p class="one-s3-text">
                                <?php echo $text ?>
                            </p>

                            <?php if ($sign_after): ?>
                                <div class="one-s3-sign-after">
                                    <img src="<?php echo $sign_after['url'] ?>" alt="" />
                                </div>
                            <?php endif ?>

                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}


$section_4_content = get_field('section_4_content');

if (!empty($section_4_content)) {
    ?>
    <div id="section-4-home">
        <div class="container-fluid">
            <?php
            foreach ($section_4_content as $key => $single_section_4_content) {
                $picture = $single_section_4_content['picture'];
                $title = $single_section_4_content['title'];
                $text = $single_section_4_content['text'];
                ?>
                <div class="one-section-4">
                    <div class="row row-spaced">
                        <div class="col-sm-3">
                            <?php if ($picture): ?>
                                <img src="<?php echo $picture['url'] ?>" alt="" class="img-fluid" />
                            <?php endif ?>
                        </div>
                        <div class="col-sm-9 align-center">
                            <div>
                                <h3>
                                    <?php echo $title ?>
                                </h3>
                                <p>
                                    <?php echo $text ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}

$s5_picture = get_field('s5_picture');
$s5_content = get_field('s5_content');


if (!empty($s5_content)) {
    ?>
    <div id="section-5-home">
        <div id="floating-triangle">
            <img src="<?php echo get_url() ?>/images/tirangle-cover.png" alt="" class="img-fluid" />
        </div>
        <div class="container-fluid">
            <div class="row row-spaced">
                <div class="col-sm-6 align-middle">
                    <div>
                        <?php
                        foreach ($s5_content as $key => $single_s5_content) {
                            $picture = $single_s5_content['picture'];
                            $title = $single_s5_content['title'];
                            $text = $single_s5_content['text'];
                            ?>
                            <div class="one-section-5">
                                <h3>
                                    <?php echo $title ?>
                                </h3>
                                <p>
                                    <?php echo $text ?>
                                </p>
                                <?php if ($picture): ?>
                                    <p>
                                        <img src="<?php echo $picture['url'] ?>" alt="" class="img-fluid" />
                                    </p>
                                <?php endif ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-sm-6 align-middle">
                    <?php if ($s5_picture): ?>
                        <img src="<?php echo $s5_picture['url'] ?>" alt="" class="img-fluid" />
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

$con_title = get_field('con_title');
$con_text = get_field('con_text');
$con_picture = get_field('con_picture');
$con_form_shortcode = get_field('con_form_shortcode');
?>
<div id="contact-us-section">
    <div class="container-fluid">
        <div id="the-contact-section">
            <div id="the-contact-top">
                <div>
                    <h3><?php echo $con_title ?></h3>
                    <p><?php echo $con_text ?></p>
                </div>
                <div>
                    <?php if($con_picture ):?>
                    <img src="<?php echo $con_picture['url']  ?>" alt="" class="img-fluid" />
                    <?php endif ?>
                </div>
            </div>
            <div id="the-contact-form">
                <?php echo do_shortcode($con_form_shortcode);?>
            </div>
        </div>
    </div>
</div>
<script>

<?php
$json = file_get_contents(dirname(__FILE__) . '/lottie/data.json');
$json = str_replace('"images/"', '"' . get_url() . '/lottie/images/"', $json);
?>

    var animationData = <?php echo $json ?>;
    var params = {
        container: document.getElementById('lottie'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        animationData: animationData
    };

    var anim;

    anim = lottie.loadAnimation(params);
</script>
<?php
get_footer();

