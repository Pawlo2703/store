<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="http://localhost/Shop/public/css/bootstrap.min.css" rel="stylesheet">
        <link href="http://localhost/Shop/public/css/main.css" type="text/css" rel="stylesheet" />


    </head>
    <body>
        <nav class="sup-navbar navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Sup</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <form class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <a href="#" class="btn btn-success">Koszyk</a>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="home">Strona główna <span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Produkty <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Jabłko <span class="badge">14</span></a></li>
                        <li><a href="#">Gruszka <span class="badge">14</span></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                <li><a href="#">Kontakt</a></li>
                <li><a href="logout">Wyloguj</a></li></li>
            </ul>
        </div>
    </div>
</nav>

