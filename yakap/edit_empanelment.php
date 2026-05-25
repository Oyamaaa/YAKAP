```php id="4u6jla"
<?php

session_start();

include 'db.php';

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$row = mysqli_fetch_assoc(

    mysqli_query(
    $conn,

    "SELECT *
    FROM empanelments
    WHERE id='$id'"

    )

);

?>

<!DOCTYPE html>

<html>

<head>

<title>
Edit Empanelment
</title>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<link rel="stylesheet"
href="style.css">

<style>

.edit-container{

max-width:850px;

margin:auto;

padding:40px 20px;

}

.edit-card{

background:white;

padding:35px;

border-radius:25px;

box-shadow:
0 15px 35px
rgba(
0,
0,
0,
.08
);

animation:fadeIn .4s ease;

}

.edit-header{

display:flex;

justify-content:space-between;

align-items:center;

margin-bottom:30px;

flex-wrap:wrap;

gap:15px;

}

.edit-header h2{

color:#0f172a;

font-size:30px;

}

.badge{

background:#2563eb;

color:white;

padding:8px 14px;

border-radius:30px;

font-size:13px;

font-weight:600;

}

.form-grid{

display:grid;

grid-template-columns:
repeat(
2,
1fr
);

gap:20px;

}

.form-group{

display:flex;

flex-direction:column;

}

.form-group label{

margin-bottom:8px;

font-weight:600;

color:#334155;

}

.form-group input,
.form-group select{

padding:14px;

border:
1px solid #cbd5e1;

border-radius:12px;

font-size:15px;

outline:none;

transition:.3s;

background:#f8fafc;

}

.form-group input:focus,
.form-group select:focus{

border-color:#2563eb;

background:white;

box-shadow:
0 0 0 4px
rgba(
37,
99,
235,
.12
);

}

.button-group{

margin-top:30px;

display:flex;

gap:15px;

flex-wrap:wrap;

}

.btn{

padding:14px 24px;

border:none;

border-radius:12px;

font-weight:600;

cursor:pointer;

text-decoration:none;

transition:.3s;

display:inline-block;

}

.btn-primary{

background:#2563eb;

color:white;

}

.btn-primary:hover{

background:#1d4ed8;

transform:translateY(-2px);

}

.btn-secondary{

background:#e2e8f0;

color:#0f172a;

}

.btn-secondary:hover{

background:#cbd5e1;

}

@keyframes fadeIn{

from{

opacity:0;

transform:translateY(15px);

}

to{

opacity:1;

transform:translateY(0);

}

}

@media(max-width:768px){

.form-grid{

grid-template-columns:1fr;

}

.edit-header{

flex-direction:column;

align-items:flex-start;

}

.edit-header h2{

font-size:24px;

}

}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <div class="logo">

        <h2>YAKAP</h2>

        <p>
            Mutual Care Agreement
        </p>

    </div>

    <a href="dashboard.php">
        Dashboard
    </a>

    <a href="empanelment.php">
        Empanelment
    </a>

    <a href="export_excel.php">
        Export Excel
    </a>

    <a href="logout.php">
        Logout
    </a>

</div>

<!-- MAIN -->

<div class="main">

    <!-- TOPBAR -->

    <div class="topbar">

        <h2>
            Edit Empanelment
        </h2>

        <div class="user">

            Welcome, 
            <?= $_SESSION['name']; ?>

        </div>

    </div>

    <!-- CONTENT -->

    <div class="edit-container">

        <div class="edit-card">

            <div class="edit-header">

                <h2>

                    Update Record

                </h2>

                <div class="badge">

                    Record ID:
                    <?= $row['id']; ?>

                </div>

            </div>

            <form
            action="update_empanelment.php"
            method="POST">

                <input
                type="hidden"
                name="id"
                value="<?= $row['id'] ?>">

                <div class="form-grid">

                    <div class="form-group">

                        <label>
                            Client Name
                        </label>

                        <input
                        type="text"
                        name="client_name"
                        value="<?= $row['client_name'] ?>"
                        required>

                    </div>

                    <div class="form-group">

                        <label>
                            Birthday
                        </label>

                        <input
                        type="date"
                        name="birthday"
                        value="<?= $row['birthday'] ?>"
                        required>

                    </div>

                    <div class="form-group">

                        <label>
                            PhilHealth ID
                        </label>

                        <input
                        type="text"
                        name="philhealth_no"
                        value="<?= $row['philhealth_no'] ?>"
                        required>

                    </div>

                    <div class="form-group">

                        <label>
                            Type
                        </label>

                        <select name="type">

                            <option value="M"
                            <?= ($row['type']=="M") ? "selected" : "" ?>>
                                Member
                            </option>

                            <option value="D"
                            <?= ($row['type']=="D") ? "selected" : "" ?>>
                                Dependent
                            </option>

                        </select>

                    </div>

                    <div class="form-group">

                        <label>
                            Empanelment Date
                        </label>

                        <input
                        type="date"
                        name="empanelment_date"
                        value="<?= $row['empanelment_date'] ?>"
                        required>

                    </div>

                </div>

                <div class="button-group">

                    <button
                    type="submit"
                    class="btn btn-primary">

                        Update Record

                    </button>

                    <a href="empanelment.php"
                    class="btn btn-secondary">

                        Back

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- FOOTER -->

<div class="footer">

    <img src="yama.png" alt="logo">

    <span>

        Empanelment System Developed by

        <strong>
            Joehaness John S. Ramos
        </strong>

    </span>

</div>

</body>

</html>
```
