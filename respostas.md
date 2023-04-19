Respostas:

1. No contexto da programação orientada a objetos, explique o que é uma "interface". Como o que aparece no código do artigo:

Em programação orientada a objetos, uma interface é um conjunto de métodos abstratos, ou seja, métodos que não têm implementação concreta que definem um conjunto de comportamentos que uma classe deve fornecer.
Em outras palavras, uma interface é um contrato que uma classe deve cumprir se ela implementa essa interface. Uma classe que implementa uma interface deve fornecer uma implementação concreta para cada método abstrato definido pela interface.
Isso permite que várias classes diferentes forneçam implementações diferentes para o mesmo conjunto de comportamentos, mas ainda possam ser usadas de maneira intercambiável, desde que implementem a mesma interface.

2. O que são "traits" no PHP?

Traits em PHP são mecanismos de reutilização de código que permitem a inclusão de um conjunto de métodos em uma classe, sem a necessidade de criar uma hierarquia de classes.
Em outras palavras, um trait é uma coleção de métodos que podem ser incluídos em uma classe para fornecer comportamentos adicionais a essa classe. Quando uma classe usa um trait, ela herda todos os métodos desse trait, e pode usar esses métodos como se eles fossem seus próprios métodos.

3. No código aparece o método "bindValue" do PDO para definir o valor que será utilizado na execução da instrução SQL. No PDO, também existe o método "bindParam". Qual(is) a(s) diferença(s) entre eles?

Ambos os métodos bindValue e bindParam são usados no PDO para associar valores a parâmetros de uma consulta SQL preparada. A principal diferença entre eles é a forma como esses valores são passados.
O método bindValue define o valor de um parâmetro diretamente como um valor literal. Ou seja, ele associa um valor a um parâmetro na consulta preparada naquele momento em que o método é invocado. O valor é passado como um parâmetro para o método bindValue.
Já o método bindParam associa um parâmetro a uma variável. Ou seja, ele não define diretamente o valor do parâmetro, mas sim uma referência a uma variável que contém o valor. Isso significa que, se o valor da variável for alterado após a associação, o valor do parâmetro na consulta preparada também será alterado.
Em resumo, a principal diferença entre bindValue e bindParam é que o primeiro define o valor do parâmetro diretamente, enquanto o segundo associa o parâmetro a uma variável que pode ter seu valor alterado posteriormente. 

4. No código é utilizada função "__autoload()" que foi descontinuada ("deprecated") no PHP desde a versão 7.2.0 e foi removida no PHP 8.0.0. Reescreva o código para efetuar o autoload de classes na versão atual do PHP.

Defina uma função que irá carregar a classe, se ela ainda não foi carregada. Esta função deve receber o nome da classe como parâmetro:

function carregarClasse($nomeClasse) {
    // Transforma o nome da classe em um caminho de arquivo
    $caminho = str_replace('\\', DIRECTORY_SEPARATOR, $nomeClasse) . '.php';
    // Verifica se o arquivo da classe existe
    if (file_exists($caminho)) {
        // Carrega o arquivo
        require_once $caminho;
    }
}

Registre a função de carregamento de classes com a função spl_autoload_register(). Você pode registrar várias funções de carregamento, que serão chamadas em ordem até que a classe seja encontrada. Por exemplo:
spl_autoload_register('carregarClasse');

Quando uma classe for usada em seu código, o PHP irá verificar se ela já foi carregada. Se a classe ainda não tiver sido carregada, a função carregarClasse() será chamada para carregá-la. Você pode então usar a classe normalmente:

$exemplo = new Exemplo();

Com esses passos, o autoload de classes será efetuado corretamente na versão atual do PHP, sem o uso da função __autoload() descontinuada.

5. Na tabela "contatos" a coluna "id" tem auto-incremento. Entretanto, o código implementado busca o próximo valor de "id" a ser inserido usando um "SELECT MAX(ID) AS ID FROM {$this->tabela}". Reescreva o método que faz INSERT para usar o recurso de auto-incremento do banco de dados.

Para utilizar o recurso de auto-incremento do banco de dados ao inserir um novo registro na tabela, basta não incluir a coluna id na lista de colunas do comando INSERT. O banco de dados irá gerar automaticamente um novo valor para a coluna id.
Além disso, é recomendado que se utilize a extensão PDO para realizar a inserção de dados, pois ela fornece suporte ao recurso de auto-incremento.
Com base nessas informações, o método que realiza o INSERT pode ser reescrito da seguinte forma:

public function inserir($dados) {
    // Monta a lista de colunas e valores para o comando INSERT
    $colunas = implode(',', array_keys($dados));
    $valores = implode(',', array_fill(0, count($dados), '?'));

    // Monta o comando INSERT
    $sql = "INSERT INTO {$this->tabela} ({$colunas}) VALUES ({$valores})";

    // Prepara o comando para execução
    $stmt = $this->conexao->prepare($sql);

    // Executa o comando, passando os valores a serem inseridos como parâmetros
    $stmt->execute(array_values($dados));

    // Retorna o ID do registro inserido
    return $this->conexao->lastInsertId();
}

Nessa versão do método, não é necessário buscar o próximo valor de id a ser inserido na tabela, pois o banco de dados irá gerar automaticamente esse valor. Depois de executar o comando INSERT, o método lastInsertId() é chamado para obter o valor gerado pelo banco de dados. Esse valor é então retornado pelo método.

6. Implemente o código para criar as telas para que um usuário possa realizar as operações de consulta (select), inserção (insert), alteração (update) e exclusão (delete).

Tela de Consulta (select):

<!DOCTYPE html>
<html>
<head>
	<title>Consulta de Contatos</title>
</head>
<body>
	<h1>Consulta de Contatos</h1>

	<?php
	// Conexão com o banco de dados
	$pdo = new PDO('mysql:host=localhost;dbname=meu_banco_de_dados', 'usuario', 'senha');

	// Consulta todos os registros da tabela de contatos
	$stmt = $pdo->query('SELECT * FROM contatos');

	// Exibe os resultados em uma tabela HTML
	echo '<table>';
	echo '<tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th></tr>';
	while ($contato = $stmt->fetch(PDO::FETCH_ASSOC)) {
		echo "<tr><td>{$contato['id']}</td><td>{$contato['nome']}</td><td>{$contato['email']}</td><td>{$contato['telefone']}</td></tr>";
	}
	echo '</table>';
	?>
</body>
</html>

Tela de Inserção (insert):

<!DOCTYPE html>
<html>
<head>
	<title>Inserção de Contato</title>
</head>
<body>
	<h1>Inserção de Contato</h1>

	<form method="POST" action="inserir_contato.php">
		<label for="nome">Nome:</label>
		<input type="text" id="nome" name="nome" required>

		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required>

		<label for="telefone">Telefone:</label>
		<input type="text" id="telefone" name="telefone" required>

		<button type="submit">Inserir</button>
	</form>
</body>
</html>

Tela de Alteração (update):

<!DOCTYPE html>
<html>
<head>
	<title>Alteração de Contato</title>
</head>
<body>
	<h1>Alteração de Contato</h1>

	<?php
	// Conexão com o banco de dados
	$pdo = new PDO('mysql:host=localhost;dbname=meu_banco_de_dados', 'usuario', 'senha');

	// Obtém o ID do contato a ser editado
	$id = $_GET['id'];

	// Busca os dados do contato no banco de dados
	$stmt = $pdo->prepare('SELECT * FROM contatos WHERE id = :id');
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	$contato = $stmt->fetch(PDO::FETCH_ASSOC);
	?>

	<form method="POST" action="editar_contato.php">
		<input type="hidden" name="id" value="<?php echo $contato['id']; ?>">

		<label for="nome">Nome:</label>
		<input type="text" id="nome" name="nome" value="<?php echo $contato['nome']; ?>" required>

		<label for="email">Email:</label>
		<input type="email" id="email" name="email" value="<?php echo $contato['email']; ?>" required>

		<label for="telefone">Telefone:</label>
		<input type="text" id="telefone" name="telefone" value="<?php echo $contato
