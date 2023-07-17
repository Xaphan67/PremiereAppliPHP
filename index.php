<?php
session_start();
ob_start();
?>

<article class="col-sm-9">
    <h1>Ajouter un produit</h1>
    <form action="traitement.php?action=add" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label col-form-label" for="name">Nom du produit :</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="name" name="name">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label col-form-label" for="price">Prix du produit :</label>
            <div class="col-sm-4">
                <input type="number" class="form-control" step="any" id="price" name="price">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label col-form-label" for="qtt">Quantité désirée :</label>
            <div class="col-sm-4">
                <input type="number" class="form-control" name="qtt" id="qtt" value="1">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label col-form-label" for="file">Image :</label>
            <div class="col-sm-4">
                <input type="file" class="form-control" name="file" id="file">
            </div>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Ajouter le produit</button>
    </form>
</article>

<?php
$title = "Ajout produit";
$contenu = ob_get_clean();
require_once("template.php");
