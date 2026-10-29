
<x-header title='Index' />

<div id='vue'>


    <div class='container top1'>    
        <div class='row'>
            
            <div class='col-2 centre  shadow ' id='sidemenuContainer'>

                <x-sidemenu />

            </div>

            <div class='col'>
                <p class='darkgreen'><b>@{{sidemenuTitle}}</b></p>

                <div v-if='sidemenu==1'><x-upload /></div>

                <div v-if='sidemenu==2' ><x-customise /></div>

                <div v-if='sidemenu==3' ><x-pdf /> </div>
                                                                
            </div>            
        </div>
    </div>


    

</div>





<script src="js/app.js"></script>   











