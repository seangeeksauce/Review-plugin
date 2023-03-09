<div class="wrap">
	<h2>FTP Landing Pages</h2>

	<?php
		$selected = '';

		$args = array(
		'post_type'=> 'page',
		'post_status' => 'publish',
		'order'    => 'ASC',
		'posts_per_page' => '100',
	);
	$pages = query_posts( $args );

	?>
	<form name="form" method="post" action="">
		<input type="hidden" name="submit" value="1">
		<table class="form-table">
			<tbody>
				<tr>
					<th>Enable FTP Rave Review Page</th>
					<td>
						<input type="checkbox" name="ftp_ravereviews_enable" value="1" <?php checked( get_option('ftp_ravereviews_enable'), 1 ); ?> />
					</td>
				</tr>

				<?php foreach($this->options as $k => $v): ?>
					<tr>
						<th><?php echo $v['label']; ?></th>
						<td>
						<?php
							if($v['type'] == 'textarea')
								echo sprintf('<textarea name="%s" cols="60" rows="2">%s</textarea>',$k, get_option($k, $v['default']) ?: $v['default']);

							elseif($v['type'] == 'input')
								echo sprintf('<input type="text" name="%s" value="%s"/>',$k, get_option($k, $v['default']) ?: $v['default']);

					endforeach; ?>

				<tr>
					<th>Choose Rave Reviews Page</th>
					<td>
						<select name="ftp_ravereviews_main_page">
							<option value='-1'></option>

						<?php foreach($pages as $k => $v) : ?>
							<option <?php echo $this->getMainPage() == $v->ID ? 'selected' : ''; ?> value="<?php echo $v->ID;?>"><?php echo $v->post_title; ?></option>
						<?php endforeach; ?>
						</select>
					</td>
				</tr>

				<tr>
					<th>Choose Positive Reviews Page</th>
					<td>
						<select name="ftp_ravereviews_positive_page">
							<option value='-1'></option>

						<?php foreach($pages as $k => $v) : ?>
							<option <?php echo $this->getPositiveReviewPage() == $v->ID ? 'selected' : ''; ?> value="<?php echo $v->ID;?>"><?php echo $v->post_title; ?></option>
						<?php endforeach; ?>
						</select>
					</td>
				</tr>

				<tr>
					<th>Choose Negative Reviews Page</th>
					<td>
						<select name="ftp_ravereviews_negative_page">
							<option value='-1'></option>

						<?php foreach($pages as $k => $v) : ?>
							<option <?php echo $this->getNegativeReviewPage() == $v->ID ? 'selected' : ''; ?> value="<?php echo $v->ID;?>"><?php echo $v->post_title; ?></option>
						<?php endforeach; ?>
						</select>
					</td>
				</tr>

				<tr>
					<th><input type="submit" class="button-primary"></input></th>
				</tr>
			</tbody>
		</table>
	</form>
</div>