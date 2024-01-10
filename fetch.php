<!DOCTYPE html>
<html>
<head>
    <title>City Selector</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form>
        <label for="state">Select State:</label>
        <select id="state" name="state">
            <option value="">Select State</option>
            <?php

include_once("config.php");
                // Assuming you have a database connection established
                $query = "SELECT DISTINCT State FROM cities order by State";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row['State'] . "'>" . $row['State'] . "</option>";
                }
            ?>
        </select>

        <br>

        <label for="district">Select District:</label>
        <select id="district" name="district">
            <option value="">Select District</option>
        </select>

        <br>

        <label for="city">Select City:</label>
        <select id="city" name="city">
            <option value="">Select City</option>
        </select>
    </form>

    <script>
        $(document).ready(function() {
            $('#state').change(function() {
                var state = $(this).val();
                if (state !== '') {
                    $.ajax({
                        url: 'get_data.php', // Create a PHP file to fetch districts for the selected state
                        type: 'POST',
                        data: {state: state},
                        success: function(response) {
                            $('#district').html(response);
                        }
                    });
                }
            });

            $('#district').change(function() {
                var district = $(this).val();
                if (district !== '') {
                    $.ajax({
                        url: 'getCities.php', // Create a PHP file to fetch cities for the selected district
                        type: 'POST',
                        data: {district: district},
                        success: function(response) {
                            $('#city').html(response);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
