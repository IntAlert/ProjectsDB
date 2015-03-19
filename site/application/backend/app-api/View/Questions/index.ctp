
			<?php foreach ($questions as $question): ?>
				

				<div 
					class="row question" 
					data-question-index="<?php echo $question['Question']['id']; ?>"
					id="question-<?php echo $question['Question']['id']; ?>"
				>

					<div class="col-sm-6 question-image">

						<img src="<?php echo $question['Question']['image_url']; ?>">

					</div>

					<div class="col-sm-6 question-text">

						<dl class="clearfix">
							<dt>
								<?php echo $question['Question']['sort_order']; ?>/10:
							</dt>
							<dd>
								<?php echo $question['Question']['content']; ?>
							</dd>
						</dl>
						
					</div>


				  <div class="col-sm-12 answers">



					<?php foreach ($question['Questionoption'] as $questionoption): ?>


				    <div class="input-group">
				    	
				      <span class="input-group-addon">
				        <input 
				        	class="answer"
					        type="radio" 
					        aria-label="<?php echo $questionoption['content']?>" 
					        name="question-<?php echo $question['Question']['id']?>" 
					        id="questionoption-<?php echo $questionoption['id']?>"
					        value="<?php echo $questionoption['id']?>"
				        >
				      </span>
				      <label 
				      	class="form-control answer" 
				      	for="questionoption-<?php echo $questionoption['id']?>"
				      >
					      <?php echo $questionoption['content']?>
					  </label>
				      
				    </div><!-- /input-group -->

					<?php endforeach; // ($question['Questionoption'] as $questionoption): ?>

				  </div><!-- /.col-md-6 -->


				  <div class="col-sm-12 controls">

				  	<div class="btn-group btn-group-justified" role="group" aria-label="Controls">
					  <div class="btn-group" role="group">
					    <button type="button" class="btn btn-default prev btn-alpha disabled">&laquo; Back</button>
					  </div>
					  
					  <div class="btn-group" role="group">
					    <button type="button" class="btn btn-default next btn-alpha disabled">Next &raquo; </button>
					  </div>
					</div>

				  </div>

				</div><!-- /.row -->


			<?php endforeach; // ($questions as $question): ?>


			<!-- Facebook -->
			<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=<?php echo Configure::read('FACEBOOK_APP_ID') ?>&version=v2.0";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>