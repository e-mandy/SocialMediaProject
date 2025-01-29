<?php
require 'discuss_functions.php';
if(1){
    $allDiscussions = Discussion::getAll(1);
    ?>
    <table>
            <th>
                <td>Id d'user</td>
                <td>Pseudo</td>
            </th>
    <?php
    foreach($allDiscussions as $value){
        ?>
            <tr>
                <td><?php echo $value["id_receiver"] ?></td>
                <td><?php echo $value["pseudo"] ?></td>
            </tr>
        </table>
        <?php
    }
}
?>
