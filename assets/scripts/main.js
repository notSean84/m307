document.getElementById('newProjectBtn').addEventListener('click', function() {
    document.getElementById('projectForm').style.display = 'block';
});

document.getElementById('newUserBtn').addEventListener('click', function() {
    document.getElementById('userForm').style.display = 'block';
});

document.getElementById('saveProjectBtn').addEventListener('click', function() {
    const projectName = document.getElementById('projectName').value;
    const startDate = document.getElementById('projectStartDate').value;
    const endDate = document.getElementById('projectEndDate').value;

    fetch('add_project.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name: projectName, start_date: startDate, end_date: endDate }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        location.reload(); // Seite neu laden, um die Liste zu aktualisieren
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});

document.getElementById('saveUserBtn').addEventListener('click', function() {
    const firstName = document.getElementById('userFirstName').value;
    const lastName = document.getElementById('userLastName').value;
    const lehrgang = document.getElementById('userLehrgang').value;

    fetch('add_user.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ first_name: firstName, last_name: lastName, lehrgang: lehrgang }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        location.reload(); // Seite neu laden, um die Liste zu aktualisieren
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});

document.getElementById('assignUserBtn').addEventListener('click', function() {
    const projectId = document.getElementById('projectSelect').value;
    const userId = document.getElementById('userSelect').value;
    const role = document.getElementById('roleName').value;

    fetch('assign_user.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ project_id: projectId, user_id: userId, role: role }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        location.reload(); // Seite neu laden, um die Liste zu aktualisieren
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});

// Funktionen zum Laden der Projekte und Mitarbeiter in die Dropdown-Menüs
function loadProjectsAndUsers() {
    fetch('get_projects.php')
    .then(response => response.json())
    .then(projects => {
        const projectSelect = document.getElementById('projectSelect');
        projects.forEach(project => {
            const option = document.createElement('option');
            option.value = project.project_id;
            option.textContent = project.name;
            projectSelect.appendChild(option);
        });
    });

    fetch('get_users.php')
    .then(response => response.json())
    .then(users => {
        const userSelect = document.getElementById('userSelect');
        users.forEach(user => {
            const option = document.createElement('option');
            option.value = user.teammember_id;
            option.textContent = `${user.first_name} ${user.last_name}`;
            userSelect.appendChild(option);
        });
    });
}






window.onload = loadProjectsAndUsers;