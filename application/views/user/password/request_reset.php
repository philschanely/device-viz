<h2>Reset a forgotten password</h2>
<form action="{base_url}user/password/request_reset" method="post" class="form-horizontal">
    <p>If you've forgotten your password just enter your account's email address below. You'll receive an email with a link to reset your password.</p>
    <div class="form-group">
        <label class="control-label">Email</label>
        <p class="controls">
            <input type="text" name="email" value="" />
            <span class="help-block"><?php echo form_error('email'); ?></span>
        </p>
    </div>
    <div class="form-end form-group">
        <p class="controls">
            <input name="submit-requst-reset" type="submit" value="Request reset" />
        </p>
    </div>
</form>