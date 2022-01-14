<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fiche</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" >

</head>

<script>
    function searchPokemon(){
        var saisie = document.getElementById("searchText").value;
        xhr = new XMLHttpRequest();
        var select = document.getElementById("selectBar");
        var option = document.createElement('option');

        xhr.onreadystatechange = function(){
            if((xhr.readyState == 4) && (xhr.status == 200)){
                option.appendChild(document.createTextNode(xhr.responseText))
                option.value = xhr.responseText;
                select.appendChild(option);
            }
        };
        if(saisie.length >= 3){
            xhr.open("GET", "search.php?searchText="+saisie, true);
            xhr.send(null);
            select.removeChild(select.options[1]);
        }
    }

    function choosePokemon(){
        var select = document.getElementById("selectBar");
        var value = select.options[select.selectedIndex].value;
        window.location.replace("pokemonFiche.php?nom="+value);
    }
</script>

<nav class="navbar navbar-light" style="background-color: red; margin-bottom:  10px;" >
    <div class="container-fluid">
        <a class="navbar-brand" href="#" >Pokedex</a>
        <div class="d-flex">
            <input type="text" id="searchText" onkeyup="searchPokemon()">
            <select id="selectBar" onchange="choosePokemon()">
                <option value ="">Choisissez un pokémon</option>
            </select>
        </div>
    </div>
</nav>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <?php

include_once("../db.inc.php");

$db = new PDO($db_name, $user, $pass);

$sql = $db->prepare("SELECT imagePkmn FROM pokedex WHERE nom LIKE ?");

$sql->execute([$_GET['nom']]);

foreach ($sql as $ligne){
    $imagePkmn = $ligne['imagePkmn'];
    echo "<img src=\"artwork/".$imagePkmn."\" class=\"img-fluid\" >";

}
?>
        </div>
        <div class="col-8">
            <table class="table">

                <tbody>

<?php

include_once("../db.inc.php");

$db = new PDO($db_name, $user, $pass);

$sql = $db->prepare("SELECT * FROM pokedex WHERE nom LIKE ?");

$sql->execute([$_GET['nom']]);

foreach ($sql as $ligne){
    $numero = $ligne['numero'];
    echo "<tr>
                    <th scope=\"row\">Numéro Pokédex</th>
                    <td>".$numero."</td>";
    $nom = $ligne['nom'];
    echo "<tr>
                    <th scope=\"row\">Nom</th>
                    <td>".$nom."</td>";
    $type0 = $ligne['types0nom'];
    echo "<tr>
                    <th scope=\"row\">Type primaire</th>
                    <td>".$type0."</td>";
    $type0couleur = $ligne['types0couleur'];
    $type1 = $ligne['types1nom'];
    echo "<tr>
                    <th scope=\"row\">Type secondaire</th>
                    <td>".$type1."</td>";
    $type1couleur = $ligne['types1couleur'];
    $baseHP = $ligne['baseHP'];
    echo "<tr>
                    <th scope=\"row\">HP de base</th>
                    <td>".$baseHP."</td>";
    $baseAttack = $ligne['baseAttack'];
    echo "<tr>
                    <th scope=\"row\">Attaque de base</th>
                    <td>".$baseAttack."</td>";
    $baseDefense = $ligne['baseDefense'];
    echo "<tr>
                    <th scope=\"row\">Defense de base</th>
                    <td>".$baseDefense."</td>";
    $baseSpAttack = $ligne['baseSpAttack'];
    echo "<tr>
                    <th scope=\"row\">Attaque Spéciale de base</th>
                    <td>".$baseSpAttack."</td>";
    $baseSpDefense = $ligne['baseSpDefense'];
    echo "<tr>
                    <th scope=\"row\">Défense Spéciale de base</th>
                    <td>".$baseSpDefense."</td>";
    $baseSpeed = $ligne['baseSpeed'];
    echo "<tr>
                    <th scope=\"row\">Vitesse de base</th>
                    <td>".$baseSpeed."</td>";
    $total = $ligne['total'];
    echo "<tr>
                    <th scope=\"row\">Total</th>
                    <td>".$total."</td>";
    $moyenne = $ligne['moyenne'];
    echo "<tr>
                    <th scope=\"row\">Moyenne</th>
                    <td>".$moyenne."</td>";
}

?>
                </tbody>
            </table>
        </div>

    </div>

</div>





</body>
</html>
