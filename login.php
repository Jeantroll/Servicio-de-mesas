<?php
    include_once 'db.php';

    session_start();

    if(isset($_GET['cerrar_sesion'])){
        session_unset();

        session_destroy();
    }

    if(isset($_SESSION['rol'])){
        switch($_SESSION['rol']){
            case 1:
                header('location: admin.php');
            break;

            case 2:
            header('location: colab.php');
            break;

            default:
        }
    }

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new Database();
        $query = $db->connect()->prepare('SELECT*FROM usuarios WHERE username = :username AND pasword = :password');
        $query->execute(['username' => $username, 'password' => $password]);

        $row = $query->fetch(PDO::FETCH_NUM);
        if($row == true){
            // validar rol
            $rol = $row[3];
            $_SESSION['rol'] = $rol;

            switch($_SESSION['rol']){
                case 1:
                    header('location: admin.php');
                break;
    
                case 2:
                header('location: colab.php');
                break;
    
                default:
            }
        }else{
            // no existe el usuario
            echo "El usuario o contraseña son incorrectos";
        }

    }
    

?>
<!DOCTYPE html>
<html lang="en" style="
    
    background: #212529;
">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="estilos1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>
<body style="
    background: #212529;
">

<main class="container my-5"style="
    background: #212529;
">
  <div class="row">
    <section class="col-md-6 my-5 offset-md-3">

      <div class="card shadow p-5">
        <form method="POST" action="#">

          <h3 class="text-center text-uppercase mb-4" style="
    color: white;
">Ingresar</h3>
          <hr>

          <div class="form-group" style="
    margin-right: 20px;
    margin-bottom: 20px;
    margin-left: 20px;
    margin-top: 20px;
">
            <label style="
    color: white;
">Usuario</label>
            <input type="text" name="username" placeholder="Usuario" class="form-control">
          </div>

          <label style="
    color: white;
    margin-left: 20px;

" for="Password">Contraseña</label>
          <div class="input-group mb-3" style="
    margin-left: 20px;
    margin-bottom: 20px;
    margin-right: 20px;
">
            <input type="password" name="password" id="password" class="form-control" placeholder="Ingresa contraseña" aria-label="Enter Password" aria-describedby="basic-addon2">
            <div class="input-group-append">
            </div>
          </div>

          <button class="btn btn-block btn-secondary rounded-pill mt-3" type="submit" style="
    margin-left: 20px;
    margin-bottom: 20px;
    margin-right: 20px;
">Entrar</button>

          <p class="mt-3 text-white">No tienes una cuenta? <a href="Registrar.php" class="text-white"> Create una</a></p>

        </form>
      </div>
    </section>
  </div>
</main>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>
</html>