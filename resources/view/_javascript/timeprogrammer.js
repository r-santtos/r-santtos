const newDateT = new Date();
const yearT = newDateT.getFullYear();
const monthT = newDateT.getMonth();
const daysT = newDateT.getDate();

const date1 = new Date("1/1/2017");
const date2 = new Date(`"${monthT}/${daysT}/${yearT}"`);
const timeDiff = Math.abs(date2.getTime() - date1.getTime());
const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

// Display the result in the element with id="demo"
document.getElementById("dayss").innerHTML = diffDays;