$(document).on('click','ul li',function(){
  $(this).addClass('active').siblings().removeClass('active');

});
$(document).ready(function () {
 
  var clipboard =  new ClipboardJS('.btn');
  clipboard.on('success', function(e) {
      e.clearSelection();
      const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });
        Toast.fire({
          icon: 'success',
          title: '¡Link Copiado en el Portapapeles!'
        }); 
  });
});

var links = new Vue({    
    el: "#main-wrapper",   
    data:{     
         links:[],
         activities:[],         
         title:"Seleccione",
         link:"",
         token0:"",
         token:"",
         token2:"",
         created_at:"",
         counter:0,
         enabled:"",
         total:0,
         id:0,
         nombre:"",
         url:"",
         numero:"",
         mensaje:"",
         qrcode: new QRious({ size: 100 }),
         qrcode2: new QRious({ size: 100 }),
        },
 methods:{
    btnNuevoLink:async function(){                    
        const {value: formValues} = await Swal.fire({
        title: 'CREAR NUEVO LINK',
        html:
        '<div class="row"><label class="col-sm-3 col-form-label">Nombre</label><div class="col-sm-7"><input style="color:black;" id="home__nombre" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Long URL</label><div class="col-sm-7"><input  style="color:black;" id="home__url" type="text" class="form-control"></div></div><div class="row"></div></div>',              
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Guardar',          
        confirmButtonColor:'#1cc88a',          
        cancelButtonColor:'#3085d6',  
        preConfirm: () => {            
            return [
              this.nombre = document.getElementById('home__nombre').value,
              this.url = document.getElementById('home__url').value
            ]
          }
        });
        if(this.nombre == "" || this.url == ""){
          //datos vacios
        }       
        else{          
          this.insertlink();
        }  
       
    },
    btnNuevoWsp:async function(){                    
        const {value: formValues} = await Swal.fire({
        title: 'CREAR NUEVO WSP',
        html:
        '<div class="row"><label class="col-sm-3 col-form-label">Nombre</label><div class="col-sm-7"><input style="color:black;" id="home__nombre" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Numero</label><div class="col-sm-7"><input style="color:black;" id="home__numero" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Mensaje</label><div class="col-sm-7"><textarea style="color:black;" class="form-control" id="home__mensaje"></textarea></div></div><div class="row"></div></div>',              
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Guardar',          
        confirmButtonColor:'#1cc88a',          
        cancelButtonColor:'#3085d6',  
        preConfirm: () => {            
            return [
              this.nombre = document.getElementById('home__nombre').value,
              this.numero = document.getElementById('home__numero').value,
              this.mensaje = document.getElementById('home__mensaje').value                   
            ]
          }
        })        
        if(this.nombre == "" || this.numero == ""){
                //datos vacios
        }       
        else{          
          this.insertwsp();
        }
    },
    btnEditarURL:async function(id, nombre, url){
      if(this.link==="")
      {
        Swal.fire({
          type: 'info',
          title: 'Seleccione un Elemento',                                    
        })
        exit();
      }                       
      await Swal.fire({
      title: 'EDITAR',
      html:
      '<div class="row"><label class="col-sm-3 col-form-label">Nombre</label><div class="col-sm-7"><input style="color:black;" id="home__nombre" value="'+nombre+'" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">links.pe/</label><div class="col-sm-7"><input  style="color:black;" id="home__url" value="'+url+'" type="text" class="form-control"></div></div><div class="row"></div></div>',              
      focusConfirm: false,
      showCancelButton: true,                         
      }).then((result) => {
        if (result.value) {
          this.id=id;                                       
          this.nombre = document.getElementById('home__nombre').value,    
          this.url = document.getElementById('home__url').value
          if(this.nombre == "" || this.url == ""){
            Swal.fire({
              type: 'info',
              title: 'Datos incompletos',                                    
            }) 
          }       
          else{          
            this.editarlink();
          }
        }
      });
      
  },
    editarlink:function(){
      axios.post(RUTA+"process.php/home/edit", { title:this.nombre, link:this.url, id:this.id }).then(response =>{
          //this.listar();
          console.log(response);    

          if(response['data']==="defaultValue")
          {
              const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000
                });
                Toast.fire({
                  type: 'success',
                  title: '¡Link Modificado!'
                });
                this.title=this.nombre;
                this.token=RUTA_TOKEN+this.url;
                this.token2=RUTA_TOKEN2+this.url;
                this.token0=this.url;
          }
          else
          {
              const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000
                });
                Toast.fire({
                  type: 'warning',
                  title: response['data']
                })
          }
          this.listarlinks();
      });    
      
  },
    btnBorrarLink:function(){
        
        if(this.title==="Seleccione")
        {
            Swal.fire({
                type: 'info',
                title: 'Por Favor Seleecione un Elemento',                                    
              });
            exit();
        }
        Swal.fire({
          title: '¿Está seguro de borrar el registro: '+this.title+" ?",         
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor:'#d33',
          cancelButtonColor:'#3085d6',
          confirmButtonText: 'Borrar'
        }).then((result) => {
          if (result.value) {            
            this.borrarlink();             
          }
        })                
    }, 
    //PROCEDIMIENTOS para el CRUD   
    listarlinks:function(){
        axios.post(RUTA+"process.php/home/list", {}).then(response =>{
            console.log(response.data);
           this.links = response.data;  
        });
    },
    listaractivities:function(){
        axios.post(RUTA+"process.php/home/activities", {id:this.id}).then(response =>{
            console.log(response.data);
           this.activities = response.data;  
        });
    },
    clicklink:function(id,title,link,created_at,counter,enabled,token){
        //alert(id);
        this.id=id;
        this.title=title;
        this.link=link;
        this.created_at=created_at;
        this.counter=counter;
        this.enabled=enabled;
        this.token0=token;
        this.token=RUTA_TOKEN+token;
        this.token2=RUTA_TOKEN2+token;

        this.listaractivities();
    },
    //Procedimiento INSERT.
    insertlink:function(){
        axios.post(RUTA+"process.php/home/link", { title:this.nombre, link:this.url }).then(response =>{
            //this.listar();
            console.log(response);    
            this.nombre = "",
            this.url = ""

            if(response['data']==="defaultValue")
            {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                  });
                  Toast.fire({
                    type: 'success',
                    title: '¡Link Creado!'
                  }) 
            }
            else
            {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                  });
                  Toast.fire({
                    type: 'warning',
                    title: response['data']
                  })
            }
            this.listarlinks();
        });    
        
    },
    //INSERT WSP
    insertwsp:function(){
        axios.post(RUTA+"process.php/home/wsp", { title:this.nombre, numero:this.numero,mensaje:this.mensaje }).then(response =>{
            //this.listar();
            console.log(response);    
            this.nombre = "",
            this.numero = "",
            this.mensaje=""

            if(response['data']==="defaultValue")
            {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                  });
                  Toast.fire({
                    type: 'success',
                    title: '¡Link Creado!'
                  }) 
            }
            else
            {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                  });
                  Toast.fire({
                    type: 'warning',
                    title: response['data']
                  })
            }
            this.listarlinks();
        });    
        
    },
     //Procedimiento BORRAR.
    borrarlink:function(id){
        axios.post(RUTA+"process.php/home/delete", { id:this.id}).then(response =>{           
            
            if(response['data']==="defaultValue")
            {
                Swal.fire(
                    '¡Eliminado!',
                    'El registro ha sido borrado.',
                    'success'
                );
                this.id="";
                this.title="Seleccione";
                this.link="";
                this.created_at="";
                this.counter=0;
                this.enabled="";
                this.token="";

            }
            else
            {   console.log(response['data']);
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                  });
                  Toast.fire({
                    type: 'warning',
                    title: response['data']
                  });
            }
            this.listarlinks();
        });
    }

 },
 created: function(){            
    this.listarlinks();            
 },
 computed:{
    totalClicks(){
        this.total = 0;
        for(rows of this.links){
            this.total = this.total + parseInt(rows.counter);
        }
        return this.total;   
    },
    newQRCode() {
      this.qrcode.value = this.token;
      return this.qrcode.toDataURL();
    },
    newQRCode2() {
      this.qrcode2.value = this.token2;
      return this.qrcode2.toDataURL();
    },
}  

});