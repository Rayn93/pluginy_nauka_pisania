<?php

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die('Nie możesz bezpośrednio uruchomić tego pliku.');

if (post_password_required()) {
    echo 'Post jest chroniony hasłem. Wprowadź hasło aby zobaczyć komentarze.';
    return;
}

?>

<div class="comments">
    
    
    
    <?php if (!comments_open()): // komentarze zostały wyłączone ?>
    
    
    <?php else: //komentarze są włączone ?>
    
        <header>
            <h2>Komentarze</h2>
            <h3>Co myślą inni?</h3>
        </header>
    
        <div class="comments-list">
            <?php if (have_comments()): //wpis posiada komentarze ?>
            
                <?php 
                   wp_list_comments(array(
                       'callback'=>'lovetoeat_comment_theme', 
                       'style'=>'div',
                       'avatar_size' => 69
                   ));
                ?>
            
            <?php else: //wpis nie posiada komentarzy ?>

                <p class="no-comments">Ten wpis nie posiada jeszcze żadnych komentrzy.</p>

            <?php endif; ?>
        </div>
    
        
        <?php if (get_comment_pages_count() > 1 && get_option('page_comments') ) : // are there comments to navigate through ?>
        <div class="comments-navi">
                <div class="prev"><?php previous_comments_link('&larr; Starsze komentarze'); ?></div>
                <div class="next"><?php next_comments_link('Nowsze komentarze &rarr;'); ?></div>
        </div>
        <?php endif; // check for comment navigation ?>
        
        <div id="respond">

            <header>
                <h2>
                    <?php comment_form_title('Dodaj komentarz', 'Odpowiedz dla %s'); ?>
                    <?php cancel_comment_reply_link('Kliknij, aby anulować.'); ?>
                </h2>
                <h3>Masz jakiś pomysł?</h3>
            </header>


            <?php if (get_option('comment_registration') && !is_user_logged_in()): //wymagane zalogowanie, użytkownik jest wylogowany ?>

            <p>Musisz się <a href="<?php echo wp_login_url(get_permalink()); ?>">zalogować</a> aby dodać komentarz.</p>

            <?php else: //nie jest wymagane zalogowanie ?>

            
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

                    <?php if (is_user_logged_in()): //uzytkownik jest zalogowany ?>

                        <p class="logged-in-as">Zalogowany jako <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Wyloguj się. &raquo;</a></p>

                    <?php else: //uzytkownik nie jest zalogowany ?>

                        <input type="text" placeholder="Imię i nazwisko" name="author" />
                        <input type="text" placeholder="Adres e-mail" name="email" />

                    <?php endif; ?>

                    <textarea placeholder="Treść komentarza" name="comment"></textarea>

                    <?php comment_id_fields(); ?>

                    <button>Wyślij</button>

                    <?php do_action('comment_form', $post->ID); ?>

                </form>

            <?php endif;  ?>

        </div>
    
    <?php endif; ?>
    
</div>