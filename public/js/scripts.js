function createTask() {
    const taskData = {
        task_id: document.getElementById('task_id').value,
        title: document.getElementById('title').value,
        description: document.getElementById('description').value,
        status: document.getElementById('status').value,
        created_at: document.getElementById('created_at').value,
    };

    fetch('/api/tasks', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(taskData),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Tarea creada:', data);
        alert('Tarea creada con éxito');
        document.getElementById('createTaskForm').reset();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un error al crear la tarea');
    });
}
