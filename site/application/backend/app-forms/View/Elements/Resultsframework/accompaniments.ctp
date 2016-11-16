<h2>Accompaniment Summary</h2>
<table>
	<tr ng-repeat="(i, participant_type) in FormOptions.participant_types">
		<th>{{participant_type.ParticipantType.name}}</th>
		<td>{{data.totals.participant_type_counts[participant_type.ParticipantType.id] || 0}}</td>
	</tr>
</table>

<div class="instruction-block">
	
	<p>
		Please note the number of each category of formal entity which we have actively accompanied, i.e. with which we worked in a relationship as a partner, critical friend, capacity-builder, etc.
	</p>

	<p>
	Veuillez noter le nombre de chaque catégorie d'entité formelle que nous avons activement accompagné, c'est-à-dire avec lesquels nous avons travaillé en tant que partenaire, « ami critique », etc.
	</p>

</div>


<div class="item-list-header clearfix">
	<h2>Accompaniments</h2>

	<md-button class="md-raised" ng-click="showAccompanimentItemDialog()">Add Accompaniment</md-button>

</div>


<div ng-hide="data.items.length">
	None
</div>


<table ng-show=" data.items.length ">
	<thead>
		<tr>
			<th>
				Title
			</th>

			<th>
				Date
			</th>

			<th>
				Participant Types
			</th>

			<th width="25%"></th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="(i, accompaniment) in data.items">
			<td>
				{{accompaniment.Accompaniment.title}}
			</td>


			<td>
				{{accompaniment.Accompaniment.date | date:'dd/MM/yyyy'}}
			</td>


			<td>
				<span ng-repeat="participant_type in accompaniment.ParticipantType | filter:cutOutZero()">
				
					{{participant_type.name}}
					({{participant_type.AccompanimentsParticipantType.count}}){{$last ? '' : ', '}}
				
				</span>
			</td>
			
			<td>

				<md-button 
					class="md-raised" 
					ng-click="showAccompanimentItemDialog(i)">
					Edit
				</md-button>

				<md-button 
					class="md-raised" 
					ng-click="removeAccompanimentItem(accompaniment.Accompaniment.id)">
					Remove
				</md-button>

			</td>
		</tr>
	</tbody>
	
</table>





