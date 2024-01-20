<?php

function bigbuy_db_products_table_create() {
    global $wpdb;

    $table_name      = $wpdb->prefix . 'sync_products';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT AUTO_INCREMENT,
        supplier VARCHAR(255),
        product_category VARCHAR(255),
        id_bigbuy VARCHAR(255) NOT NULL,
        category_code VARCHAR(255),
        product_name VARCHAR(255) NOT NULL,
        attributes1 VARCHAR(255),
        attributes2 VARCHAR(255),
        values1 VARCHAR(255),
        values2 VARCHAR(255),
        product_description TEXT NOT NULL,
        short_description TEXT,
        long_description TEXT,
        benefices TEXT,
        testimonial TEXT,
        claim_1 TEXT,
        meta_description VARCHAR(255),
        seo_title VARCHAR(255),
        brand VARCHAR(255),
        feature VARCHAR(255),
        product_price VARCHAR(255),
        product_pvp VARCHAR(255),
        EAN VARCHAR(255),
        image_urls TEXT,
        stock VARCHAR(255),
        status VARCHAR(255),
        dateAdd TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        dateUpd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}

// Deactivation hook: Remove database table
function bigbuy_db_products_table_remove() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'sync_products';
    $sql        = "DROP TABLE IF EXISTS $table_name;";
    $wpdb->query( $sql );
}







