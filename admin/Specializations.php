<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Specialization</title>
</head>
<body>
<div class="containers border">
    <h2>Select Specialization</h2>
   
       <div class="row border ">
       <label for="specialization">Choose a specialization:</label>
        <select id="specialization" name="specialization">
            <option value="" disabled selected>Choose a specialization</option>
            <?php
            include '../sql_connection.php';
            // Fetching data from the database
            $sql = "SELECT * FROM specializations";
            $result = $conn->query($sql);

            // If there are results, display them in the dropdown menu
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["specialization_name"] . "</option>";
                }
            } else {
                echo "<option value='' disabled>No specialization found</option>";
            }

            // Closing connection
            $conn->close();
            ?>
        </select>
        </div>
       </div>
    <div id="subSpecializations"></div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var specializationSelect = document.getElementById('specialization');
        var subSpecializationsDiv = document.getElementById('subSpecializations');

        // Event listener for when the selected option changes
        specializationSelect.addEventListener('change', function() {
            // Get the selected specialization ID
            var specializationId = specializationSelect.value;
            
            // If no specialization is selected, clear the subSpecializationsDiv
            if (specializationId === "") {
                subSpecializationsDiv.innerHTML = "";
                return;
            }

            // Make an AJAX request to fetch sub-specializations based on the selected specialization ID
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Request successful, display the sub-specializations in a table
                        var subSpecializations = JSON.parse(xhr.responseText);
                        var tableHtml = "<table>";
                        subSpecializations.forEach(function(subSpecialization, index) {
                            if (index % 4 === 0) {
                                tableHtml += "<tr>";
                            }
                            tableHtml += "<td><input type='checkbox' name='sub_specializations[]' value='" + subSpecialization.id + "' id='sub_specialization_" + subSpecialization.id + "'><label for='sub_specialization_" + subSpecialization.id + "'>" + subSpecialization.sub_specialization_name + "</label></td>";
                            if ((index + 1) % 4 === 0 || index === subSpecializations.length - 1) {
                                tableHtml += "</tr>";
                            }
                        });
                        tableHtml += "</table>";
                        subSpecializationsDiv.innerHTML = tableHtml;
                    } else {
                        // Request failed, display an error message
                        subSpecializationsDiv.innerHTML = "Error fetching sub-specializations.";
                    }
                }
            };
            xhr.open('GET', 'fetch_sub_specializations.php?specialization_id=' + specializationId, true);
            xhr.send();
        });
    });
    </script>
</body>
</html>
