<?php

function get_the_ip() {
	//Just get the headers if we can or else use the SERVER global
	if ( function_exists( 'apache_request_headers' ) ) {
		$headers = apache_request_headers();
	} else {
		$headers = $_SERVER;
	}
	//Get the forwarded IP if it exists
	if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
		$the_ip = $headers['X-Forwarded-For'];
	} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )) {
		$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
	} else {
		$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
	}
	if(!empty($the_ip)){
		return $the_ip;
	} else {
		return false;
	}
}


/**
* Quick use SVG
*/
function svg($name, $options = array('title'=>false,'class'=>false)) {

	return
'<svg class="icon icon--'.$name. ($options['class'] != false ? ' '. $options['class']  : '').'">'.($options['title'] != false ? '<title>'.$options['title'].'</title>' : '').'<use xlink:href="#'.$name.'" /></svg>';
}

function get_site_url() {
	if($_SERVER['HTTP_HOST'] === 'thenewsbeat.org') {
		$site = 'thenewsbeat.org/2018-demonstrating-balance';
	} else {
		$site = $_SERVER['HTTP_HOST'];
	}
	return "https://".$site;
}

function get_current_url() {
	return get_site_url().$_SERVER['REQUEST_URI'];
}

function social_share($title, $position) {
	$current_url = get_current_url();
	$user_ip = get_the_ip();
	return '<ul class="social-share social-share--'.$position.'">
				<li class="social-share__item social-share__item--facebook">
					<button type="text" class="social-share__link social-share__link--facebook social-share__link--facebook-'.$position.'" data-position="'.ucwords($position).'" data-social="Facebook" data-label="'.$user_ip.'">
						<span class="icon-social icon-social--facebook" role="presentation" aria-hidden="true">
							'.svg('facebook').'
						</span>
						<span class="screen-reader-text">Share on Facebook</span>
					</button>
				</li>

				<li class="social-share__item social-share__item--twitter">
					<button type="text" class="social-share__link social-share__link--twitter social-share__link--twitter-'.$position.'" data-action="Twitter Share - '.ucwords($position).'" data-label="'.$user_ip.'" data-social="Twitter"  data-position="'.ucwords($position).'">
						<span class="icon-social icon-social--twitter" role="presentation" aria-hidden="true" >
							'.svg('twitter').'
						</span>
						<span class="screen-reader-text">Share on Twitter</span>
					</button>
				</li>
			</ul>';
}


/**
* An internal navigation used on the About the Trust Project page
*/
function prev_article($pos) {
	return '<a class="prev-article" href="#">Go Back to Previous Article</a>';
}

/**
* Get previous referrer from URL Param
* @return string (/root/path/previous-page-url/)
*/
function get_referral_url() {
	$referrer = '';
	if(isset($_GET['referrer']) && !empty($_GET['referrer'])) {
		// process the url into a cleaner string
		$url = urldecode($_GET['referrer']);
		// get the last one

		$referrer = $url;

		// check if there are any remaining referrer urls we need to re-encode. We need the most recent one.
	}
	return $referrer;
}
