


<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Explorer</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="dossier_reception/contenu.php">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/bootstrap.min.js"></script>

        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->



    <div class="container">
 
        <div class="row">
            <div class="col-sm-6">
                <form action="?" method="POST" id="mkdir"/>
                    <label for=dirname>Nouveau Dossier</label>
                    <input id=dirname type=text name=name value="" />
                    <input type="submit" value="OK" />
                </form>
            </div>

            <div id="file_drop_target"  class="col-sm-6">
                <input type="file" multiple />
                <input type="submit" name="ok" value="OK">
            </div>

            <div id="breadcrumb" class="col-sm-12 py-2">&nbsp;</div>
        </div>
        

        <div id="upload_progress"></div>
        <table id="table"  class="table">
            <thead>
                <tr>
                	
                    <th>Nom</th>
                    <th>Taille</th>
                    <th>Modifier</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                </tr>
                <td><?php
                         include('dossier_reception/contenu.php');

                      
                    ?></td>
            </thead>

            <tbody id="list">



            </tbody>



        </table>

      <hr>

        <footer>
        <p>&copy;  By tim,ines,gabet romain ^^ </p>
        </footer>

    </div> 
    <!-- /container -->        
            


        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
