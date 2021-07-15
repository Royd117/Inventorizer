<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inventorizer Web App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="./resources/css/box.png" />
    <link rel="stylesheet" type="text/css" href="./resources/css/global.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="./resources/js/categoryScripts.js"></script>
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
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-center " href="/Inventorizer/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-center " href="/Inventorizer/stashes">Stashes</a>
                </li>
                <li class="nav-item active">
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
            <div class="row">
                <div class="col">
                    <h1>Categories</h1>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col mb-1 text-nowrap">
                    <form action="">
                        <div class="form-row">
                            <div class="col">
                                <input class="form-control" type="text" value="" placeholder="Search categories..." id="InputCategory" onkeyup="printCategories(this.value)">
                            </div>
                            <div class="col">
                                <a type="button" data-toggle="modal" data-target="#newCategory"
                                    class="btn btn-secondary float-right">
                                    <span class="material-icons float-right ml-2">
                                        add_circle_outline
                                    </span>
                                    New category
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--Header de las tarjetas-->
            <div class="table-responsive mt-3">
                <table class="table text-center">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Stash ID</th>
                            <th scope="col">View items</th>
                            <th scope="col">Modify</th>
                        </tr>
                    </thead>
                    <tbody id="tableResultC" class="bg-light">
                        <!--tr>
                            <td class="align-middle">Shoes</td>
                            <td class="align-middle">350</td>
                            <td class="align-middle">HQ</td>
                            <td class="align-middle">
                                <form action="" method="POST">
                                    <button type="submit" class="btn btn-primary text-nowrap" style="min-width: 120px;">
                                        <span class="material-icons float-right ml-1">
                                            view_in_ar
                                        </span>
                                        Items
                                    </button>
                                </form>
                            </td>
                            <td class="align-middle">
                                <form action="" method="POST">
                                    <button type="button" data-toggle="modal" data-target="#modifyCategory"
                                        class="btn btn-primary text-nowrap" style="min-width: 120px;">
                                        <span class="material-icons float-right ml-1">
                                            edit
                                        </span>
                                        Modify
                                    </button>
                                </form>
                            </td>
                        </tr-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="newCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="btn btn-secondary-no-click text-nowrap user-select-none" style="min-width: 120px;">
                        <span class="material-icons float-right ml-1">
                            category
                        </span>
                        New category
                    </a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="InputNewCategoryName">Category name:</label>
                            <input type="text" class="form-control" id="InputNewCategoryName" placeholder="Ex. MyCategory">
                            <p id="invalidNewCategoryName" class="h5 invalid-feedback mt-2" hidden>This value cannot be null.</p>
                        </div>
                        <div class="form-group">
                            <label for="InputNewCategoryStash">Stash it belongs to:</label>
                            <select class="form-control" id="InputNewCategoryStash"></select>
                            <p id="invalidNewCategoryStash" class="h5 invalid-feedback mt-2" hidden>A value must be selected.</p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="sendToCreate(InputNewCategoryName.value,InputNewCategoryStash.value)">
                        Save changes
                        <span class="material-icons float-right ml-1">
                            save
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modifyCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="btn btn-primary-no-click text-nowrap user-select-none" style="min-width: 120px;">
                        <span class="material-icons float-right ml-1">
                            category
                        </span>
                        Modify category
                    </a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="InputNewCategoryName">Category name:</label>
                            <input type="text" class="form-control" id="InputChangeCategoryName">
                            <p id="invalidChangeCategoryName" class="h5 invalid-feedback mt-2" hidden>This value cannot be null.</p>
                        </div>
                        <div class="form-group">
                            <label for="InputNewCategoryStash">Stash it belongs to:</label>
                            <select class="form-control" id="InputChangeCategoryStash"></select>
                            <p id="invalidChangeCategoryStash" class="h5 invalid-feedback mt-2" hidden>This value cannot be null.</p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-auto" onclick="sendToDelete()">
                        Delete
                        <span class="material-icons float-left ml-1">
                            delete
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" onclick="sendToUpdate(InputChangeCategoryName.value,InputChangeCategoryStash.value)">
                        Save changes
                        <span class="material-icons float-right ml-1">
                            save
                        </span>
                    </button>
                </div>
            </div>
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