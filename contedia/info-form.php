<?php

require "Database.php";

$db = new Database("localhost", "contedia", "contediaTest2023", "contedia");

$db->connect();

$query = "SHOW COLUMNS FROM form_options";
$result = $db->query($query);


ob_start();
?>


<form id="dynamicForm">
    <?php while ($row = $result->fetch_assoc()): ?>
        <?php if ($row['Field'] === 'UserID') continue; ?>
        
        <?php if ($row['Field'] === 'Name'): ?>
            <!--name field-->
            <div id= "nameField">
            <label for = "<?= $row['Field'] ?>">
            Please provide your <?= $row['Field'] ?>:</label>
            <input type="text" id = "name" name="<?= $row['Field'] ?>" required><br>
            </div>

        <?php elseif ($row['Field'] === 'Email'): ?>
            <!--email field-->
            <div id= "emailField">
            <label for = "<?= $row['Field'] ?>">
            Please provide your <?= $row['Field'] ?>:</label>
            <input type="text" id = "email" name="<?= $row['Field'] ?>" required><br>
            </div>
        <br>

        <?php elseif ($row['Field'] === 'photo'): ?>
            <!--File upload field-->
            <label for="<?= $row['Field'] ?>">Photo/File</label>
            <input type="file" id="photoInput" name="photo" style="display: none;"onchange="handlePhotoSelection()">
            <button type="button" id="choosePhotosButton" onclick="document.getElementById('photoInput').click()">Choose Photos/File</button>
            </div>
            <div class="form-field" id="photoPreviewContainer" style="display: inline-flex;"></div>
            <br>
            </div>

            <?php elseif ($row['Field'] === 'retailer'): ?>
            <!--hogwarts house field-->
            <div id = "retailer">
            <label>
                Choose your preferred online <?= $row['Field'] ?>:
                <select name="retailer">
                    <option value="Amazon">Amazon</option>
                    <option value="eBay">Ebay</option>
                    <option value="Notonthehighstreet">Notonthehighstreet</option>
                    <option value="Etsy">Etsy</option>
                </select>
            </label>
            </div>
            <br>


            <?php elseif ($row['Field'] === 'contactable'): ?>
            <!--contactable checkbox field-->
            <div id = "contactable">
            <label>
                Are you happy to be contacted?
                <input type="hidden" name="<?= $row['Field'] ?>" value="no">
                <input type="checkbox" name="<?= $row['Field'] ?>" value="yes">
            </label>
        </div>
            <br>
        
        <?php elseif ($row['Field'] === "preferred") : ?>
             <!--phone choice fields-->
            <div id = "preferred">
            <label for = "<?= $row['Field'] ?>">
            Which one do you prefer:</label>
            <label><input type="radio" name="preferred" value="Phone"> Phone</label>
            <label><input type="radio" name="preferred" value="Email"> Email</label>
            <label><input type="radio" name="preferred" value="Post"> Post</label>
            <label><input type="radio" name="preferred" value="N/A"> N/A</label>
        </div>
            <br>


        

        <?php endif; ?>
    <?php endwhile; ?>
</form>

<?php
$formHtml = ob_get_clean(); // Get the buffered content and clean the buffer
echo $formHtml;
?>