<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Menu</title>

    <style>
        /* Admin Themes */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

body {
  height: 100vh;
  width: 100%;
  background: linear-gradient(90deg, #ffffff, #fc6fb1);
  background-size: 300% 300%;
  animation: color 12s ease-in-out infinite;
}

@keyframes color {
  0% {
    background-position: 100% 50%;
  }
  50% {
    background-position: 0 50%;
  }
  100% {
    background-position: 100% 50%;
  }
}

/* Admin Header */
.admin-header {
  width: 100%;
  height: 88px;
  position: relative;
  z-index: 1; /* Ensure .admin-header is behind the nav */
  box-shadow: 0px 5px 5px #3f3f3f;
  background: transparent;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: visible; /* Ensure dropdowns are visible outside header bounds */
}

a, .user-management {
  text-decoration: none;
}

.user-management {
  color: #000000;
}

/* Position and style the nav */
nav {
  position: absolute;
  top: calc(50% - 44%); /* Move nav upwards by 20% */
  left: 50%;
  transform: translate(-50%, -50%);
  display: flex;
  align-items: center;
  z-index: 3; /* Ensure nav is above .admin-header */
}

nav ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
}

nav li {
  position: relative;
  padding: 15px 20px;
  cursor: pointer;
  border-radius: 8px; /* Border radius for list items */
}

/* Style for 'User Management' and 'Learning Level Management' */
nav li.user-management,
nav li.learning-level-management {
  font-size: 1.25em; /* Increase font size */
  font-weight: bold; /* Make text bold */
  border-radius: 8px; /* Border radius for these items */
}

/* Ensure that the dropdown remains visible when hovering over it */
nav li:hover:not(.profile-icon),
nav li:hover:not(.profile-icon) .dropdown-menu {
  background-color: #D3D3D3; /* Updated from #555 to #D3D3D3 */
  border-radius: 8px; /* Border radius for hovered items */
}

.dropdown-menu {
  display: none !important; /* Ensure dropdown is hidden by default */
  position: absolute;
  top: 100%;
  left: 0;
  background-color: #D3D3D3; /* Updated from #444 to #D3D3D3 */
  list-style: none;
  padding: 0;
  margin: 0;
  z-index: 1000; /* Ensure dropdown is on top */
  transition: display 0.3s ease; /* Optional: smooth transition */
  border-radius: 8px; /* Border radius for dropdown menu */
}

.header-dropdown:hover .dropdown-menu,
.dropdown-menu:hover {
  display: block !important;
}

.dropdown-menu li {
  padding: 10px 20px; /* Add padding for better visual appearance */
  color: #000000; /* Default color for dropdown items */
  border-radius: 8px; /* Border radius for dropdown items */
  font-size: 1.25em; /* Same font size as other menu items */
  font-weight: bold; /* Same font weight as other menu items */
}

.dropdown-menu li:hover {
  background-color: #000000 !important; /* Background color on hover */
  color: #f9d2e4 !important; /* Text color on hover */
}

.dropdown-menu .level {
  position: relative;
}

.sub-menu {
  display: none;
  position: absolute;
  top: 0;
  left: 100%;
  background-color: #D3D3D3; /* Updated from #555 to #D3D3D3 */
  list-style: none;
  padding: 0;
  margin: 0;
  z-index: 1001; /* Ensure sub-menu is on top of the level */
  border-radius: 8px; /* Border radius for sub-menu */
  text-align: center;
}

.dropdown-menu .level:hover .sub-menu,
.sub-menu:hover {
  display: block;
}

.sub-menu li {
  padding: 10px 20px; /* Add padding for better visual appearance */
  color: #000000; /* Default color for sub-menu items */
  border-radius: 8px; /* Border radius for sub-menu items */
  font-size: 1.25em; /* Same font size as other menu items */
  font-weight: bold; /* Same font weight as other menu items */
}

.sub-menu li:hover {
  background-color: #000000 !important; /* Background color on hover */
  color: #f9d2e4 !important; /* Text color on hover */
}

/* Profile Dropdown Menu */
.profile-icon {
  position: relative;
}

.profile-dropdown-menu {
  display: none !important; /* Ensure dropdown is hidden by default */
  position: absolute;
  top: 100%;
  right: 0;
  background-color: #D3D3D3; /* Background color for dropdown */
  list-style: none;
  padding: 0;
  margin: 0;
  border-radius: 8px;
  z-index: 1000; /* Ensure dropdown is on top */
  text-align: center;
}

.profile-dropdown-menu li {
  padding: 10px 20px; /* Padding for menu items */
  font-size: 1.25em; /* Same font size as other menu items */
  font-weight: bold; /* Same font weight as other menu items */
  color: #000000; /* Default text color */
}

.profile-dropdown-menu li a {
  color: #000000; /* Default text color for links */
  text-decoration: none;
}

.profile-dropdown-menu li:hover {
  background-color: #000000 !important; /* Background color on hover */
  border-radius: 8px;
}

.profile-dropdown-menu li a:hover {
  color: #f9d2e4 !important; /* Text color on hover */
}

/* Ensure profile dropdown menu displays on hover */
.profile-icon:hover .profile-dropdown-menu {
  display: block !important;
}

/* Hide other dropdowns when profile icon is hovered */
.profile-icon:hover ~ nav li .dropdown-menu,
.profile-icon:hover ~ nav li .sub-menu {
  display: none !important;
}

/* Numerus Logo */
.logo {
  position: absolute;
  top: 50%;
  left: 10px; /* Adjust as needed */
  transform: translateY(-50%);
  z-index: 1;
}

.logo img {
  width: 80px;
  height: auto;
}

/* Profile Icon */
.profile-icon {
  position: absolute;
  top: 50%;
  right: 10px; /* Adjust as needed */
  transform: translateY(-50%);
  z-index: 1;
}

.profile-icon a {
  display: inline-block;
}

.profile-icon img {
  width: 70px;
  height: auto;
}

/* Numerus Background Logo */
.background-logo {
  position: absolute;
  top: 11%;
  left: 30%;
  width: 20px;
  height: auto;
  text-align: center;
  z-index: 0; /* Set background-logo z-index to 0 */
}

.background-logo img {
  width: 650px;
  height: auto;
  opacity: 0.2;
  -webkit-user-drag: none;
}

    </style>
</head>
<body>
    <div class="admin-header">
        <div class="logo">
            <a href="a1_adminHomePage.html">
                <img src="image/Logo.png" alt="Logo">
            </a>
        </div>
        <div class="profile-icon header-dropdown">
            <a href="a8_View_AdminProfile.php">
                <img src="image/profile.png" alt="Profile Icon">
            </a>
            <ul class="profile-dropdown-menu">
                <li><a href="a8_View_AdminProfile.php">View Profile</a></li>
                <li><a href="includes/logOut.inc.php">Log Out</a></li>
            </ul>
        </div>
        
    </div>
    <div class="background-logo">
        <img src="image/Logo.png" alt="Background Logo">
    </div>

    <nav>
        <ul>
            <a href="a2_userManagement.php">
                <li class="user-management">User Management</li>
            </a>
            <li class="learning-level-management header-dropdown">
                Learning Level Management
                <ul class="dropdown-menu">
                    <li class="level" data-level="1">Level 1
                        <ul class="sub-menu">
                            <a href="a4_viewTutorial.php?level=1">
                                <li>Tutorial Management</li>
                            </a>
                            <a href="a6_QuizManagement.php?level=1">
                                <li>Quiz Management</li>
                            </a>
                        </ul>
                    </li>
                    <li class="level" data-level="2">Level 2
                        <ul class="sub-menu">
                            <a href="a4_viewTutorial.php?level=2">
                                <li>Tutorial Management</li>
                            </a>
                            <a href="a6_QuizManagement.php?level=2">
                                <li>Quiz Management</li>
                            </a>
                        </ul>
                    </li>
                    <li class="level"  data-level="3">Level 3
                        <ul class="sub-menu">
                            <a href="a4_viewTutorial.php?level=3">
                                <li>Tutorial Management</li>
                            </a>
                            <a href="a6_QuizManagement.php?level=3">
                                <li>Quiz Management</li>
                            </a>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </nav> 

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
    </script>
</body>
</html>




