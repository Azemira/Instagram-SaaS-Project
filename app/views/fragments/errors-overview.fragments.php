<div class='skeleton' id="accounts">
    <div class="container-1200">
        <div class="row clearfix">
            <?/*php print_r($Errors); */ ?>

            <?php
            foreach ($Errors as $plugin_name => $value) {


                // print_r($value);
                // die();
                echo'<h3 class="error-plugin-title">' .$plugin_name .'</h3>';
                echo ' <table class="table table-hover table-body-scroll">
                        <thead>
                        <tr>
                        <th scope="col">#</th>
                        <!-- <th scope="col">Plugin Name</th> -->
                        <th scope="col">Message</th>
                        <th scope="col">Details</th>
                        <th scope="col">Date</th>

                        </tr>
                        </thead>';

                echo "<tbody>";
                if ($value != null) {


                    foreach ($value as $key => $value2) {

                        $message = json_decode($value2->data);

                        $print_message = $message->error->msg;
                        $details = "";
                        if (!empty($message->error->details)) {

                            $details = $message->error->details;
                        }
                        echo "<tr>";
                        echo "<td>$key</td>";
                        // echo "<td>$plugin_name</td>";
                        echo "<td>$print_message</td>";
                        echo "<td>$details</td>";
                        echo "<td>$value2->date</td>";

                        //    echo "<td>details</td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td>0</td>";
                    echo "<td>$plugin_name</td>";
                    echo "<td>Empty table</td>";
                    echo "<td>Empty table</td>";
                    echo "<td>Empty table</td>";
                }
                echo "</tbody>";

                echo ' </table>';
            }
            // echo"<div>Chat Bot</div>";
            echo'<h3 class="error-plugin-title">Chat Bot</h3>';

            echo ' <table class="table table-hover table-body-scroll">
                <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Plugin Name</th>
                <th scope="col">Message</th>
                <th scope="col">Details</th>
                <th scope="col">Date</th>

                </tr>
                </thead>';


            echo "<tbody>";
            
            if (!empty($ErrorsChatbot['Chat Bot'])) {


                foreach ($ErrorsChatbot['Chat Bot'] as $key => $value2) {

                    $print_message = $value2->error_action;
                    $details = $value2->error_message;


                    echo "<tr>";
                    echo "<td>$key</td>";
                    echo "<td>Chat Bot</td>";
                    echo "<td>$print_message</td>";
                    echo "<td>$details</td>";
                    echo "<td>$value2->date</td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo "<td>0</td>";
                echo "<td>Chat Bot</td>";
                echo "<td>Empty table</td>";
                echo "<td>Empty table</td>";
                echo "<td>Empty table</td>";
            }
            echo "</tbody>";
            echo ' </table>';


            ?>

        </div>
    </div>
</div>