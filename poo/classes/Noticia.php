<?php
/**
 * Classe Noticia 
 * @author Giovana Padilha gigi261102@hotmail.com
 * @copyright GPL, 2020, Info63
 * @access public 
 * @since 09/07/2020
 */
class Noticia{
    /**
     * @access private 
     * @name id 
     */
    private $id;
    /**
     * @access private 
     * @name titulo
     */
    private $titulo;
    /**
     * @access private 
     * @name descricao
     */
    private $descricao;
    /**
     * @access private 
     * @name comentarios
     */
    private $comentarios;
    /**
     * @access private 
     * @name data
     */
    private $data;
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
    public function setTitulo($titulo){
        $this->titulo=$titulo;
    }
    /** 
     * @access public 
     * @return string
     */
    public function getTitulo(){
        return $this->titulo;
    }
    /** 
     * @access public 
     * @param string
     */
    public function setDescricao($descricao){
        $this->descricao=$descricao;
    }
    /** 
     * @access public 
     * @return string
     */
    public function getDescricao(){
        return $this->descricao;
    }
    /** 
     * @access public 
     * @param string
     */
    public function setComentarios($comentarios){
        $this->comentarios=$comentarios;
    }
     /** 
     * @access public 
     * @return string
     */
    public function getComentarios(){
        return $this->comentarios;
    }
    /** 
     * @access public 
     * @param int 
     */
    public function setData($data){
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
     * Método responsável por carregar a página inicial 
     * @access public 
     * @author Giovana Padilha gigi261102@hotmail.com
     * @since 09/07/2020
     */
    public function index(){
        $this->listar();
    }

    /**
     * Método responsável por listar noticias 
     * @access public 
     * @author Giovana Padilha gigi261102@hotmail.com
     * @since 16/07/2020
     */
    public function listar(){
        $conexao=Conexao::getInstance();
        $sql="SELECT id, titulo, descricao, DATE_FORMAT(data, '%d/%m/%Y') AS data,
        (SELECT nome FROM usuario WHERE id=noticia.usuario_id)AS nome_usuario 
        FROM noticia
        ORDER BY id DESC LIMIT 5";
        
        $resultado=$conexao->query($sql);
        $noticias=null;

        while($noticia=$resultado->fetch(PDO::FETCH_OBJ)){
            $noticias[]=$noticia;
        }
        
        include HOME_DIR."view/paginas/noticias/noticias.php";
    }
    /**
     * Método responsável mostrar a noticia e quem a postou 
     * @access public 
     * @author Giovana Padilha gigi261102@hotmail.com
     * @since 16/07/2020
     */
    public function ver($id){
        $conexao=Conexao::getInstance();
        $sql="SELECT id, titulo, descricao, DATE_FORMAT(data, '%d/%m/%Y') AS data,
        (SELECT nome FROM usuario WHERE id=noticia.usuario_id)AS nome_usuario 
        FROM noticia
        WHERE id=".$id;

        $resultado=$conexao->query($sql);
        $noticia=$resultado->fetch(PDO::FETCH_OBJ);

        include "Comentario.php";
        $comentario = new Comentario();
        $noticia->comentarios = $comentario->listar($noticia->id);

        include HOME_DIR."view/paginas/noticias/noticia.php";
    }
    /**
     * Método responsável por mostrar os comentarios e qual usuario comentou
     * @access public 
     * @author Giovana Padilha gigi261102@hotmail.com
     * @since 16/07/2020
     */
    public function comentar(){
        include "Comentario.php";
        $comentario = new Comentario();
        if ($comentario->salvar($_POST['id_noticia'], $_POST['comentario'], $_POST['id_usuario'])){
            $msg['msg'] = "Comentário adicionado!";
            $msg['class'] = "success";
            $_SESSION['msg'] = $msg;
        }
        else {
            $msg['msg'] = "Falha ao adicionar comentário!";
            $msg['class'] = "danger";
            $_SESSION['msg'] = $msg;
        }
        header("location:".HOME_URI."noticia/ver/".$_POST['id_noticia']);
    }

}

?>