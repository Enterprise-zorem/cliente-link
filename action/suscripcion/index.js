
  var plans = new Vue({    
      el: "#main-wrapper",   
      data:{     
           plans:[],
           id:0,
           },
   methods:{  
    btnUpgrade:function(id){
        axios.interceptors.request.use((config) => {
            Swal.fire({
              title: 'Procesando'
          });
          Swal.showLoading();
          return config;
        });
        axios.post(RUTA+"process.php/suscripcion/paypal", {id:id}).then(response =>{
          Swal.close();
          if(response['data']['status']==="ERROR")
          {
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000
            });
            Toast.fire({
              type: 'warning',
              title: response['data']['message']
            });
          }
          else
          {
            location.href=response['data']['message'];
          }
          
         
      });
    },
      //PROCEDIMIENTOS para el CRUD   
      listarplans:function(){
          axios.post(RUTA+"process.php/suscripcion/list", {}).then(response =>{
              console.log(response.data);
             this.plans = response.data;  
          });
      },
  
   },
   created: function(){            
      this.listarplans();            
   },
   computed:{
      
  }  
  
  });