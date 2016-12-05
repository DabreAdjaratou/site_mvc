
<html>
    <head>
        <title><?php echo isset($title_for_layout) ? $title_for_layout : 'MON SITE'; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"  href="../../web/bootstrap/css/bootstrap.min.css" >
    </head>
    <body>
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">MON SITE</a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <?php foreach ($pages as $p): ?> 
                    <li><a href="<?php echo base_url.'/page/view/'.$p->id; ?>" title="<?php echo $p->name; ?>"><?php echo $p->name; ?></a></li>;
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>

        <div class="container"> <?php echo $content_for_layout; ?>
        </div>

    </body>
</html>
