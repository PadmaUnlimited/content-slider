<?php

class PadmaContentSliderBlockOptions extends PadmaBlockOptionsAPI {

	public $tabs = array(
		'content-tab' 	=> 'Content',
		'slider-tab' 	=> 'Settings',
	);


	public $inputs = array(

		'content-tab' => array(
			'post-type' => array(
				'type' => 'select',
				'name' => 'post-type',
				'label' => 'Which Product',
				'options' => array(
					'none' 		=> 'Choose your product',
					'woo' 		=> 'WooCommerce',
					'cf7' 		=> 'Contact Form 7',
					'gravity' 	=> 'Gravity Forms',
					'price' 	=> 'Price Tables'
				),
				'default' => 'post',
				'tooltip' => '',		
				'options' => 'get_post_types()',
				'callback' => ''
			),

			'categories' => array(
				'type' => 'multi-select',
				'name' => 'categories',
				'label' => 'Categories',
				'tooltip' => '',
				'options' => 'get_categories()'
			),

			'order-by' => array(
				'type' => 'select',
				'name' => 'order-by',
				'label' => 'Order By',
				'tooltip' => '',
				'options' => array(
					'date' => 'Date',
					'title' => 'Title',
					'rand' => 'Random',
					'comment_count' => 'Comment Count',
					'ID' => 'ID',
					'author' => 'Author',
					'type' => 'Post Type',
					'menu_order' => 'Custom Order'
				)
			),
			
			'order' => array(
				'type' => 'select',
				'name' => 'order',
				'label' => 'Order',
				'tooltip' => '',
				'options' => array(
					'desc' => 'Descending',
					'asc' => 'Ascending',
				)
			),

			'only-featured' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'only-featured',
				'label' 	=> 'Only show featured image',
				'tooltip' 	=> 'Only show featured image',
			),
		),
		'slider-tab' => array(

			'items' => array(
				'type' 		=> 'integer',
				'default' 	=> 3,
				'name' 		=> 'items',
				'label' 	=> 'Items to show',
				'tooltip' 	=> 'The number of items you want to see on the screen.',				
			),

			'margin' => array(
				'type' 		=> 'integer',
				'default' 	=> 0,
				'name' 		=> 'margin',
				'label' 	=> 'Item right margin',
				'tooltip' 	=> 'margin-right(px) on item.',
			),

			'loop' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'loop',
				'label' 	=> 'Loop',
				'tooltip' 	=> 'Infinity loop. Duplicate last and first items to get loop illusion.',
			),

			'center' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'center',
				'label' 	=> 'Center',
				'tooltip' 	=> 'Center item. Works well with even an odd number of items.',
			),

			'mouse-drag' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'mouse-drag',
				'label' 	=> 'Mouse Drag',
				'tooltip' 	=> 'Mouse drag enabled.',
			),

			'touch-drag' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'touch-drag',
				'label' 	=> 'Touch Drag',
				'tooltip' 	=> 'Touch drag enabled.',
			),
			
			'pull-drag' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'pull-drag',
				'label' 	=> 'Pull Drag',
				'tooltip' 	=> 'Stage pull to edge.',
			),

			'free-drag' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'free-drag',
				'label' 	=> 'Free Drag',
				'tooltip' 	=> 'Item pull to edge.',
			),

			'stage-padding' => array(
				'type' 		=> 'integer',
				'default' 	=> 0,
				'name' 		=> 'stage-padding',
				'label' 	=> 'Stage Padding',
				'tooltip' 	=> 'Padding left and right on stage (can see neighbours).',
			),

			'merge' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'merge',
				'label' 	=> 'Merge',
				'tooltip' 	=> 'Merge items. Looking for data-merge=\'{number}\' inside item..',
			),

			'merge-fit' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'merge-fit',
				'label' 	=> 'Merge Fit',
				'tooltip' 	=> 'Fit merged items if screen is smaller than items value.',
			),			

			'auto-width' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'auto-width',
				'label' 	=> 'Auto Width',
				'tooltip' 	=> 'Set non grid content. Try using width style on divs.',
			),
			
			'start-position' => array(
				'type' 		=> 'integer',
				'default' 	=> 0,
				'name' 		=> 'start-position',
				'label' 	=> 'Start Position',
				'tooltip' 	=> 'Start position',
			),

			'url-hash-listener' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'url-hash-listener',
				'label' 	=> 'URL hash Listener',
				'tooltip' 	=> 'Listen to url hash changes. data-hash on items is required.',
			),

			'nav' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'nav',
				'label' 	=> 'Show next/prev buttons.',
				'tooltip' 	=> 'Show next/prev buttons.',
			),

			'rewind' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'rewind',
				'label' 	=> 'Rewind',
				'tooltip' 	=> 'Go backwards when the boundary has reached.',
			),

			'nav-text-next' => array(
				'type' 		=> 'text',
				'default' 	=> null,
				'name' 		=> 'nav-text-next',
				'label' 	=> '"Next" text',
				'tooltip' 	=> 'HTML allowed.',
			),

			'nav-text-prev' => array(
				'type' 		=> 'text',
				'default' 	=> null,
				'name' 		=> 'nav-text-prev',
				'label' 	=> '"Prev" text',
				'tooltip' 	=> 'HTML allowed.',
			),

			'nav-element' => array(
				'type' 		=> 'text',
				'default' 	=> 'div',
				'name' 		=> 'nav-element',
				'label' 	=> 'Nav element',
				'tooltip' 	=> 'DOM element type for a single directional navigation link.',
			),

			'slide-by' => array(
				'type' 		=> 'integer',
				'default' 	=> 1,
				'name' 		=> 'slide-by',
				'label' 	=> 'Slide By',
				'tooltip' 	=> 'Navigation slide by x. \'page\' string can be set to slide by page.',
			),

			'slide-transition' => array(
				'type' 		=> 'text',
				'default' 	=> null,
				'name' 		=> 'slide-transition',
				'label' 	=> 'Slide Transition',
				'tooltip' 	=> 'You can define the transition for the stage you want to use eg. linear.',
			),

			'dots' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'dots',
				'label' 	=> 'Dots',
				'tooltip' 	=> 'Show dots navigation.',
			),

			'dots-each' => array(
				'type' 		=> 'integer',
				'default' 	=> 0,
				'name' 		=> 'dots-each',
				'label' 	=> 'Show dots each x item.',
				'tooltip' 	=> 'Show dots each x item.',
			),

			'dots-data' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'dots-data',
				'label' 	=> 'Dots Data',
				'tooltip' 	=> 'Used by data-dot content.',
			),

			'lazy-load' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'lazy-load',
				'label' 	=> 'Lazy Load',
				'tooltip' 	=> 'Lazy load images. data-src and data-src-retina for highres. Also load images into background inline style if element is not <img>',
			),

			'lazy-load-eager' => array(
				'type' 		=> 'integer',
				'default' 	=> 0,
				'name' 		=> 'lazy-load-eager',
				'label' 	=> 'Lazy Load Eager',
				'tooltip' 	=> 'Eagerly pre-loads images to the right (and left when loop is enabled) based on how many items you want to preload.',
			),

			'autoplay' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'autoplay',
				'label' 	=> 'Auto Play',
				'tooltip' 	=> 'Autoplay',
			),

			'autoplay-timeout' => array(
				'type' 		=> 'integer',
				'default' 	=> 5000,
				'name' 		=> 'autoplay-timeout',
				'label' 	=> 'Auto Play Timeout',
				'tooltip' 	=> 'Autoplay interval timeout.',
			),

			'autoplay-hover-pause' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'autoplay-hover-pause',
				'label' 	=> 'Pause on Hover',
				'tooltip' 	=> 'Pause on mouse hover.',
			),
			/*
			'smartSpeed' => array(
				'type' 		=> 'integer',
				'default' 	=> 250,
				'name' 		=> 'smartSpeed',
				'label' 	=> 'Smart Speed',
				'tooltip' 	=> 'Speed Calculate. More info to come..',
			),

			'fluidSpeed' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'fluidSpeed',
				'label' 	=> 'Fluid Speed',
				'tooltip' 	=> 'Speed Calculate. More info to come..',
			),

			'autoplaySpeed' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'autoplaySpeed',
				'label' 	=> 'Autoplay speed.',
				'tooltip' 	=> 'Autoplay speed.',
			),

			'navSpeed' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'navSpeed',
				'label' 	=> 'Nav speed.',
				'tooltip' 	=> 'Navigation speed.',
			),

			'dotsSpeed' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'dotsSpeed',
				'label' 	=> 'Dots speed.',
				'tooltip' 	=> 'Pagination speed.',
			),

			'dragEndSpeed' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'dragEndSpeed',
				'label' 	=> 'Drag End speed.',
				'tooltip' 	=> 'Drag end speed.',
			),
			*/

			'callbacks' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'callbacks',
				'label' 	=> 'Callback.',
				'tooltip' 	=> 'Enable callback events.',
			),

			/*
				To DO
			'responsive' => array(
				'type' 		=> 'object',
				'default' 	=> '',
				'name' 		=> 'responsive',
				'label' 	=> 'Responsive',
				'tooltip' 	=> 'Object containing responsive options. Can be set to false to remove responsive capabilities.',
			),*/

			'responsive-refresh-rate' => array(
				'type' 		=> 'integer',
				'default' 	=> 200,
				'name' 		=> 'responsive-refresh-rate',
				'label' 	=> 'Responsive Refresh Rate',
				'tooltip' 	=> 'Responsive refresh rate.',
			),
			/*
				To Do
			'responsiveBaseElement' => array(
				'type' 		=> 'DOM element ',
				'default' 	=> 200,
				'name' 		=> 'responsiveBaseElement',
				'label' 	=> 'Responsive Base Element',
				'tooltip' 	=> 'Responsive refresh rate.',
			),
			*/


			'video' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'video',
				'label' 	=> 'Video.',
				'tooltip' 	=> 'Enable fetching YouTube/Vimeo/Vzaar videos.',
			),

			'video-height' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'video-height',
				'label' 	=> 'Video height.',
				'tooltip' 	=> 'Set height for videos.',
			),

			'video-width' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'video-width',
				'label' 	=> 'Video width.',
				'tooltip' 	=> 'Set width for videos.',
			),

			'animate-out' => array(
				'type' 		=> 'text',
				'default' 	=> null,
				'name' 		=> 'animate-out',
				'label' 	=> 'AnimateOut Class',
				'tooltip' 	=> 'Class for CSS3 animation out.',
			),

			'animate-in' => array(
				'type' 		=> 'text',
				'default' 	=> null,
				'name' 		=> 'animate-in',
				'label' 	=> 'AnimateIn Class',
				'tooltip' 	=> 'Class for CSS3 animation in.',
			),

			'fallback-easing' => array(
				'type' 		=> 'text',
				'default' 	=> null,
				'name' 		=> 'fallback-easing',
				'label' 	=> 'Fallback Easing',
				'tooltip' 	=> 'Easing for CSS2 $.animate.',
			),
			/*

				To Do
			'info' => array(
				'type' 		=> 'function',
				'default' 	=> null,
				'name' 		=> 'info',
				'label' 	=> 'Fallback Easing',
				'tooltip' 	=> 'Callback to retrieve basic information (current item/pages/widths). Info function second parameter is Owl DOM object reference.',
			),
			*/

			'nested-item-selector' => array(
				'type' 		=> 'text',
				'default' 	=> null,
				'name' 		=> 'nested-item-selector',
				'label' 	=> 'Nested Item Selector',
				'tooltip' 	=> 'Use it if owl items are deep nested inside some generated content. E.g \'youritem\'. Dont use dot before class name.',
			),

			'item-element' => array(
				'type' 		=> 'text',
				'default' 	=> 'div',
				'name' 		=> 'item-element',
				'label' 	=> 'Item Element',
				'tooltip' 	=> 'DOM element type for owl-item.',
			),

			'stage-element' => array(
				'type' 		=> 'text',
				'default' 	=> 'div',
				'name' 		=> 'stage-element',
				'label' 	=> 'Stage Element',
				'tooltip' 	=> 'DOM element type for owl-stage.',
			),

			'nav-container' => array(
				'type' 		=> 'text',
				'default' 	=> null,
				'name' 		=> 'nav-container',
				'label' 	=> 'Nav container',
				'tooltip' 	=> 'Set your own container for nav.',
			),

			'dots-container' => array(
				'type' 		=> 'text',
				'default' 	=> null,
				'name' 		=> 'dots-container',
				'label' 	=> 'Dots container',
				'tooltip' 	=> 'Set your own container for nav.',
			),

			'check-visible' => array(
				'type' 		=> 'checkbox',
				'default' 	=> false,
				'name' 		=> 'check-visible',
				'label' 	=> 'Check Visible.',
				'tooltip' 	=> 'If you know the carousel will always be visible you can set `checkVisibility` to `false` to prevent the expensive browser layout forced reflow the $element.is(\':visible\') does.',
			),
		),

	);

	function get_categories() {
		
		$category_options 			= array();		
		$categories_select_query 	= get_categories();
		
		foreach ($categories_select_query as $category)
			$category_options[$category->term_id] = $category->name;

		return $category_options;	
	}

	function get_tags() {
		
		$tag_options = array();
		$tags_select_query = get_terms('post_tag');
		foreach ($tags_select_query as $tag)
			$tag_options[$tag->term_id] = $tag->name;
		$tag_options = (count($tag_options) == 0) ? array('text'	 => 'No tags available') : $tag_options;
		return $tag_options;
	}

	function get_post_types() {
		
		$post_type_options 	= array();
		$post_types 		= get_post_types(false, 'objects'); 
			
		foreach($post_types as $post_type_id => $post_type){
			
			//Make sure the post type is not an excluded post type.
			if(in_array($post_type_id, array('revision', 'nav_menu_item'))) 
				continue;
			
			$post_type_options[$post_type_id] = $post_type->labels->name;
		
		}
		
		return $post_type_options;
	}

	function get_authors() {
		
		$author_options = array();
		
		$authors = get_users(array(
			'orderby' => 'post_count',
			'order' => 'desc',
			'who' => 'authors'
		));
		
		foreach ( $authors as $author )
			$author_options[$author->ID] = $author->display_name;
			
		return $author_options;	
	}

	function get_taxonomies() {

		$taxonomy_options = array('&ndash; Default: Category &ndash;');

		$taxonomy_select_query=get_taxonomies(false, 'objects', 'or');

		
		foreach ($taxonomy_select_query as $taxonomy)
			$taxonomy_options[$taxonomy->name] = $taxonomy->label;
		
		
		return $taxonomy_options;
	}

	function get_post_status() {
		
		return get_post_stati();
		
	}
}