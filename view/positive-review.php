<?php
$assetUrl = plugin_dir_url(__FILE__);

get_header();
?>

<div class="dealer-reviews-container">
	<div class="dealer-reviews-content">
	<?php if (!isset($_POST['form_submission'])): ?>
		<!--
			Page: Positive Feedback Pg
			URL: /how-did-we-do/tell-us-more
		-->
		<h1 style="text-align:center;"><img src="<?php echo $assetUrl; ?>img/how-did-we-do-banner.jpg" alt="How Did We Do?"/></h1>

		<h2>Awesome! Please Tell Us More.</h2>
		<p><img style="margin-right:10px;" src="<?php echo $assetUrl; ?>img/one-happy-customer.jpg" alt="Great!"/></p>

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

		if ($ftp->getManagerPositiveEmail())
			mail($ftp->getManagerPositiveEmail(), 'Rave Reviews Submission', $message);
	?>
		<!--
			Page: Postive Feedback Thank You Page
			URL: /how-did-we-do/thank-you-for-sharing
		-->
		<h1 style="text-align:center;"><img src="<?php echo $assetUrl; ?>img/how-did-we-do-banner.jpg" alt="How Did We Do?"/></h1>
		<h2>HOT DOG!</h2>
		<p class="dealer-reviews-sharing-intro">We're happy to hear that you had a great experience with us. What site would you like to share your review on?</p>

		<p class="dealer-reviews-social-media">
			<?php if ($ftp->getYelpReviewLink()) : ?>
				<a class="dealer-reviews-links" href="<?php echo $ftp->getYelpReviewLink(); ?>" target="blank">
					<img src="<?php echo $assetUrl; ?>img/review-sharing-yelp.png" alt="Share Review on Yelp"/></a>
			<?php endif; ?>

			<?php if ($ftp->getFacebookReviewLink()) : ?>
				<a href="<?php echo $ftp->getFacebookReviewLink(); ?>" target="blank">
					<img src="<?php echo $assetUrl; ?>img/review-sharing-facebook.png" alt="Share Review on Facebook"/></a>
			<?php endif; ?>

			<?php if ($ftp->getGoogleReviewLink()) : ?>
				<a href="<?php echo $ftp->getGoogleReviewLink(); ?>" target="blank">
					<img src="<?php echo $assetUrl; ?>img/review-sharing-google-plus.png" alt="Share Review on Google Plus"/></a>
			<?php endif; ?>

			<?php if ($ftp->getDealerRaterReviewLink()) : ?>
				<a href="<?php echo $ftp->getGoogleReviewLink(); ?>" target="blank">
					<img src="<?php echo $assetUrl; ?>img/review-sharing-dealer-rater.png" alt="Share Review on Dealer Rater"/></a>
			<?php endif; ?>

			<?php if ($ftp->getOtherReviewLink()) : ?>
				<a href="<?php echo $ftp->getOtherReviewLink(); ?>" target="blank">
					<?php if ($ftp->getOtherIconUrl()) : ?>
						<img src="<?php echo $ftp->getOtherIconUrl(); ?>" alt="Share Reviews"/>
					<?php endif; ?>
				</a>
			<?php endif; ?>
		</p>

		<div class="dealer-reviews-sharing">
			<textarea id="js-copy-content"><?php echo isset($_POST['review']) ? stripslashes($_POST['review']) : '' ?></textarea>
			<a href="#" class="copy-to-clipboard" id="js-copy-btn">Copy To Clipboard</a>
		</div>
	<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>