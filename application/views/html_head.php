<!DOCTYPE html>
<html lang="en" class="{page_class}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{page_title} | DeviceViz</title>

        <!-- Bootstrap -->
        <link href="{base_url}assets/css/styles.css" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav id="nav-main">
            <div id="nav-main-content">
                <div id="masthead">
                    <h1><a href="{base_url}">Device<b>Viz</b> <small>Visualize your device data</small></a></h1>
                </div>
                {show_login?}
                <a id="btn-login" href="{base_url}user/login?returnto=main/dashboard">Log in</a>
                {/show_login?}
                {show_acct_options?}
                <a id="btn-logout" href="{base_url}user/logout">Log out</a>
                <a id="btn-account" href="{base_url}user/index">My Account</a>
                {/show_acct_options?}
            </div>
        </nav>
        
        <div id="site-content">
            {show_feedback?}
            <div id="feedback">
                {show_flashdata?}{flashdata}{/show_flashdata?}
                {feedback}
            </div>
            {/show_feedback?}
            