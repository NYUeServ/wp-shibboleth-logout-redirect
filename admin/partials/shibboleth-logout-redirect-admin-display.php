<?php

/**
 * This is the options page for Network Admin Settings
 *
 * @link       https://github.com/NYUeServ/wp-shibboleth-logout-redirect
 * @since      1.0.0
 *
 * @package    Shibboleth_Logout_Redirect
 * @subpackage Shibboleth_Logout_Redirect/admin/partials
 */
?>

<div class="wrap">
    <h2><?php _e( 'Shibboleth Logout Redirect') ?></h2>

    <?php
        //Display status message
        if ( isset( $_GET['dmsg'] ) ) { ?>
            <div id="message" class="updated fade"><p><?php echo urldecode( $_GET['dmsg'] ); ?></p></div><?php
        } ?>
            
        <div id="slr-network-settings">

            <form method="post" action="">
                <table  class="form-table slr-settings">

                    <tr class="slr-settings" valign="top">
                        <th scope="row"><?php _e( 'Logout URL' ); ?></th>
                        <td>
                            <input type="text" name="slr_settings_logout_redirect_url" class="regular-text" <?php if ( !empty( $this->current_settings['slr_settings']['slr_settings_logout_redirect_url'] ) ) { echo "value=".$this->current_settings['slr_settings']['slr_settings_logout_redirect_url']; } ?> />
                            <p class="description"><?php _e( 'The url at which you want to redirect after performing local wordpress logout, e.g. Shibboleth Idp\'s Logout URL' ); ?></p>
                        </td>
                    </tr>

                </table>

                <p class="submit">
                    <?php wp_nonce_field('submit_slr_settings_network'); ?>
                    <input type="submit" name="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
                </p>

            </form>
        </div>
</div>