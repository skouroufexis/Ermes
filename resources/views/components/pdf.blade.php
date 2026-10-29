<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use Barryvdh\DomPDF\Facade\Pdf;




?>




<body id='body'>
    <div>

        <div class="container" v-if='fields!="" '>
            <div class="row">
                <p v-if='fields!=""' class='col-6 lightgrey'>@{{fileName}}</p>
                <div class='col-4'><small><b>Record @{{datasetIndex+1}} of @{{datasetSize}}</b></small></div>

                 <div v-if='datasetIndex>0' class="col-1"><button class='btn btn-active' @click='previousRecord'><i class="fas fa-caret-left"></i></button></div>
                 <div v-if='datasetIndex==0' class="col-1 lightgrey"><button class='btn btn-active'><i class="fas fa-caret-left"></i></button></div>

                 <div v-if='datasetIndex<(datasetSize-1)' class="col-1"><button class='btn btn-active' @click='nextRecord'><i class="fas fa-caret-right"></i></button></div>
                 <div v-if='datasetIndex==(datasetSize-1)' class="col-1"><button class='btn btn-active'><i class="fas fa-caret-right"></i></button></div>
            </div>

            


            <div  id='pdfArea' class='shadow-sm'>
                <div class='row documentContainer  justify-centre'  >

                    <div v-for='f in fields' class='fieldContainer'
                    :class='{ "col-1": f.column=="col-1",
                    "col-2": f.column=="col-2",
                    "col-3": f.column=="col-3",
                    "col-4": f.column=="col-4",
                    "col-5": f.column=="col-5",
                    "col-6": f.column=="col-6",
                    "col-7": f.column=="col-7",
                    "col-8": f.column=="col-8",
                    "col-9": f.column=="col-9",
                    "col-10": f.column=="col-10",
                }'
                >

                

                <div v-if='f.image'>
                    <button type='button' class = 'col-12 btn top1 field'
                    :style='{textAlign:f.align}'
                    >
                    <img  :src="f.imageSrc" alt=""

                    :class='{ "col-1": f.imageSize=="col-1",
                    "col-2": f.imageSize=="col-2",
                    "col-3": f.imageSize=="col-3",
                    "col-4": f.imageSize=="col-4",
                    "col-5": f.imageSize=="col-5",
                    "col-6": f.imageSize=="col-6",
                    "col-7": f.imageSize=="col-7",
                    "col-8": f.imageSize=="col-8",
                    "col-9": f.imageSize=="col-9",
                    "col-10": f.imageSize=="col-10",
                    "col-11": f.imageSize=="col-11",
                    "col-12": f.imageSize=="col-12",
                }'
                >
            </button>
        </div>

        <div v-if='!f.image'>

            <div v-if='f.hasUrl.trim()!=""'>

                <a :href='f.hasUrl' target='_blank'>
                    <button  type='button' class = 'col-12 btn  top1 field'
                    :style='{ textAlign:  f.align,fontWeight:f.bold,fontStyle:f.italic,fontFamily:f.font,
                    fontSize:f.size+"pt",color:f.color,hasUrl:f.hasUrl}' 
                    
                    > <u>
                    @{{dataset[datasetIndex][f.initialIndex]}}
                    </u>
                </button>
            </a>
        </div>

        <div v-else>

            <button  type='button' class = 'col-12 btn top1 field'
            :style='{ textAlign:  f.align,fontWeight:f.bold,fontStyle:f.italic,fontFamily:f.font,
            fontSize:f.size+"pt",color:f.color,hasUrl:f.hasUrl}'
            >
            @{{dataset[datasetIndex][f.initialIndex]}}
            </button>
       </div>        
</div>
</div>

</div>
</div>



<div class="row">
<button class='btn green col-1 rounded-0' title="Preview PDF" @click='previewPdf()'> <b><i class='fas fa-file-pdf'></i> </b></button>    
<button class='btn green col-1 rounded-0' title="Download PDF" @click='downloadPdf()'> <b><i class='fas fa-download'></i> </b></button>

<button class='btn  green col-1 rounded-0 ms-1' title="Send email" @click='email()'><b> <i class="fas fa-download"></i> <i class='fas fa-envelope'></i></b></button>

</div>


</div>
</div>
<p v-if='fields==""'>No file uploaded</p>






</body>

