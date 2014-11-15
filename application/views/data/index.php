<h2>Device Data</h2>
<div class="entity">
    <h3>{period.start_date} - {period.end_date}</h3>
    <a class="btn-add" href="{base_url}data/edit/0/{period.period_id}">&plus; Add</a>
    <a class="btn-add" href="{base_url}data/import/{period.period_id}">&uarr; Import</a>
</div>
{device_data_found?}
<table>
    <tr>
        <th>Width</th>
        <th>Height</th>
        <th>Initial URL</th>
        <th># Sessions</th>
        <th>Avg. Duration</th>
        <th>Avg. # Pages</th>
        <th>Options</th>
    </tr>
    {device_data}
    <tr>
        <td>{width}</td>
        <td>{height}</td>
        <td>{url}</td>
        <td>{sessions}</td>
        <td>{avg_duration}</td>
        <td>{avg_pages}</td>
        <td><a href="{base_url}data/edit/{data_point_id}">Edit</a> | Delete</td>
    </tr>
    {/device_data}
</table>
{/device_data_found?}
{device_data_not_found?}
<p>No data provided yet.</p>
{/device_data_not_found?}