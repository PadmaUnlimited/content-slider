<?php 

class PadmaContentSliderBlock extends PadmaBlockAPI {

    public $id 				= 'content-slider-block';    
    public $name 			= 'Content Slider';
    public $options_class 	= 'PadmaContentSliderBlockOptions';
    
			
	function setup_elements() {
		debug($block);
	}

	public static function enqueue_action($block_id, $block) {

		wp_enqueue_style('padma-content-slider-owl-carousel-css', plugin_dir_url( __FILE__ ).'css/owl.carousel.min.css');
		wp_enqueue_style('padma-content-slider-owl-theme-css', plugin_dir_url( __FILE__ ).'css/owl.theme.default.min.css');
		wp_enqueue_style('padma-content-slider-owl-theme-green-css', plugin_dir_url( __FILE__ ).'css/owl.theme.green.min.css');
		wp_enqueue_script('padma-content-slider-slider-js', plugins_url( '/js/owl.carousel.min.js', __FILE__ ), array('jquery'), '1.0', false);
	}

	function content($block) {

		debug($block);

		// Content
		$post_type 			= ($block['settings']['post-type']) ? $block['settings']['post-type']: 'post';
		$categories 		= ($block['settings']['categories']) ? $block['settings']['categories']: array();
		$order_by 			= ($block['settings']['order-by']) ? $block['settings']['order-by']: 'date';
		$order 				= ($block['settings']['order']) ? $block['settings']['order']: 'desc';
		$onlyShowFeatured 	= ($block['settings']['only-featured']) ? true: false;

		// Settings
		$carouselParams 	= '';

		if($block['settings']['items']){
			$carouselParams .= 'items:'.$block['settings']['items'].',';
		}
		$margin 			= ($block['settings']['margin']) ? $block['settings']['margin']: 0;
		$loop 				= ($block['settings']['loop']) ? 'true': 'false';
		$center 			= ($block['settings']['center']) ? 'true': 'false';
		$mouseDrag 			= ($block['settings']['mouse-drag']) ? 'true': 'false';
		$touchDrag 			= ($block['settings']['touch-drag']) ? 'true': 'false';
		$pullDrag 			= ($block['settings']['pull-drag']) ? 'true': 'false';
		$freeDrag 			= ($block['settings']['free-drag']) ? 'true': 'false';
		$stagePadding 		= ($block['settings']['stage-dadding']) ? $block['settings']['stage-padding']: 0;
		$merge 				= ($block['settings']['merge']) ? 'true': 'false';
		$mergeFit 			= ($block['settings']['merge-fit']) ? 'true': 'false';
		$autoWidth 			= ($block['settings']['auto-width']) ? 'true': 'false';
		$startPosition 		= ($block['settings']['start-position']) ? $block['settings']['start-position']: 0;
		$URLhashListener 	= ($block['settings']['url-hash-listener']) ? 'true': 'false';
		$nav 				= ($block['settings']['nav']) ? 'true': 'false';
		$rewind 			= ($block['settings']['rewind']) ? 'true': 'false';
		$navText_next		= ($block['settings']['nav-text-next']) ? $block['settings']['nav-text-next']: '&#x27;next&#x27;';
		$navText_prev		= ($block['settings']['nav-text-prev']) ? $block['settings']['nav-text-prev']: '&#x27;prev&#x27;';
		$navText 			= '['.$navText_next.','.$navText_prev.']';
		$navElement 		= ($block['settings']['nav-element']) ? $block['settings']['nav-element']: 'div';
		$slideBy 			= ($block['settings']['slide-by']) ? $block['settings']['slide-by']: 1;
		$slideTransition 	= ($block['settings']['slide-transition']) ? $block['settings']['slide-transition']: '';
		$dots 				= ($block['settings']['dots']) ? 'true': 'false';
		$dotsEach 			= ($block['settings']['dots-each']) ? $block['settings']['dots-each']: 0;
		$dotsData 			= ($block['settings']['dots-data']) ? 'true': 'false';
		$lazyLoad 			= ($block['settings']['lazy-load']) ? 'true': 'false';
		$lazyLoadEager		= ($block['settings']['lazy-load-eager']) ? $block['settings']['lazy-load-eager']: 0;
		$auto_play 			= ($block['settings']['autoplay']) ? 'true': 'false';
		$autoplayTimeout 	= ($block['settings']['autoplay-timeout']) ? $block['settings']['autoplay-timeout']: 5000;
		$autoplayHoverPause = ($block['settings']['autoplay-hover-pause']) ? 'true': 'false';
		$callbacks 			= ($block['settings']['callbacks']) ? 'true': 'false';
		$responsiveRefreshRate 	= ($block['settings']['responsive-refresh-rate']) ? $block['settings']['responsive-refresh-rate']: 200;
		$video 				= ($block['settings']['video']) ? 'true': 'false';
		$videoHeight 		= ($block['settings']['video-height']) ? 'true': 'false';
		$videoWidth 		= ($block['settings']['video-width']) ? 'true': 'false';
		$animateOut 		= ($block['settings']['animate-out']) ? $block['settings']['animate-out']: '';
		$animateIn 			= ($block['settings']['animate-in']) ? $block['settings']['animate-in']: '';
		$fallbackEasing 	= ($block['settings']['fallback-easing']) ? $block['settings']['fallback-easing']: '';
		$nestedItemSelector = ($block['settings']['nested-item-selector']) ? $block['settings']['nested-item-selector']: '';
		$itemElement 		= ($block['settings']['item-element']) ? $block['settings']['item-element']: 'div';
		$stageElement 		= ($block['settings']['stage-element']) ? $block['settings']['stage-element']: 'div';
		$navContainer 		= ($block['settings']['nav-container']) ? $block['settings']['nav-container']: '';
		$dotsContainer 		= ($block['settings']['dots-container']) ? $block['settings']['dots-container']: '';
		$checkVisible 		= ($block['settings']['check-visible']) ? 'true': 'false';


		global $post;

		$psrndn = rand(1,1000);
		$args 	= array ( 
					'post_type' 		=> $post_type,
					'posts_per_page' 	=> $number,
					'orderby' 			=> $order_by,
					'order' 			=> $order 
				);

		if(count($categories) > 0) {
			$args['tax_query'] = array(
				array(
						'taxonomy' 	=> 'category',
						'field' 	=> 'id',
						'terms' 	=> $categories 
					)
			);
		}

		$content_slider_query = new WP_Query( $args );


		$result = '<script type="text/javascript">';
		$result .= 'jQuery(document).ready(function($){';
		$result .= '$("#content-slider-'.$psrndn.'.owl-carousel").owlCarousel({';
		//$result .= 'items:'.$items.',';
		$result .= $carouselParams;
		$result .= 'margin:'.$margin.',';
		$result .= 'loop:'.$loop.',';
		$result .= 'center:'.$center.',';
		$result .= 'mouseDrag:'.$mouseDrag.',';
		$result .= 'touchDrag:'.$touchDrag.',';
		$result .= 'pullDrag:'.$pullDrag.',';
		$result .= 'freeDrag:'.$freeDrag.',';
		$result .= 'stagePadding:'.$stagePadding.',';
		$result .= 'merge:'.$merge.',';
		$result .= 'mergeFit:'.$mergeFit.',';
		$result .= 'autoWidth:'.$autoWidth.',';
		$result .= 'startPosition:'.$startPosition.',';
		$result .= 'URLhashListener:'.$URLhashListener.',';
		$result .= 'nav:'.$nav.',';
		$result .= 'rewind:'.$rewind.',';
		$result .= 'navText:"'.$navText.'",';
		$result .= 'navElement:"'.$navElement.'",';
		$result .= 'slideBy:'.$slideBy.',';
		$result .= 'slideTransition:"'.$slideTransition.'",';
		$result .= 'dots:'.$dots.',';
		$result .= 'dotsEach:'.$dotsEach.',';
		$result .= 'dotsData:'.$dotsData.',';
		$result .= 'lazyLoad:'.$lazyLoad.',';
		$result .= 'lazyLoadEager:'.$lazyLoadEager.',';
		$result .= 'auto_play:'.$auto_play.',';
		$result .= 'autoplayTimeout:'.$autoplayTimeout.',';
		$result .= 'autoplayHoverPause:'.$autoplayHoverPause.',';
		$result .= 'callbacks:'.$callbacks.',';
		$result .= 'responsiveRefreshRate:'.$responsiveRefreshRate.',';
		$result .= 'video:'.$video.',';
		$result .= 'videoHeight:'.$videoHeight.',';
		$result .= 'videoWidth:'.$videoWidth.',';
		$result .= 'animateOut:"'.$animateOut.'",';
		$result .= 'animateIn:"'.$animateIn.'",';
		$result .= 'fallbackEasing:"'.$fallbackEasing.'",';
		$result .= 'nestedItemSelector:"'.$nestedItemSelector.'",';
		$result .= 'itemElement:"'.$itemElement.'",';
		$result .= 'stageElement:"'.$stageElement.'",';
		$result .= 'navContainer:"'.$navContainer.'",';
		$result .= 'dotsContainer:"'.$dotsContainer.'",';
		$result .= 'checkVisible:'.$checkVisible.',';
		$result .= '});});</script>';
		$result .= '<div id="content-slider-'.$psrndn.'" class="owl-carousel owl-theme">';

		while ( $content_slider_query->have_posts() ) : $content_slider_query->the_post();

			setup_postdata( $post );			
			if($onlyShowFeatured && has_post_thumbnail()){
				$result .= '<div class="item">'.get_the_post_thumbnail( $post->ID, 'content-slider-thumb', array( 'class' => "img-responsive" ) ).'</div>';
			}else{
				$result .= '<div class="item">'.do_shortcode(get_the_content()).'</div>';				
			}

		endwhile;
		wp_reset_postdata();

		echo $result;
	}

	function custom_excerpt_post($text, $limit = 20){
		$excerpt = explode(' ', $text, $limit);

		if (count($excerpt)>=$limit) {
			
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		
		} else {
			$excerpt = implode(" ",$excerpt);

		}	
		$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
		return $excerpt;
	}
	
}