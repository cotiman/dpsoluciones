<?php
/**
 * Page template for Studio Dark Portfolio
 *
 * @package Studio_Dark_Portfolio
 */

get_header(); ?>

<main id="primary" class="site-main pt-32 pb-24 px-6">
    <div class="studio-container max-w-4xl mx-auto space-y-8">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'glass-card p-8 sm:p-12 rounded-3xl space-y-6' ); ?>>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white title-sequel"><?php the_title(); ?></h1>
                <div class="text-slate-300 text-sm sm:text-base leading-relaxed space-y-4">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
