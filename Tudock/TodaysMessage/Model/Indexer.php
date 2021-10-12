<?php
namespace Tudock\TodaysMessage\Model;

use Magento\Framework\Indexer\ActionInterface as IndexerInterface;
use Magento\Framework\Mview\ActionInterface as MviewInterface;

class Indexer implements IndexerInterface, MviewInterface
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Tudock\TodaysMessage\Model\TudockIndexerFactory $ModelindexerFactory,
        \Tudock\TodaysMessage\Model\ResourceModel\TudockIndexer $TudockIndexerResourceModel,
//        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory

    ) {
        $this->scopeConfig = $scopeConfig;
        $this->ModelindexerFactory = $ModelindexerFactory;
        $this->TudockIndexerResourceModel = $TudockIndexerResourceModel;
//        $this->categoryFactory = $categoryFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
    }
    /**
     * It's used by mview. It will execute when process indexer in "Update on schedule" Mode.
     */
    public function execute($ids)
    {
        $this->executeFull();
    }

    /**
     * Add code here for execute full indexation
     */
    public function executeFull()
    {
        $catIds = array();
        $MessageinCat = array();
    //get configuration values
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $configValue =  $this->scopeConfig->getValue('todays_message_sec/todays_message_group/todays_message_field', $storeScope);
        $configValuearray = json_decode($configValue, true);
        //delete data function
        foreach ($configValuearray as $value){
            $ModelindexerFactorycreate = $this->ModelindexerFactory->create();
            $ModelfactoryNewdataCreate = $ModelindexerFactorycreate;

        //check already exists using model collection
            $Dataexits = $ModelindexerFactorycreate->getCollection()
                ->addFieldToFilter('category', array('eq' => $value['category_id']))
                ->addFieldToFilter('message', array('eq' => $value['message']));

        //get all products from selected category
//            $categoryProducts = $this->categoryFactory->create()->load($value['category_id'])->getProductCollection()->addAttributeToSelect('*');
            $collection = $this->_productCollectionFactory->create();
            $collection->addAttributeToSelect('*');
            $collection->addCategoriesFilter(['in' => $value['category_id']]);
//            return $collection;
            $productSkus = '';
            foreach ($collection as $products){
                $productSkus = $products->getSku().",".$productSkus;
            }
        //save data if doesn't exit or update products data if exists
            if($Dataexits->getData()){
                foreach($Dataexits as $item) {
                    $item->setProduct($productSkus);
                }
                $this->TudockIndexerResourceModel->save($item);
            }else{
                $ModelfactoryNewdataCreate->setCategory($value['category_id']);
                $ModelfactoryNewdataCreate->setProduct($productSkus);
                $ModelfactoryNewdataCreate->setMessage($value['message']);
                $this->TudockIndexerResourceModel->save($ModelfactoryNewdataCreate);
            }
            $catIds []= array('cat_id'=>$value['category_id'],'message'=>$value['message']);
            $MessageinCat[] = $value['message'];
        }
        $this->DeleteRecordIndexer($catIds,$ModelindexerFactorycreate);
    }

    /**
     * Add code here for execute partial indexation by ID list
     */
    public function executeList(array $ids)
    {
        $this->executeFull();
    }

    /**
     * Add code here for execute partial indexation by ID
     */
    public function executeRow($id)
    {
        $this->executeFull();
    }

    public function DeleteRecordIndexer($catIds,$ModelindexerFactorycreate){
        $Exitingdata = $ModelindexerFactorycreate->getCollection();
        foreach ($Exitingdata as $exitingValues){
            $found = false;
            foreach ($catIds as $catIdmessage) {
//                print_r($catIdmessage);
                if (strcmp($catIdmessage['cat_id'],$exitingValues->getData("category")) == 0) {
                    if (strcmp($catIdmessage['message'],$exitingValues->getData("message")) == 0){
                        $found = true;
                        break;
                    }
                }
            }
            if ($found == true){
                continue;
            }else{
                $ModelindexerFactorycreate->load($exitingValues->getData("tudock_indexer_id"));
                $ModelindexerFactorycreate->delete();
            }
        }
    }
}