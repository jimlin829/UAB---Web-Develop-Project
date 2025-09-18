<?php foreach($categories as $categoria): ?> 
    <div class="category-card" onclick="mostraProductesPerCat(<?php echo $categoria['id']; ?>);">
        <img src= "<?php echo $categoria['imatge'] ?>" alt="<?php echo htmlentities($categoria['nom'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); //htmlentities escapa el contingut?>" class="category-image">
        <div class="category-name"> <?php echo htmlentities($categoria['nom'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); //htmlentities escapa el contingut?> </div>
    </div>
<?php endforeach; ?>