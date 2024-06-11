<?php
/**
 * Import pack ajax functions
 *
 * @package Import Pack
 */

if( ! function_exists( 'seine_import_pack_modal_import_body_template' ) ) {
    /**
     * Modal import template
     *
     */
    function seine_import_pack_modal_import_body_template() {

        set_query_var( 'package_id', $_POST['package_id'] );
        set_query_var( 'package_data', seine_import_pack_get_package_data_by_id( $_POST['package_id'] ) );
        set_query_var( 'import_steps', seine_import_pack_import_steps() );

        ob_start();
        load_template( get_template_directory() . '/install/import-pack/templates/modal-body-by-package-id.php' );
        $content = ob_get_clean();

        wp_send_json( [
            'success' => true,
            'content' => $content,
        ] );
    }

    add_action( 'wp_ajax_seine_import_pack_modal_import_body_template', 'seine_import_pack_modal_import_body_template' );
    add_action( 'wp_ajax_nopriv_seine_import_pack_modal_import_body_template', 'seine_import_pack_modal_import_body_template' );
}

if( ! function_exists( 'seine_import_pack_import_action_ajax_callback' ) ) {
    /**
     * Import action ajax callback
     *
     */
    function seine_import_pack_import_action_ajax_callback() {

        extract( $_POST );

        if( ! isset( $data['form_data'] ) ) {
            wp_send_json( [
                'success' => true,
                'type' => 'error',
                'message' => __( 'Error: Form data not defined!', 'seine' ),
            ] );
        }

        if( ! isset( $data['form_data'][$data['action_type']] ) ) {
            wp_send_json( [
                'success' => true,
                'type' => 'error',
                'message' => __( 'Error: Missing function ajax callback!', 'seine' ),
            ] );
        }

        if( ! function_exists( $data['form_data'][$data['action_type']] ) ) {
            wp_send_json( [
                'success' => true,
                'type' => 'error',
                'message' => __( 'Error: Function ajax not defined!', 'seine' ),
            ] );
        }

        $result = call_user_func( $data['form_data'][$data['action_type']] );

        wp_send_json( [
            'success' => true,
            'type' => 'success',
            'result' => $result,
        ] ); exit();
    }

    add_action( 'wp_ajax_seine_import_pack_import_action_ajax_callback', 'seine_import_pack_import_action_ajax_callback' );
    add_action( 'wp_ajax_nopriv_seine_import_pack_import_action_ajax_callback', 'seine_import_pack_import_action_ajax_callback' );
}

if( ! function_exists( 'seine_import_pack_install_plugin' ) ) {
    /**
     * Install plugin
     *
     */
    function seine_import_pack_install_plugin() {
        extract( $_POST );

        $installer = false;
        $plugin = ['slug' => $data['plugin_slug']];
        if( ! empty( $data['plugin_source'] ) ) { $plugin['source'] = $data['plugin_source']; }

        if(! Import_Pack_Plugin_Installer_Helper::is_installed( $plugin )) {

            $install_response = Import_Pack_Plugin_Installer_Helper::install( $plugin );
            if( $install_response['success'] == true ) {
                // Install...
                $installer = true;
            }
        } else {
            $installer = true;
        }

        if( false == $installer ) {
            wp_send_json( [
                'success' => true,
                'status' => false,
                'substep' => 'installer',
            ] );
        }

        $active_response = Import_Pack_Plugin_Installer_Helper::activate( $plugin );
        $activate = false;

        if( $active_response['success'] == true ) {
            $activate = true;
        }

        if( false == $activate ) {
            wp_send_json( [
                'success' => true,
                'status' => false,
                'substep' => 'activate',
            ] );
        }

        wp_send_json( [
            'success' => true,
            'status' => true,
            'substep' => 'activate',
        ] );
    }

    add_action( 'wp_ajax_seine_import_pack_install_plugin', 'seine_import_pack_install_plugin' );
    add_action( 'wp_ajax_nopriv_seine_import_pack_install_plugin', 'seine_import_pack_install_plugin' );
}

if( ! function_exists( 'seine_import_pack_download_package' ) ) {
    /**
     * Download package
     *
     */
    function seine_import_pack_download_package() {

        extract( $_POST );
        $package_name = $data['package_name'];
        $position = isset( $data['position'] ) ? $data['position'] : 0;
        $package = isset( $data['package'] ) ? $data['package'] : '';

        $result = seine_import_pack_download_package_step( $package_name, $position, $package );

        wp_send_json( array(
            'success' => true,
            'result' => $result,
        ) );

        exit();
    }

    add_action( 'wp_ajax_seine_import_pack_download_package', 'seine_import_pack_download_package' );
    add_action( 'wp_ajax_nopriv_seine_import_pack_download_package', 'seine_import_pack_download_package' );
}

if( ! function_exists( 'seine_import_pack_extract_package_demo' ) ) {
    /**
     * Extract (.zip) package demo
     *
     */
    function seine_import_pack_extract_package_demo() {
        global $Bears_Backup;
        extract( $_POST );

        $package_name = $data['package_name'];
        $package = $data['package'];

        $upload_dir = wp_upload_dir();
        $path = $upload_dir['basedir'];
        $path_file_package = $path . '/' . $package;

        $backup_path = $Bears_Backup->upload_path();
        $extract_to = $backup_path . '/' . sprintf( 'package-install__%s', $package_name );

        if ( ! wp_mkdir_p( $extract_to ) ) {
            wp_send_json( array(
                'success' => true,
                'result' => array(
                    'extract_success' => false,
                )
            ) );
        }

        WP_Filesystem();
        $unzipfile = unzip_file( $path_file_package, $extract_to);

         if ( $unzipfile ) {
           wp_send_json( array(
               'success' => true,
               'result' => array(
                   'extract_success' => true,
                   'extract_to' => $extract_to,
               )
           ) );
         } else {
           wp_send_json( array(
               'success' => true,
               'result' => array(
                   'extract_success' => false,
               )
           ) );
         }

         // remove zip file
         wp_delete_file( $path_file_package );

        exit();
    }

    add_action( 'wp_ajax_seine_import_pack_extract_package_demo', 'seine_import_pack_extract_package_demo' );
    add_action( 'wp_ajax_nopriv_seine_import_pack_extract_package_demo', 'seine_import_pack_extract_package_demo' );
}

if( ! function_exists( 'seine_import_pack_restore_data' ) ) {
    /**
     * Restore data
     *
     */
    function seine_import_pack_restore_data() {
        global $wp_filesystem;
        $package_path = $_POST['data']['package_path'];

        if (empty($wp_filesystem)) {
            require_once (ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }

        do_action( 'seine/import_pack/before_restore_package', $package_path );

        $result = BBACKUP_Restore_Data( array(
            'name' => basename( $package_path ),
            'backup_path_file' => $package_path,
        ), '' );

        do_action( 'seine/import_pack/after_restore_package', $package_path, $result );

        // delete package folder
        $wp_filesystem->delete( $package_path , true );

        if( isset( $result['success'] ) && true == $result['success'] ) {

            wp_send_json( array(
                'success' => true,
                'result' => array(
                    'restore' => true
                )
            ) );
        } else {
            wp_send_json( array(
                'success' => true,
                'result' => array(
                    'restore' => false
                )
            ) );
        }
    }

    add_action( 'wp_ajax_seine_import_pack_restore_data', 'seine_import_pack_restore_data' );
    add_action( 'wp_ajax_nopriv_seine_import_pack_restore_data', 'seine_import_pack_restore_data' );
}

if( ! function_exists( 'seine_import_pack_backup_site_substep_install_bears_backup_plg' ) ) {
    /**
     * Backup site step install Bears Backup plugin
     *
     */
    function seine_import_pack_backup_site_substep_install_bears_backup_plg() {

        // Install plugin Bears Backup
        $installer = false;
        $plugin = [
            'slug' => 'bears-backup',
            'source' => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . '/bears-backup.zip',
        ];

        if(! Import_Pack_Plugin_Installer_Helper::is_installed( $plugin )) {

            $install_response = Import_Pack_Plugin_Installer_Helper::install( $plugin );

            if( $install_response['success'] == true ) {
                // Install...
                $installer = true;
            }
        } else {
            $installer = true;
        }

        if( false == $installer ) {
            wp_send_json( [
                'success' => true,
                'result' => [
                    'status' => false,
                    'message' => __( 'Install plugin Bears Backup fail!', 'seine' ),
                ]
            ] );

            exit();
        }

        $active_response = Import_Pack_Plugin_Installer_Helper::activate( $plugin );
        $activate = false;

        if( $active_response['success'] != true ) {
            wp_send_json( [
                'success' => true,
                'result' => [
                    'status' => false,
                    'message' => __( 'Active plugin Bears Backup fail!', 'seine' ),
                ]
            ] );

            exit();
        }

        wp_send_json( [
            'success' => true,
            'result' => [
                'status' => true,
                'message' => __( 'Install plugin Bears Backup successful.', 'seine' ),
            ]
        ] );

        exit();
    }

    add_action( 'wp_ajax_seine_import_pack_backup_site_substep_install_bears_backup_plg', 'seine_import_pack_backup_site_substep_install_bears_backup_plg' );
    add_action( 'wp_ajax_nopriv_seine_import_pack_backup_site_substep_install_bears_backup_plg', 'seine_import_pack_backup_site_substep_install_bears_backup_plg' );
}

if( ! function_exists( 'seine_import_pack_backup_site_substep_backup_database' ) ) {
    /**
     * Backup site step backup database
     *
     */
    function seine_import_pack_backup_site_substep_backup_database() {

        // bbackup_backup_database
        $result = BBACKUP_Backup_Database( [], '' );

        if( $result['success'] == true ) {

            wp_send_json( [
                'success' => true,
                'result' => [
                    'status' => true,
                    'message' => __( 'Backup database successful.', 'seine' ),
                    'next_step_data' => $result,
                ]
            ] );
        } else {
            wp_send_json( [
                'success' => true,
                'result' => [
                    'status' => false,
                    'message' => __( 'Backup database fail!', 'seine' ),
                ]
            ] );
        }
    }

    add_action( 'wp_ajax_seine_import_pack_backup_site_substep_backup_database', 'seine_import_pack_backup_site_substep_backup_database' );
    add_action( 'wp_ajax_nopriv_seine_import_pack_backup_site_substep_backup_database', 'seine_import_pack_backup_site_substep_backup_database' );
}

if( ! function_exists( 'seine_import_pack_backup_site_substep_create_file_config' ) ) {
    /**
     * Backup site step create file config
     *
     */
    function seine_import_pack_backup_site_substep_create_file_config() {

        $result = BBACKUP_Create_File_Config( $_POST['data']['next_step_data'], '' );

        if( $result['success'] == true ) {

            wp_send_json( [
                'success' => true,
                'result' => [
                    'status' => true,
                    'message' => __( 'Backup database successful.', 'seine' ),
                    'next_step_data' => $result,
                ]
            ] );
        } else {
            wp_send_json( [
                'success' => true,
                'result' => [
                    'status' => false,
                    'message' => __( 'Backup database fail!', 'seine' ),
                ]
            ] );
        }
    }

    add_action( 'wp_ajax_seine_import_pack_backup_site_substep_create_file_config', 'seine_import_pack_backup_site_substep_create_file_config' );
    add_action( 'wp_ajax_nopriv_seine_import_pack_backup_site_substep_create_file_config', 'seine_import_pack_backup_site_substep_create_file_config' );
}

if( ! function_exists( 'seine_import_pack_backup_site_substep_backup_folder_upload' ) ) {
    /**
     * Backup site step backup folder upload
     *
     */
    function seine_import_pack_backup_site_substep_backup_folder_upload() {

        $result = BBACKUP_Backup_Folder_Upload( $_POST['data']['next_step_data'], '' );

        if( $result['success'] == true ) {

            wp_send_json( [
                'success' => true,
                'result' => [
                    'status' => true,
                    'message' => __( 'Backup folder upload successful.', 'seine' ),
                    'next_step_data' => $result,
                ]
            ] );
        } else {
            wp_send_json( [
                'success' => true,
                'result' => [
                    'status' => false,
                    'message' => __( 'Backup folder upload fail!', 'seine' ),
                ]
            ] );
        }
    }

    add_action( 'wp_ajax_seine_import_pack_backup_site_substep_backup_folder_upload', 'seine_import_pack_backup_site_substep_backup_folder_upload' );
    add_action( 'wp_ajax_nopriv_seine_import_pack_backup_site_substep_backup_folder_upload', 'seine_import_pack_backup_site_substep_backup_folder_upload' );
}
