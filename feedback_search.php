<?php
    include($_SERVER['DOCUMENT_ROOT'].'/Juncle/database.php');

    if(isset($_POST['input'])){
        $input = $_POST['input'];
        $query =    "SELECT 
                        system_feedback.feedback_id, 
                        user.user_id, 
                        user.user_last_name, 
                        user.user_first_name, 
                        system_feedback.rating, 
                        system_feedback.feedback, 
                        system_feedback.rating_date, 
                        system_feedback.status 
                    FROM user, system_feedback 
                    WHERE user.user_id = system_feedback.user_id 
                    AND user.user_id = system_feedback.user_id LIKE '{$input}%' AND feedback LIKE '{$input}%' AND rating LIKE '{$input}%' ";
        /* $query = "SELECT * FROM system_feedback WHERE user_id LIKE '{$input}%' AND feedback LIKE '{$input}%' AND rating LIKE '{$input}%'"; */

                    
        
        /* $query = "SELECT * FROM system_feedback WHERE user_id LIKE '{$input}%' OR feedback LIKE '{$input}%' OR rating LIKE '{$input}%'";
        $query = "select * from system_feedback inner join user on user.user_id = system_feedback.user_id";
 */

        $result = mysqli_query($connection,$query);

            if(mysqli_num_rows($result) > 0){?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Feedback ID</th>
                            <th>User ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Rating</th>
                            <th>Feedback</th>
                            <th>Rating Date</th>
                            <th>Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            while($row = mysqli_fetch_assoc($result)){                          
                                $feedback_id = $row['feedback_id'];
                                $user_id = $row['user_id'];
                                $user_first_name = $row['user_first_name'];
                                $user_first_name = $row['user_last_name'];
                                $rating = $row['rating'];
                                $feedback = $row['feedback'];
                                $rating_date =$row['rating_date'];
                        ?>
                        <tr>
                            <td><?php echo $row['feedback_id']; ?></td>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['user_first_name']; ?></td>
                            <td><?php echo $row['user_last_name']; ?></td>
                            <td><?php echo $row['rating']; ?></td>
                            <td><?php echo $row['feedback']; ?></td>
                            <td><?php echo $row['rating_date'];?></td>
                            <td>
                        </tr>
                        <?php
                            }
                        ?>

                    </tbody>
            
                </table>
                    <?php
            }
                        else{
                            echo "<h6 class='text-danger text-center mt-3'>No Data is Found</h6>";
                        }
        }
?>
