<?php

session_start();

include 'db.php';

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit();
}

/* TOTAL RECORDS */

$total_query = mysqli_query(
$conn,
"SELECT COUNT(*) total
FROM empanelments"
);

$total = mysqli_fetch_assoc($total_query);

/* MEMBERS */

$m_query = mysqli_query(
$conn,
"SELECT COUNT(*) total
FROM empanelments
WHERE type='M'"
);

$m = mysqli_fetch_assoc($m_query);

/* DEPENDENTS */

$d_query = mysqli_query(
$conn,
"SELECT COUNT(*) total
FROM empanelments
WHERE type='D'"
);

$d = mysqli_fetch_assoc($d_query);

/* TODAY RECORDS */

$today_query = mysqli_query(
$conn,
"SELECT COUNT(*) total
FROM empanelments
WHERE DATE(empanelment_date)=CURDATE()"
);

$today = mysqli_fetch_assoc($today_query);

?>

<!DOCTYPE html>

<html>

<head>

<title>
YAKAP Dashboard
</title>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<!-- TAB ICON -->

<link rel="icon"
type="image/png"
href="yama.png">

<link rel="stylesheet"
href="style.css">

<style>

.dashboard-banner{

background:
linear-gradient(
135deg,
#1e3a8a,
#2563eb
);

border-radius:25px;

padding:40px;

color:white;

margin-bottom:35px;

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

.banner-text h1{

font-size:38px;

margin-bottom:10px;

}

.banner-text p{

font-size:16px;

opacity:.9;

}

.banner-logo img{

width:120px;

height:120px;

object-fit:contain;

filter:drop-shadow(
0 10px 20px rgba(0,0,0,.2)
);

}

/* CARD ENHANCEMENT */

.cards{

display:grid;

grid-template-columns:
repeat(
auto-fit,
minmax(
240px,
1fr
)
);

gap:25px;

}

.card{

position:relative;

overflow:hidden;

background:white;

padding:30px;

border-radius:22px;

box-shadow:
0 10px 25px
rgba(
0,
0,
0,
.06
);

transition:.3s;

}

.card:hover{

transform:
translateY(-8px);

}

.card::before{

content:"";

position:absolute;

top:0;

left:0;

width:100%;

height:6px;

background:
linear-gradient(
90deg,
#2563eb,
#1d4ed8
);

}

.card h4{

color:#64748b;

margin-bottom:15px;

font-size:16px;

}

.card h1{

font-size:48px;

color:#0f172a;

margin-bottom:10px;

}

.card p{

color:#94a3b8;

font-size:14px;

}

/* QUICK INFO */

.quick-info{

margin-top:35px;

background:white;

padding:30px;

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

.quick-info h3{

margin-bottom:20px;

color:#0f172a;

}

.info-grid{

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

}

.info-box{

background:#f8fafc;

padding:20px;

border-radius:18px;

border:
1px solid #e2e8f0;

}

.info-box span{

display:block;

font-size:14px;

color:#64748b;

margin-bottom:8px;

}

.info-box strong{

font-size:22px;

color:#0f172a;

}

/* MOBILE */

@media(max-width:768px){

.dashboard-banner{

padding:30px 25px;

text-align:center;

justify-content:center;

}

.banner-text h1{

font-size:28px;

}

.banner-logo img{

width:90px;

height:90px;

}

.card h1{

font-size:38px;

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
            Dashboard
        </h2>

        <div class="user">

            Welcome,
            <?= $_SESSION['name']; ?>

        </div>

    </div>

    <!-- CONTENT -->

    <div class="content">

        <!-- BANNER -->

        <div class="dashboard-banner">

            <div class="banner-text">

                <h1>

                    Welcome to YAKAP

                </h1>

                <p>

                    Manage and monitor empanelment
                    records efficiently and securely.

                </p>

            </div>

            <div class="banner-logo">

                <img src="yama.png" alt="logo">

            </div>

        </div>

        <!-- CARDS -->

        <div class="cards">

            <div class="card">

                <h4>
                    Total Empanelment
                </h4>

                <h1>
                    <?= $total['total']; ?>
                </h1>

                <p>
                    Total registered records
                </p>

            </div>

            <div class="card">

                <h4>
                    Members
                </h4>

                <h1>
                    <?= $m['total']; ?>
                </h1>

                <p>
                    Registered members
                </p>

            </div>

            <div class="card">

                <h4>
                    Dependents
                </h4>

                <h1>
                    <?= $d['total']; ?>
                </h1>

                <p>
                    Registered dependents
                </p>

            </div>

            <div class="card">

                <h4>
                    Added Today
                </h4>

                <h1>
                    <?= $today['total']; ?>
                </h1>

                <p>
                    Records added today
                </p>

            </div>

        </div>

        <!-- QUICK INFO -->

        <div class="quick-info">

            <h3>

                System Overview

            </h3>

            <div class="info-grid">

                <div class="info-box">

                    <span>
                        Current User
                    </span>

                    <strong>
                        <?= $_SESSION['name']; ?>
                    </strong>

                </div>

                <div class="info-box">

                    <span>
                        System Name
                    </span>

                    <strong>
                        YAKAP
                    </strong>

                </div>

                <div class="info-box">

                    <span>
                        Current Date
                    </span>

                    <strong>
                        <?= date("F d, Y"); ?>
                    </strong>

                </div>

            </div>

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