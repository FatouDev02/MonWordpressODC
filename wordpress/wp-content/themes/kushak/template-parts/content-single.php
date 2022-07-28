<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
* @package Kushak
 * @since 1.0.0
 */

$kushak_ed_feature_image = esc_html( get_post_meta( get_the_ID(), 'kushak_ed_feature_image', true ) );
	
$kushak_ed_post_views = esc_html( get_post_meta( get_the_ID(), 'kushak_ed_post_views', true ) );
$kushak_ed_post_read_time = esc_html( get_post_meta( get_the_ID(), 'kushak_ed_post_read_time', true ) );
$kushak_ed_post_like_dislike = esc_html( get_post_meta( get_the_ID(), 'kushak_ed_post_like_dislike', true ) );
$kushak_ed_post_author_box = esc_html( get_post_meta( get_the_ID(), 'kushak_ed_post_author_box', true ) );
$kushak_ed_post_social_share = esc_html( get_post_meta( get_the_ID(), 'kushak_ed_post_social_share', true ) );
$kushak_ed_post_reaction = esc_html( get_post_meta( get_the_ID(), 'kushak_ed_post_reaction', true ) );

kushak_disable_post_views();
kushak_disable_post_read_time();
if( $kushak_ed_post_like_dislike ){ kushak_disable_post_like_dislike(); }
if( $kushak_ed_post_author_box ){ kushak_disable_post_author_box(); }
if( $kushak_ed_post_reaction ){ kushak_disable_post_reaction(); }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php kushak_breadcrumb(); ?>

    <?php
    if( has_post_thumbnail() ){

        if( empty( $kushak_ed_feature_image ) ){ ?>

            <div class="entry-featured-thumbnail mb-20">

	            <div class="entry-thumbnail">

	            	<?php

	            	$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
	            	$featured_image = isset( $featured_image[0] ) ? $featured_image[0] : '';
	            	?>
					<img src="<?php echo esc_url( $featured_image ); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">

	            </div>

	            <?php if( 'post' === get_post_type() && class_exists('Booster_Extension_Class') && ( empty( $kushak_ed_post_views ) || empty( $kushak_ed_post_read_time ) ) ){ ?>

		            <div class="theme-page-vitals">

		            	<?php
		            	if( empty( $kushak_ed_post_read_time ) ){ 
		            		echo do_shortcode('[booster-extension-read-time]');
		            	} ?>

                        <?php
                        if( empty( $kushak_ed_post_views ) ){
                            echo do_shortcode('[booster-extension-visit-count container="true"]');
                        } ?>

					</div>

				<?php } ?>

            </div>
        
        <?php
        }
    }

	if( is_singular() ){ ?>
		
		<?php
		if( 'post' === get_post_type() ){ ?>

	        <div class="entry-meta theme-meta-categories">
	            <?php kushak_entry_footer( $cats = true, $tags = false, $edits = false ); ?>
	        </div>
	        
	    <?php } ?>

		<header class="entry-header">

			<h1 class="entry-title entry-title-big">

	            <?php the_title(); ?>

	        </h1>

		</header>

	<?php }

	if( is_single() && 'post' === get_post_type() ){ ?>

		<div class="entry-meta">

			<?php
			kushak_posted_by();
			?>

		</div>

	<?php  } ?>
	
	<div class="post-content-wrap">

		<?php if( is_singular() && empty( $kushak_ed_post_social_share ) && class_exists( 'Booster_Extension_Class' ) && 'post' === get_post_type() ){ ?>

			<div class="post-content-share">
				<?php echo do_shortcode('[booster-extension-ss layout="layout-1" status="enable"]'); ?>
			</div>

		<?php } ?>

		<div class="post-content">

			<div class="entry-content">

				<?php

				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'kushak' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				if( !class_exists( 'Booster_Extension_Class' ) ){

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kushak' ),
						'after'  => '</div>',
					) );

				} ?>

			</div>

			<?php
			if ( is_singular() && 'post' === get_post_type() ) { ?>

				<div class="entry-footer">
                    <div class="entry-meta">
                        <?php kushak_entry_footer( $cats = false, $tags = true, $edits = true ); ?>
                    </div>
				</div>

			<?php } ?>

		</div>

	</div>

</article>