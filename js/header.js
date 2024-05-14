// Výběr HTML tagů, se kterými budu pracovat:
const menuIcon = document.querySelector(".menu-icon"); // jdi do documentu (HTML) a vyber mi classu menu-icon,
// a ulož mi to do proměnné menuIcon.
// const - tímto ZAČÍNÁ PROMĚNNÁ
// query je PŘÍKAZ
// Selector zn. podle čeho budu vybárat

const navigation = document.querySelector("nav");
const hamburgerIcon = document.querySelector(".fa-solid");

console.log(menuIcon, navigation, hamburgerIcon); // KONTROLA - stránku JE NĚKDY NUTNÉ NĚKOLIKRÁT REFRESHNOUT, aby se zobrazil HTML kód v konzole.

// Zachytím událost KLIKnutí na ikonku HAMBURGERU (ukáže se po zůžení displaye pod 800px):
menuIcon.addEventListener("click", () => {
  // tady ve funkci bude popsáno, co se má stát:
  console.log(hamburgerIcon.classList); // Po kliknutí na HAMBURGER, vypíše do konzoly OČÍSLOVANÝ SEZNAM class uložených v proměnné hamburgerIcon.
  // Mě zajímá classa s číslem 1: "fa-bars" (to je ikonka HAMBURGERU)
  // classa "fa-xmark" je ikonka KŘÍŽKU.

  if (hamburgerIcon.classList[1] === "fa-bars") {
    // Tato podmínka PŘEPÍNÁ ikonky HABURGERU a KŘÍŽKU:
    // V seznamu tříd - je-li na pozici [1] prvek "fa-bars"
    hamburgerIcon.classList.remove("fa-bars"); // V seznamu tříd - prvek "fa-bars" ODSTRAŇ
    hamburgerIcon.classList.add("fa-xmark"); // V seznamu tříd - prvek "fa-xmark" PŘIDEJ
    navigation.style.display = "block"; // = ZOBRAZIT PRVEK
  } else {
    hamburgerIcon.classList.remove("fa-xmark"); // V seznamu tříd - prvek "fa-xmark" ODSTRAŇ
    hamburgerIcon.classList.add("fa-bars"); // V seznamu tříd - prvek "fa-bars" PŘIDEJ
    navigation.style.display = "none"; // = PRVEK SKRÝT
  }
});
// odposlech událostí (klik myší) - DŮLEŽITÝ PRO ZACHYCENÁ KLIKNUTÍ, apod.
// Následuje čárka, a CO SE MÁ PO KLIKNUTÍ SPUSTIT (NĚJAKOU FUNKCI).
