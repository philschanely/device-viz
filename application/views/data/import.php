<h2>Import Device Data</h2>
<p>Import data straight from Google Analytics. Follow these steps:</p>
<ul>
    <li>In Google Analytics, filter your data set to match the dates for the currently selected data period: {period.start_date} - {period.end_date}</li>
    <li>Choose the Screen Resolution aggregation from the Technology section.</li>
    <li>Add the secondary dimension of Behavior &gt; Page</li>
    <li>Ensure your entire data set is visible by adjusting the pagination options</li>
    <li>Export the data to a CSV file</li>
    <li>Upload the CSV file Google provided. <a href="{base_url}data/import_sample">Install a sample data set</a></li>
</ul>
<?php echo form_open_multipart('data/import/' . $period->period_id, array('class'=>'form-horiztonal'));?>
    <div class="form-group">
        <label class="control-label">Choose a file</label>
        <p class="controls">
            <input type="file" name="csvfile" size="20" />
            <span class="help-block"><?php echo form_error('csvfile'); ?></span>
        </p>
    </div>
    <input type="hidden" name="period_id" value="{period.period_id}" />
    <input type="hidden" name="user_id" value="{user.user_id}" />
    <div class="form-group form-end">
        <p class="controls">
            <input type="submit" name="submit-data-import" value="Save" />
            <a class="btn-cancel" href="{base_url}data/index/{period.period_id}">Cancel</a>
        </p>
    </div>
</form>