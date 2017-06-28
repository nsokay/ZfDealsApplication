<?php
namespace ZfDeals\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\Feature\RowGatewayFeature;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\HydratorInterface;
use ZfDeals\Entity\Product as ProductEntity;

class Product extends TableGateway
{
    protected $tableName = 'product';
    protected $idCol = 'productId';
    protected $entityPrototype = null;
    protected $hydrator = null;

    public function __construct($adapter)
    {
        parent::__construct($this->tableName, $adapter);
        $this->entityPrototype = new ProductEntity();
        $this->hydrator = new \Zend\Stdlib\Hydrator\Reflection;
    }

    public function insert($entity)
    {
        return parent::insert($this->hydrator->extract($entity));
    }

    public function findOneById($id)
    {
        return $this->hydrator->hydrate(
            $this->select(array('productId' => $id))->current()->getArrayCopy(),
            new $this->entityPrototype()
        );
    }
}