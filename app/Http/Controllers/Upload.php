<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Upload extends Controller
{
    function fileType(){
        
        $file= $_FILES['excelFile'];
        
        $isExcel=false;

        $mimes=['application/vnd.ms-excel', 
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
        'application/vnd.ms-excel.sheet.macroEnabled.12',
        'application/vnd.ms-excel.template.macroEnabled.12',
        'application/vnd.ms-excel.addin.macroEnabled.12',
        'application/vnd.ms-excel.sheet.binary.macroEnabled.12'];
        
        $type = mime_content_type($file['tmp_name']);

        // //control file type
        foreach($mimes as $m){
            if($type==$m){
                $isExcel=true;                
            }
        }
                
        $response = array('isExcel'=>$isExcel,'fileName'=>$file['name']);
        echo json_encode($response);
        
    }

    function imageType(){
        
        $file= $_FILES['imageFile'];
        
        $isImage=false;

        $mimes=['image/jpeg', 'image/png','image/jpg'];
        
        $type = mime_content_type($file['tmp_name']);

        //control file type
        foreach($mimes as $m){
            if($type==$m){
                $isImage=true;                
            }
        }
        $response = array('isImage'=>$isImage,'fileName'=>$file['name']);
        echo json_encode($response);
        
    }

    function loadVariables(){

        $file= $_FILES['excelFile'];
        

        // read excel file and extract variables
        $filename=$file['name'];
        $file=$file['tmp_name'];
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows=$worksheet->getRowIterator();
        $variables = [];
        $dataset=[];
        $record=[];
        $initialIndex='';
        foreach ($rows as $row) { 
            $rowIndex = $row->getRowIndex();
            $cells=$row->getCellIterator();    
            
            if($rowIndex==1){ //get variables from spreadsheet titles
                foreach ($cells as $cell){
                    $value=$cell->getValue();

                    if($value!=''){
                        //put into array of variables

                        if($initialIndex==''){
                            $initialIndex=0;
                        }
                        else{
                            $initialIndex++;
                        }

                        $valueData=array('index'=>$initialIndex,'value'=>$value);
                        array_push($variables, $valueData);                    
                    }  

                    // if($value!='' && strtolower($value)!='email'){
                    //     //put into array of variables
                    //     array_push($variables, $value);                    
                    // }                                        
                }            
            }
            else{ //get data                 
                foreach ($cells as $cell){
                $value=$cell->getValue();
                    if($value!=''){
                        //put into record[]
                        array_push($record,$value);                          
                    }                                                                               
                }   

                //do not include empty rows
                if(sizeof($record)>0){
                    array_push($dataset,$record); 
                }                
                $record=[];                                                              
            }                        
        }   
        $response = array('name'=>$filename,'variables'=>$variables,'dataset'=>$dataset);
        echo json_encode($response);
    }

}
