<h2>Edit a Data Period</h2>
<form method="post" action="{base_url}period/edit" class="form-horizontal">
    <?php echo validation_errors(); ?>
    <ul>
        <li class="form-group">
            <label class="control-label">Start Date</label>
            <div class="controls">
                <input type="date" name="start_date" value="{period.start_date}"/>
                <span class="help-block"><?php echo form_error('start_date'); ?></span>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">End Date</label>
            <div class="controls">
                <input type="date" name="end_date" value="{period.end_date}"/>
                <span class="help-block"><?php echo form_error('end_date'); ?></span>
            </div>
        </li>
    </ul>
    <input type="hidden" name="period_id" value="{period.period_id}" />
    <input type="hidden" name="site" value="{period.site}" />
    <input type="hidden" name="user_id" value="{user.user_id}" />
    <div class="form-group form-end">
        <p class="controls">
            <input type="submit" name="submit-perdio-edit" value="Save" />
        </p>
    </div>
</form>