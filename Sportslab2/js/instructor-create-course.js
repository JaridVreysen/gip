
  // function createcourse() {
  //   console.log('klik');








  //   const courseTitle = $('#courseTitle').val();
  //   const shortDescription = $('#shortDescription').val();
  //   // console.log(courseTitle);
  //   // console.log(shortDescription);
  //     $.ajax({
  //       method: 'POST',
  //       url: './includes/create-course.php',
  //       data: {
  //         courseTitle: courseTitle, 
  //         shortDescription: shortDescription
  //       },
  //       dataType: 'json', 
  //       success: function(response) {
  //         console.log(response);
  //       },
  //       // error: function(err) {
  //       //   console.error('failed', err);
  //       // }
  //     });
  // }

  function createcourse() {
    console.log('Creating course...');
    
    // Verzamel alle ID's van de tr elementen in sortable2
    const selectedIds = [];
    $('#sortable2 tr:not(.empty-row)').each(function() {
        const id = $(this).attr('id');
        console.log('Found ID:', id);
        if (id) {
            selectedIds.push(id);
        }
    });
    console.log('Selected IDs array:', selectedIds);
    console.log('Joined string:', selectedIds.join(','));
    
    // Check of er items geselecteerd zijn
    if (selectedIds.length === 0) {
        alert('Selecteer eerst minstens één fiche!');
        return;
    }
    
    console.log('Selected IDs:', selectedIds);

    const file = $("#file")[0].files[0];
    const niveau = $('#niveau').val();


    if (!file) {
      alert("Selecteer een afbeelding");
      return;
     }
    // Maak FormData aan
    const fd = new FormData();
    
    // Voeg de fiche IDs toe (als comma-separated string of als array)
    fd.append("fiche_ids", selectedIds.join(',')); // als string: "1,5,8"
    // OF als je meerdere waarden wilt:
    // selectedIds.forEach(id => fd.append("fiche_ids[]", id));
    
    // Eventueel andere course gegevens toevoegen
    const courseTitle = $('#courseTitle').val();
    // const courseDescription = $('#courseDescription').val(); 
    
    //execute (description)
    const qDescription = window.quillEditors?.descriptionEditor;
    if (!qDescription) {
      console.error('Quill instance niet gevonden voor #descriptionEditor', window.quillEditors);
      return;
    }
    const description = qDescription.root.innerHTML;
    
    fd.append("courseTitle", courseTitle);
    fd.append("niveau", niveau);
    fd.append("description", description);
    fd.append("picture", file);





    // Verstuur via AJAX
    $.ajax({
        method: 'POST',
        url: './includes/create-course.php',
        data: fd,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            console.log('Response:', response);
            if (response.success) {
                alert('Course succesvol aangemaakt!');
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(err) {
            console.error('AJAX failed:', err);
            alert('Er is iets misgegaan bij het aanmaken van de course.');
        }
    });
}