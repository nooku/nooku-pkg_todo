<?
/**
 * Todo - a Joomla example extension built with Nooku Framework.
 *
 * @package     Todo
 * @copyright   Copyright (C) 2011 - 2014 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/joomlatools/joomlatools-todo for the canonical source repository
 */

defined('KOOWA') or die; ?>

<div class="k-table-container">
    <div class="k-table">
        <table class="table--fixed">
            <thead>
            <tr>
                <th width="1%">
                    <?= helper('grid.checkall')?>
                </th>
                <th>
                    <?= translate('Message'); ?>
                </th>
                <th>
                    <?= helper('grid.sort', array('column' => 'created_on', 'title' => 'Time')); ?>
                </th>
            </tr>
            </thead>
            <tbody>
            <? foreach ($activities as $activity): ?>
                <tr>
                    <td>
                        <?= helper('grid.checkbox', array('entity' => $activity)) ?>
                    </td>
                    <td>
                        <?= helper('com:activities.activity.activity', array('entity' => $activity)) ?>
                    </td>
                    <td>
                        <?= helper('date.humanize', array('date' => $activity->created_on)); ?>
                    </td>
                </tr>
            <? endforeach; ?>

            <? if (!count($activities)) : ?>
                <tr>
                    <td colspan="9">
                        <?= translate('No activities found.') ?>
                    </td>
                </tr>
            <? endif; ?>
            </tbody>
        </table>

    </div><!-- .k-table -->

    <? if (count($tasks)): ?>
        <div class="k-table-pagination">
            <?= helper('paginator.pagination') ?>
        </div><!-- .k-table-pagination -->
    <? endif; ?>

</div><!-- .k-table-container -->