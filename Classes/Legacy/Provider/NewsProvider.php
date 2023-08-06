<?php

namespace DMK\T3rest\Legacy\Provider;

use DMK\T3rest\Legacy\Model\GenericModel;
use DMK\T3rest\Legacy\Search\TtNewsSearch;
use Sys25\RnBase\Frontend\Filter\BaseFilter;
use Sys25\RnBase\Search\SearchBase;
use tx_rnbase;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012-2017 Rene Nitzsche
 *  Contact: rene@system25.de
 *  All rights reserved
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 ***************************************************************/

/**
 * This is a sample REST provider for tt_news.
 *
 * @author Rene Nitzsche
 */
class NewsProvider extends AbstractProvider
{
    private $configurations;
    private $confId;
    private $decorator;
    private $items = [];

    protected function handleRequest($configurations, $confId)
    {
        if ($itemUid = $configurations->getParameters()->get('get')) {
            $confId = $confId.'get.';
            $item = $this->getItem($itemUid, $configurations, $confId, [\tx_cfcleague_util_ServiceRegistry::getMatchService(), 'search']);
            $decorator = tx_rnbase::makeInstance('tx_t3rest_decorator_News');
            $data = $decorator->prepareItem($item, $configurations, $confId);
        } elseif ($searchType = $configurations->getParameters()->get('search')) {
            $confId = $confId.'search.';
            $data = $this->getItems($searchType, $configurations, $confId);
        }

        return $data;
    }

    protected function getItems($searchType, $configurations, $confId)
    {
        $searcher = SearchBase::getInstance(TtNewsSearch::class);
        $filter = BaseFilter::createFilter($configurations->getParameters(), $configurations, null, $confId.'defined.'.$searchType.'.filter.');
        $fields = [];
        $options = [];
        // suche initialisieren
        $filter->init($fields, $options);
        $options['forcewrapper'] = 1;

        $prov = tx_rnbase::makeInstance(\Sys25\RnBase\Frontend\Marker\ListProvider::class);
        $searchCallback = [$searcher, 'search'];
        $prov->initBySearch($searchCallback, $fields, $options);

        $this->configurations = $configurations;
        $this->confId = $confId;
        $this->decorator = tx_rnbase::makeInstance('tx_t3rest_decorator_News');
        $prov->iterateAll([$this, 'loadItem']);

        return $this->items;
    }

    public function loadItem($item)
    {
        $data = $this->decorator->prepareItem($item, $this->configurations, $this->confId);
        $this->items[] = $data;
    }

    protected function getBaseClass()
    {
        return GenericModel::class;
    }

    protected function getConfId()
    {
        return 'news.';
    }
}
