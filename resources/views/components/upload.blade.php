
<div>

    <form v-if='fields==""' name='form_excel' action="/" method="post" enctype="multipart/form-data" id='form_excel'>
        @csrf                
       
        <label class='col-12' for="excelFile">    
            <input class='col-12' type="file" name="excelFile" id="excelFile">                           
        </label>

        <div v-if='fileName!=""' class='col-12 lightgrey top1'><small>@{{fileName}}</small></div>
        <div v-if='error!=""' class='col-12 orange'><small>@{{error}}</small></div>
            
        <button type='button' class='top1 btn btn-active' @click='validateFile'>upload</button>   
 
    </form>
    

       



     <div v-if='fields!=""'>
        <div class='col-12 lightgrey top1'>
            <small>@{{fileName}}</small> 
            <!-- <button class='btn  left1 fas fa-trash-alt red' @click='removeAttachment'></button> -->
            <a href='/'><button class='btn  left1  red'><i class="fas fa-trash"></i></button></a>
            
        </div>        
        <button type='button' class="btn top1 black" @click='next(2)'> <i class='fas fa-caret-right'></i>  Next</button>
     </div>   

</div>







 