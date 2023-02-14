<?php
/**
* Custom Post Types & Taxonomies
*/
function rinhae_register_custom_post_types() {
    
    // Register Staff CPT
    $labels = array(
        'name'               => _x( 'Staff', 'post type general name' ),
        'singular_name'      => _x( 'Staff', 'post type singular name'),
        'menu_name'          => _x( 'Staff', 'admin menu' ),
        'name_admin_bar'     => _x( 'Staff', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'staff' ),
        'add_new_item'       => __( 'Add New Staff' ),
        'new_item'           => __( 'New Staff' ),
        'edit_item'          => __( 'Edit Staff' ),
        'view_item'          => __( 'View Staff' ),
        'all_items'          => __( 'All Staff' ),
        'search_items'       => __( 'Search Staff' ),
        'parent_item_colon'  => __( 'Parent Staff:' ),
        'not_found'          => __( 'No staff found.' ),
        'not_found_in_trash' => __( 'No staff found in Trash.' ),
        'archives'           => __( 'Staff Archives'),
        'insert_into_item'   => __( 'Insert into staff'),
        'uploaded_to_this_item' => __( 'Uploaded to this staff'),
        'filter_item_list'   => __( 'Filter staff list'),
        'items_list_navigation' => __( 'Staff list navigation'),
        'items_list'         => __( 'Staff list'),
        'featured_image'     => __( 'Staff featured image'),
        'set_featured_image' => __( 'Set staff featured image'),
        'remove_featured_image' => __( 'Remove staff featured image'),
        'use_featured_image' => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'staff' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title' ),
    );
    register_post_type( 'rinhae-staff', $args );

    // Register Students CPT
    $labels = array(
        'name'               => _x( 'Students', 'post type general name' ),
        'singular_name'      => _x( 'Student', 'post type singular name'),
        'menu_name'          => _x( 'Students', 'admin menu' ),
        'name_admin_bar'     => _x( 'Students', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'staff' ),
        'add_new_item'       => __( 'Add New Student' ),
        'new_item'           => __( 'New Student' ),
        'edit_item'          => __( 'Edit student' ),
        'view_item'          => __( 'View student' ),
        'all_items'          => __( 'All students' ),
        'search_items'       => __( 'Search students' ),
        'parent_item_colon'  => __( 'Parent student:' ),
        'not_found'          => __( 'No students found.' ),
        'not_found_in_trash' => __( 'No student found in Trash.' ),
        'archives'           => __( 'Student Archives'),
        'insert_into_item'   => __( 'Insert into student'),
        'uploaded_to_this_item' => __( 'Uploaded to this student'),
        'filter_item_list'   => __( 'Filter student list'),
        'items_list_navigation' => __( 'Student list navigation'),
        'items_list'         => __( 'Student list'),
        'featured_image'     => __( 'Student featured image'),
        'set_featured_image' => __( 'Set student featured image'),
        'remove_featured_image' => __( 'Remove student featured image'),
        'use_featured_image' => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'students' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title', 'thumbnail', 'editor' ),
        'template'           => array( array( 'core/paragraph' ), array( 'core/button' )),
        'template_lock'      => 'all'
    );
    register_post_type( 'rinhae-students', $args );
}

add_action( 'init', 'rinhae_register_custom_post_types' );

function rinhae_register_taxonomies() {
    // Add Staff Categories taxonomy
    $labels = array(
        'name'              => _x( 'Staff Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Staff Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Staff Categories' ),
        'all_items'         => __( 'All Staff Category' ),
        'parent_item'       => __( 'Parent Staff Category' ),
        'parent_item_colon' => __( 'Parent Staff Category:' ),
        'edit_item'         => __( 'Edit Staff Category' ),
        'view_item'         => __( 'View Staff Category' ),
        'update_item'       => __( 'Update Staff Category' ),
        'add_new_item'      => __( 'Add New Staff Category' ),
        'new_item_name'     => __( 'New Staff Category Name' ),
        'menu_name'         => __( 'Staff Category' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'staff-categories' ),
    );
    register_taxonomy( 'rinhae-staff-category', array( 'rinhae-staff' ), $args );


    // Add Student Type taxonomy
    $labels = array(
        'name'                       => _x( 'Student Type', 'taxonomy general name' ),
        'singular_name'              => _x( 'Student Type', 'taxonomy singular name' ),
        'search_items'               => __( 'Student Type' ),
        'all_items'                  => __( 'All Student Type' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Student Type' ),
        'update_item'                => __( 'Update Student Type' ),
        'add_new_item'               => __( 'Add New Student Type' ),
        'new_item_name'              => __( 'New Student Type Name' ),
        'separate_items_with_commas' => __( 'Separate student type with commas' ),
        'add_or_remove_items'        => __( 'Add or remove Student Types' ),
        'choose_from_most_used'      => __( 'Choose from the most used student types' ),
        'not_found'                  => __( 'No student types found.' ),
        'menu_name'                  => __( 'Student Type' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menu'      => true,
        'show_in_rest'          => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'student-type' ),
    );

    register_taxonomy( 'rinhae-student-type', array( 'rinhae-students' ), $args );
}
add_action( 'init', 'rinhae_register_taxonomies');



// This flushes the permalinks if the theme is changed
function rinhae_rewrite_flush() {
    rinhae_register_custom_post_types();
    rinhae_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'rinhae_rewrite_flush' );
