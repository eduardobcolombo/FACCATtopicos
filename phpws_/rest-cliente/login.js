//host do recurso
var host="https://fit.faccat.br/~rodjle/phpws/api"



//ao dar um submit no #frm
$(document).on("click", "#btnLogin", function () {   
        
        var user=$('#user').val();
        var pass=$('#pass').val();
      
        $(".erro").html('');
        $(".sucesso").html('');
    
        //Requisição GET usando Jquery/Ajax 
        
        if (user=='' || pass==''){
          $("#frmLogin .erro").html('*** Informe usuario e senha ***');     
        }else {
            //pega os valores que estão nos campos , usando IDs
           var formData={
            'user':user,
            'pass':pass
           }    
            
          $.ajax({
             url:host+'/login',
             type:'POST',                    
             data:JSON.stringify(formData),
             success: function(data) {
             console.log(data[0]);
                 var decoded = jwt_decode(data[0]);
                 //console.log(decoded);
                 window.localStorage.setItem('token',data[0]);
                 
                 document.location.href='index.html'
            }         
        });
     }
});

