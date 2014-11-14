<h2>Manager your account</h2>
<form action="{base_url}user/index" method="post" class="form-horizontal">
    <p>Update your account information by changing it below.</p>
    <ul>
        <li class="form-group">
            <label class="control-label">Name</label>
            <div class="controls">
                <input type="text" name="name" value="{user.name}" />
                <span class="help-block"><?php echo form_error('name'); ?></span>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">Email</label>
            <div class="controls">
                <input type="text" name="email" value="{user.email}" />
                <span class="help-block"><?php echo form_error('email'); ?></span>
            </div>
        </li>
    </ul>
    <input type="hidden" name="user_id" value="{user.user_id}" />
    <div class="form-end form-group">
        <p class="controls">
            <input name="submit-change-info" type="submit" value="Update info" />
        </p>
    </div>
</form>

<form action="{base_url}user/index" method="post" class="form-horizontal">
    <p>Change your password here if you like.</p>
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
    <input type="hidden" name="user_id" value="{user.user_id}" />
    <div class="form-end form-group">
        <p class="controls">
            <input name="submit-change-password" type="submit" value="Change password" />
        </p>
    </div>
</form>