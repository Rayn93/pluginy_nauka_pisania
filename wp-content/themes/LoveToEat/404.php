		<?php get_header(); ?>

        <section id="error404" class="content">
            <div class="pos-center">
                
                <div class="wrapper">
                    <div class="code">404</div>
                    <div class="message">
                        <h2>Przykro nam, ale strona której szukasz nie istnieje...</h2>
                        <a href="<?php echo esc_url(home_url('/')); ?>">Przejdź do strony głównej</a>
                    </div>
                </div>
                
            </div>
        </section>


        <?php get_footer(); ?>