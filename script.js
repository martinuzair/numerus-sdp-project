document.addEventListener('DOMContentLoaded', function() {
    // Common functionality
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

    // Tutorial Management functionality
    const tutorialChapterDropdownContent = document.getElementById('tutorial-chapter-dropdown-content');
    if (tutorialChapterDropdownContent) {
        handleTutorialManagement();
    }

    // Quiz Management functionality
    const quizChapterDropdownContent = document.getElementById('quiz-chapter-dropdown-content');
    if (quizChapterDropdownContent) {
        handleQuizManagement();
    }

    function handleTutorialManagement() {
        const selectedChapter = document.getElementById('selected-chapter');
        const chapterLinks = tutorialChapterDropdownContent.getElementsByTagName('a');

        for (let link of chapterLinks) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                selectedChapter.textContent = this.textContent;
                const chapterID = this.getAttribute('data-chapter-id');
                document.getElementById('chapter_id').value = chapterID;
                document.getElementById('subtopic_id').value = ''; // Clear subtopic when chapter changes
                document.getElementById('selected-chapter').textContent = this.textContent;

                // Fetch subtopics for the selected chapter
                fetchSubtopics(chapterID);
            });
        }

        function fetchSubtopics(chapterID) {
            console.log('Fetching subtopics for chapter ID:', chapterID); // Debugging line
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'fetch_subtopics.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    console.log('Response received:', this.responseText); // Debugging line
                    const subtopics = JSON.parse(this.responseText);
                    updateSubtopicDropdown(subtopics);
                } else {
                    console.error('Failed to fetch subtopics:', this.status);
                }
            };
            xhr.send('chapter_id=' + chapterID);
        }

        function updateSubtopicDropdown(subtopics) {
            const subtopicDropdownContent = document.getElementById('subtopic-dropdown-content');
            subtopicDropdownContent.innerHTML = ''; // Clear existing subtopics

            subtopics.forEach(subtopic => {
                const a = document.createElement('a');
                a.href = '#';
                a.textContent = subtopic.Subtopic_Number; 
                a.setAttribute('data-subtopic-id', subtopic.Subtopic_ID);
                console.log('Creating link for subtopic ID:', subtopic.Subtopic_ID); // Debugging line

                a.addEventListener('click', function(event) {
                    event.preventDefault();
                    console.log('Subtopic clicked:', subtopic.Subtopic_ID); // Debugging line

                    document.getElementById('selected-subtopic').textContent = this.textContent;
                    document.getElementById('subtopic_id').value = subtopic.Subtopic_ID;

                    // Fetch video and description for the selected subtopic
                    fetchVideoAndDescription(subtopic.Subtopic_ID);
                });
                subtopicDropdownContent.appendChild(a);
            });
        }

        function fetchVideoAndDescription(subtopicID) {
            console.log('Fetching video and description for subtopic ID:', subtopicID);
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_video_description.php?subtopic=' + subtopicID, true);
            xhr.onload = function() {
                try {
                    if (this.status === 200) {
                        const data = JSON.parse(this.responseText);
                        console.log('Response received:', data); // Debugging line
                        updateContent(data);
                    } else {
                        console.error('Request failed with status:', this.status);
                    }
                } catch (e) {
                    console.error('Error parsing JSON response:', e.message); // Error handling
                }
            };
            xhr.send();
        }

        // Update video and notes content
        function updateContent(data) {
            const videoBox = document.getElementById('video-box');
            const notesBox = document.getElementById('notes-box');
            videoBox.innerHTML = '';
            notesBox.innerHTML = '';
            if (data.video_available) {
                videoBox.innerHTML = `
                    <video width="860" height="560" controls>
                        <source src="/Children2/tutorial_video/${data.video_url}" type="video/mp4">                            
                        Your browser does not support the video tag.
                    </video>`;
            } else {
                videoBox.innerHTML = '<p>No video available</p>';
            }

            if (data.notes_available) {
                notesBox.innerHTML = `<iframe src="/Children2/tutorial_notes/${data.notes_url}" width="100%" height="1000px"></iframe>`;
                console.log("Notes", data.notes_url);
            } else {
                notesBox.innerHTML = '<p>No description available</p>';
            }
        }

        // Edit Buttons
        document.querySelector('.edit-button-1').addEventListener('click', function() {
            redirectToEditPage();
        });

        document.querySelector('.edit-button-2').addEventListener('click', function() {
            redirectToEditPage2();
        });

        function redirectToEditPage() {
            const chapterID = document.getElementById('chapter_id').value;
            const subtopicID = document.getElementById('subtopic_id').value;

            if (chapterID && subtopicID) {
                window.location.href = `a5_editTutorialVideo.php?level=${level}&chapter=${chapterID}&subtopic=${subtopicID}`;
            } else {
                alert('Please select a chapter and subtopic first.');
            }
        }

        function redirectToEditPage2() {
            const chapterID = document.getElementById('chapter_id').value;
            const subtopicID = document.getElementById('subtopic_id').value;

            if (chapterID && subtopicID) {
                window.location.href = `a6_editNotes.php?level=${level}&chapter=${chapterID}&subtopic=${subtopicID}`;
            } else {
                alert('Please select a chapter and subtopic first.');
            }
        }
    }

    function handleQuizManagement() {
        const quizDropdownContent = document.getElementById('quiz-chapter-dropdown-content');
        if (quizDropdownContent) {
            const quizLinks = quizDropdownContent.getElementsByTagName('a');
            for (let link of quizLinks) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const chapterID = this.getAttribute('data-chapter-id');
                    document.getElementById('selected-quiz-chapter').textContent = `Chapter ${chapterID}`;
                    document.getElementById('quiz-title-header').textContent = 'Quiz_Title';
                    fetchQuizzes(chapterID);
                });
            }
        } else {
            console.error('Quiz dropdown content element not found.');
        }

        function fetchQuizzes(chapterID) {
            fetch(`fetch_quizzes.php?chapter_id=${chapterID}`)
                .then(response => response.json())
                .then(data => {
                    const quizBox = document.getElementById('quizMGMT-box');
                    if (quizBox) {
                        quizBox.innerHTML = `
                            <div class="quizMGMT-heading">
                                <h1 class="question-no">NO</h1><br>
                                <h1 class="question-title" id="quiz-title-header">Title</h1>
                                <button type="button" class="plus-button" onclick="createQuizQuestion()">
                                    <h1 class="plus-text">+</h1>
                                </button>
                            </div>
                        `;
                        data.forEach((quiz, index) => {
                            fetchQuizQuestions(quiz.Quiz_ID, index);
                        });
                    } else {
                        console.error('quizMGMT-box element not found.');
                    }
                })
                .catch(error => console.error('Error fetching quizzes:', error));
        }

        function fetchQuizQuestions(quizID) {
            fetch(`fetch_quiz_questions.php?quiz_id=${quizID}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        throw new Error(data.error);
                    }
                    const quizBox = document.getElementById('quizMGMT-box');
                    quizBox.innerHTML = `
                        <div class="quizMGMT-heading">
                            <h1 class="question-no">NO</h1><br>
                            <h1 class="question-title" id="quiz-title-header">Title</h1>
                            <button type="button" class="plus-button" onclick="createQuizQuestion()">
                                <h1 class="plus-text">+</h1>
                            </button>
                        </div>
                    `;
                    data.forEach((question, index) => {
                        const quizItem = document.createElement('div');
                        quizItem.className = index % 2 === 0 ? 'question-oddBox' : 'question-evenBox';
                        quizItem.innerHTML = `
                            <a href="viewquiz.php?id=${question.Question_ID}" id="quiz-link">
                                <h1 class="question-value">${index + 1}.</h1>
                            </a>
                            <h1 class="question-text">${question.Ques_text}</h1>
                            <div class="question-actions">
                                <button type="button" class="delete-button" onclick="deleteQuizQuestion(${question.Question_ID})">Delete</button>
                                <button type="button" class="modify-button" onclick="modifyQuizQuestion(${question.Question_ID})">Modify</button>
                            </div>
                        `;
                        quizBox.appendChild(quizItem);
                    });
                })
                .catch(error => console.error('Error fetching quiz questions:', error));
        }

        // Ensure that the chapter dropdown updates the hidden input correctly
        const dropdownLinks = document.querySelectorAll('#quiz-chapter-dropdown-content a');
        const chapterIdInput = document.getElementById('chapter_id');
        const selectedChapterButton = document.getElementById('selected-quiz-chapter');

        dropdownLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const chapterID = this.getAttribute('data-chapter-id');
                chapterIdInput.value = chapterID;
                selectedChapterButton.textContent = `Chapter ${chapterID}`;
                fetchQuizzes(chapterID);
            });
        });

        function createQuizQuestion() {
            const chapterID = document.getElementById('chapter_id').value;
            if (chapterID) {
                // Proceed with adding a new quiz question
                window.location.href = `CreateQuizQuestion.php?chapter_id=${chapterID}`;
            } else {
                alert('Please select a chapter first.');
            }
        }

        function deleteQuizQuestion(questionID) {
            if (confirm('Are you sure you want to delete this question?')) {
                fetch(`delete_quiz_question.php?question_id=${questionID}`, { method: 'DELETE' })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            // Refresh the quiz questions
                            const chapterID = document.getElementById('selected-quiz-chapter').textContent.split(' ')[1];
                            console.log(`Selected Chapter ID: ${chapterID}`);
                            fetchQuizzes(chapterID);
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error deleting question:', error));
            }
        }

        function modifyQuizQuestion(questionID) {
            window.location.href = `a7_editQuizQuestion.php?question_id=${questionID}`;
        }

        // Expose functions to global scope
        window.createQuizQuestion = createQuizQuestion;
        window.deleteQuizQuestion = deleteQuizQuestion;
        window.modifyQuizQuestion = modifyQuizQuestion;
    }
});
document.getElementById('url').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('imagePreview').src = e.target.result;
      }
      reader.readAsDataURL(file);
    }
  });
  function updateOption(index, value) {
    const select = document.getElementById('answer');
    const option = select.options[index - 1]; // index - 1 because array is 0-based
    option.text = value;
}  

