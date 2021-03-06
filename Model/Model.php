<?php
namespace Models;
use PDO;
class Model {

public function __construct(){
$this->usuario = 'bf00fc7e826f36';
$this->senha ='f5f495c1';
$this->host = 'us-cdbr-iron-east-05.cleardb.net';
}
public function create_table($sintexe,$campos){
    try {
    $connection = new PDO("mysql:host=".$this->host.";dbname=heroku_59fa39afa14a72d", $this->usuario, $this->senha);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connection->prepare($sintexe)->execute($campos);

    }catch(PDOException $e){
     return "Falha na conexão:".$e->getMessage();   
    }
}

public function select($sintexe,$campos){
    try {
    $connection = new PDO("mysql:host=".$this->host.";dbname=heroku_59fa39afa14a72d", $this->usuario, $this->senha);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query= $connection->query($sintexe);
    if($query->rowCount() > 0){
        // CREATE POSTS ARRAY
        $carros = [];
        
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            
            $carros_data = [
                'id' => $row['id'],
                'modelo' => $row['modelo'],
                'marca' => $row['marca'],
                'ano' => $row['ano']
            ];
          
            array_push($carros, $carros_data);
        }
    
        echo json_encode($carros);
     
    
    }
    else{
       
        echo json_encode(['message'=>'Sem dados']);
    }

    
    }catch(PDOException $e){
     return "Falha na conexão:".$e->getMessage();   
    }
}
public function query($sintexe,$campos,$tipo){
    try {
    $connection = new PDO("mysql:host=".$this->host.";dbname=heroku_59fa39afa14a72d", $this->usuario, $this->senha);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query= $connection->prepare($sintexe);
    $query->execute($campos);
    if($tipo == 1)
   echo json_encode(["message"=>"Cadastro efetuado com sucesso"]);
    else if($tipo ==2){
        echo  json_encode(["message"=>"Atualização efetuado com sucesso"]);
    }else{
        echo json_encode(["message"=>"Exclusão efetuado com sucesso"]);   
    } 
    }catch(PDOException $e){
     return "Falha na conexão:".$e->getMessage();   
    }
}
}
?>
