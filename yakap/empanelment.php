<?php

session_start();

include 'db.php';

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit();
}

/* SEARCH */

$search = "";
$year = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
}

if(isset($_GET['year'])){
    $year = $_GET['year'];
}

/* QUERY */

$sql_str = "SELECT * FROM empanelments WHERE 1=1";

if($search != ""){

    $sql_str .= "
    AND (
        client_name LIKE '%$search%'
        OR philhealth_no LIKE '%$search%'
    )";

}

if($year != ""){

    $sql_str .= "
    AND YEAR(empanelment_date)='$year'";

}

$sql_str .= " ORDER BY id DESC";

$sql = mysqli_query($conn, $sql_str);

/* TOTAL RECORDS */

$total_records = mysqli_num_rows($sql);

?>

<!DOCTYPE html>

<html>

<head>

<title>
Empanelment Records
</title>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<link rel="icon"
type="image/png"
href="yama.png">

<link rel="stylesheet"
href="style.css">

<style>

/* PAGE HEADER */

.page-banner{

background:
linear-gradient(
135deg,
#1e3a8a,
#2563eb
);

padding:35px;

border-radius:25px;

color:white;

margin-bottom:30px;

display:flex;

justify-content:space-between;

align-items:center;

flex-wrap:wrap;

gap:20px;

box-shadow:
0 15px 35px
rgba(
37,
99,
235,
.25
);

}

.page-banner h1{

font-size:34px;

margin-bottom:10px;

}

.page-banner p{

opacity:.9;

}

.page-banner img{

width:90px;

height:90px;

object-fit:contain;

}

/* FORM ENHANCEMENT */

.form-box{

padding:35px;

border-radius:25px;

}

.form-box h3{

font-size:24px;

margin-bottom:10px;

color:#0f172a;

}

.form-grid{

margin-top:25px;

}

/* INPUT DESIGN */

.form-group input,
.form-group select{

background:#f8fafc;

transition:.3s;

}

.form-group input:focus,
.form-group select:focus{

border-color:#2563eb;

box-shadow:
0 0 0 4px
rgba(
37,
99,
235,
.12
);

background:white;

}

/* ACTION BAR */

.action-bar{

background:white;

padding:25px;

border-radius:22px;

margin-bottom:25px;

box-shadow:
0 10px 25px
rgba(
0,
0,
0,
.05
);

display:flex;

justify-content:space-between;

align-items:center;

gap:20px;

flex-wrap:wrap;

}

.filter-form{

display:flex;

gap:15px;

flex-wrap:wrap;

flex:1;

}

/* TABLE */

.table-box{

border-radius:25px;

overflow:auto;

}

table{

min-width:900px;

}

th{

background:#eff6ff;

color:#1e3a8a;

font-weight:700;

}

td{

vertical-align:middle;

}

tr:hover{

background:#f8fafc;

}

/* TYPE BADGE */

.type-badge{

padding:8px 14px;

border-radius:30px;

font-size:12px;

font-weight:700;

display:inline-block;

}

.member{

background:#dcfce7;

color:#166534;

}

.dependent{

background:#dbeafe;

color:#1d4ed8;

}

/* STATS */

.stats-bar{

display:grid;

grid-template-columns:
repeat(
auto-fit,
minmax(
220px,
1fr
)
);

gap:20px;

margin-bottom:30px;

}

.stats-card{

background:white;

padding:25px;

border-radius:22px;

box-shadow:
0 10px 25px
rgba(
0,
0,
0,
.05
);

}

.stats-card span{

display:block;

font-size:14px;

color:#64748b;

margin-bottom:10px;

}

.stats-card h2{

font-size:36px;

color:#0f172a;

}

/* MOBILE */

@media(max-width:768px){

.page-banner{

text-align:center;

justify-content:center;

}

.page-banner h1{

font-size:28px;

}

.action-bar{

flex-direction:column;

align-items:stretch;

}

.filter-form{

flex-direction:column;

}

}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <div class="logo">

        <h2>
            YAKAP
        </h2>

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

            Empanelment Records

        </h2>

        <div class="user">

            Welcome,
            <?= $_SESSION['name']; ?>

        </div>

    </div>

    <!-- CONTENT -->

    <div class="content">

        <!-- BANNER -->

        <div class="page-banner">

            <div>

                <h1>

                    Empanelment Management

                </h1>

                <p>

                    Manage, monitor and organize
                    all empanelment records efficiently.

                </p>

            </div>

            <img src="yama.png" alt="logo">

        </div>

        <!-- STATS -->

        <div class="stats-bar">

            <div class="stats-card">

                <span>
                    Total Records
                </span>

                <h2>
                    <?= $total_records ?>
                </h2>

            </div>

            <div class="stats-card">

                <span>
                    Current Year
                </span>

                <h2>
                    <?= date("Y") ?>
                </h2>

            </div>

        </div>

        <!-- FORM -->

        <div class="form-box">

            <h3>

                Add New Empanelment

            </h3>

            <form
            action="save_empanelment.php"
            method="POST">

                <div class="form-grid">

                    <div class="form-group">

                        <label>
                            Client Name
                        </label>

                        <input
                        type="text"
                        name="client_name"
                        placeholder="Enter Client Name"
                        required>

                    </div>

                    <div class="form-group">

                        <label>
                            Birthday
                        </label>

                        <input
                        type="date"
                        name="birthday"
                        required>

                    </div>

                    <div class="form-group">

                        <label>
                            PhilHealth ID
                        </label>

                        <input
                        type="text"
                        name="philhealth_no"
                        placeholder="Enter PhilHealth ID"
                        required>

                    </div>

                    <div class="form-group">

                        <label>
                            Type
                        </label>

                        <select name="type">

                            <option value="M">
                                Member
                            </option>

                            <option value="D">
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
                        required>

                    </div>

                </div>

                <br>

                <button class="btn btn-primary">

                    Save Record

                </button>

            </form>

        </div>

        <!-- ACTION BAR -->

        <div class="action-bar">

            <form
            method="GET"
            class="filter-form">

                <input
                class="search-box"
                type="text"
                name="search"
                placeholder="Search Name / PhilHealth"
                value="<?= $search ?>">

                <select
                name="year"
                class="search-box">

                    <option value="">
                        All Year
                    </option>

                    <?php

                    for($y=2020;$y<=2035;$y++){

                        $selected =
                        ($year==$y)
                        ? "selected"
                        : "";

                        echo "
                        <option value='$y' $selected>
                            $y
                        </option>";

                    }

                    ?>

                </select>

                <button class="btn btn-primary">

                    Filter

                </button>

            </form>

            <a href="
            export_excel.php?search=<?= $search ?>&year=<?= $year ?>
            "
            class="btn btn-success">

                Download CSV

            </a>

        </div>

        <!-- TABLE -->

        <div class="table-box">

            <table>

                <tr>

                    <th>
                        Name
                    </th>

                    <th>
                        Birthday
                    </th>

                    <th>
                        PhilHealth ID
                    </th>

                    <th>
                        Type
                    </th>

                    <th>
                        Date
                    </th>

                    <th>
                        Action
                    </th>

                </tr>

                <?php while($row=mysqli_fetch_assoc($sql)) { ?>

                <tr>

                    <td>
                        <?= $row['client_name'] ?>
                    </td>

                    <td>
                        <?= date(
                        "F d, Y",
                        strtotime($row['birthday'])
                        ) ?>
                    </td>

                    <td>
                        <?= $row['philhealth_no'] ?>
                    </td>

                    <td>

                        <?php if($row['type']=="M"){ ?>

                            <span class="type-badge member">

                                Member

                            </span>

                        <?php } else { ?>

                            <span class="type-badge dependent">

                                Dependent

                            </span>

                        <?php } ?>

                    </td>

                    <td>
                        <?= date(
                        "F d, Y",
                        strtotime($row['empanelment_date'])
                        ) ?>
                    </td>

                    <td>

                        <a class="btn btn-primary"
                        href="
                        edit_empanelment.php?id=<?= $row['id'] ?>
                        ">

                            Edit

                        </a>

                        <a class="btn btn-danger"
                        href="
                        delete_empanelment.php?id=<?= $row['id'] ?>
                        "
                        onclick="
                        return confirm('Delete this record?')
                        ">

                            Delete

                        </a>

                    </td>

                </tr>

                <?php } ?>

            </table>

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