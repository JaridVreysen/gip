
function submitFiche() {
  console.log('klik');
  const coverFile = $("#coverFile")[0].files[0];
  const muscleFile = $("#muscleFile")[0].files[0];
  const exerciseFile = $("#exerciseFile")[0].files[0];

  if (!coverFile || !muscleFile || !exerciseFile) {
    alert("Selecteer alle 3 afbeeldingen (cover / muscle / exercise).");
    return;
  }

  const fd = new FormData();
  fd.append("coverPicture", coverFile);
  fd.append("musclePicture", muscleFile);
  fd.append("exercisePicture", exerciseFile);

  const ficheTitle = $('#ficheTitle').val();
  const niveau = $('#niveau').val();
  const muscles = $('#muscles').val();
  const ficheHours = $('#ficheHours').val();
  const ficheMinutes = $('#ficheMinutes').val();
  const time = parseInt((Number(ficheHours) * 60) + Number(ficheMinutes));
  console.log(ficheHours);
  console.log(ficheMinutes);
  console.log(time);
  




  //execute (uitvoering)
  const qUitvoering = window.quillEditors?.uitvoeringEditor;
  if (!qUitvoering) {
    console.error('Quill instance niet gevonden voor #uitvoeringEditor', window.quillEditors);
    return;
  }
  const execute = qUitvoering.root.innerHTML;

  //exercise
  const qExercise = window.quillEditors?.exerciseEditor;
  if (!qExercise) {
    console.error('Quill instance niet gevonden voor #exerciseEditor', window.quillEditors);
    return;
  }
  const exercise = qExercise.root.innerHTML;

  console.log('execute:', execute);
  console.log('exercise:', exercise);

  fd.append("ficheTitle", ficheTitle);
  fd.append("niveau", niveau);
  fd.append("execute", execute);
  fd.append("muscles", muscles);
  fd.append("exercise", exercise);
  fd.append("time", time);
  $.ajax({
    method: 'POST',
    url: './includes/create-fiche.php',
    data: fd,
     processData: false,
    contentType: false,
    dataType: 'json',
    success: function (response) {
      console.log(response);
    },
    // error: function(err) {
    //   console.error('failed', err);
    // }
  });
}

