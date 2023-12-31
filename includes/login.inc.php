<?php 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username =$_POST["username"];
    $pwd = $_POST["pwd"];

    try {
        require_once 'db.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php'

        // Error handlers
        $errors = [];
if(is_input_empty($username, $pwd)){
    $errors["empty_input"] = " Fill in all fields";
}
$result = get_user( $pdo, $username);

if(is_username_wrong(($result)){
    $errors["login_incorrect"] = "Incorrect login info";
})
if (is_username_taken($pdo, $username)){
    $errors["username_taken"] = " Username already taken!";
}
if(!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])){
    $errors["login_incorrect"] = "Incorrect ogin info!";
}
require_once 'config_session.inc.php';
if($errors) {
    $_SESSION["errors_signup"] = $errors;
    $signupData = [
        "username" => $username,
        "email" =>$email
    ];
    $_SESSION["signup_data"] =$signupData;
    header("location:../index.php");
    die();
}
$newSessionId = session_create_id();
$sessionId = $newSessionId . "_" .$result["id"];
session_id($sessionId);
$_SESSION["user_id"] = $result["id"];
$_SESSION["user_username"] = htmlspecilchars($result["username"]);
$_SESSIO["last_regeneration"] = time();
header("location:../index.php?login=success");
$pdo = null;
$statement = null;

}

    } catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    } 
}else {
    header("location:../ index.php");
    die();
}
?>