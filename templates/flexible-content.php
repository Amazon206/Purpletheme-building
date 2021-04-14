<?php

/* 
 * Template Name: Flexible Content
 */


get_header(); 
$flexible_content = get_field('flexible_content');

if(!empty($flexible_content))
{
    global $section;
    foreach($flexible_content as $s)
    {
        $section = $s;
        get_template_part('blocks/'.$section['acf_fc_layout']);
    }
}

get_footer(); 