function signup() {
  const email = $('#email').val();
  const firstname = $('#FirstName').val();
  const lastname = $('#LastName').val();
  const user = $('#UserName').val();
  const password1 = $('#Password1').val();
  const password2 = $('#Password2').val()
  const termsAccepted = $('#checkbox-1').is(':checked');

  // Check empty fields
  if (!email || !firstname || !lastname || !user || !password1 || !password2) {
    $('#createInformation').html('Gelieve alle velden in te vullen.');
  }
  // Check passwords match
  else if (password1 != password2) {
    $('#createInformation').html('Wachtwoorden komen niet overeen.');
  }
  else {
    $.ajax({
      method: 'POST',
      url: './includes/signup.php',
      data: {
        email: email,
        FirstName: firstname,
        LastName: lastname,
        UserName: user,
        Password1: password1,
        Password2: password2,
        termsAccepted: termsAccepted
      },
      dataType: 'json',
      success: function (response) {
        console.log(response);

        if (response.error) {
          $('#createInformation').html(response.error);
          console.log(typeof response, response);
        } 
        else {
          $('#createInformation').html('Account aangemaakt!');
          window.location.href = "index.php";
        }
      }
    });
  }
}

function login() {
  const user = $('#UserName').val();
  const password = $('#Password').val();
// console.log(user, password)
  // Controleer of velden leeg zijn
  if (!user || !password) {
    $('#loginInformation').html('Gelieve gebruikersnaam en wachtwoord in te vullen.');
  }
  else {
    $.ajax({
      method: 'POST',
      url: './includes/login.php',
      data: {
        UserName: user, 
        Password: password
      },
      dataType: 'json', 
      success: function(response) {
        console.log(response);

        if (response.error) {
          $('#loginInformation').html(response.error);
        } else {
          $('#loginInformation').html('Welkom!');
          window.location.href = "index.php";
        }
      },
      error: function(err) {
        console.error('Login failed', err);
        $('#loginInformation').html('Er is iets misgegaan bij het inloggen.');
      }
    });
  }
}


function logout() {
  $.ajax({
    method: 'POST',
    url: './includes/logout.php',
    data: {},
    datatype: 'json',
    success: function (data) {
      window.location.reload()
      console.log(data);

    }
  })
}

//refresh
function refresh() {
  window.location.reload();
}
