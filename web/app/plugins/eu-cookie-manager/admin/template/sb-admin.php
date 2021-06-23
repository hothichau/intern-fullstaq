<?php
global $sb_eucookie;
$sb_lang = $sb_eucookie->sb_lang;
?>
<div class="wrap">       
	<h1>EU Cookie Manager</h1>      
	<form method="post" action="options.php">
		<?php 
		settings_fields('sb_cookie_options');                
		$options = get_option('sb_cookie_data_'.$sb_lang);
		if(!empty($options['outcss'])) {
			$options['backgroundcolor'] = '';
			$options['fontcolor'] = '';
		}
		?>
		<table class="form-table">				
			<tr valign="top"><th scope="row"><label for="autoblock"><?php esc_html_e('Auto Block', 'sb-cookies'); ?></label></th>
				<td><input id="autoblock" name="sb_cookie_data_<?php echo esc_attr($sb_lang); ?>[autoblock]" type="checkbox" value="1" <?php checked('1', esc_attr(@$options['autoblock'])); ?> /><br>
					<small><?php esc_html_e('With this activated, Iframes and embedded scripts will not work anymore as long as cookies are not accepted. This is to prevent cookies from other sources to be placed via this website.', 'sb-cookies'); ?></small>                    
				</td>
			</tr>  
		</table>
		<hr>
		<h3 class="title"><?php esc_html_e('Appearance'); ?></h3>
		<table class="form-table">
			<tr><th scope="row"><label for="outcss">
				<?php esc_html_e('Custom CSS', 'sb-cookies'); ?></label></th>
				
				<td><input id="outcss" type="checkbox" name="sb_cookie_data_<?php echo $sb_lang; ?>[outcss]" value="1" <?php checked('1', esc_attr(@$options['outcss'])); ?>></td>
			</tr>
			
			<tr valign="top" class="inner_css" style="display: <?php echo empty($options['outcss'])?'table-row':'none'?>"><th scope="row"><label for="position"><?php esc_html_e('Position', 'sb-cookies'); ?></label></th>
				
				<td>
					<select name="sb_cookie_data_<?php echo esc_attr($sb_lang); ?>[position]">							 
						<option value="sb_cookie_top"<?php if (@$options['position'] == 'sb_cookie_top') { echo ' selected="selected"'; } ?>>
							<?php esc_html_e('Top Center', 'sb-cookies'); ?></option>							 
							<option value="sb_cookie_bottom"<?php if (@$options['position'] == 'sb_cookie_bottom' || empty(@$options['position'])) { echo ' selected="selected"'; } ?>>
								<?php esc_html_e('Bottom Center', 'sb-cookies'); ?></option>
							</select>
						</td>
					</tr>
					
					<tr valign="top" class="inner_css" style="display: <?php echo empty($options['outcss'])?'table-row':'none'?>"><th scope="row"><label for="backgroundcolor">
						<?php esc_html_e('Background Color', 'sb-cookies'); ?></label></th>
						<td><input id="backgroundcolor" type="text" name="sb_cookie_data_<?php echo esc_attr($sb_lang); ?>[backgroundcolor]" value="<?php echo esc_attr(@$options['backgroundcolor']); ?>" class="color-field" data-default-color="#000000"/></td>
					</tr>
					<tr valign="top" class="inner_css" style="display: <?php echo empty($options['outcss'])?'table-row':'none'?>"><th scope="row"><label for="fontcolor">
						<?php esc_html_e('Font Color', 'sb-cookies'); ?></label></th>
						<td><input id="fontcolor" type="text" name="sb_cookie_data_<?php echo esc_attr($sb_lang); ?>[fontcolor]" value="<?php echo esc_attr(@$options['fontcolor']); ?>"  class="color-field" data-default-color="#ffffff"/></td>
					</tr>
					
				</table>
				<hr>
				<h3 class="title"><?php esc_html_e('Content'); ?></h3>
				<table class="form-table">
					<tr valign="top"><th scope="row"><label for="barmessage">
						<?php esc_html_e('Bar Message', 'sb-cookies'); ?></label></th>
						<td>
							<textarea style='font-size: 90%; width:95%;' name='sb_cookie_data_<?php echo esc_attr($sb_lang); ?>[barmessage]' id='boxcontent' rows='9' ><?php echo esc_textarea( @$options['barmessage'] ); ?></textarea>					
						</td>
					</tr>				
					<tr valign="top"><th scope="row"><label for="barbutton">
						<?php esc_html_e('Accept Text', 'sb-cookies'); ?></label></th>
						<td><input id="barbutton" type="text" name="sb_cookie_data_<?php echo esc_attr($sb_lang); ?>[barbutton]" value="<?php echo esc_attr(@$options['barbutton']); ?>" />  <small>Default: Accept</small></td>
					</tr>  
					<tr valign="top"><th scope="row"><label for="denybutton">
						<?php esc_html_e('Deny Text', 'sb-cookies'); ?></label></th>
						<td><input id="denybutton" type="text" name="sb_cookie_data_<?php echo esc_attr($sb_lang); ?>[denybutton]" value="<?php echo esc_attr( @$options['denybutton'] ); ?>" /></td>
					</tr>
					<tr valign="top"><th scope="row"><label for="barlink">
						<?php esc_html_e('More Info Text', 'sb-cookies'); ?></label></th>
						<td><input id="barlink" type="text" name="sb_cookie_data_<?php echo esc_attr($sb_lang); ?>[barlink]" value="<?php echo esc_attr( @$options['barlink'] ); ?>" /></td>
					</tr> 
					<tr valign="top"><th scope="row"><label for="customurl">
						<?php esc_html_e('Custom URL'); ?></label></th>
						<td><input type="text" name="sb_cookie_data_<?php echo esc_attr($sb_lang); ?>[customurl]" value="<?php echo esc_attr( @$options['customurl'] ); ?>" /><br>
							<input name="sb_cookie_data_<?php echo esc_attr($sb_lang); ?>[boxlinkblank]" type="checkbox" value="1" <?php checked('1', @$options['boxlinkblank']); ?>/><label for="boxlinkblank"><small>Open new window</small>
							</td>
						</tr> 
					</table>            
					<p class="submit">
						<input type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
					</p>
				</form>
			</div>