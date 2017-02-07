<?php
if (!function_exists('sorting')):

    function sorting($sorting) {
        if ($sorting == 'yes') {
            ?>
            <script type="text/javascript">
                jQuery(function() {
                    jQuery('.orderbysort').change(function() {
                        this.form.submit();
                    });
                });
            </script>
            <form class="sorting" method="GET">
                <select name="gtsorderby" class="orderbysort" >
                    <option value="ASC"<?php echo (isset($_GET["gtsorderby"]) && $_GET["gtsorderby"] == "ASC") ? 'selected' : '' ?>>sort by title: A - Z</option>
                    <option value="DESC" <?php echo (isset($_GET["gtsorderby"]) && $_GET["gtsorderby"] == "DESC") ? 'selected' : '' ?>>sort by title: Z - A</option>
                </select>
            </form>
            <?php
        }
    }

endif;
if (!function_exists('shortcodepaginav')) :

    /**
     * Display navigation to next/previous set of posts when applicable.
     * Based on paging nav function from Twenty Fourteen
     */
    function shortcodepaginav($max_page) {

        // Don't print empty markup if there's only one page.
        if ($max_page < 2) {
            return;
        }

        $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
        $pagenum_link = html_entity_decode(get_pagenum_link());
        $query_args = array();
        $url_parts = explode('?', $pagenum_link);

        if (isset($url_parts[1])) {
            wp_parse_str($url_parts[1], $query_args);
        }

        $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
        $pagenum_link = trailingslashit($pagenum_link) . '%_%';

        $format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
        $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

        // Set up paginated links.
        $links = paginate_links(array(
            'base' => $pagenum_link,
            'format' => $format,
            'total' => $max_page,
            'current' => $paged,
            'mid_size' => 3,
            'add_args' => array_map('urlencode', $query_args),
            'prev_text' => __('&larr; Previous', 'yourtheme'),
            'next_text' => __('Next &rarr;', 'yourtheme'),
            'type' => 'list',
                ));

        if ($links) :
            ?>
            <nav class="navigation paging-navigation" role="navigation">
            <?php echo $links; ?>
            </nav><!-- .navigation -->
            <?php
        endif;
    }

endif;

function post_listing($atts) {
    ob_start();
    global $wpdb;
    global $post;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $post_type_name = isset($atts['post_name']) ? $atts['post_name'] : '';
    $taxonomy_type_name = isset($atts['texonomy_name']) ? $atts['texonomy_name'] : '';
    $term_type_name = isset($atts['term_name']) ? $atts['term_name'] : '';
    $posts_per_page = isset($atts['post_per_page_list']) ? $atts['post_per_page_list'] : '';
    $sorting = isset($atts['sorting']) ? $atts['sorting'] : '';
    $sortingvalue = isset($_GET['gtsorderby']) ? $_GET['gtsorderby'] : '';
    $display_view = isset($atts['display_view']) ? $atts['display_view'] : '';

    if (isset($post_type_name) && isset($taxonomy_type_name) && isset($term_type_name)) {

        $PostListArgs = array(
            'post_type' => $post_type_name,
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy_type_name,
                    'field' => 'slug',
                    'terms' => $term_type_name
            )),
            'orderby' => "title",
            'order' => $sortingvalue,
            'posts_per_page' => $posts_per_page,
            'paged' => $paged
        );
    } else if (isset($post_type_name) && isset($taxonomy_type_name)) {

        $PostListArgs = array(
            'post_type' => $post_type_name,
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy_type_name,
                    'field' => 'slug',
                    'posts_per_page' => $posts_per_page,
                    'paged' => $paged
            )),
            'orderby' => "title",
            'order' => $sortingvalue,
        );
    } else if (isset($post_type_name)) {

        $PostListArgs = array(
            'post_type' => $post_type_name,
            'orderby' => "title",
            'order' => $sortingvalue,
            'posts_per_page' => $posts_per_page,
            'paged' => $paged
        );
    }
    $my_query = new WP_Query($PostListArgs);

    if ($display_view == 'first-view') {
        echo '<div class="shortcode-main ' . $display_view . ' first-box">';
        $max_page = $my_query->max_num_pages;
        sorting($sorting);
        if ($my_query->have_posts()) {
            while ($my_query->have_posts()) : $my_query->the_post();
                echo '<div class="row">';
                echo ' <div class="content-block-main">
					  <div class="site-title">' . '<a href="' . get_permalink() . '">' . get_the_title() . '</a></div>
					 <div class="site-content">';
                if (empty($post->post_content)) {
                    echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed iaculis sollicitudin sem, sed blandit diam porttitor at. Donec auctor, lacus id mollis gravida, tortor neque egestas justo, quis posuere velit neque nec augue. Suspendisse eget pulvinar sem.';
                } else {
                    echo '<p>' . get_the_excerpt() . '</p>';
                }
                echo '</div></div></div>';
            endwhile;
        }
        $max_page = $my_query->max_num_pages;
        shortcodepaginav($max_page);
        echo '</div>';
    } elseif ($display_view == 'second-view') {

        echo '<div class="shortcode-main ' . $display_view . ' second-box">';
        if ($my_query->have_posts()) {
            while ($my_query->have_posts()) : $my_query->the_post();
                echo '<div class="row">';
                echo ' <div class="content-block-main">
					  <div class="site-title">' . '<a href="' . get_permalink() . '">' . get_the_title() . '</a></div>
					 <div class="site-content">';
                if (empty($post->post_content)) {
                    echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed iaculis sollicitudin sem, sed blandit diam porttitor at. Donec auctor, lacus id mollis gravida, tortor neque egestas justo, quis posuere velit neque nec augue. Suspendisse eget pulvinar sem.';
                } else {
                    echo '<p>' . get_the_excerpt() . '</p>';
                }
                echo '</div></div></div>';
            endwhile;
        }
        $max_page = $my_query->max_num_pages;
        shortcodepaginav($max_page);
        echo '</div>';
    } elseif ($display_view == 'third-view') {
        if ($my_query->have_posts()) {
            echo '<div class="shortcode-main ' . $display_view . ' third-box">';
            while ($my_query->have_posts()) : $my_query->the_post();
                echo '<div class="row">';
                echo '<div class="site-thumbnail">' . '<a href="' . get_permalink() . '">' . get_the_post_thumbnail() . '</a></div>';
                echo '<div class="content-block-main"><div class="site-title">' . '<a href="' . get_permalink() . '">' . get_the_title() . '</a></div>';
                echo '<div class="site-content">';
                if (empty($post->post_content)) {
                    echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed iaculis sollicitudin sem, sed blandit diam porttitor at. Donec auctor, lacus id mollis gravida, tortor neque egestas justo, quis posuere velit neque nec augue. Suspendisse eget pulvinar sem.';
                } else {
                    echo '<p>' . get_the_excerpt() . '</p>';
                }
                echo '</div></div></div>';
            endwhile;
        }
        $max_page = $my_query->max_num_pages;
        shortcodepaginav($max_page);
        echo '</div>';
    } else {
        if ($my_query->have_posts()) {
            $PostNumber = 1;
            while ($my_query->have_posts()) : $my_query->the_post();
                echo '<div id="content" class="site-content" role="main">
						<h2 class="entry-title">' . get_the_title() . '</h2>
					</div>';

                echo '<div class="entry-content">';
                if (empty($post->post_content)) {
                    echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed iaculis sollicitudin sem, sed blandit diam porttitor at. Donec auctor, lacus id mollis gravida, tortor neque egestas justo, quis posuere velit neque nec augue. Suspendisse eget pulvinar sem.';
                } else {
                    echo '<p>' . get_the_excerpt() . '</p>';
                }
                echo '</div><br/><br/>';
                $PostNumber++;
            endwhile;
        }
        $max_page = $my_query->max_num_pages;
        shortcodepaginav($max_page);
    }
    wp_reset_postdata();
    $post_data = ob_get_clean();
    return $post_data;
}

add_shortcode('post_listing_data', 'post_listing');