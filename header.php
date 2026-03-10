<style>
body{
    margin:0;
    font-family:Arial;
}


.sidebar{
    width:220px;
    height:100vh;
    background:#2c3e50;
    position:fixed;
    left:0;
    top:0;
    transition:0.3s;
    padding-top:20px;
}

.sidebar a{
    display:block;
    color:white;
    padding:12px 20px;
    text-decoration:none;
}

.sidebar a:hover{
    background:#34495e;
}

.header{
    height:60px;
    background:#2c3e50;
    color:white;
    padding:15px;
    margin-left:220px;
    transition:0.3s;
    display:flex;
    align-items:center;
}

.header button{
    margin-right:15px;
    padding:5px 10px;
}

.content{
    margin-left:220px;
    padding:30px;
    transition:0.3s;
}


.sidebar.collapsed{
    left:-220px;
}


.sidebar.collapsed + .header{
    margin-left:0;
}

.sidebar.collapsed ~ .content{
    margin-left:0;
}
</style>
<div class="sidebar" id="sidebar">

<a href="../admin/dashboard.php">Dashboard</a>
<a href="../employees/list.php">Employees</a>
<a href="../holidays/list.php">Holidays</a>
<a href="../salary/list.php">Salaries</a>
<a href="../attendance/list.php">Attendance</a>
<a href="../admin/logout.php">Logout</a>

</div>

<div class="header">
<button onclick="toggleSidebar()">☰</button>
Admin Panel
</div>

<script>
function toggleSidebar(){
    document.getElementById("sidebar").classList.toggle("collapsed");
}
</script>