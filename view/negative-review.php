<?php
$assetUrl = plugin_dir_url(__FILE__);

get_header();
?>

<div class="dealer-reviews-container">
	<div class="dealer-reviews-content">
	<?php if (!isset($_POST['form_submission'])): ?>
		<!--
			Page: Negative Feedback Pg
			URL: /how-did-we-do/sorry-we-let-you-down
	 	-->
		<h1 style="text-align:center;"><img src="<?php echo $assetUrl; ?>img/how-did-we-do-banner.jpg" alt="How Did We Do?"/></h1>

		<h2>We're Sorry We Let You Down</h2>

		<p><img style="margin-right:10px;" src="<?php echo $assetUrl; ?>img/one-unhappy-customer.jpg" alt="Not so hot"/></a></p>
		   <form id="review-form" action="" method="post">
				<input type="hidden" name="form_submission" value="1"/>
				<input type="text" placeholder="Name" class="dealer-reviews-input full-name" name="full_name" value=""/>
				<input type="text" placeholder="Email" class="dealer-reviews-input email-name" name="email" value=""/>
				<input type="text" placeholder="Phone" class="dealer-reviews-input phone" name="phone" value=""/>
				<textarea placeholder="Please take a few minutes to tell us why." class="dealer-reviews-textarea" name="review"></textarea>
				<label><input type="checkbox" class="dealer-reviews-checkbox" name="respond"/> I Would Like a Response</label>
				<button type="submit" class="dealer-reviews-submit">Submit</button>
			</form>

	<?php else :

		// send mail to manager
		$message = '';

		if (isset($_POST['full_name']))
			$message .= 'Name: ' . stripslashes($_POST['full_name']). "\r\n";

		if (isset($_POST['email']))
			$message .= 'Email: ' . stripslashes($_POST['email']). "\r\n";

		if (isset($_POST['phone']))
			$message .= 'Phone: ' . stripslashes($_POST['phone']). "\r\n";

		$message .= sprintf('Do they want a response: %s %s',$_POST['respond'] ? 'Yes' : 'No', "\r\n" );

		if (isset($_POST['review']))
			$message .= 'Review: ' . stripslashes($_POST['review']). "\r\n";

		if ($ftp->getManagerNegativeEmail())
			mail($ftp->getManagerNegativeEmail(), 'Rave Reviews Submission', $message);
		?>
		<!--
			Page: Negative Feedback Thank You Page
			URL: /how-did-we-do/we-appreciate-your-feedback
		-->
				<h1 style="text-align:center;"><img src="<?php echo $assetUrl; ?>img/how-did-we-do-banner.jpg" alt="How Did We Do?"/></h1>
				<h2>We Appreciate Your Feedback</h2>
				<p class="dealer-reviews-intro">Thank you for sharing your experience. Customer service is a top priority at our dealership and we never want a customer to leave unhappy. One of our customer service specialists will be reaching out to you shortly.</p>
	<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>