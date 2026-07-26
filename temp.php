<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Dashboard</title>
</head>

<body>
    <h1>Add account</h1>
    <form action="create.php" method="post">
        <input type="number" name="id" placeholder="ID">
        <input type="text" name="fullname" placeholder="Nama">
        <input type="text" name="displayname" placeholder="displayName">
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="password" placeholder="Password">
        <input type="text" name="role" placeholder="Role (teacher/president/vice/treasurer/secretary/student)">
        <button type="submit">Add</button>
    </form>
</body>

</html>
