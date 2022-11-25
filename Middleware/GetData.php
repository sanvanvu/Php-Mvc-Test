<?php
namespace TestProject\Middleware;
class GetData {
    /**
     * @param $orBy
     * @param $desc
     * @return string
     */
    public function ordeyBy($stmt, $orBy, $desc){

            $stmt.=' ORDER BY '.$orBy.' '. ($desc?'DESC':'ASC');
            return $stmt;
    }
    public function selected($smmt,$cond){
        $smmt.=' WHERE '.$cond.' = :'.$cond;
        return $smmt;
    }
}