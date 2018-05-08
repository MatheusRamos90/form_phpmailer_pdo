<?php

require ('PHPMailer/class.phpmailer.php');

$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$assunto = isset($_POST['assunto']) ? $_POST['assunto'] : '';
$mensagem = isset($_POST['mensagem']) ? $_POST['mensagem'] : '';

// Inicia a classe PHPMailer
$mail = new PHPMailer();

// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(); // Define que a mensagem será SMTP

try {
    $corpoEmail = '<!DOCTYPE html>
                        <head>
                            <meta charset="UTF-8">
                            <title>Contato - Formulário via Site</title>
                            <style>
                                p{
                                    margin: 0 0 10px 0;
                                }
                            </style>
                        </head>
                        <body>
                            <div>
                                <p>Nome: '.$nome.'</p>
                                <p>E-mail: '.$email.'</p>
                                <p>Assunto: '.$assunto.'</p>
                                <p>Mensagem: '.$mensagem.'</p>
                            </div>
                        </body>   
    
                    </html>';

    $mail->Host = 'site.com.br'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
    $mail->SMTPAuth   = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
    $mail->Port       = 587; //  Usar 587 porta SMTP
    $mail->Username = 'contato@site.com.br'; // Usuário do servidor SMTP (endereço de email)
    $mail->Password = '123'; // Senha do servidor SMTP (senha do email usado)

    //Define o remetente
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->SetFrom($email, $nome); //Seu e-mail
    $mail->AddReplyTo($email, $nome); //Seu e-mail
    $mail->Subject = 'Assunto';//Assunto do e-mail


    //Define os destinatário(s)
    //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->AddAddress('contato@site.com.br', 'Seu nome / ou site');

    //Campos abaixo são opcionais
    //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    //$mail->AddCC('destinarario@dominio.com.br', 'Destinatario'); // Copia
    //$mail->AddBCC('destinatario_oculto@dominio.com.br', 'Destinatario2`'); // Cópia Oculta
    //$mail->AddAttachment('images/phpmailer.gif');      // Adicionar um anexo


    //Define o corpo do email
    $mail->MsgHTML($corpoEmail);

    ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
    //$mail->MsgHTML(file_get_contents('arquivo.html'));

    $mail->Send();
    echo "<p class='alert alert-success alert-dismissible' role='alert'>Mensagem enviada com sucesso<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></p>";

    //caso apresente algum erro é apresentado abaixo com essa exceção.
}catch (phpmailerException $e) {
    echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
}