<?php

/*
 * @package Qcloudapi服务器内存图表
 * @author 约码团队
 * @version 1.0.0
 * @link https://github.com/yuecode
 * @date 2016-3-1
 */

error_reporting(E_ALL ^ E_NOTICE);
require_once './src/QcloudApi/QcloudApi.php';
$config = [
    'SecretId' => '你的SecretId',
    'SecretKey' => '你的SecretKey',
    'RequestMethod' => 'GET',
    'DefaultRegion' => 'gz'
];

$cvm = QcloudApi::load('monitor', $config);
$package = [
    'namespace' => 'qce/cvm',
    'metricName' => 'mem_used',
//    'startTime'=>'2016-02-28 00:00:00',
//    'endTime'=>'2016-02-28 23:59:00',
    'dimensions.1.name' => 'unInstanceId',
    'dimensions.1.value' => 'ins-egwohmde',
    'period' => 300,
];
$a = $cvm->GetMonitorData($package);
//$a = $cvm->generateUrl('DescribeInstances', $package);

if ($a === false) {
    $error = $cvm->getError();
    echo "Error code:" . $error->getCode() . ".\n";
    echo "message:" . $error->getMessage() . ".\n";
    echo "ext:" . var_export($error->getExt(), true) . ".\n";
} else {
    echo json_encode($a['dataPoints']);
}
