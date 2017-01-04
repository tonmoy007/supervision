<?php

namespace App;

use DateTime;

class SuperVision{

    public function getDateTime($date=null){
        $d=new DateTime($date);
        return ''.$d->format('Y-m-d H:i');
    }
}