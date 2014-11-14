<h2>Reset a forgotten password</h2>
<form action="{base_url}user/password/reset" method="post" class="form-horizontal">
    <p>Update your account information by changing it below.</p>
    <ul>
        <li class="form-group">
            <label class="control-label">New password</label>
            <div class="controls">
                <input type="password" name="password" />
                <span class="help-block"><?php echo form_error('password'); ?></span>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">Re-enter new password</label>
            <div class="controls">
                <input type="password" name="password2" />
                <span class="help-block"><?php echo form_error('password2'); ?></span>
            </div>
        </li>
    </ul>
    <input type="hidden" name="user_id" value="{user_id}" />
    <input type="hidden" name="action_code" value="{action_code}" />
    <div class="form-end form-group">
        <p class="controls">
            <input name="submit-reset-password" type="submit" value="Reset password" />
        </p>
    </div>
</form>