<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
$is_search = count($_GET);
$locations = get_terms([
    'taxonomy' => 'custom_taxonomy',
    'hide_empty' => false,
]);
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
    <div class="card">
        <div class="card-body">
            <form action="<?php echo home_url('/treatment-search'); ?>" method="get">
                <div class="form-group">
                    <label>Type a Treatment</label>
                    <input type="text" name="treatment" placeholder="type a treatment name" class="form-control">
                </div>
                <div class="form-group">
                    <select name="location" class="form-control">
                        <option value="">Choose a location</option>
                        <?php foreach($locations as $location): ?>
                        <option value="<?php echo $location->slug ?>"><?php echo $location->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-lg btn-success btn-block">search</button>
            </form>
        </div>
    </div>
<?php


?>
</div>
