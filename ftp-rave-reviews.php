<?php

	/**
	 * Plugin Name: FTP Rave Reviews
	 * Plugin URI: #
	 * Description: Sets up Reviews page template
	 * Version: 1.0.0
	 */

	class FtpRaveReviews  {
		private $debug = false;
		private $options = array();
		private $mainPage;
		private $positiveReviewPage;
		private $negativeReviewPage;
		private $facebookReviewLink;
		private $googleReviewLink;
		private $yelpReviewLink;
		private $otherReviewLink;
		private $managerPositiveEmail;
		private $managerNegativeEmail;

		public function __constructor() {
		}

		public function getOptions() {
			return $this->options;
		}

		public function setOptions(array $options) {
			$this->options = $options;

			return $this;
		}

		public function getMainPage() {
			return $this->mainPage;
		}

		public function setMainPage($mainPage) {
			$this->mainPage = $mainPage;

			return $this;
		}

		public function getPositiveReviewPage() {
			return $this->positiveReviewPage;
		}

		public function setPositiveReviewPage($positiveReviewPage) {
			$this->positiveReviewPage = $positiveReviewPage;

			return $this;
		}

		public function getNegativeReviewPage() {
			return $this->negativeReviewPage;
		}

		public function setNegativeReviewPage($negativeReviewPage) {
			$this->negativeReviewPage = $negativeReviewPage;

			return $this;
		}

		public function getFacebookReviewLink() {
			return $this->facebookReviewLink;
		}

		public function setFacebookReviewLink($facebookReviewLink) {
			$this->facebookReviewLink = $facebookReviewLink;

			return $this;
		}

		public function getGoogleReviewLink() {
			return $this->googleReviewLink;
		}

		public function setGoogleReviewLink($googleReviewLink) {
			$this->googleReviewLink = $googleReviewLink;

			return $this;
		}

		public function getDealerRaterReviewLink() {
			return $this->dealerRaterReviewLink;
		}

		public function setDealerRaterReviewLink($dealerRaterReviewLink) {
			$this->dealerRaterReviewLink = $dealerRaterReviewLink;

			return $this;
		}

		public function getOtherReviewLink() {
			return $this->otherReviewLink;
		}

		public function setOtherReviewLink($otherReviewLink) {
			$this->otherReviewLink = $otherReviewLink;

			return $this;
		}

		public function getOtherIconUrl() {
			return $this->otherIconUrl;
		}

		public function setOtherIconUrl($otherIconUrl) {
			$this->otherIconUrl = $otherIconUrl;

			return $this;
		}

		public function getYelpReviewLink() {
			return $this->yelpReviewLink;
		}

		public function setYelpReviewLink($yelpReviewLink) {
			$this->yelpReviewLink = $yelpReviewLink;

			return $this;
		}

		public function getManagerPositiveEmail() {
			return $this->managerPositiveEmail;
		}

		public function setManagerPositiveEmail($managerEmail) {
			$this->managerEmail = $managerEmail;

			return $this;
		}

		public function getManagerNegativeEmail() {
			return $this->managerNegativeEmail;
		}

		public function setManagerNegativeEmail($managerNegativeEmail) {
			$this->managerNegativeEmail = $managerNegativeEmail;

			return $this;
		}

		public function init() {

			add_action('admin_menu', array($this, 'addOptions'));

			if (get_option('ftp_ravereviews_enable')) {

				$this->setMainPage(get_option('ftp_ravereviews_main_page'));
				$this->setPositiveReviewPage(get_option('ftp_ravereviews_positive_page'));
				$this->setNegativeReviewPage(get_option('ftp_ravereviews_negative_page'));
				$this->setFacebookReviewLink(get_option('ftp_ravereviews_social_facebook'));
				$this->setGoogleReviewLink(get_option('ftp_ravereviews_social_google'));
				$this->setYelpReviewLink(get_option('ftp_ravereviews_social_yelp'));
				$this->setOtherReviewLink(get_option('ftp_ravereviews_social_other'));
				$this->setDealerRaterReviewLink(get_option('ftp_ravereviews_social_dealerrater'));
				$this->setOtherIconUrl(get_option('ftp_ravereviews_social_other_icon'));
				$this->setManagerPositiveEmail(get_option('ftp_ravereviews_manager_positive_email'));
				$this->setManagerNegativeEmail(get_option('ftp_ravereviews_manager_negative_email'));

				add_filter( 'template_include', array($this, 'templateSwitch'), 100 );
			}
		}

		public function addOptions() {
			add_options_page('Create FTP Rave Reviews Page', 'FTP Rave Reviews Page', 'manage_options', 'ftp-rave-reviews', array($this, 'pageOptions'));
		}

		private function loadAdminDefaults() {
			$this->options = array(
				'ftp_ravereviews_manager_positive_email' => array(
					'label' => 'Positive Manager Email',
					'type'	=> 'input',
					'default' => '',
				),
				'ftp_ravereviews_manager_negative_email' => array(
					'label' => 'Negative Manager Email',
					'type'	=> 'input',
					'default' => '',
				),
				'ftp_ravereviews_social_facebook' => array(
					'label' => 'Facebook Link',
					'type'	=> 'input',
					'default' => '',
				),
				'ftp_ravereviews_social_google' => array(
					'label' => 'Google+ Link',
					'type'	=> 'input',
					'default' => '',
				),
				'ftp_ravereviews_social_yelp' => array(
					'label' => 'Yelp Link',
					'type'	=> 'input',
					'default' => '',
				),
				'ftp_ravereviews_social_dealerrater' => array(
					'label' => 'Dealer Rater Link',
					'type'	=> 'input',
					'default' => '',
				),
				'ftp_ravereviews_social_other' => array(
					'label' => 'Other Social Media',
					'type'	=> 'input',
					'default' => '',
				),
				'ftp_ravereviews_social_other_icon' => array(
					'label' => 'Other Social Media Icon',
					'type'	=> 'input',
					'default' => '',
				),
			);

		}

		public function pageOptions() {
			if (!current_user_can('manage_options'))
				wp_die(__('Sorry! You dont have the correct user access rights to use this plugin!'));

			$this->loadAdminDefaults();

			if (isset($_POST['submit'])) {
	 			foreach($this->options as $k => $v)
					if (isset($_POST[$k]))
						update_option( $k, stripslashes($_POST[$k]) );

				update_option( 'ftp_ravereviews_enable', isset($_POST['ftp_ravereviews_enable']) ? 1 : 0 );

				if(isset($_POST['ftp_ravereviews_main_page']))
					update_option( 'ftp_ravereviews_main_page', $_POST['ftp_ravereviews_main_page'] );

				if(isset($_POST['ftp_ravereviews_positive_page']))
					update_option( 'ftp_ravereviews_positive_page', $_POST['ftp_ravereviews_positive_page'] );

				if(isset($_POST['ftp_ravereviews_negative_page']))
					update_option( 'ftp_ravereviews_negative_page', $_POST['ftp_ravereviews_negative_page'] );
			}

			$this->setMainPage(get_option('ftp_ravereviews_main_page'));
			$this->setPositiveReviewPage(get_option('ftp_ravereviews_positive_page'));
			$this->setNegativeReviewPage(get_option('ftp_ravereviews_negative_page'));
			$this->setFacebookReviewLink(get_option('ftp_ravereviews_social_facebook'));
			$this->setGoogleReviewLink(get_option('ftp_ravereviews_social_google'));
			$this->setYelpReviewLink(get_option('ftp_ravereviews_social_yelp'));
			$this->setOtherReviewLink(get_option('ftp_ravereviews_social_other'));
			$this->setDealerRaterReviewLink(get_option('ftp_ravereviews_social_dealerrater'));
			$this->setOtherIconUrl(get_option('ftp_ravereviews_social_other_icon'));
			$this->setManagerPositiveEmail(get_option('ftp_ravereviews_manager_positive_email'));
			$this->setManagerNegativeEmail(get_option('ftp_ravereviews_manager_negative_email'));

			require __DIR__ . '/view/admin-view.php';
		}

		public function templateSwitch($template) {
			global $post;

			if (is_page($this->getMainPage()) || is_page($this->getPositiveReviewPage()) || is_page($this->getNegativeReviewPage())) {

				switch ($post->ID) {
					case $this->getMainPage():
						$template = __DIR__ . '/view/rate.php';
						break;

					case $this->getPositiveReviewPage():
						$template = __DIR__ . '/view/positive-review.php';
						$this->redirect = '';
						break;

					case $this->getNegativeReviewPage():
						$template = __DIR__ . '/view/negative-review.php';
						$this->redirect = '';
						break;
				}

				wp_enqueue_style( 'rave-reviews-styles', plugin_dir_url(__FILE__) . 'view/css/rave-reviews.css' );
				wp_enqueue_script( 'zeroclipboard', plugin_dir_url(__FILE__) . 'view/js/zeroclipboard-master/dist/ZeroClipboard.js', array('jquery'), '1.0.0', true );
				wp_enqueue_script( 'rave-reviews-script', plugin_dir_url(__FILE__) . 'view/js/rave-reviews.js', array('jquery'), '1.0.0', true );
			}

			return $template;

		}
	}

	$ftp = new FtpRaveReviews();
	$ftp->init();
?>