<?php 
    /*
    Plugin Name: CC Analytics
    Plugin URI: https://chriscather.wordpress.com
    Description: Plugin for adding Google Analytics to website
    Author: C. Cather
    Version: 1.0
    Author URI: https://chriscather.wordpress.com
    */

add_action('admin_menu', 'cc_analytics_menu');

function cc_analytics_menu() {
    add_menu_page('CC Analytics', 'CC Analytics', 'administrator', 'cc_analytics_settings_page', 'cc_analytics_menu_function', plugins_url('analytics/images/analytics.png'));
}

add_action( 'admin_init', 'cc_analytics_settings' );

function cc_analytics_settings() {
    register_setting( 'cc_analytics_settings_group', 'accountant_name' );
}

function cc_analytics_menu_function(){?>
    <div class="wrap">
        <h2>CC Analytics</h2>
        <form method="post" action="options.php">
            <?php settings_fields( 'cc_analytics_settings_group' ); ?>
            <?php do_settings_sections( 'cc_analytics_settings_group' ); ?>
            <table class="form-table">
                <tr valign="top">
                <th scope="row">Google Account Name</th>
                <td><input type="text" name="accountant_name" value="<?php echo esc_attr( get_option('accountant_name') ); ?>" placeholder="UA-XXXXX-X" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php }

add_action( 'wp_head', 'cc_analytics' );
    function cc_analytics() { ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', '<?php echo get_option('accountant_name', ''); ?>', 'auto');
            ga('send', 'pageview');
        </script>
    <?php }