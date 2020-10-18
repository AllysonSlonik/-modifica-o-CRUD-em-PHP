<!doctype html>
<html lang="en">
  <head>
    <title>Registrar Autos</title>

    <!--Stylesheet-->
    <link rel="stylesheet" href="styles.css">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

  <div id="formContainer" class="container-fluid">
    <div id="formContainerItems">
      <h1 id="textoRegistrar">REGISTRE SEU VEÍCULO</h1>

  <form action="" method="POST">
    <div class="form-group">
      <input type="text" id="marca" name="marca" class="form-control" placeholder="Digite a Marca" required>
    </div>
    <div class="form-group">
      <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Digite o Modelo" required>
    </div>
    <div class="form-group">
      <input type="text" id="cor" name="cor" class="form-control" placeholder="Digite a Cor" required>
    </div>
    <div class="form-group">
      <input type="text" id="ano" name="ano" class="form-control" placeholder="Digite o Ano" required>
    </div>
    <div class="form-group">
      <input type="text" id="placa" name="placa" class="form-control" placeholder="Digite a Placa" required>
    </div>
      <button type="submit" id="btnEnviar" name="btnEnviar" class="btn btn-info" required>Registrar!</button>
  </form>
      </div>
  </div>

  <!--TABELA-->

  <div id="checarTabela" class="container-fluid">
    <div id="tudoTabela">
      <h1 id="textoChecar">CHECAR VEÍCULOS</h1>

      <table class="table table-bordered table-dark">
        <thread>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Marca</th>
            <th scope="col">Modelo</th>
            <th scope="col">Cor</th>
            <th scope="col">Ano</th>
            <th scope="col">Placa</th>
            <th scope="col">Atualizar</th>
            <th scope="col">Deletar</th>
          </tr>
        </thread>
      

    </div>
  </div>

  <?php

    $conexao = mysqli_connect("localhost","root","root","userregistration");

    if(mysqli_connect_errno()){
      echo "Conexão falhou " . mysqli_connect_errno();
    }

    if(isset($_POST['btnEnviar'])){
      
      $marca = $_POST['marca'];
      $modelo = $_POST['modelo'];
      $cor = $_POST['cor'];
      $ano = $_POST['ano'];
      $placa = $_POST['placa'];
 
      $query = "insert into vehicles(marca, modelo, cor, ano, placa) values ('$marca','$modelo', '$cor','$ano','$placa')";
      $inserir_query = mysqli_query($conexao, $query);

      if($inserir_query){
      header("location: confirmation.php");
      exit;
      }
    }
?>

<?php

    $conectar = mysqli_connect("localhost", "root", "root", "userregistration");
    //EDIT DATA FROM TABLE
    if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $get_car = " select * from vehicles where id='$edit_id'";
      $query_get_car_element = mysqli_query($conectar, $get_car);

      $query_get_car = mysqli_fetch_array($query_get_car_element);

        $id_qcar = $query_get_car['id'];
        $marca_qcar = $query_get_car['marca'];
        $modelo_qcar = $query_get_car['modelo'];
        $cor_qcar = $query_get_car['cor'];
        $ano_qcar = $query_get_car['ano'];
        $placa_qcar = $query_get_car['placa'];

        echo "
        
        <form action='' method='POST'>
          <input type='text' name='u_marca' value='$marca_qcar'/>
          <input type='text' name='u_modelo' value='$modelo_qcar'/>
          <input type='text' name='u_cor' value='$cor_qcar'/>
          <input type='text' name='u_ano' value='$ano_qcar'/>
          <input type='text' name='u_placa' value='$placa_qcar'/>
          <input type='submit' id='atualizar' name='atualizar' value='Atualizar Dados'/>
        </form>

        ";
    }

    if(isset($_POST['atualizar'])){

      $update_id = $id_qcar;

      $carMarca = $_POST['u_marca'];
      $carModelo = $_POST['u_modelo'];
      $carCor = $_POST['u_cor'];
      $carAno = $_POST['u_ano'];
      $carPlaca = $_POST['u_placa'];

      $update_car = "update vehicles set marca='$carMarca', modelo='$carModelo', cor='$carCor', ano='$carAno', placa='$carPlaca' where id='$update_id'";

      $run_car = mysqli_query($conectar, $update_car);

      if($run_car){
        header("location: confirmation.php");
        exit;
      }
    }

  ?>

  <?php

    $con = mysqli_connect("localhost","root","root","userregistration");
    
    $selecionar_query = "select * from vehicles ORDER BY 1 ASC";
    $inserir_novo = mysqli_query($con, $selecionar_query);

    while($row = mysqli_fetch_array($inserir_novo)){
      $car_id = $row['id'];
      $car_modelo = $row['modelo'];
      $car_marca = $row['marca'];
      $car_ano = $row['ano'];
      $car_cor = $row['cor'];
      $car_placa = $row['placa'];

      echo "
      
      <tr>
        <td>$car_id</td>
        <td>$car_marca</td>
        <td>$car_modelo</td>
        <td>$car_cor</td>
        <td>$car_ano</td>
        <td>$car_placa</td>
        <td><a href='index.php?edit=$car_id'>Atualizar</td>
        <td><a href='index.php?del=$car_id'>Deletar</a></td>
      </tr>
      
      ";
    }
    echo "</table>";
     
    //DELETE USERS FROM TABLE
    if(isset($_GET['del'])){
      $del_car = $_GET['del'];

      $delete_query = "delete from vehicles where id='$car_id'";

      $delete_car = mysqli_query($con, $delete_query);

      if($delete_car){
        header("location: confirmation.php");
        exit;
      }
     
    }    


  ?>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>