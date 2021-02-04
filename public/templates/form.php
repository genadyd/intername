<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/styles/styles.css">
    <title>Document</title>
</head>
<body>
<div class="form_container">
<form action="/form" method="post" class="add_post" enctype="multipart/form-data">
    <label for="user_name">User Name</label>
    <div class="input_area">
        <input type="text" name="user_name" id="user_name" required>
    </div>
    <label for="user_email">User Email</label>
    <div class="input_area">
        <input type="email" name="user_email" id="user_email" required>
    </div>
    <label for="post_title">Post Title</label>
    <div class="input_area">
    <input type="text" name="post_title" id="post_title" required>
    </div>
    <label for="post_body">Post Text</label>
    <div class="input_area">
    <textarea name="post_body" id="post_body" required></textarea>
    </div>
    <input type="submit" value="add_post">
</form>
</div>

</body>
</html>
