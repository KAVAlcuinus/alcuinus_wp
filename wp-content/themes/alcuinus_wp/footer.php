            <!-- footer -->
            <footer class="row" role="contentinfo">
                <div class="col-sm-4">
                    <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footerleft')) ?>
                </div>
                <div class="col-sm-4">
                    <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footermid')) ?>
                </div>
                <div class="col-sm-4">
                    <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footerright')) ?>
                </div>

            </footer>
            <!-- /footer -->
        </div>
        <?php wp_footer(); ?>
    </body>
    </html>
