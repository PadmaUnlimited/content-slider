<?php 

class PadmaContentSliderBlock extends PadmaBlockAPI {

    public $id 				= 'content-slider-block';    
    public $name 			= 'Content Slider';
    public $options_class 	= 'PadmaContentSliderBlockOptions';
    public $categories 		= array('content','gallery');
    
			
	function setup_elements() {
		
		$this->register_block_element(array(
			'id' => 'slide',
			'name' => 'Slide',
			'selector' => '.owl-item'
		));

		$this->register_block_element(array(
			'id' => 'slide-p',
			'name' => 'Slide text',
			'selector' => '.owl-item p'
		));

		$this->register_block_element(array(
			'id' => 'slide-a',
			'name' => 'Slide link',
			'selector' => '.owl-item a'
		));

		$this->register_block_element(array(
			'id' => 'slide-h1',
			'name' => 'Slide H1',
			'selector' => '.owl-item h1'
		));

		$this->register_block_element(array(
			'id' => 'slide-h2',
			'name' => 'Slide H2',
			'selector' => '.owl-item h2'
		));

		$this->register_block_element(array(
			'id' => 'slide-h3',
			'name' => 'Slide H3',
			'selector' => '.owl-item h3'
		));

		$this->register_block_element(array(
			'id' => 'slide-h4',
			'name' => 'Slide H4',
			'selector' => '.owl-item h4'
		));

		$this->register_block_element(array(
			'id' => 'slide-h5',
			'name' => 'Slide H5',
			'selector' => '.owl-item h5'
		));

		$this->register_block_element(array(
			'id' => 'slide-ul',
			'name' => 'Slide UL',
			'selector' => '.owl-item ul'
		));


		$this->register_block_element(array(
			'id' => 'slide-li',
			'name' => 'Slide LI',
			'selector' => '.owl-item li'
		));

		$this->register_block_element(array(
			'id' => 'dots',
			'name' => 'Dots',
			'selector' => '.owl-dots'
		));

		$this->register_block_element(array(
			'id' => 'dots-item',
			'name' => 'Dots Item',
			'selector' => '.owl-dots .owl-dot'
		));

		

	}

	public static function enqueue_action($block_id, $block) {

		wp_enqueue_style('padma-content-slider-owl-carousel-css', plugin_dir_url( __FILE__ ).'css/owl.carousel.min.css');
		wp_enqueue_style('padma-content-slider-owl-theme-css', plugin_dir_url( __FILE__ ).'css/owl.theme.default.min.css');
		//wp_enqueue_style('padma-content-slider-owl-theme-green-css', plugin_dir_url( __FILE__ ).'css/owl.theme.green.min.css');
		wp_enqueue_script('padma-content-slider-slider-js', plugins_url( '/js/owl.carousel.min.js', __FILE__ ), array('jquery'), '1.0', false);
	}

	function content($block) {

		// Content
		$post_type 			= ($block['settings']['post-type']) ? $block['settings']['post-type']: 'post';
		$categories 		= ($block['settings']['categories']) ? $block['settings']['categories']: array();
		$order_by 			= ($block['settings']['order-by']) ? $block['settings']['order-by']: 'date';
		$order 				= ($block['settings']['order']) ? $block['settings']['order']: 'desc';
		$onlyShowTitle 		= ($block['settings']['only-title']) ? true: false;
		$linkTitle 			= ($block['settings']['link-title']) ? true: false;
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

			if($onlyShowTitle){
				if($linkTitle){
					$result .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
				}else{
					$result .= '<h3>'.get_the_title().'</h3>';
				}
			}else{

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
			}


		endwhile;
		wp_reset_postdata();

		echo $result;
	}

	public static function dynamic_js($block_id, $block = false) {

		if ( !$block )
			$block = PadmaBlocksData::get_block($block_id);

		// Settings
		$carouselParams = '';

		// Items
		$carouselParams .= 'items:' . ( !empty($block['settings']['items']) && $block['settings']['items'] > 0 ? $block['settings']['items'] : '3' ) . ', ';

		// Margin
		$carouselParams .= 'margin:' . ( !empty($block['settings']['margin']) ? $block['settings']['margin'] : '0' ) . ', ';

		// Loop
		$carouselParams .= 'loop:' . ( !empty($block['settings']['loop']) ? $block['settings']['loop'] : 'false' ) . ', ';

		// Center
		$carouselParams .= 'center:' . ( !empty($block['settings']['center']) ? $block['settings']['center'] : 'false' ) . ', ';

		// mouse-drag
		$carouselParams .= 'mouseDrag:' . ( !empty($block['settings']['mouse-drag']) ? $block['settings']['mouse-drag'] : 'true' ) . ', ';

		// touch-drag
		$carouselParams .= 'touchDrag:' . ( !empty($block['settings']['touch-drag']) ? $block['settings']['touch-drag'] : 'true' ) . ', ';

		// pull-drag
		$carouselParams .= 'pullDrag:' . ( !empty($block['settings']['pull-drag']) ? $block['settings']['pull-drag'] : 'true' ) . ', ';

		// pull-drag
		$carouselParams .= 'freeDrag:' . ( !empty($block['settings']['free-drag']) ? $block['settings']['free-drag'] : 'false' ) . ', ';

		// stagePadding
		$carouselParams .= 'stagePadding:' . ( !empty($block['settings']['stage-padding']) ? $block['settings']['stage-padding'] : '0' ) . ', ';

		// merge
		$carouselParams .= 'merge:'. ( !empty($block['settings']['merge']) ? $block['settings']['merge']: 'false' ) . ', ';
		
		// mergeFit
		$carouselParams .= 'mergeFit:'. ( !empty($block['settings']['merge-fit']) ? $block['settings']['merge-fit']: 'true' ) . ', ';
		
		// autoWidth
		$carouselParams .= 'autoWidth:'. ( !empty($block['settings']['auto-width']) ? 'true': 'false' ) . ', ';
		
		// startPosition
		$carouselParams .= 'startPosition:'. ( !empty($block['settings']['start-position']) ? $block['settings']['start-position']: '0' ) . ', ';
		
		// startPosition
		$carouselParams .= 'URLhashListener:'. ( !empty($block['settings']['url-hash-listener']) ? $block['settings']['url-hash-listener']: '0' ) . ', ';
		
		// nav
		$carouselParams .= 'nav:'. ( !empty($block['settings']['nav']) ? $block['settings']['nav']: 'false' ) . ', ';

		// rewind
		$carouselParams .= 'rewind:'. ( !empty($block['settings']['rewind']) ? $block['settings']['rewind']: 'true' ) . ', ';

		// navText
		if($block['settings']['nav-text-next'] || $block['settings']['nav-text-prev']){
			$navText_next	= ($block['settings']['nav-text-next']) ? $block['settings']['nav-text-next']: '>';
			$navText_prev	= ($block['settings']['nav-text-prev']) ? $block['settings']['nav-text-prev']: '<';
			$navText 		= '["'.$navText_next.'","'.$navText_prev.'"]';
			$carouselParams .= 'navText:"'.$navText.'",';
		}else{
			$carouselParams .= 'navText:"[&#x27;next&#x27;,&#x27;prev&#x27;]",';			
		}

		// navElement
		$carouselParams .= 'navElement:'. ( !empty($block['settings']['nav-element']) ? $block['settings']['nav-element']: '"div"' ) . ', ';

		// slideBy
		$carouselParams .= 'slideBy:'. ( !empty($block['settings']['slide-by']) ? $block['settings']['slide-by']: '1' ) . ', ';

		// slideTransition
		$carouselParams .= 'slideTransition:'. ( !empty($block['settings']['slide-transition']) ? $block['settings']['slide-transition']: '``' ) . ', ';

		// dots
		$carouselParams .= 'dots:'. (!empty($block['settings']['dots']) ? $block['settings']['dots'] : 'true') . ', ';
		
		// dotsEach
		$carouselParams .= 'dotsEach:'. (!empty($block['settings']['dots-each']) ? $block['settings']['dots-each'] : 'false') . ', ';

		// dotsData
		$carouselParams .= 'dotsData:'. (!empty($block['settings']['dots-data']) ? $block['settings']['dots-data'] : 'false') . ', ';
		
		// lazyLoad
		$carouselParams .= 'lazyLoad:'. (!empty($block['settings']['lazy-load']) ? $block['settings']['lazy-load'] : 'false') . ', ';

		// lazyLoadEager
		$carouselParams .= 'lazyLoadEager:'. (!empty($block['settings']['lazy-load-eager']) ? $block['settings']['lazy-load-eager'] : '0') . ', ';
		
		// autoPlay
		$carouselParams .= 'autoPlay:'. (!empty($block['settings']['autoplay']) ? $block['settings']['autoplay'] : 'false') . ', ';
		
		// autoplayTimeout
		$carouselParams .= 'autoplayTimeout:'. (!empty($block['settings']['autoplay-timeout']) ? $block['settings']['autoplay-timeout'] : '5000') . ', ';
		
		// autoplayHoverPause
		$carouselParams 	.= 'autoplayHoverPause:'. (!empty($block['settings']['autoplay-hover-pause']) ? $block['settings']['autoplay-hover-pause'] : 'false') . ', ';

		// smartSpeed
		$carouselParams 	.= 'smartSpeed:'. (!empty($block['settings']['smart-speed']) ? $block['settings']['smart-speed'] : '250') . ', ';		

		// fluidSpeed
		$carouselParams 	.= 'fluidSpeed:'. (!empty($block['settings']['fluid-speed']) ? $block['settings']['fluid-speed'] : 'Number') . ', ';		

		// autoplaySpeed
		$carouselParams 	.= 'autoplaySpeed:'. (!empty($block['settings']['autoplay-speed']) ? $block['settings']['autoplay-speed'] : 'false') . ', ';		
		// navSpeed
		$carouselParams 	.= 'navSpeed:'. (!empty($block['settings']['nav-speed']) ? $block['settings']['nav-speed'] : 'false') . ', ';		

		// dotsSpeed
		$carouselParams 	.= 'dotsSpeed:'. (!empty($block['settings']['dots-speed']) ? $block['settings']['dots-speed'] : 'false') . ', ';		

		// dragEndSpeed
		$carouselParams 	.= 'dragEndSpeed:'. (!empty($block['settings']['dragend-speed']) ? $block['settings']['dragend-speed'] : 'false') . ', ';	

		// callbacks
		$carouselParams 	.= 'callbacks:'. (!empty($block['settings']['callbacks']) ? $block['settings']['callbacks'] : 'false') . ', ';
		
		// responsive
		//$carouselParams 	.= 'responsive:{ 0:{ items: 1 }, 480:{ items: 1 }, 640:{ items: 2 }, 1200:{ items: 3 }  }' . ', ';
				
		// responsiveRefreshRate
		$carouselParams 	.= 'responsiveRefreshRate:'. (!empty($block['settings']['responsive-refresh-rate']) ? $block['settings']['responsive-refresh-rate'] : '200') . ', ';
		
		// responsiveBaseElement
		$carouselParams 	.= 'responsiveBaseElement:'. (!empty($block['settings']['responsive-base-element']) ? $block['settings']['responsive-base-element'] : 'window') . ', ';
		
		// video
		$carouselParams 	.= 'video:'. (!empty($block['settings']['video']) ? $block['settings']['video'] : 'false') . ', ';

		// videoHeight
		$carouselParams 	.= 'videoHeight:'. (!empty($block['settings']['video-height']) ? $block['settings']['video-height'] : 'false') . ', ';
		
		// videoWidth
		$carouselParams 	.= 'videoWidth:'. (!empty($block['settings']['video-width']) ? $block['settings']['video-width'] : 'false') . ', ';

		// animateOut
		$carouselParams 	.= 'animateOut:'. (!empty($block['settings']['animate-out']) ? $block['settings']['animate-out'] : 'false') . ', ';

		// animateIn
		$carouselParams 	.= 'animateIn:'. (!empty($block['settings']['animate-in']) ? $block['settings']['animate-in'] : 'false') . ', ';
		
		// fallbackEasing
		$carouselParams 	.= 'fallbackEasing:'. (!empty($block['settings']['fallback-easing']) ? $block['settings']['fallback-easing'] : '"swing"') . ', ';
		
		// info
		$carouselParams 	.= 'info:'. (!empty($block['settings']['info']) ? $block['settings']['info'] : 'false') . ', ';
		
		// nestedItemSelector
		$carouselParams 	.= 'nestedItemSelector:'. (!empty($block['settings']['nested-item-selector']) ? $block['settings']['nested-item-selector'] : 'false') . ', ';
		
		// itemElement
		$carouselParams 	.= 'itemElement:'. (!empty($block['settings']['item-element']) ? $block['settings']['item-element'] : '"div"') . ', ';
		
		// stageElement
		$carouselParams .= 'stageElement:'. (!empty($block['settings']['stage-element']) ? $block['settings']['stage-element'] : '"div"') . ', ';
		
		// navContainer
		$carouselParams .= 'navContainer:'. (!empty($block['settings']['nav-container']) ? $block['settings']['nav-container'] : 'false') . ', ';
		
		// dotsContainer
		$carouselParams .= 'dotsContainer:'. (!empty($block['settings']['dots-container']) ? $block['settings']['dots-container'] : 'false') . ', ';
		
		// checkVisible
		$carouselParams .= 'checkVisible:'. (!empty($block['settings']['check-visible']) ? $block['settings']['check-visible'] : 'true');
			 
		$js = 'jQuery(document).ready(function($){';
		$js .= 'window.carousel_'.$block['id'].' = jQuery("#content-slider-'.$block['id'].'.owl-carousel").owlCarousel({';
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