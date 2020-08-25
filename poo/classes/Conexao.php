<?php
/**
 * Classe que faz a conexão com o banco de dados
 */
class Conexao {
    static public function getInstance(){
        return new PDO (SGBD.":host=".HOST_DB.";dbname=".DB."",USER_DB, PASS_DB);
    }

}
?>