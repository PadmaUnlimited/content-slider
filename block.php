<?php 

class PadmaContentSliderBlock extends PadmaBlockAPI {

    public $id 				= 'content-slider-block';    
    public $name 			= 'Content Slider';
    public $options_class 	= 'PadmaContentSliderBlockOptions';
    public $categories 		= array('content','gallery');
    
			
	function setup_elements() {
			
		

	}

	public static function enqueue_action($block_id, $block) {

		wp_enqueue_style('padma-content-slider-owl-carousel-css', plugin_dir_url( __FILE__ ).'css/owl.carousel.min.css');
		wp_enqueue_style('padma-content-slider-owl-theme-css', plugin_dir_url( __FILE__ ).'css/owl.theme.default.min.css');
		wp_enqueue_style('padma-content-slider-owl-theme-green-css', plugin_dir_url( __FILE__ ).'css/owl.theme.green.min.css');
		wp_enqueue_script('padma-content-slider-slider-js', plugins_url( '/js/owl.carousel.min.js', __FILE__ ), array('jquery'), '1.0', false);
	}

	function content($block) {

		// Content
		$post_type 			= ($block['settings']['post-type']) ? $block['settings']['post-type']: 'post';
		$categories 		= ($block['settings']['categories']) ? $block['settings']['categories']: array();
		$order_by 			= ($block['settings']['order-by']) ? $block['settings']['order-by']: 'date';
		$order 				= ($block['settings']['order']) ? $block['settings']['order']: 'desc';
		$onlyShowFeatured 	= ($block['settings']['only-featured']) ? true: false;
		$onlyShowExcerpt 	= ($block['settings']['only-excerpt']) ? true: false;
		$showLink 			= ($block['settings']['show-link']) ? true: false;
		$showLinkText		= ($block['settings']['show-link-text']) ? $block['settings']['show-link-text']: 'Show more';

		
		global $post;

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


		$result = '<div id="content-slider-'.$block['id'].'" class="owl-carousel owl-theme">';

		while ( $content_slider_query->have_posts() ) : $content_slider_query->the_post();

			setup_postdata( $post );			

			if($block['settings']['item-width']){
				$itemTag = '<div class="item" style="width:'.$block['settings']['item-width'].'px">';
			}else{
				$itemTag = '<div class="item">';
			}

			if($onlyShowFeatured && has_post_thumbnail()){
				$result .= $itemTag;
				$result .= get_the_post_thumbnail( 
					$post->ID, 
					'content-slider-thumb', 
					array( 
						'class' => "img-responsive",
						'alt' 	=> get_the_title(),
						'title' => get_the_title(),
					)
				);
				$result .= '</div>';
			
			}elseif (!$onlyShowFeatured && has_post_thumbnail() ) {
				
				$result .= $itemTag;
				$result .= get_the_post_thumbnail( 
					$post->ID, 
					'content-slider-thumb', 
					array( 
						'class' => "img-responsive",
						'alt' 	=> get_the_title(),
						'title' => get_the_title(),
					)
				);


				$result .= '<h3>'.get_the_title().'</h3>';
				if($onlyShowExcerpt){
					$result .= do_shortcode('<p>'.get_the_excerpt().'</p>');
				}else{
					$result .= do_shortcode('<p>'.get_the_content().'</p>');
				}

				if($showLink){
					$result .= '<a href='.get_the_permalink().'>' . $showLinkText . '</a>';
				}

				$result .= '</div>';
			
			}else{
				if($onlyShowExcerpt){
					$result .= $itemTag.do_shortcode('<p>'.get_the_excerpt().'</p>').'</div>';
				}else{
					$result .= $itemTag.do_shortcode('<p>'.get_the_content().'</p>').'</div>';
				}

				if($showLink){
					$result .= '<a href='.get_the_permalink().'>' . $showLinkText . '</a>';
				}
				
			}

		endwhile;
		wp_reset_postdata();

		echo $result;
	}

	public static function dynamic_js($block_id, $block = false) {

		if ( !$block )
			$block = PadmaBlocksData::get_block($block_id);

		// Settings
		$carouselParams 	= '';

		if($block['settings']['items'])
			$carouselParams .= 'items:'.$block['settings']['items'].',';
		else
			$carouselParams .= 'items:3,';

		if($block['settings']['margin']){
			$carouselParams .= 'margin:'.$block['settings']['margin'].',';
		}

		if($block['settings']['loop']){
			$loop 			= ($block['settings']['loop']) ? 'true': 'false';
			$carouselParams .= 'loop:'.$loop.',';
		}

		if($block['settings']['center']){
			$center 		= ($block['settings']['center']) ? 'true': 'false';
			$carouselParams .= 'center:'.$center.',';
		}

		if($block['settings']['mouse-drag']){
			$mouseDrag 		= ($block['settings']['mouse-drag']) ? 'true': 'false';
			$carouselParams .= 'mouseDrag:'.$mouseDrag.',';
		}

		if($block['settings']['touch-drag']){
			$touchDrag 		= ($block['settings']['touch-drag']) ? 'true': 'false';
			$carouselParams .= 'touchDrag:'.$touchDrag.',';
		}

		if($block['settings']['pull-drag']){
			$pullDrag 		= ($block['settings']['pull-drag']) ? 'true': 'false';
			$carouselParams .= 'pullDrag:'.$pullDrag.',';
		}

		if($block['settings']['free-drag']){
			$freeDrag 		= ($block['settings']['free-drag']) ? 'true': 'false';
			$carouselParams .= 'freeDrag:'.$freeDrag.',';
		}

		if($block['settings']['stage-padding']){
			$stagePadding 	= ($block['settings']['stage-padding']) ? $block['settings']['stage-padding']: 0;
			$carouselParams .= 'stagePadding:'.$stagePadding.',';
		}

		if($block['settings']['merge']){
			$merge 			= ($block['settings']['merge']) ? 'true': 'false';
			$carouselParams .= 'merge:'.$merge.',';
		}

		if($block['settings']['merge-fit']){
			$mergeFit 		= ($block['settings']['merge-fit']) ? 'true': 'false';
			$carouselParams .= 'mergeFit:'.$mergeFit.',';
		}

		if($block['settings']['auto-width']){
			$autoWidth 		= ($block['settings']['auto-width']) ? 'true': 'false';
			$carouselParams .= 'autoWidth:'.$autoWidth.',';
		}

		if($block['settings']['start-position']){
			$startPosition 	= ($block['settings']['start-position']) ? $block['settings']['start-position']: 0;
			$carouselParams .= 'startPosition:'.$startPosition.',';
		}

		if($block['settings']['url-hash-listener']){
			$URLhashListener = ($block['settings']['url-hash-listener']) ? 'true': 'false';
			$carouselParams .= 'URLhashListener:'.$URLhashListener.',';
		}

		if($block['settings']['nav']){
			$nav = ($block['settings']['nav']) ? 'true': 'false';
			$carouselParams .= 'nav: true, pagination:'.$nav.',';
		}

		if($block['settings']['rewind']){
			$rewind = ($block['settings']['rewind']) ? 'true': 'false';
			$carouselParams .= 'rewind:'.$rewind.',';
		}

		if($block['settings']['nav-text-next'] || $block['settings']['nav-text-prev']){
			$navText_next	= ($block['settings']['nav-text-next']) ? $block['settings']['nav-text-next']: '&#x27;next&#x27;';
			$navText_prev	= ($block['settings']['nav-text-prev']) ? $block['settings']['nav-text-prev']: '&#x27;prev&#x27;';
			$navText 		= '["'.$navText_next.'","'.$navText_prev.'"]';
			$carouselParams .= 'navText:"'.$navText.'",';
		}

		if($block['settings']['nav-element']){
			$navElement 	= ($block['settings']['nav-element']) ? $block['settings']['nav-element']: 'div';
			$carouselParams .= 'navElement:'.$navElement.',';
		}

		if($block['settings']['slide-by']){
			$slideBy 		= ($block['settings']['slide-by']) ? $block['settings']['slide-by']: 1;
			$carouselParams .= 'slideBy:'.$slideBy.',';
		}

		if($block['settings']['slide-transition']){
			$slideTransition = ($block['settings']['slide-transition']) ? $block['settings']['slide-transition']: '';
			$carouselParams .= 'slideTransition:'.$slideTransition.',';
		}

		if($block['settings']['dots']){
			$dots 			= ($block['settings']['dots']) ? 'true': 'false';
			$carouselParams .= 'dots:'.$dots.',';
		}

		if($block['settings']['dots-each']){
			$dotsEach 		= ($block['settings']['dots-each']) ? $block['settings']['dots-each']: 0;
			$carouselParams .= 'dotsEach:'.$dotsEach.',';
		}

		if($block['settings']['dots-each']){
			$dotsEach 		= ($block['settings']['dots-each']) ? $block['settings']['dots-each']: 0;
			$carouselParams .= 'dotsEach:'.$dotsEach.',';
		}

		if($block['settings']['dots-data']){
			$dotsData 		= ($block['settings']['dots-data']) ? 'true': 'false';
			$carouselParams .= 'dotsData:'.$dotsData.',';
		}

		if($block['settings']['lazy-load']){
			$lazyLoad 		= ($block['settings']['lazy-load']) ? 'true': 'false';
			$carouselParams .= 'lazyLoad:'.$lazyLoad.',';
		}

		if($block['settings']['lazy-load-eager']){
			$lazyLoadEager   = ($block['settings']['lazy-load-eager']) ? $block['settings']['lazy-load-eager']: 0;
			$carouselParams .= 'lazyLoadEager:'.$lazyLoadEager.',';
		}

		if($block['settings']['autoplay']){
			$autoplay 		= ($block['settings']['autoplay']) ? 'true': 'false';
			$carouselParams .= 'autoPlay:'.$autoplay.',';
		}

		if($block['settings']['autoplay-timeout']){
			$autoplayTimeout = ($block['settings']['autoplay-timeout']) ? $block['settings']['autoplay-timeout']: 5000;
			$carouselParams .= 'autoplayTimeout:'.$autoplayTimeout.',';
		}

		if($block['settings']['autoplay-hover-pause']){
			$autoplayHoverPause = ($block['settings']['autoplay-hover-pause']) ? 'true': 'false';
			$carouselParams 	.= 'autoplayHoverPause:'.$autoplayHoverPause.',';
		}

		if($block['settings']['callbacks']){
			$callbacks 			= ($block['settings']['callbacks']) ? 'true': 'false';
			$carouselParams 	.= 'callbacks:'.$callbacks.',';
		}

		if($block['settings']['responsive-refresh-rate']){
			$responsiveRefreshRate 	= ($block['settings']['responsive-refresh-rate']) ? $block['settings']['responsive-refresh-rate']: 200;
			$carouselParams 		.= 'responsiveRefreshRate:'.$responsiveRefreshRate.',';
		}

		if($block['settings']['video']){
			$video 				= ($block['settings']['video']) ? 'true': 'false';
			$carouselParams 	.= 'video:'.$video.',';
		}

		if($block['settings']['video-height']){
			$videoHeight 		= ($block['settings']['video-height']) ? $block['settings']['video-height']: 'false';
			$carouselParams 	.= 'videoHeight:'.$videoHeight.',';
		}

		if($block['settings']['video-width']){
			$videoWidth 		= ($block['settings']['video-width']) ? $block['settings']['video-width']: 'false';
			$carouselParams 	.= 'videoWidth:'.$videoWidth.',';
		}

		if($block['settings']['animate-out']){
			$animateOut 		= ($block['settings']['animate-out']) ? $block['settings']['animate-out']: '';
			$carouselParams 	.= 'animateOut:'.$animateOut.',';
		}

		if($block['settings']['animate-in']){
			$animateIn 			= ($block['settings']['animate-in']) ? $block['settings']['animate-in']: '';
			$carouselParams 	.= 'animateIn:'.$animateIn.',';
		}

		if($block['settings']['fallback-easing']){
			$fallbackEasing 	= ($block['settings']['fallback-easing']) ? $block['settings']['fallback-easing']: '';
			$carouselParams 	.= 'fallbackEasing:'.$fallbackEasing.',';
		}

		if($block['settings']['nested-item-selector']){
			$nestedItemSelector = ($block['settings']['nested-item-selector']) ? $block['settings']['nested-item-selector']: '';
			$carouselParams 	.= 'nestedItemSelector:'.$nestedItemSelector.',';
		}

		if($block['settings']['item-element']){
			$itemElement 		= ($block['settings']['item-element']) ? $block['settings']['item-element']: 'div';
			$carouselParams 	.= 'itemElement:'.$itemElement.',';
		}

		if($block['settings']['stage-element']){
			$stageElement 	= ($block['settings']['stage-element']) ? $block['settings']['stage-element']: 'div';
			$carouselParams .= 'stageElement:'.$stageElement.',';
		}

		if($block['settings']['nav-container']){
			$navContainer 	= ($block['settings']['nav-container']) ? $block['settings']['nav-container']: '';
			$carouselParams .= 'navContainer:'.$navContainer.',';
		}

		if($block['settings']['nav-container']){
			$navContainer 	= ($block['settings']['nav-container']) ? $block['settings']['nav-container']: '';
			$carouselParams .= 'navContainer:'.$navContainer.',';
		}

		if($block['settings']['dots-container']){
			$dotsContainer 	= ($block['settings']['dots-container']) ? $block['settings']['dots-container']: '';
			$carouselParams .= 'dotsContainer:'.$dotsContainer.',';
		}

		if($block['settings']['check-visible']){
			$checkVisible 	= ($block['settings']['check-visible']) ? 'true': 'false';
			$carouselParams .= 'checkVisible:'.$checkVisible.',';
		}
		
		$carouselParams .= 'responsive:{ 0:{ items: 1 }, 480:{ items: 1 }, 640:{ items: 2 }, 1200:{ items: 3 }  }';
	 
		$carouselParams = rtrim($carouselParams, ',');
		
 		
		$js = 'jQuery(document).ready(function($){';
		$js .= 'window.carousel_'.$block['id'].' = $("#content-slider-'.$block['id'].'.owl-carousel").owlCarousel({';
		$js .= $carouselParams;
		$js .= '});});';

		return $js;
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