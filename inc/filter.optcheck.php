<?php

/**
 * Songbook options filters
 *
 * Methods preventing saving wrong option values into database - in past caused breaking of script
 * Methods left without PHP docs, they arent to use in any other way
 *
 * @since       v. 2.0.
 * @version     1.0
 * @author      Sjiamnocna
 * @copyright   (c) 2015 Sjiamnocna
 * 
 */ 

class songbook_optfilters extends songbook_functions{
    
    public function __construct() {
        foreach(array_keys($this->defs()) as $opt){
            if(strpos($opt,'enable'))
                                add_filter('chkval_'.$opt,array($this,'enable'));
            
            elseif(strpos($opt,'mincap'))
                    add_filter('chkval_'.$opt,array($this,'mincap'));
            
            elseif(strpos($opt,'disp'))
                    add_filter('chkval_'.$opt,array($this,'disp'));
        }
    }
    
    public function enable($cont){
        if(in_array($cont,array('enable','disable')))
                return $cont;
        else return;
    }
    
    public function mincap($cont){
        if(in_array($cont,array('manage_options','read_private_pages','publish_posts','edit_posts','read')))
                return $cont;
        else return;
    }
    
    public function disp($cont){
        if(in_array($cont,array('display','false')))
                return $cont;
        else return;
    }
    
}

$wpsb_filters= new songbook_optfilters();