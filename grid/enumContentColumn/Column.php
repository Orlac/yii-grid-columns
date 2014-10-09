<?php
namespace ext\grid\enumContentColumn;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
\Yii::import('zii.widgets.grid.CDataColumn');
/**
 * Description of SelectColumn
 *
 * @author antonio
 */
class Column extends \CDataColumn{
    //put your code here
    
    public $value;
    public $assertTrueContent;
    public $assertFalseContent;
    

    

    protected function renderDataCellContent($row,$data){
        if($this->getIsAssert($row, $data)){
            echo $this->getAssertTrueContent($row, $data);
        }else{
            echo $this->getAssertFalseContent($row, $data);
        }
    }
    
    protected function getIsAssert($row,$data) {
        return $this->evaluateExpression($this->value,array('data'=>$data,'row'=>$row));
    }
    
    protected function getAssertTrueContent($row,$data) {
        return $this->evaluateExpression($this->assertTrueContent,array('data'=>$data,'row'=>$row));
    }
    
    protected function getAssertFalseContent($row,$data) {
        return $this->evaluateExpression($this->assertFalseContent,array('data'=>$data,'row'=>$row));
    }
    
    
}
