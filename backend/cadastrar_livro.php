<?php
// Exibe todas as variáveis enviadas via POST ao PHP
// var_dump($_POST);

// Criar uma variável PHP
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$categoria = $_POST['categoria']
$valor = $POST['valor'];

// Para visualizar no response
//echo $titulo;
//echo "<br>";

//echo $autor;
//echo "<br>";

// conexão com banco de dados
    $servidor = 'localhost';
    $usuario = 'root';
    $senha = '';

    try {
        $conexao = new PDO("mysql:host=$servidor;dbname=myDB", $usuario, $senha);
        // set the PDO error mode to exception
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }

// final da conexão
?>