<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <title>Ajout produit</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-2">

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Ajouter un produit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="recap.php">Récapitulatif</a>
                    </li>
                </ul>
            </nav>
            <article class="col-sm-6">
                <h1>Ajouter un produit</h1>
                <form action="traitement.php" method="post">
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
                    <button type="submit" class="btn btn-primary" name="submit">Ajouter le produit</button>
                </form>
            </article>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>