<?php
namespace ApacheSolrForTypo3\Solr\Backend\SolrModule;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Thomas Hohn <tho@systime.dk>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Search Statistics Module
 *
 * @author Thomas Hohn <tho@systime.d>
 */
class SearchStatisticsModuleController extends AbstractModuleController
{
    /**
     * Module name, used to identify a module f.e. in URL parameters.
     *
     * @var string
     */
    protected $moduleName = 'SearchStatistics';

    /**
     * Module title, shows up in the module menu.
     *
     * @var string
     */
    protected $moduleTitle = 'Search Statistics';

    /**
     * Index action, shows an overview of the state of the Solr index
     *
     * @return void
     */
    public function indexAction()
    {
        $stats = GeneralUtility::makeInstance('ApacheSolrForTypo3\\Solr\\Domain\\Search\\Statistics\\Statistics');

        // @TODO: Do we want Typoscript constants to restrict the results?
        $this->view->assign('top_search_phrases', $stats->getTopKeyWordsWithHits($this->site->getRootPageId(), 5));
        $this->view->assign('top_search_phrases_without_hits',
            $stats->getTopKeyWordsWithoutHits($this->site->getRootPageId(), 5));
        $this->view->assign('search_phrases_statistics', $stats->getSearchStatistics($this->site->getRootPageId(), 100));
    }
}
