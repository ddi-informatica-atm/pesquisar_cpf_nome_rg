<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar</title>

    <style>

        form{
            text-align:center;
            font-size: 25px;
        }
        input{
            padding: 12px;
            font-size: 20px;;
        }
    </style>
    
</head>
<body>
<form method="POST">
<label for="pesquisar">Digite: Nome,CPF, ou RG</label>
<input type="text" name="pesquisar" requirid>
<input type="submit" value="OK">
</form>
<hr>

<table>
<div class="php">
<?php
$con = new PDO("mysql:host=localhost;dbname=cadastro","root","123456");

if($_SERVER['REQUEST_METHOD']=='POST'){
    $pesquisar = $_POST['pesquisar'];
    $buscar ="%".$pesquisar."%";

$sql="SELECT * FROM pessoa where nome LIKE ? or cpf LIKE ? or rg LIKE ?";    
$stmt = $con->prepare($sql);
$stmt->bindParam(1, $buscar, PDO::PARAM_STR);
$stmt->bindParam(2, $buscar, PDO::PARAM_STR);
$stmt->bindParam(3, $buscar, PDO::PARAM_STR);
$stmt->execute();
$rows=$stmt->rowCount();
if($rows==0){
echo "Nenhum registro encontrado!";
exit();
}else{

echo "<th>NOME:</th><th>CPF:</th><th>RG:</th>";

while($dados = $stmt->fetch()){

        echo "<tr>";
        echo "<td>".$nome=$dados['nome']."</td>";
        echo "<td>".$cpf=$dados['cpf']."</td>";;
        echo "<td>".$rg=$dados['rg']."</td>";;
    echo "</tr>";
}
}
}

?>

</table>

</div>
</body>
</html>