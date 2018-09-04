<?php 
include("include/db.php");
include("include/utility.php");
if(!isset($_SESSION["logged_in_admin"])){
	if(!check_admin_cookie()){
		header("Location: login.php");
		die;
	}	
}
if(isset($_GET["id"]) && $_SESSION["logged_in_admin"]["branch_id"]==0){
	$_SESSION["current_branch_id"]=slash($_GET["id"]);
	header("Location: index.php");
	die;
}

?>
<?php include("include/header.php");?>		
   <div class="page-header">
        <h1 class="title">Branches</h1>
        <ol class="breadcrumb">
            <li class="active">Welcome to <?php echo $site_title?> Dashboard.</li>
        </ol>
		<?php
        $branches=doquery("Select * from branch where status = 1 order by title",$dblink);
        if( numrows( $branches ) > 0 ){
            ?>
            <ul class="menu-boxes clearfix">
                <?php
                while( $branch = dofetch( $branches ) ){
                    ?>
                    <li class="col-xs-6 col-md-2 col-sm-3">
                        <a href="branches.php?id=<?php echo $branch["id"]?>">
                            <span class="project-icon"><img width="40px" height="40px" alt="Menu Icon" src="images/pdf.png"></span>
                            <span><?php echo unslash( $branch[ "title" ] );?></span>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <?php
        }
        ?>
    </div>
</div>
<style>
.menu-boxes a {
    display:  block;
    position: relative;
    max-width: 150px;
    padding: 0;
}

.menu-boxes a:before {
    content:  "";
    padding-top: 100%;
    display: block;
}

span.project-icon {
    position:  absolute;
    top: 0;
    left: 0;
    height:  60%;
    width:  100%;
    display:  block;
}

span.project-icon img {
    position:  absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    margin: 0;
}

.menu-boxes span:last-child {
    position:  absolute;
    bottom: 0;
    width:  100%;
    text-align:  center;
}
</style>
<?php include("include/footer.php");?>
	