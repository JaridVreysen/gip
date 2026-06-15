
function changeprofile() {
    // console.log('klik');

    const firstName = $('#firstName').val();
    const lastName = $('#lastName').val();
    const age = $('#age').val();
    const gender = $('#gender').val();
    console.log(gender);

    const organistation = $('#organistation').val();
    console.log(organistation);

    const length = $('#length').val();
    const weight = $('#weight').val();
    const about = $('#about').val();
    const profilePicture = $('#profilePicture').val();
    // console.log(profilePicture);




    // console.log(ficheTitle);
    // console.log(shortDescription);
    $.ajax({
        method: 'POST',
        url: './includes/edit-profile.php',
        data: {
            firstName,
            lastName,
            age,
            gender,
            length,
            weight,
            about,
            profilePicture,
            organistation
        },
        dataType: 'json',
        success: function (response) {
            console.log(response);
        },
        error: function (err) {
            console.error('failed', err);
        }
    });
}

function uploadFile() {

    // console.log($("#file")[0]);
    // console.log($("#file")[0].files);
    // console.log($("#file")[0].files[0]);

    const file = $("#file")[0].files[0];


    if (!file) {
        $('#editProfileUploadProfilePicture').html('Please select a file!');
        return;
    }
    //formulier maken
    let formData = new FormData();
    console.log(file);


    //file in het formulier
    formData.append('file', file);

    $.ajax({
        url: './includes/uploadFile.php',
        method: 'POST',
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,

        success: function (response) {
            console.log(response);

            if (response.error) {
                $('#editProfileUploadProfilePicture').html(response.error);
                console.log(typeof response, response);
                console.log("hallo");
                
            }
            else {
                $('#editProfileUploadProfilePicture').html('File upload succes!');
                console.log("hallo");
                
            }
        }

    });
}