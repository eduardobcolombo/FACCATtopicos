<?php    

    define('KEY','MY_SECRET_KEY');
    require  './vendor/autoload.php';
    use \Firebase\JWT\JWT;
    date_default_timezone_set('America/Sao_Paulo');

    

 /*  if (verificaToken('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.'.
               'eyJpZCI6MTIzLCJ1c2VyIjoic2EiLCJwZXJmaWwiOi'.
                    'JBIiwiaWF0IjoxNDkzOTk5MDU2LCJleHAiOjE0OTM5OTkzNTZ9.'.
                    'GZ1HCECFq68wMzGjfuqVkfDfa93t5iso6Jl1NkjZClI') ==false){
      echo 'xxx';
   }*/
  
   

    //ao fazer login token é gerado
    function getToken($userId,$perfil,$userName) {
         
        $now =time();
        $exp=time()+60;//expira em 1 min
    
        $token = array(
            "id" =>$userId ,
            "user" => $userName,
            "perfil" => $perfil,
            "iat"=>$now,
            "exp" => $exp
        );
        
        //gera token
        return JWT::encode($token, KEY);   
    }
 
    
    
    //ao tentar decofidicar é verificado se o token é integro e se não expirou
    function verificaToken($token){
        try{
           
            $decoded = JWT::decode($token, KEY, ['HS256']);
            return true;
        
        }
            catch (\Firebase\JWT\ExpiredException $e) {
            return false;
                
        } catch (Exception $e) {
            return false;
        }
        
        return false;
    
    }
   
  



    ?>
