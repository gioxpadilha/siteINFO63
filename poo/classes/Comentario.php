<?php
/**
 * Classe Comentario 
 * @author Giovana Padilha gigi261102@hotmail.com
 * @copyright GPL, 2020, Info63
 * @access public 
 * @since 09/07/2020
 */
class Comentario{
    /**
     * @access private 
     * @name id 
     */
    private $id;
    /**
     * @access private 
     * @name comentario 
     */
    private $comentario;
    /**
     * @access private 
     * @name data
     */
    private $data;
    /**
     * @access private 
     * @name noticia
     */
    private $noticia;
    /**
     * @access private 
     * @name usuario
     */
    private $usuario;

    /** 
     * @access public 
     * @param int 
     */
    public function setId($id){
        $this->id=$id;
    }
    /** 
     * @access public 
     * @return int 
     */
    public function getId(){
        return $this->id;
    }
    /** 
     * @access public 
     * @param string 
     */
    public function setComentario($comentario){
        $this->comentario=$comentario;
    }
    /** 
     * @access public 
     * @return string
     */
    public function getComentario(){
        return $this->comentario;
    }
    /** 
     * @access public 
     * @param int
     */
    public function setDatad($data){
        $this->data=$data;
    }
    /** 
     * @access public 
     * @return int 
     */
    public function getData(){
        return $this->data;
    }
    /** 
     * @access public 
     * @param string 
     */
    public function setNoticia($noticia){
        $this->noticia=$noticia;
    }
    /** 
     * @access public 
     * @return string 
     */
    public function getNoticia(){
        return $this->noticia;
    }
    /** 
     * @access public 
     * @param string 
     */
    public function setUsuario($usuario){
        $this->usuario=$usuario;
    }
    /** 
     * @access public 
     * @return string 
     */
    public function getUsuario(){
        return $this->usuario;
    }

    /** 
     * Método que salva os comentarios no banco de dados 
     * @access public 
     */
    public function salvar($id_noticia, $comentario, $id_usuario){
        $conexao = Conexao::getInstance();
        $sql = 'INSERT INTO comentario (id_comentario, comentario, noticia_id, usuario_id) VALUES(0,"'.$comentario.'","'.$id_noticia.'","'.$id_usuario.'")';
        if ($conexao->query($sql)){
            return true;
        }
        else {
            return false;
        }
    }

    /** 
     * Método que lista na página os comentarios já inseridos 
     * @access public 
     */
    public function listar($id_noticia = null){
        $conexao = Conexao::getInstance();
        $sql = 'SELECT comentario, nome AS nome_usuario FROM comentario c';
        
        $resultado = $conexao->query($sql);
    
        while ($item = $resultado->fetch(PDO::FETCH_OBJ)) {
            $comentarios[] = $item;
            
        }

        if (isset($comentarios)){
            return $comentarios;
        }
        else {
            return false;
        }
    }

}