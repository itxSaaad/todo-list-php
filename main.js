const apiUrl = 'http://todo-list.test/api';

const todoForm = document.getElementById('todo-form');
const todoInput = document.getElementById('task');
const todoList = document.getElementById('todo-list');

// Convert the 'completed' string to a boolean
function convertToBoolean(value) {
  return value === '1';
}

// Fetch all the tasks from the API and Display on the page
function fetchTasks() {
  try {
    fetch(`${apiUrl}/readTodo.php`)
      .then((response) => response.json())
      .then((data) => {
        data.data.forEach((todo) => {
          const taskElement = document.createElement('li');
          taskElement.innerHTML = `
            <input type="checkbox" ${
              convertToBoolean(todo.completed) ? 'checked' : ''
            } id="${todo.id}" />
            <span>${todo.task}</span>
            <button id="${todo.id}">Delete</button>
                    `;
          todoList.appendChild(taskElement);
        });
      });
  } catch (error) {
    console.error('Error:', error);
  }
}

// Add a new task to the list
function addTask(task, completed) {
  try {
    fetch(`${apiUrl}/createTodo.php`, {
      method: 'POST',
      body: JSON.stringify({ task, completed }),
    })
      .then((response) => response.json())

      .then((data) => {
        data = data.data;
        count = data.length;

        /// append the new task to the list from last index of dat
        const taskElement = document.createElement('li');
        taskElement.innerHTML = `
            <input type="checkbox" ${
              convertToBoolean(data[count - 1].completed) ? 'checked' : ''
            } id="${data[count - 1].id}" />
            <span>${data[count - 1].task}</span>
            <button id="${data[count - 1].id}">Delete</button>
                    `;
        todoList.appendChild(taskElement);
      });
  } catch (error) {
    console.error('Error:', error);
  }
}

// Delete a task from the list
function deleteTask(id) {
  try {
    fetch(`${apiUrl}/deleteTodo.php`, {
      method: 'DELETE',
      body: JSON.stringify({ id }),
    })
      .then((response) => {
        response.json();
      })
      .then(() => {
        document.getElementById(id).parentElement.remove();
      });
  } catch (error) {
    console.error('Error:', error);
  }
}

// Update the task status
function updateTaskStatus(id, completed) {
  try {
    fetch(`${apiUrl}/updateTodo.php`, {
      method: 'PUT',
      body: JSON.stringify({ id, completed }),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
      });
  } catch (error) {
    console.error('Error:', error);
  }
}

// Event for Form Submission
document.getElementById('todo-form').addEventListener('submit', (event) => {
  event.preventDefault();
  addTask(todoInput.value, false);
  todoInput.value = '';
});

// Evernt Listenr for the checkbox
todoList.addEventListener('change', (event) => {
  const target = event.target;
  if (target.tagName === 'INPUT') {
    var checked;
    if (target.checked) {
      checked = true;
    } else {
      checked = false;
    }

    updateTaskStatus(target.id, checked);
  }
});

// Event listener for the delete button
todoList.addEventListener('click', (event) => {
  const target = event.target;
  if (target.tagName === 'BUTTON') {
    deleteTask(target.id);
  }
});

document.addEventListener('DOMContentLoaded', () => {
  fetchTasks();
});
