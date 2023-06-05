<?php
session_start();
$isok = false;
$codiceErrato = false;
if (!isset($_SESSION["logged_in"])) {
    header("location: login_definitivo.php");
    exit;
}
if (isset($_REQUEST["Invio"])) {
    $isok = true;
    $password = trim(htmlspecialchars($_REQUEST["password"]));
    $hash = password_hash($password, PASSWORD_DEFAULT);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        #errore {
            display: none;
            color: #d4c03d;
        }

        #info {
            display: none;
            color:#d4c03d;
        }
        

        #message {
            display: none;
            background: black;
            color: #000;
            position: absolute;
            right: 10px;
            padding: 20px;
            margin-top: 10px;
        }

        #message p {
            padding: 10px 35px;
            font-size: 18px;
        }

        .valid {
            color: green;
        }

        .valid:before {
            position: relative;
            left: -35px;
            content: "✔";
        }


        .invalid {
            color: #d4c03d;
        }

        .invalid:before {
            position: relative;
            left: -35px;
            content: "✖";
        }

        
        #error {
            color: #d4c03d;
        }

        .glow-button:hover {
            color: rgba(255, 255, 255, 1);
            box-shadow: 0 10px 25px rgba(207, 117, 6, 0.4);
        }
    </style>
    <link rel="stylesheet" href="http://localhost/Projectworkits/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Modifica password</title>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md bg-body navbar-dark">
            <a class="navbar-brand" href="http://localhost/Projectworkits/index.php" colour>
                <img src="http://localhost/Projectworkits/30secmod.gif" width="225" height="50" style="width:130px"
                    class="rounded d-block img-fluid">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse davide" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-warning" href="#" id="navbardrop"
                            data-toggle="dropdown">
                            Account
                        </a>
                        <div class="dropdown-menu bg-warning">
                            <a class="dropdown-item" href="http://localhost/Projectworkits/Index.php">Informazioni
                                account</a>
                            <a class="dropdown-item"
                                href="http://localhost/Projectworkits/Account/modificapassword.php">Modifica
                                password</a>
                            <a class="dropdown-item text-danger"
                                href="http://localhost/Projectworkits/Account/LogOut.php">Log Out</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-warning" href="#" id="navbardrop"
                            data-toggle="dropdown">
                            Ricerca ultimi movimenti
                        </a>
                        <div class="dropdown-menu pt-0 pb-0 bg-warning">

                            <form class="form-inline" name="FormRicercaUltimi" action="" method="get">
                                <input class="form-control text-light" style="background-color:#dda74f; border:black"
                                    type="number" id="intRicerca" name="IntUltimi"
                                    placeholder="Trova ultimi X movimenti">
                                <button class="btn btn-block text-warning" style="background-color:#070707;"
                                    type="submit" onclick="CercaUltimi()">Cerca</button>
                            </form>
                            <?php
                            if (isset($_GET['IntUltimi'])) {
                                $intRicercaUltimi = $_GET['IntUltimi'];
                                $url = "http://localhost/Projectworkits/Ricerche/RicercaMovimenti1.php?ID=" . $intRicercaUltimi;

                                if (empty($intRicercaUltimi) == false) {
                                    header("Location: " . $url);
                                }
                            }
                            ?>

                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-warning" href="#" id="navbardrop"
                            data-toggle="dropdown">
                            Ricerca per tipologia movimenti
                        </a>
                        <div class="dropdown-menu bg-warning">
                            <a class="dropdown-item"
                                href="http://localhost/Projectworkits/Ricerche/RicercaMovimenti2.php?ID=2">Bonifico
                                Entrata</a>
                            <a class="dropdown-item"
                                href="http://localhost/Projectworkits/Ricerche/RicercaMovimenti2.php?ID=3">Versamento
                                Bancomat</a>
                            <a class="dropdown-item"
                                href="http://localhost/Projectworkits/Ricerche/RicercaMovimenti2.php?ID=4">Bonifico
                                Uscita</a>
                            <a class="dropdown-item"
                                href="http://localhost/Projectworkits/Ricerche/RicercaMovimenti2.php?ID=5">Prelievo
                                Contanti</a>
                            <a class="dropdown-item"
                                href="http://localhost/Projectworkits/Ricerche/RicercaMovimenti2.php?ID=6">Pagamento
                                Utenze</a>
                            <a class="dropdown-item"
                                href="http://localhost/Projectworkits/Ricerche/RicercaMovimenti2.php?ID=7">Ricarica
                                Telefonica</a>
                            <a class="dropdown-item"
                                href="http://localhost/Projectworkits/Ricerche/RicercaMovimenti2.php?ID=8">Pagamento
                                Bollette</a>
                            <a class="dropdown-item"
                                href="http://localhost/Projectworkits/Ricerche/RicercaMovimenti2.php?ID=9">Pagamento
                                F24</a>
                            <a class="dropdown-item"
                                href="http://localhost/Projectworkits/Ricerche/RicercaMovimenti2.php?ID=10">Bollettino
                                Postale</a>
                            <a class="dropdown-item"
                                href="http://localhost/Projectworkits/Ricerche/RicercaMovimenti2.php?ID=11">Ricarica
                                Carta Prepagata</a>
                            <a class="dropdown-item"
                                href="http://localhost/Projectworkits/Ricerche/RicercaMovimenti2.php?ID=12">Bollo
                                Auto</a>
                            <a class="dropdown-item"
                                href="http://localhost/Projectworkits/Ricerche/RicercaMovimenti2.php?ID=13">Accredito
                                Stipendio</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-warning" href="#" id="navbardrop"
                            data-toggle="dropdown">
                            Ricerca per data movimento
                        </a>
                        <div class="dropdown-menu pt-0 pb-0 bg-warning">
                            <form class="form-inline needs-validation" name="FormRicercaData" method="get"
                                action="http://localhost/Projectworkits/Ricerche/RicercaMovimenti3.php">
                                <div class="form-group mx-auto ">
                                    <label for="da" class="float-start">Da: </label>
                                    <input class="form-control" style="background-color:#dda74f; border:black"
                                        type="date" id="IDda" name="Datada">
                                </div> </br>
                                <div class="form-group mx-auto ">
                                    <label for="a" class="mr-sm-2"> A:</label>
                                    <input class="form-control" style="background-color:#dda74f; border:black"
                                        type="date" id="IDa" name="DataA">
                                </div>
                                <button class="btn btn-block text-warning" style="background-color:#070707;"
                                    type="submit">Cerca</button>

                                <?php

                                if (isset($_GET['Datada']) && isset($_GET["DataA"])) {

                                    $data1 = $_GET['Datada'];
                                    $data2 = $_GET['DataA'];
                                    $url = "http://localhost/Projectworkits/Ricerche/RicercaMovimenti3.php?DA=" . $data1 . "&A=" . $data2;


                                    if (empty($data1) == false) {
                                        header("Location: http://localhost/Projectworkits/Ricerche/RicercaMovimenti3.php");
                                    } else {

                                    }
                                }
                                ?>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-warning" href="#" id="navbardrop"
                            data-toggle="dropdown">
                            Servizi
                        </a>
                        <div class="dropdown-menu bg-warning">
                            <a class="dropdown-item"
                                href="http://localhost/Projectworkits/Servizi/RicaricaTelefonica.php">Ricarica
                                Telefonica</a>
                            <a class="dropdown-item"
                                href="http://localhost/Projectworkits/Servizi/bonifico.php">Bonifico</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container text-warning davide">
        <form action="" method="post" onsubmit="return Controllo()">
            <div>
                <h1>Modifica password</h1>
            </div>
            <div class="form-group w-75 centrare">
                <label for="password">Inserisci nuova password:</label><br>
                <input type="password" id="password" name="password" autocomplete="off"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="********" required style="background-color:#dda74f;">
            </div>
            <div class="form-group w-75 centrare">
                <label for="passwordConferma">Conferma password:</label><br>
                <input type="password" id="passwordConferma" name="passwordConferma" placeholder="********"
                    autocomplete="off" required style="background-color:#dda74f;">
            </div>
            <div>
                <p id="errore" class="alert alert-danger" role="alert"></p>
                <p id="info"class="alert alert-warning" role="alert"></p>
            </div>
            <div>
                <input type="submit" id="Invio" name="Invio" value="Cambia password" class="btn btn-default glow-button" style="background-color:#d4c03d;">
            </div>
        </form>
    </div>
    <div id="message">
        <h3 id="error">La password deve contenere i seguenti requisiti:</h3>
        <p id="letter" class="invalid">Una lettera <b>minuscola</b></p>
        <p id="capital" class="invalid">Una lettera <b>maiuscola</b></p>
        <p id="number" class="invalid">Un <b>numero</b></p>
        <p id="length" class="invalid">Minimo <b>8 caratteri</b>, massimo <b>20</b></p>
    </div>

</body>
<?php
if ($isok) {
    $conn = mysqli_connect("localhost", "root", "", "projectworkits");
    $queryUpdate = $conn->prepare("UPDATE tconticorrenti SET password=? WHERE email=?");
    //$mail="tomas.arnaldi@allievi.itsdigitalacademy.com";
    $mail = $_SESSION["logged_in"];
    $queryUpdate->bind_param("ss", $hash, $mail);

    if ($queryUpdate->execute()) {
        echo ("<script>document.getElementById('info').style.display='block';document.getElementById('info').innerHTML='';document.getElementById('info').innerHTML='Password cambiata con successo!';</script>");
    } else {
        echo ("<script>document.getElementById('errore').style.display='block';document.getElementById('errore').innerHTML='';document.getElementById('errore').innerHTML='Errore generico. Riprovare.';</script>");
    }
}

?>
<script>
    var myInput = document.getElementById("password");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
    // When the user clicks on the password field, show the message box
    myInput.onfocus = function () {
        document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function () {
        document.getElementById("message").style.display = "none";
    }
    // When the user starts to type something inside the password field
    myInput.onkeyup = function () {
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if (myInput.value.match(lowerCaseLetters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");

        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");

        }


        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if (myInput.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid");
            capital.classList.add("valid");

        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");

        }

        // Validate numbers
        var numbers = /[0-9]/g;
        if (myInput.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");

        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");

        }

        // Validate length
        if (myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
    }
    function Controllo() {
        let pass1 = document.getElementById("password").value;
        let pass2 = document.getElementById("passwordConferma").value;

        if (pass1 != pass2) {
            document.getElementById("errore").style.display = "block";
            document.getElementById("errore").innerHTML = "";
            document.getElementById("errore").innerHTML = "Le due password non coincidono!";
            return false;

        }


        if (pass1.length < 8) {
            document.getElementById("errore").style.display = "block";
            document.getElementById("errore").innerHTML = "";
            document.getElementById("errore").innerHTML = "La password deve avere almeno 8 caratteri!";
            return false;
        }

        //maximum length of password validation  
        if (pass1.length > 20) {
            document.getElementById("errore").style.display = "block";
            document.getElementById("errore").innerHTML = "";
            document.getElementById("errore").innerHTML = "La password deve avere al massimo 20 caratteri!";
            return false;
        }


        return true;
    }
</script>

</html>