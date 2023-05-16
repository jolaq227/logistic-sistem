let ust = document.querySelector('.profil-ust');
let profil = document.querySelector('.pas');
let ok = document.querySelector('p.ok');

profil.addEventListener('click', function () {

    if (ust.style.top === "-9vh") {

        //ust.style.display = 'none';
        ust.style.top = '-500px';
        ok.style.transform = 'rotate(90deg)';

    } else if (ust.style.top != "-9vh") {

        //ust.style.display = 'block';
        ust.style.top = '-9vh';
        ok.style.transform = 'rotate(270deg)';

    }
});



let onayla = document.querySelectorAll('.confirm');

for (let i = 0; i < onayla.length; i++) {
  onayla[i].addEventListener("click", function () {
    if (confirm('Onaylıyor musunuz?') == true) {
      
    } else {
      this.href = '';
    }
  });
}

let toplam = document.querySelector('input.toplam');
let hesapla = document.querySelector('input.hesapla');
let adet   = document.getElementById('s-adet');
let fiyat  = document.getElementById('s-fiyat');

hesapla.addEventListener('click', function () {
  toplam.value = adet.value * fiyat.value;

});
// toplam.value = adet * fiyat;
console.log(hesapla);