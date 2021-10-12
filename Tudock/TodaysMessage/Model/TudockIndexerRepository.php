<?php

namespace Tudock\TodaysMessage\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Tudock\TodaysMessage\Api\Data\TudockIndexerInterfaceFactory;
use Tudock\TodaysMessage\Api\Data\TudockIndexerSearchResultsInterfaceFactory;
use Tudock\TodaysMessage\Api\TudockIndexerRepositoryInterface;
use Tudock\TodaysMessage\Model\ResourceModel\TudockIndexer as ResourceTudockIndexer;
use Tudock\TodaysMessage\Model\ResourceModel\TudockIndexer\CollectionFactory as TudockIndexerCollectionFactory;

class TudockIndexerRepository implements TudockIndexerRepositoryInterface
{

    protected $resource;

    protected $extensibleDataObjectConverter;
    protected $dataTudockIndexerFactory;

    protected $searchResultsFactory;

    protected $tudockIndexerFactory;

    protected $tudockIndexerCollectionFactory;

    private $storeManager;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;


    /**
     * @param ResourceTudockIndexer $resource
     * @param TudockIndexerFactory $tudockIndexerFactory
     * @param TudockIndexerInterfaceFactory $dataTudockIndexerFactory
     * @param TudockIndexerCollectionFactory $tudockIndexerCollectionFactory
     * @param TudockIndexerSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceTudockIndexer $resource,
        TudockIndexerFactory $tudockIndexerFactory,
        TudockIndexerInterfaceFactory $dataTudockIndexerFactory,
        TudockIndexerCollectionFactory $tudockIndexerCollectionFactory,
        TudockIndexerSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->tudockIndexerFactory = $tudockIndexerFactory;
        $this->tudockIndexerCollectionFactory = $tudockIndexerCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataTudockIndexerFactory = $dataTudockIndexerFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface $tudockIndexer
    ) {
        /* if (empty($tudockIndexer->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $tudockIndexer->setStoreId($storeId);
        } */
        
        $tudockIndexerData = $this->extensibleDataObjectConverter->toNestedArray(
            $tudockIndexer,
            [],
            \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface::class
        );
        
        $tudockIndexerModel = $this->tudockIndexerFactory->create()->setData($tudockIndexerData);
        
        try {
            $this->resource->save($tudockIndexerModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the tudockIndexer: %1',
                $exception->getMessage()
            ));
        }
        return $tudockIndexerModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($tudockIndexerId)
    {
        $tudockIndexer = $this->tudockIndexerFactory->create();
        $this->resource->load($tudockIndexer, $tudockIndexerId);
        if (!$tudockIndexer->getId()) {
            throw new NoSuchEntityException(__('tudock_indexer with id "%1" does not exist.', $tudockIndexerId));
        }
        return $tudockIndexer->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->tudockIndexerCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface $tudockIndexer
    ) {
        try {
            $tudockIndexerModel = $this->tudockIndexerFactory->create();
            $this->resource->load($tudockIndexerModel, $tudockIndexer->getTudockIndexerId());
            $this->resource->delete($tudockIndexerModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the tudock_indexer: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($tudockIndexerId)
    {
        return $this->delete($this->get($tudockIndexerId));
    }
}

