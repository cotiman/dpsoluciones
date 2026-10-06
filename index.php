<?php
/**
 * Main index template for Studio Dark Portfolio
 *
 * @package Studio_Dark_Portfolio
 */

get_header(); ?>

<main id="primary" class="site-main pt-32 pb-24 px-6">
    <div class="studio-container max-w-4xl mx-auto space-y-8">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'glass-card p-8 rounded-2xl space-y-4' ); ?>>
                    <h2 class="text-2xl font-bold text-white"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="text-slate-300 text-sm leading-relaxed">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="glass-card p-8 text-center text-slate-400">
                <p><?php esc_html_e( 'No se encontraron publicaciones.', 'studio-dark-portfolio' ); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
