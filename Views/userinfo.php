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
    <script type="text/javascript" src="/Inventorizer/resources/js/accountScripts.js"></script>
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
                        <?php echo $_SESSION['displayid'];?>
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
                    <h1>Account Settings</h1>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col mb-1">
                    <p class="h4">User ID:</p>
                    <p><?php echo $_SESSION['userid'];?></p>
                    <p class="h4">User Name:</p>
                    <p><?php echo $_SESSION['username'];?></p>
                    <p class="h4">Display Name:</p>
                    <p><?php echo $_SESSION['displayid'];?></p>
                    <p class="h4">Email Address:</p>
                    <p><?php echo $_SESSION['emailreg'];?></p>
                </div>
            </div>
            <div class="row mt-3">
                <button type="button" data-toggle="modal" data-target="#modify" class="btn btn-primary mr-3"
                    onclick="placeValues(<?php echo $_SESSION['userid'];?>,'<?php echo $_SESSION['username'];?>','<?php echo $_SESSION['displayid'];?>','<?php echo $_SESSION['emailreg'];?>')">
                    Modify Account
                    <span class="material-icons float-right ml-1">
                        edit
                    </span>
                </button>
                <button type="button" data-toggle="modal" data-target="#changepass" class="btn btn-primary mr-auto"
                    onclick="placeSecretValues(<?php echo $_SESSION['userid'];?>)">
                    Change password
                    <span class="material-icons float-right ml-1">
                        lock
                    </span>
                </button>
                <button type="button" data-toggle="modal" data-target="#delete" class="btn btn-danger">
                    Delete Account
                    <span class="material-icons float-right ml-1">
                        delete
                    </span>
                </button>
            </div>
        </div>
    </div>

    <!--Modal de modificar cuenta-->
    <div class="modal fade" id="modify" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Modify Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="InputChangeUser">New username:</label>
                        <input type="text" class="form-control" id="InputChangeUser">
                        <p id="invalidChangeUser" class="h5 invalid-feedback mt-2" hidden>This user already exists.</p>
                    </div>
                    <div class="form-group">
                        <label for="InputChangeDisplay">New display name:</label>
                        <input type="text" class="form-control" id="InputChangeDisplay">
                        <p id="invalidChangeDisplay" class="h5 invalid-feedback mt-2" hidden>This value cannot be null.</p>
                    </div>
                    <div class="form-group">
                        <label for="InputChangeEmail">New email:</label>
                        <input type="text" class="form-control" id="InputChangeEmail">
                        <p id="invalidChangeEmail" class="h5 invalid-feedback mt-2" hidden>This email is not valid.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">
                        <span class="material-icons float-right ml-1">
                            close
                        </span>Cancel
                    </button>
                    <button type="button" class="btn btn-primary" onclick="sendToUpdate(InputChangeUser.value,InputChangeDisplay.value,InputChangeEmail.value)">
                        <span class="material-icons float-right ml-1">
                            save
                        </span>Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal de modificar contraseña-->
    <div class="modal fade" id="changepass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Change Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="InputOldPass">Old password:</label>
                        <input type="password" class="form-control" id="InputOldPass" onkeyup="validateOldPass('<?php echo $_SESSION['username'];?>',InputOldPass.value)">
                        <p id="invalidOldPass" class="h5 invalid-feedback mt-2" hidden>This password is incorrect.</p>
                    </div>
                    <div class="form-group">
                        <label for="InputNewPass">New password:</label>
                        <input type="password" class="form-control" id="InputNewPass">
                        <p id="invalidNewPass" class="h5 invalid-feedback mt-2" hidden>Password must contain at least 1 number,
                    upper case letter and lower case letter and be between 8 and 20 characters long.</p>
                    </div>
                    <div class="form-group">
                        <label for="InputConfirmPass">Confirm new password:</label>
                        <input type="password" class="form-control" id="InputConfirmPass">
                        <p id="invalidConfirmPass" class="h5 invalid-feedback mt-2" hidden>Password does not match.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">
                        <span class="material-icons float-right ml-1">
                            close
                        </span>Cancel
                    </button>
                    <button type="button" class="btn btn-primary" onclick="sendToSecretUpdate('<?php echo $_SESSION['username'];?>',InputOldPass.value,InputNewPass.value,InputConfirmPass.value)">
                        <span class="material-icons float-right ml-1">
                            save
                        </span>Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal de eliminar cuenta-->
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Delete Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>IMPORTANT: This action cannot be undone, are you sure you want to proceed?</h5>
                    <h5>(This action will end your session).</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">
                        <span class="material-icons float-right ml-1">
                            close
                        </span>Cancel
                    </button>
                    <button type="button" class="btn btn-danger" onclick="sendToDelete(<?php echo $_SESSION['userid'];?>)">
                        <span class="material-icons float-right ml-1">
                            delete
                        </span>Delete
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
