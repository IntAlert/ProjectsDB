<div layout="row" ng-show="!searching && travelapplications.length == 0">

		No travel applications found

</div>

<div layout="row" ng-show="travelapplications.length">

	<div flex>
		<table cellpadding="0" cellspacing="0">
			<thead>
			<tr>
					
					<th>Destinations</th>
					<th>Applicant</th>
					<th>Approving Manager</th>
					<th>Contact (HQ)</th>
					<th>Contact (Home)</th>
					<th>Contact (In Country)</th>
					<th>Created</th>
					<th class="actions">Actions</th>
			</tr>
			</thead>
			<tbody>
			<tr
				ng-repeat="ta in travelapplications">

				<td>

		  			<span ng-repeat="itinerary_item in ta.itinerary">
							{{itinerary_item.destination.Territory.name}}{{$last ? '' : ', '}}
					</span>

				</td>


				<td>
					{{ta.applicant.name}}
				</td>
				<td>
					{{ta.applicant.approving_manager.displayName}}
				</td>

				<!-- Contacts -->
				<td>						
					{{ta.contact_hq.user.displayName}}
				</td>

				<td>
					{{ta.contact_home.user.displayName || "n/a"}}
				</td>
				<td>
					{{ta.contact_incountry.user.displayName || "n/a"}}
				</td>

				

				<td>{{ta.created|date:"dd/MM/yyyy 'at' h:mma"}}</td>
				
				<td class="actions">
					<a 
						ng-click="previewTravelapplication($event, ta)"
						class="md-button">
						View
					</a>
				</td>
			</tr>
			</tbody>
			</table>

			<!-- <pre>{{travelapplications | json}}</pre> -->

		</div>

	</div>



 <div style="visibility: hidden">
<div class="md-dialog-container" id="myDialog">
  <md-dialog layout-padding>
    

    <md-toolbar>
		      <div class="md-toolbar-tools">
		        <h2>
		        	Travel Application for {{formData.applicant.name}}
		        </h2>
		      </div>
		    </md-toolbar>
    

				        
		     <md-dialog-content>
		      <div class="md-dialog-content">

								<?php echo $this->element('Travelapplications/confirm/general'); ?>

								<?php echo $this->element('Travelapplications/confirm/applicant'); ?>

								<?php echo $this->element('Travelapplications/confirm/contacts'); ?>

								<?php echo $this->element('Travelapplications/confirm/itinerary'); ?>

								<?php echo $this->element('Travelapplications/confirm/meetings'); ?>

								<?php echo $this->element('Travelapplications/confirm/security'); ?>

								<?php echo $this->element('Travelapplications/confirm/checklist'); ?>

								<!-- <pre>{{formData |json}}</pre> -->
							</div>
						</md-dialog-content>


						<md-dialog-actions
							ng-show="isAdmin || (formData.applicant.id == me.id)"
							layout="row">


							<span flex></span>
		      
	      <md-button 
		      target="_blank"
		      class="md-raised"
	      	ng-href="/forms/travelapplications/edit/{{formData.id}}">
	       Edit
	      </md-button>
		      
		     
		    </md-dialog-actions>


  </md-dialog>
</div>
</div>