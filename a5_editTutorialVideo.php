<?php
require 'includes/numerusdatabase.php';
require 'includes/config_session.inc.php';

$level = isset($_GET['level']) ? (int)$_GET['level'] : null;
$chapterID = isset($_GET['chapter']) ? (int)$_GET['chapter'] : null;
$subtopicID = isset($_GET['subtopic']) ? (int)$_GET['subtopic'] : null;

if ($level && $chapterID && $subtopicID) {
    if (isset($_POST['submit'])) {
        $maxsize = 41943040; // 40MB
        
    
        if (isset($_FILES['myFile']['name']) && $_FILES['myFile']['name'] != '') {
            $target_dir = "C://xampp//htdocs//Children2//tutorial_video//";
            $target_file = $target_dir . basename($_FILES['myFile']['name']);
            $relative_path = basename($target_file);
    
            
            $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extension_arr = array("mp4", "mov", "mkv");
    
    
            if (in_array($extension, $extension_arr)) {
                if ($_FILES['myFile']['size'] >= $maxsize) {
                    $_SESSION['message'] = "File too large. Maximum size is 40MB.";
                } else {
                    if ($_FILES['myFile']['error'] === UPLOAD_ERR_OK) {
                        if (move_uploaded_file($_FILES['myFile']['tmp_name'], $target_file)) {
                            try {
                                $query = "UPDATE subtopic SET Video = :video WHERE Subtopic_ID = :subtopicID";                                
                                $stmt = $pdo->prepare($query);
                                $stmt->bindParam(':video', $relative_path);
                                $stmt->bindParam(':subtopicID', $subtopicID); 
                                $stmt->execute();
    
                                $_SESSION['message'] = "Upload successful";

                            } catch (PDOException $e) {
                                $_SESSION['message'] = "Database error: Could not upload the file.";
                                error_log("Database error: " . $e->getMessage());
                            }
                        } 
                    } else {
                        $_SESSION['message'] = "Upload error: " . $_FILES['myFile']['error'];
                        error_log("Upload error: " . $_FILES['myFile']['error']);
                    }
                }
            } else {
                $_SESSION['message'] = "Invalid file extension. Only .mp4, .mov, and .mkv are allowed.";
            }
        } else {
            $_SESSION['message'] = "Please select a file";
            
            
        }
       
        header('location: a4_viewTutorial.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial Management Page</title>
    <link rel="stylesheet" href="CSS/design.css">
</head>
<body>
    <div class="unscrollable-page">
        <?php include "includes/adminheader.php"?>    

        <center>
            <div class="chapter-dropdown-wrapper">
                <div class="page-text">Level - <?php echo $level; ?>, Chapter - <?php echo $chapterID; ?><br> Subtopic ID - <?php echo $subtopicID; ?></div>
            </div>
            <form method="post" enctype="multipart/form-data">
            <h1 class="video-text">Video</h1>
            <div class="video-box">
                <button type="submit" name="submit" class="edit-button-1">Save</button>
                
                <div class="video-container">
                
                    <div class="drop-zone">
                        <span class="drop-zone__prompt">Drop file here or click to upload</span>
                        <input type="file" name="myFile" class="drop-zone__input">
                    </div>
                </div>
            </div>
</form>
            <div>
            <h1 class="property-text">Description</h1>
            <div class="notes-box">
                
            </div>
            </div>
        </center>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const headerDropdown = document.querySelector('.header-dropdown');
            const dropdownMenu = document.querySelector('.dropdown-menu');
            const profileDropdownMenu = document.querySelector('.profile-dropdown-menu');

            let isHoveringDropdown = false;
            let isHoveringProfile = false;

            function handleDropdownMouseEnter() {
                isHoveringDropdown = true;
                dropdownMenu.style.display = 'block';
            }

            function handleDropdownMouseLeave() {
                isHoveringDropdown = false;
                setTimeout(() => {
                    if (!isHoveringDropdown && !isHoveringProfile) {
                        dropdownMenu.style.display = 'none';
                    }
                }, 300); // delay to allow hover action on the dropdown
            }

            function handleProfileMouseEnter() {
                isHoveringProfile = true;
                profileDropdownMenu.style.display = 'block';
                dropdownMenu.style.display = 'none'; // Hide other dropdowns
            }

            function handleProfileMouseLeave() {
                isHoveringProfile = false;
                setTimeout(() => {
                    if (!isHoveringDropdown && !isHoveringProfile) {
                        profileDropdownMenu.style.display = 'none';
                    }
                }, 300); // delay to allow hover action on the dropdown
            }

            headerDropdown.addEventListener('mouseenter', handleDropdownMouseEnter);
            headerDropdown.addEventListener('mouseleave', handleDropdownMouseLeave);

            dropdownMenu.addEventListener('mouseenter', () => isHoveringDropdown = true);
            dropdownMenu.addEventListener('mouseleave', handleDropdownMouseLeave);

            profileDropdownMenu.addEventListener('mouseenter', () => isHoveringProfile = true);
            profileDropdownMenu.addEventListener('mouseleave', handleProfileMouseLeave);

            // Handle profile icon hover
            document.querySelector('.profile-icon').addEventListener('mouseenter', handleProfileMouseEnter);
            document.querySelector('.profile-icon').addEventListener('mouseleave', handleProfileMouseLeave);
        });

        document.addEventListener('DOMContentLoaded', (event) => {
            const chapterDropdownContent = document.getElementById('chapter-dropdown-content');
            const selectedChapter = document.getElementById('selected-chapter');
            const chapterLinks = chapterDropdownContent.getElementsByTagName('a');
        
            for (let link of chapterLinks) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    selectedChapter.textContent = this.textContent;
                });
            }

            const subtopicDropdownContent = document.getElementById('subtopic-dropdown-content');
            const selectedSubtopic = document.getElementById('selected-subtopic');
            const subtopicLinks = subtopicDropdownContent.getElementsByTagName('a');
        
            for (let link of subtopicLinks) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    selectedSubtopic.textContent = this.textContent;
                });
            }
        });

        // Drag n Drop
        document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
            const dropZoneElement = inputElement.closest(".drop-zone");

            dropZoneElement.addEventListener("click", (e) => {
                inputElement.click();
            });

            inputElement.addEventListener("change", (e) => {
                if (inputElement.files.length) {
                    const file = inputElement.files[0];
                    if (isValidVideoFile(file)) {
                        updateThumbnail(dropZoneElement, file);
                    } else {
                        alert("Please upload a .mp4 or .mkv file.");
                        inputElement.value = ""; // Clear the input
                    }
                }
            });

            dropZoneElement.addEventListener("dragover", (e) => {
                e.preventDefault();
                dropZoneElement.classList.add("drop-zone--over");
            });

            ["dragleave", "dragend"].forEach((type) => {
                dropZoneElement.addEventListener(type, (e) => {
                    dropZoneElement.classList.remove("drop-zone--over");
                });
            });

            dropZoneElement.addEventListener("drop", (e) => {
                e.preventDefault();

                const file = e.dataTransfer.files[0];
                if (file && isValidVideoFile(file)) {
                    inputElement.files = e.dataTransfer.files;
                    updateThumbnail(dropZoneElement, file);
                } else {
                    alert("Please upload a .mp4 or .mkv file.");
                }

                dropZoneElement.classList.remove("drop-zone--over");
            });
        });

        function updateThumbnail(dropZoneElement, file) {
            let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

            if (dropZoneElement.querySelector(".drop-zone__prompt")) {
                dropZoneElement.querySelector(".drop-zone__prompt").remove();
            }

            if (!thumbnailElement) {
                thumbnailElement = document.createElement("div");
                thumbnailElement.classList.add("drop-zone__thumb");
                dropZoneElement.appendChild(thumbnailElement);
            }

            thumbnailElement.dataset.label = file.name;

            if (file.type.startsWith("video/")) {
                const videoElement = document.createElement("video");
                videoElement.controls = true;
                videoElement.src = URL.createObjectURL(file);
                thumbnailElement.innerHTML = ''; // Clear previous content
                thumbnailElement.appendChild(videoElement);
            } else {
                thumbnailElement.style.backgroundImage = null;
            }
        }

        function isValidVideoFile(file) {
            const validTypes = ['video/mp4', 'video/x-matroska'];
            return validTypes.includes(file.type);
        }
    </script>
</body>
</html>