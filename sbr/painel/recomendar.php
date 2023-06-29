<?php
    include("../../conexao.php");
    include_once("../../objs/objetos.php");
    session_start();

    # Declaração das variáveis
    $gostosCli = explode("-",$_SESSION["cliente"]->gostos);
    $enderecoCli = $_SESSION["endereco"];
    $melhorRes;
    $ptsMelhorRes;
    $ptsEndMelhorRes;
    $ptsTipoMelhorRes;
    $ptsNotaMelhorRes;
    $counter = 1;

    # Pesos
    $pesoNota = 100;

    # Função responsável por calcular a pontuação referente ao tipo do restaurante
    function calculaPtsTipo($a){
        switch($a){
            case 1:
                return 500;
            case 2:
                return 300;
            case 3:
                return 0;
            case 4:
                return -250;
            case 5:
                return -10000;
        }
    }

    # Função responsável por calcular a pontuação referente ao endereço do restaurante
    function calculaPtsEnd($a, $b){
        $notaTemp = 0;
        if($a->pais == $b->pais){
            $notaTemp += 10;
        }else{
            $notaTemp += -9000;
        }
        if($a->uf == $b->uf){
            $notaTemp += 100;
        }else{
            $notaTemp += -100;
        }
        if($a->cidade == $b->cidade){
            $notaTemp += 200;
        }else{
            $notaTemp += -50;
        }
        if($a->bairro == $b->bairro){
            $notaTemp += 300;
        }else{
            $notaTemp += -20;
        }
        if($a->logradouro == $b->logradouro){
            $notaTemp += 400;
        }else{
            $notaTemp += -5;
        }
        return $notaTemp;
    }

    # Função responsável por calcular a pontuação referente ao cnpj do restaurante
    function calculaPtsCnpj($a){
        if($a != null){
            return 100;
        }else{
            return -10;
        }
    }

    # Função responsável por calcular a pontuação referente a entrega do restaurante
    function calculaPtsEnt($a){
        if($a == 1){
            return 100;
        }else{
            return -100;
        }
    }

    # Função responsável por calcular a pontuação referente ao pedido do restaurante
    function calculaPtsPed($a){
        if($a == 1){
            return 100;
        }else{
            return -100;
        }
    }

    function calculaPtsAd($ad, $conexao){
        if($ad->id_ad != null){
            $ad->atualizaAdBanco($conexao);
            if($ad->status_ad == 1 and $ad->status_pag_ad == 1){
                return 350;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }

    # Query MySql
    $query = 'SELECT res.id_res, res.tipo_res, res.encomenda_res, res.entrega_res, res.cnpj_res, res.nota_res, end.id_end, end.cep_end, end.logradouro_end, end.num_end, end.bairro_end, end.uf_end, end.cidade_end, end.pais_end, ad.id_ad, ad.status_ad, ad.status_pag_ad, ad.data_fim_ad, ad.data_inicio_ad FROM res LEFT JOIN end ON res.id_res = end.id_end LEFT JOIN ad ON res.id_res = ad.id_res WHERE res.status_conta_res = 1;';
    $result = mysqli_query($conexao, $query);
    $row = mysqli_num_rows($result);

    if($row >= 1){ 
        foreach($result as $res){
            # Variáveis
            $tipoRes = $res['tipo_res'];
            $notaRes = $res['nota_res'];
            $enderecoRes = new endereco($res['cep_end'], $res['num_end'], $res['logradouro_end'], $res['bairro_end'], $res['uf_end'], $res['pais_end'], $res['cidade_end'], $res['id_end']);
            $ad = new ad($res['id_ad'], $res['id_res'], $res['data_inicio_ad'], $res['data_fim_ad'], $res['status_ad'], $res['status_pag_ad']);
            $ad->id_res= $res['id_res'];
            
            # Cálculo das pontuações
            $ptsNota = $notaRes * $pesoNota;
            $ptsTipo = calculaPtsTipo($gostosCli[$tipoRes - 1]);
            $ptsEnd = calculaPtsEnd($enderecoCli,$enderecoRes);
            $ptsAd = calculaPtsAd($ad, $conexao);
            $ptsPed = calculaPtsPed($res['encomenda_res']);
            $ptsEnt = calculaPtsEnt($res['entrega_res']);
            $ptsCnpj = calculaPtsCnpj($res['cnpj_res']);
            $totalTemp = $pesoNota + $ptsTipo + $ptsEnd + $ptsAd + $ptsEnt + $ptsPed + $ptsCnpj;

            # Atribuição dos melhores
            if($counter == 1){
                $melhorRes = $res['id_res'];
                $ptsMelhorRes = $totalTemp;
                $ptsEndMelhorRes = $ptsEnd;
                $ptsTipoMelhorRes = $ptsTipo;
                $ptsNotaMelhorRes = $ptsNota;
            }else{
                if($totalTemp > $ptsMelhorRes){
                    $melhorRes = $res['id_res'];
                    $ptsMelhorRes = $totalTemp;
                    $ptsEndMelhorRes = $ptsEnd;
                    $ptsTipoMelhorRes = $ptsTipo;
                    $ptsNotaMelhorRes = $ptsNota;
                }elseif($totalTemp == $ptsMelhorRes){
                    if($ptsEnd > $ptsEndMelhorRes){
                        $melhorRes = $res['id_res'];
                        $ptsMelhorRes = $totalTemp;
                        $ptsEndMelhorRes = $ptsEnd;
                        $ptsTipoMelhorRes = $ptsTipo;
                        $ptsNotaMelhorRes = $ptsNota;
                    }elseif($ptsEnd == $ptsEndMelhorRes){
                        if($ptsTipo > $ptsTipoMelhorRes){
                            $melhorRes = $res['id_res'];
                            $ptsMelhorRes = $totalTemp;
                            $ptsEndMelhorRes = $ptsEnd;
                            $ptsTipoMelhorRes = $ptsTipo;
                            $ptsNotaMelhorRes = $ptsNota;
                        }elseif($ptsNota > $ptsNotaMelhorRes){
                            $melhorRes = $res['id_res'];
                            $ptsMelhorRes = $totalTemp;
                            $ptsEndMelhorRes = $ptsEnd;
                            $ptsTipoMelhorRes = $ptsTipo;
                            $ptsNotaMelhorRes = $ptsNota;
                        }
                    }
                }
            }
            $counter += 1;
        }
        header("Location: ../restaurantes/index.php?idRes=$melhorRes");
    }else{
        echo "<p>Parece que nenhum restaurante foi cadastrado</p>";
    }
?>