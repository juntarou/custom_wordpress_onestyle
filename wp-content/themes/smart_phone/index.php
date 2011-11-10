<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<section class="serviceArea">
<h2>1st contents</h2>

<ul>
<?php $posts = get_posts('exclude=282,293&posts_per_page=20&post_type=page');
foreach($posts as $post) :
setup_postdata($post);
?>
<li class="top_slist<?php the_ID(); ?>">
<a href="<?php the_permalink(); ?>">
<h3>sample1</h3>
<p class="serviceRead"><?php the_title(); ?></p>
<p class="serviceName"><?php the_content(); ?></p>
</a>
</li>
<?php endforeach; ?>
</ul>
</section>
<section class="newsList">
<h2>ニュースリリース</h2>
<p class="newsBtn"><a href="<?php home_url(); ?>/news">一覧</a></p>

<?php $posts = get_posts('posts_per_page=10&category=3');
foreach ($posts as $post) : 
setup_postdata($post);
?>
<article>
<time datetime=""><?php the_date(); ?></time><p><a href="<?php the_permalink();?>"><?php the_title(); ?></a></p>
</article>
<?php endforeach; ?>
</section>

<section class="mainText">
<h2>説明文</h2>
<p>ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー</p>
</section>

<?php get_footer(); ?>
