<?php
$showtime = date("Y-m-d H:i:s");
$fangwen = "访问者IP:";
$fangwentime = "访问时间:";
$ips = $_SERVER['REMOTE_ADDR'];

// 设置调试模式，生产环境中将其设置为 false
$debug = false;

// 使用提供的 API 查询 IP 归属地信息
$apiKey = 'b6rEkaDVlu4oRPWW4J1tnxiZE4j6obHcd1KeazbGMOdQ51b9PbylpSzMQO4X9HdN'; // 你的 API key
$apiUrl = "https://api.ipplus360.com/ip/geo/v1/city/?key=$apiKey&ip=$ips&coordsys=WGS84"; // 使用提供的 API

$location = file_get_contents($apiUrl);
$locationData = json_decode($location, true);

if ($debug) {
    // 调试信息：输出API返回的数据
    echo "<pre>";
    print_r($locationData);
    echo "</pre>";
}

if ($locationData && isset($locationData['data'])) {
    $continent = $locationData['data']['continent'] ?? '未知大陆';
    $country = $locationData['data']['country'] ?? '未知国家';
    $province = $locationData['data']['prov'] ?? '未知省份';
    $city = $locationData['data']['city'] ?? '未知城市';
    $locationInfo = "$continent, $country, $province, $city";
} else {
    $locationInfo = "未知地点";
}

if ($debug) {
    // 调试信息：输出解析后的位置信息
    echo "IP: $ips<br>";
    echo "Location Info: $locationInfo<br>";
}

$file = "/www/wwwroot/www.josphersun.ink/access_log.txt"; // 确保路径和权限设置正确

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 获取停留时间和可见时间
    $timeSpent = intval($_POST['timeSpent']);
    $visibleTime = intval($_POST['visibleTime']);

    $fp = fopen($file, "a");
    if ($fp) {
        // 将数据转换为UTF-8编码
        $txt = "$fangwen $ips ---- 归属地: $locationInfo ---- $fangwentime $showtime ---- 总停留时间: $timeSpent 秒 ---- 可见时间: $visibleTime 秒\n";
        $txt = mb_convert_encoding($txt, 'UTF-8', 'auto');
        
        // 如果文件为空，写入BOM头以确保是UTF-8编码
        if (filesize($file) == 0) {
            fwrite($fp, "\xEF\xBB\xBF");
        }

        fputs($fp, $txt);
        fclose($fp); // 关闭文件
        echo "Time logged successfully";
    } else {
        echo "Failed to open file for writing.";
    }
} else {
    $fp = fopen($file, "a");
    if ($fp) {
        // 将数据转换为UTF-8编码
        $txt = "$fangwen $ips ---- 归属地: $locationInfo ---- $fangwentime $showtime\n";
        $txt = mb_convert_encoding($txt, 'UTF-8', 'auto');

        // 如果文件为空，写入BOM头以确保是UTF-8编码
        if (filesize($file) == 0) {
            fwrite($fp, "\xEF\xBB\xBF");
        }

        fputs($fp, $txt);
        fclose($fp); // 关闭文件
    } else {
        echo "Failed to open file for writing.";
    }
}
?>
