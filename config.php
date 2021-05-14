<?php
return [
    'host'      =>'localhost',
    'http-port' =>'',//http端口
    'path' => [
        'git' => 'git'//git 执行文件位置
    ],
    'project' => [
        [
            'project_name' => '',//项目名称
            'project_url'  => '',//项目url
            'remote_branch'  => '',//远程分支
            'project_path' => '',//项目目录
            'password' =>'',
            'after_scrip' => ''//pull 执行后的额外脚本命令
        ]
    ],

];