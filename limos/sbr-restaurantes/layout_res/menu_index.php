    <style>
        /* nav */
.main_header {
    width: 100%;
    height: 6em;
}

.main_header .main_header_content {
    max-width: 1300px;
    height: 100%;
    margin: 0 5%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
.img_logo{
    display:flex;
    align-items: center;
    height: 100%;
}
.main_header .main_header_content img{
    /* flex-basis: 330px; */
    padding: 5px 0;
    width: 220px;
    
}

.main_header .main_header_content .main_header_content_menu {
    flex-basis: calc(100% - 330px);
    display: flex;
    justify-content: flex-end;
}
.main_header_content_menu{
    display: flex;
    align-items: center;
}

.menu_a_inportant{
    padding: 0 10px;
}
.menu_a_inportant a{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 40px;
    width: 160px;
    background-color: #F2B807;
}
.cadastro_menu{
    color: #070300;
    padding:10px 20px;
    font-weight: 400;
    font-size: 1.085em;
    letter-spacing: 1px;
    text-align: center;
    transition: .20s;
}
.menu_a_inportant a:hover{
    background-color: #A60303;
    color: #fff;
}
    </style>

<body>
    <header  class="main_header">
        <div class="main_header_content">
            <div class="img_logo">
                <a href="../../sbr/index.php" class="logo">
                    <img src="../../img/limos_vermelho.png" alt="Bem vindo ao projeto Limos"
                        title="Bem vindo ao projeto Limos"></a>
            </div>
    
            <nav class="main_header_content_menu">
                <div class="menu_a_inportant">
                        <a href="../index.php" class="cadastro_menu">Voltar</a>
                    </div>
            </nav>
        </div>
    </header>
