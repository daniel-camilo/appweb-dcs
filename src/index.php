<!DOCTYPE HTML>
<html lang="pt-br">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Teste de App Web</title>

        <!-- Incluindo o CSS do Bootstrap e o js-->
        <link href="bootstrap3/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="bootstrap3/js/jquery.js" type="text/javascript"></script>
        <script src="bootstrap3/js/bootstrap.min.js"></script>
        <link rel="icon" href="icones/login.png">
        <style>
                body {
                        /* ALTERAR CORES AQUI PARA SIMULAR TESTES NO FORMULÁRIO.
                        Link com paleta de cores para usar no CSS:
                        https://www.ranoya.com/books/public/css/corescss.php
                        */
                        background-color: #D3D3D3;
                }
                .container {
            padding-top: 50px; /* Adiciona espaço no topo */
    }
  </style>
</head>
  <body>
                <div class="container text-center">
                        <div class="row">
                                <div class="col-sm-12">
                                        <h1 class="badge" style="background-color: #006400; color: #F0E68C; font-size: 36px;padding: 20px; max-width: 100%; white-space: normal;">
                                                <?php
                                                        echo 'VM: ' . getenv('HOSTNAME');
                                                ?>
                                        </h1>
                                </div>
                        </div>
                </div>
  </body>
        <div class="footer">
    <p style="text-align: center; color: #8B0000;">
                        Developed By Daniel C-S.
                </p>
        </div>
</html>
