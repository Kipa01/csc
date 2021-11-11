<?php

/* https://api.telegram.org/botXXXXXXXXXXXXXXXXXXXXXXX/getUpdates,
где, XXXXXXXXXXXXXXXXXXXXXXX - токен бота, полученный ранее */


//========Преобразование телефона в нужный формат

// пришло + 7(929) 7896-56-56
// $phone = $_POST['phone'];

// чистим
// $phone = str_replace(['(',')','-','+',' '], '', $phone );

// на выходе
// $phone будет равен 792978965656

//========/Преобразование телефона в нужный формат

$token = "1984055083:AAFFHsHDCtZWPrVGXYb3dX83tQAMcswVub8";
$chat_id = "-581303645";

if (empty($_POST['candidate_phone'])) {
    if (empty($_POST['user_question'])) {
        $user_email = $_POST['user_email'];
        $user_phone = $_POST['user_phone'];
        $arr = array(
          'С нами хотят связаться!' => '',
          'Почта посетителя: ' => $user_email,
          'Телефон посетителя: ' => $user_phone,
        );
    } else {
        $user_email = $_POST['user_email'];
        $user_question = $_POST['user_question'];
        $arr = array(
          'С нами хотят связаться!' => '',
          'Почта посетителя: ' => $user_email,
          'Вопрос посетителя: ' => $user_question,
        );
    }
} else {
    $candidate_phone = $_POST['candidate_phone'];
    $candidate_link = $_POST['candidate_link'];
    $user_phone = $_POST['user_phone'];
    $arr = array(
      'Пришла рекомендация!' => '',
      'Телефон кандидата: ' => $candidate_phone,
      'Ссылка на резюме кандидата: ' => $candidate_link,
      'Телефон рекомендующего: ' => $user_phone,
    );
}

foreach($arr as $key => $value) {
  $txt .= "<b>".$key."</b> ".$value."%0A";
};

$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

if ($sendToTelegram) {
  echo "No Error";
} else {
  echo "Error";
}
?>