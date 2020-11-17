<h2>Каталог</h2>

<? foreach ($catalog as $item): ?>

    <h2><a href="/product/card/?id=<?= $item['id'] ?>"><?= $item['name'] ?></a></h2>
    <p><?= $item['description'] ?></p>
    <p>Цена: <?= $item['price'] ?></p>
    <button type="submit" data-id="<?= $item['id'] ?>" class="buy">КУПИТЬ</button>

    <hr>
<? endforeach; ?>

<a href="/product/catalog/?page=1">Далее</a>

<script>
    let buttons = document.querySelectorAll('.buy');
    buttons.forEach((elem) => {
        elem.addEventListener('click', () => {
            let id = elem.getAttribute('data-id');
            (
                async () => {
                    const response = await fetch('/basket/buy/', {
                        method: 'POST',
                        headers: new Headers({
                            'Content-Type': 'application/json'
                        }),
                        body: JSON.stringify({
                            id: id
                        })
                    })
                    const answer = await response.json();
                    document.getElementById('count').innerText = answer.count;

                }
            )();
        })
    });
</script>