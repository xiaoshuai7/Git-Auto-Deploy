<?php
class GitAutoDeploy{
    protected $config;
    protected $project;
    public function __construct()
    {
        $this->config = require './config.php';
        $this->setProject();
    }

    protected function setProject(){
        $this->project = $this->config['project'];
    }

    public function getProject($url='',$password=''){
        if(!$url){
            return false;
        }
        $project = filter_by_value($this->project,'project_url',$url);
        if($project['password'] != $password){
            return false;
        }
        return array_shift($project);
    }

    public function getPath(){
        return $this->config['path'];
    }







}