<?php
// Exibe todas as variáveis enviadas via POST ao PHP
// var_dump($_POST);

// Criar uma variável PHP
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$categoria = $_POST['categoria'];
$valor = $_POST['valor'];

// Para visualizar no response
//echo $titulo;
//echo "<br>";
//echo $autor;
//echo "<br>";

// conexão com banco de dados
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$bancodados = 'db_livraria';

try {
  // Definindo as configurações de conexão com o banco de dados
  $conexao = new PDO("mysql:host=$servidor;dbname=$bancodados;charset=utf8", $usuario, $senha);

  // seta o modo de erro do PDO para exception
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // querry(comando) de inserção de dados no DB MySQL
  $sql = "INSERT into 
          tb_livros
            (titulo,autor,id_categorias,valor)
          VALUES
            ('$titulo','$autor',$categoria,$valor)";

  // prepara a execução da query sql acima
  $comando = $conexao->prepare($sql);

  // executa a query preparada acima
  $comando->execute();

  // criar um array para resposta ao usuário
  $resposta = array("Resposta" => "OK", "Mensagem" => "Cadastro realizado com sucesso!");

} catch (PDOException $e) {
  // aqui é tratado o erro e retornado ao usuário
  $resposta = array("Resposta" => "Erro", "Mensagem" => $e->getMessage());
  
}

// converte o array resposta em JSON
// JSON_UNESCAPED_UNICODE = Manter o arquivo com mapa de caracter padrão
$json = json_encode($resposta, JSON_UNESCAPED_UNICODE);

// retorna o json convertido;
echo $json;

// final da conexão
?>