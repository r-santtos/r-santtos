// Set the date we're counting down to
const countDownDate = new Date("Dec 31, 2021 23:59:59").getTime();
const countDownDateStart = new Date("Dec 31, 2020 23:59:59").getTime();

const totalDayYear = countDownDate - countDownDateStart
const totalDay = Math.floor(totalDayYear / (1000 * 60 * 60 *24)); 
const porcDay = 100 / totalDay;

// Update the count down every 1 second
const x = setInterval(function() {

  // Get today's date and time
  const now = new Date().getTime();

  // Find the distance between now and the count down date
  const distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  const days = Math.floor(distance / (1000 * 60 * 60 * 24));
  const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("days").innerHTML = ('000' + days).slice(-3);

  document.getElementById("hours").innerHTML = ('0' + hours).slice(-2);

  document.getElementById("minutes").innerHTML = ('0' + minutes).slice(-2);

  document.getElementById("seconds").innerHTML = ('0' + seconds).slice(-2);

  document.getElementById("line-two").style.width = days * porcDay+"%"; 
  document.getElementById("line-twos").style.width = Math.round((100 / 60)*seconds)+"%"; 

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);