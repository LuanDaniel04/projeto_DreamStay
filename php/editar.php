<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Editar Hotel</title>
</head>
<body>

<?php
include_once("config.php");
$id = $_POST['id'];
$sql = "SELECT * FROM anuncios WHERE id = '" . $id . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
mysqli_close($conn);
?>

<h2>Editar Hotel</h2>

<form action="update.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />

  <label for="nome">Nome:</label><br />
  <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>" /><br /><br />

  <label for="localizacao">Localização:</label><br />
  <input type="text" id="localizacao" name="localizacao" value="<?php echo htmlspecialchars($row['localizacao']); ?>" /><br /><br />

  <label for="preco">Preço:</label><br />
  <input type="number" step="0.01" id="preco" name="preco" value="<?php echo htmlspecialchars($row['preco']); ?>" /><br /><br />

  <label for="avaliacao">Avaliação:</label><br />
  <input type="text" id="avaliacao" name="avaliacao" value="<?php echo htmlspecialchars($row['avaliacao']); ?>" /><br /><br />

  <label for="imagem">Imagem:</label><br />
  <input type="file" id="imagem" name="imagem" /><br /><br />

  <input type="submit" value="Salvar Alterações" />
</form>

</body>
</html>
