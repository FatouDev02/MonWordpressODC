<?php
/**
 * Default Values.
 *
 * @package Kushak
 */

if ( ! function_exists( 'kushak_get_default_theme_options' ) ) :

    /**
     * Get default theme options
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function kushak_get_default_theme_options() {

        $kushak_defaults = array();
        // Options.
        $kushak_defaults['logo_width_range']      = 260;
        $kushak_defaults['ed_site_description']      = 0;
        $kushak_defaults['kushak_pagination_layout']      = 'numeric';
        $kushak_defaults['footer_column_layout']                       = 2;
        $kushak_defaults['footer_copyright_text']                      = esc_html__( 'All rights reserved.', 'kushak' );
        $kushak_defaults['ed_header_search']                           = 1;
        $kushak_defaults['ed_image_content_inverse']                   = 0;
        $kushak_defaults['ed_related_post']                            = 1;
        $kushak_defaults['related_post_title']                         = esc_html__('Related Post','kushak');
        $kushak_defaults['twp_navigation_type']                        = 'norma-navigation';
        $kushak_defaults['ed_post_author']                             = 1;
        $kushak_defaults['ed_post_date']                               = 1;
        $kushak_defaults['ed_post_category']                           = 1;
        $kushak_defaults['ed_post_tags']                               = 1;
        $kushak_defaults['ed_floating_next_previous_nav']               = 1;
        $kushak_defaults['ed_footer_copyright']                        = 1;

        // Default Color
        $kushak_defaults['background_color']          = 'ffffff';
        $kushak_defaults['kushak_primary_color']          = '#000000';
        $kushak_defaults['kushak_secondary_color']        = '#72df14';
        $kushak_defaults['kushak_general_color']        = '#000000';

        // Simple Color
        $kushak_defaults['kushak_primary_color_dark']          = '#007CED';
        $kushak_defaults['kushak_secondary_color_dark']        = '#fb7268';
        $kushak_defaults['kushak_general_color_dark']        = '#ffffff';

        // Fancy Color
        $kushak_defaults['kushak_primary_color_fancy']          = '#017eff';
        $kushak_defaults['kushak_secondary_color_fancy']        = '#fc9285';
        $kushak_defaults['kushak_general_color_fancy']        = '#455d58';


        $kushak_defaults['ed_category_section']                    = 0;
        
        $kushak_defaults['ed_header_banner']                    = 0;
        $kushak_defaults['header_banner_title']                 = '';
        $kushak_defaults['header_banner_description']           = '';
        $kushak_defaults['header_banner_title_link']             = '';
        $kushak_defaults['header_button_title']                 = '';


        $kushak_defaults['ed_popular_post_section']                 = 1;
        $kushak_defaults['popular_post_section_title']              = esc_html__('Popular Post','kushak');
        $kushak_defaults['popular_post_category_section_cat']       = '';
        $kushak_defaults['number_of_popular_post']                 = 2;
        $kushak_defaults['ed_trending_post_section']                 = 1;
        $kushak_defaults['trending_post_section_title']              = esc_html__('Trending Post','kushak');
        $kushak_defaults['trending_post_section_cat']                 = '';
        $kushak_defaults['number_of_trending_post']                 = 5;


        $kushak_defaults['kushak_color_schema']           = 'default';
        $kushak_defaults['ed_desktop_menu']            = 1;
        $kushak_defaults['ed_post_excerpt']            = 1;
        $kushak_defaults['ed_carousel_section']             = 0;
        $kushak_defaults['carousel_section_title']          = esc_html__('Latest Highlights','kushak');
        $kushak_defaults['ed_carousel_autoplay']             = 1;
        $kushak_defaults['ed_carousel_arrow']             = 1;
        $kushak_defaults['ed_carousel_dots']             = 0;

        $kushak_defaults['ed_banner_similar_post']             = 1;
        $kushak_defaults['banner_similar_post_title']          = esc_html__('More stories from same author','kushak');
        $kushak_defaults['ed_recommended_section']             = 0;
        $kushak_defaults['ed_recommended_section_title']          = esc_html__('You May Also Like','kushak');

        $kushak_defaults['ed_top_filter']                           = 0;
        $kushak_defaults['ed_filter_and_featured_post_section']             = 0;

        $kushak_defaults['ed_banner_slider_section']                           = 1;
        $kushak_defaults['ed_banner_slider_autoplay']                           = 1;
        $kushak_defaults['ed_banner_slider_arrow']                           = 1;
        $kushak_defaults['ed_banner_slider_dots']                           = 0;
        
        
        // homepage contact 
        $kushak_defaults['ed_contact_section']                       = 0;
        $kushak_defaults['contact_section_title']                    = esc_html__( 'Contact us', 'kushak' );
        $kushak_defaults['contact_section_location']                 = '';
        $kushak_defaults['contact_section_email']                    = '';
        $kushak_defaults['contact_section_number']                   = '';



        // Newsletter
        $kushak_defaults['ed_mailchimp_newsletter_section'] = '';
        $kushak_defaults['twp_newsletter_title_section'] = esc_html__('Sign Up to Our Newsletter', 'kushak');
        $kushak_defaults['twp_newsletter_desc_section'] = esc_html__('Get notified about exclusive offers every week!', 'kushak');
        $kushak_defaults['kushak_newsletter_bg_color']             = '#f8e3d5';
        $kushak_defaults['kushak_newsletter_text_color']             = '#2a2c29';

        $kushak_defaults['ed_mailchimp_newsletter'] = '';
        $kushak_defaults['ed_mailchimp_newsletter_home_only'] = '';
        $kushak_defaults['ed_mailchimp_newsletter_first_loading_only'] = '';
        $kushak_defaults['twp_newsletter_title'] = esc_html__('Sign Up to Our Newsletter', 'kushak');
        $kushak_defaults['twp_newsletter_desc'] = esc_html__('Get notified about exclusive offers every week!', 'kushak');

        $kushak_defaults['global_sidebar_layout']             = 'right-sidebar';
        
        $kushak_defaults['home_section_arrange_vals_1']                             =  'kushak_banner_slider_section,header_category_setting,kushak_popular_post_section,kushak_carousel_section,static_front_page,kushak_you_may_like_section,homepage_contact_Section';

        // Pass through filter.
        $kushak_defaults = apply_filters( 'kushak_filter_default_theme_options', $kushak_defaults );

        return $kushak_defaults;

    }

endif;
