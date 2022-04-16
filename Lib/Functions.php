<?php 

class func{

    static function href($page){
        echo ($page==null)?url::myurl()."#":url::myurl().$page;
    }

}