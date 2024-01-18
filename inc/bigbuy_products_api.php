<?php

function bigbuy_db_products_table_create()
{
    global $wpdb;

    $table_name      = $wpdb->prefix . 'sync_products';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT AUTO_INCREMENT,
        fournisseur VARCHAR(255) NOT NULL,
        product_category VARCHAR(255),
        id_bigbuy VARCHAR(255) NOT NULL,
        Category VARCHAR(255) NOT NULL,
        product_name VARCHAR(255) NOT NULL,
        attributes1 VARCHAR(255) NOT NULL,
        attributes2 VARCHAR(255) NOT NULL,
        values1 VARCHAR(255) NOT NULL,
        values2 VARCHAR(255) NOT NULL,
        product_description TEXT NOT NULL,
        short_description TEXT NOT NULL,
        long_description TEXT NOT NULL,
        benefices TEXT NOT NULL,
        testimonial TEXT NOT NULL,
        claim_1 TEXT NOT NULL,
        meta_description VARCHAR(255) NOT NULL,
        seo_title VARCHAR(255) NOT NULL,
        brand VARCHAR(255) NOT NULL,
        feature VARCHAR(255) NOT NULL,
        product_price VARCHAR(255) NOT NULL,
        product_pvp VARCHAR(255) NOT NULL,
        EAN VARCHAR(255),
        image_url TEXT,
        stock VARCHAR(255),
        dateAdd TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        dateUpd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}

// Deactivation hook: Remove database table
function bigbuy_db_products_table_remove()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'sync_products';
    $sql        = "DROP TABLE IF EXISTS $table_name;";
    $wpdb->query($sql);
}







