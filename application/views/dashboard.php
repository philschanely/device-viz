<h2>Dashboard</h2>
<section id="own-sites" class="entity">
    <header>
        <h3>Site Profiles</h3>
        <div class="options">
            <a class="btn-add" href="{base_url}site/edit">&plus; Add a site</a>
        </div>
        <div class="intro">
            <p>Site Profiles allow you to track data for a specific site. Add one to get started!</p>
        </div>
    </header>
    {sites_found?}
    <table>
        <tr>
            <th>Site</th>
            <th>Options</th>
        </tr>
        {sites}
        <tr>
            <td>
                <a href="{url}">{name}</a>
            </td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-default" href="{base_url}site/index/{site_id}">Visualize</a>
                    <a class="btn btn-default" href="{base_url}site/manage/{site_id}">Manage</a>
                    <a class="btn btn-default" href="{base_url}site/edit/{site_id}">Edit</a>
                    <a class="btn btn-danger disabled" href="#">Delete</a>
                </div>
            </td>
        </tr>
        {/sites}
        
    </table>
    {/sites_found?}
    {sites_not_found?}
    <p>You don't have any site profiles set up yet.</p>
    {/sites_not_found?}
</section>
