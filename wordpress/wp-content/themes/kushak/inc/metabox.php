<?php
/**
* Sidebar Metabox.
*
* @package Kushak
*/
 
add_action( 'add_meta_boxes', 'kushak_metabox' );

if( ! function_exists( 'kushak_metabox' ) ):


    function  kushak_metabox() {
        
        add_meta_box(
            'kushak-custom-metabox',
            esc_html__( 'Layout Settings', 'kushak' ),
            'kushak_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'kushak-custom-metabox',
            esc_html__( 'Layout Settings', 'kushak' ),
            'kushak_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;

$kushak_post_sidebar_fields = array(
    'global-sidebar' => array(
                    'id'        => 'post-global-sidebar',
                    'value' => 'global-sidebar',
                    'label' => esc_html__( 'Global sidebar', 'kushak' ),
                ),
    'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value' => 'right-sidebar',
                    'label' => esc_html__( 'Right sidebar', 'kushak' ),
                ),
    'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left-sidebar',
                    'label'     => esc_html__( 'Left sidebar', 'kushak' ),
                ),
    'no-sidebar' => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no-sidebar',
                    'label'     => esc_html__( 'No sidebar', 'kushak' ),
                ),
);

/**
 * Callback function for post option.
*/
if( ! function_exists( 'kushak_post_metafield_callback' ) ):
    
	function kushak_post_metafield_callback() {
		global $post, $kushak_post_sidebar_fields;
        $post_type = get_post_type($post->ID);
		wp_nonce_field( basename( __FILE__ ), 'kushak_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-general" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('General Settings', 'kushak'); ?>

                        </a>
                    </li>

                    <?php if( $post_type == 'post' ): ?>
                        <li>
                            <a id="metabox-navbar-appearance" href="javascript:void(0)">

                                <?php esc_html_e('Appearance Settings', 'kushak'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ): ?>
                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'kushak'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="twp-tab-content">

                <div id="metabox-navbar-general-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Sidebar Layout','kushak'); ?></h3>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <?php
                            $kushak_post_sidebar = esc_html( get_post_meta( $post->ID, 'kushak_post_sidebar_option', true ) ); 
                            if( $kushak_post_sidebar == '' ){ $kushak_post_sidebar = 'global-sidebar'; }

                            foreach ( $kushak_post_sidebar_fields as $kushak_post_sidebar_field) { ?>

                                <label class="description">

                                    <input type="radio" name="kushak_post_sidebar_option" value="<?php echo esc_attr( $kushak_post_sidebar_field['value'] ); ?>" <?php if( $kushak_post_sidebar_field['value'] == $kushak_post_sidebar ){ echo "checked='checked'";} if( empty( $kushak_post_sidebar ) && $kushak_post_sidebar_field['value']=='right-sidebar' ){ echo "checked='checked'"; } ?>/>&nbsp;<?php echo esc_html( $kushak_post_sidebar_field['label'] ); ?>

                                </label>

                            <?php } ?>

                        </div>

                    </div>

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Navigation Setting','kushak'); ?></h3>

                        <?php $twp_disable_ajax_load_next_post = esc_attr( get_post_meta($post->ID, 'twp_disable_ajax_load_next_post', true) ); ?>
                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <label><b><?php esc_html_e( 'Navigation Type','kushak' ); ?></b></label>

                            <select name="twp_disable_ajax_load_next_post">

                                <option <?php if( $twp_disable_ajax_load_next_post == '' || $twp_disable_ajax_load_next_post == 'global-layout' ){ echo 'selected'; } ?> value="global-layout"><?php esc_html_e('Global Layout','kushak'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'no-navigation' ){ echo 'selected'; } ?> value="no-navigation"><?php esc_html_e('Disable Navigation','kushak'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'norma-navigation' ){ echo 'selected'; } ?> value="norma-navigation"><?php esc_html_e('Next Previous Navigation','kushak'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'ajax-next-post-load' ){ echo 'selected'; } ?> value="ajax-next-post-load"><?php esc_html_e('Ajax Load Next 3 Posts Contents','kushak'); ?></option>

                            </select>

                        </div>
                    </div>

                </div>

                <?php if( $post_type == 'post' ): ?>

                    <div id="metabox-navbar-appearance-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Feature Image Setting','kushak'); ?></h3>

                                <?php
                                $kushak_ed_feature_image = esc_html( get_post_meta( $post->ID, 'kushak_ed_feature_image', true ) ); ?>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="kushak-ed-feature-image" name="kushak_ed_feature_image" value="1" <?php if( $kushak_ed_feature_image ){ echo "checked='checked'";} ?>/>
                                <label for="kushak-ed-feature-image"><?php esc_html_e( 'Disable Feature Image','kushak' ); ?></label>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>

                <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ):

                    
                    $kushak_ed_post_views = esc_html( get_post_meta( $post->ID, 'kushak_ed_post_views', true ) );
                    $kushak_ed_post_read_time = esc_html( get_post_meta( $post->ID, 'kushak_ed_post_read_time', true ) );
                    $kushak_ed_post_like_dislike = esc_html( get_post_meta( $post->ID, 'kushak_ed_post_like_dislike', true ) );
                    $kushak_ed_post_author_box = esc_html( get_post_meta( $post->ID, 'kushak_ed_post_author_box', true ) );
                    $kushak_ed_post_social_share = esc_html( get_post_meta( $post->ID, 'kushak_ed_post_social_share', true ) );
                    $kushak_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'kushak_ed_post_reaction', true ) );
                    $kushak_ed_post_rating = esc_html( get_post_meta( $post->ID, 'kushak_ed_post_rating', true ) );
                    ?>

                    <div id="twp-tab-booster-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content','kushak'); ?></h3>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="kushak-ed-post-views" name="kushak_ed_post_views" value="1" <?php if( $kushak_ed_post_views ){ echo "checked='checked'";} ?>/>
                                <label for="kushak-ed-post-views"><?php esc_html_e( 'Disable Post Views','kushak' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="kushak-ed-post-read-time" name="kushak_ed_post_read_time" value="1" <?php if( $kushak_ed_post_read_time ){ echo "checked='checked'";} ?>/>
                                <label for="kushak-ed-post-read-time"><?php esc_html_e( 'Disable Post Read Time','kushak' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="kushak-ed-post-like-dislike" name="kushak_ed_post_like_dislike" value="1" <?php if( $kushak_ed_post_like_dislike ){ echo "checked='checked'";} ?>/>
                                <label for="kushak-ed-post-like-dislike"><?php esc_html_e( 'Disable Post Like Dislike','kushak' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="kushak-ed-post-author-box" name="kushak_ed_post_author_box" value="1" <?php if( $kushak_ed_post_author_box ){ echo "checked='checked'";} ?>/>
                                <label for="kushak-ed-post-author-box"><?php esc_html_e( 'Disable Post Author Box','kushak' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="kushak-ed-post-social-share" name="kushak_ed_post_social_share" value="1" <?php if( $kushak_ed_post_social_share ){ echo "checked='checked'";} ?>/>
                                <label for="kushak-ed-post-social-share"><?php esc_html_e( 'Disable Post Social Share','kushak' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="kushak-ed-post-reaction" name="kushak_ed_post_reaction" value="1" <?php if( $kushak_ed_post_reaction ){ echo "checked='checked'";} ?>/>
                                <label for="kushak-ed-post-reaction"><?php esc_html_e( 'Disable Post Reaction','kushak' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="kushak-ed-post-rating" name="kushak_ed_post_rating" value="1" <?php if( $kushak_ed_post_rating ){ echo "checked='checked'";} ?>/>
                                <label for="kushak-ed-post-rating"><?php esc_html_e( 'Disable Post Rating','kushak' ); ?></label>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>
                
            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'kushak_save_post_meta' );

if( ! function_exists( 'kushak_save_post_meta' ) ):

    function kushak_save_post_meta( $post_id ) {

        global $post, $kushak_post_sidebar_fields;

        if( !isset( $_POST[ 'kushak_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['kushak_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if( isset(  $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }

        foreach ( $kushak_post_sidebar_fields as $kushak_post_sidebar_field ) {  
            
            $old = esc_attr( get_post_meta( $post_id, 'kushak_post_sidebar_option', true ) ); 
            $new = sanitize_text_field( wp_unslash( $_POST['kushak_post_sidebar_option'] ) );

            if ( $new && $new != $old ){

                update_post_meta ( $post_id, 'kushak_post_sidebar_option', $new );

            }elseif( '' == $new && $old ) {

                delete_post_meta( $post_id,'kushak_post_sidebar_option', $old );

            }
            
        }

        $twp_disable_ajax_load_next_post_old = esc_attr( get_post_meta( $post_id, 'twp_disable_ajax_load_next_post', true ) ); 

        $twp_disable_ajax_load_next_post_new = '';

        if( isset( $_POST['twp_disable_ajax_load_next_post'] ) ){
            $twp_disable_ajax_load_next_post_new = kushak_sanitize_meta_pagination( wp_unslash( $_POST['twp_disable_ajax_load_next_post'] ) );
        }

        if( $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_new != $twp_disable_ajax_load_next_post_old ){

            update_post_meta ( $post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_new );

        }elseif( '' == $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_old ) {

            delete_post_meta( $post_id,'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_old );

        }

        $kushak_ed_feature_image_old = absint( get_post_meta( $post_id, 'kushak_ed_feature_image', true ) );

        $kushak_ed_feature_image_new = '';
        if( isset( $_POST['kushak_ed_feature_image'] ) ){
            $kushak_ed_feature_image_new = absint( wp_unslash( $_POST['kushak_ed_feature_image'] ) );
        }

        if ( $kushak_ed_feature_image_new && $kushak_ed_feature_image_new != $kushak_ed_feature_image_old ){

            update_post_meta ( $post_id, 'kushak_ed_feature_image', $kushak_ed_feature_image_new );

        }elseif( '' == $kushak_ed_feature_image_new && $kushak_ed_feature_image_old ) {

            delete_post_meta( $post_id,'kushak_ed_feature_image', $kushak_ed_feature_image_old );

        }

        $kushak_ed_post_views_old = absint( get_post_meta( $post_id, 'kushak_ed_post_views', true ) );

        $kushak_ed_post_views_new = '';
        if( isset( $_POST['kushak_ed_post_views'] ) ){

            $kushak_ed_post_views_new = absint( wp_unslash( $_POST['kushak_ed_post_views'] ) );

        }

        if( $kushak_ed_post_views_new && $kushak_ed_post_views_new != $kushak_ed_post_views_old ){

            update_post_meta ( $post_id, 'kushak_ed_post_views', $kushak_ed_post_views_new );

        }elseif( '' == $kushak_ed_post_views_new && $kushak_ed_post_views_old ) {

            delete_post_meta( $post_id,'kushak_ed_post_views', $kushak_ed_post_views_old );

        }

        $kushak_ed_post_read_time_old = absint( get_post_meta( $post_id, 'kushak_ed_post_read_time', true ) );

        $kushak_ed_post_read_time_new = '';
        if( isset( $_POST['kushak_ed_post_read_time'] ) ){

            $kushak_ed_post_read_time_new = absint( wp_unslash( $_POST['kushak_ed_post_read_time'] ) );

        }

        if( $kushak_ed_post_read_time_new && $kushak_ed_post_read_time_new != $kushak_ed_post_read_time_old ){

            update_post_meta ( $post_id, 'kushak_ed_post_read_time', $kushak_ed_post_read_time_new );

        }elseif( '' == $kushak_ed_post_read_time_new && $kushak_ed_post_read_time_old ) {

            delete_post_meta( $post_id,'kushak_ed_post_read_time', $kushak_ed_post_read_time_old );

        }

        $kushak_ed_post_like_dislike_old = absint( get_post_meta( $post_id, 'kushak_ed_post_like_dislike', true ) );

        $kushak_ed_post_like_dislike_new = '';
        if( isset( $_POST['kushak_ed_post_like_dislike'] ) ){

            $kushak_ed_post_like_dislike_new = absint( wp_unslash( $_POST['kushak_ed_post_like_dislike'] ) );

        }

        if( $kushak_ed_post_like_dislike_new && $kushak_ed_post_like_dislike_new != $kushak_ed_post_like_dislike_old ){

            update_post_meta ( $post_id, 'kushak_ed_post_like_dislike', $kushak_ed_post_like_dislike_new );

        }elseif( '' == $kushak_ed_post_like_dislike_new && $kushak_ed_post_like_dislike_old ) {

            delete_post_meta( $post_id,'kushak_ed_post_like_dislike', $kushak_ed_post_like_dislike_old );

        }

        $kushak_ed_post_author_box_old = absint( get_post_meta( $post_id, 'kushak_ed_post_author_box', true ) );

        $kushak_ed_post_author_box_new = '';
        if( isset( $_POST['kushak_ed_post_like_dislike'] ) ){

            $kushak_ed_post_author_box_new = absint( wp_unslash( $_POST['kushak_ed_post_like_dislike'] ) );

        }

        if( $kushak_ed_post_author_box_new && $kushak_ed_post_author_box_new != $kushak_ed_post_author_box_old ){

            update_post_meta ( $post_id, 'kushak_ed_post_author_box', $kushak_ed_post_author_box_new );

        }elseif( '' == $kushak_ed_post_author_box_new && $kushak_ed_post_author_box_old ) {

            delete_post_meta( $post_id,'kushak_ed_post_author_box', $kushak_ed_post_author_box_old );

        }

        $kushak_ed_post_social_share_old = absint( get_post_meta( $post_id, 'kushak_ed_post_social_share', true ) );

        $kushak_ed_post_social_share_new = '';
        if( isset( $_POST['kushak_ed_post_social_share'] ) ){

            $kushak_ed_post_social_share_new = absint( wp_unslash( $_POST['kushak_ed_post_social_share'] ) );

        }

        if( $kushak_ed_post_social_share_new && $kushak_ed_post_social_share_new != $kushak_ed_post_social_share_old ){

            update_post_meta ( $post_id, 'kushak_ed_post_social_share', $kushak_ed_post_social_share_new );

        }elseif( '' == $kushak_ed_post_social_share_new && $kushak_ed_post_social_share_old ) {

            delete_post_meta( $post_id,'kushak_ed_post_social_share', $kushak_ed_post_social_share_old );

        }

        $kushak_ed_post_reaction_old = absint( get_post_meta( $post_id, 'kushak_ed_post_reaction', true ) );

        $kushak_ed_post_reaction_new = '';
        if( isset( $_POST['kushak_ed_post_reaction'] ) ){

            $kushak_ed_post_reaction_new = absint( wp_unslash( $_POST['kushak_ed_post_reaction'] ) );

        }

        if( $kushak_ed_post_reaction_new && $kushak_ed_post_reaction_new != $kushak_ed_post_reaction_old ){

            update_post_meta ( $post_id, 'kushak_ed_post_reaction', $kushak_ed_post_reaction_new );

        }elseif( '' == $kushak_ed_post_reaction_new && $kushak_ed_post_reaction_old ) {

            delete_post_meta( $post_id,'kushak_ed_post_reaction', $kushak_ed_post_reaction_old );

        }

        $kushak_ed_post_rating_old = absint( get_post_meta( $post_id, 'kushak_ed_post_rating', true ) );

        $kushak_ed_post_rating_new = '';
        if( isset( $_POST['kushak_ed_post_rating'] ) ){

            $kushak_ed_post_rating_new = absint( wp_unslash( $_POST['kushak_ed_post_rating'] ) );

        }

        if ( $kushak_ed_post_rating_new && $kushak_ed_post_rating_new != $kushak_ed_post_rating_old ){

            update_post_meta ( $post_id, 'kushak_ed_post_rating', $kushak_ed_post_rating_new );

        }elseif( '' == $kushak_ed_post_rating_new && $kushak_ed_post_rating_old ) {

            delete_post_meta( $post_id,'kushak_ed_post_rating', $kushak_ed_post_rating_old );

        }


    }

endif;   