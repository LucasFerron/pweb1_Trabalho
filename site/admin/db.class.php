<?php

class db {

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $port = "3306";
    private $dbname ="bancotrabalhopweb1";
    private $table_name;

    public function __construct($table_name){
        $this->table_name = $table_name;
        return $this->conn();
    }

    function conn(){

        try{
            $conn = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                $this->user,
                $this->password,
                [
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"
                ]
            );

            return $conn;

        } catch(PDOException $e){
            echo "Erro: ". $e->getMessage();
        }
    }



    public function all(){
        $conn = $this->conn(); 

        $sql = "SELECT * FROM $this->table_name";

        $st = $conn->prepare( $sql);
        $st->execute();

        return $st->fetchAll(PDO::FETCH_CLASS);
    }



    public function store($dados){
        unset($dados['id']);
        $conn = $this->conn(); 

        
        $sql = "INSERT INTO $this->table_name (";
        $flag = 0;
        $arrayDados = [];
        foreach($dados as $campo => $valor){
            if($flag ==0){
                $sql .= "$campo";
            } else {
                $sql .= ", $campo";
            }
            $flag = 1;
        }

        $sql .=") VALUES (";

        $flag = 0;
        foreach($dados as $campo => $valor){
            if($flag ==0){
                $sql .= "?";
            } else {
                $sql .= ", ?";
            }
            $flag = 1;
            $arrayDados[] = $valor;
        }

        $sql .=") ";

        $st = $conn->prepare(query: $sql);
        $st->execute($arrayDados);
    }



    public function update($dados, $id) {
        
    $conn = $this->conn(); 

    $sql = "UPDATE $this->table_name SET ";
    $arrayDados = [];
    $flag = 0;

    foreach ($dados as $campo => $valor) {
        if ($campo == 'id') continue; // ignora o campo id
        if ($flag == 0) {
            $sql .= "$campo = ?";
        } else {
            $sql .= ", $campo = ?";
        }
        $arrayDados[] = $valor;
        $flag = 1;
    }

    $sql .= " WHERE id = ?";  // condição final
    $arrayDados[] = $id;      // adiciona o id como último valor para o WHERE

    $st = $conn->prepare($sql);
    $st->execute($arrayDados);
}


    public function find($id){

        $conn = $this->conn(); 

        $sql = "SELECT * FROM $this->table_name WHERE id = ?";

        $st = $conn->prepare( $sql);
        $st->execute([$id]);

        return $st->fetchObject();
    }




    public function destroy($id){
        $conn = $this->conn();

        $sql = "DELETE FROM $this->table_name WHERE id = ?";

        $st = $conn->prepare( $sql);
        $st->execute([$id]);
    }



    public function search($dados){

        $campo = $dados['tipo'];
        $valor = $dados['valor'];

        $conn = $this->conn();

        $sql = "SELECT * FROM $this->table_name WHERE $campo LIKE ?";

        $st = $conn->prepare( $sql);
        $st->execute(["%$valor%"]);

        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function login($dados){

        $conn = $this->conn(); 

        $sql = "SELECT * FROM $this->table_name WHERE email = ?";

        $st = $conn->prepare( $sql);
        $st->execute([$dados['email']]);

        $result = $st->fetchObject();

        if($result && password_verify($dados['senha'], $result->senha)){
            return $result;
        } else {
            return "error";
        }
    }

    public function where($conditions) {
    $conn = $this->conn();
    $sql = "SELECT * FROM $this->table_name WHERE ";

    $clauses = [];
    $values = [];

    foreach ($conditions as $column => $value) {
        $clauses[] = "$column = ?";
        $values[] = $value;
    }

    $sql .= implode(' AND ', $clauses);

    $st = $conn->prepare($sql);
    $st->execute($values);

    return $st->fetchAll(PDO::FETCH_CLASS);
}

}