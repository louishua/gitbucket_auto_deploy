<?php

define('ROOT',dirname(__DIR__));

$data = $_POST;

$log_file = dirname(__DIR__) . '/logs/' . time() . '.html';

$shellPath = dirname(__DIR__) . '/' . 'bin/' . 'auto_deploy.sh';

$json = $data['payload'];

$info = json_decode($json,true);

#file_put_contents($log_file,'<pre>'.var_export($info,true));exit;
$repository = $info['repository']['name'];//仓库名
$fullname = $info['repository']['full_name'];
$branch = substr($info['ref'],11);//分支名词

$configFile = ROOT . '/config' . '/' . $fullname . '.php';

$config = require($configFile);

#file_put_contents($log_file,'<pre>'.var_export($config,true));exit;
$deployedGit = '/usr/share/tomcat7/.gitbucket/repositories/' . $fullname . '.git';
$gitDeployPath = $config[$branch]['deploy_path'];


$shell = $shellPath . ' ' . $deployedGit . ' ' . $gitDeployPath . ' ' .  $branch;

exec($shell);

#echo '<pre>';
#file_put_contents($log_file,'<pre>'.var_export($debug,true));
echo 'ok';

