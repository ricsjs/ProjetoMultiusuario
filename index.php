<?php

  include("config.php");

  if(isset($_POST['entrar'])){
    $user = $_POST['usuario'];
    $pass = $_POST['senha'];

    if(empty($user) or empty($pass)){
      //imprime essa mensagem caso estejam vazios
			$_SESSION['msg'] = "<h6 style='color: red'>Preencha todos os campos!</h6>";
    }else{
      //consulta e resultado da consulta do db
      $sql = "SELECT usu_nome FROM usuarios WHERE usu_nome = '$user'";
			$resultado = mysqli_query($conn, $sql);
      if (mysqli_num_rows($resultado)>0) {
        $sql = "SELECT * FROM usuarios WHERE usu_nome = '$user' AND usu_senha = '$pass'";
        $resultado = mysqli_query($conn, $sql);
        //se a quantidade de linhas for igual a 1 significa que temos um registo de login, então será feita a autenticação e o usuário será redirecionado para a pagina principal
        if(mysqli_num_rows($resultado) == 1){
          $dados = mysqli_fetch_array($resultado);
          if($dados[1] == 1){
            $_SESSION['logado'] = true;
            $_SESSION['codigo_usuario'] = $dados['usu_cod'];
            header('Location: telaMaster.php');
          }else{
            $_SESSION['logado'] = true;
            $_SESSION['codigo_usuario'] = $dados['usu_cod'];
            header('Location: telaCliente.php');
          }
        //mensagem de erro dizendo usuário inválido
        }else{
          $_SESSION['msg2'] = "<h6 style='color: red'>Usuário inválido!</h6>";
        }
      }else{
        $_SESSION['msg3'] = "<h6 style='color: red'>Usuário inválido!</h6>";
      }
    }

  }

?>

<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style.css">

        <title>Projeto Multiusuáro</title>
    </head>

    <body>

        <div id="container_login" class="container">
            <div id="image_people" class="container">
                <img src="images/people_login.png" width="80px" height="80px">
            </div>
            
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="form_login">
                <div class="mb-3">
                <?php 
                  //verificando se há uma sessao chamada "msg"
                  if(isset($_SESSION['msg'])){
                    //impressao do conteudo da sessao
                    echo $_SESSION['msg'];
                    //destruição da sessao
                    unset($_SESSION['msg']);
                  }
                  //verificando se ha uma sessao chamada "msg2"
                  if(isset($_SESSION['msg2'])){
                    //imprimindo conteudo da sessao
                    echo $_SESSION['msg2'];
                    //destruição da sessao
                    unset($_SESSION['msg2']);
                  }
                  //verificando se uma uma sessao chamada "msg3"
                  if(isset($_SESSION['msg3'])){
                    //impressao do conteudo da sessao
                    echo $_SESSION['msg3'];
                    //destruição da sessao
                    unset($_SESSION['msg3']);
                  }
                ?>
                  <label for="exampleInputEmail1" class="form-label">E-mail ou usuário: </label>
                  <input name="usuario" type="text" class="form-control input_login" id="inputEmail" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Senha: </label>
                  <input name="senha" type="password" class="form-control input_login" id="imputPassword">
                </div>
                <p>Ainda não tem uma conta? <a href="#">Cadastre-se</a></p>
                <button name="entrar" type="submit" class="btn btn-primary">Entrar</button>
              </form>

        </div>

        

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>

</html>