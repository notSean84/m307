<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M307 - Endprodukt</title>
    <link rel="stylesheet" href="./assets/styles/style.css">
</head>

<body>
    <main>
        <div class="panel">
            <section class="project-section">
                <div class="project-header">
                    <h1>Projekte</h1>
                    <button id="newProjectBtn">+ Neues Projekt</button>
                </div>

                <!--Formular um Projekt zu erstellen-->
                <form enctype="multipart/form-data" id="projectForm" class="form-container" style="display: none;"
                    action="./assets/php/save_projects.php" method="post">
                    <label for="projectName">Projektname:</label>
                    <input type="text" name="projectName">
                    <div class="date-container">
                        <div>
                            <label for="projectStartDate">Startdatum:</label>
                            <input type="date" name="projectStartDate">
                        </div>
                        <div>
                            <label for="projectEndDate">Enddatum:</label>
                            <input type="date" name="projectEndDate">
                        </div>
                    </div>
                    <button class="submit-btn" type="submit" id="saveProjectBtn">Projekt speichern</button>
                </form>

                <!--Projekt Info Anzeige-->
                <div class="project-info">
                    <h3>Projekt Name</h3>
                    <h3>Startdatum | Enddatum</h3>
                </div>
                <div class="project-list">
                    <?php
                    include "./assets/php/db.php";

                    $sql = "SELECT * FROM project";
                    $stmt = $conn->prepare($sql);

                    if ($stmt->execute()) {
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $projectId = $row['project_id'];
                            $startDate = date("d.m.Y", strtotime($row['start_date']));
                            $endDate = date("d.m.Y", strtotime($row['end_date']));

                            echo '<p class="project-list">' . htmlspecialchars($row['name']) . ' (' . htmlspecialchars($startDate) . ' - ' . htmlspecialchars($endDate) . ') ' .
                                ' <a href="./assets/php/delete_project.php?id=' . $projectId . '" class="delete-btn" onclick="return confirm(\'Projekt wirklich löschen?\')" style="text-decoration: none;">❌</a>' .
                                ' <a href="#" class="editProjectBtn" data-id="' . $projectId . '" style="text-decoration: none;">🖊️</a></p>';

                            // Verstecktes Bearbeitungsformular für das Projekt
                            echo '<form action="./assets/php/edit_project.php?id=' . $projectId . '" method="POST" class="form-container" id="editProjectForm-' . $projectId . '" style="display: none;">
                <label for="projectName">Projektname:</label>
                <input type="text" name="projectName" value="' . htmlspecialchars($row['name']) . '" required>

                <label for="startDate">Startdatum:</label>
                <input type="date" name="startDate" value="' . $row['start_date'] . '" required>

                <label for="endDate">Enddatum:</label>
                <input type="date" name="endDate" value="' . $row['end_date'] . '" required>

                <button type="submit" class="submit-btn">Änderungen speichern</button>
            </form>';
                        }
                    } else {
                        echo "Fehler bei der Ausführung der Abfrage.";
                    }
                    ?>




                </div>


                <!--Projekt Mitglieder Anzeige-->
                <div class="project-member">
                    <!-- Dynamisch gefüllt -->
                </div>
                <section class="assignment-section">
                    <div class="assignment-header">
                        <h1>Mitarbeiter zuweisen</h1>
                    </div>

                    <!--Formular um Mitarbeiter zuweisen-->
                    <form enctype="multipart/form-data" id="assigForm" class="form-container" action="./assets/php/assign_member.php" method="post">
                        <label for="projectSelect">Projekt auswählen:</label>
                        <select id="projectSelect" name="projectSelect">
                            <!-- Dynamisch gefüllt -->
                            <option value="" hidden selected disabled>-- Projekte --</option>

                            <?php
                            include "./assets/php/db.php";
                            $sql = "SELECT * FROM project";
                            $stmt = $conn->prepare($sql);

                            // SQL-Abfrage ausführen
                            if ($stmt->execute()) {
                                $result = $stmt->get_result(); // Ergebnis abrufen

                                // Projekte in <option>-Tags auflisten
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['project_id'] . '">' . $row['name'] . '</option>';
                                }
                            } else {
                                echo "Fehler bei der Ausführung der Abfrage.";
                            }
                            ?>

                        </select>
                        <label for="userSelect">Mitarbeiter auswählen:</label>
                        <select id="userSelect" name="userSelect">
                            <!-- Dynamisch gefüllt -->
                            <option value="" hidden selected disabled>-- Teammitglieder --</option>

                            <?php
                            include "./assets/php/db.php";
                            $sql = "SELECT * FROM teammember";
                            $stmt = $conn->prepare($sql);

                            // SQL-Abfrage ausführen
                            if ($stmt->execute()) {
                                $result = $stmt->get_result(); // Ergebnis abrufen

                                // Projekte in <option>-Tags auflisten
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['teammember_id'] . '">' . $row['first_name'] . " " . $row['last_name'] . '</option>';
                                }
                            } else {
                                echo "Fehler bei der Ausführung der Abfrage.";
                            }
                            ?>


                        </select>
                        <label for="roleName">Rolle auswählen:</label>
                        <input type="text" id="roleName" name="roleName" placeholder="Rolle">
                        <br>
                        <button type="submit" class="submit-btn" id="assignBtn">Mitarbeiter zuweisen</button>
                    </form>



                </section>
            </section>


            <section class="user-section">
                <div class="user-header">
                    <h1>Mitarbeiter</h1>
                    <button id="newUserBtn">+ Neuer Mitarbeiter</button>
                </div>

                <!--Formular um Mitarbeiter zu erstellen-->
                <form enctype="multipart/form-data" id="userForm" class="form-container" style="display: none;"
                    action="./assets/php/save_user.php" method="post">
                    <label for="userFirstName">Vorname:</label>
                    <input class="userInput" type="text" name="userFirstName" required>
                    <label for="userLastName">Nachname:</label>
                    <input class="userInput" type="text" name="userLastName" required>
                    <label for="userLehrgang">Lehrgang:</label>
                    <input class="userInput" type="text" name="userLehrgang">
                    <button class="submit-btn" type="submit" id="saveUserBtn">Mitarbeiter speichern</button>
                </form>

                <!--Mitarbeiter Anzeige-->
                <div class="user-list">
                    <h3>Alle Mitarbeiter:</h3>
                    <!-- Dynamisch gefüllt -->
                    <?php

                    include "./assets/php/db.php";

                    $sql = "SELECT * FROM teammember";
                    $stmt = $conn->prepare($sql);

                    if ($stmt->execute()) {
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            $teammember_id = $row['teammember_id']; // ID speichern
                            echo '<p class="teammember-list">' . htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) . " | " . htmlspecialchars($row['lehrgang']) .
                                ' <a href="./assets/php/delete_user.php?id=' . $teammember_id . '" class="delete-btn" onclick="return confirm(\'Mitarbeiter:in wirklich löschen?\')" style="text-decoration: none;">❌</a>' .
                                ' <a style="text-decoration: none; cursor: pointer;" class="editBtn" data-id="' . $teammember_id . '">🖊️</a></p>' .

                                '<form action="./assets/php/edit_user.php?id=' . $teammember_id . '" enctype="multipart/form-data" class="form-container" style="display: none;" id="editForm-' . $teammember_id . '" method="POST">
                                    <label for="userFirstName">Vorname:</label>
                                    <input class="userInput" type="text" name="userFirstName" value="' . htmlspecialchars($row['first_name']) . '" required>
                                    <label for="userLastName">Nachname:</label>
                                    <input class="userInput" type="text" name="userLastName" value="' . htmlspecialchars($row['last_name']) . '" required>
                                    <label for="userLehrgang">Lehrgang:</label>
                                    <input class="userInput" type="text" name="userLehrgang" value="' . htmlspecialchars($row['lehrgang']) . '">
                                    <button class="submit-btn" type="submit">Änderungen speichern</button>
                                </form>';
                        }
                    } else {
                        echo "Fehler bei der Ausführung der Abfrage.";
                    }

                    ?>


                </div>
            </section>

        </div>
    </main>
    <script src="./assets/scripts/main.js"></script>
</body>

</html>