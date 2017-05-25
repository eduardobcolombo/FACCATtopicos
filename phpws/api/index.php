<?php

header('Access-Control-Allow-Origin: *');  

//echo getMunicipios();
require './Slim/Slim/Slim.php';



\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
header('Access-Control-Allow-Origin: *');
$app->response()->header('Content-Type', 'application/json;charset=utf-8');



//métodos
$app->get('/', 'hello');
$app->get('/municipios','getMunicipios');
$app->get('/municipios/descricao/:descricao','localizaPorDescricao');
$app->post('/municipios/novo','addMunicipio');
$app->run();


function hello(){
	echo 'Hello';
}

//Localiza por descrição 
function localizaPorDescricao($descricao)
{
  try {
   $tuplas[] ='';
   require("banco.php");
   mysqli_set_charset($conexao, 'utf8');
   $sql = "SELECT * FROM MUNICIPIO where descricao like '%".$descricao."%' order by descricao";
   //$sql = "SELECT * FROM MUNICIPIO where descricao='$descricao'";
   $recursoExec = mysqli_query($conexao,$sql);
   if ($recursoExec) {
      
      while($dados = mysqli_fetch_assoc($recursoExec)) {
        $tuplas[] = $dados;
      }     	
      echo json_encode($tuplas);      	
   }
  }catch(Exception $e){
   echo '{{"erro":'.  $e->getMessage() .'}}';
  }

}


$app->get('/municipios','getMunicipios');

//Retorna dos os munícipios
function getMunicipios()
{
   $tuplas[] ='';
   require("banco.php");
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
  require("banco.php");
  $tuplas[] ='municipios';
  $request =\Slim\Slim::getInstance()->request();
  $municipio = json_decode($request->getBody());
  try {
    $sql = "INSERT INTO MUNICIPIO (descricao,uf) values ('$municipio->DESCRICAO','$municipio->UF') ";
    mysqli_query($conexao,$sql);
    
    $municipio->CODIGO = mysqli_insert_id($conexao);
    
    $tuplas[]=$municipio;
    echo json_encode($tuplas);
  }catch(Exception $e){
   echo '{{"erro":'.  $e->getMessage() .'}}';
  }
  
}



?>