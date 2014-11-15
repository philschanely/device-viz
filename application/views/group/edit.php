<h2>Edit a Device Group</h2>
<form method="post" action="{base_url}group/edit" class="form-horizontal">
    <?php echo validation_errors(); ?>
    <ul>
        <li class="form-group">
            <label class="control-label">Name</label>
            <div class="controls">
                <input type="text" name="name" value="{group.name}"/>
                <span class="help-block"><?php echo form_error('name'); ?></span>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">Name</label>
            <div class="controls">
                <label class="radio-inline">
                    <input type="radio" name="icon" id="icon-smartphone" value="1"> 
                    <img src="http://placehold.it/80x100" alt=smartphone" title="smartphone" />
                </label>
                <label class="radio-inline">
                    <input type="radio" name="icon" id="icon-tablet" value="2">
                    <img src="http://placehold.it/80x100" alt=tablet" title="tablet" />
                </label>
                <label class="radio-inline">
                    <input type="radio" name="icon" id="icon-laptop" value="3">
                    <img src="http://placehold.it/80x100" alt=laptop" title="laptop" />
                </label>
                <label class="radio-inline">
                    <input type="radio" name="icon" id="icon-desktop" value="4">
                    <img src="http://placehold.it/80x100" alt=desktop" title="desktop" />
                </label>
                <?php echo form_error('icon'); ?>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">Min. Width</label>
            <div class="controls">
                <input type="number" name="min_width" value="{group.min_width}"/>
                <span class="help-block"><?php echo form_error('min_width'); ?></span>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">Max. Width</label>
            <div class="controls">
                <input type="number" name="max_width" value="{group.max_width}"/>
                <span class="help-block"><?php echo form_error('max_width'); ?></span>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">Include portrait orientations?</label>
            <div class="controls">
                <label class="radio-inline">
                    <input type="radio" name="allow_portrait" value="1"> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="allow_portrait" value="2"> No
                </label>
                <?php echo form_error('allow_portrait'); ?>
            </div>
        </li>
    </ul>
    <input type="hidden" name="group_id" value="{group.group_id}" />
    <input type="hidden" name="site" value="{group.site}" />
    <input type="hidden" name="order" value="{group.order}" />
    <input type="hidden" name="user_id" value="{user.user_id}" />
    <div class="form-group form-end">
        <p class="controls">
            <input type="submit" name="submit-group-edit" value="Save" />
        </p>
    </div>
</form>