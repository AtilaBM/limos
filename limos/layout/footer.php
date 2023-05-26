<style>
    /* footer {
        position: relative;
        min-height: 75vh;
        width: 100%;
    } */
    html {
        height: 100%;
        min-height: 100%;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100%;
    }

    footer {
        margin-top: auto;
    }

    .main_footer {
        padding: 40px 5%;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: auto 0px;
        color: #333;
        background-color: #f7f7f7;
    }

    .main_footer article {
        padding-bottom: 10px;
    }

    .main_footer>header {
        flex-basis: 100%;
    }

    .main_footer>header h1 {
        font-size: 1.4em;
        margin-bottom: 40px;
    }

    .main_footer>header h1::after {
        content: '';
        display: block;
        width: 4rem;
        height: 0.2rem;
        background-color: #F2B807;
        margin: 0 auto;
        position: absolute;
        border-radius: 5px;
    }

    .main_footer>article h2 {
        margin-bottom: 20px;
    }

    .main_footer>article h2::after {
        content: '';
        display: block;
        width: 2rem;
        height: 0.2rem;
        background-color: #F2B807;
        margin: 0 auto;
        position: absolute;
        border-radius: 5px;
    }

    .main_footer>article ul li {
        list-style: none;
        margin: 5px 0;
    }

    .main_footer>article ul li a {
        color: #333;

    }

    .main_footer>article ul li a:hover {
        border-bottom: 1px solid #A60303;
        margin-top: 5px;
    }

    .main_footer_our_pages,
    .main_footer_links {
        flex-basis: 25%;
    }

    .main_footer_about {
        flex-basis: 50%;
    }

    .main_footer_rights {

        display: flex;
        align-items: center;
        justify-content: center;
        align-self: center;
        padding: 2px 0;
        width: 100%;
        height: 50px;
        text-align: center;
        background-color: #f7f7f7;
        border-top: 1px solid #808080;
        font-size: 0.9em;
        color: #333;
        font-weight: 300;
    }
</style>
<footer>

    <section class="main_footer">
        <header>
            <h1>Quer saber mais?</h1>
        </header>
        <article class="main_footer_our_pages">
            <header>
                <h2>Nossas Páginas</h2>
            </header>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="../sbr/pesquisa/index.php">Restaurantes</a></li>
            </ul>
        </article>

        <article class="main_footer_links">
            <header>
                <h2>Links Úteis</h2>
            </header>
            <ul>
                <li><a href="#">Política de Privacidade</a></li>
                <li><a href="#">Aviso Legal</a></li>
                <li><a href="#">Termos de Uso</a></li>
            </ul>
        </article>

        <article class="main_footer_about">
            <header>
                <h2>Sobre o Projeto</h2>
            </header>
            <p>Procure os melhores restaurantes com base em sua localização e gostos pessoais e divulgue sua experiência por meio dos comentários e da avaliação do resturante.</p>
        </article>
        <div class="main_footer_rights">
            <p>LIMOS - &copy;Todos os direitos reservados.</p>
        </div>


    </section>
</footer>