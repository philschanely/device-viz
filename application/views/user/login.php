<h2>Log in</h2>

{show_message?}
<p class="alert alert-warning">{message}</p>
{/show_message?}

<form action="{base_url}user/login">
    <ul>
        <li class="control-group">
            <label class="control-label">Username</label>
            <div class="controls">
                <input type="text" name="username" />
            </div>
        </li>
        <li class="control-group">
            <label class="control-label">Password</label>
            <div class="controls">
                <input type="password" name="password" />
            </div>
        </li>
    </ul>
    <p class="form-actions"><input type="submit" value="Log in" /></p>
</form>