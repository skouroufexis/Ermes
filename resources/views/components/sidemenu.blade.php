


   <div class='container' id='sidemenu'>
    <div class='row'>
        <button v-if='sidemenu!=1' class='btn sidebutton' @click='activeSidemenu(1,"Upload Excel file")'>
            <i class="fas fa-file-upload"></i>            
        </button>

        <button v-if='sidemenu==1' class='btn btn-active sidebutton' @click='activeSidemenu(1,"Upload Excel file")'>
            <i class="fas fa-file-upload"></i>            
        </button>
    </div>

    <div class='row top1'>
        <button v-if='sidemenu!=2' class='btn sidebutton' @click='activeSidemenu(2,"Customise Template")'>
        <i class="fas fa-pencil-alt"></i>
        </button>   

        <button v-if='sidemenu==2' class='btn btn-active sidebutton' @click='activeSidemenu(2,"Customise Template")'>
        <i class="fas fa-pencil-alt"></i>                    
        </button>   
    </div>

    <div class='row  top1'>
        <button v-if='sidemenu!=3' class='btn sidebutton' @click='activeSidemenu(3,"Preview PDF")'>
            <i class="fas fa-file-pdf"></i>
        </button>   

        <button v-if='sidemenu==3' class='btn btn-active sidebutton' @click='activeSidemenu(3,"Preview PDF")'>
            <i class="fas fa-file-pdf"></i>
        </button>   
    </div>
        
        <!-- <div class='row  top1' @click='activeSidemenu(4,"Email")'>
            <button v-if='sidemenu!=4' class='btn sidebutton'>
                <i class="fas fa-envelope"></i>
            </button>   

            <button v-if='sidemenu==4' class='btn btn-active sidebutton' @click='activeSidemenu(4,"Email")'>
                <i class="fas fa-envelope"></i>
            </button>   
        </div> -->
   </div>
    




    

