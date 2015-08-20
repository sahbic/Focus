<?php

/**
 * Handles items interactions within the app
 *
 * PHP version 5
 *
 * @author Jason Lengstorf
 * @author Chris Coyier
 * @copyright 2009 Chris Coyier and Jason Lengstorf
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 *
 */
class FocusItems
{
    /**
     * The database object
     *
     * @var object
     */
    private $_db;

    /**
     * Checks for a database object and creates one if none is found
     *
     * @param object $db
     * @return void
     */
    public function __construct($db=NULL)
    {
        if(is_object($db))
        {
            $this->_db = $db;
        }
        else
        {
            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            $this->_db = new PDO($dsn, DB_USER, DB_PASS);
        }
    }

    /**
     * Loads all items associated with a user ID
     *
     * This function outputs <li> tags with items
     *
     * @return void
     */
    public function loadItemsByUser()
    {
      $sql = "SELECT
                  items.UserID, ItemID, ItemName, ItemType,  ItemColor, ItemThickness,
                  ItemFormality, ItemLength, ItemAttractiveness, ItemFitness
                  FROM items
              WHERE items.UserID=(
                  SELECT users.UserID
                  FROM users
                  WHERE users.Username=:user
              )";
        if($stmt = $this->_db->prepare($sql))
        {
            $stmt->bindParam(':user', $_SESSION['Username'], PDO::PARAM_STR);
            $stmt->execute();
            while($row = $stmt->fetch())
            {
                echo $this->formatItems($row);
            }
            $stmt->closeCursor();

        }
        else
        {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }

    }

    /**
     * Generates HTML markup for each list of item
     *
     * @param array $row    an array of the current item's attributes
     * @return string       the formatted HTML string
     */
    private function formatItems($row)
    {
        $name = $row['ItemName'];
        $type = $row['ItemType'];
        $itemid = $row['ItemID'];
      // If not logged in, manually append the <span> tag to each item
        if(!isset($_SESSION['LoggedIn'])||$_SESSION['LoggedIn']!=1)
        {
            $ss = "<span>";
            $se = "</span>";
        }
        else
        {
            $ss = NULL;
            $se = NULL;
        }
        return "<tr id=$itemid>
                  <td>$ss$name$se</td>
                  <td>$ss$type$se</td>
                  <td><input type='button' class='btn btn-sm btn-danger' value = 'Delete' id='delete-row'></td>
                </tr>";
    }

    /**
     * Adds an item to the database
     *
     * @return mixed    ID of the new item on success, error message on failure
     */
    public function addItem()
    {
        $userid = $_POST['userid'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $color = $_POST['color'];
        $thickness = $_POST['thickness'];
        $formality = $_POST['formality'];
        $length = $_POST['length'];
        $attractiveness = $_POST['attractiveness'];
        $fitness = $_POST['fitness'];

        $sql = "INSERT INTO items
                    (UserID, ItemName, ItemType, ItemColor, ItemThickness, ItemFormality, ItemLength, ItemAttractiveness, ItemFitness)
                VALUES (:userid, :name, :type, :color, :thickness, :formality, :length, :attractiveness, :fitness)";
        try
        {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->bindParam(':color', $color, PDO::PARAM_STR);
            $stmt->bindParam(':thickness', $thickness, PDO::PARAM_INT);
            $stmt->bindParam(':formality', $formality, PDO::PARAM_INT);
            $stmt->bindParam(':length', $length, PDO::PARAM_INT);
            $stmt->bindParam(':attractiveness', $attractiveness, PDO::PARAM_INT);
            $stmt->bindParam(':fitness', $fitness, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();

            return $this->_db->lastInsertId();
        }
        catch(PDOException $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * Removes an item from the database
     *
     * @return string    message indicating success or failure
     */
    public function deleteItem()
    {
        $itemid = $_POST['itemid'];
        $userid = $_POST['userid'];

        $sql = "DELETE FROM items
                WHERE ItemID=:itemid AND UserID=:userid
                LIMIT 1";
        try
        {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':itemid', $itemid, PDO::PARAM_STR);
            $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }

}

?>
