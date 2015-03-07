<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php bloginfo('name'); if(wp_title('', false)) { echo ' | ';} wp_title('');   ?></title>

    <link href="//www.google-analytics.com" rel="dns-prefetch">
    <link href="<?php echo get_template_directory_uri(); ?>/favicon.ico" rel="shortcut icon">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
    <meta name="theme-color" content="#<?php background_color(); ?>">
    <style>
        body    {
            background-color: #<?php background_color(); ?>;
        }
        nav#nav ul {
            background-color: #<?php background_color(); ?>;
        }
        html.no-touch nav#nav ul li ul    {
            background-color: #<?php background_color(); ?>;
        }
        header h1   {
            background-color: #<?php background_color(); ?>;
        }
        input.form-control, textarea.form-control  {
            background-color: #<?php background_color(); ?>;
        }
        #toc {
            background-color: #<?php background_color(); ?>;
        }
    </style>
</head>
<body <?php body_class(); ?> id="top">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <!--[if lte IE 9]>
        <p class="browsehappy">Je gebruikt een <strong>hevig verouderde</strong> browser. <a href="http://browsehappy.com/">Update alsjeblieft je browser</a> om het web beter en veiliger te bekijken.<br /><br />You are using a <strong>strongly outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="container">
            <header role="banner" id="header" style="background-image: url(<?php header_image(); ?>);">
                <a id="homelinkheader" href="<?php echo get_home_url(); ?>"></a>
            </header>
            <div id="subtitle"><?php bloginfo('description'); ?></div>
            <nav role="navigation" id="nav">
                <?php alcuinus_nav(); ?>
            </nav>