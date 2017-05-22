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
dpm($population);
dpm($specific_population);
?>

<h3 class="no-top-margin">
  <?php if (empty($hide_title)) print obiba_mica_commons_get_localized_field($population, 'name') ?>
</h3>

<?php if (!empty($population->description)): ?>
  <p>
    <?php print obiba_mica_commons_markdown(obiba_mica_commons_get_localized_field($population, 'description')); ?>
  </p>
<?php endif; ?>

<?php if (!empty($population->model->recruitment->dataSources)
  || !empty($population->model->recruitment->specificPopulationSources)
  || !empty($population->model->recruitment->otherSpecificPopulationSource)
  || !empty($population->model->recruitment->otherSource)
): ?>
  <h4><?php print t('Sources of Recruitment') ?></h4>

  <div class="scroll-content-tab">
    <table class="table table-striped">
      <tbody>
      <?php if (in_array('general_population', $population->model->recruitment->dataSources)): ?>
        <tr>
          <th><?php print t('General Population') ?></th>
		  <td> <?php print t('Yes'); ?> </td>
        </tr>
      <?php endif; ?>

      <?php if (!empty($population->model->recruitment->specificPopulationSources)): ?>
        <tr>
          <th><?php print t('Specific Population') ?></th>
          <td> <?php print $specific_population; ?> </td>
        </tr>
      <?php endif; ?>

      <?php if (!empty($population->model->recruitment->otherSource)): ?>
        <tr>
          <th><?php print t('Other sources') ?></th>
          <td><?php print obiba_mica_commons_get_localized_field($population->model->recruitment, 'otherSource'); ?></td>
        </tr>
      <?php endif; ?>

      <?php if (in_array('exist_studies', $population->model->recruitment->dataSources)): ?>
        <tr>
          <th><?php print t('Existing Studies') ?></th>
		  <td> <?php print t('Yes'); ?> </td>
        </tr>
      <?php endif; ?>

      </tbody>
    </table>
  </div>
<?php endif; ?>

<?php if (
  (isset($population->model->selectionCriteria->gender) && (obiba_mica_study_get_gender($population->model->selectionCriteria->gender) !== NULL))
  || !empty($population->model->selectionCriteria->ageMin)
  || !empty($population->model->selectionCriteria->ageMax)
  || !empty($population->model->selectionCriteria->countriesIso)
  || !empty($population->model->selectionCriteria->areaResidence)
  || !empty($population->model->selectionCriteria->healthStatus)
  || !empty($population->model->selectionCriteria->otherCriteria)
): ?>
  <h4><?php print t('Selection Criteria') ?></h4>
  <div class="scroll-content-tab">
    <table class="table table-striped">
      <tbody>
      <?php if (!empty($population->model->selectionCriteria->gender)): ?>
        <tr>
          <th><?php print t('Gender') ?></th>
          <td><?php 
			if ($population->model->selectionCriteria->gender === 'women') {
				print t('Women only');
			} elseif ($population->model->selectionCriteria->gender === 'men') {
				print t('Men only');
			} elseif ($population->model->selectionCriteria->gender === 'women_men') {
				print t('Women and Men');
			} else {
				print t('N/A');
			}
		  ?></td>
        </tr>
      <?php endif; ?>

      <?php if (!empty($population->model->selectionCriteria->ageMin) || !empty($population->model->selectionCriteria->ageMax)): ?>
        <tr>
          <th><?php print t('Age') ?></th>
          <td>
            <?php !empty($population->model->selectionCriteria->ageMin) ? print t('Minimum') . ' '
              .$population->model->selectionCriteria->ageMin
              . ((!empty($population->model->selectionCriteria->ageMax))? ', ':'' ): NULL;?>
            <?php !empty($population->model->selectionCriteria->ageMax) ? print t('Maximum') . ' '
              . $population->model->selectionCriteria->ageMax : NULL; ?>
          </td>
        </tr>
      <?php endif; ?>

      <?php if (!empty($population->model->selectionCriteria->countriesIso)): ?>
        <tr>
          <th><?php print t('Country'); ?></th>
          <td>
            <?php print obiba_mica_commons_countries($population->model->selectionCriteria->countriesIso); ?>
          </td>
        </tr>
      <?php endif; ?>

      <?php if (!empty($population->model->selectionCriteria->areaResidence)): ?>
        <tr>
          <th><?php print t('Area of residence') ?></th>
          <td>
            <?php print obiba_mica_commons_get_localized_field($population->model->selectionCriteria, 'areaResidence'); ?>
          </td>
        </tr>
      <?php endif; ?>

      <?php if (!empty($population->model->selectionCriteria->criteria)): ?>
        <t>
          <th><?php print t('Criteria') ?></th>
          <td><?php print $selection_criteria ?></td>
        </t>
      <?php endif ?>

      <?php if (!empty($population->model->selectionCriteria->healthStatus)  && !empty(array_filter($population->model->selectionCriteria->healthStatus, 'obiba_mica_commons_array_empty_test'))): ?>
        <tr>
          <th><?php print t('Health Status') ?></th>
          <td>
            <?php $health_status = obiba_mica_commons_get_localized_dtos_field($population->model->selectionCriteria, 'healthStatus'); ?>
            <?php print implode(', ', $health_status); ?>
          </td>
        </tr>
      <?php endif; ?>

      <?php if (!empty($population->model->selectionCriteria->otherCriteria)): ?>
        <tr>
          <th><?php print t('Other') ?></th>
          <td><?php print obiba_mica_commons_get_localized_field($population->model->selectionCriteria, 'otherCriteria'); ?></td>
        </tr>
      <?php endif; ?>

      <?php if (!empty($population->model->selectionCriteria->info)): ?>
        <tr>
          <th><?php print t('Supplementary Information') ?></th>
          <td><?php print obiba_mica_commons_get_localized_field($population->model->selectionCriteria, 'info'); ?></td>
        </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>

<?php if (!empty($attachments)): ?>
      <h4><?php print variable_get_value('files_documents_label'); ?></h4>
  <?php print $attachments; ?>
<?php endif; ?>
