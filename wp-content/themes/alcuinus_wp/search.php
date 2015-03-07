<?php get_header(); ?>

<main class="row" role="main">
    <div class="col-sm-2"></div>
    <section class="col-sm-8" id="content" role="content">
        <article>
            <header>
                <h1><?php echo sprintf( __( '%s resultaten voor ', 'alcuinus' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>
            </header>
            <hr />
            <?php get_template_part('loop'); ?>

            <?php get_template_part('pagination'); ?>
        </article>
    </section>
    <div class="col-sm-2"></div>
</main>

<?php get_footer(); ?>
