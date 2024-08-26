var selectedAvatar = '';

document.getElementById('openAvatarModal').addEventListener('click', function() {
    // Fetch avatar status from check_avatar_status.php
    fetch('check_avatar_status.php')
        .then(response => response.json())
        .then(data => {
            const avatarsContainer = document.getElementById('avatars-container');
            avatarsContainer.innerHTML = ''; // Clear previous avatars
            
            data.avatars.forEach(avatar => {
                const avatarButton = document.createElement('button');
                avatarButton.classList.add('avatar-button');
                avatarButton.style.backgroundImage = `url('${avatar.Image_URL}')`;
                avatarButton.style.backgroundSize = 'cover';
                avatarButton.style.width = '100px'; // Set size as needed
                avatarButton.style.height = '100px'; // Set size as needed

                if (avatar.is_clickable) {
                    avatarButton.classList.add('clickable-avatar');
                    avatarButton.addEventListener('click', function() {
                        selectAvatar(avatar.Image_URL); 
                        console.log('Avatar selected:', avatar.CAvatar_ID);
                        // Additional logic to update selected avatar, if needed
                    });
                } else {
                    avatarButton.classList.add('non-clickable-avatar');
                    avatarButton.style.opacity = '0.5';
                    avatarButton.disabled = true; // Make it non-clickable
                }

                avatarsContainer.appendChild(avatarButton);
            });
        })
        .catch(error => console.error('Error fetching avatar data:', error));

        var selectedAvatar = '';
        document.getElementById('popup').style.display = 'block';
});

// Close modal when the close button is clicked
document.getElementById('closeAvatar').addEventListener('click', function() {
    document.getElementById('popup').style.display = 'none';
});

// Optional: Close the modal when clicking outside of it
window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('popup')) {
        document.getElementById('popup').style.display = 'none';
    }
});
document.getElementById('update_avatar').addEventListener('click', function() {
    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    
    // Open a POST request to update_avatar.php
    xhr.open('POST', 'update_avatar.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    // Define the onload callback
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Update the profile picture with the new avatar
                document.getElementById('currentAvatar').src = '/Children2/avatar/' + response.new_avatar_url;
                alert('Avatar updated successfully!');
                window.location.reload();

            } else {
                alert('Error: ' + response.message);
            }
        } else {
            alert('Request failed. Please try again.');
        }
    };
    
    // Define the data to send with the request
    var data = 'avatar=' + encodeURIComponent(selectedAvatar); // Adjust according to your logic

    // Send the request
    xhr.send(data);
});
function selectAvatar(avatarUrl) {
    const basePath = '/Children2/avatar/';
    if (avatarUrl.startsWith(basePath)) {
        selectedAvatar = avatarUrl.substring(basePath.length);
    } else {
        selectedAvatar = avatarUrl;
    }
    console.log('Selected Avatar:', selectedAvatar); // For debugging
}

document.getElementById('update_avatar').addEventListener('click', function() {
    if (!selectedAvatar) {
        alert('Please select an avatar first.');
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_avatar.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Update the profile picture with the new avatar
                document.getElementById('currentAvatar').src = '/Children2/avatar/' + response.new_avatar_url;
                alert('Avatar updated successfully!');
                document.getElementById('popup').style.display = 'none'; // Close modal
            } else {
                alert('Error: ' + response.message);
            }
        } else {
            alert('Request failed. Please try again.');
        }
    };
    
    var data = 'avatar=' + encodeURIComponent(selectedAvatar);
    xhr.send(data);
});

