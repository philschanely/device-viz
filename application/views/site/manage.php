<h2>Manage a site: {site.name}</h2>

<section id="data-periods" class="entity">
    <header>
        <h3>Data Periods</h3>
        <div class="options">
            <a class="btn-add" href="{base_url}period/edit/0/{site.site_id}">&plus; Add Data Period</a>
        </div>
        <div class="intro">
            <p>Data periods allow you to enter data inside a specific date range. Add at least one in order to add or import data to visualize.</p>
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
                <div class="btn-group">
                    <a class="btn btn-default" href="{base_url}period/edit/{period_id}/{site.site_id}">Edit</a>
                    <a class="btn btn-default" href="{base_url}data/index/{period_id}">Manage data</a>
                    <a class="btn btn-danger disabled" href="#">Delete</a>
                </div>
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
        <div class="intro">
            <p>Device groups help you visualize the devices accessing your site. Add as many as you like but consider the following:</p>
            <ul class="list-unstyled">
                <li>Smartphone: 100px to 767px including portrait orientation</li>
                <li>Tablet: 768px to 1199px including portrait orientation</li>
                <li>Laptop: 1200px to 1599px excluding portrait orientation</li>
                <li>Desktop: 1600px to 5000px including portrait orientation</li>
            </ul>
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
            <td>
                <div class="btn-group">
                    <a class="btn btn-default" href="{base_url}group/edit/{group_id}/{site.site_id}">Edit</a>
                    <a class="btn btn-danger disabled" href="#">Delete</a>
                </div>
            </td>
        </tr>
        {/groups}
    </table>
    {/groups_found?}

    {groups_not_found?}
    <p>No data periods are set up yet.</p>
    {/groups_not_found?}
</section>