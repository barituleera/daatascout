<?php

function apace_generate_custom_css() {

    $primary_color = get_theme_mod( 'apace_primary_color', '#49a8ff' );

    $custom_css = '';

    if ( '#49a8ff' != $primary_color ) {

        $custom_css .= '
            .site-footer a:hover,
            .site-title a,
            .site-title a:visited,
            .apa-article .entry-meta a:hover, 
            .apa-single-article .entry-meta a:hover,
            .comment-author a:hover,
            .comment-metadata a:hover,
            .comment-metadata a:focus,
            .pingback .comment-edit-link:hover,
            .pingback .comment-edit-link:focus,
            .comment-notes a:hover,
            .comment-awaiting-moderation a:hover,
            .logged-in-as a:hover,
            .form-allowed-tags a:hover,
            .required,
            .comment-reply-title small a:visited, .comment-reply-title small a:hover,
            .apace-readmore-link:hover,
            .apa-article .entry-title a:hover,
            .apa-article .byline .author a:hover,
            .apa-single-article .byline .author a:hover,
            .post-navigation .nav-links a:hover,
            #secondary.widget-area ul li:not(.wp-block-social-link) a:hover,
            .apa-footer-widget-container ul li:not(.wp-block-social-link) a:hover,
            .wp-block-latest-comments__comment-meta a:hover {
                color: '. $primary_color .';
            }

            .wp-block-search .wp-block-search__button,
            .apace-pagination a.page-numbers:hover,
            .apace-pagination .page-numbers.current,
            .main-navigation.toggled li a:hover,
            .main-navigation .current_page_item > a,
            .main-navigation .current-menu-item > a,
            .main-navigation .current_page_ancestor > a,
            .main-navigation .current-menu-ancestor > a,
            .main-navigation li:hover > a,
            .main-navigation li.focus > a,
            .apa-tag-list-icon,
            .apa-tag-list a,
            .apa-category-list a,
            .page-links a.post-page-numbers:hover,
            .post-page-numbers.current,
            .comment-reply-link:hover,
            .comment-reply-link:focus,
            button,
            input[type="button"],
            input[type="reset"],
            input[type="submit"] {
                background-color: '. $primary_color .';
            }

            .wp-block-quote,
            .blockquote,
            .archive .page-title,
            .widget-title,
            .a.post-page-numbers,
            .page-links a.post-page-numbers:hover,
            .apace-pagination .page-numbers.current,
            .apace-pagination a.page-numbers:hover,
            .page-links .post-page-numbers.current {
                border-color: '. $primary_color .';
            }
        ';

    }

    return $custom_css;

}