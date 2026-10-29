<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;

?>

<body id='body'>

    <div>

        <div class="container" v-if='fields!=""'>

        <p v-if='fields!=""' class='row lightgrey'>@{{fileName}}</p>


            <div class='row top1 documentContainer'>

                <!-- edit menu -->
                <div class='row'>
                    <div class='col-10'>
                        <div v-if='selected!=null && fields[selected].image==false' class='col-12 shadow padding1 top1'>
                        <div class='col-10 left2 black'><small><b>Customise selection</b></small></div>

                            <div class='col-12 top1 text-right'>
                            <button  class = 'col-1 btn  green  left1 top1' @click='reorderUp()'> <i class='fas fa-caret-up'></i> </button>
                            <button  class = 'col-1 btn  green  left1  top1' @click='reorderDown()' > <i class='fas fa-caret-down'></i> </button>

                            <button  v-if='action==1' class = 'col-1 btn btn-active left1 top1' @click='customise(1)'> <i class='fas fa-font'></i> </button>
                            <button  v-if='action!=1' class = 'col-1 btn lightgrey   left1 top1' @click='customise(1)'> <i class='fas fa-font'></i> </button>

                            <button v-if='action==2'  class = 'col-1 btn btn-active    left1 top1' @click='customise(2)'> <i class='fas fa-palette'></i> </button>
                            <button v-if='action!=2'  class = 'col-1 btn lightgrey   left1 top1' @click='customise(2)'> <i class='fas fa-palette'></i></button>

                            <button  v-if='action==3' class = 'col-1 btn btn-active left1 top1' @click='customise(3)'> <i class='fas fa-align-center'></i> </button>
                            <button  v-if='action!=3' class = 'col-1 btn lightgrey left1 top1' @click='customise(3)' > <i class='fas fa-align-center'></i> </button>

                            <!-- <button v-if='action==4'  class = 'col-1 btn btn-active    left1 top1' @click='customise(4)'> <i class='fas fa-columns'></i> </button>
                            <button v-if='action!=4'  class = 'col-1 btn lightgrey   left1 top1' @click='customise(4)'> <i class='fas fa-columns'></i> </button>  -->

                            <button v-if='action==6'  class = 'col-1 btn btn-active    left1 top1' @click='customise(6)'> <i class="fas fa-link"></i> </button>
                            <button v-if='action!=6'  class = 'col-1 btn lightgrey   left1 top1' @click='customise(6)'> <i class="fas fa-link"></i></button>

                            <button class = 'col btn btn-danger top1 left1' @click='deleteVariable(selected)'> <i class='fas fa-trash-alt'></i> </button>
                            <button class = 'col btn btn-light top1 left1' @click='closeEdit()'>Done</button>
                            </div>



                            <!-- edit actions -->

                            <div  v-if='action==1' class='col-12   padding1 top1 margin-v-auto'>

                                <select class='col-4 button left1' name="fonts" id="fonts" @change='font()'>
                                <option  value=isFont>@{{isFont}}</option>
                                <option v-if='isFont!="Arial"' value="Arial">Arial</option>
                                <option v-if='isFont!="Courier New"' value="Courier New">Courier New</option>
                                <option v-if='isFont!="Cursive"' value="Cursive">Cursive</option>
                                <option v-if='isFont!="Georgia"' value="Georgia">Georgia</option>
                                <option v-if='isFont!="Lucida Console"' value="Lucida Console">Lucida Console</option>
                                <option v-if='isFont!="Monaco"' value="Monaco">Monaco</option>
                                <option v-if='isFont!="Sans-serif"' value="Sans-serif">Sans-serif</option>
                                <option v-if='isFont!="Tahoma"' value="Tahoma">Tahoma</option>
                                <option v-if='isFont!="Times New Roman"' value="Times New Roman">Times New Roman</option>
                                <option v-if='isFont!="Trebuchet MS"' value="Trebuchet MS">Trebuchet MS</option>
                                <option v-if='isFont!="Verdana"' value="Verdana">Verdana</option>
                                </select>

                                <select class='button col-1 left1 centre' name="size" id="size" @change='size()'>

                                <option v-if='isSize!=30' value="30">30</option>
                                <option v-if='isSize==30' value="30" selected>30</option>

                                <option v-if='isSize!=20' value="20">20</option>
                                <option v-if='isSize==20' value="20" selected>20</option>

                                <option v-if='isSize!=18' value="18">18</option>
                                <option v-if='isSize==18' value="18" selected>18</option>


                                <option v-if='isSize!=16' value="16">16</option>
                                <option v-if='isSize==16' value="16" selected>16</option>

                                <option v-if='isSize!=14' value="14">14</option>
                                <option v-if='isSize==14' value="14" selected>14</option>

                                <option v-if='isSize!=12' value="12">12</option>
                                <option v-if='isSize==12' value="12" selected>12</option>

                                <option v-if='isSize!=10' value="10">10</option>
                                <option v-if='isSize==10' value="10" selected>10</option>

                                <option v-if='isSize!=8' value="8">8</option>
                                <option v-if='isSize==8' value="8" selected>8</option>
                                </select>

                            <button v-if='isBold!="bold"' class = 'col-1 btn lightgrey   left1 top1' @click='bold()'> <i class='fas fa-bold'></i> </button>
                            <button v-if='isBold=="bold"' class = 'col-1 btn left1 top1' @click='bold()'> <i class='fas fa-bold'></i></button>

                            <button v-if='isItalic!="italic"' class = 'col-1 btn lightgrey   left1 top1' @click='italic()'> <i class='fas fa-italic'></i> </button>
                            <button v-if='isItalic=="italic"' class = 'col-1 btn left1 top1' @click='italic()'> <i class='fas fa-italic'></i> </button>
                            </div>

                            <div v-if='action==2' class='col-12 top1'>

                            <div class="col-1 left1 top1" id='color-picker1'></div>
                            </div>

                            <div v-if='action==3' class='col-12 padding1 top1'>

                            <button v-if='alignPosition=="left"' class = 'col-1 btn    left1 top1' @click='align(0)'> <i class='fas fa-align-left'></i> </button>
                            <button v-if='alignPosition!="left"' class = 'col-1 btn lightgrey   left1 top1' @click='align(0)'> <i class='fas fa-align-left'></i> </button>

                            <button v-if='alignPosition=="right"'  class = 'col-1 btn    left1 top1' @click='align(1)' > <i class='fas fa-align-right'></i></button>
                            <button v-if='alignPosition!="right"' class = 'col-1 btn lightgrey   left1 top1' @click='align(1)' > <i class='fas fa-align-right'></i> </button>

                            <button v-if='alignPosition=="center"' class = 'col-1 btn    left1 top1' @click='align(2)'> <i class='fas fa-align-center'></i></button>
                            <button v-if='alignPosition!="center"' class = 'col-1 btn  lightgrey  left1 top1' @click='align(2)'> <i class='fas fa-align-center'></i></button>

                            <button v-if='alignPosition=="justify"'  class = 'col-1 btn    left1 top1' @click='align(3)'> <i class='fas fa-align-justify'></i> </button>
                            <button v-if='alignPosition!="justify"' class = 'col-1 btn lightgrey left1 top1' @click='align(3)'><i class='fas fa-align-justify'></i></button>
                            </div>


                            <div v-if='action==4' class='col-12  padding1 top1'>
                            <button class = 'col-1 btn left1  top1 lightgrey' @click='changeWidth(1)'><i class="fas fa-columns"></i> +</i></button>
                            <button class = 'col-1 btn left1  top1 lightgrey' @click='changeWidth(-1)'><i class="fas fa-columns"></i> -</i></button>
                            </div>



                            <!-- image -->
                            <div v-if='action==5' class='col-12  padding1 top1'>
                            <button class = 'col-1 border btn  top1 lightgrey' @click='changeimageSize(1)'><i class="fas fa-image"></i> +</i></button>
                            <button class = 'col-1 btn  top1 lightgrey' @click='changeimageSize(-1)'><i class="fas fa-image"></i> -</i></button>
                            </div>


                            <!-- add link -->

                            <div v-if='action==6' class='col-12 margin-v-auto border top1'>
                                <input class='col-8' type="text" placeholder='Add the url here' @keyup='addUrl' id='url' v-model='hasUrl'>
                            <!-- <button class='btn'> <b>cancel</b> </button> -->
                            </div>



                        </div>

                        <div v-if='selected!=null && fields[selected].image==true' class='col-12 shadow padding1 top1'>
                        <div class='col-12 left2 black'><small><b>Customise selection</b></small></div>
                            <div class='col-12'>
                            <button  class = 'col-1 btn  green  left1 top1' @click='reorderUp()'><i class='fas fa-caret-up'></i></button>
                            <button  class = 'col-1 btn  green  left1  top1' @click='reorderDown()'><i class='fas fa-caret-down'></i></button>

                            <button  v-if='action==3' class = 'col-1 btn btn-active left1 top1' @click='customise(3)'><i class='fas fa-align-center'></i></button>
                            <button  v-if='action!=3' class = 'col-1 btn lightgrey left1 top1' @click='customise(3)' > <i class='fas fa-align-center'></i></button>

                            <button v-if='action==5'  class = 'col-1 btn btn-active    left1 top1' @click='customise(5)'> <i class='fas fa-image'></i> +/-</button>
                            <button v-if='action!=5'  class = 'col-1 btn lightgrey   left1 top1' @click='customise(5)'> <i class='fas fa-image'></i> +/-</button>



                            <button class = 'col-1 btn btn-danger top1 left1' @click='deleteVariable(selected)'> <i class='fas fa-trash-alt'></i> </button>
                            <button class = 'col btn btn-light top1 left1' @click='closeEdit()'>Done</button>


                                <!-- edit actions -->

                                <div v-if='action==3' class='col-12 padding1 top1'>

                                <button v-if='alignPosition=="left"' class = 'col-1 btn    left1 top1' @click='align(0)'> <i class='fas fa-align-left'></i></button>
                                <button v-if='alignPosition!="left"' class = 'col-1 btn lightgrey   left1 top1' @click='align(0)'> <i class='fas fa-align-left'></i> </button>

                                <button v-if='alignPosition=="right"'  class = 'col-1 btn    left1 top1' @click='align(1)' > <i class='fas fa-align-right'></i></button>
                                <button v-if='alignPosition!="right"' class = 'col-1 btn lightgrey   left1 top1' @click='align(1)' > <i class='fas fa-align-right'></i></button>

                                <button v-if='alignPosition=="center"' class = 'col-1 btn    left1 top1' @click='align(2)'> <i class='fas fa-align-center'></i></button>
                                <button v-if='alignPosition!="center"' class = 'col-1 btn  lightgrey  left1 top1' @click='align(2)'> <i class='fas fa-align-center'></i> </button>

                                <button v-if='alignPosition=="justify"'  class = 'col-1 btn    left1 top1' @click='align(3)'> <i class='fas fa-align-justify'></i></button>
                                <button v-if='alignPosition!="justify"' class = 'col-1 btn lightgrey left1 top1' @click='align(3)'> <i class='fas fa-align-justify'></i> </button>
                                </div>


                                <div v-if='action==4' class='col-12  padding1 top1'>
                                <button class = 'col-1 btn  top1 lightgrey' @click='changeWidth(1)'><i class="fas fa-columns"></i> +</i></button>
                                <button class = 'col-1 btn  top1 lightgrey' @click='changeWidth(-1)'><i class="fas fa-columns"></i> -</i></button>
                                </div>

                                <div v-if='action==5' class='col-12 padding1 top1'>


                                <button class = 'col-1 btn   top1 lightgrey' @click='changeimageSize(1)'><i class="fas fa-image"></i> <small>+</small></button>
                                <button class = 'col-1 btn    top1 lightgrey' @click='changeimageSize(-1)'><i class="fas fa-image"></i><small>-</small> </button>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div  v-for='(f, index) in fields' class='fieldContainer top1'
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


            <button type='button' v-if='selected!=index && f.image==false' class = 'col-12 btn btn-light top1 field' @click='select(index)'
            :style='{ textAlign:  f.align,fontWeight:f.bold,fontStyle:f.italic,fontFamily:f.font,
            fontSize:f.size+"pt",color:f.color}'>
            @{{f.name}}
        </button>

        <button type='button' v-if='selected==index && f.image==false' class = 'col-12 btn btn-active2  top1 field' @click='select(index)'
        :style='{ textAlign:  f.align,fontWeight:f.bold,fontStyle:f.italic,fontFamily:f.font,
        fontSize:f.size+"pt",color:f.color}'>
        @{{f.name}}
    </button>

    <button type='button' v-if='selected!=index && f.image==true' class = 'col-12 btn btn-light top1 field' @click='select(index)'
    :style='{ textAlign:f.align}'
    >
    <img   :src="f.imageSrc" alt=""

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

<button type='button' v-if='selected==index && f.image==true' class = 'col-12 btn btn-active2 top1 field' @click='select(index)'
:style='{ textAlign:  f.align}'
>

<img   :src="f.imageSrc" alt=""
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

<div v-if='enableAdd==false' class="row left1 black top1">
<textarea class='lightgrey col-10' name="" id='newField'  rows="5"></textarea>
<button class='col-10 left1 btn btn-light top1 green' @click='addField()'>ok</button>
<button class='col-10 left1 btn btn-light top1 red' @click='cancelAdd'>cancel</button>
</div>

<div v-if='errorImage!=""' class='col-12 orange'><small>@{{errorImage}}</small></div>

</div>


<div v-if='enableAdd==true && fields!="" && selected==null' class="col-2 left2 left black p-2 fixed-bottom shadow" id='bottomMenu'>

<button class="col-12  left1 centre top1 btn btn-primary"  @click="addCounter" >+ Abc </button>


<label  class='top1 col-12 centre left1  btn btn-green' for="imageFile" > + <i class='far fa-image'></i></label>

    <input  type="file" id='imageFile' name="imageFile" hidden @change='selectImage'>

</div>

<button type='button' class="btn top1  black" @click='next(3)'> <i class='fas fa-caret-right'></i> Next</button>
</div>

<p v-if='fields==""'>No file uploaded</p>



</div>
</body>


