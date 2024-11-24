<?php if (isset($_GET['deleted']) && $_GET['deleted'] === 'true'): ?>
    <div class="notice">
        <p><?php echo esc_html__('A bejegyzés sikeresen törölve.', 'pause'); ?></p>
    </div>
<?php endif;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'blog',
    'posts_per_page' => 10,
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged,
);

$blogs = new WP_Query($args);

if ($blogs->have_posts()): ?>
    <div class="blog-list">
        <ul>
            <?php while ($blogs->have_posts()):
                $blogs->the_post(); ?>
                <li>
                    <h3><?php echo esc_html(get_the_title()); ?></h3>
                    <p><?php echo esc_html(sprintf(__('Dátum: %s', 'pause'), get_the_date())); ?></p>
                    <form method="post">
                        <?php wp_nonce_field('delete_blog_post'); ?>
                        <input type="hidden" name="delete_post_id" value="<?php echo esc_attr(get_the_ID()); ?>">
                        <button type="submit"
                            class="delete-post-button"><?php echo esc_html(__('Törlés', 'pause')); ?></button>
                    </form>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <div class="pagination">
        <?php
        echo paginate_links(array(
            'total' => $blogs->max_num_pages,
            'current' => $paged,
            'format' => '?paged=%#%',
            'prev_text' => __('< Előző', 'pause'),
            'next_text' => __('Következő >', 'pause'),
            'end_size' => 1,
            'mid_size' => 2,
        ));
        ?>
    </div>
<?php else: ?>
    <p><?php echo esc_html(__('Nincsenek blog bejegyzések.', 'pause')); ?></p>
<?php endif;

wp_reset_postdata();
