<?php

class ThreadController {

    public function fork(){
        $pid = pcntl_fork();
        if($pid == -1){
            //file_put_contents('testlog.log',"\r\nFork Test",FILE_APPEND);
            return 1; //error
        }
        else if($pid){
            return 0; //success
        }
        else{   
            //file_put_contents($log, 'Running...', FILE_APPEND);
        }
    }
}