<?php
// Função para enviar o e-mail
function enviar_email($to, $subject, $body, $headers) {
    // Usar a função mail() para enviar o e-mail
    return mail($to, $subject, $body, $headers);
}

// Verificar se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Filtrar os dados para evitar XSS e outros problemas
    $nome = isset($_POST['nome']) ? htmlspecialchars(trim($_POST['nome'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $mensagem = isset($_POST['mensagem']) ? htmlspecialchars(trim($_POST['mensagem'])) : '';

    // Verificar se os campos obrigatórios foram preenchidos
    if (empty($nome) || empty($email) || empty($mensagem)) {
        echo "Todos os campos são obrigatórios.";
        exit;
    }

    // Validar o formato do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "E-mail inválido. Tente novamente.";
        exit;
    }

    // Definir o destinatário, assunto e corpo do e-mail
    $to = "kkassiaribeiro@gmail.com";
    $subject = "Nova mensagem de contato";
    $body = "Nome: $nome\nEmail: $email\n\nMensagem:\n$mensagem";

    // Definir o cabeçalho do e-mail (De)
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Enviar o e-mail e verificar se a operação foi bem-sucedida
    if (enviar_email($to, $subject, $body, $headers)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Falha ao enviar a mensagem. Tente novamente.";
    }
}
?>
