<?php 
if(!$_SESSION['isAdmin']) {
    header("Location: home.php");
    exit();
}
session_start();
$title = "Credit Management"; 
include("template/base_header.php"); 

$searchQuery = htmlentities($_GET['searchQuery']);

require("api.php");
$api = new AprilInstituteScheduler_API();
$api -> connect();
$users = $api -> getUserCredits($searchQuery);


echo '<div class="container">';
echo '<h1 class="header-font">Credit Management</h1>';
echo '
<div class="row valign-wrapper">
  <div class="col s8">
    <nav>
        <div class="nav-wrapper">
        <form action="editCredits.php" method="GET">
            <div class="input-field april-blue">
            <input placeholder="Search By Name" id="search" type="search" name="searchQuery" required>
            <label class="label-icon" for="search">
                <i class="material-icons">search</i> 
            </label>
            <i class="material-icons">close</i>
            </div>
        </form>
        </div>
    </nav>
  </div>
  <div class="col s4">
    <form>
        <input id="search" type="hidden" name="searchQuery" value=" "/>
        <button class="btn-large april-blue">Display all users</button>
    </form>
  </div>
</div>
';

if ($searchQuery === "") {

} else {
    echo '<table class="highlight responsive-table">';
    echo 
        '<thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Credits</th>
                <th>Edit</th>
            </tr>
        </thead>';

    echo '<tbody>';
    while ($row = $users -> fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['last_name'] . ', ' . $row['first_name']. '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['credits'] . '</td>';
        echo '<td> <a class="waves-effect waves-light btn modal-trigger april-orange" href="#' . $row['uid'] . '">
             <i class="material-icons right">edit</i>Edit
        </a> </td>';
        echo '</tr>';
        echo '<div id="' . $row['uid'] . '" class="modal">';
        echo '
            <form method="POST" action="process_editCredits.php">
                <div class="modal-content">
                    <h4>' . $row['last_name'] . ', ' . $row['first_name'] . '</h4>
                    <div class="input-field">
                        <input type="hidden" name="uidToUpdate" value="' . $row['uid']. '">
                        <input type="hidden" name="searchQuery" value="' . $searchQuery . '">
                        <div class="row">
                            <div class="col s6">
                                <input name="creditAmt' . $row['uid'] . '" id="creditAmt'. $row['uid'] .'" value="' . $row['credits'] . '" type="text" class="validate">
                                <label class="active" for="creditAmt' . $row['uid'] . '">Credit Amount</label>
                            </div>
                            <button type="button" onclick="addOne(' . $row['uid'] . ', 1)" class="s3 waves-effect waves-light btn april-orange">
                                <i class="material-icons">exposure_plus_1</i>
                            </button>
                            <button type="button" onclick="addOne(' . $row['uid'] . ', -1)" class="s3 waves-effect waves-light btn april-orange">
                                <i class="material-icons">exposure_neg_1</i> 
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                    <button type="submit" class="waves-effect btn-flat">Submit Change</button>
                </div>
            </form>
        ';
        echo '</div>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';

}
?>

<script type="text/javascript">
    function addOne(uid, amt) {
        id = "creditAmt".concat('', uid)
        document.getElementById(id).value = parseInt(document.getElementById(id).value) + parseInt(amt)
        if (document.getElementById(id).value < 0) {
            document.getElementById(id).value = 0
        }
    }
</script>

<?php include("template/base_footer.php"); ?>