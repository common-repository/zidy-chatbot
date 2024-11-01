<?php
    $options = get_option('zidy_webchat_options');
    $options['enabled'] ??= 0;
    $options['zidy_webchat_widget_code'] ??= '';
?>
<div class="wrap">
    <form name="zidy-webchat-form" action="options.php" method="post" enctype="multipart/form-data">
        <?php settings_fields( 'zidy_webchat_options_group' ); ?>
        <?php do_settings_sections( 'zidy_webchat_options_group' ); ?>

        <h1>Zidy Webchat</h1>
        <table class="form-table" cellspacing="2" cellpadding="5" width="100%">
            <tr>
                <th width="30%" valign="top" style="padding-top: 10px;">
                    <label for="zidy_webchat_enabled">Zidy Webchat is:</label>
                </th>
                <td>
                <select name="zidy_webchat_options[enabled]"  id="zidy_webchat_enabled">
                  <option value="0">Disabled</option>
                  <option <?php selected( $options['enabled'], 1 );?> value="1" >Enabled</option>
                </select>
                </td>
            </tr>
        </table>
        <table class="form-table zidy-webchat-script" cellspacing="2" cellpadding="5" width="100%" <?php echo ( $options['enabled'] != 1 ) ? "style=display:none":''?>>
            <tr>
                <th valign="top" style="padding-top: 10px;">
                    <label for="zidy_webchat_widget_code">Zidy Webchat Script:</label>
                </th>
                <td>
                  <textarea rows="5" cols="120" placeholder="<!-- Insert the Zidy Webchat script here -->" name="zidy_webchat_options[widget_code]"><?php echo esc_attr( $options['widget_code'] ); ?></textarea>
                    <p style="margin: 5px 10px;">Please Enter Your Zidy Webchat Script Above </p>
                </td>
            </tr>
        </table>
        <p class="submit">
            <?php echo submit_button('Save Changes'); ?>
        </p>
    </form>
</div>
<script type="text/javascript">
    jQuery("#zidy_webchat_enabled").on('change', function(){
        if (jQuery(this).val() == "1"){
            jQuery(".zidy-webchat-script").show();
        } else {
            jQuery(".zidy-webchat-script").hide();
        }
    });
</script>