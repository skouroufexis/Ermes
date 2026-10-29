 <div class='row documentContainer justify-centre'>                                 
                    @foreach($fields as $f){                    
                        <div class="fieldContainer {{$f->column}}"
                                        
                    >    
                         @if($f->image){
                            <div>
                                <button type='button' class = 'col-12 btn btn-light top1 field'                            
                                style="text-align: {{ $f->align }}"
                                >                                    
                                    <img  src="{{ $f->imageSrc }}" alt=""
                                    
                                    class="{{ $f->imageSize }}"                                    
                                    >                            
                                </button> 
                        </div>
                         }       
                        
                        @endif       
                        
                        @if(!$f->image){
                        <div>

                            @if(trim($f->hasUrl!='')){
                            <div>
                                 
                                <a href='{{$f->hasUrl}}' target='_blank'>
                                <button  type='button' class = 'col-12 btn btn-light top1 field'  
                                    style='textAlign:  {{@f->align}},fontWeight:{{$f->bold}},fontStyle:{{$f->italic}},fontFamily:{{$f->font}},
                                            fontSize:{{$f->size."pt"}},color:{{$f->color}},hasUrl:{{$f->hasUrl}}'                                                                        
                                            >
                                            
                                        @{{dataset[f->initialIndex]}}  
                                </button>
                                </a>
                            </div>
                            }
                            @else{

                            <div>
                                
                                <button  type='button' class = 'col-12 btn btn-light top1 field'  
                                    style='textAlign: {{ $f->align}},fontWeight:{{$f->bold}},fontStyle:{{$f->italic}},fontFamily:{{$f->font}},
                                            fontSize:{{$f->size."pt"}},color:{{$f->color}},hasUrl:{{$f->hasUrl}}'                                                                        
                                            >
                                        <!-- @{{dataset[datasetIndex][f.initialIndex]}}   -->
                                </button>                                
                            </div>   
                            }
                            @endif 
                        </div>
                        }
                        @endif
                    </div>

                    }
                    @endforeach
                    
                        
            </div> 