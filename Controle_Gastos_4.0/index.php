<?php session_start() ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--- Pdf maker -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
        <!-- bootstarp 5 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Meu CSS -->
        <link rel="stylesheet" href="css/styles.css">

        <!-- Include Chart.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

<title>Controle de despesas</title>
</head>
<body>
<?php
        if(!isset($_SESSION['login'])){
            if(isset($_POST['login'])){
                $username = $_POST['username'];
                $password = $_POST['password'];

                if($username == 'admin' && $password == '1234'){
                    $_SESSION['login'] = true;
                    echo '<script>window.location.href = "index.php";</script>';
                }else{
                    echo '  <div class="alert alert-danger alert-dismissible fade show" role="alert" >
                            <strong>Erro!</strong> usuario ou senha incorreto.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    ';
                    
                }
            }

            include("php/login/login.php");
        }else{
            if(isset($_GET['logout'])){
                unset($_SESSION['login']);
                session_destroy();
                echo '<script>window.location.href = "index.php";</script>';
            }
            include("php/home.php");
        }
?>
</body>
</html>