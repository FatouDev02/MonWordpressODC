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
$kushak_default = kushak_get_default_theme_options(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('theme-blog-article twp-archive-items'); ?>>
    <div class="entry-wrapper">

        <?php if (has_post_thumbnail()) {
            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
            $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>

            <div class="entry-thumbnail">
                <a href="<?php the_permalink(); ?>" class="data-bg data-bg-big" data-background="<?php echo esc_url($featured_image); ?>">
                </a>
            </div>

        <?php } ?>

        <div class="post-content mt-20">

            <div class="entry-meta theme-meta-categories">

                <?php kushak_entry_footer($cats = true, $tags = false, $edits = false); ?>

            </div>

            <header class="entry-header">

                <h3 class="entry-title entry-title-big">

                    <a href="<?php the_permalink(); ?>">

                        <?php the_title(); ?>

                    </a>
                </h3>

            </header>

            <div class="entry-meta">

                <?php
                kushak_posted_by();
                ?>

            </div>

            <?php kushak_excerpt_content(); ?>

            <?php kushak_read_more_render(); ?>

        </div>

    </div>
</article>