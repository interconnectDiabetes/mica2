<?php
/**
 * Copyright (c) 2016 OBiBa. All rights reserved.
 *
 * This program and the accompanying materials
 * are made available under the terms of the GNU Public License v3.0.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
dpm($study_dto)
?>

<?php if (!empty($populations)): ?>
  <?php foreach ($populations as $key => $population): ?>
    <?php if (!empty($population['data']) && !empty($population['data']['dce-modal'])): ?>
      <div><?php print $population['data']['dce-modal']; ?></div>
    <?php endif; ?>
  <?php endforeach ?>
<?php endif; ?>
<div>
  <div class="row md-bottom-margin">
    <?php if (!empty($study_dto->logo->id)): ?>
      <div class="col-xs-12 col-md-6">
        <a
          href="<?php print obiba_mica_commons_safe_expose_server_url($study_dto->id, $study_dto->logo, 'study', TRUE) ?>"
          class="fancybox-button">
          <img
            src="<?php print obiba_mica_commons_safe_expose_server_url($study_dto->id, $study_dto->logo, 'study') ?>"
            class="imageThumb img-responsive">
        </a>
      </div>
    <?php endif; ?>
    <div class="md-top-margin col-xs-12">
      <?php print obiba_mica_commons_markdown(obiba_mica_commons_get_localized_field($study_dto, 'objectives')); ?>
    </div>

  </div>

  <div class="pull-right md-bottom-margin">
    <?php if ($can_edit_draf_document): ?>
      <a title="<?php print t('Edit') ?>"
         target="_blank"
         href="<?php print MicaClientPathProvider::study_draft_url($study_dto->id) ?>"
         class="btn btn-default">
        <i class="fa fa-pencil-square-o"></i> <?php print t('Edit')?></a>
    <?php endif; ?>

    <?php if (variable_get_value('study_detail_show_search_button')): ?>
        <?php print MicaClientAnchorHelper::studyVariables(NULL, $study_dto->id, TRUE) ?>
    <?php endif; ?>
  </div>
</div>

<div class="clearfix"></div>

<article class="bordered-article">

  <section>
    <div class="row">
      <div class="col-lg-6 col-xs-12 ">
        <!-- GENERAL INFORMATION -->
        <h2 id="overview"><?php print t('General Information') ?></h2>

        <table class="table table-striped">
          <tbody>

          <?php if (!empty($study_dto->acronym)): ?>
            <tr>
              <th><?php print t('Acronym') ?></th>
              <td>
                <p><?php print obiba_mica_commons_get_localized_field($study_dto, 'acronym'); ?></p>
              </td>
            </tr>
          <?php endif; ?>

          <?php if (!empty($study_dto->model->website)): ?>
            <tr>
              <th><?php print t('Website') ?></th>
              <td>
                <p><?php
                  print l(obiba_mica_commons_get_localized_field($study_dto, 'acronym') . ' ' . t('website'),
                    $study_dto->model->website,
                    array('attributes' => array('target' => '_blank')));
                  ?></p>
              </td>
            </tr>
          <?php endif; ?>

          <?php if (!empty($study_dto->model->infoPublic)): ?>
            <tr>
              <th><?php print $localize->getTranslation("study_taxonomy.vocabulary.infoPublic.description"); ?></th>
              <td>
                <p><?php print $localize->getTranslation("study_taxonomy.vocabulary.infoPublic.term." . $study_dto->model->infoPublic . ".title"); ?></p>
              </td>
            </tr>
          <?php endif; ?>


          <?php if (!empty($ordered_membership)): ?>
            <?php foreach ($ordered_membership as $membership): ?>
              <?php if (!empty($membership->members)): ?>
              <tr>
                <th><?php print ucfirst(t($membership->role)) ?></th>
                <td>
                  <ul class="list-unstyled">
                    <?php foreach ($membership->members as  $key_member => $member) : ?>
                      <li>
                        <a href="#" data-toggle="modal"
                           data-target="#<?php print obiba_mica_person_generate_target_id($membership->role, $study_dto->id, $key_member); ?>">
                          <?php print !empty($member->title)?$member->title:''; ?>
                          <?php print !empty($member->firstName)?$member->firstName:''; ?>
                          <?php print !empty($member->lastName)?$member->lastName:''; ?>
                          <?php if (!empty($member->academicLevel)) {
                            print ', ' . $member->academicLevel;
                          } ?>
                          <?php if (!empty($member->institution->name)): ?>
                            (<?php print obiba_mica_commons_get_localized_field($member->institution, 'name'); ?>
                            )
                          <?php endif; ?>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </td>
              </tr>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>

          <?php if (!empty($study_dto->model->startYear)): ?>
            <tr>
              <th><?php print t('Study Start Year') ?></th>
              <td><p><?php print $study_dto->model->startYear; ?></p></td>
            </tr>
          <?php endif; ?>

          <?php if (!empty($study_dto->model->endYear)): ?>
            <tr>
              <th><?php print t('Study End Year') ?></th>
              <td><p><?php print $study_dto->model->endYear; ?></p></td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>

      </div>
      <div class="col-lg-6  col-xs-12">
        <!-- GENERAL DESIGN -->
        <h2 id="design"><?php print t('Methods') ?></h2>

        <table class="table table-striped">
          <tbody>

          <?php if (!empty($study_dto->model->methods->design)): ?>
            <tr>
              <th><?php print t('Study Design') ?></th>
              <td>
                <?php print $localize->getTranslation("study_taxonomy.vocabulary.methods-design.term." . $study_dto->model->methods->design . ".title"); ?>
                  <?php if (!empty($study_dto->model->methods->otherDesign)): ?>
                    : <?php print obiba_mica_commons_get_localized_field($study_dto->model->methods->otherDesign); ?>
                  <?php endif; ?>
              </td>
            </tr>
          <?php endif; ?>

          <?php if (!empty($study_dto->model->methods->followUpInfo)): ?>
            <tr>
              <th><?php print t('General Information on Follow Up (profile and frequency)') ?></th>
              <td>
                <p><?php print obiba_mica_commons_get_localized_field($study_dto->model->methods, 'followUpInfo'); ?></p>
              </td>
            </tr>
          <?php endif; ?>
          <?php if (!empty($study_dto->model->timeline)): ?>
				  <?php if (!empty($study_dto->model->timeline->startYearRec)): ?>
					  <tr>
						<th><?php print t('Recruitment start date') ?></th>
						<td><p><?php print obiba_mica_commons_format_year($study_dto->model->timeline->startYearRec, !empty($study_dto->model->timeline->startMonthRec) ? $study_dto->model->timeline->startMonthRec : NULL); ?></p></td>
					  </tr>
					  <?php if (!empty($study_dto->model->timeline->continueRec)): ?>
					   <tr>
						<th><?php print $localize->getTranslation("study_taxonomy.vocabulary.timeline-continue-rec.description"); ?></th>
						<td><p><?php print $localize->getTranslation("study_taxonomy.vocabulary.timeline-continue-rec.term." . $study_dto->model->timeline->continueRec . ".title"); ?></p></td>
					  </tr>
						  <?php if (stristr($study_dto->model->timeline->continueRec, 'no') && !empty($study_dto->model->timeline->endYearRec)): ?>
							  <tr>
								<th><?php print t('Recruitment end date') ?></th>
								<td><p><?php print obiba_mica_commons_format_year($study_dto->model->timeline->endYearRec, !empty($study_dto->model->timeline->endMonthRec) ? $study_dto->model->timeline->endMonthRec : NULL); ?></p></td>
							  </tr>
						  <?php endif; ?>
					  <?php endif; ?>
				  <?php endif; ?>
          <?php endif; ?>
          <?php if (!empty($study_dto->model->recruitmentIC)): ?>
            <tr>
              <th><?php print $localize->getTranslation("study_taxonomy.vocabulary.methods-recruitments.description"); ?></th>
              <td>
                    <p><?php print $localize->getTranslation("study_taxonomy.vocabulary.methods-recruitments.term." . $study_dto->model->recruitmentIC . ".title"); ?></p>
                      <?php if (stristr($study_dto->model->recruitmentIC, 'other') && !empty($study_dto->model->methods->otherRecruitmentIC)): ?>
                         : <?php print $study_dto->model->otherRecruitmentIC; ?>
                    <?php endif; ?>
              </td>
            </tr>
          <?php endif; ?>
          <?php if (!empty($study_dto->model->numberOfParticipants->participant->number) || !empty($study_dto->model->numberOfParticipants->participant->noLimit)): ?>
            <tr>
              <th><?php print $localize->getTranslation('numberOfParticipants.participants') ?></th>
              <td>
                <p>
                  <?php if (!empty($study_dto->model->numberOfParticipants->participant->number)) {
                    print obiba_mica_commons_format_number($study_dto->model->numberOfParticipants->participant->number);
                  } ?>
                  <?php if (!empty($study_dto->model->numberOfParticipants->participant->noLimit)): ?>
                    (<?php print t('No Limit'); ?>)
                  <?php endif; ?>
                </p>
              </td>
            </tr>
          <?php endif; ?>

          <?php if (!empty($study_dto->model->numberOfParticipants->participantsActual)): ?>
            <tr>
              <th><?php print t('Actual number of participants') ?></th>
              <td>
                <p>
                  <?php print obiba_mica_commons_format_number($study_dto->model->numberOfParticipants->participantsActual);?>
					<?php if (!empty($study_dto->model->numberOfParticipants->actualYear)): ?>
	
						(<?php print t('as of') ?>
						<?php print obiba_mica_commons_format_year($study_dto->model->numberOfParticipants->actualYear, !empty($study_dto->model->numberOfParticipants->actualMonth) ? $study_dto->model->numberOfParticipants->actualMonth : NULL); ?>)
					
					<?php endif; ?>
                </p>
              </td>
            </tr>
          <?php endif; ?>		  
		  
          <?php if (!empty($study_dto->model->numberOfParticipants->sample->number) || !empty($study_dto->model->numberOfParticipants->sample->noLimit)): ?>
            <tr>
              <th><?php print variable_get_value('study_target_number_participant_with_sample_label') ?></th>
              <td>
                <p>
                  <?php if (!empty($study_dto->model->numberOfParticipants->sample->number)) {
                    print obiba_mica_commons_format_number($study_dto->model->numberOfParticipants->sample->number);
                  } ?>
                  <?php if (!empty($study_dto->model->numberOfParticipants->sample->noLimit)): ?>
                    (<?php print t('No Limit'); ?>)
                  <?php endif; ?>
                </p>
              </td>
            </tr>
          <?php endif; ?>

          <?php if (!empty(obiba_mica_commons_get_localized_field($study_dto->model->numberOfParticipants, 'info'))): ?>
            <tr>
              <th><?php print variable_get_value('study_supplementary_information_about_target_number_participant') ?></th>
              <td>
                <p><?php print obiba_mica_commons_get_localized_field($study_dto->model->numberOfParticipants, 'info'); ?></p>
              </td>
            </tr>
          <?php endif; ?>

          <?php if (!empty($study_dto->model->methods->info)): ?>
            <tr>
              <th><?php print t('Supplementary Information') ?></th>
              <td>
                <p><?php print obiba_mica_commons_get_localized_field($study_dto->model->methods, 'info'); ?></p>
              </td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>

      </div>
    </div>

  </section>

  <section>

    <div class="row">
      <div class="col-lg-6 col-xs-12">
        <!-- AVAILABLE INFORMATION -->
        <h2 id="access"><?php print t('Available Information') ?></h2>
        <div class="table-responsive">
          <table class="table table-striped valign-table-column">
            <tbody>
			<?php if (!empty($study_dto->model->healthInformation->healthInfo)): ?>
				<tr>
				  <th><?php print t('Health Information'); ?></th>
				  <td>
					<ul class="list-unstyled">
					  <?php foreach ($study_dto->model->healthInformation->healthInfo as $health): ?>
						<li>
						  <?php print $localize->getTranslation("study_taxonomy.vocabulary.health-information-health-info.term." . $health . ".title"); ?>
						  <?php if ((stristr($health, 'OD_p') || stristr($health, 'OD_i')) && !empty($study_dto->model->healthInformation->otherDiab)): ?>
							 : <?php print obiba_mica_commons_get_localized_field($study_dto->model->healthInformation->otherDiab); ?>
						  <?php endif; ?>
						</li>
					  <?php endforeach; ?>
					</ul>
				  </td>
				</tr>
			<?php endif; ?>
			<?php if (!empty($study_dto->model->measureDiet)): ?>
            <tr>
              <th><?php print $localize->getTranslation("study_taxonomy.vocabulary.measure-diet.description"); ?></th>
              <td>
                <p><?php print $localize->getTranslation("study_taxonomy.vocabulary.measure-diet.term." . $study_dto->model->measureDiet . ".title");  ?></p>
              </td>
            </tr>
			<?php endif; ?>
			
			<?php if (!empty($study_dto->model->measureDNA)): ?>
            <tr>
              <th><?php print $localize->getTranslation("study_taxonomy.vocabulary.measure-DNA.description"); ?></th>
              <td>
                <p><?php print $localize->getTranslation("study_taxonomy.vocabulary.measure-DNA.term." . $study_dto->model->measureDNA . ".title"); ?></p>
              </td>
            </tr>
			<?php endif; ?>
			
			<?php if (!empty($study_dto->model->measurePA)): ?>
            <tr>
              <th><?php print $localize->getTranslation("study_taxonomy.vocabulary.measure-PA.description"); ?></th>
              <td>
                <p><?php print $localize->getTranslation("study_taxonomy.vocabulary.measure-PA.term." . $study_dto->model->measurePA . ".title"); ?></p>
              </td>
            </tr>
			<?php endif; ?>



            </tbody>
          </table>
        </div>
      </div>
      <div class="col-lg-6 col-xs-12">
        <!-- MARKER PAPER -->
        <?php if (!empty($study_dto->model->markerPaper) || !empty($study_dto->model->pubmedId)): ?>
          <h2 id="marker"><?php print t('Marker Paper') ?></h2>
          <?php if (!empty($study_dto->model->markerPaper)): ?>
            <p><?php print $study_dto->model->markerPaper; ?></p>
          <?php endif; ?>
          <?php if (!empty($study_dto->model->pubmedId)): ?>
            <p>
              <a
                href="http://www.ncbi.nlm.nih.gov/pubmed/<?php print $study_dto->model->pubmedId; ?>"
                target="_blank">
                PUBMED <?php print $study_dto->model->pubmedId; ?>
              </a>
            </p>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>

  </section>
  
  <section>

    <div class="row">
      <div class="col-lg-6 col-xs-12">
        <!-- ETHNIC / RACIAL GROUPS -->
        <h2 id="ethnic"><?php print t('Broad categories of ethnic and racial groups recruited') ?></h2>
        <div class="table-responsive">
          <table class="table table-striped valign-table-column">
            <tbody>
			<?php if (!empty($study_dto->model->ethnicityRace)): ?>
				<tr>
				  <th><?php print t('Ethnic or racial group'); ?></th>
				  <th><?php print t('Approximate number of participants'); ?></th>
				</tr>
			  <?php foreach ($study_dto->model->ethnicityRace as $ethnic): ?>
				<tr>
					<td>
					<?php if (!empty($ethnic->ethGroup)): ?>
					  <?php print $localize->getTranslation("study_taxonomy.vocabulary.ethnicityRace-ethGroup.term." . $ethnic->ethGroup . ".title"); ?>
					  <?php if (stristr($ethnic->ethGroup, 'other') && !empty($ethnic->otherEthGroup)): ?>
						 : <?php print obiba_mica_commons_get_localized_field($ethnic->otherEthGroup); ?>
					  <?php endif; ?>
					<?php endif; ?>
					</td>
					<td>
					<?php if (!empty($ethnic->numGroup)): ?>
					  <?php print $ethnic->numGroup; ?>
					<?php endif; ?>
					</td>
				</tr>
			  <?php endforeach; ?>
			<?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-lg-6 col-xs-12">
        <!-- GENOTYPING -->
        <?php if (!empty($study_dto->model->genoPlats)): ?>
          <h2 id="geno"><?php print t('Genotyping information') ?></h2>
            <div class="table-responsive">
				<table class="table table-striped valign-table-column">
					<tbody>
						<tr>
						  <th><?php print $localize->getTranslation("study_taxonomy.vocabulary.genoPlats-genotypingPlat.title"); ?></th>
						  <th><?php print t("Number of Individuals"); ?></th>
						  <th><?php print $localize->getTranslation("study_taxonomy.vocabulary.genoPlats-imputationPanel.title"); ?></th>
						  <th><?php print $localize->getTranslation("study_taxonomy.vocabulary.genoPlats-referencePop.title"); ?></th>
						</tr>
					  <?php foreach ($study_dto->model->genoPlats as $geno): ?>
						<tr>
							<td>
							<?php if (!empty($geno->genotypingPlat)): ?>
							  <?php print $localize->getTranslation("study_taxonomy.vocabulary.genoPlats-genotypingPlat.term." . $geno->genotypingPlat . ".title"); ?>
							  <?php if (stristr($geno->genotypingPlat, 'other') && !empty($geno->otherGenoPlat)): ?>
								 : <?php print $geno->otherGenoPlat; ?>
							  <?php endif; ?>
							<?php endif; ?>
							</td>
							<td>
							<?php if (!empty($geno->numberGenoIndiv)): ?>
							  <?php print $geno->numberGenoIndiv; ?>
							<?php endif; ?>
							</td>
							<td>
							<?php if (!empty($geno->imputationPanel)): ?>
							  <?php print $localize->getTranslation("study_taxonomy.vocabulary.genoPlats-imputationPanel.term." . $geno->imputationPanel . ".title"); ?>
							  <?php if (stristr($geno->imputationPanel, 'other') && !empty($geno->otherImputPanel)): ?>
								 : <?php print $geno->otherImputPanel; ?>
										<?php if (!empty($geno->panelYear)): ?>
											(<?php print obiba_mica_commons_format_year($geno->panelYear, !empty($geno->panelMonth) ? $geno->panelMonth : NULL); ?>)
										<?php endif; ?>
							  <?php endif; ?>
							<?php endif; ?>
							</td>
							<td>
							<?php if (!empty($geno->referencePop)): ?>
							  <?php print $localize->getTranslation("study_taxonomy.vocabulary.genoPlats-referencePop.term." . $geno->referencePop . ".title"); ?>
							  <?php if (stristr($geno->referencePop, 'other') && !empty($geno->otherRefPop)): ?>
								 : <?php print $geno->otherRefPop; ?>
							  <?php endif; ?>
							<?php endif; ?>
							</td>
						</tr>
					  <?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>
      </div>
    </div>

  </section>

  <!-- SUPPLEMENTARY INFORMATION -->
  <?php if (!empty($study_dto->model->info)): ?>
    <section>
      <h2 id="info"><?php print t('Supplementary Information'); ?></h2>

      <p><?php print obiba_mica_commons_get_localized_field($study_dto->model, 'info'); ?></p>
    </section>
  <?php endif; ?>

  <!-- DOCUMENTS -->

  <!-- TODO find a way not to show browser if there are no files -->
  <?php if (!empty($attachments)): ?>
    <section>
      <h2><?php print variable_get_value('files_documents_label'); ?></h2>
      <?php print (!empty($file_browser) ? $file_browser : $attachments); ?>
    </section>
  <?php endif; ?>

  <!-- TIMELINE -->
  <?php if (!empty($timeline)): ?>
    <section>
      <h2 id="timeline"><?php print t('Timeline'); ?></h2>

      <p class="help-block">
        <?php print t('Each colour in the timeline graph below represents a separate Study Population, while each segment in the graph represents a separate Data Collection Event. Clicking on a segment gives more detailed information on a Data Collection Event.') ?>
      </p>

      <div class="scroll-content-tab">
        <?php print $timeline; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- POPULATIONS -->
  <?php if (!empty($populations)): ?>
    <section>
      <h2 id="populations"><?php if (count($populations) > 1) {
          print t('Populations');
        }
        else print '<span id="population-' . $key . '">' . t('Population') . '</span>' ?></h2>
      <?php if (count($populations) == 1): ?>
        <?php print array_pop($populations)['html']; ?>
      <?php else: ?>

        <div class="row tabbable tabs-left">
          <div class="col-lg-2 col-xs-12  ">
            <ul class="nav nav-pills nav-stacked" id="tab-pane">
              <?php foreach ($populations as $key => $population): ?>
                <li <?php if ($key == array_keys($populations)[0]) {
                  print 'class="active"';
                } ?>>
                  <a href="#population-<?php print $key; ?>" data-toggle="pill">
                    <?php print obiba_mica_commons_get_localized_field($population['data']['data'], 'name'); ?>
                  </a>
                </li>

              <?php endforeach ?>
            </ul>
          </div>
          <div class="col-lg-10 col-xs-12  ">
            <div class="tab-content indent">
              <?php foreach ($populations as $key => $population): ?>
                <div
                  class="tab-pane  <?php if ($key == array_keys($populations)[0]) {
                    print 'active';
                  } ?>"
                  id="population-<?php print $key; ?>">
                  <?php print $population['html']; ?>
                </div>
              <?php endforeach ?>
            </div>
          </div>
        </div>

      <?php endif ?>
    </section>
  <?php endif; ?>

  <!-- NETWORKS placeholder -->
  <section id="networks">
    <div><?php print t('Loading ...') ?></div>
  </section>

  <!-- DATASETS placeholder -->
  <section id="datasets">
    <div><?php print t('Loading ...') ?></div>
  </section>

  <!-- COVERAGE placeholder -->
  <div ng-controller="VariableCoverageChartController">
    <section id="coverage" ng-if="d3Configs && d3Configs.length">
      <h2><?php print t('Variables Classification') ?></h2>

      <div ng-repeat="d3Config in d3Configs">
        <obiba-nv-chart chart-config="d3Config"></obiba-nv-chart>
      </div>
    </section>
  </div>
  

  <div><?php !empty($investigators_modal) ? print $investigators_modal : ''; ?></div>
  <div><?php !empty($contacts_modal) ? print $contacts_modal : ''; ?></div>
  <div><?php !empty($members_modal) ? print $members_modal : ''; ?></div>
</article>
<div class="back-to-top t_badge"><i class="glyphicon glyphicon-arrow-up"></i>
</div>
