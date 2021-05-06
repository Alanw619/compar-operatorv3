<?php
session_start();
include('../process/db.php');
include('../process/autoload.php');

$manager = new Manager($db);

$locations = $manager->getEverything();
$listeOperateur = $manager->getAllOperator();


echo '<strong>Liste des Destinations : </strong>
<br>
<br>';

foreach ($locations as $everything) {

    echo "<div>
    <strong>Offer n°" . $everything['destination']->getId() . ' </strong>: ' . ucfirst($everything['destination']->getLocation()) . ' / ' . ucfirst($everything['destination']->getPrice()) . " € / " . $everything['operator']->getName() . " 
    <br>
    Delete : <a style='text-decoration:none;' href='deleteDestination.php?id=" . $everything['destination']->getId() . "'> ❎</a>
    </div>
    <br>";

}

?>

<br>
<form action="addDestination.php" method="post">

    <p>
        Destination : <input type="text" name="location" maxlength="50" required>
        Price : <input type="text" name="price" required>

        Tour Operator : <select name="id_tour_operator" id="">
            <?php foreach ($listeOperateur as $opId) {

                echo "<option value='" . $opId->getId() . "'>" . $opId->getName() . "</option>";
            } ?>
        </select>

        Image (URL required): <input type="text" name="image" maxlength="255" required>

        <br><br>

        <input type="submit" value="Create Destination" name="send">

    </p>

</form>

<?php


echo '<br><br><hr><br><br>';

echo '<strong>Liste des Operateurs : </strong><br><br>';

foreach ($listeOperateur as $operateur) {

    if ($operateur->getIsPremium() === 1) {


        echo "<p><h3>👑 " . ucfirst($operateur->getName()) . 
        "<a style='text-decoration:none;' href='deleteOperateur.php?id=".$operateur->getId()."'> ❎</a></h3>
        <form action='upgradePremium.php' method='post'>

            <input name='id_tour_operator' type='hidden' value='".$operateur->getId()."'>

            Premium : <select name='is_premium'id=''>
                <option value='1'>Oui</option>
                <option value='0'>Non</option>
            </select>
            <br>
            <input type='submit' value='Update Premium' name='send'>

        </form>

        Grade : ".$operateur->getGrade()."
        <br> 
        Link : <a href='".$operateur->getLink()."'>Go to site</a></p>";


    } else {


        echo "<p><h3>" . ucfirst($operateur->getName()) . 
        "<a style='text-decoration:none;' href='deleteOperateur.php?id=".$operateur->getId()."'> ❎</a></h3>
        <form action='upgradePremium.php' method='post'>

            <input name='id_tour_operator' type='hidden' value='".$operateur->getId()."'>

            Premium : <select name='is_premium'id=''>
                <option value='0'>Non</option>
                <option value='1'>Oui</option>
            </select>
            <br>
            <input type='submit' value='Update Premium' name='send'>

        </form>

        Grade : ".$operateur->getGrade()."
        <br> 
        Link : <a href='".$operateur->getLink()."'>Go to site</a></p>";


    }
}

?>


<br>
<form action="addOperateur.php" method="post">

    <p>
        Name : <input type="text" name="name" maxlength="50" required>
        Grade : <input type="number" min="0" max="5" name="grade" required>
        Link : <input type="text" name="link" maxlength="250" required>
        Premium : <select name='is_premium' id=''>
            <option value='0'>Non</option>
            <option value='1'>Oui</option>
        </select>

        <br><br>

        <input type='submit' value='Create TO' name='send'>

    </p>

</form>

<a href="../index.php">Back to index</a>