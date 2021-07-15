<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inventorizer Web App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="./resources/css/box.png" />
    <link rel="stylesheet" type="text/css" href="./resources/css/loginStyles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="./resources/js/loginScripts.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light text-left">
        <span class="material-icons float-xl-left float-md-right text-center align-middle">
            inventory_2
        </span>
        <a class="navbar-brand font-weight-bold text-center d-none d-lg-block" href="#">
            Inventorizer
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item active">
                    <a class="nav-link font-weight-bold text-center " href="/Inventorizer/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-center " href="/Inventorizer/stashes">Stashes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-center " href="/Inventorizer/categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-center " href="/Inventorizer/items">Items</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link font-weight-bold text-center align-middle" href="/Inventorizer/userSettings">
                        <span class="material-icons float-md-left float-md-right text-center align-middle">
                            account_circle
                        </span>
                        <?php echo $_SESSION['displayid']; ?>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link font-weight-bold text-center" href="/Inventorizer/logout">
                        <span class="material-icons float-md-left float-md-right text-center align-middle">
                            logout
                        </span>
                        Log out
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="jumbotron mt-5 bg-light">
            <h1 class="display-4">Welcome to Inventorizer!</h1>
            <p class="lead">This is a simple inventory App that will help you manage all your business items in the
                easiest way posible.</p>
            <hr class="my-4">
            <p>It uses simple categories and inventory management for you to have the best and simplest experience
                possible.</p>
            <!--a class="btn btn-primary btn-lg" href="#" role="button">My Inventory</a-->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>