<?php
namespace core\classes;

use Exception;
use PDO;
use PDOException;

class Database{

    private $ligacao;

    //============================================================
    private function ligar(){
        //ligar o banco de dados
        $this->ligacao = new PDO(
            'mysql:'.
            'host='.MYSQL_SERVER.';'.
            'dbname='.MYSQL_DATABASE.';'.
            'charset='.MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );

        // debug
        $this->ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //============================================================
    private function desligar(){
        $this->ligacao = null;
    }

    //============================================================
    //CRUD
    //============================================================
    /**
     * @throws Exception
     */
    public function select($sql, $parametros = null) {

        //verifica se é uma instrução SELECT
        IF(!preg_match("/^SELECT/i", $sql)){
            throw new Exception('Base de dados - Não é uma instrução SELECT.');
        }

        //liga
        $this->ligar();

        $resultados = null;

        try {
            //comunicação com a bd
            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                $resultados = $executar->fetchAll(\PDO::FETCH_CLASS);
            }
        } catch (PDOException $e) {

            // caso exista erro
            return false;
        }

        //desligar a base de dados
        $this->desligar();

        //devolver os resultados obtidos
        return $resultados;
    }

    //============================================================

    /**
     * @throws Exception
     */
    public function insert($sql, $parametros = null){

        //verifica se é uma instrução insert
        if (!preg_match("/^INSERT/i", $sql)) {
            throw new Exception('Base de dados - Não é uma instrução INSERT.');
        }

        //liga
        $this->ligar();

        try {
            //comunicação com a bd
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            // caso exista erro
            return false;
        }

        //desligar a base de dados
        $this->desligar();
    }

    //============================================================


    /**
     * @throws Exception
     */
    public function update($sql, $parametros = null)
    {

        //verifica se é uma instrução UPDATE
        if (!preg_match("/^UPDATE/i", $sql)) {
            throw new Exception('Base de dados - Não é uma instrução UPDATE.');
        }

        //liga
        $this->ligar();

        try {
            //comunicação com a bd
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {

            // caso exista erro
            return false;
        }

        //desligar a base de dados
        $this->desligar();
    }

    //============================================================
    public function delete($sql, $parametros = null)
    {

        //verifica se é uma instrução DELETE
        if (!preg_match("/^DELETE/i", $sql)) {
            throw new Exception('Base de dados - Não é uma instrução DELETE.');
        }

        //liga
        $this->ligar();

        try {
            //comunicação com a bd
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            // caso exista erro
            return false;
        }

        //desligar a base de dados
        $this->desligar();
    }


    //============================================================
    //GENÉRICA
    //============================================================

    /**
     * @throws Exception
     */
    public function statement($sql, $parametros = null){

        //verifica se é uma instrução diferete das anteriores
        if(preg_match('/^(SELECT|INSERT|UPDATE|DELETE)/i', $sql)){
            throw new Exception('Base de dados - Instrução inválida.');
        }

        //liga
        $this->ligar();

        try {
            //comunicação com a bd
            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            // caso exista erro
            return false;
        }

        //desligar a base de dados
        $this->desligar();
    }
}
