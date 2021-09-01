<?php

namespace classes;

use Iterator;
use FilterIterator;


class CallFilter extends FilterIterator
{
    private $callFilter;
   
    public function __construct(Iterator $iterator , $filter )
    {
        parent::__construct($iterator);
        $this->callFilter = $filter;
    }
   
    public function accept()
    {
        $call = $this->getInnerIterator()->current();
        if( strcasecmp($call['id'],$this->callFilter) == 0) {
            return true;
        }       
        return false;
    }
}