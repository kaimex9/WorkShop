<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workshop</title>
</head>

<body>
    <h1>My Workshop</h1>
    <form method='POST' action='ViewReparation.php'>
        <label>
            Type:
            <select name="rol">
                <option value='client'>Client</option>
                <option value='employee'>Employee</option>
            </select>
        </label><br><br>
        <input type='submit' name="send" value="Enviar">
    </form>
</body>

</html>