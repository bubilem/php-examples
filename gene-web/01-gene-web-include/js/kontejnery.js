let addBtnEle = document.getElementById("add-btn");
let clrBtnEle = document.getElementById("clr-btn");
let contEle = document.getElementById("container");
let count = 0;

addBtnEle.onclick = function () {
  count++;
  addBtnEle.innerText = "Přidej box #" + (count + 1);
  let divEle = document.createElement("div");
  divEle.innerText = "#" + count;
  divEle.onclick = function () {
    this.remove();
  };
  contEle.appendChild(divEle);
};

clrBtnEle.onclick = function () {
  count = 0;
  addBtnEle.innerText = "Přidej box #" + (count + 1);
  contEle.innerHTML = "";
};
