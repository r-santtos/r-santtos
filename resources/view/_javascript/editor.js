function vai() {
  let codes = document.getElementsByClassName('c');
  for (let i = 0; i < codes.length; i++) {
    let porra = codes.item(i);
    let porra2 = porra.getElementsByTagName('h1');

    for (let i = 0; i < porra2.length; i++) {
      let porra3 = porra2.item(i);
      porra3.innerHTML="<span class='porra'><<span><span class='porras'>h2<span>>"+ porra3.innerText +"<span class='porra'><<span>h2/>";
    }
  }
}