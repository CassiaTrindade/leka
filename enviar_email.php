<?php
function enviar_email($to, $subject, $body, $headers) {
    return mail($to, $subject, $body, $headers);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $mensagem = htmlspecialchars($_POST['mensagem']);

    $to = "kkassiaribeiro@gmail.com";
    $subject = "Nova mensagem de contato";
    $body = "Nome: $nome\nEmail: $email\n\nMensagem:\n$mensagem";
    $headers = "From: $email";

    if (enviar_email($to, $subject, $body, $headers)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Falha ao enviar a mensagem. Tente novamente.";
    }
}
?>
