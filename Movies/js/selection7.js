var numElements = 4;

// Rempli le main avec les films en fonction de ce qui a cherché l'utilisateur
function fillMain(data) {
	var main = $('#main');
	
	main.empty();
	
	var filmArray = [];
	data.forEach(function(val){
		filmArray.push(val);
	});
	
	var numberOfRows = (data.length / numElements);
	
	var k = 0;
	var htmlString = "";
	
	for (var i=0; i<numberOfRows; i++) {
		htmlString += '<div class="row">';
			for (var g=0; g<numElements; g++){
				if (filmArray.length > k){
					film = filmArray[k++];
					htmlString += '<div class="col-lg-3 mb-3">'
						htmlString += '<div class="row">';
						htmlString += '<div class="movie-container col-lg-12">';
							htmlString += '<img class="movie-cover m-auto border border-selection" src="../img/' + film.nom + '.jpg" alt="' + film.nom + '"></img>';
							htmlString += '<form class="" method="GET" action="description.php">';
								htmlString += '<input name="film" type="hidden" value="' + film.idFilm + '"/>';
								htmlString += '<button class="" type="submit">' + film.nom + '</button>';
							htmlString += '</form>';
						htmlString += '</div>';
						htmlString += '</div>'
					htmlString += '</div>';
				}
			}
		htmlString += '</div>'
	}
	
	main.html(htmlString);
}

$(document).ready(function() {

    
    $('#movieSearch').keyup(function(){
		
		var val = "" + $(this).val() + "";
		
		$.ajax({
			url : '../php/BusinessLayer/movieSearch.php',
			method: 'GET',
			dataType : 'json',
			data: {search: val},
			success: function (data, status){
				fillMain(data);
			},
			error: function (result, status, error) {
				alert("result: " + result + " status: " + status + " error: " + error);
			}
		});
    });
	
	/*$('#movieGenre').change(function(){
		
		var action = $('#actionCheckBox').is(":checked");
		var adventure = $('#adventureCheckBox').is(":checked");
		var comedie = $('#comedieCheckBox').is(":checked");
		var documentary = $('#documentaryCheckBox').is(":checked");
		var drama = $('#dramaCheckBox').is(":checked");
		var horror = $('#horrorCheckBox').is(":checked");
		var romance = $('#romanceCheckBox').is(":checked");
		var scifi = $('#scifiCheckBox').is(":checked");
		
		$.ajax({
			url : 'php/BusinessLayer/movieSearch.php',
			method: 'GET',
			data: {genre: action},
			success: function (data, status){
				
			},
			error: function (result, status, error) {
				alert("result: " + result + " status: " + status + " error: " + error);
			}
		});
    });*/
});