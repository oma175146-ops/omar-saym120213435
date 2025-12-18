<?php
$hashed_password = "";
$result = "";

if (isset($_POST['register'])) {
    $plaintext = $_POST["password"]; 
    
    if (!empty($plaintext)) {
        $hashed_password = password_hash($plaintext, PASSWORD_DEFAULT);
    } else {
        $hashed_password = "يرجى إدخال كلمة مرور أولاً";
    }
}

if (isset($_POST['verify_action'])) {
    $plaintext = $_POST["password"];
    $stored_hash = $_POST['stored_hash']; 
    if (!empty($plaintext) & !empty($stored_hash)) {
        if (password_verify($plaintext, $stored_hash)) {
            $result = "<span style='color: green;'> (متطابق)</span>"; 
        } else {
            $result = "<span style='color: red;'> (غير متطابق)</span>"; 
        }
        $hashed_password = $stored_hash; 
    } else {
        $result = "يجب الضغط على زر تجزئة قبل زر التحقق .";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>حل الواجب الثاني</title>
    <style>
        .container { border: 3px solid rgba(9, 201, 60, 1); padding: 20px; width: 500px; }
        .result-box { background: rgba(255, 255, 255, 1); padding: 10px; margin-top: 10px; word-break: break-all; }
        input[type="text"] { width: 100%; padding: 8px; margin-bottom: 10px; }
        button { padding: 10px 15px; cursor: pointer; }
    </style>
</head>
<body>

<div class="container">
    <h2>تجزئة كلمة المرور </h2>
    
    <form method="post" action="">
        <label>ادخل كلمة المرور هنا</label>
        <input type="text" name="password" placeholder="أدخل كلمة المرور هنا" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : ''; ?>">
        
        <input type="hidden" name="stored_hash" value="<?php echo $hashed_password; ?>">

        <div>
            <button type="submit" name="register">تجزئة</button>
            <button type="submit" name="verify_action">تحقق من التطابق </button>
        </div>
    </form>

    <?php if ($hashed_password): ?>
        <div class="result-box">
            <strong>التجزئة:</strong><br>
            <?php echo $hashed_password; ?> </div>
    <?php endif; ?>

    <?php if ($result): ?>
        <div class="result-box">
            <strong>حالة التطابق:</strong><br>
            <?php echo $result; ?> </div>
    <?php endif; ?>
</div>

</body>
</html>
