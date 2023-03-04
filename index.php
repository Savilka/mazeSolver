<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <label>Высота (N)
        <input type="number" name="N" min="1" max="30">
    </label>
    <label>Ширина (M)
        <input type="number" name="M" min="1" max="30">
    </label>
    <input type="submit" value="Создать лабиринт">
</form>
<?php
if (isset($_POST['N']) && isset($_POST['M'])) {
    echo '<form id="maze" method="post">';
    echo '<table>';
    echo '<tbody>';
    $n = $_POST['N'];
    $m = $_POST['M'];
    for ($i = 1; $i <= $n; $i++): ?>
        <tr> <?php
            for ($j = 1; $j <= $m; $j++):?>
                <td>
                    <select name="<?= $i . $j ?>">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="-1">Старт</option>
                        <option value="10">Финиш</option>
                    </select>
                </td>
            <?php endfor; ?>
        </tr>
    <?php endfor;
    echo '</tbody>';
    echo '</table>';
    echo '<input type="submit" value="Найти путь">';
    echo '</form>';
}
?>
<span id="errors"></span>
<span id="cost"></span>
<script>
    $(document).ready(function () {

        $('#maze').submit(function (e) {
            e.preventDefault();
            const tr = $('tr');
            let tableArray = [];

            for (let i = 0; i < tr.length; i++) {
                tableArray[i] = [];
                for (let j = 0; j < tr[i].children.length; j++) {
                    tableArray[i][j] = tr[i].children[j].children[0].value;
                }
            }
            $.ajax({
                type: "post",
                url: 'mazeAjax.php',
                data: {mazeData: tableArray},
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.errors === undefined) {
                        $('#errors').text('');
                        $('#cost').text(data.cost);
                    } else {
                        $('#cost').text('');
                        $('#errors').text(data.errors);
                    }

                }
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>



