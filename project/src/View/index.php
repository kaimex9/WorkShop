<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workshop</title>
</head>

<body>
    <h1>My Workshop</h1>
    <form type='POST' action=''>
        <label>
            Type:
            <select name="accountType">
                <option value='client'>Client</option>
                <option value='employee'>Employee</option>
            </select>
        </label><br><br>
        <label>
            ID: <input name="id" type="number" min="1000" max="9999" placeholder="1234" required>
        </label><br><br>
        <label>
            Name: <input name="name" type="text" placeholder="Juan" required>
        </label><br><br>
        <label>
            Register date: <input name="date" type="date" required>
        </label><br><br>
        <label>
            License: <input name="license" type="text" pattern="^\d{4}[A-Za-z]{3}$" placeholder="9999AAA" required>
        </label><br><br>
        <input type='submit' value='Buscar'>
    </form>
</body>

</html>