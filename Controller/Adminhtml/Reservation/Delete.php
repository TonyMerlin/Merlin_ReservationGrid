<?php
namespace Merlin\ReservationGrid\Controller\Adminhtml\Reservation;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\Redirect;

class Delete extends Action
{
    const ADMIN_RESOURCE = 'Merlin_ReservationGrid::reservation';

    public function execute()
    {
        $id = $this->getRequest()->getParam('reservation_id');
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $this->_objectManager
                    ->create(\Merlin\ReservationGrid\Model\Reservation::class)
                    ->load($id)
                    ->delete();
                $this->messageManager->addSuccessMessage(__('Reservation deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        } else {
            $this->messageManager->addErrorMessage(__('No reservation ID specified.'));
        }
        return $resultRedirect->setPath('*/*/index');
    }
}
