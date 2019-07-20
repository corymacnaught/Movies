var slideIndex = 0;
showSlides(slideIndex);

function showSlides() {
	var i;
	var slides = document.getElementsByClassName("mySlides");
	for (i = 0; i < slides.length; i++) {
		slides[i].style.display = "none"; 
	}
	slideIndex++;
	if (slideIndex > slides.length) {slideIndex = 1} 
	slides[slideIndex-1].style.display = "block"; 
	setTimeout(showSlides, 10000); // Change image every 10 seconds
}

// Set les valeurs des label en fonction de la langage choisi.
function setValeurs(val) {
	var data = JSON.parse(eval(val));
	$('#boutonLocalisation').html(data[0].langage);
	$('#titre').html(data[0].titre);
	$('#head').html(data[0].head);
	$('#description').html(data[0].description);
	$('#selection').html(data[0].selection);
	$('#releases').html(data[0].releases);
	$('#droits').html(data[0].droits);
}

// Change la langage
function changerLangage(val) {
	if (val == "en") $('#boutonLocalisation').val("fr");
	else $('#boutonLocalisation').val("en");
	setValeurs(val);
}

$(document).ready(function() {
	
	// Change la langage du site web
	$('#boutonLocalisation').click(function(){
			
			var val = $('#boutonLocalisation').val();
			
			$.ajax({
				url : 'php/BusinessLayer/localisation.php',
				method: 'GET',
				data: {langage: val},
				success: function (status){
					changerLangage(val);
				},
				error: function (result, status, error) {
					alert("result: " + result + " status: " + status + " error: " + error);
				}
			});
    });
});