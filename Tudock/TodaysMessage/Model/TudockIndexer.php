<?php

namespace Tudock\TodaysMessage\Model;

use Magento\Framework\Api\DataObjectHelper;
use Tudock\TodaysMessage\Api\Data\TudockIndexerInterface;
use Tudock\TodaysMessage\Api\Data\TudockIndexerInterfaceFactory;

class TudockIndexer extends \Magento\Framework\Model\AbstractModel
{

    protected $_eventPrefix = 'tudock_todaysmessage_tudock_indexer';
    protected $dataObjectHelper;

    protected $tudock_indexerDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param TudockIndexerInterfaceFactory $tudock_indexerDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Tudock\TodaysMessage\Model\ResourceModel\TudockIndexer $resource
     * @param \Tudock\TodaysMessage\Model\ResourceModel\TudockIndexer\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        TudockIndexerInterfaceFactory $tudock_indexerDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Tudock\TodaysMessage\Model\ResourceModel\TudockIndexer $resource,
        \Tudock\TodaysMessage\Model\ResourceModel\TudockIndexer\Collection $resourceCollection,
        array $data = []
    ) {
        $this->tudock_indexerDataFactory = $tudock_indexerDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve tudock_indexer model with tudock_indexer data
     * @return TudockIndexerInterface
     */
    public function getDataModel()
    {
        $tudock_indexerData = $this->getData();
        
        $tudock_indexerDataObject = $this->tudock_indexerDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $tudock_indexerDataObject,
            $tudock_indexerData,
            TudockIndexerInterface::class
        );
        
        return $tudock_indexerDataObject;
    }
}

