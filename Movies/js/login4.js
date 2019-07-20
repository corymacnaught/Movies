var submitBool = false;

$(document).ready(function() {
	
	$("#credentialsForm").validate({
		rules: {
			user: {
				required: true
			},
			
			pass: {
				required: true
			}
		},
		
		messages: {
			user:{
				required: '<p style="color: #ffffff;">Un username est requis.</p>'
			},
			
			pass:{
				required: '<p style="color: #ffffff;">Un mot de passe est requis.</p>'
			}
		},
		
		submitHandler: function(form) {
			// submit la formulaire
			if (submitBool) form.submit();
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

	
	function encrypt(pass) {
		// Encrypt le mot de pass
		var encryptedPass = CryptoJS.AES.encrypt(JSON.stringify(pass), "cle", {format: CryptoJSAesJson}).toString();
		return encryptedPass;
	};
	
	$('#buttonlogin').click(function(){
		
		// vérifie si la formulaire est valide
		if($('#credentialsForm').valid()){
			
			var val = $('#user').val();
			var pass = $('#pass').val();
			
			$.ajax({
				url : '../php/BusinessLayer/loginSearch.php',
				method: 'POST',
				data: {user: val},
				success: function (data, status){
					// Vérifie si un objet a été retrouvé du base de donnée
					if (data.indexOf('non-object') == -1){
						// Décrypt et compare le mot de passe du base de donnée
						if (JSON.parse(CryptoJS.AES.decrypt(data, "cle", {format: CryptoJSAesJson}).toString(CryptoJS.enc.Utf8)) == pass){
							submitBool = true;
						}else{
							submitBool = false;
						}
					}
					else{
						submitBool = false;
					}
					
					// affiche un message si le login n'était pas bonne
					if (submitBool){
						$('#mauvaisLoginText').html('');
						$('#credentialsForm').submit();
					}else{
						$('#mauvaisLoginText').html('<p style="color: #ffffff">L\'information que vous avez rentré n\'est  pas valide</p>');
					}
				},
				error: function (result, status, error) {
					alert("result: " + result + " status: " + status + " error: " + error);
				}
			});
		}
    });
});
