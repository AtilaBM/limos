<?php
    class admsis{
        public $id_admsis;
        public $nome_admsis;
        public $email_admsis;
        public $senha_admsis;
        			
        
        public function __construct($id_admsis, $nome_admsis, $email_admsis, $senha_admsis){
            $this->id_admsis = $id_admsis;
            $this->nome_admsis = $nome_admsis;
            $this->email_admsis = $email_admsis;
            $this->senha_admsis = $senha_admsis;
        }

        # Autentica o login automaticamente, 
        public function login($conexao){
            # $tipo_usu: 1 = usu_cpf, 2 = usu_cnpj, 3 = adm

            $email = $this->email_admsis;
            $senha = $this->senha_admsis;
    
            $query = "SELECT * FROM `admsis` WHERE email_admsis = '$email' and senha_admsis = '$senha'";
            $result = mysqli_query($conexao, $query);
            $row = mysqli_num_rows($result); 
            $usu_bd = mysqli_fetch_assoc($result);

            if($row == 1){

                $this->__construct($usu_bd["id_admsis"], $usu_bd["nome_admsis"], $usu_bd["email_admsis"], $usu_bd["senha_admsis"]);
                $_SESSION["admsis"] = $this;
                return true;
            }else{
                echo "<p>Falha no login. Não foi encontrado nenhum usuário com esse e-mail e senha</p>";
                return false;
            }
        }
        # Autentica o cadastro automaticamente, 
        public function cadastro($conexao){
            # $tipo_usu: 1 = usu_cpf, 2 = usu_cnpj, 3 = adm

            $email = $this->email_admsis;
            $nome = $this->nome_admsis;
            $senha = $this->senha_admsis;

            if($this->verifica_email_ja_cadastrado($conexao)){

                $query = "INSERT INTO `admsis`(`nome_admsis`, `email_admsis`, `senha_admsis`) VALUES ('$nome','$email','$senha')";

                if($conexao->query($query) === TRUE){
                    if($this->login($conexao)){
                        return true;
                    }else{
                        echo "<p>Falha em se comunicar com o banco na função login dentro da função do cadastro</p>";
                        return false;
                    }
                }else{
                    echo "<p>Falha na query do cadastro.</p>";
                    return false;
                }
            }else{
                echo "<p>Falha no cadastro, o e-mail já foi cadastrado</p>";
                return false;
            }

        }

        public function logout($location="login/index.php"){
            session_destroy();
            $location = "Location: ".$location;
            header($location);
            exit();
        }

        # Verifica se o email já foi cadastrado no banco
        public function verifica_email_ja_cadastrado($conexao){
            # $tipo_usu: 1 = usu_cpf, 2 = usu_cnpj, 3 = adm
            $email = $this->email_admsis;

            $query = "select count(*) as total from admsis where email_admsis = '$email'";
            $result = mysqli_query($conexao, $query);
            $row = mysqli_fetch_assoc($result);

            if($row['total'] >= 1){
                echo "<p>Aparentemente esse e-mail já foi cadastrado em nosso banco</p>";
                return false;
            }else{
                return true;
            }
        }

        # Faz o update do objeto no banco
        public function updade($conexao){
            # $tipo_usu: 1 = usu_cpf, 2 = usu_cnpj, 3 = adm
            $id = $this->id_admsis;
            $nome = $this->nome_admsis;
            $email = $this->email_admsis;
            $senha= $this->senha_admsis;

            $query = "UPDATE `admsis` SET `nome_admsis`='$nome',`email_admsis`='$email',`senha_admsis`='$senha' WHERE `id_admsis` = '$id'";

            if($conexao->query($query) === TRUE){
                return true;
            }else{
                echo "<p>Erro ao se comunicar com o banco durante a função updade</p>";
                return false;
            }
        }


        public function delete($conexao){
            # $tipo_usu: 1 = usu_cpf, 2 = usu_cnpj, 3 = adm
            $id = $this->id_admsis;
            $query = "DELETE FROM `admsis` WHERE WHERE `admsis` = '$id'";
            if($conexao->query($query) === TRUE){
                return true;
            }else{
                return false;
            }
        }
    }
?>