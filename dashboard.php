<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.html");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>

  <style>
    body {
      font-family: Arial;
      text-align: center;
      margin-top: 50px;
    }

    .calculator {
      width: 250px;
      margin: auto;
      padding: 20px;
      border: 2px solid #333;
      border-radius: 10px;
    }

    input {
      width: 100%;
      height: 40px;
      text-align: right;
      margin-bottom: 10px;
      font-size: 18px;
      padding-right: 5px;
    }

    button {
      width: 50px;
      height: 40px;
      margin: 5px;
      font-size: 16px;
      cursor: pointer;
    }
  </style>

</head>
<body>

<h2>Welcome <?php echo $_SESSION['user']; ?> 🎉</h2>
<a href="logout.php">Logout</a>

<h3>Calculator</h3>

<div class="calculator">
  <input type="text" id="display" disabled>

  <div>
    <button onclick="append('7')">7</button>
    <button onclick="append('8')">8</button>
    <button onclick="append('9')">9</button>
    <button onclick="append('/')">/</button>
  </div>

  <div>
    <button onclick="append('4')">4</button>
    <button onclick="append('5')">5</button>
    <button onclick="append('6')">6</button>
    <button onclick="append('*')">*</button>
  </div>

  <div>
    <button onclick="append('1')">1</button>
    <button onclick="append('2')">2</button>
    <button onclick="append('3')">3</button>
    <button onclick="append('-')">-</button>
  </div>

  <div>
    <button onclick="append('0')">0</button>
    <button onclick="append('.')">.</button>
    <button onclick="calculate()">=</button>
    <button onclick="append('+')">+</button>
  </div>

  <div>
    <button onclick="clearDisplay()">C</button>
  </div>
</div>

<script>
function append(value) {
  document.getElementById("display").value += value;
}

function clearDisplay() {
  document.getElementById("display").value = "";
}

function calculate() {
  try {
    document.getElementById("display").value = eval(document.getElementById("display").value);
  } catch {
    alert("Invalid Expression");
  }
}
</script>

</body>
</html>