<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Envio de form com PHPMailer usando PDO</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        body,html{
            font-family: 'Calibri';
            color: #222;
        }
        p{
            margin: 0 0 10px 0;
        }
        .wrapper .container{
            width: 1170px;
        }
        .form-control{
            border: 1px solid #CCC;
            border-radius: 0px;
            padding: 8px;
            font-family: 'Calibri';
        }
        .form-control:focus,
        .form-control:active{
            border: 1px solid #333;
        }

    </style>

    <!-- jQuery 3.3.1 -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>

<section class="wrapper">
    <div class="container">
        <div class="col-lg-4 col-md-4 center-div" style="float: none;margin: auto;padding: 15rem 0 0 0">
            <form method="post" id="form-contato">
                <p>Nome:</p>
                <input type="text" class="form-control" name="nome" id="nome">
                <br/>
                <p>E-mail:</p>
                <input type="text" class="form-control" name="email" id="email">
                <br/>
                <p>Assunto:</p>
                <select name="assunto" class="form-control">
                    <option value="Orçamento">Orçamento</option>
                    <option value="Dúvidas">Dúvidas</option>
                    <option value="Reclamação">Reclamação</option>
                    <option value="Outros">Outros</option>
                </select>
                <br/>
                <textarea name="mensagem" id="mensagem" class="form-control"></textarea>
                <br/>
                <button type="submit" class="btn btn-primary" id="btn-envia">Enviar</button>
            </form>
            <br/>
            <div id="conteudoResposta"></div>
        </div>
    </div>
</section>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
    $(function () {

        var resp = $('#conteudoResposta');

        $('#form-contato').on('submit', function (ev) {
            ev.preventDefault();

            $.ajax({
                url: '/form_contato_pdo/controllers/FormContatoController.php',
                type: 'post',
                data: $(this).serialize(),
                success: function (data) {
                    if(data){
                        resp.html('');
                        resp.html(data);
                    }
                }
            });
        })

    })
</script>

</body>
</html>