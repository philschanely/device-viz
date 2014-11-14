<h2>Dashboard</h2>
<section id="own-sites">
    <header>
        <h3>Site Profiles</h3>
        <div class="options">
            <a class="btn-add" href="{base_url}site/add">&plus; Add a site</a>
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
                <a href="{base_url}site/index/{site_id}">Visualize</a> | 
                <a href="{base_url}site/manage/{site_id}">Manage</a> | 
                <a href="{base_url}site/edit/{site_id}">Edit</a>
            </td>
        </tr>
        {/sites}
        
    </table>
    {/sites_found?}
    {sites_not_found?}
    <p>You don't have any site profiles set up yet.</p>
    {/sites_not_found?}
</section>
