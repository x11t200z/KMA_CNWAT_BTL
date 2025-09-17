const display = document.getElementById("display");
const buttons = document.querySelectorAll(".btn");

let currentInput = "0";
let operator = "";
let firstOperand = null;

buttons.forEach(btn => {
  btn.addEventListener("click", () => {
    const value = btn.textContent;
    // xử lý các nút để nhận giá trị nhập vào
    if (!isNaN(value) || value === ".") {
      // Nhập số hoặc dấu chấm
      if (currentInput === "0") currentInput = value;
      else currentInput += value;
      display.value = currentInput;
    }

    // Xử lý nút C
    else if (value === "C") {
      currentInput = "0"; // 
      firstOperand = null;
      operator = "";
      display.value = currentInput;
    }
    else if (value === "CE") {
      currentInput = "0";
      display.value = currentInput;
    }
    else if (["+", "-", "*", "/"].includes(value)) {
      firstOperand = parseFloat(currentInput);
      operator = value;
      currentInput = "";  
    }
    else if (value === "=") {
      if (operator && firstOperand !== null) {
        const secondOperand = parseFloat(currentInput);
        switch (operator) {
          case "+": currentInput = firstOperand + secondOperand; break;
          case "-": currentInput = firstOperand - secondOperand; break;
          case "*": currentInput = firstOperand * secondOperand; break;
          case "/": currentInput = firstOperand / secondOperand; break;
        }
        display.value = currentInput;
        firstOperand = null;
        operator = "";
      }
    }
  });
});
