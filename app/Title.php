<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends ReadOnlyBase            //remove the dependency from Eloquent, and add the inheritance from ReadOnlyBase
{
    //
    protected $titles_array = ['Mr', 'Mrs', 'Ms', 'Dr', 'Mx','Professor'];
}
