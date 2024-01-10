
<table border="1"><?php
require('config.php');
                                    $query = "SELECT * FROM crm_contact";
                                    $result = mysqli_query($conn, $query);
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr>";
                                        echo "<td>".$i."</td>";
                                        echo "<td>".$row['contact_first']." ".$row['contact_last']."</td>";
                                        echo "<td>".$row['company']."</td>";
                                        echo "<td>".$row['industry']."</td>";
                                        echo "<td>".$row['website']."</td>";
                                        echo "<td>".$row['mobile']."</td>";
                                        echo "<td>".$row['city']."</td>";
                                        echo "<td>".$row['status']."</td>";
                                        echo "</tr>";
                                        $i++;
                                    }
                                    ?>
                                </table>

