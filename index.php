<?php 
include("include/db.php");
include("include/utility.php");
include("include/session.php");
$page="index";
?>
<?php include("include/header.php");?>		
   <div class="page-header">
        <h1 class="title">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="active">Welcome to <?php echo $site_title?> Dashboard.</li>
        </ol>
    </div>
    <div class="container-widget row">
        <div class="col-md-12">
            <?php
            $res=doquery("Select * from menu where parent_id=0 and id in (select menu_id from menu_2_admin_type where admin_type_id='".$_SESSION[ "logged_in_admin" ][ "admin_type_id" ]."') order by sortorder ASC",$dblink);
            if(numrows($res)>0){
                while($rec=dofetch($res)){
                    ?>
                    <h2 class="title"><?php echo $rec["title"]?></h2>
                    <?php
                    $res1=doquery("Select * from menu where parent_id=".$rec["id"]." and id in (select menu_id from menu_2_admin_type where admin_type_id='".$_SESSION[ "logged_in_admin" ][ "admin_type_id" ]."') order by sortorder ASC",$dblink);
                    if(numrows($res1)>0){
                        ?>
                        <ul class="menu-boxes clearfix">
                            <?php
                            while($rec1=dofetch($res1)){
                                ?>
                                <li class="col-xs-6 col-md-2 col-sm-3">
                                    <a href="<?php echo $rec1["url"]?>">
                                        <span class="project-icon"><img width="40px" height="40px" title="<?php echo $rec1['title'];?>" alt="Menu Icon" src="<?php echo $file_upload_root?>menu/<?php echo $rec1["icon"]?>"></span>
                                        <span><?php echo $rec1["title"];?></span>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                }
            }
            ?>
        </div>
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
	