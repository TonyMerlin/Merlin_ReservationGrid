<?php
namespace Merlin\ReservationGrid\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Reservation extends AbstractDb
{
    protected function _construct()
    {
        // table inventory_reservation, primary key reservation_id
        $this->_init('inventory_reservation', 'reservation_id');
    }
}
