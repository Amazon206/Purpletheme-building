</div>
<?php 
$include_google_maps = get_field('include_google_maps'); 

$flexible_content = get_field('flexible_content');
if(!empty($flexible_content))
{
   
    foreach($flexible_content as $s)
    {
        if($s['acf_fc_layout']=='map')
        {
            $include_google_maps = true;
        }
    }
}

if($include_google_maps):?>
<script>
var google_maps_key = '<?php echo get_field('google_maps_key', 'option') ?>';
</script>
<?php endif ?>
<?php wp_footer() ?>
<script type="text/javascript" defer src="<?php echo get_url() ?>/js/all.js.min.js"></script>
</body>
</html>