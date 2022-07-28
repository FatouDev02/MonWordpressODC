<?php
if ( !class_exists('Kushak_Dashboard_Notice') ):

    class Kushak_Dashboard_Notice
    {
        function __construct()
        {   
            global $pagenow;

            if( $this->kushak_show_hide_notice() ){

                add_action( 'admin_notices',array( $this,'kushak_admin_notiece' ) );
            }
            add_action( 'wp_ajax_kushak_notice_dismiss', array( $this, 'kushak_notice_dismiss' ) );
            add_action( 'switch_theme', array( $this, 'kushak_notice_clear_cache' ) );
        
            if( isset( $_GET['page'] ) && $_GET['page'] == 'kushak-about' ){

                add_action('in_admin_header', array( $this,'kushak_hide_all_admin_notice' ),1000 );

            }
        }

        public function kushak_hide_all_admin_notice(){

            remove_all_actions('admin_notices');
            remove_all_actions('all_admin_notices');

        }
        
        public static function kushak_show_hide_notice( $status = false ){

            if( $status ){

                if( (class_exists( 'Booster_Extension_Class' ) ) || get_option('kushak_admin_notice') ){

                    return false;

                }else{

                    return true;

                }

            }

            // Check If current Page 
            if ( isset( $_GET['page'] ) && $_GET['page'] == 'kushak-about'  ) {
                return false;
            }

            // Hide if dismiss notice
            if( get_option('kushak_admin_notice') ){
                return false;
            }
            // Hide if all plugin active
            if ( class_exists( 'Booster_Extension_Class' ) && class_exists( 'WPCF7_ContactForm' )  ) {
                return false;
            }
            // Hide On TGMPA pages
            if ( ! empty( $_GET['tgmpa-nonce'] ) ) {
                return false;
            }
            // Hide if user can't access
            if ( current_user_can( 'manage_options' ) ) {
                return true;
            }
            
        }

        // Define Global Value
        public static function kushak_admin_notiece(){

            ?>
            <div class="updated notice is-dismissible twp-kushak-notice">

                <h3><?php esc_html_e('Quick Setup','kushak'); ?></h3>

                <p><strong><?php esc_html_e('Kushak is now installed and ready to use. Are you looking for a better experience to set up your site?','kushak'); ?></strong></p>

                <small><?php esc_html_e("We've prepared a unique onboarding process through our",'kushak'); ?> <a href="<?php echo esc_url( admin_url().'themes.php?page='.get_template().'-about') ?>"><?php esc_html_e('Getting started','kushak'); ?></a> <?php esc_html_e("page. It helps you get started and configure your upcoming website with ease. Let's make it shine!",'kushak'); ?></small>

                <p>
                    <a class="button button-primary twp-install-active" href="javascript:void(0)"><?php esc_html_e('Install and activate recommended plugins','kushak'); ?></a>
                    <span class="quick-loader-wrapper"><span class="quick-loader"></span></span>

                    <a target="_blank" class="button button-primary" href="<?php echo esc_url( 'https://live-preview.themeinwp.com/kushak/' ); ?>"><?php esc_html_e('View Demo','kushak'); ?></a>
                    <a target="_blank" class="button button-primary button-primary-upgrade" href="<?php echo esc_url( 'https://www.themeinwp.com/theme/kushak-pro/' ); ?>"><?php esc_html_e('Upgrade to Pro','kushak'); ?></a>
                    <a class="btn-dismiss twp-custom-setup" href="javascript:void(0)"><?php esc_html_e('Dismiss this notice.','kushak'); ?></a>

                </p>

            </div>

        <?php
        }

        public function kushak_notice_dismiss(){

            if ( isset( $_POST[ '_wpnonce' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ '_wpnonce' ] ) ), 'kushak_ajax_nonce' ) ) {

                update_option('kushak_admin_notice','hide');

            }

            die();

        }

        public function kushak_notice_clear_cache(){

            update_option('kushak_admin_notice','');

        }

    }
    new Kushak_Dashboard_Notice();
endif;