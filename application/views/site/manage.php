<h2>Manage a site: {site.name}</h2>

<section id="data-periods" class="entity">
    <header>
        <h3>Data Periods</h3>
        <div class="options">
            <a class="btn-add" href="{base_url}period/edit/0/{site.site_id}">&plus; Add Data Period</a>
        </div>
    </header>
    {periods_found?}
    <table>
        <tr>
            <th>Start date</th>
            <th>End date</th>
            <th>Options</th>
        </tr>
        {periods}
        <tr>
            <td>{start_date}</td>
            <td>{end_date}</td>
            <td>
                <a href="{base_url}period/edit/{period_id}">Edit</a> | 
                <a href="{base_url}data/index/{period_id}">Manage data</a> | 
                Delete
            </td>
        </tr>
        {/periods}
    </table>
    {/periods_found?}

    {periods_not_found?}
    <p>No data periods are set up yet.</p>
    {/periods_not_found?}
</section>

<section id="device-groups" class="entity">
    <header>
        <h3>Device Groups</h3>
        <div class="options">
            <a class="btn-add" href="{base_url}group/edit/0/{site.site_id}">&plus; Add Device Group</a>
        </div>
    </header>
    {groups_found?}
    <table>
        <tr>
            <th>Name</th>
            <th>Min. Width</th>
            <th>Max. Width</th>
            <th>Includes portrait</th>
            <th>Options</th>
        </tr>
        {groups}
        <tr>
            <td>{name}</td>
            <td>{min_width}</td>
            <td>{max_width}</td>
            <td>{allow_portrait}</td>
            <td><a href="{base_url}group/edit/{group_id}">Edit</a> | Move up | Move down | Delete </td>
        </tr>
        {/groups}
    </table>
    {/groups_found?}

    {groups_not_found?}
    <p>No data periods are set up yet.</p>
    {/groups_not_found?}
</section>