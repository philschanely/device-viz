<h2>{site.name} <small>Device Data Visualization</small></h2>
<p>The visualizations below are to-scale simulations of the devices used to access your site based on the data you've imported so far.</p>
<h3>Device Onion Skin</h3>
<p>This display shows the size of devices laid on top of each other. Darker edges are from devices that were used frequently while lighter edges are from devices used less frequently.</p>
<h3>Device Lineup</h3>
<p>Here is a to-scale line-up of the devices. They are sorted from most popular to least popular. Other sorting and filtering options are coming soon.</p>
<ul class="list-unstyled list-inline">
{devices}
    <li>
        {device}
        <p class="device-info">
            <span>{width}&times;{height}</span>
            <span class="session-count">{sessions}</span>
            <span class="sessions-label">sessions</span> 
            {show_percentage?}
            <span class="sessions-percentage">{percentage}%</span>
            {/show_percentage?}
            {show_url?}
            <span class="sessions-url">{site.url}{url}</span>
            {/show_url?}
        </p>
    </li>
{/devices}
</ul>