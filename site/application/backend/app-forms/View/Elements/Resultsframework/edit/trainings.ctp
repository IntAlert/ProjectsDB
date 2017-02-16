<div ng-controller="TrainingsController">
	<h2>Training Summary</h2>

	<table>

		<tr>
			<th>How many training and learning events were carried out within the project, whether by Alert or partners?</th>
			<td>{{data.totals.event_count || 0}}</td>
		</tr>

		<tr>
			<th>How many male participants took part?</th>
			<td>{{data.totals.male_count || 0}}</td>
		</tr>

		<tr>
			<th>How many female participants took part?</th>
			<td>{{data.totals.female_count || 0}}</td>
		</tr>

		<tr>
			<th>How many transgender participants took part?</th>
			<td>{{data.totals.transgender_count || 0}}</td>
		</tr>
		<tr>
			<th>Themes</th>
			<td>
				<span ng-repeat="theme in data.totals.themes">
						{{theme.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !data.totals.themes.length ">
					none
				</span>
			</td>
		</tr>

		<tr>
			<th>Participant Types</th>
			<td>
				<span ng-repeat="participant_type in data.totals.participant_types">
						{{participant_type.name}}{{$last ? '' : ', '}}
				</span>
				<span ng-if=" !data.totals.participant_types.length ">
					none
				</span>
			</td>
		</tr>
	</table>

	<div class="instruction-block">
		<p>
			Please include here all training workshops or other training / learning events held, along with your best estimate of the total number of male and female participants. If you have precise data based on attendance sheets etc., please use them; if not, please use reasonable estimates based on internal reports or on the advice of the trainers who led the workshops.
			<br>
			<strong>
				NB a person who attends two trainings is counted twice.
			</strong>
		</p>
		<p>
			Veuillez inclure ici tous les ateliers de formation ou d'autres activités de renforcement des capacités exécutés, ainsi que votre meilleure estimation du nombre total de participants masculins et féminins. Si vous avez des données précises, veuillez les utiliser; sinon, utilisez des estimations raisonnables fondées sur des rapports internes ou sur les estimations des formateurs qui ont facilité les ateliers.
			<br>
			<strong>NB une personne qui assiste à deux formations est comptée deux fois.</strong>
		</p>
	</div>

	<div class="item-list-header clearfix">
		<h2>Training</h2>

		<md-button 
			class="md-raised" 
			ng-click="showTrainingItemDialog()">Add Training</md-button>

	</div>

	<div ng-hide="data.items.length">
		None
	</div>

	<table ng-show=" data.items.length ">
		<thead>
			<tr>

				<th>
					Start Date
				</th>

				<th>
					Finish Date
				</th>

				<th>
					Title
				</th>

				<th>
					Themes
				</th>

				<th>
					Participant Types
				</th>

				<th>
					Men
				</th>

				<th>
					Women
				</th>

				<th>
					Transgender
				</th>
				<th width="25%"></th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="(i, training) in data.items">
				<td>
					{{training.Training.start_date | date:'dd/MM/yyyy'}}
				</td>

				<td>
					{{training.Training.finish_date | date:'dd/MM/yyyy'}}
				</td>

				<td>
					{{training.Training.title}}
				</td>


				<td>
					<span ng-repeat="theme in training.Theme">
						{{theme.name}}{{$last ? '' : ', '}}
					</span>
					<span ng-if=" !training.Theme.length ">
						none
					</span>
				</td>

				<td>
					<span ng-repeat="participant_type in training.ParticipantType">
						{{participant_type.name}}{{$last ? '' : ', '}}
					</span>
					<span ng-if=" !training.ParticipantType.length ">
						none
					</span>
				</td>

				<td>
					{{training.Training.male_count || 0}}
				</td>

				<td>
					{{training.Training.female_count || 0}}
				</td>

				<td>
					{{training.Training.transgender_count || 0}}
				</td>

				<td>

					<md-button 
						class="md-raised" 
						ng-click="showTrainingItemDialog(i)">
						Edit
					</md-button>

					<md-button 
						class="md-raised" 
						ng-click="removeTrainingItem(training.Training.id)">
						Remove
					</md-button>

				</td>
			</tr>
		</tbody>
		
	</table>
</div>