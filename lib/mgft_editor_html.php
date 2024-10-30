<?php
if (!class_exists('misamee_gf_tools')) {
    require_once '../misamee-gf-tools.php';
}
?>
<div id="select_mgft_shortcode" title="<?php _e("Compose shortcode", misamee_gf_tools::$localizationDomain); ?>">
    <div class="wrap">
        <fieldset>
            <div>
                <label for="shortcode_type" class="normal"><?php _e("Select the shortcode you want to build:", misamee_gf_tools::$localizationDomain); ?></label>
                <select id="shortcode_type" class="shortcodeargument">
                    <option value="grandtotal" selected="selected"><?php _e("Total", misamee_gf_tools::$localizationDomain); ?></option>
                    <option value="progressbar"><?php _e("Progress bar", misamee_gf_tools::$localizationDomain); ?></option>
                </select> <br/>
            </div>
            <div>
                <label for="form_id" class="normal"><?php _e("Select a form below to add it to your post or page:", misamee_gf_tools::$localizationDomain); ?></label>
                <select id="form_id" class="shortcodeargument">
                    <option value=""><?php _e("Select a Form", misamee_gf_tools::$localizationDomain); ?>  </option>
                    <?php
                    $forms = RGFormsModel::get_forms(1, "title");
                    foreach ($forms as $form) {
                        ?>
                        <option value="<?php echo absint($form->id) ?>"><?php echo esc_html($form->title) ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
		</fieldset>

		<fieldset>
            <h2><?php _e("Set parameters", misamee_gf_tools::$localizationDomain); ?></h2>
            <div class="row">
                <label for="cssclass" class="normal"><?php _e("CSS Class", misamee_gf_tools::$localizationDomain); ?></label>
                <input type="text" id="cssclass" class="shortcodeargument" value="<?php echo misamee_gf_tools::$defaults['cssclass']; ?>" data-default="<?php echo misamee_gf_tools::$defaults['cssclass'];?>" />
            </div>
            <div class="row">
                <label for="htmlelement" class="normal"><?php _e("HTML Element", misamee_gf_tools::$localizationDomain); ?></label>
                <input type="text" id="htmlelement" class="shortcodeargument" value="<?php echo misamee_gf_tools::$defaults['htmlelement']; ?>" data-default="<?php echo misamee_gf_tools::$defaults['htmlelement'];?>" />
            </div>
            <div class="row">
                <label for="exp" class="normal"><?php _e("Expression", misamee_gf_tools::$localizationDomain); ?></label>
				<input type="text" id="exp" class="shortcodeargument" value="" data-default="<?php echo misamee_gf_tools::$defaults['exp'];?>" />
                <a href="#" class="selectfields" rel="selectfield_exp">[?] <?php _e("List fields", misamee_gf_tools::$localizationDomain); ?></a>
            </div>
            <div class="progressbar row">
                <label for="maxvalueexp" class="normal"><?php _e("Maximum Value Expression", misamee_gf_tools::$localizationDomain); ?></label>
				<input type="text" id="maxvalueexp" class="shortcodeargument" value="" data-default="<?php echo misamee_gf_tools::$defaults['maxvalueexp'];?>" />
            </div>
            <div class="progressbar row">
                <input type="checkbox" id="autostyle" class="shortcodeargument"<?php echo (misamee_gf_tools::$defaults['autostyle'] != 0 ? ' checked="checked"' : ''); ?> data-default="<?php echo misamee_gf_tools::$defaults['autostyle'];?>" />
				&nbsp;<label for="autostyle"><?php _e("Style automatically", misamee_gf_tools::$localizationDomain); ?></label>
				&nbsp;<input type="checkbox" id="hidevalue" class="shortcodeargument"<?php echo (misamee_gf_tools::$defaults['hidevalue'] != 0 ? ' checked="checked"' : ''); ?> data-default="<?php echo misamee_gf_tools::$defaults['hidevalue'];?>" />
				&nbsp;<label for="hidevalue"><?php _e("Hide progress bar value", misamee_gf_tools::$localizationDomain); ?></label>
            </div>

            <div class="progressbar row">
                    <label for="colors" class="normal full"><?php _e("Colors", misamee_gf_tools::$localizationDomain); ?></label>
                    <input type="hidden" id="colors" value="<?php echo misamee_gf_tools::$defaults['colors'];?>" data-default="<?php echo misamee_gf_tools::$defaults['colors'];?>" />
                    <div id="colorswrapper" class="shortcodeargument">
                        <div class="colorcontainer" style="display: inline-block;">
                            <!--suppress HtmlFormInputWithoutLabel -->
                            <input type="text" class="color" value="#FF0000" style="width:50px" />
                        </div>
                        <div class="colorcontainer" style="display: inline-block;">
                            <!--suppress HtmlFormInputWithoutLabel -->
                            <input type="text" class="color" value="#FFFF00" style="width:50px" />
                            <a href="#" class="shortcodeargument removecolor">[-]</a>
                        </div>
                        <div class="colorcontainer" style="display: inline-block;">
                            <!--suppress HtmlFormInputWithoutLabel -->
                            <input type="text" class="color" value="#00FF00" style="width:50px" />
                            <a href="#" class="shortcodeargument removecolor">[-]</a>
                        </div>
                    </div>
                    <a href="#" id="addcolor" class="shortcodeargument">[+] <?php _e("Add a new color", misamee_gf_tools::$localizationDomain); ?></a>
            </div>
        </fieldset>

        <fieldset>
            <div class="row">
                <input type="checkbox" id="thousandsseparator" class="shortcodeargument"<?php echo (misamee_gf_tools::$defaults['thousandsseparator'] != 0 ? ' checked="checked"' : ''); ?> data-default="<?php echo misamee_gf_tools::$defaults['thousandsseparator'];?>" />
				&nbsp;<label for="thousandsseparator"><?php _e("Print thousands separator", misamee_gf_tools::$localizationDomain); ?></label>
            </div>
            <div class="row">
                <label for="decimals" class="normal"><?php _e("Number of decimals", misamee_gf_tools::$localizationDomain); ?></label>
				<input type="text" id="decimals" class="shortcodeargument" value="<?php echo misamee_gf_tools::$defaults['decimals']; ?>" data-default="<?php echo misamee_gf_tools::$defaults['decimals'];?>" />
            </div>
            <div class="row">
                <label for="search" class="normal"><?php _e("Filter entries by", misamee_gf_tools::$localizationDomain); ?></label>
				<input type="text" id="search" class="shortcodeargument" value="<?php echo misamee_gf_tools::$defaults['search'];?>" data-default="<?php echo misamee_gf_tools::$defaults['search'];?>" />
            </div>
            <div class="row">
                <label for="star" class="normal"><?php _e("Filter starred entries", misamee_gf_tools::$localizationDomain); ?></label>
				<select id="star" class="shortcodeargument" data-default="<?php echo misamee_gf_tools::$defaults['star'];?>">
					<option value="" selected="selected"><?php _e("No", misamee_gf_tools::$localizationDomain); ?></option>
					<option value="1"><?php _e("Starred", misamee_gf_tools::$localizationDomain); ?></option>
					<option value="0"><?php _e("Non starred", misamee_gf_tools::$localizationDomain); ?></option>
				</select>
            </div>
            <div class="row">
                <label for="entrystatus" class="normal"><?php _e("Filter entry status", misamee_gf_tools::$localizationDomain); ?></label>
				<select id="entrystatus" class="shortcodeargument" data-default="<?php echo misamee_gf_tools::$defaults['entrystatus'];?>">
					<option value="active"<?php echo (misamee_gf_tools::$defaults['entrystatus'] == 'active' ? ' selected="selected"' : ''); ?>><?php _e("Active", misamee_gf_tools::$localizationDomain); ?></option>
					<option value="spam"<?php echo (misamee_gf_tools::$defaults['entrystatus'] == 'spam' ? ' selected="selected"' : ''); ?>><?php _e("Spam", misamee_gf_tools::$localizationDomain); ?></option>
					<option value="trash"<?php echo (misamee_gf_tools::$defaults['entrystatus'] == 'trash' ? ' selected="selected"' : ''); ?>><?php _e("Trash", misamee_gf_tools::$localizationDomain); ?></option>
				</select>
            </div>
        </fieldset>

        <div class="preview">
            <h3 style="margin: 5px 0 0 0;"><?php _e("Shortcode:", misamee_gf_tools::$localizationDomain); ?></h3>
            <div id="shortcodepreview" style="padding:0 15px;font-weight: bold;"></div>

            <h3 style="margin: 5px 0 0 0;"><?php _e("Preview:", misamee_gf_tools::$localizationDomain); ?></h3>
            <div id="shortcodesamples" style="padding:0 15px;font-weight: bold;"></div>
        </div>
    </div>
</div>
<div id="selectfield_exp" class="fieldslistcontainer" title="<?php _e("Fields list", misamee_gf_tools::$localizationDomain); ?>"></div>
