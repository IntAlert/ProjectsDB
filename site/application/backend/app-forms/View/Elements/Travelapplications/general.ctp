<p>Does your destination country have an Alert office? *</p>
<md-radio-group ng-model="formData.mode">

  <md-radio-button value="has-office" class="md-primary">Yes, the country does have an Alert office</md-radio-button>
  <md-radio-button value="no-office"> No, the country does not have an Alert office </md-radio-button>

</md-radio-group>

<md-input-container class="md-block">
	<label>Reason for your trip *</label>
	<textarea ng-model="formData.applicant.reason" md-minlength="3" md-maxlength="350" rows="5" required></textarea>
</md-input-container>


	<div class="input select">
		<label>Name of manager who has approved trip *</label>
		<select 
			required
			ng-model="formData.applicant.approving_manager" 
			ng-options="office365user.displayName for office365user in office365Users.all track by office365user.objectId">
		</select>
	</div>

	<div layout="row" layout-align="end center">
	  
		<md-button 
			ng-show="generalForm.$valid"
			ng-click=" changeActiveTab(1) "
			class="md-raised">
			Next
		</md-button>
	</div>