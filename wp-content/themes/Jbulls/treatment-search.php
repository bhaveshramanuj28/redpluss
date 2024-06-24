<?php

/**
 * Template Name: treatment search
 */
$is_search = count($_GET);
$locations = get_terms([
    'taxonomy' => 'custom_taxonomy',
    'hide_empty' => false
]);


?>
<?php get_header(); ?>


<section class = "page-wrap">
    <div class="container">
        <div class="card">

            <div class="card-body">
            <form class = "search-form" action ="<?php echo home_url('/treatment-search'); ?>">
                <div class="form-group">
                    <input 
                        type="text" 
                        name="keyword" 
                        onkeyup = "fetchResults()"
                        placeholder="type a keyword here" 
                        class="form-control"
                        value ="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>"
                    >
                    <div id="datafetch"></div>
                </div>
                <div class="form-group">
                    <select name="location" class="form-control">
                        <option value=""> Choose a Location</option>
                        <?php foreach($locations as $location): ?>
                            <option 
                                <?php if (isset($_GET['location']) && $_GET['location'] == $location->slug): ?>
                                    selected
                                <?php endif; ?>
                                value="<?php echo $location->slug; ?>"><?php echo $location->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-lg btn-success btn-block">Search</button>
            </form>

            
            
            <?php
                $args=[

                    'post_type' => 'healthcarepackages',
                    'posts_per-page ' => -1,
                    'tax_query' => [],
                    'meta_query' => [
                        'relation' => 'AND',
                    ],
                ];
            
                if(isset($_GET['keyword'])){

                    if(!empty($_GET['keyword']))
                    {
                        $args['s'] = sanitize_text_field( $_GET['keyword']);
                    }


                }

                if(isset($_GET['location'])){
                    if(!empty($_GET['location'])){
                        $args['tax_query'][] = [
                            'taxonomy' => 'custom_taxonomy',
                            'field' => 'slug',
                            'terms' => array( sanitize_text_field($_GET['location']))
                        ];
                    }
                }





                if($is_search){
                    $query = new WP_Query($args);
                }
                
            
            ?>


                <?php if($is_search): ?>
                    <?php if($query->have_posts() ): ?>
                        <?php while($query->have_posts() ): $query->the_post() ?>
                            <h1><?php the_title(); ?></h1>
                            <?php if(has_post_thumbnail()): ?>
                            <img src ="<?php the_post_thumbnail_url();?>" class ="img-fluid mb-3 img-thumbnail featured-img" >
                        <?php endif; ?>
                        <?php endwhile;?>
                    <?php else: ?>
                        <div class ="clearfix mb-3"></div>
                    <div class="alert alert-danger">there are no results</div>
                    
                    <?php endif; ?>
                <?php endif;?>
            </div>



        </div>





    </div>
</section>

<?php get_footer(); ?>
