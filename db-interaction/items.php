<?php

session_start();

include_once "../inc/constants.inc.php";
include_once "../inc/class.items.inc.php";

if(!empty($_POST['action'])
&& isset($_SESSION['LoggedIn'])
&& $_SESSION['LoggedIn']==1)
{
    $listObj = new FocusItems();
    switch($_POST['action'])
    {
        case 'add':
            echo $listObj->addItem();
            break;
        // case 'update':
        //     $listObj->updateItem();
        //     break;
        // case 'sort':
        //     $listObj->changeListItemPosition();
        //     break;
        case 'delete':
            echo $listObj->deleteItem();
            break;
        default:
            header("Location: /");
            break;
    }
}
else
{
    header("Location: /closet.php");
    exit;
}

?>
