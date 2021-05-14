<?php
class Request{
    protected $header;
    protected $post;
    protected $input;
    protected function setHeader(){
        $header = [];
        if (isset($_SERVER['CONTENT_TYPE'])) {
            $header['content-type'] = $_SERVER['CONTENT_TYPE'];
        }
        if (isset($_SERVER['CONTENT_LENGTH'])) {
            $header['content-length'] = $_SERVER['CONTENT_LENGTH'];
        }
        $this->header = $header;
    }
    public function __construct()
    {
        $this->setHeader();
        $this->input = file_get_contents('php://input');
        $inputData = $this->getInputData($this->input);
        $this->post    = $_POST ?: $inputData;
    }


    public function contentType(): string
    {
        $contentType = $this->header['content-type'];


        if ($contentType) {
            if (strpos($contentType, ';')) {
                [$type] = explode(';', $contentType);
            } else {
                $type = $contentType;
            }
            return trim($type);
        }

        return '';
    }

    protected function getInputData($content): array
    {
        $contentType = $this->contentType();
        if ('application/x-www-form-urlencoded' == $contentType) {
            parse_str($content, $data);
            return $data;
        } elseif (false !== strpos($contentType, 'json')) {
            return (array) json_decode($content, true);
        }

        return [];
    }

    public  function getParams($method){
        if($method == 'post'){
            return $this->post;
        }
    }
}