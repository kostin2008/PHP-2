<h2>Каталог</h2>

<? foreach ($catalog as $item): ?>
<a href="/?c=product&a=card&id=<?= $item['id'] ?>">
    <h2><?= $item['name'] ?></h2>
    <img src="images/products/<?= $item['image'] ?>" width="150px" height="150px" alt=""><br>
</a>
<p><?= $item['description'] ?></p>
<p>Цена: <?= $item['price'] ?></p>
<hr>
<? endforeach;?>

<a href="/?c=product&page=1">Далее</a>