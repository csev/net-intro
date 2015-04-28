<?php
$answer_suffix = 89;
$answer_factor = 97;
require_once('../config.php');

function decode_answer($answer, $answer_suffix,$answer_factor) {
    if ( $answer < 100 ) return $answer;
    $anstr = $answer.'';
    $sufstr = $answer_suffix.'';
    $front = substr($anstr,0,strlen($anstr)-strlen($sufstr));
    $back = substr($anstr,strlen($anstr)-strlen($sufstr));
    $dec = ($front+0) % $answer_factor;
    return $dec;
}

if ( isset($_POST['cancel']) ) {
    header('Location: index.php');
    return;
}

$quizzes = json_decode(file_get_contents("quizzes.json"), true);

?>
<html>
<head>
<?php require_once('../head.php'); ?>
<title>Quiz</title>
</head>
<body style="font-family: sans-serif;">
<?php


if ( ! isset($_REQUEST['quiz']) ) {
    echo('<h1>Quizzes <small>(<a href="../index.php">Back to Net-Intro</a>)</small></h1>');
    echo("<ol>\n");
    foreach ($quizzes as $file => $quiz ) {
        $f = str_replace(".mkd","",$file);
        echo('<li><a href="index.php?quiz='.htmlentities($f).'">'.htmlentities($quiz['title']).'</a></li>'."\n");
    }
    echo("</ol>\n");
    return;
}

$thequiz = false;
foreach ($quizzes as $file => $quiz ) {
    $f = str_replace(".mkd","",$file);
    if ($f == $_REQUEST['quiz']) {
        $thequiz = $quiz;
        break;
    }
}

if ( $thequiz === false ) {
    echo("<p>Quiz not found</p>");
    exit();
}

echo("<h1>".htmlentities($thequiz['title']).' <small>(<a href="index.php">Back to all quizzes</a>)</small>'."</h1>\n");
echo('<form method="post" action="index.php">'."\n");
echo('<input type="hidden" name="quiz" value="'.htmlentities($_REQUEST['quiz']).'">'."\n");
echo("<ol>\n");

$qno = 0;
foreach($thequiz['questions'] as $question) {
    echo("<li>".htmlentities($question['question'])."<p>\n");
    // echo("<!-- ".decode_answer($question['answer'], $answer_suffix,$answer_factor)." -->\n");
    $correct = decode_answer($question['answer'], $answer_suffix,$answer_factor);
    $qno++;
    $ano = 0;
    $qf = 'q_'.$qno;
    foreach($question['answers'] as $answer) {
        $ano++;
        $indicate = '';
        $checked = '';
        if ( isset($_POST[$qf]) && $_POST[$qf] == $ano ) {
            $checked = ' checked ';
            $indicate = ' <span style="color:red">&#x2717;</span> ';
            if ( $_POST[$qf] == $correct ) $indicate = ' <span style="color:green">&#x2713;</span> ';
        }
        echo($indicate);
        echo('<input type="radio" name="'.$qf.'" value="'.$ano.'"'.$checked.'/>');
        echo(htmlentities($answer));
        echo("<br/>\n");
    }
    echo("</p></li>\n");
}
echo("</ol>\n");

echo('<input class="btn btn-normal" type="submit">'."\n");
echo('<input class="btn btn-danger" type="submit" name="cancel" value="Cancel">'."\n");
echo("</form>\n");

// echo("<pre>\n"); var_dump($thequiz); echo("</pre>\n");

require_once('../javascript.php');
