<h2>Device Data</h2>
<div class="entity">
    <h3 class="pull-left">{period.start_date} - {period.end_date}</h3>
    <div class="pull-right btn-group">
        <a class="btn btn-default btn-success btn-add" href="{base_url}data/edit/0/{period.period_id}">&plus; Add</a>
        <a class="btn btn-default btn-import" href="{base_url}data/import/{period.period_id}">&uarr; Import</a>
        <a class="btn btn-default btn-clear" href="{base_url}data/clear/{period.period_id}">Clear data</a>
    </div>
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
        <td>
            <div class="btn-group">
                <a class="btn btn-default" href="{base_url}data/edit/{data_point_id}">Edit</a>
                <a class="btn btn-danger disabled" href="#">Delete</a>
            </div>
        </td>
    </tr>
    {/device_data}
</table>
{/device_data_found?}
{device_data_not_found?}
<p>No data provided yet.</p>
{/device_data_not_found?}