const taskA = document.querySelector('#taskA')
const taskB = document.querySelector('#taskB')
const taskC = document.querySelector('#taskC')
const taskD = document.querySelector("#taskD")
const taskE = document.querySelector('#taskD')
const taskF = document.querySelector('#taskE')

let che = [participants].filter(part => part["nation"] === 'CHE').length;
taskA.innerHTML = che;

let hun = participants.some(part => part["nation"] === 'HUN');
taskB.innerHTML = hun;

let name3 = participants.find(element => element["name"].split(' ').length >= 3);
taskC.innerHTML = name3["name"];

let code = [];
let countryname = []
for (let index = 0; index < participants.length; index++) {
    const element = participants[index]["nation"];
    if (!code.includes(element)) {
        code.push(element);

        countryname.push(nations[element])
    }
}

merge = []
for (let index = 0; index < code.length; index++) {
    merge.push(code[index] + ":" + countryname[index] + " ");
}
taskE.innerHTML = merge

let partnumber = [];
for (let country = 0; country < code.length; country++) {
    let db = 0;
    for (let index = 0; index < participants.length; index++) {
        if (participants[index]["nation"] == code[country]) {
        db += 1
        }
    }
    partnumber.push(db);
}

let max = partnumber[0]
let maxcountry = code[0]
for (let index = 0; index < partnumber.length; index++) {
    if(max < partnumber[index]){
        max = partnumber[index]
        maxcountry = code[index]
    }
}
taskF.innerHTML = nations[maxcountry]