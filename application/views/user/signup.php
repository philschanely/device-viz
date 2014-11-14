<h2>Sign up for a free account</h2>
<form action="{base_url}user/signup" method="post" class="form-horizontal">
    <ul>
        <li class="form-group">
            <label class="control-label">Name</label>
            <div class="controls">
                <input type="text" name="name" />
                <span class="help-block"><?php echo form_error('name'); ?></span>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">Email</label>
            <div class="controls">
                <input type="text" name="email" />
                <span class="help-block"><?php echo form_error('email'); ?></span>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">Password</label>
            <div class="controls">
                <input type="password" name="password" />
                <span class="help-block"><?php echo form_error('password'); ?></span>
            </div>
        </li>
        <li class="form-group">
            <label class="control-label">Re-enter password</label>
            <div class="controls">
                <input type="password" name="password2" />
                <span class="help-block"><?php echo form_error('password2'); ?></span>
            </div>
        </li>
    </ul>
    <p class="form-actions"><input name="submit-signup" type="submit" value="Sign up" /></p>
</form>