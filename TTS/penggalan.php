<?php
//test class penggalan
class penggalan {
    function processpenggalan($inputtext) {
        $explodetext = explode(" ",$inputtext);
        $arrayvokal = array('a','e','i','u','o');
        $arraysavedpenggalan = array();
        if(is_array($explodetext)) {
            foreach($explodetext as $listtext) {
                $panjang = strlen($listtext);
                $start = 0;
                $penggalan = "";
                while($start<$panjang) {
                    $singlchar = strtolower(substr($listtext,$start,1));
                    if($penggalan=="") {
                        $penggalan = $singlchar;
                    }
                    else {
                        if(in_array($singlchar,$arrayvokal)) {
                            $penggalan .= $singlchar;
                            $startnext = $start + 1;
                            $singlcharnext = strtolower(substr($listtext,$startnext,1));
                            if($singlcharnext=="") {
                                $arraysavedpenggalan[] = $penggalan;
                                $penggalan = "";
                            }
                        }
                        else {
                            $startnext = $start + 1;
                            $startbefore = $start - 1;
                            $singlcharnext = strtolower(substr($listtext,$startnext,1));
                            $singlcharbefore = strtolower(substr($listtext,$startbefore,1));
                            if(in_array($singlcharnext,$arrayvokal)) {
                                if(strtolower(substr($listtext,$start,1))=="r" and !in_array($singlcharbefore,$arrayvokal)) {
                                    $penggalan .= $singlchar;
                                }
                                else {
                                    $arraysavedpenggalan[] = $penggalan;
                                    $penggalan = "";
                                    $penggalan = $singlchar;
                                }
                                
                            }
                            else {
                                if($singlcharnext=="") {
                                    $penggalan .= $singlchar;
                                    $arraysavedpenggalan[] = $penggalan;
                                    $penggalan = "";
                                }
                                else {
                                    $startnextnext = $startnext + 1;
                                    if(strtolower(substr($listtext,$startnext,1))=="r") {
                                        $arraysavedpenggalan[] = $penggalan;
                                        $penggalan = $singlchar;
                                    }
                                    else {
                                        $penggalan .= $singlchar;
                                    }
                                    
                                }
                            }
                            
                        }
                    }
                    $start++;
                }
            }
        }
        return json_encode($arraysavedpenggalan);
        
    }
}
?>