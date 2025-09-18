<?php foreach($productes as $producte): ?>
    <div class="product-card" onclick="mostraProductesDetall(<?php echo $producte['id']; ?>)"> 
        <img src= "<?php echo $producte['imatge'] ?>" class="product-image">
        <div class="product-name"> <?php echo $producte['nom'] ?> </div>
        <div class="product-price"> <?php echo $producte['preu'] ?> </div>
    </div>
<?php endforeach; ?>