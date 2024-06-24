<?php get_header(); ?>


<section class = "page-wrap">
<div class="container">
    <h3>searh results for <?php echo get_search_query();?></h3>
    <?php get_search_form(); ?>
    <div class="results">
        <h1 class="cat-name"><?php echo single_cat_title(); ?></h1>
        <?php get_template_part('includes/section', 'archive'); ?>
        <?php  the_posts_pagination(); ?>
    </div>

</div>
</section>





<?php get_footer(); ?>