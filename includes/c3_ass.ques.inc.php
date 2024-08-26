<?php

// Database connection
require_once 'numerusdatabase.php';
require_once 'config_session.inc.php';

if(!isset($_SESSION['score'])){
    $_SESSION['score'] = 0;
 }

 //Get next to increment n=1 ++ to the next question
 if($_POST){
    $number = isset($_POST['number']) ? (int)$_POST['number'] : 0;
    $selected_choice = isset($_POST['choice']) ? $_POST['choice']: null;
    
 

    if($number && $selected_choice !== null){
        //Get total questions
        $query = "SELECT COUNT(*) FROM assess_question";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $total = $stmt->fetchColumn();

        //Get correct choice for current question
        $query = "SELECT Choice_ID FROM assess_choice WHERE Ques_ID = :number AND Answer = 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':number', $number, PDO::PARAM_INT);
        $stmt->execute();
        $correct_choice = $stmt->fetchColumn();
        

        if($correct_choice == $selected_choice){
            $_SESSION['score']++;
        }

        if($number == $total){
            header("Location: ../c4_ass.result.php");
            die();
        }else{
            $next = $number + 1;
            header("Location: ../c3_ass.ques.php?n=".$next);
            die();
            }
        } else {
        // Handle case where number or choice are missing
        echo "Error: Question number or choice not set.";
        }
    } else {
    // Handle case where POST data is not set
    //echo "Error: No data submitted.";
    }



/*
 Get the current question number from the request (default to 1 if not set)
$number = isset($_GET['number']) ? intval($_GET['number']) : 1;


$sql = "
    SELECT q.Ques_ID, q.Ques_Text, q.URL, c.Choice_ID, c.Choice_Text, c.Answer
    FROM assess_question q
    LEFT JOIN assess_choice c ON q.Ques_ID = c.Ques_ID
    WHERE q.Ques_ID = :ques_id
";

$stmt = $pdo->prepare($sql);
$stmt->execute(['ques_id' => $number]);
$questionData = $stmt->fetchAll(PDO::FETCH_ASSOC);

Separate the question and choices
$question = null;
$choices = [];
foreach ($questionData as $row) {
    if (!$question) {
        $question = [
            'Ques_ID' => $row['Ques_ID'],
            'Ques_Text' => $row['Ques_Text'],
            'URL' => $row['URL']
        ];
    }
    $choices[] = [
        'Choice_ID' => $row['Choice_ID'],
        'Choice_Text' => $row['Choice_Text'],
        'Answer' => $row['Answer']
    ];
}

 Pass data to the HTML
*/

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $number = isset($_POST['number']) ? (int)$_POST['number'] : 1; // Default to 1 if number is not set

    if ($action == 'Back') {
        $number = max($number - 1, 1); // Prevent going below 1
    } else if ($action == 'Next') {
        $number = $number + 1; // Increment question number
    }

    // Redirect to the question page with the new number
    header("Location: ../c3_ass.ques.php?n=$number");
    exit();
}