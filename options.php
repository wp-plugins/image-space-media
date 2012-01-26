<div class="wrap">
<h2>Image Space Media v. <?php global $ismversion; echo $ismversion; ?></h2>
<form method="post" action="options.php">
<div id="poststuff">
<div id="post-body">
<div class="postbox" id="1"> 
<h3 class='hndle'><span>Image Space Media settings</span></h3>
<div class="inside"> 

<?php wp_nonce_field('update-options'); ?>
<?php settings_fields('ism'); ?>

<table class="form-table" style="margin-top: 0; clear:none;">
<tr valign="top">
<th scope="row"><b>Ad Trigger:</b></th>
<td>
  <select name="adtrigger">
    <option value="imagefocus"  <?php if (get_option('adtrigger') == 'imagefocus') echo "selected=selected" ?>>image focus</option>
    <option value="mouseover" <?php if (get_option('adtrigger') == 'mouseover') echo "selected=selected" ?>>mouse over</option>
  </select>
</td>
</tr><tr valign="top">

</table>
</div>
</div>

<input type="hidden" name="action" value="update" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</div>
</div>
</form>
</div>
