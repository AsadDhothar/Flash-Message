<?php

namespace Tudock\TodaysMessage\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface TudockIndexerRepositoryInterface
{

    /**
     * Save tudock_indexer
     * @param \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface $tudockIndexer
     * @return \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface $tudockIndexer
    );

    /**
     * Retrieve tudock_indexer
     * @param string $tudockIndexerId
     * @return \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($tudockIndexerId);

    /**
     * Retrieve tudock_indexer matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Tudock\TodaysMessage\Api\Data\TudockIndexerSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete tudock_indexer
     * @param \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface $tudockIndexer
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface $tudockIndexer
    );

    /**
     * Delete tudock_indexer by ID
     * @param string $tudockIndexerId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($tudockIndexerId);
}

