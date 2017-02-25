<?php

function my_log($message){

    if(defined('WP_DEBUG') && WP_DEBUG){
        $file_path = __DIR__.DIRECTORY_SEPARATOR.'app-log.log';
        $time = date('Y-m-d H:i:s');

        if(is_array($message) || is_object($message)){
            $message = print_r($message, true);
        }

        $log_line = $time."\t".$message."\n";

        if(!(file_put_contents($file_path, $log_line, FILE_APPEND))){
            throw new Exception('Plik logów '.$file_path.' nie istnieje');
        }
    }


}

//add_action('shutdown', 'my_log');

function my_query_logger(){

    if((defined('WP_DEBUG') && WP_DEBUG) && (defined('SAVEQUERIES') && SAVEQUERIES)){

        global $wpdb;
        $dump = [];
        $header = '--SQL DUMP at '.date('Y:m:d H-i-s').' --';
        $footer = 'END DUMP!!!';
        $file_path = __DIR__.DIRECTORY_SEPARATOR.'query-logger.log';

        if(!empty($wpdb->queries)){

            foreach($wpdb->queries as $i=>$qrow){

                $query = $qrow[0];
                $time = number_format(sprintf('%0.2f', $qrow[1]*1000), 2, ".", ",") ;
                $path = $qrow[2];
                $dump[] = "[{$i}]\t - Query:  {$query}\n\t - Time: {$time}ms \n\t - Path: {$path}";
            }
        }
        else{

            $dump[] = 'Brak zapytań SQL';
        }

        $content = $header. "\n\n".implode("\n\n", $dump)."\n\n".$footer."\n";

        if(!(file_put_contents($file_path, $content, FILE_APPEND))){
            throw new Exception('Plik logów '.$file_path.' nie istnieje');
        }
    }



}


add_action('shutdown', 'my_query_logger');