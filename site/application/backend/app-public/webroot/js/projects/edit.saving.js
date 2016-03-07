var changesUnsaved = false;

// ENSURE UNSAVED CHANGES ARE NOTICED
$(function(){
  // assume any changes up to now were code-driven
  changesUnsaved = false;

  // detect future changes
  $("textarea,input,select").change(function(){
    changesUnsaved = true;
  })
});

// warn if there were changes
$(window).on('beforeunload', function() {
    if (changesUnsaved) {
        return 'You have unsaved changes. Are you sure you want to leave?'
    }
}); 
