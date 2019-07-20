$(document).ready(function() {
	
	$.validator.addMethod('paysValid', function(value, element) {
		return value != "Aucune";
	}, 'non-valide.')
	
	$.validator.addMethod('adresseValid', function(value, element) {
		//var regex = /^^()$/
		//return regex.test(value);
		return value.indexOf('\'') == -1;
	}, 'non-valide.')
	
	$.validator.addMethod('codePostalValid', function(value, element) {
		var regex = /^^([A-Z][0-9][A-Z][0-9][A-Z][0-9])$/
		return regex.test(value);
	}, 'non-valide.')
	
	$.validator.addMethod('creditValid', function(value, element) {
		var regex = /^^([0-9]{16})$/
		return regex.test(value);
	}, 'non-valide.')
	
	$.validator.addMethod('cvvValid', function(value, element) {
		var regex = /^^([0-9]{3})$/
		return regex.test(value);
	}, 'non-valide.')
	
	$("#commande").validate({
		rules: {
			pays: {
				required: true,
				paysValid: true
			},
			
			adresse: {
				required: true,
				adresseValid: true
			},
			
			codePostal: {
				required: true,
				codePostalValid: true
			},
			
			credit: {
				required: true,
				creditValid: true
			},
			
			cvv: {
				required: true,
				cvvValid: true
			}
		},
		
		messages: {
			pays:{
				required: '<p>Choisi un pays.</p>',
				paysValid: '<p>Choisi un pays.</p>'
			},
			
			adresse:{
				required: '<p>Une adresse est requis.</p>',
				adresseValid: '<p>Le format que vous avez rentré n\'est pas valide</p>'
			},
			
			codePostal:{
				required: '<p>Un code postal est requis.</p>',
				codePostalValid: '<p>Le format que vous avez rentré n\'est pas valide (format: A1A1A1)</p>'
			},
			
			credit:{
				required: '<p>SVP rentrez le numéro de votre carte de crédit</p>',
				creditValid: '<p>Le format que vous avez rentré n\'est pas valide (format: 1234123412341234)</p>'
			},
			
			cvv:{
				required: '<p>SVP rentrez le CVV de votre carte de crédit</p>',
				cvvValid: '<p>Le format que vous avez rentré n\'est pas valide (format: 123)</p>'
			}
		},
		
		submitHandler: function(form) {
			// encrypt le # du carte de crédit
			var credit = encrypt($('#credit').val());
			var cvv = encrypt($('#cvv').val());
			
			// rentre les valeurs encryter dans ses textfields 
			$('#credit').val(credit);
			$('#cvv').val(cvv);
			
			//Soumet la formulaire
			form.submit();
			
			// vide tout les textfields de la formulaire
			$('#commande').each(function() {
				this.reset();
			});
		}
	});
	
	var CryptoJSAesJson = {
		stringify: function (cipherParams) {
			var j = {ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64)};
			if (cipherParams.iv) j.iv = cipherParams.iv.toString();
			if (cipherParams.salt) j.s = cipherParams.salt.toString();
			return JSON.stringify(j);
		},
			parse: function (jsonStr) {
			var j = JSON.parse(jsonStr);
			var cipherParams = CryptoJS.lib.CipherParams.create({ciphertext: CryptoJS.enc.Base64.parse(j.ct)});
			if (j.iv) cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv)
			if (j.s) cipherParams.salt = CryptoJS.enc.Hex.parse(j.s)
			return cipherParams;
		}
	}

	
	function encrypt(value) {
		var encrypted = CryptoJS.AES.encrypt(JSON.stringify(value), "cle", {format: CryptoJSAesJson}).toString();
		return encrypted;
	};
	
    $('#pays').change(function(){
        // Chercher les valeurs et elements requis.
        var val = $(this).val();
        var province = $('#province');
		var codePostalText = $('#codePostalText');
		var provinceText = $('#provinceText');
        
        province.empty();
        // Si la valeur de province n'est pas Aucune on continue.
        // Si elle est Aucune on disable les select pour ville
        if (val != "Aucune"){
			
			$.ajax({
				url : '../php/BusinessLayer/listeProvince.php',
				method: 'GET',
				dataType : 'json',
				data: {pays: val},
				success: function (data, status){
					// On append l'information de la base de donnees pour les provinces dans
					// le select pour les provinces et on enleve le disable dessus.
					data.forEach(function(val){
						province.append('<option value="' + val.province + '">' + val.province + '</option>');
					});
					province.prop('disabled', false);
					
					// Change le text des labels du Code Postal et du Province en fonction de la pays sélectionné
					if (val == "Canada"){
						codePostalText.text("Code Postal");
						provinceText.text("Province");
					}else if(val == "États-Unis"){
						codePostalText.text("ZIP Code");
						provinceText.text("État");
					}
				},
				error: function (result, status, error) {
					alert("result: " + result + " status: " + status + " error: " + error);
				}
			});
			
        } else {
			// Default
			codePostalText.html("Code Postal");
			provinceText.html("Province");
            province.prop('disabled', true);
        }
    });
});
