<?php
/**
 * bs-sliders.php
 *---------------------------
 * [bs-sldiers-{1,2,3}] shortcode
 *
 */


/**
 * Publisher Slider 1
 */
class Publisher_Slider_1_Shortcode extends Publisher_Theme_Listing_Shortcode {

	function __construct( $id, $options ) {

		$id = 'bs-slider-1';

		$_options = array(
			'defaults'       => array(
				'title'         => '',
				'hide_title'    => 1,
				'icon'          => '',
				'heading_style' => 'default',

				'category'    => '',
				'tag'         => '',
				'post_ids'    => '',
				'post_type'   => '',
				'offset'      => '',
				'count'       => 4,
				'order_by'    => 'date',
				'order'       => 'DESC',
				'time_filter' => '',

				'style' => 'slider-1',

				'animation'       => 'fade',
				'slideshow_speed' => 7000,
				'animation_speed' => 600,

				'tabs'            => FALSE,
				'tabs_cat_filter' => '',
			),
			'have_widget'    => FALSE,
			'have_vc_add_on' => TRUE,
		);

		if ( isset( $options['shortcode_class'] ) ) {
			$_options['shortcode_class'] = $options['shortcode_class'];
		}

		parent::__construct( $id, $_options );

	}


	/**
	 * Display the inner content of listing
	 *
	 * @param string $atts         Attribute of shortcode or ajax action
	 * @param string $tab          Tab
	 * @param string $pagin_button Ajax action button
	 */
	function display_content( &$atts, $tab = '', $pagin_button = '' ) {

		$class = '';

		$atts = publisher_improve_block_atts_for_size( $atts, 'slider-1' );

		if ( isset( $atts['mg-layout'] ) ) {
			$class .= " {$atts['mg-layout']}";
		}

		if ( ! empty( $class ) ) {
			publisher_set_prop( 'listing-class', $class );
		}

		publisher_set_prop( 'bs-slider-1', $atts );

		if ( ! publisher_get_prop( 'block-customized', FALSE ) && publisher_have_posts() ) {

			$block_settings = publisher_get_option( 'listing-bs-slider-1' );

			if ( $block_settings_override = publisher_get_prop( 'block-settings-override' ) ) {
				$block_settings = array_merge( $block_settings, $block_settings_override );
			}
			$block_settings_override = NULL;

			publisher_set_prop( 'title-limit', $block_settings['title-limit'] );
			publisher_set_prop( 'show-subtitle', $block_settings['subtitle'] );

			if ( $block_settings['subtitle'] ) {
				publisher_set_prop( 'subtitle-limit', $block_settings['subtitle-limit'] );
				publisher_set_prop( 'subtitle-location', $block_settings['subtitle-location'] );
			}

			publisher_set_prop( 'show-term-badge', $block_settings['term-badge'] );
			publisher_set_prop( 'term-badge-count', $block_settings['term-badge-count'] );
			publisher_set_prop( 'show-format-icon', $block_settings['format-icon'] );
			publisher_set_prop( 'show-meta', $block_settings['meta']['show'] );

			if ( $block_settings['meta']['show'] ) {
				publisher_set_prop( 'hide-meta-author', ! $block_settings['meta']['author'] );
				publisher_set_prop( 'hide-meta-date', ! $block_settings['meta']['date'] );
				publisher_set_prop( 'meta-date-format', $block_settings['meta']['date-format'] );
				publisher_set_prop( 'hide-meta-view', ! $block_settings['meta']['view'] );
				publisher_set_prop( 'hide-meta-share', ! $block_settings['meta']['share'] );
				publisher_set_prop( 'hide-meta-comment', ! $block_settings['meta']['comment'] );
				publisher_set_prop( 'hide-meta-review', ! $block_settings['meta']['review'] );
				publisher_set_prop( 'hide-meta-author-if-review', TRUE );
			}

		}

		// Change title tag to p for adding more priority to content heading tags.
		if ( bf_get_current_sidebar() ) {
			publisher_set_blocks_title_tag( 'p' );
		}


		publisher_get_view( 'shortcodes', 'bs-slider-1' );

	}


	public function get_fields() {

		return array_merge(
			$this->filter_fields(),
			array(
				array(
					'type' => 'tab',
					'name' => __( 'Slider', 'publisher' ),
					'id'   => 'slider',
				),
				array(
					'name'           => __( 'Animation', 'publisher' ),
					'id'             => 'animation',
					//
					'type'           => 'select',
					'options'        => array(
						'slide' => __( 'Slide', 'publisher' ),
						'fade'  => __( 'Fade', 'publisher' ),
					),
					//
					'vc_admin_label' => TRUE,
				),
				array(
					'desc'           => __( 'Set the speed of the slideshow cycling, in milliseconds', 'publisher' ),
					'name'           => __( 'Slideshow Speed', 'publisher' ),
					'id'             => 'slideshow_speed',
					'type'           => 'text',
					//
					'vc_admin_label' => TRUE,
				),
				array(
					'desc'           => __( 'Set the speed of animations, in milliseconds', 'publisher' ),
					'name'           => __( 'Animation Speed', 'publisher' ),
					'id'             => 'animation_speed',
					'type'           => 'text',
					//
					'vc_admin_label' => TRUE,
				),
				array(
					'type' => 'tab',
					'name' => __( 'Heading', 'publisher' ),
					'id'   => 'heading',
				),
				array(
					'name'           => __( 'Title', 'publisher' ),
					'id'             => 'title',
					'type'           => 'text',
					//
					'vc_admin_label' => TRUE,
				),
				array(
					'name'           => __( 'Hide Title?', 'publisher' ),
					'id'             => 'hide_title',
					'type'           => 'switch',
					//
					'vc_admin_label' => FALSE,
				),
			),
			parent::get_fields()
		);
	}


	/**
	 * Registers Visual Composer Add-on
	 */
	function register_vc_add_on() {

		vc_map(
			array(
				'name'           => __( 'Slider 1', 'publisher' ),
				"base"           => $this->id,
				"weight"         => 10,
				"wrapper_height" => 'full',
				"category"       => __( 'Publisher', 'publisher' ),
				"params"         => $this->vc_map_listing_all(),
			)
		);
	} // register_vc_add_on

} // Publisher_Slider_1_Shortcode


/**
 * Publisher Slider 2
 */
class Publisher_Slider_2_Shortcode extends Publisher_Theme_Listing_Shortcode {

	function __construct( $id, $options ) {

		$id = 'bs-slider-2';

		$_options = array(
			'defaults'       => array(
				'title'      => '',
				'hide_title' => 1,
				'icon'       => '',

				'category'    => '',
				'tag'         => '',
				'post_ids'    => '',
				'post_type'   => '',
				'offset'      => '',
				'count'       => 4,
				'order_by'    => 'date',
				'order'       => 'DESC',
				'time_filter' => '',

				'style' => 'slider-2',

				'animation'       => 'fade',
				'slideshow_speed' => 7000,
				'animation_speed' => 600,

				'tabs'            => FALSE,
				'tabs_cat_filter' => '',
			),
			'have_widget'    => FALSE,
			'have_vc_add_on' => TRUE,
		);

		if ( isset( $options['shortcode_class'] ) ) {
			$_options['shortcode_class'] = $options['shortcode_class'];
		}

		parent::__construct( $id, $_options );

	}


	/**
	 * Display the inner content of listing
	 *
	 * @param string $atts         Attribute of shortcode or ajax action
	 * @param string $tab          Tab
	 * @param string $pagin_button Ajax action button
	 */
	function display_content( &$atts, $tab = '', $pagin_button = '' ) {

		$class = '';

		$atts = publisher_improve_block_atts_for_size( $atts, 'slider-2' );

		if ( isset( $atts['mg-layout'] ) ) {
			$class .= " {$atts['mg-layout']}";
		}

		if ( ! empty( $class ) ) {
			publisher_set_prop( 'listing-class', $class );
		}

		publisher_set_prop( 'bs-slider-2', $atts );

		if ( ! publisher_get_prop( 'block-customized', FALSE ) && publisher_have_posts() ) {

			$block_settings = publisher_get_option( 'listing-bs-slider-2' );

			if ( $block_settings_override = publisher_get_prop( 'block-settings-override' ) ) {
				$block_settings = array_merge( $block_settings, $block_settings_override );
			}
			$block_settings_override = NULL;


			publisher_set_prop( 'title-limit', $block_settings['title-limit'] );
			publisher_set_prop( 'show-subtitle', $block_settings['subtitle'] );

			if ( $block_settings['subtitle'] ) {
				publisher_set_prop( 'subtitle-limit', $block_settings['subtitle-limit'] );
				publisher_set_prop( 'subtitle-location', $block_settings['subtitle-location'] );
			}

			publisher_set_prop( 'show-term-badge', $block_settings['term-badge'] );
			publisher_set_prop( 'term-badge-count', $block_settings['term-badge-count'] );
			publisher_set_prop( 'show-format-icon', $block_settings['format-icon'] );
			publisher_set_prop( 'show-read-more', $block_settings['read-more'] );
			publisher_set_prop( 'show-meta', $block_settings['meta']['show'] );

			if ( $block_settings['meta']['show'] ) {
				publisher_set_prop( 'hide-meta-author', ! $block_settings['meta']['author'] );
				publisher_set_prop( 'hide-meta-date', ! $block_settings['meta']['date'] );
				publisher_set_prop( 'meta-date-format', $block_settings['meta']['date-format'] );
				publisher_set_prop( 'hide-meta-view', ! $block_settings['meta']['view'] );
				publisher_set_prop( 'hide-meta-share', ! $block_settings['meta']['share'] );
				publisher_set_prop( 'hide-meta-comment', ! $block_settings['meta']['comment'] );
				publisher_set_prop( 'hide-meta-review', ! $block_settings['meta']['review'] );
				publisher_set_prop( 'hide-meta-author-if-review', TRUE );
			}

		}

		// Change title tag to p for adding more priority to content heading tags.
		if ( bf_get_current_sidebar() ) {
			publisher_set_blocks_title_tag( 'p' );
		}

		publisher_get_view( 'shortcodes', 'bs-slider-2' );

	}


	public function get_fields() {

		return array_merge(
			$this->filter_fields(),
			array(
				array(
					'type' => 'tab',
					'name' => __( 'Slider', 'publisher' ),
					'id'   => 'slider',
				),

				array(
					'name'           => __( 'Animation', 'publisher' ),
					'id'             => 'animation',
					//
					'type'           => 'select',
					'options'        => array(
						'slide' => __( 'Slide', 'publisher' ),
						'fade'  => __( 'Fade', 'publisher' ),
					),
					//
					'vc_admin_label' => TRUE,
				),
				array(
					'desc'           => __( 'Set the speed of the slideshow cycling, in milliseconds', 'publisher' ),
					'name'           => __( 'Slideshow Speed', 'publisher' ),
					'id'             => 'slideshow_speed',
					'type'           => 'text',
					//
					'vc_admin_label' => TRUE,
				),
				array(
					'desc'           => __( 'Set the speed of animations, in milliseconds', 'publisher' ),
					'name'           => __( 'Animation Speed', 'publisher' ),
					'id'             => 'animation_speed',
					'type'           => 'text',
					//
					'vc_admin_label' => TRUE,
				),
				array(
					'type' => 'tab',
					'name' => __( 'Heading', 'publisher' ),
					'id'   => 'heading',
				),
				array(
					'name'           => __( 'Title', 'publisher' ),
					'id'             => 'title',
					'type'           => 'text',
					//
					'vc_admin_label' => TRUE,
				),
				array(
					'name'           => __( 'Hide Title?', 'publisher' ),
					'id'             => 'hide_title',
					'type'           => 'switch',
					//
					'vc_admin_label' => FALSE,
				),
			),
			parent::get_fields()
		);
	}


	/**
	 * Registers Visual Composer Add-on
	 */
	function register_vc_add_on() {

		vc_map(
			array(
				'name'           => __( 'Slider 2', 'publisher' ),
				"base"           => $this->id,
				"weight"         => 10,
				"wrapper_height" => 'full',
				"category"       => __( 'Publisher', 'publisher' ),
				"params"         => $this->vc_map_listing_all(),
			)
		);
	} // register_vc_add_on

} // Publisher_Slider_2_Shortcode


/**
 * Publisher Slider 3
 */
class Publisher_Slider_3_Shortcode extends Publisher_Theme_Listing_Shortcode {

	function __construct( $id, $options ) {

		$id = 'bs-slider-3';

		$_options = array(
			'defaults'       => array(
				'title'      => '',
				'hide_title' => 1,
				'icon'       => '',

				'category'    => '',
				'tag'         => '',
				'post_ids'    => '',
				'post_type'   => '',
				'offset'      => '',
				'count'       => 4,
				'order_by'    => 'date',
				'order'       => 'DESC',
				'time_filter' => '',

				'style' => 'slider-3',

				'animation'       => 'fade',
				'slideshow_speed' => 7000,
				'animation_speed' => 600,

				'tabs'            => FALSE,
				'tabs_cat_filter' => '',
			),
			'have_widget'    => FALSE,
			'have_vc_add_on' => TRUE,
		);

		if ( isset( $options['shortcode_class'] ) ) {
			$_options['shortcode_class'] = $options['shortcode_class'];
		}

		parent::__construct( $id, $_options );

	}


	/**
	 * Display the inner content of listing
	 *
	 * @param string $atts         Attribute of shortcode or ajax action
	 * @param string $tab          Tab
	 * @param string $pagin_button Ajax action button
	 */
	function display_content( &$atts, $tab = '', $pagin_button = '' ) {

		$class = '';
		$atts  = publisher_improve_block_atts_for_size( $atts, 'slider-3' );

		if ( isset( $atts['mg-layout'] ) ) {
			$class .= " {$atts['mg-layout']}";
		}

		if ( ! empty( $class ) ) {
			publisher_set_prop( 'listing-class', $class );
		}

		publisher_set_prop( 'bs-slider-3', $atts );

		if ( ! publisher_get_prop( 'block-customized', FALSE ) && publisher_have_posts() ) {

			$block_settings = publisher_get_option( 'listing-bs-slider-3' );

			if ( $block_settings_override = publisher_get_prop( 'block-settings-override' ) ) {
				$block_settings = array_merge( $block_settings, $block_settings_override );
			}
			$block_settings_override = NULL;


			publisher_set_prop( 'title-limit', $block_settings['title-limit'] );
			publisher_set_prop( 'show-subtitle', $block_settings['subtitle'] );

			if ( $block_settings['subtitle'] ) {
				publisher_set_prop( 'subtitle-limit', $block_settings['subtitle-limit'] );
				publisher_set_prop( 'subtitle-location', $block_settings['subtitle-location'] );
			}

			publisher_set_prop( 'show-term-badge', $block_settings['term-badge'] );
			publisher_set_prop( 'term-badge-count', $block_settings['term-badge-count'] );
			publisher_set_prop( 'show-format-icon', $block_settings['format-icon'] );
			publisher_set_prop( 'show-read-more', $block_settings['read-more'] );
			publisher_set_prop( 'show-meta', $block_settings['meta']['show'] );

			if ( $block_settings['meta']['show'] ) {
				publisher_set_prop( 'hide-meta-author', ! $block_settings['meta']['author'] );
				publisher_set_prop( 'hide-meta-date', ! $block_settings['meta']['date'] );
				publisher_set_prop( 'meta-date-format', $block_settings['meta']['date-format'] );
				publisher_set_prop( 'hide-meta-view', ! $block_settings['meta']['view'] );
				publisher_set_prop( 'hide-meta-share', ! $block_settings['meta']['share'] );
				publisher_set_prop( 'hide-meta-comment', ! $block_settings['meta']['comment'] );
				publisher_set_prop( 'hide-meta-review', ! $block_settings['meta']['review'] );
				publisher_set_prop( 'hide-meta-author-if-review', TRUE );
			}

		}

		// Change title tag to p for adding more priority to content heading tags.
		if ( bf_get_current_sidebar() ) {
			publisher_set_blocks_title_tag( 'p' );
		}

		publisher_get_view( 'shortcodes', 'bs-slider-3' );

	}


	public function get_fields() {

		return array_merge(
			$this->filter_fields(),
			array(
				array(
					'type' => 'tab',
					'name' => __( 'Slider', 'publisher' ),
					'id'   => 'slider',
				),
				array(
					'name'           => __( 'Animation', 'publisher' ),
					'id'             => 'animation',
					//
					'type'           => 'select',
					'options'        => array(
						'slide' => __( 'Slide', 'publisher' ),
						'fade'  => __( 'Fade', 'publisher' ),
					),
					//
					'vc_admin_label' => TRUE,
				),
				array(
					'desc'           => __( 'Set the speed of the slideshow cycling, in milliseconds', 'publisher' ),
					'name'           => __( 'Slideshow Speed', 'publisher' ),
					'id'             => 'slideshow_speed',
					'type'           => 'text',
					//
					'vc_admin_label' => TRUE,
				),
				array(
					'desc'           => __( 'Set the speed of animations, in milliseconds', 'publisher' ),
					'name'           => __( 'Animation Speed', 'publisher' ),
					'id'             => 'animation_speed',
					'type'           => 'text',
					//
					'vc_admin_label' => TRUE,
				),
				array(
					'type' => 'tab',
					'name' => __( 'Heading', 'publisher' ),
					'id'   => 'heading',
				),
				array(
					'name'           => __( 'Title', 'publisher' ),
					'type'           => 'text',
					'id'             => 'title',
					//
					'vc_admin_label' => TRUE,
				),
				array(
					'name'           => __( 'Hide Title?', 'publisher' ),
					'type'           => 'switch',
					'id'             => 'hide_title',
					//
					'vc_admin_label' => FALSE,
				),
			),
			parent::get_fields()
		);
	}


	/**
	 * Registers Visual Composer Add-on
	 */
	function register_vc_add_on() {

		vc_map(
			array(
				'name'           => __( 'Slider 3', 'publisher' ),
				"base"           => $this->id,
				"weight"         => 10,
				"wrapper_height" => 'full',
				"category"       => __( 'Publisher', 'publisher' ),
				"params"         => $this->vc_map_listing_all(),
			)
		);
	} // register_vc_add_on

} // Publisher_Slider_3_Shortcode
