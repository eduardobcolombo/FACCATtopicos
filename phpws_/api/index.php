<?php

header('Access-Control-Allow-Origin: *');  


//echo getMunicipios();
require './Slim/Slim/Slim.php';
require_once("auth.php");    

      


\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();




$app->response()->header('Content-Type', 'application/json;charset=utf-8');



//métodos
$app->get('/', 'hello');
$app->post('/login','login');
$app->get('/municipios','getMunicipios');
$app->get('/municipios/descricao/:descricao','localizaPorDescricao');
$app->get('/municipios/id/:id','localizaPorId');
$app->post('/municipios/novo','addMunicipio');
$app->delete('/municipios/excluir/:id','excluiMunicipio');
$app->run();



function hello(){
	echo 'Hello';
}

//Localiza por descrição 
function localizaPorDescricao($descricao)
{
  try {
   //token enviado no header
   $token=apache_request_headers()["Authorization"];
      
      
   //request e response
   $response =\Slim\Slim::getInstance()->response();
        
   //valida o token, caso de um erro joga uma exceção do tipo Exception
   validaToken($response,$token);
                    
   require("banco.php");
      
   $tuplas[] ='';
   
   mysqli_set_charset($conexao, 'utf8');
   $sql = "SELECT * FROM MUNICIPIO where descricao like '%".$descricao."%' order by descricao";
   
   $recursoExec = mysqli_query($conexao,$sql);
   if ($recursoExec) {
      
      while($dados = mysqli_fetch_assoc($recursoExec)) {
        $tuplas[] = $dados;
      }     	
      echo json_encode($tuplas);      	
   }
  }catch(Exception $e){
   echo json_encode($e->getMessage());
  }

}

//Localiza por Id
function localizaPorId($id)
{
   require("banco.php");
   $tuplas[] ='';
   mysqli_set_charset($conexao, 'utf8');
   $sql = "SELECT * FROM MUNICIPIO where codigo=$id";
   $recursoExec = mysqli_query($conexao,$sql);
   
   if ($recursoExec) {      
      while($dados = mysqli_fetch_assoc($recursoExec)) {
        $tuplas[] = $dados;
      }
      echo json_encode($tuplas);
   }
}

//Exclusão de municípios
function excluiMunicipio($id)
{
 try {
   require("banco.php");
   mysqli_set_charset($conexao, 'utf8');
   $sql = "delete FROM MUNICIPIO where codigo=$id";
   $recursoExec = mysqli_query($conexao,$sql);
   echo '{{"sucesso":Ok}}';
 }catch(Exception $e){
   echo '{{"erro":'.  $e->getMessage() .'}}';
  }
}

$app->get('/municipios','getMunicipios');

//Retorna dos os munícipios
function getMunicipios()
{
     require("banco.php");
   $tuplas[] ='';
   mysqli_set_charset($conexao, 'utf8');
   $sql = "SELECT * FROM MUNICIPIO ";
   $recursoExec = mysqli_query($conexao,$sql);
   if ($recursoExec) {
      
      while($dados = mysqli_fetch_assoc($recursoExec)) {
        $tuplas[] = $dados;
      }
      //codifica no formato json
      echo json_encode($tuplas);
   }
}

//Insere um municipío
function addMunicipio()
{
 
   
  try {
        //token enviado no header
        $token=apache_request_headers()["Authorization"];
      
        //request e response
        $request =\Slim\Slim::getInstance()->request();
        $response =\Slim\Slim::getInstance()->response();
        
        //valida o token, caso de um erro joga uma exceção do tipo Exception
        validaToken($response,$token);
        
        require("banco.php");
        $tuplas[]='municipio';
      
        //retorna  os dados informado em formData
        $municipio = json_decode($request->getBody());
    
        $sql = "INSERT INTO MUNICIPIO (descricao,uf) values ('$municipio->DESCRICAO','$municipio->UF') ";
        mysqli_query($conexao,$sql);
    
        //retorna o id gerado pelo auto_increment
        $municipio->CODIGO = mysqli_insert_id($conexao);
    
        $tuplas[]=$municipio;
      
        //retorna status 201
        $response->setStatus(201);
        
        //retorna json
        echo json_encode($tuplas);
  
  }catch(Exception $e){
    
     echo json_encode($e->getMessage());
  
  }
  
}


//realiza login
function login()
{
  $request =\Slim\Slim::getInstance()->request();
  $usuario = json_decode($request->getBody());
  
  //getToken proveniente de auth.php
  $ret[] =getToken(123,'A',$usuario->user);
  
  echo json_encode($ret);    
    
}


 //valida token
function validaToken($response,$token){
    //verificaToken é proveniente de auth.php
    if (!verificaToken($token)) {  
        $response->setStatus(401);
        throw new Exception('Token Invalido');
    }
     
}



?>