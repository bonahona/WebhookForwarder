<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">
        <?php echo $this->Html->Favicon('fyrvall-favicon.png');?>

        <title><?php echo $title;?></title>

        <?php echo $this->Html->Css('bootstrap.min.css');?>
        <?php echo $this->Html->Css('dashboard.css');?>
    </head>

    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top dark-blue">
            <div class="container-fluid">
                <div class="navbar-header"/>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar hidden">
                    <?php if(isset($Sidebar)):?>
                        <?php echo $this->PartialView('Sidebar', array('Sidebar' => $Sidebar));?>
                    <?php endif;?>
                </div>
                <main role="main">
                    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                        <article>
                            <?php echo $view;?>
                        </article>
                    </div>
                </main>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <?php echo $this->Html->Js('bootstrap.min.js');?>
        <?php echo $this->Html->Js('dashboard.js');?>
    </body>
</html>
