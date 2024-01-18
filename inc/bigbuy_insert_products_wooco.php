<?php
require_once PLUGIN_PATH . '/vendor/autoload.php';
use Automattic\WooCommerce\Client;

function product_insert_woocommerce() {
    // Get global $wpdb object
    global $wpdb;
    // Define table names
    $table_name = $wpdb->prefix . 'sync_products';

    // Retrieve pending products from the database
    $products = $wpdb->get_results( "SELECT * FROM $table_name LIMIT 1" );

    $website_url     = home_url();
    $consumer_key    = 'ck_b02f9e74a802655803fdb11e55e873cf45fe0cb7';
    $consumer_secret = 'cs_d6eb867be919817cf7ce871e94ffe2c11d6eba39';

    foreach ( $products as $product ) {
        $product_id          = $product->id;
        $fournisseur         = $product->fournisseur;
        $product_category    = $product->product_category;
        $id_bigbuy           = $product->id_bigbuy;
        $Category            = $product->Category;
        $product_name        = $product->product_name;
        $attributes1         = $product->attributes1;
        $attributes2         = $product->attributes2;
        $values1             = $product->values1;
        $values2             = $product->values2;
        $product_description = $product->product_description;
        $benefices           = $product->benefices;
        $testimonial         = $product->testimonial;
        $claim_1             = $product->claim_1;
        $meta_description    = $product->meta_description;
        $seo_title           = $product->seo_title;
        $brand               = $product->brand;
        $feature             = $product->feature;
        $product_price       = $product->product_price;
        $product_pvp         = $product->product_pvp;
        $EAN                 = $product->EAN;
        $image_url           = $product->image_url;
        $stock               = $product->stock;
    }

    // Set up the API client with your WooCommerce store URL and credentials
    $client = new Client(
        $website_url,
        $consumer_key,
        $consumer_secret,
        [
            'verify_ssl' => false,
        ]
    );

    // if sku already exists, update the product
    $args = array(
        'post_type'  => 'product',
        'meta_query' => array(
            array(
                'key'     => '_sku',
                'value'   => $product_id,
                'compare' => '=',
            ),
        ),
    );

    // Check if the product already exists
    $exiting_products = new WP_Query( $args );

    if ( $exiting_products->have_posts() ) {
        $exiting_products->the_post();

        // get product id
        $product_id = get_the_ID();

        // Update the status of the processed product in your database
        $wpdb->update(
            $table_name_products,
            [ 'status' => 'completed' ],
            [ 'id' => $product->id ]
        );

        // Update the product
        $product_data = [
            'name'        => $title,
            'sku'         => $sku,
            'type'        => 'simple',
            'description' => $description,
            'attributes'  => [
                [
                    'name'      => 'Dimensions',
                    'visible'   => true,
                    'variation' => true,
                ],
            ],
        ];

        // update product
        $client->put( 'products/' . $product_id, $product_data );

    } else {

        // Update the status of the processed product in your database
        $wpdb->update(
            $table_name_products,
            [ 'status' => 'completed' ],
            [ 'id' => $product->id ]
        );

        // Create a new product
        $product_data = [
            'name'        => $title,
            'sku'         => $sku,
            'type'        => 'simple',
            'description' => $description,
            'attributes'  => [
                [
                    'name'      => 'Dimensions',
                    'visible'   => true,
                    'variation' => true,
                ],
            ],
        ];

        // Create the product
        $product = $client->post( 'products', $product_data );
    }
}
add_shortcode( 'insert_product_api', 'product_insert_woocommerce' );

