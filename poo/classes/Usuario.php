<?php
/**
 * Classe Usuario 
 * @author Giovana Padilha gigi261102@hotmail.com
 * @copyright GPL, 2020, Info63
 * @access public 
 * @since 09/07/2020
 */
class Usuario{
     /**
     * @access private 
     * @name id 
     */
    private $id;
     /**
     * @access private 
     * @name nome
     */
    private $nome;
     /**
     * @access private 
     * @name email
     */
    private $email;
     /**
     * @access private 
     * @name senha
     */
    private $senha;

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
    public function setNome($nome){
        $this->nome=$nome;
    }
     /** 
     * @access public 
     * @return string 
     */
    public function getNome(){
        return $this->nome;
    }
     /** 
     * @access public 
     * @param string 
     */
    public function setEmail($email){
        $this->email=$email;
    }

     /** 
     * @access public 
     * @return string 
     */
    public function getEmail(){
        return $this->email;
    }

    /** 
     * @access public 
     * @param string 
     */
    public function setSenha($senha){
        $this->senha=$senha;
    }
    /** 
     * @access public 
     * @return string 
     */
    public function getSenha(){
        return $this->senha;
    }

    /**
     * Método responsável por carregar a pagina de login
     * @access public 
     * @author Giovana Padilha gigi261102@hotmail.com
     * @since 20/07/2020
     */
    public function index(){
        if (!isset($_SESSION['user'])){
            $this->login();
        }
        else {
            $this->listar();
        }

    }
    /**
     * Método responsável por listar os usuarios 
     * @access public 
     * @author Giovana Padilha gigi261102@hotmail.com
     * @since 20/07/2020
     */
    public function listar(){
        include HOME_DIR."view/paginas/usuarios/listar.php";
    }
    /**
     * Método responsável por criar os usuarios via formulário 
     * @access public 
     * @author Giovana Padilha gigi261102@hotmail.com
     * @since 20/07/2020
     */
    public function criar(){
        include HOME_DIR."view/paginas/usuarios/form_usuario.php";
    }
    /**
     * Método responsável por salvar os novos cadastros de usuarios  
     * @access public 
     * @author Giovana Padilha gigi261102@hotmail.com
     * @since 20/07/2020
     */
    public function salvar(){
        $conexao = Conexao::getInstance();
        $sql = 'INSERT INTO usuario (nome, email, senha) VALUES ("'.$_POST['nomeSalvar'].'","'.$_POST['emailSalvar'].'","'.md5('123').'")';
    }
    /**
     * Método responsável por exibir o id do usuário 
     * @access public 
     * @author Giovana Padilha gigi261102@hotmail.com
     * @since 20/07/2020
     */
    public function exibir($id){
        echo "O id do usuario é".$id;
    }
    /**
     * Método responsável por fazer o login 
     * @access public 
     * @author Giovana Padilha gigi261102@hotmail.com
     * @since 16/07/2020
     */
    public function login(){
        include HOME_DIR."view/paginas/usuarios/login.php";
    }
    /**
     * Método responsável por chamar a senha padrao 
     * @access public 
     * @author Giovana Padilha gigi261102@hotmail.com
     * @since 16/07/2020
     */
    public function senha(){
        include HOME_DIR."view/paginas/usuarios/senha_padrao.php";
    }
    /**
     * Método responsável por deletar algum usuario 
     * @access public 
     * @author Giovana Padilha gigi261102@hotmail.com
     * @since 20/07/2020
     */
    public function deletar($id){
        $conexao = Conexao::getInstance();
        $sql = 'DELETE FROM usuario WHERE id='.$id;
        if ($conexao->query($sql)){
            
        }
        $this->listar();
    }
    /**
     * Método responsável por trocar a senha padrao do usuario ja registrado 
     * @access public 
     * @author Giovana Padilha gigi261102@hotmail.com
     * @since 20/07/2020
     */
    public function trocar_senha(){
        $conexao = Conexao::getInstance();
        $sql = 'UPDATE usuario SET senha = "'.md5($_POST['senhaTrocar']).'" WHERE id = '.$_SESSION['user']->id;
        if ($conexao->query($sql)){
            
        }
    }
    /**
     * Método responsável por autenticar a nova senha  
     * @access public 
     * @author Giovana Padilha gigi261102@hotmail.com
     * @since 20/07/2020
     */
    public function autenticar(){
        $conexao = Conexao::getInstance();

        $email = $_POST['email'];
            /**
             * Criptografia da nova senha, inserindo ela no banco de dados 
             */
        $sql = "SELECT senha FROM usuario WHERE email ='$email'";

        $resultado = $conexao->query($sql);
      
        $senha = $resultado->fetch(PDO::FETCH_OBJ);
           
            if (md5($_POST['senha']) === $senha -> senha){

                $sql = "SELECT * FROM usuario WHERE email= '$email'";
                $resultado = $conexao->query($sql);

                $_SESSION['user'] = $resultado -> fetch(PDO::FETCH_OBJ);

                if ($_SESSION['user'] -> senha == md5('12345') ){
                
                    $this->senha();
                }

                else{
                    header('Location:'.HOME_URI);
                }

            }

            else{
                $this->login();
            }  

        }
     /**
     * Método responsável por fazer o lougout
     * @access public 
     * @author Giovana Padilha gigi261102@hotmail.com
     * @since 20/07/2020
     */
    public function logout(){
        session_destroy();
        header('Location:'.HOME_URI);
    }

}