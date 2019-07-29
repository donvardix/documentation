<!-- Сравнение игр двух пользователей Steam  -->
<!doctype html>
<html lang="ru">
<head>
    <title>Сравнение игр двух пользователей Steam</title>
</head>
<body>

<?php
$id1 = 76561198127210094;
$id2 = 76561198352806201;
function SteamApi($userId)
{
    $key = '';
    $url = file_get_contents('http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=' . $key . '&steamid=' . $userId . '&include_appinfo=1');
    $content = json_decode($url);
    $coin = $content->response->game_count;
    $arr = [];
    for ($i = 0; $i < $coin; $i++) {
        $appId = $content->response->games[$i]->name;
        $arr[] = $appId;
    }
    return $arr;
}

$arr1 = SteamApi($id1);
$arr2 = SteamApi($id2);
$result2 = array_merge($arr1, $arr2);
$result3 = array_unique($result2);
?>

<table cellpadding="5" cellspacing="0" border="1">
    <caption>Title</caption>
    <tr>
        <th>Игры</th>
        <th><?php echo $id1 ?></th>
        <th><?php echo $id2 ?></th>
    </tr>
    <?php
    for ($i = 0; $i < count($result3); $i++) {
        $appId2 = $result3[$i];
        echo '<tr><td>' . $appId2 . '</td><td>';
        if (in_array($appId2, $arr1)) {
            echo '+';
        }
        echo  '</td>';
        if (in_array($appId2, $arr2)) {
            echo '<td>+</td>';
        }
        echo '</tr>';
    }
    ?>
</table>

</body>
</html>