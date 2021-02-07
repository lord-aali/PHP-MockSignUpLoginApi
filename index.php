<?php
include_once "./classes/JsonDatabase.php";
$db = new JsonDatabase();
$users = $db->getAllUsers();
$self_uri = $_SERVER["SCRIPT_URI"];
$url = "";
if (strpos($self_uri, "index.php"))
    $url = substr($self_uri, 0, -9);
else
    $url = $self_uri . "admin.php";

$appActive = $db->getAppConfig()
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
    <style>
        .container {
            border-radius: 8px;
            border: 1px solid silver;
            box-shadow: 0 0 3px 3px #efefef;
            overflow: hidden;
            margin-bottom: 16px;
        }

        h1, h2 {
            margin: 0;
            padding: 8px;
        }

        .header {
            background-color: skyblue;
        }

        .page_title h1 {
            text-align: center;
        }

        .content {
            padding: 8px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid silver;
            padding: 8px 16px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header page_title">
        <h1>Admin Panel</h1>
    </div>
</div>
<div class="container">
    <div class="header">
        <h2>Settings</h2>

    </div>
    <div class="content">
        <div class="col-2">
            <label for="is_app_active">App Active</label>
            <input <?php echo ($appActive["app_active"]) ? "checked" : "" ?> id="is_app_active"
                                                                             onclick="appActivation(this)"
                                                                             type="checkbox">
        </div>
    </div>
</div>
<div class="container">
    <div class="header">
        <h2>Users</h2>
    </div>
    <div class="content">
        <table>
            <tr>
                <th>Action</th>
                <th>Username</th>
                <th>Name</th>
                <th>Lastname</th>
                <th>Password</th>
                <th>Key</th>
            </tr>
            <?php
            if (!is_null($users) && $users) {
                foreach ($users as $user) {
                    $activationStr = $user["active"] ? "deactivate" : "activate";
                    echo "<tr>";
                    echo "<td><a  href='' onclick='activation(this)'>$activationStr</a> / ";
                    echo "<a  href='' onclick='activation(this)'>delete</a></td>";
                    echo "<td class=\"username\">${user["username"]}</td>";
                    echo "<td>${user["name"]}</td>";
                    echo "<td>${user["lastname"]}</td>";
                    echo "<td>${user["password"]}</td>";
                    echo "<td>${user["key"]}</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>
</div>
</body>
<script>
    function appActivation(view) {
        if (view.checked) {
            order("deactivate_app", null)
        } else {
            order("activate_app", null)
        }
    }

    function activation(view) {
        let username = view.parentElement.parentElement.getElementsByClassName("username")[0].innerHTML;
        order(view.textContent, username)
    }

    function order(order, value) {
        let url = "<?php echo $url?>";
        let xhr = new XMLHttpRequest();
        xhr.onload = function () {
            alert(xhr.responseText);
        }
        xhr.addEventListener("error", function (e) {
            alert(e.type)
        });
        xhr.open('POST', url);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(JSON.stringify({order: order, value: value}));
    }
</script>
</html>