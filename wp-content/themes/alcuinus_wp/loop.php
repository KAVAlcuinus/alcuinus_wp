<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <!-- article -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header>
            <!-- post title -->
            <h3>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            </h3>

            <!-- post details -->
            <span class="date"><?php the_time('j F Y'); ?></span>
            <!-- /post details -->
        </header>
        <!-- /post title -->

        <?php alcuinus_wp_excerpt(); // Build your custom callback length in functions.php ?>

        <?php edit_post_link(); ?>

    </article>
    <!-- /article -->

<?php endwhile; ?>

<?php else: ?>

    <!-- article -->
    <article>
        <h2>Sorry, er is geen inhoud gevonden.</h2>
    </article>
    <!-- /article -->

<?php endif; ?>
