<h2>Edit a Site</h2>
<form method="post" action="{base_url}site/edit" class="form-horizontal">
    <ul>
        <li class="form-group">
            <label class="control-label">Name</label>
            <div class="controls">
                <input type="text" name="name" value="{site.name}"/>
                <span class="help-block"><?php echo form_error('name'); ?></span>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">URL</label>
            <div class="controls">
                <input type="text" name="url" value="{site.url}"/>
                <span class="help-block"><?php echo form_error('url'); ?></span>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">Description</label>
            <div class="controls">
                <textarea name="description" class="form-control" rows="5">{site.description}</textarea>
                <span class="help-block"><?php echo form_error('description'); ?></span>
            </div>
        </li>
    </ul>
    <input type="hidden" name="site_id" value="{site.site_id}" />
    <input type="hidden" name="user_id" value="{user.user_id}" />
    <div class="form-group form-end">
        <p class="controls">
            <input type="submit" name="submit-site-edit" value="Save" />
        </p>
    </div>
</form>