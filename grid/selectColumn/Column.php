<?php
namespace ext\grid\selectColumn;
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
    
    public $updateUrl;
    public $nameValue;
    public $list;
    public $requestData;
    public $method='post';
    
    public $selector ='select-column';
    

    

    protected function renderDataCellContent($row,$data){
        $opts = \CMap::mergeArray($this->htmlOptions, array(
            'data-name' =>  $this->nameValue,
            'data-type' => $this->selector,
            'data-url' => $this->getUpdateUrl($row, $data),
            'data-request' => json_encode( $this->getRequestData($row,$data) ),
            'data-grid-id' => $this->grid->getId(),
            'data-method' => $this->method,
            'empty' => '--  --'
        ));
        echo \CHtml::dropDownList('', $this->getSelectedValue($row, $data), $this->list, $opts);
        
        //register script
        $this->registerScript();
    }
    
    protected function registerScript(){
        /* @var $am \CAssetManager */
        $am = \Yii::app()->getAssetManager(); 
        /* @var $cs \CClientScript */
        $cs = \Yii::app()->getClientScript(); 
        
        $url = $am->publish(dirname(__FILE__).'/assets/script.js');
        $cs->registerScriptFile($url);
        
        $script = "$(document).grid('selectColumn', {target: '[data-type=".$this->selector."]' })";
        $cs->registerScript('selectColumn_'.$this->selector, $script);
    }
    
    protected function getSelectedValue($row, $data){
        if ( $this->value !== null  ){
            return $this->evaluateExpression($this->value,array('data'=>$data,'row'=>$row));
        }elseif(!$this->name !== null){
            return \CHtml::value($data, $this->name);
        }
        return null;
    }
    
    protected function getUpdateUrl($row, $data){
        $updateUrl=null;
        if($this->updateUrl !== null){
            $updateUrl=$this->evaluateExpression($this->updateUrl,array('data'=>$data,'row'=>$row));
        }
        return $updateUrl;
    }
    
    protected function getRequestData($row,$data){
        $_data=array();
        if($this->requestData !== null){
            $_data=$this->evaluateExpression($this->requestData,array('data'=>$data,'row'=>$row));
        }
        return $_data;
    }
    
    
}
