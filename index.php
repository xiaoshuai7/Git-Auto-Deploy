<?php
require 'GitAutoDeploy.php';
require 'Request.php';
require 'functions.php';
require 'Log.php';
define("ROOT",__DIR__);
$gitClass  = new GitAutoDeploy();
$post_data = (new Request())->getParams("post");
$ssh_url   = $post_data['repository']['ssh_url']??'';
$password  = $post_data['password']??'';
$project   = $gitClass->getProject($ssh_url,$project);
$path  = $gitClass->getPath();
if(!$project){
    messageJson(0,"NOT FOUND PROJECT");
}

if(!is_dir($project['project_path'])){
    mkdir($project['project_path'],'0755',true);
}
$project_path =  $project['project_path'].'/'.$project['project_name'];
if(!is_dir($project_path)){
    //没有目录 需要clone
    $sh = "cd {$project['project_path']} && {$path['git']} clone {$project['project_url']} {$project['project_name']}";
}else{
    // 有目录直接pull
    $script = $project['after_scrip'] ?"&& {$project['after_scrip']}":"";
    $sh = "cd  {$project_path} && {$path['git']} pull origin {$project['remote_branch']} {$script}";
}
exec($sh,$result,$code);
if($code!=0){
    Log::write('error',var_export($result,true));
    messageJson(0,'pull失败');
}
Log::write('success',var_export($result,true));
messageJson(1,'pull成功');




