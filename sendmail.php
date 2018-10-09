<?php

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = filter_var(trim($_POST["phone"]), FILTER_SANITIZE_STRING);
        $message = trim($_POST["message"]);
        $message = filter_var(trim($message), FILTER_SANITIZE_STRING);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Упс! Неправильно заполнена форма. Пожалуйста заполните форму правильно и попытайтесь еще раз.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "support@evakyator.biz";

        // Set the email subject.
        $subject = "Новое сообщение от $name";

        // Build the email content.
        $email_content = "Имя: $name\n";
        $email_content .= "Номер телефона: $phone\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Сообщение:\n$message\n";

        // Build the email headers.
        $email_headers = "От: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Спасибо за отзыв! Мы вам скоро ответим";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Упс! Что-то пошло не так, попытайтесь отправить форму еще раз";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "Возникла проблема с отправкой письма, пожалуйста попытайтесь снова.";
    }

?>