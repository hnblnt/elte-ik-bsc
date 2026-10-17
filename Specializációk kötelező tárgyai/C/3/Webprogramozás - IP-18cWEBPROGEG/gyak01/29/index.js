const temps = [3.4, 1.2, -0.7, -2, 20, 6]

//a.

const fagy = temps.filter(t => t < 0)
console.log(`${fagy}`);
console.log(temps.filter(t => t < 0));

//b.
/*temps.forEach((elem, i, arr) => arr[i] = elem + " C")
console.log(temps)

const ujtomb = temps.map((elem) => elem+" C")
console.log(ujtomb);*/

//c.

const max = Math.max(...temps);
const max2 = temps.reduce((m, x) => Math.max(m, x));
const max3 = temps.reduce((m, x) => m > x ? m : x);


//f. 
//Some: legalább egy true az elemek közül, every: Az összes elemre igaz-e

const vane = (temps.some(e => e <= 0 )? "nem" : "igen");
const vane2 = (temps.every(e => e > 0)? "igen" : "nem");
console.log(vane2);

//d.
const darab = (temps.filter(e => e < 20)).length;
console.log(darab);

//e.
const negyvenfelett = (temps.some(e =>e > 40)? "van" : "nincs");
console.log(negyvenfelett);

//g.
const index = temps.findIndex(e => e > 10);
console.log(index);