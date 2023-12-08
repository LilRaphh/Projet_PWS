/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

import './styles/app.css';

const slide = ["{{ asset('assets/images/bouteille1.png')}}",
"{{ asset('assets/images/bouteille2.png')}}",
"{{ asset('assets/images/bouteille3.png')}}",
"{{ asset('assets/images/bouteille4.png')}}",
"{{ asset('assets/images/bouteille5.png')}}",
"{{ asset('assets/images/bouteille6.png')}}"];
let numero = 0;

function ChangeSlide(sens) {
    numero = numero + sens;
    if (numero < 0)
        numero = slide.length - 1;
    if (numero > slide.length - 1)
        numero = 0;
    document.getElementById("slide").src = slide[numero];
}