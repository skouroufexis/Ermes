
const { createApp } = Vue;

createApp({
    data() {
      return {
        sidemenuTitle: '',
        sidemenu:'',
        token:'',
        error:'',
        fileName:'',
        submitted:false,
        counter:0,
        enableAdd:true,
        fields:[],
        lastFieldIndex:'',
        selected:null,
        action:0,
        properties:[],
        alignPosition:'',
        isBold:'',
        isItalic:'',
        isFont:'',
        isSize:'',
        isColour:'',
        isColumn:'',
        isImageSize:'',
        imageCounter:0,
        errorImage:'',
        dataset:[],
        datasetIndex:0,
        datasetSize:'',
        hasUrl:'',
        recipient:'',



      }
    },

    methods: {
      activeSidemenu:function(n,title){
        this.sidemenu=n;
        this.sidemenuTitle=title;
      },

      //validates size & type
      validateFile:function(){

        let excelFile=document.getElementById('excelFile').files[0];

        //check size
        let size = excelFile.size;

        if(size>2000000){
          // excelFile.value='';
          this.error='Uploaded file must not exceed 2MB';
          this.fileName=excelFile.name;
        }
        else{
            //check type
            let data = new FormData();
            data.append('excelFile', excelFile);

            let url ='/checkType';
            fetch(url,{
              method:'POST',
              headers: {
                'X-CSRF-TOKEN': this.token
              },
              body:data
          })
          .then(x => x.json())
          .then(y=>{
            this.fileName=excelFile.name;
            if(y.isExcel==false){
              this.error='Please upload a valid Excel file';
            }
            else{
                this.error='';
                //submit form
                // document.getElementById('form_excel').submit();
                this.fileName=excelFile.name;
                this.loadVariables(excelFile);
              }
          });

        }
      },

      removeAttachment:function(){
        window.close();
        myWindow = window.open("/", "_blank");
      },


      next:function(n){
        this.sidemenu=n;

        switch(n) {
          case 2:
            this.sidemenuTitle= 'Customise Template';

            break;
            case 3:
              this.sidemenuTitle= 'Preview PDF';
              console.log(this.fields);
              break;
              default:
                this.sidemenuTitle='Email';
              }
            }
            ,
      select:function(n){

        if(this.selected!=n){

          this.action=0;
          this.selected=n;
          let field = this.fields[this.selected];
          this.alignPosition=field.align;
          this.isBold=field.bold;
          this.isItalic=field.italic;
          this.isFont=field.font;
          this.isSize=field.size;
          this.isColour=field.color;
          this.isColumn=field.column;
          this.hasUrl=field.hasUrl;

        }
        else{
            this.selected=null;
            this.action=0;
          }
        },

      closeEdit:function(){
        this.selected=null;

      },

      addCounter:function(){
        this.counter++;
        this.enableAdd=false;
        this.selected=null;

      },

      cancelAdd:function(){
        this.counter--;
        this.enableAdd=true;
      },

      addField:function(){

        
        //update lastFieldIndex
        this.lastFieldIndex++;
        this.enableAdd=true;
        let variableName=document.getElementById('newField').value;
        let newField= {image:false,initialIndex:this.lastFieldIndex, name:variableName, align:'center', bold:'normal',
        italic:'normal',color:'#000000',size:12,font:'Arial',
        column:'col-10',hasUrl:''}

        this.fields.push(newField);

        //add the new field to each record in dataset[]
        this.dataset.forEach(d => {
          d.push(newField.name);
      });


      console.log(this.fields);
      console.log(this.dataset);
    },

      deleteVariable:function(n){

        //get initialIndex
        console.log(this.fields[n].initialIndex);

        // delete the variable from fields[]
        this.fields.splice(n,1);
        this.selected=null;
        this.action=0;

        if(this.counter>0) {
          this.counter--;
        }


        console.log(this.dataset);
        console.log(this.fields);
      },
            
     customise:function(n){

            if(this.action==n){
              this.action=0;
            }
            else{
                this.action=n;
              }

              //load color picker
              if(n==2){
                setTimeout(() => {
                  this.loadColorPicker();
                }, 100);

              }
            },
    //reorders selected field upwards
      reorderUp:function(){

        //reorder if selected is not already at position 0
        if(this.selected!=0){
          let newIndex=this.selected-1;

          //place fields into new array
          let newFields=[];
          let c;

          for(c=0;c<this.fields.length;c++){
            if(c!=newIndex && c!=this.selected){
              newFields.push(this.fields[c]);
            }
            else if(c==newIndex){
                newFields.push(this.fields[c+1])
                newFields.push(this.fields[c]);
              }
            }

            //repopulate fields array
            this.fields=[];

            for(f of newFields){
              this.fields.push(f);
            }
            this.selected=newIndex;

            console.log(this.fields);
          }
        },

    //reorders selected field downwards
    reorderDown:function(){

      let totalFields=this.fields.length;

      //reorder if selected is not already at position totalFields
      if(this.selected!=totalFields-1){
        let newIndex=this.selected+1;

        //place fields into new array
        let newFields=[];
        let c;

        for(c=0;c<this.fields.length;c++){
          if(c<this.selected){
            newFields.push(this.fields[c]);
          }
          else if(c==this.selected) {
              newFields.push(this.fields[c+1]);
              newFields.push(this.fields[c]);
            }

            else if(c>=this.selected+2){
                newFields.push(this.fields[c]);
              }

            }

            //repopulate fields array
            this.fields=[];

            for(f of newFields){
              this.fields.push(f);
            }
            this.selected=newIndex;
          }
        },

          //aligns selected text
    align:function(n){


                let field = this.fields[this.selected];
                switch(n) {
                  case 0:
                    field.align='left';
                    this.alignPosition=field.align;
                    break;
                    case 1:
                      field.align='right';
                      this.alignPosition=field.align;
                      break;
                      case 2:
                        field.align='center';
                        this.alignPosition=field.align;
                        break;
                        default:
                          field.align='justify'
                          this.alignPosition=field.align;
                        }

                      },

  bold:function(){
    let field = this.fields[this.selected];
    this.isBold=field.bold;

    if(field.bold=='normal'){
      field.bold='bold';
    }
    else{
        field.bold='normal';
      }
      this.isBold=field.bold;

    },

  italic:function(){
    let field = this.fields[this.selected];
    this.isItalic=field.italic;

    if(field.italic=='normal'){
      field.italic='italic';
    }
    else{
        field.italic='normal';
      }
      this.isItalic=field.italic;

    },

  font:function(){
    let field = this.fields[this.selected];
    let selectedFont=document.getElementById('fonts').value;
    field.font=selectedFont;
    this.isFont=selectedFont;
  },

  size:function(){
    let field = this.fields[this.selected];
    let selectedSize=document.getElementById('size').value;
    field.size=selectedSize;
    this.isSize=selectedSize;
  },

//change column width of each field
  changeWidth:function(n){

    let field = this.fields[this.selected];

    let fieldColumn=field.column.split('-');
    fieldColumn=parseInt(fieldColumn[1]);


    if((fieldColumn+n)<=10 && (fieldColumn+n)>=1){

      fieldColumn=fieldColumn+n;
      fieldColumn='col-'+fieldColumn;
      console.log(fieldColumn);
      field.column=fieldColumn;
      this.isColumn=fieldColumn;
    }
  },

//adds url to a field
  addUrl:function(){
    let field = this.fields[this.selected];
    field.hasUrl=this.hasUrl;
    console.log(this.hasUrl)
  },

  changeimageSize:function(n){

    let field = this.fields[this.selected];

    let imageSize=field.imageSize.split('-');
    imageSize=parseInt(imageSize[1]);


    if((imageSize+n)<=12 && (imageSize+n)>=1){

      imageSize=imageSize+n;
      imageSize='col-'+imageSize;
      console.log(imageSize);
      field.imageSize=imageSize;
      this.isImageSize=imageSize;
    }


  },

  selectImage:function(){

    let image=document.getElementById('imageFile').files[0];


    //check file size
    let size = image.size;

    if(size>2000000){
      // excelFile.value='';
      this.errorImage='Uploaded image size must not exceed 2MB';

    }
    else{
        this.checkImageType(image);
      }
    },

  checkImageType:function(image){
    let url ='/imageType';

    let data = new FormData();
    data.append('imageFile', image);

    fetch(url,{
      method:'POST',
      headers: {
        'X-CSRF-TOKEN': this.token
      },
      body:data
  })
  .then(x => x.json())
  .then(async y=>{
    //populate excel file fields

    if(y.isImage==false){
      this.errorImage='Please select a valid image (png or jpeg)';
    }
    else{



        this.errorImage="";
        let reader=new FileReader();
        // let image=document.getElementById('imageFile').files[0];
        reader.readAsDataURL(image);
        reader.onload=()=>{

          //update lastFieldIndex
          this.lastFieldIndex++;
          let newImage= {image:true,imageName:'image'+this.imageCounter++,
          imageSrc:reader.result,
          initialIndex:this.lastFieldIndex,
          align:'center',column:'col-10',imageSize:'col-12'}

          this.fields.push(newImage);

          //add the new imageName to each record in dataset[]
          this.dataset.forEach(d => {
            d.push(newImage.imageName);
        });
        console.log(this.fields);
        console.log(this.dataset);
      }
    }
});
    },

  loadColorPicker:function(){
        const pickr = Pickr.create({
            el: '#color-picker1',
            theme: 'classic', // or 'monolith', or 'nano'
            default:this.isColour,
            defaultRepresentation: 'HEX',


            swatches: [
              'rgba(244, 67, 54, 1)',
              'rgba(233, 30, 99, 0.95)',
              'rgba(156, 39, 176, 0.9)',
              'rgba(103, 58, 183, 0.85)',
              'rgba(63, 81, 181, 0.8)',
              'rgba(33, 150, 243, 0.75)',
              'rgba(3, 169, 244, 0.7)',
              'rgba(0, 188, 212, 0.7)',
              'rgba(0, 150, 136, 0.75)',
              'rgba(76, 175, 80, 0.8)',
              'rgba(139, 195, 74, 0.85)',
              'rgba(205, 220, 57, 0.9)',
              'rgba(255, 235, 59, 0.95)',
              'rgba(255, 193, 7, 1)'
            ],

            components: {

              // Main components
              preview: true,
              opacity: true,
              hue: true,

              // Input / output Options
              interaction: {
                hex: false,
                rgba: false,
                hsla: false,
                hsva: false,
                cmyk: false,
                input: false,
                clear: false,
                save: false
              }
            }
        });

        pickr.on('init', instance => {

          //retrieve the saved colour selected by the user and assign it to
          // the colour picker
          let field = this.fields[this.selected];
          let fieldColor=field.color;
          instance.default=fieldColor;

      }).on('change', (color,source, instance) => {
        console.log('color:'+color.toHEXA() + ' instance: '+ instance);
        instance.applyColor();

        //assign colour to selected field
        let field = this.fields[this.selected];
        color=color.toHEXA();
        color="#"+color[0]+color[1]+color[2];
        field.color=color;
        this.isColour=field.color;

    })

  },

  //loads variables of excel file
  loadVariables:function(excelFile){

    let data = new FormData();
    data.append('excelFile', excelFile);


    let url ='/loadVariables';
    fetch(url,{
      method:'POST',
      headers: {
        'X-CSRF-TOKEN': this.token
      },
      body:data
  })
  .then(x => x.json())
  .then(y=>{
    console.log(y);
    console.log(y.variables);
    this.dataset=y.dataset;

    //set first record of dataset[] as the first recipient    
    for(d of this.dataset[0]){
      if(d.includes("@")){
        this.recipient=d;
      }
    }

    this.datasetSize=this.dataset.length;
    console.log(this.dataset);
    //populate excel file fields
    for( v of y.variables){

      
      let variable= {image:false,initialIndex:v.index, name:v.value, align:'center', bold:'normal',
      italic:'normal',color:'#000000',size:12,font:'Arial',
      column:'col-10',imageSize:'col-12',hasUrl:''}
      this.fields.push(variable);
    }

    //initialize lastFieldIndex
    this.lastFieldIndex=this.fields.length-1;
    console.log(this.fields);
});
  },

  nextRecord:function(){
     this.recipient='';
    if(this.datasetIndex<this.datasetSize-1)
    this.datasetIndex++;

    //reset the recipient
    for(d of this.dataset[this.datasetIndex]){
      if(d.includes("@")){
        this.recipient=d;
      }
      
    }

    console.log(this.dataset[this.datasetIndex])
  },

  previousRecord:function(){
    if(this.datasetIndex>0)
    this.datasetIndex--;

    //reset the recipient
    this.recipient='';
    for(d of this.dataset[this.datasetIndex]){
      if(d.includes("@")){
        this.recipient=d;
      }
      
    }

  },


    previewPdf:function(){
      let data={dataset:this.dataset,datasetIndex:this.datasetIndex,fields:this.fields};
      data=encodeURIComponent(JSON.stringify(data));
      const target = document.getElementById("pdfArea");



    //  Find all links inside the container before converting
    const linkElements = target.querySelectorAll('a[href]');
    const containerRect = target.getBoundingClientRect();   


      html2canvas(target).then(canvas => {
        const imgData = canvas.toDataURL("image/png");
        
        // Use canvas size as PDF size
        const pdf = new jspdf.jsPDF({
            orientation: canvas.width > canvas.height ? "landscape" : "portrait",
            unit: "px",
            format: [canvas.width, canvas.height]
        });

        // Add the image to fill the page
        pdf.addImage(imgData, "PNG", 0, 0, canvas.width, canvas.height);

        // . Calculate scaling ratio between HTML pixels and PDF millimeters
      const scaleX = canvas.width / containerRect.width;
      const scaleY = canvas.height / containerRect.height;

      // . Loop through each link and add it to the PDF coordinate space
    linkElements.forEach((link) => {
        const rect = link.getBoundingClientRect();
        const href = link.getAttribute('href');
        const targetAttr = link.getAttribute('target');

        // Calculate position relative to the container
        const x = (rect.left - containerRect.left) * scaleX;
        const y = (rect.top - containerRect.top) * scaleY;
        const w = rect.width * scaleX;
        const h = rect.height * scaleY;

        // Add clickable link annotation to jsPDF
        pdf.link(x, y, w, h, { url: href });
    });
        
        // Open in new tab
        const pdfUrl = pdf.output("bloburl");
        const win = window.open(pdfUrl, "_blank");

        //check if popups are enabled
        if (!win || win.closed || typeof win.closed === "undefined") {
            console.log("Popup was blocked");
            alert("Please allow popups to view the PDF.");
          } else {
            console.log("Popup opened successfully");

          }
      });



    },

    downloadPdf:function(){


    let data={dataset:this.dataset,datasetIndex:this.datasetIndex,fields:this.fields};
      data=encodeURIComponent(JSON.stringify(data));
      const target = document.getElementById("pdfArea");


    // 1. Find all links inside the container before converting
    const linkElements = target.querySelectorAll('a[href]');
    const containerRect = target.getBoundingClientRect();   


      html2canvas(target).then(canvas => {
        const imgData = canvas.toDataURL("image/png");
        
        // Use canvas size as PDF size
        const pdf = new jspdf.jsPDF({
            orientation: canvas.width > canvas.height ? "landscape" : "portrait",
            unit: "px",
            format: [canvas.width, canvas.height]
        });

        // Add the image to fill the page
        pdf.addImage(imgData, "PNG", 0, 0, canvas.width, canvas.height);

      // . Calculate scaling ratio between HTML pixels and PDF millimeters
      const scaleX = canvas.width / containerRect.width;
      const scaleY = canvas.height / containerRect.height;


       // . Loop through each link and add it to the PDF coordinate space
    linkElements.forEach((link) => {
        const rect = link.getBoundingClientRect();
        const href = link.getAttribute('href');
        const targetAttr = link.getAttribute('target');

        // Calculate position relative to the container
        const x = (rect.left - containerRect.left) * scaleX;
        const y = (rect.top - containerRect.top) * scaleY;
        const w = rect.width * scaleX;
        const h = rect.height * scaleY;

        // Add clickable link annotation to jsPDF
        pdf.link(x, y, w, h, { url: href });
    });

        pdf.save(this.recipient+'.pdf');
      });

    },


    email: async function(){
      
       await this.downloadPdf();

       setTimeout(() => {
        window.location.href = "mailto:"+this.recipient.trim(); 
       }, 1500);
              

     
       
      
    },
                    },
  mounted:function(){
    this.sidemenu=1;
    this.sidemenuTitle='Upload Excel file';
    this.token=document.getElementById('token').getAttribute('token');
  }
}).mount('#vue');






