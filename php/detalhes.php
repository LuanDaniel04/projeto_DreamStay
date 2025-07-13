<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detalhes do Hotel</title>
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

    <h2>Detalhes do Hotel</h2>

    <img src="<?php echo $row['imagem']; ?>" alt="Imagem do hotel" style="height: 300px"/>

    <h3><?php echo $row['nome']; ?></h3>
    <p>Localização:<?php echo $row['localizacao']; ?></p>
    <p>Preço: R$ <?php echo $row['preco']; ?></p>
    <p>Avaliação: <?php echo $row['avaliacao']; ?></p>

    <form action="delete.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
        <input type="submit" value="Deletar" />
    </form>

    <form action="editar.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
        <input type="submit" value="Editar" />
    </form>

</body>
</html>
