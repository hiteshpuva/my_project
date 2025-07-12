<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Home Page</title>
<style>
    html, body {
        height: 100%;
        margin: 0; 
        padding: 0;
    }
    body {
        font-family: Arial, sans-serif;
        min-height: 100vh;
        margin: 0;
        padding: 0;
        /* Remove display:flex here since sidebar is fixed */
    }
    .sidebar {
        position: fixed;          /* Fix sidebar to viewport */
        top: 0;
        left: 0;
        width: 250px;
        height: 100vh;            /* Full viewport height */
        background-color: #333;
        color: white;
        padding: 20px;
        box-sizing: border-box;
        overflow-y: auto;         /* Scrollbar if content is tall */
        flex-shrink: 0;
    }
    .sidebar a {
        display: block;
        color: white;
        text-decoration: none;
        padding: 10px;
        margin: 5px 0;
        background-color: #444;
        border-radius: 5px;
    }
    .sidebar a:hover {
        background-color: #555;
    }
    .content {
        margin-left: 250px;       /* Push content to right of fixed sidebar */
        padding: 20px;
        flex-grow: 1;
    }
    .header {
        background-color: #f4f4f4;
        padding: 15px;
        text-align: center;
        font-size: 20px;
        border-bottom: 2px solid #ccc;
    }
</style>
</head>
<body>

<div class="sidebar">
    <h2>Menu</h2>
    <a href="dashboard_page.php">Home</a>
    <a href="users_page_display.php">Users</a>
    <a href="pages_page_display.php">Pages</a>
    <a href="logout_page.php">Logout</a>
</div>

<div class="content">
