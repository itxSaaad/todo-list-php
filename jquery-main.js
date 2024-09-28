const apiUrl = 'http://todo-list.test/api';

// Convert the 'completed' string to a boolean
function convertToBoolean(value) {
  return value === '1';
}

$(document).ready(function () {
  // Fetch all the tasks from the API and Display on the page using ajax
  function fetchTasks() {
    $.ajax({
      url: `${apiUrl}/readTodo.php`,
      type: 'GET',
      success: function (data) {
        data.data.forEach((todo) => {
          const taskElement = $(`<li>
            <input type="checkbox" ${
              convertToBoolean(todo.completed) ? 'checked' : ''
            } id="${todo.id}" />
            <span>${todo.task}</span>
            <button id="${todo.id}">Delete</button>
            </li>`);
          $('#todo-list').append(taskElement);
        });
      },
      error: function (error) {
        console.error('Error:', error);
      },
    });
  }

  // Add a new task to the list
  function addTask(task, completed) {
    $.ajax({
      url: `${apiUrl}/createTodo.php`,
      type: 'POST',
      data: JSON.stringify({
        task,
        completed,
      }),
      success: function (data) {
        data = data.data;
        count = data.length;

        /// append the new task to the list from last index of dat
        const taskElement = $(`<li>
            <input type="checkbox" ${
              convertToBoolean(data[count - 1].completed) ? 'checked' : ''
            } id="${data[count - 1].id}" />
            <span>${data[count - 1].task}</span>
            <button id="${data[count - 1].id}">Delete</button>
            </li>`);
        $('#todo-list').append(taskElement);
      },
      error: function (error) {
        console.error('Error:', error);
      },
    });
  }

  // Delete a task from the list
  function deleteTask(id) {
    $.ajax({
      url: `${apiUrl}/deleteTodo.php`,
      type: 'DELETE',
      data: JSON.stringify({
        id,
      }),
      success: function (data) {
        $(`#${id}`).parent().remove();
      },
      error: function (error) {
        console.error('Error:', error);
      },
    });
  }

  // Update the task status
  function updateTaskStatus(id, completed) {
    $.ajax({
      url: `${apiUrl}/updateTodo.php`,
      type: 'PUT',
      data: JSON.stringify({
        id,
        completed,
      }),
      success: function (data) {
        console.log(data);
      },
      error: function (error) {
        console.error('Error:', error);
      },
    });
  }

  // Event for Form Submission
  $('#todo-form').submit(function (event) {
    event.preventDefault();
    addTask($('#task').val(), false);
    $('#task').val('');
  });

  // Evernt Listenr for the checkbox
  $('#todo-list').on('change', 'input[type="checkbox"]', function (event) {
    const target = event.target;
    var checked;
    if (target.checked) {
      checked = true;
    } else {
      checked = false;
    }

    updateTaskStatus(target.id, checked);
  });

  // Event listener for the delete button
  $('#todo-list').on('click', 'button', function (event) {
    const target = event.target;
    deleteTask(target.id);
  });

  fetchTasks();
});
