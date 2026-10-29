
<?php 
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use Barryvdh\DomPDF\Facade\Pdf;


// echo $dataset[1];




// echo sizeof($fields[0]->column);
 
?>


<head>
  <link rel="stylesheet" type="text/css" href="./css/app.css" />

</head>





 


      

<body id='body'>    
    <div>
        <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col">
                      <div class='row documentContainer justify-centre'>                                 
                    @foreach($fields as $f)                 
                        <div class="{{$f->column}}"
                                        
                    >    
                         @if($f->image)
                            <div>
                                <button type='button' class = 'col-12 btn top1 recordPdf'                            
                                style="text-align: {{ $f->align }}"
                                >                                    
                                    <img  src="{{ $f->imageSrc }}" alt=""
                                    
                                    class="{{ $f->imageSize }}"                                    
                                    >                            
                                </button> 
                        </div>
                           
                        
                        @endif       
                        
                        @if(!$f->image)
                        <div>

                            @if(trim($f->hasUrl!=''))
                            <div>
                                 
                                <a href='{{$f->hasUrl}}' target='_blank'>
                                <button  type='button' class = 'col-12 btn top1 recordPdf'  
                                    style='text-align:{{$f->align}};font-weight:{{$f->bold}};font-style:{{$f->italic}};fontFamily:{{$f->font}};
                                            font-size:{{$f->size."pt"}};color:{{$f->color}}'                                                                        
                                            >
                                        
                                        {{$dataset[$f->initialIndex]}} 
                                </button>
                                </a>
                            </div>
                            
                            @else

                            <div>                                                                
                                <button  type='button' class = 'col-12 btn top1 recordPdf'  
                                    style='text-align: {{ $f->align}};font-weight:{{$f->bold}};font-style:{{$f->italic}};font-family:{{$f->font}};
                                            font-size:{{$f->size."pt"}};color:{{$f->color}}'                                                                        
                                            >
                                        {{$dataset[$f->initialIndex]}} 
                                         
                                </button>                                
                            </div>   
                            
                            @endif 
                        </div>
                        
                        @endif
                    </div>

                    
                    @endforeach
                    
                        
            </div> 
            
            



        </div>
            </div>
        </div>    
            
        


        
        


    </div>
</body>

