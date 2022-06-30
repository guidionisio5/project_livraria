// Criar uma Funçãp em JavaScript
// Formato ES6 baseado em Arrow Function

// Função que realiza o cadastro de livros
const cadastrar = () => {
    // declara a variavel titulo e captura o valor preenchido do usuario 
    let titulo = document.getElementById('titulo').value
    // declara a variavel autor e captura o valor preenchido do usuario 
    let autor = document.getElementById('autor').value
    // declara a variavel categoria e captura o valor preenchido do usuario 
    let categoria = document.getElementById('categoria').value
    // declara a variavel valor e captura o valor preenchido do usuario 
    let valor = document.getElementById('valor').value

    // verifica se a variável título está vazia
    // se verdadeiro(iestiver sem peencher) irá exibir em alerta
    if (titulo == '') {
        alert('Coloque o título do livro')
        return
    }

    // verifica se a variável autor está vazia
    // se verdadeiro(iestiver sem peencher) irá exibir em alerta
    if (autor == '') {
        alert('Coloque o nome do autor do livro')
        return
    }

    // verifica se a variável categoria está vazia
    // se verdadeiro(iestiver sem peencher) irá exibir em alerta
    if (categoria == '') {
        alert('Escolha uma categoria')
        return
    }

    // verifica se a variável valor está vazia
    // se verdadeiro(iestiver sem peencher) irá exibir em alerta
    if (valor == '') {
        alert('Coloque um valor')
        return
    }

    // envio dos dados usando fetch ao backend
    fetch('backend/cadastrar_livro.php', {
        method: 'POST',
        body: `titulo=${titulo}&autor=${autor}&categoria=${categoria}&valor=${valor}`,
        headers: {
            'Content-type': 'application/x-www-form-urlencoded'
        }
    })

        .then(function (response) {
            response.json().then(resposta => {
                // aqui é onde iremos receber e tratar a resposta ao PHP
                if (resposta.Resposta == 'OK') {
                    Swal.fire(
                        'Atenção!',
                        resposta.Mensagem,
                        // outra maneira de fazer if e else: resposta.Resposta == "OK" ? 'success' : 'error'
                        'success'
                    )
                } else {
                    Swal.fire(
                        'Atenção!',
                        resposta.Mensagem,
                        'error'
                    )
                }
                // resetar o Formulário - Limpar os campos
                document.getElementById('form-cadastrar').reset()
            })

        })

}
// final da função cadastrar

// inicio da função listar
const listar = () =>{
    fetch('backend/listar-livro.php',)
    .then(response => response.json())
    .then(resposta =>{
        // Aqui será manipulado o HTML com os dados retonados pelo PHP em formato JSON
        // O JS monta o HTML de forma dimânica, atráves de um laço(repetição)

        // Limpa a div que irá armazenar a lista de livros
        document.getElementById('lista-livros-grid').innerHTML = ``

        for(let cont = 0;cont < resposta.length;cont++){
            document.getElementById('lista-livros-grid').innerHTML += 
            `
            
            <figure>
                <img class="livros-img" src="img/livro-faltando.png" alt="Imagem do livro">
                <figcaption>
                    <h4>${resposta[cont]['titulo']}</h4>
                    <h6>${resposta[cont]['autor']}</h6>
                    <small>${resposta[cont]['id_categorias']}</small>
                    <h5>R$ ${resposta[cont]['valor']}</h5>
                    <button class="comprar">Comprar</button>
                </figcaption>
            </figure>

            `

        }

    })

}
// final da função listar