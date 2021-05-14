<?php
class Log{
    const LOG_DIR = ROOT."/log/";
    public static function write($type='',$content){
        $log_dir = self::generated_dir();
        $log_filename    = date("d");
        $time = date("Y-m-d H:i:s");
        $data = "[ {$time} ]  $type\n$content\n\n";
        file_put_contents($log_dir.'/'.$log_filename,$data,FILE_APPEND);
    }

    private static function generated_dir()
    {
        $date = date("Y-m");
        $log_dir = self::LOG_DIR . $date;
        if (!is_dir($log_dir)) {
            mkdir($log_dir, '0755', true);
        }
        return $log_dir;
    }

}