<?php
namespace Tudock\TodaysMessage\Block;
use Magento\Framework\View\Element\Template;

class Productdetail extends Template
{
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Tudock\TodaysMessage\Model\TudockIndexerFactory $customProductfactory,
        array $data = []
    ) {
        $this->customProductfactory = $customProductfactory;
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }
    public function getProductmsge($catId)
    {
        $finalarray = '';
        $collection = $this->customProductfactory->create()->getCollection()->addFieldToFilter('category',$catId);
        if($collection->getSize()){
            foreach ($collection->getData() as $data){
                $products = $data["product"];
                $Message[] = $data["message"];
            }
            $ke = array_rand($Message);
            $finalarray = array('product'=>$products,'message'=>$Message[$ke]);
        }
        return $finalarray;
    }
    public function getCurrentCategory()
    {
        return $this->_registry->registry('current_category');
    }

    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }
}