<?php
namespace Merlin\ReservationGrid\Controller\Adminhtml\Reservation;

use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;

class MassDelete extends Action
{
    const ADMIN_RESOURCE = 'Merlin_ReservationGrid::reservation';

    public function execute()
    {
        $ids = $this->getRequest()->getParam('selected');
        $resultRedirect = $this->resultRedirectFactory->create();
        if (!is_array($ids) || empty($ids)) {
            $this->messageManager->addErrorMessage(__('Please select reservation(s).'));
            return $resultRedirect->setPath('*/*/index');
        }
        try {
            $model = $this->_objectManager->create(\Merlin\ReservationGrid\Model\Reservation::class);
            foreach ($ids as $id) {
                $model->load($id)->delete();
            }
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', count($ids))
            );
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __('An error occurred while deleting reservations.')
            );
        }
        return $resultRedirect->setPath('*/*/index');
    }
}
