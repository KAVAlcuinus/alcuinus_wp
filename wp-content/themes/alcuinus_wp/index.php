<?php get_header(); ?>

<main class="row" role="main">
    <div class="col-sm-2"></div>
    <section class="col-sm-8" id="content" role="content">
        <div>
            <header>
                <h1>De Strijd</h1>
            </header>
            <?php get_template_part('loop'); ?>

            <?php get_template_part('pagination'); ?>
        </div>
    </section>
    <div class="col-sm-2"></div>
</main>

<?php get_footer(); ?>
