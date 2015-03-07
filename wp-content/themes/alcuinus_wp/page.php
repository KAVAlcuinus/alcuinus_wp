<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post();

    if (!is_category() && !is_archive()) {
        $args = array(
            'sort_order' => 'ASC',
            'sort_column' => 'post_title',
            'hierarchical' => 0,
            'child_of' => get_the_ID(),
            'depth' => 1,
            'post_type' => 'page',
            'post_status' => 'publish'
            );
        $children = get_pages($args);
        ?>

        <main class="row <?php if($children){echo "hastoc";} ?>" id="main" role="main">

          <div class="col-sm-2" role="complementary">

            <nav id="toc">
                <a href="#top" id="btt">Terug naar boven</a>
                <hr />
                <?php if(getHeadingList(get_the_content())->length > 3){ ?>
                <span class="b">Inhoud</span>
                <ul class="nav tocnav">

                </ul>
                <?php if ($children) { ?>
                <hr />
                <?php } ?>
                <?php } ?>
                <?php // add subpage list if single page
                if ($children) { ?>
                <span class="b">Menu</span>
                <ul class="nav">
                    <?php
                    foreach ( $children as $child ) { ?>
                    <li>
                        <a href="<?php echo get_page_link($child->ID); ?>">
                            <?php echo $child->post_title ?>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </nav>
            <?php } ?>
        </div>
        <section class="col-sm-8" id="content" role="content">

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header>
                    <h1><?php the_title(); ?></h1>
                </header>

                <?php the_content(); ?>

                <br class="clear">

                <?php edit_post_link(); ?>

            </article>

        </section>
        <div class="col-sm-2"></div>
    </main>

<?php endwhile; ?>
<?php else: ?>
    <main class="row" id="main" role="main">
        <div class="col-sm-2"></div>
        <!-- article -->
        <article>
            <header>
                <h1>Sorry, er is geen inhoud gevonden.</h1>
            </header>
        </article>
        <!-- /article -->
        <div class="col-sm-2"></div>
    </main>
<?php endif; ?>


<?php get_footer(); ?>
