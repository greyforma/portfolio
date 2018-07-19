//scroll au click
$(document).ready(function(){
    // au clic sur un lien
    $('nav a').on('click', function(evt){
       // bloquer le comportement par défaut: on ne rechargera pas la page
       evt.preventDefault();
       // enregistre la valeur de l'attribut  href dans la variable target
	var target = $(this).attr('href');
       /* le sélecteur $(html, body) permet de corriger un bug sur chrome
       et safari (webkit) */
       //console.log(this);
	$('html, body')
       // on arrête toutes les animations en cours
       .stop()
       /* on fait maintenant l'animation vers le haut (scrollTop) vers
        notre ancre target */
       .animate({scrollTop: $(target).offset().top}, 600 );
    });
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        $(".zoomscroll img").css({
            width: (100 + scroll/5)  + "%",
            top: -(scroll/10)  + "%",
            //Blur suggestion from @janwagner: http://codepen.io/janwagner/ in comments
            "-webkit-filter": "blur(" + (scroll/100) + "px)",
            filter: "blur(" + (scroll/100) + "px)"
        });
    });
});

// set up text to print, each item in array is new line
var aText = new Array(
"Vous pouvez me laisser un message, ",
"je reviendrais vers vous au plus vite. ",
"Bonne journée !",
);
var iSpeed = 200; // time delay of print out
var iIndex = 0; // start printing array at this posision
var iArrLength = aText[0].length; // the length of the text array
var iScrollAt = 20; // start scrolling up at this many lines

var iTextPos = 0; // initialise text position
var sContents = ''; // initialise contents variable
var iRow; // initialise current row

function typewriter()
{
 sContents =  ' ';
 iRow = Math.max(0, iIndex-iScrollAt);
 var destination = document.getElementById("typedtext");

 while ( iRow < iIndex ) {
  sContents += aText[iRow++] + '<br />';
 }
 destination.innerHTML = sContents + aText[iIndex].substring(0, iTextPos) + "_";
 if ( iTextPos++ == iArrLength ) {
  iTextPos = 0;
  iIndex++;
  if ( iIndex != aText.length ) {
   iArrLength = aText[iIndex].length;
   setTimeout("typewriter()", 500);
  }
 } else {
  setTimeout("typewriter()", iSpeed);
 }
}


typewriter();


/*google map*/
// function myMap() {
//   var amsterdam = new google.maps.LatLng(52.395715,4.888916);
//
//   var mapCanvas = document.getElementById("map");
//   var mapOptions = {center: amsterdam, zoom: 7};
//   var map = new google.maps.Map(mapCanvas,mapOptions);
//
//   var myCity = new google.maps.Circle({
//     center: amsterdam,
//     radius: 50000,
//     strokeColor: "#0000FF",
//     strokeOpacity: 0.8,
//     strokeWeight: 2,
//     fillColor: "#0000FF",
//     fillOpacity: 0.4
//   });
//   myCity.setMap(map);
// }

// <script src="{{asset('https://maps.googleapis.com/maps/api/js?key=AIzaSyCETLRPWoPNBHYFsMLj64rW6Pn5ovo6Ae8&callback=myMap')}}"></script>




/*//scroll souris zoom
$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    $(".zoomscroll img").css({
    width: (100 + scroll/5)  + "%",
    top: -(scroll/10)  + "%",
    });

});
})*/

/*v2*/
/*$(document).ready(function(){
	$('#nav').localScroll(800);

	//.parallax(xPosition, speedFactor, outerHeight) options:
	//xPosition - Horizontal position of the element
	//inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
	//outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
	$('#accueil').parallax("50%", 0.1);
	$('#comp').parallax("50%", 0.1);
	$('.bg').parallax("50%", 0.4);
	$('#cv').parallax("50%", 0.3);
    $('#accueil').parallax("50%", 0.2);*/
