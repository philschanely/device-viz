<h2>Edit Device Data</h2>
<form method="post" action="{base_url}data/edit" class="form-horizontal">
    <?php echo validation_errors(); ?>
    <ul>
        <li class="form-group">
            <label class="control-label">Width</label>
            <div class="controls">
                <input type="number" name="width" value="{device_data.width}"/>
                <span class="help-block"><?php echo form_error('width'); ?></span>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">Height</label>
            <div class="controls">
                <input type="number" name="height" value="{device_data.height}"/>
                <span class="help-block"><?php echo form_error('height'); ?></span>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">URL</label>
            <div class="controls">
                <input type="text" name="url" value="{device_data.url}"/>
                <span class="help-block"><?php echo form_error('url'); ?></span>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">Number of Sessions</label>
            <div class="controls">
                <input type="number" name="sessions" value="{device_data.sessions}"/>
                <span class="help-block"><?php echo form_error('sessions'); ?></span>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">Avg. Duration</label>
            <div class="controls">
                <input type="text" name="avg_duration" value="{device_data.avg_duration}"/>
                <span class="help-block"><?php echo form_error('avg_duration'); ?></span>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">Avg. Number of Pages</label>
            <div class="controls">
                <input type="number" name="avg_pages" value="{device_data.avg_pages}"/>
                <span class="help-block"><?php echo form_error('avg_pages'); ?></span>
            </div>
        </li>
    </ul>
    <input type="hidden" name="period_id" value="{device_data.period}" />
    <input type="hidden" name="data_id" value="{device_data.data_point_id}" />
    <input type="hidden" name="user_id" value="{user.user_id}" />
    <div class="form-group form-end">
        <p class="controls">
            <input type="submit" name="submit-data-edit" value="Save" />
            <a class="btn-cancel" href="{base_url}data/index/{device_data.period}">Cancel</a>
        </p>
    </div>
</form>