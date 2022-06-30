<?php
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
  $sql = "SELECT 
              *
          FROM
              tb_livros
          WHERE
              ativo = 1
            ";

  // prepara a execução da query sql acima
  $comando = $conexao->prepare($sql);

  // executa a query preparada acima
  $comando->execute();

  // essa linha ira tratar os dados do retorno do SELECT executando no banco de dados, somente é usada nesse caso, em INSERT, UPDATE,DELETE, não tem necessidade    
  $resposta = $comando->fetchAll(PDO::FETCH_ASSOC);

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