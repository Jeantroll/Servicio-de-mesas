<?php
    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: login.php');
    }else{
        if($_SESSION['rol'] != 1){
            header('location: login.php');
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilos2.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    
    <title>Admin</title>
  </head>
  <body>
  <div class="header">
  <a href="#" id="menu-action">
    <i class="fa fa-bars"></i>
    <span>Close</span>
  </a>
  <div class="logo">
    Panel de Administrador
  </div>
</div>
<div class="sidebar">
  <ul>
    <li><a href="#"><i class="fa fa-desktop"></i><span>Desktop</span></a></li>
    <li><a href="#"><i class="fa fa-server"></i><span>Server</span></a></li>
    <li><a href="#"><i class="fa fa-calendar"></i><span>Calendar</span></a></li>
    <li><a href="#"><i class="fa fa-envelope-o"></i><span>Messages</span></a></li>
    <li><a href="login.php?cerrar_sesion=1"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Salir</span></a></li>
    </ul>
</div>
   
<!-- Content -->
<div class="main">
  <div class="">
    <div class="jumbotron">
      <h1>Hola Administrador!<a class="anchorjs-link" href="#hello,-world!"><span class="anchorjs-icon"></span></a></h1>
      <p>Aqui puedes visualizar, editar y tomar los pedidos de los clientes y ver el uso de las mesas. <br>Para mas información puedes visitar nuestra documentación, con un PDF que relata a fondo nuestra pagina web con panel de administrador </p>    
      <p><button type="button" class="btn btn-dark">Documentación</button></p>
    </div>
    <div class="bs-callout bs-callout-danger" style="margin-bottom: 80px;">
  <h4>Posible error!</h4>
    Si algo malo pasa con la pagina de administrador. <br>
    Puedes contactar al desarrollador Jean Pool R, desdes su correo electronico personal. Jean.seiya@hotmail.com
    </div>
   <center> <h1 style="color: white;     margin-bottom: 20px;">Las personas que han pedido una solicitud</h1></center>
    
    <?php 
    $conex=mysqli_connect('localhost', 'root', '', 'mesas')
    ?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre de la Mesa solicitada</th>
          <th>Cliente que solicitó la mesa</th>
          <th>Editar pedido</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        

        $sql="SELECT*from solicitud";
        $result=mysqli_query($conex,$sql);
        while ($mostrar=mysqli_fetch_array($result)) {
        ?>
        
        <tr>
          <th scope="row"><?php echo $mostrar['id']; ?></th>
          <td><?php echo $mostrar['nombre_mesa']; ?></td>
          <td><?php echo $mostrar['nombre_cliente']; ?></td>
          <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">Editar</button> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Eliminar</button></td>
        </tr>
    
        <?php 
        }
  
        ?>
      </tbody>
    </table>

  </div>
  
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Escribe el numero del pedido que desees eliminar </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     <form method="POST" action="#">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Numero que desea eliminar</label>
    <input type="number" class="form-control"name="id">
    <div class="form-text">Aquí puedes poner el numero del pedido que deseas eliminar. EJ(Si deseas eliminar la primera solicitud, solo debes pones 1 y así con el resto.).</div>
  </div>
  <center>
  <button type="submit" class="btn btn-primary">Confirmar e eliminar</button>
  </Center>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        
<?php
if(isset($_POST['id']) ){
  $id = $_POST['id'];
  
  
  $sql = "DELETE FROM solicitud WHERE id = $id";
  $resultado = mysqli_query($conex,$sql);
  
}


?>





<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar los datos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="#">
      <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">ID que deseas cambiar</label>
    <input type="number" class="form-control"name="IDc">
    <div class="form-text">Necesitamos saber que id usted desea cambiar ej.(1, 2, 3...).</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">El nuevo Nombre de la mesa</label>
    <input type="text" class="form-control"name="nombreMC">
    <div class="form-text">Necesitamos saber que nombre de mesa usted desea cambiar ej.(Mesa 1, Mesa 2...).</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Inserte el nuevo nombre del cliente</label>
    <input type="text" class="form-control" name="nombreUC">
  </div>
  <center>
  <button type="submit" class="btn btn-primary">Solicitar</button>
  </Center>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<?php 
if(isset($_POST['IDc']) && isset($_POST['nombreMC']) && isset($_POST['nombreUC']) ){
  $idc = $_POST['IDc'];
  $nombremc = $_POST['nombreMC'];
  $nombreuc = $_POST['nombreUC'];
  
  
  $sql2 = "UPDATE `solicitud` SET `nombre_mesa` = '$nombremc', `nombre_cliente` = '$nombreuc' WHERE `solicitud`.`id` = $idc";
 

  $resultado = mysqli_query($conex,$sql2);
  
}



?>


    <script src="newmenu.js"></script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>