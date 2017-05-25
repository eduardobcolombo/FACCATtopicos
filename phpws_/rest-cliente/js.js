//host do recurso
var host="https://fit.faccat.br/~rodjle/phpws/api"


//monta tabela
var montaTabela=function(data){
    var html="";
    
    //verifica se tem algum dado
    
    if (data.length>0){
        html="<fieldset><legend>Resultado da Pesquisa</legend>";
        html+="<table>";
    
        html+="<tr>";
        html+="<th>Codigo</th>";
        html+="<th>Descricao</th>";
        html+="<th>UF</th>";
        html+="</tr>";
    
        //loop municipios
        for (var k in data) {
          if (k>0) { //primeira posição não tem informação
              
           var cidade=data[k];//json   
           
           html+="<tr>";
           html+="<td>"+cidade.CODIGO+"</td>";
           html+="<td>"+cidade.DESCRICAO+"</td>";
           html+="<td>"+cidade.UF+"</td>";
           html+="</tr>";
          }
        }
    
        html+="</table>";
                html+="</fieldset>";

    }
    
    return html;
}


//Jquery ao clicar no botão consultar 
$(document).on("click", "#btnConsultar", function () {   
     verificaToken();
     var cidade= $("#txtCidade").val();    
     
     console.log(cidade);
    
     $(".erro").html('');
     $(".sucesso").html('');
     
     if (cidade==''){
        $("#frmConsulta .erro").html('*** Informe a cidade ***');     
     }else {
     
        //Requisição GET usando Jquery/Ajax 
        $.ajax({
            url:host+'/municipios/descricao/'+cidade,
            type:'GET',                    
            data:{},
            headers: {
                 "Authorization":window.localStorage.getItem('token')
            },
            //quando houver sucesso
            success: function(data) {
                var tabela=montaTabela(data);                
                //monta a tabela e repassa a div #lista
                $("#lista").html(tabela); 
            },
            //quando houver um erro
            error:function(xqr)  {
               console.log(xqr);
               $("#frmConsulta .erro").html(xqr.responseJSON+'-'+xqr.statusText);                
               $("#lista").html('');   
               //remove token
               window.localStorage.removeItem('token');
            }         
        });
     }
    
});


//ao dar um submit no #frm
$(document).on("click", "#btnIncluir", function () {   
        verificaToken();   
        var descricao=$('#txtDescricao').val();
        var uf=$('#txtUF').val();
      
        $(".erro").html('');
        $(".sucesso").html('');
    
        //Requisição GET usando Jquery/Ajax 
        
        if (descricao=='' || uf==''){
          $("#frmIncluir .erro").html('*** Informe a cidade e uf ***');     
        }else {
            //pega os valores que estão nos campos , usando IDs
           var formData={
            'CODIGO':0,
            'DESCRICAO': descricao,
            'UF': uf
           }    
            
          $.ajax({
             url:host+'/municipios/novo',
             type:'POST',                    
             data:JSON.stringify(formData),
             headers: {
                 "Authorization":window.localStorage.getItem('token')
             },
              
             //quando houver sucesso
             success: function(data) {
                console.log(data);
                
                var tabela=montaTabela(data);
                
                //monta a tabela e repassa a div #lista
                $("#lista").html(tabela);      
                $('#txtDescricao').val('');
                $('#txtUF').val('');                
                $('#txtDescricao').focus();                
                $(".sucesso").html('Cadastro realizado com sucesso!');
            },
            //quando houver um erro
            error:function(xqr)  {
               console.log(xqr);
               $("#frmIncluir .erro").html(xqr.responseJSON+'-'+xqr.statusText);                
               $("#lista").html('');   
               //remove token
               window.localStorage.removeItem('token');
            }
          })
        }
     
});



var verificaToken=function(){
    if (window.localStorage.getItem('token')===null) {           
        document.location.href='login.html'
    }
}


$(window).on( "load", function() {    
  verificaToken();     
  
})

