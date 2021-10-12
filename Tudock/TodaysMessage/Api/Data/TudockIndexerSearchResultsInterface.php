<?php

namespace Tudock\TodaysMessage\Api\Data;

interface TudockIndexerSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get tudock_indexer list.
     * @return \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface[]
     */
    public function getItems();

    /**
     * Set category list.
     * @param \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

