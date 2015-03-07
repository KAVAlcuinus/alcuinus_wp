<?php get_header(); ?>

<main class="row" role="main">
    <div class="col-sm-2"></div>
    <section class="col-sm-8" id="content" role="content">
        <article>
            <header>
                <h1>404 Pagina niet gevonden</h1>
            </header>
            <p>
                De pagina is niet gevonden. Mogelijke oplossingen:
                <ol>
                    <li>Zoeken: <br /><?php get_search_form(); ?></li>
                    <li>Ga <a href="<?php echo home_url(); ?>">terug naar de startpagina</a></li>
                    <li>Ga <a href="javascript: window.history.back();">terug naar waar je vandaan kwam</a></li>
                    <li>Vraag het aan ons via <a href="http://www.facebook.com/Alcuinus">Facebook</a></li>
                    <li>Panikeren en je PC uit het raam smijten</a></li>
                    <li>Bel je locale computer service</a></li>
                    <li>Verwijder system32</a></li>
                    <li>Drink een pilsje</li>
                    <li>Bij <a href="http://www.lmgtfy.nl/?q=Hoe drink ik bier?" title="google">Google</a> zoeken</li>
                    <li>Ververs de pagina</li>
                    <li>Ga huilen</li>
                    <li>An hero</li>
                </ol>
            </p>
        </article>
    </section>
    <div class="col-sm-2"></div>
</main>

<?php get_footer(); ?>
