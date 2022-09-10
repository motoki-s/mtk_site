        <footer class="footer">
            <!-- snsアイコン -->
            <?php if (is_front_page()) : ?>
                <ul class="sns-navi">
                    <li class="icon-twitter">
                        <a href="https://twitter.com/SakumaMotoki" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-twitter"></i></a>
                    </li>
                    <li class="icon-instagram">
                        <a href="https://www.instagram.com/s_motoki616/?hl=ja" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a>
                    </li>
                    <li class="icon-youtube">
                        <a href="https://www.youtube.com/channel/UC3v6vVBsHx8jWcxjFUbvQQQ" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-youtube"></i></a>
                    </li>
                </ul>
            <?php endif; ?>

            <!-- snsシェア -->
            <?php if (is_singular(['post', 'live',]) || (is_page() && $post->post_parent)) : ?>
                <ul class="sns-navi share container">
                    <span>SHARE</span>
                    <li class="icon-instagram">
                        <a href="" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook"></i></a>
                    </li>
                    <li class="icon-twitter">
                        <a href="" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-twitter"></i></a>
                    </li>
                </ul>
            <?php endif; ?>
            <small>&copy;Motoki Sakuma All Right Reserved.</small>
        </footer>
        <?php wp_footer(); ?>
        </div>
    </body>

    </html>