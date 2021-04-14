<?php
global $wpdb;
?>
<?php if(isset($_POST['save'])):?>
<p class="save">The changes has been saved!</p>
<?php endif ?>
<form action="" method="post">
    <div class="one-segment">
        <label for="housetrim">Number of results from Housetrip</label>
        <input type="text" name="housetrim" id="housetrim" value="<?php echo get_field('housetrip') ?>">
    </div>
    
    <div class="one-segment">
        <label for="roomorama">Number of results from Roomorama</label>
        <input type="text" name="roomorama" id="housetrim" value="<?php echo get_field('roomorama') ?>">
    </div>
    
    <div class="one-segment">
       
        <input type="submit" name='save' value="save">
    </div>
</form>

<style>
.one-segment
{
    margin-bottom:20px;
}

.one-segment label
{
    font-weight: bold;
    display:block;
}

.save
{
    font-size:18px;
    color: #c55;
    font-weight:bold;
    margin-bottom:20px;
}

</style>