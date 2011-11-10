<?php
/*
template Name: カテゴリーニュース
*/
get_header(); ?>

<!-- / #globalHeader --></header>

<section class="newsList">
<h1>ニュース一覧</h1>

<?php $posts = get_posts('posts_per_page=20&category=3');
foreach ($posts as $post) : 
setup_postdata($post);
?>
<article>
<time datetime=""><?php the_date(); ?></time><p><a href="<?php the_permalink();?>"><?php the_title(); ?></a></p>
</article>
<?php endforeach; ?>
</section>

<?php get_footer(); ?>
