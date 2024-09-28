<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Todo List - Core PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    header {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 1rem;
      min-height: 100vh;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 0 1rem;
    }

    h1 {
      margin: 0;
    }

    form {
      display: flex;
      margin-top: 1rem;
    }

    input[type='text'] {
      flex: 1;
      padding: 0.5rem;
      font-size: 1rem;
    }

    button {
      padding: 0.5rem 1rem;
      font-size: 1rem;
      background-color: #333;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #555;
    }

    ul {
      list-style: none;
      padding: 0;
    }

    li {
      background-color: #f4f4f4;
      padding: 1rem;
      margin: 0.5rem 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #333;
    }

    li:nth-child(odd) {
      background-color: #e9e9e9;
    }

    li span {
      cursor: pointer;
    }

    li span:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <header>
    <div class="container">
      <h1>Todo List</h1>
      <form id="todo-form">
        <input type="text" id="task" placeholder="Enter task" required>
        <button type="submit">Add Task</button>
      </form>
      <ul id="todo-list"></ul>
    </div>
  </header>

  <!-- <script src="./main.js"></script> -->
  <script src="./jquery-main.js"></script>
</body>

</html>