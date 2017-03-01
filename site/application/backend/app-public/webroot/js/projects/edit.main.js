$(function(){
  
    // Summary: limit word count, autogrow
    $("#ProjectSummary, #ProjectBeneficiaries, #ProjectLocation, #ProjectGoals, #ProjectObjectives")
      .each(function(){

        $(this).counter({
          type: 'word',
          goal: 300
        })
        .autoGrow();  
      })    
	
})
