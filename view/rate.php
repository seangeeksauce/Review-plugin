<?php
$assetUrl = plugin_dir_url(__FILE__);
$action = '';

get_header();
?>

<!--
	Page: Inital Feedback Pg
	URL: /how-did-we-do
 -->
<div class="dealer-reviews-container">
	<div class="dealer-reviews-content">
		<h1 style="text-align: center;"><img src="<?php echo $assetUrl; ?>img/how-did-we-do-banner.jpg" alt="How Did We Do?" /></h1>
		<p class="dealer-reviews-intro">Congratulations on your Nicer, Newer<sup>®</sup> car! We hope you loved your experience with us as much as you love your new ride! Please take a few minutes to let us know how we did.</p>

		<h2>How would you rate your experience?</h2>
		<a class="dealer-reviews-links" href="<?php echo get_permalink($ftp->getPositiveReviewPage());?>">
			<img class="dealer-reviews-intro-image" src="<?php echo $assetUrl; ?>img/happy-customer.gif" alt="Great!" />
		</a>

		<a href="<?php echo get_permalink($ftp->getNegativeReviewPage());?>">
			<img style="margin-right: 10px;" src="<?php echo $assetUrl; ?>img/unhappy-customer.gif" alt="Not so hot" />
		</a>

	</div>
</div>

<?php get_footer(); ?>